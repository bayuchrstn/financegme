<?php
class Model_teknis_dashboard extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function table_summary_problem()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$cat_problem = array();
		$cat_cust = array();
		
		$this->db->from("master");
		$this->db->where('category', 'noc_cat_problem');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$n = 0;
			foreach($q->result_array() as $k => $r){
				$n++;
				$cat_problem[$k]['no'] = $n;
				$cat_problem[$k]['id'] = $r['id'];
				$cat_problem[$k]['nama'] = $r['name'];
			}
		}
		$q->free_result();
		
		$this->db->from("master");
		$this->db->where('category', 'customer_type');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$cat_cust[$k]['id'] = $r['id'];
				$cat_cust[$k]['nama'] = $r['name'];
				$cat_cust[$k]['total'] = 0;
			}
		}
		$q->free_result();
		
		$msg = '<table class="table table-xxs text-nowrap table-hover table-striped text-size-mini table-bordered">
		<thead><tr class="text-bold"><th width="1">NO</th><th>PROBLEM</th>';
		foreach($cat_cust as $cck => $ccr){
			$msg .= '<th>'.strtoupper($cat_cust[$cck]['nama']).'</th>';
		}
		$msg .= '<th>BTS</th><th>TOTAL</th><th width="1">EXTERNAL</th><th>INTERNAL</th></tr></thead><tbody>';
		
		$ttl_bts = 0;
		$ttl_gt = 0;
		foreach($cat_problem as $cpk => $cpr){
			$msg .= '<tr>';
			$msg .= '<td align="right">'.$cat_problem[$cpk]['no'].'.</td><td>'.$cat_problem[$cpk]['nama'].'</td>';
			$total = 0;
			foreach($cat_cust as $cck => $ccr){
				$this->db->select("count(a.id) as ttl", false);
				$this->db->from('task_laporan_harian a');
				$this->db->join('task b','a.task_id = b.id','left');
				$this->db->join('customer c','b.location_id = c.id','left');
				$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
				$this->db->where('b.area' , $this->session->userdata('scope_area'));
				$this->db->where('a.problem_cat' , $cat_problem[$cpk]['id']);
				$this->db->where('d.id' , $cat_cust[$cck]['id']);
				$this->db->where('a.jenis_laporan' , 'gangguan');
				$this->db->where('b.location' , 'customer');
				$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
				//$this->db->where('a.status_laporan !=' , '3');
				//$this->db->order_by($order_name, $order_dir);
				$q = $this->db->get();
				if($q->num_rows() > 0){
					foreach($q->result_array() as $r){
						$total += $r['ttl'];
						$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
						$msg .= '<td align="center">'.$v.'</td>';
						$cat_cust[$cck]['total'] = $cat_cust[$cck]['total'] + $r['ttl'];
					}
				}
				$q->free_result();
			}
			$this->db->select("count(a.id) as ttl", false);
			$this->db->from('task_laporan_harian a');
			$this->db->join('task b','a.task_id = b.id','left');
			$this->db->join('customer c','b.location_id = c.id','left');
			$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
			$this->db->where('b.area' , $this->session->userdata('scope_area'));
			$this->db->where('a.problem_cat' , $cat_problem[$cpk]['id']);
			$this->db->where('a.jenis_laporan' , 'gangguan');
			$this->db->where('b.location' , 'BTS');
			$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
			//$this->db->where('a.status_laporan !=' , '3');
			//$this->db->order_by($order_name, $order_dir);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$total += $r['ttl'];
					$ttl_bts += $r['ttl'];
					$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
					$msg .= '<td align="center">'.$v.'</td>';
				}
			}
			$q->free_result();
			$msg .= '<td align="center" class="text-black">'.$total.'</td>';
			$ttl_gt += $total;
			$this->db->select("count(a.id) as ttl", false);
			$this->db->from('task_laporan_harian a');
			$this->db->join('task b','a.task_id = b.id','left');
			$this->db->join('customer c','b.location_id = c.id','left');
			$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
			$this->db->where('b.area' , $this->session->userdata('scope_area'));
			$this->db->where('a.problem_cat' , $cat_problem[$cpk]['id']);
			$this->db->where('a.jenis_laporan' , 'gangguan');
			$this->db->where('a.problem_side' , '2');
			$this->db->where("(b.location = 'customer' OR b.location = 'BTS')" , NULL, FALSE);
			$this->db->where("d.id IS NOT NULL",NULL, FALSE);
			$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
			//$this->db->where('a.status_laporan !=' , '3');
			//$this->db->order_by($order_name, $order_dir);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
					$msg .= '<td align="center">'.$v.'</td>';
				}
			}
			$q->free_result();
			$this->db->select("count(a.id) as ttl", false);
			$this->db->from('task_laporan_harian a');
			$this->db->join('task b','a.task_id = b.id','left');
			$this->db->join('customer c','b.location_id = c.id','left');
			$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
			$this->db->where('b.area' , $this->session->userdata('scope_area'));
			$this->db->where('a.problem_cat' , $cat_problem[$cpk]['id']);
			$this->db->where('a.jenis_laporan' , 'gangguan');
			$this->db->where('a.problem_side' , '1');
			$this->db->where("(b.location = 'customer' OR b.location = 'BTS')" , NULL, FALSE);
			$this->db->where("d.id IS NOT NULL",NULL, FALSE);
			$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
			//$this->db->where('a.status_laporan !=' , '3');
			//$this->db->order_by($order_name, $order_dir);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
					$msg .= '<td align="center">'.$v.'</td>';
				}
			}
			$q->free_result();
			$msg .= '</tr>';
		}
		$msg .= '<tr>';
		$msg .= '<td colspan="2" align="right" class="text-black">Grand Total</td>';
		foreach($cat_cust as $cck => $ccr){
			$msg .= '<td align="center" class="text-black">'.$cat_cust[$cck]['total'].'</td>';
		}
		$msg .= '<td align="center" class="text-black">'.$ttl_bts.'</td><td align="center" class="text-black">'.$ttl_gt.'</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td>';
		$msg .= '</tr>';
		
		$msg .= '<tr>';
		$msg .= '<td colspan="2" align="right" class="text-black">External</td>';
		$total = 0;
		foreach($cat_cust as $cck => $ccr){
			$this->db->select("count(a.id) as ttl", false);
			$this->db->from('task_laporan_harian a');
			$this->db->join('task b','a.task_id = b.id','left');
			$this->db->join('customer c','b.location_id = c.id','left');
			$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
			$this->db->where('b.area' , $this->session->userdata('scope_area'));
			//$this->db->where('a.problem_cat' , $cat_problem[$cpk]['id']);
			$this->db->where('d.id' , $cat_cust[$cck]['id']);
			$this->db->where('a.jenis_laporan' , 'gangguan');
			$this->db->where('a.problem_side' , '2');
			$this->db->where('b.location' , 'customer');
			$this->db->where("d.id IS NOT NULL",NULL, FALSE);
			$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
			//$this->db->where('a.status_laporan !=' , '3');
			//$this->db->order_by($order_name, $order_dir);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$total += $r['ttl'];
					$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
					$msg .= '<td align="center">'.$v.'</td>';
					$cat_cust[$cck]['total'] = $cat_cust[$cck]['total'] + $r['ttl'];
				}
			}
			$q->free_result();
		}
		$this->db->select("count(a.id) as ttl", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where('a.problem_side' , '2');
		$this->db->where('b.location' , 'BTS');
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		//$this->db->where('a.status_laporan !=' , '3');
		//$this->db->order_by($order_name, $order_dir);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$total += $r['ttl'];
				$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
				$msg .= '<td align="center">'.$v.'</td>';
			}
		}
		$q->free_result();
		$msg .= '<td align="center" class="text-black">'.$total.'</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td>';
		$msg .= '</tr>';
		
		$msg .= '<tr>';
		$msg .= '<td colspan="2" align="right" class="text-black">Internal</td>';
		$total = 0;
		foreach($cat_cust as $cck => $ccr){
			$this->db->select("count(a.id) as ttl", false);
			$this->db->from('task_laporan_harian a');
			$this->db->join('task b','a.task_id = b.id','left');
			$this->db->join('customer c','b.location_id = c.id','left');
			$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
			$this->db->where('b.area' , $this->session->userdata('scope_area'));
			//$this->db->where('a.problem_cat' , $cat_problem[$cpk]['id']);
			$this->db->where('d.id' , $cat_cust[$cck]['id']);
			$this->db->where('a.jenis_laporan' , 'gangguan');
			$this->db->where('a.problem_side' , '1');
			$this->db->where('b.location' , 'customer');
			$this->db->where("d.id IS NOT NULL",NULL, FALSE);
			$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
			//$this->db->where('a.status_laporan !=' , '3');
			//$this->db->order_by($order_name, $order_dir);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$total += $r['ttl'];
					$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
					$msg .= '<td align="center">'.$v.'</td>';
					$cat_cust[$cck]['total'] = $cat_cust[$cck]['total'] + $r['ttl'];
				}
			}
			$q->free_result();
		}
		$this->db->select("count(a.id) as ttl", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where('a.problem_side' , '1');
		$this->db->where('b.location' , 'BTS');
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		//$this->db->where('a.status_laporan !=' , '3');
		//$this->db->order_by($order_name, $order_dir);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$total += $r['ttl'];
				$v = ($r['ttl'] == 0)?'':number_format($r['ttl'],0);
				$msg .= '<td align="center">'.$v.'</td>';
			}
		}
		$q->free_result();
		$msg .= '<td align="center" class="text-black">'.$total.'</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td>';
		$msg .= '</tr>';
		
		
		$msg  .= '</tbody></table>';
		echo $msg;
	}

	function table_top_teen()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$msg = '<table class="table table-xxs text-nowrap text-size-mini table-bordered">
		<thead><tr class="text-black text-center"><th width="1">NO</th><th>PROBLEM</th>';
		$msg .= '<th>TOTAL</th><th>INTERNAL</th><th width="1">EXTERNAL</th></tr></thead><tbody>';
		$ttl = 0;
		$ttl_int = 0;
		$ttl_ext = 0;
		$this->db->select("e.name, COUNT(a.id) AS total, SUM(IF(a.problem_side = '1', 1, 0)) AS internal, SUM(IF(a.problem_side = '2', 1, 0)) AS external", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->join('master e',"a.problem_cat = e.id AND e.category = 'noc_cat_problem'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where("e.id IS NOT NULL",NULL, FALSE);
		$this->db->where("d.id IS NOT NULL",NULL, FALSE);
		$this->db->where("(b.location = 'customer' OR b.location = 'BTS')",NULL, FALSE);
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		$this->db->group_by('e.id');
		$this->db->order_by('total', 'DESC');
		$this->db->order_by('internal', 'DESC');
		$this->db->order_by('external', 'DESC');
		$this->db->order_by('e.name', 'ASC');
		//$this->db->limit(10);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$n = 0;
			foreach($q->result_array() as $r){
				$n++;
				$ttl += $r['total'];
				$ttl_int += $r['internal'];
				$ttl_ext += $r['external'];
				$class = '';
				if($n == 1){
					$class = 'bg-danger-800';
				}elseif($n > 1 && $n <= 3){
					$class = 'bg-danger';
				}elseif($n > 3 && $n <= 10){
					$class = 'bg-danger-300';
				}
				$msg .= '<tr class="'.$class.'">';
				$msg .= '<td align="right">'.$n.'.</td><td>'.$r['name'].'</td><td align="center">'.number_format($r['total'],0).'</td><td align="center">'.number_format($r['internal'],0).'</td><td align="center">'.number_format($r['external'],0).'</td>';
				$msg .= '</tr>';
			}
		}
		$msg .= '<tr class="text-black">';
		$msg .= '<td align="right" colspan="2">Grand Total</td><td align="center">'.number_format($ttl,0).'</td><td align="center">'.number_format($ttl_int,0).'</td><td align="center">'.number_format($ttl_ext,0).'</td>';
		$msg .= '</tr>';
		$q->free_result();
		
		$msg  .= '</tbody></table>';
		echo $msg;
	}

	function donut_persentase_problem()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
		$this->db->select("e.name, COUNT(a.id) AS total, SUM(IF(a.problem_side = '1', 1, 0)) AS internal, SUM(IF(a.problem_side = '2', 1, 0)) AS external", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->join('master e',"a.problem_cat = e.id AND e.category = 'noc_cat_problem'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where("e.id IS NOT NULL",NULL, FALSE);
		$this->db->where("d.id IS NOT NULL",NULL, FALSE);
		$this->db->where("(b.location = 'customer' OR b.location = 'BTS')",NULL, FALSE);
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		$this->db->group_by('e.id');
		$this->db->order_by('e.name', 'ASC');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data[$k]['nama'] = $r['name'];
				$data[$k]['nilai'] =  $r['total'];
			}
		}
		$q->free_result();
		echo json_encode($data);
	}

	function donut_persentase_source_problem()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
		$this->db->select("IF(a.problem_side = '1', 'Internal', 'External') AS nama, COUNT(a.id) AS total, SUM(IF(a.problem_side = '1', 1, 0)) AS internal, SUM(IF(a.problem_side = '2', 1, 0)) AS external", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->join('master e',"a.problem_cat = e.id AND e.category = 'noc_cat_problem'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where("e.id IS NOT NULL",NULL, FALSE);
		$this->db->where("d.id IS NOT NULL",NULL, FALSE);
		$this->db->where("(b.location = 'customer' OR b.location = 'BTS')",NULL, FALSE);
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		$this->db->group_by('a.problem_side');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data[$k]['nama'] = $r['nama'];
				$data[$k]['nilai'] =  $r['total'];
			}
		}
		$q->free_result();
		echo json_encode($data);
	}

	function bar_total_problem()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
		$this->db->select("e.name, COUNT(a.id) AS total, SUM(IF(a.problem_side = '1', 1, 0)) AS internal, SUM(IF(a.problem_side = '2', 1, 0)) AS external", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->join('master e',"a.problem_cat = e.id AND e.category = 'noc_cat_problem'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where("e.id IS NOT NULL",NULL, FALSE);
		$this->db->where("d.id IS NOT NULL",NULL, FALSE);
		$this->db->where("(b.location = 'customer' OR b.location = 'BTS')",NULL, FALSE);
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		$this->db->group_by('e.id');
		$this->db->order_by('e.name', 'ASC');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data[$k]['nama'] = $r['name'];
				$data[$k]['nilai'] =  $r['total'];
			}
		}
		$q->free_result();
		echo json_encode($data);
	}

	function bar_problem_by_category_customer()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
		$this->db->select("d.name, COUNT(a.id) AS total, SUM(IF(a.problem_side = '1', 1, 0)) AS internal, SUM(IF(a.problem_side = '2', 1, 0)) AS external", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->join('master e',"a.problem_cat = e.id AND e.category = 'noc_cat_problem'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where("e.id IS NOT NULL",NULL, FALSE);
		$this->db->where("d.id IS NOT NULL",NULL, FALSE);
		$this->db->where("(b.location = 'customer' OR b.location = 'BTS')",NULL, FALSE);
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		$this->db->group_by('d.id');
		$this->db->order_by('total', 'DESC');
		$this->db->order_by('internal', 'DESC');
		$this->db->order_by('external', 'DESC');
		$this->db->order_by('e.name', 'ASC');
		$this->db->limit(10);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data[$k]['nama'] = $r['name'];
				$data[$k]['nilai'] =  $r['total'];
				$data[$k]['internal'] =  $r['internal'];
				$data[$k]['external'] =  $r['external'];
			}
		}
		$q->free_result();
		echo json_encode($data);
	}

	function bar_problem_by_external_internal()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
		$this->db->select("e.name, COUNT(a.id) AS total, SUM(IF(a.problem_side = '1', 1, 0)) AS internal, SUM(IF(a.problem_side = '2', 1, 0)) AS external", false);
		$this->db->from('task_laporan_harian a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('master d',"c.customer_type = d.code AND d.category = 'customer_type'",'left');
		$this->db->join('master e',"a.problem_cat = e.id AND e.category = 'noc_cat_problem'",'left');
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->where('a.jenis_laporan' , 'gangguan');
		$this->db->where("e.id IS NOT NULL",NULL, FALSE);
		$this->db->where("d.id IS NOT NULL",NULL, FALSE);
		$this->db->where("(b.location = 'customer' OR b.location = 'BTS')",NULL, FALSE);
		$this->db->where("(b.date_start BETWEEN '".$tanggal_awal." 00:00:00' AND '".$tanggal_akhir." 23:59:59')" , NULL, FALSE);
		$this->db->group_by('e.id');
		$this->db->order_by('e.name', 'ASC');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data[$k]['nama'] = $r['name'];
				$data[$k]['nilai'] =  $r['total'];
				$data[$k]['internal'] =  $r['internal'];
				$data[$k]['external'] =  $r['external'];
			}
		}
		$q->free_result();
		echo json_encode($data);
	}

	function data_monthly()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
		$net_profit = 0;
		//INCOME
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.jumlah),0) AS jumlah
			FROM
			  gmd_finance_invoice_billing a
			WHERE (
				a.tanggal BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )
			  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data['total_income'] =  number_format($r['jumlah'],0);
				$net_profit += $r['jumlah'];
			}
		}
		$q->free_result();
		//AR
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."'),0)),0) AS jumlah
			FROM
			  gmd_finance_invoice_customer a
			WHERE a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
			AND a.date_invoice <= '".$tanggal_akhir."'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '".$tanggal_akhir."')");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data['accounts_receivable'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		//EXPENSES
		$total_expenses = 0;
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.jumlah),0) AS jumlah
			FROM
			  gmd_finance_ap_billing a
			WHERE (
				a.tanggal BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )
			  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$total_expenses += $r['jumlah'];
				$net_profit -= $r['jumlah'];
			}
		}
		$q->free_result();
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.jumlah),0) AS jumlah
			FROM
			  gmd_finance_transaksi_kasir a
			WHERE (
				a.tanggal BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )
			  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
			  AND a.tipe = '0'
			  AND a.fixcost_cat != '0'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$total_expenses += $r['jumlah'];
				$net_profit -= $r['jumlah'];
			}
		}
		$q->free_result();
		$data['total_expenses'] =  number_format($total_expenses,0);
		//AP
		$q = $this->db->query("SELECT
			 COALESCE(SUM(a.jumlah) - SUM(COALESCE((select sum(jumlah) from gmd_finance_ap_billing where id_invoice = a.id AND tanggal <= '".$tanggal_akhir."'),0)),0) AS jumlah
			FROM
			  gmd_finance_ap_invoice a
			WHERE a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
			AND a.tanggal <= '".$tanggal_akhir."'
			AND (a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '".$tanggal_akhir."')");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data['accounts_payable'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		//CASH
		$q = $this->db->query("SELECT 
			COALESCE(SUM(IF(tipe = 1, jumlah, 0.00) - IF(tipe = 0, jumlah, 0.00))) AS jumlah 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE tanggal <= '".$tanggal_akhir."'
			AND branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data['cash_at_end_of_month'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		//TAX
		$q = $this->db->query("SELECT
		  (SUM(sp.debet) - SUM(sp.kredit)) as jumlah
		FROM
		  (SELECT
			id, tipe, tanggal_faktur AS tanggal, jumlah as debet, 0 as kredit, CONCAT(no_seri_faktur, ' - ', nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax
		  WHERE tanggal_faktur <= '".$tanggal_akhir."'
			AND tipe = '0'
			AND branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
		  UNION
		  ALL
		  SELECT
			id, tipe, tanggal_faktur AS tanggal, 0 as debet, jumlah as kredit, CONCAT(no_seri_faktur, ' - ', nama_pkp) AS deskripsi
		  FROM
			gmd_finance_transaksi_tax
		  WHERE tanggal_faktur <= '".$tanggal_akhir."'
			AND tipe = '1'
			AND branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
		  UNION
		  ALL
		  SELECT
			id, '2' AS tipe, tanggal, 0 as debet, jumlah as kredit, CONCAT('Pembayaran') AS deskripsi
		  FROM
			gmd_finance_transaksi_tax_billing
		  WHERE tanggal <= '".$tanggal_akhir."'
			AND branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."') AS sp
		ORDER BY sp.tanggal ASC, sp.tipe ASC");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data['tax'] =  number_format($r['jumlah'],0);
				$net_profit -= $r['jumlah'];
			}
		}
		$q->free_result();
		//sales this month
		$q = $this->db->query("SELECT
		  SUM(b.product_price) AS jumlah
		FROM
		  gmd_customer a
		  LEFT JOIN gmd_customer_product b
			ON a.id = b.customer_id
		  LEFT JOIN gmd_users c
			ON a.id_user = c.id
		WHERE (
			a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
			AND '".$tanggal_akhir." 23:59:59'
		  )
		  AND a.area = '".$this->session->userdata('scope_area')."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data['sales_this_month'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		//EXPENSES DIVISI
		$q = $this->db->query("SELECT
		 SUM(a.jumlah) AS jumlah
		FROM
		  gmd_finance_transaksi_kasir a
		  LEFT JOIN gmd_finance_master_divisi b
			ON a.divisi_cat = b.id
		WHERE (
			a.tanggal BETWEEN '".$tanggal_awal."'
			AND '".$tanggal_akhir."'
		  )
		  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
		  AND a.tipe = '0'
		  AND a.fixcost_cat != '0'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data['expenses_divisi'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		//EXPENSES VENDOR
		$q = $this->db->query("SELECT
		  SUM(a.jumlah) AS jumlah
		FROM
		  gmd_finance_ap_billing a
		  LEFT JOIN gmd_finance_ap_invoice b
			ON a.id_invoice = b.id
		  LEFT JOIN gmd_finance_supplier c
			ON b.supplier = c.id
		WHERE (
			a.tanggal BETWEEN '".$tanggal_awal."'
			AND '".$tanggal_akhir."'
		  )
		  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data['expenses_vendor'] =  number_format($r['jumlah'],0);
			}
		}
		$q->free_result();
		
		$data['net_profit'] =  number_format($net_profit,0);
		echo json_encode($data);
	}

	function cash_month()
	{
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucfirst('jan'),
			'02' => ucfirst('feb'),
			'03' => ucfirst('mar'),
			'04' => ucfirst('apr'),
			'05' => ucfirst('mey'),
			'06' => ucfirst('jun'),
			'07' => ucfirst('jul'),
			'08' => ucfirst('aug'),
			'09' => ucfirst('sep'),
			'10' => ucfirst('oct'),
			'11' => ucfirst('nov'),
			'12' => ucfirst('dec'),
			);
		$data = array();
		foreach($bulan as $k => $v){
			$tanggal_awal = date(''.$year.'-'.$k.'-01');
			$tanggal_akhir = date(''.$year.'-'.$k.'-t');
			
			$q = $this->db->query("SELECT 
			COALESCE(SUM(IF(tipe = 1, jumlah, 0.00) - IF(tipe = 0, jumlah, 0.00))) AS jumlah 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE tanggal <= '".$tanggal_akhir."'
			AND branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  $r['jumlah'];
				}
			}
			$q->free_result();
		}
		
		echo json_encode($data);
	}

	function expenses_divisi_this_month()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
			$q = $this->db->query("SELECT
			  COALESCE(b.nama, 'Lain2') AS divisi, SUM(a.jumlah) AS harga
			FROM
			  gmd_finance_transaksi_kasir a
			  LEFT JOIN gmd_finance_master_divisi b
				ON a.divisi_cat = b.id
			WHERE (
				a.tanggal BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )
			  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
			  AND a.tipe = '0'
			  AND a.fixcost_cat != '0'
			GROUP BY b.nama
			ORDER BY b.nama ASC");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $k => $r){
					$data[$k]['nama'] = $r['divisi'];
					$data[$k]['rupiah'] =  $r['harga'];
				}
			}
			$q->free_result();
		
		echo json_encode($data);
	}

	function expenses_vendor_this_month()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
			$q = $this->db->query("SELECT
			  COALESCE(c.nama, 'Lain2') AS vendor, SUM(a.jumlah) AS harga
			FROM
			  gmd_finance_ap_billing a
			  LEFT JOIN gmd_finance_ap_invoice b
				ON a.id_invoice = b.id
			  LEFT JOIN gmd_finance_supplier c
				ON b.supplier = c.id
			WHERE (
				a.tanggal BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )
			  AND a.branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
			GROUP BY c.nama
			ORDER BY c.nama ASC");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $k => $r){
					$data[$k]['nama'] = $r['vendor'];
					$data[$k]['rupiah'] =  $r['harga'];
				}
			}
			$q->free_result();
		
		echo json_encode($data);
	}

	function sales_of_the_year()
	{
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucfirst('jan'),
			'02' => ucfirst('feb'),
			'03' => ucfirst('mar'),
			'04' => ucfirst('apr'),
			'05' => ucfirst('mey'),
			'06' => ucfirst('jun'),
			'07' => ucfirst('jul'),
			'08' => ucfirst('aug'),
			'09' => ucfirst('sep'),
			'10' => ucfirst('oct'),
			'11' => ucfirst('nov'),
			'12' => ucfirst('dec'),
			);
		$data = array();
		foreach($bulan as $k => $v){
			$tanggal_awal = date(''.$year.'-'.$k.'-01');
			$tanggal_akhir = date(''.$year.'-'.$k.'-t');
			
			$q = $this->db->query("SELECT
			  SUM(b.product_price) AS jumlah
			FROM
			  gmd_customer a
			  LEFT JOIN gmd_customer_product b
				ON a.id = b.customer_id
			  LEFT JOIN gmd_users c
				ON a.id_user = c.id
			WHERE (
				a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				AND '".$tanggal_akhir." 23:59:59'
			  )
			  AND a.area = '".$this->session->userdata('scope_area')."'");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  $r['jumlah'];
				}
			}
			$q->free_result();
		}
		
		echo json_encode($data);
	}

	function gross_profit()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		
		if($month == 'th'){
			$tanggal_awal = date(''.$year.'-01-01');
			$tanggal_akhir = date(''.$year.'-12-t');
		}elseif($month == 'sm_1'){
			$tanggal_awal = date(''.$year.'-01-01');
			$tanggal_akhir = date(''.$year.'-06-t');
		}elseif($month == 'sm_2'){
			$tanggal_awal = date(''.$year.'-07-01');
			$tanggal_akhir = date(''.$year.'-12-t');
		}elseif($month == 'tw_1'){
			$tanggal_awal = date(''.$year.'-01-01');
			$tanggal_akhir = date(''.$year.'-03-t');
		}elseif($month == 'tw_2'){
			$tanggal_awal = date(''.$year.'-04-01');
			$tanggal_akhir = date(''.$year.'-06-t');
		}elseif($month == 'tw_3'){
			$tanggal_awal = date(''.$year.'-07-01');
			$tanggal_akhir = date(''.$year.'-09-t');
		}elseif($month == 'tw_4'){
			$tanggal_awal = date(''.$year.'-10-01');
			$tanggal_akhir = date(''.$year.'-12-t');
		}else{
			$tanggal_awal = date(''.$year.'-'.$month.'-01');
			$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		}
		
		$data = array();
		
		$ar = 0;
		$q = $this->db->query("SELECT
			  COALESCE(SUM(a.jumlah),0) AS jumlah_ar
			FROM
			  gmd_finance_invoice_customer a
			WHERE (
				a.date_invoice BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$ar += $r['jumlah_ar'];
			}
		}
		$q->free_result();
		
		$ap = 0;
		$q = $this->db->query("SELECT
			  COALESCE(SUM(a.jumlah),0) AS jumlah_ap
			FROM
			  gmd_finance_ap_invoice a
			WHERE (
				a.tanggal BETWEEN '".$tanggal_awal."'
				AND '".$tanggal_akhir."'
			  )");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$ap += $r['jumlah_ap'];
			}
		}
		$q->free_result();
		
		$data[0]['nama'] = 'Accounts Receivable';
		$data[0]['nilai'] =  $ar;
		$data[1]['nama'] = 'Accounts Payable';
		$data[1]['nilai'] =  $ap;
		$data[2]['nama'] = 'Gross Profit Rp ';
		$data[2]['nilai'] =  number_format($ar - $ap,0);
		echo json_encode($data);
	}

}
