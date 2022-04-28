<?php
class Model_teknis_report_laporan_harian extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'nama_lokasi', 'b.subject', 'a.laporan', 'a.analisa', 'a.tindakan', 'c.name', 'solve', 'b.date_start', 'b.date_due', 'b.time_duration'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'id';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS CASE
			b.location
			WHEN 'customer'
			THEN d.customer_name
			WHEN 'pre_customer'
			THEN e.customer_name
			WHEN 'bts'
			THEN f.bts_name
		  END AS nama_lokasi, b.subject, a.laporan, a.analisa, a.tindakan, c.name AS author_name, IF(a.solve = 'Y', 'SOLVE', 'TIDAK') solve, b.date_start, b.date_due, DATE_FORMAT(
    b.date_start, '%d/%m/%Y %H:%i:%s'
  ) AS date_startnya, DATE_FORMAT(b.date_due, '%d/%m/%Y %H:%i:%s') AS date_duenya,
		TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration", false);
        $this->db->from('gmd_task_laporan_harian a');
		$this->db->join('gmd_task b','a.task_id = b.id','left');
		$this->db->join('gmd_users c','b.author = c.id','left');
		$this->db->join('gmd_customer d',"b.location_id = d.id AND b.location = 'customer'",'left');
		$this->db->join('gmd_customer e',"b.location_id = e.id AND b.location = 'pre_customer'",'left');
		$this->db->join('gmd_bts f',"b.location_id = f.id AND b.location = 'bts'",'left');
		$this->db->where("(b.date_created between '".$this->input->post('searchDateTransFirst')." 00:00:00' and '".$this->input->post('searchDateTransFirst')." 23:59:59')", NULL, FALSE);
		$this->db->where('b.area',$this->session->userdata('scope_area'));
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('b.date_created', 'ASC');
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$time_duration = secondsToTime($r['time_duration']);
				$row  = array(
								$no.'.',
								$r['nama_lokasi'],
								$r['subject'],
								$r['laporan'],
								$r['analisa'],
								$r['tindakan'],
								$r['author_name'],
								$r['solve'],
								$r['date_startnya'],
								$r['date_duenya'],
								$time_duration,
							);

	 
				$data[] = $row;
			}
		}
		$q->free_result();
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $n,
                        "recordsFiltered" => $n,
                        "data" => $data,
                );
        echo json_encode($output);
	}

	function get_data_info()
	{
		$msg = '';
		
		$this->db->select("c.name AS author_name, b.date_start, b.date_due, TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration", false);
        $this->db->from('gmd_task_laporan_harian a');
		$this->db->join('gmd_task b','a.task_id = b.id','left');
		$this->db->join('gmd_users c','b.author = c.id','left');
		$this->db->join('gmd_customer d',"b.location_id = d.id AND b.location = 'customer'",'left');
		$this->db->join('gmd_customer e',"b.location_id = e.id AND b.location = 'pre_customer'",'left');
		$this->db->join('gmd_bts f',"b.location_id = f.id AND b.location = 'bts'",'left');
		$this->db->where("(b.date_created between '".$this->input->post('searchDateTransFirst')." 00:00:00' and '".$this->input->post('searchDateTransFirst')." 23:59:59')", NULL, FALSE);
		$this->db->where('b.area',$this->session->userdata('scope_area'));
        $q = $this->db->get();
        $no = 0;
        $time_duration = 0;
        $person = array();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$time_duration += $r['time_duration'];
				if(!in_array($r['author_name'], $person, true)){
					array_push($person, $r['author_name']);
				}
			}
		}
		$q->free_result();
		$time_duration_perhari = ($time_duration != 0 && $no != 0)?secondsToTime(round($time_duration/$no)):0;
		$time_duration_person = ($time_duration != 0 && sizeof($person) != 0)?secondsToTime(round($time_duration/sizeof($person))):0;
		
		$msg .= '<ul>';
		$msg .= '<li>Jumlah Laporan = '.$no.'</li>';
		$msg .= '<li>MTTR Per Hari = '.$time_duration_perhari.'</li>';
		$msg .= '<li>MTTR Rata - rata Per Person = '.$time_duration_person.'</li>';
		$msg .= '</ul>';
		
		echo $msg;
	}
	
}
