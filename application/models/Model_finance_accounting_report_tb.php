<?php
class Model_finance_accounting_report_tb extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }
	
	function re($tanggal){
		set_time_limit(0);
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("a.tukar, coalesce(b.saldo, 0.00) as saldo",false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '".$branch."'", 'left');
		$kelompok = array(1, 2, 3);
		$this->db->where_not_in('a.kelompok', $kelompok);
		$this->db->where('b.tanggal <',$tanggal);
		$this->db->group_by('a.id');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($r['tukar'] == '1'){	$data += $r['saldo']; }
				else{	$data -= $r['saldo']; }
			}
		}
		$q->free_result();
		
		$this->db->select("SUM(a.kredit - a.debet) as saldo",false);
		$kelompok = array(1, 2, 3);
		$this->db->where_not_in('c.kelompok', $kelompok);
		$this->db->where('a.bulan <',$tanggal);
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_monthly a');
		$this->db->join('finance_coa c', 'a.id_biaya = c.id', 'left');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data += $r['saldo'];
			}
		}
		$q->free_result();
		return $data;
	}
	
	function cye($tanggal_awal_tahun, $tanggal_akhir){
		set_time_limit(0);
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("a.tukar, coalesce(b.saldo, 0.00) as saldo",false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '".$branch."'", 'left');
		$kelompok = array(1, 2, 3);
		$this->db->where_not_in('a.kelompok', $kelompok);
		$this->db->where('b.tanggal >=',$tanggal_awal_tahun);
		$this->db->where('b.tanggal <=',$tanggal_akhir);
		$this->db->group_by('a.id');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($r['tukar'] == '1'){	$data += $r['saldo']; }
				else{	$data -= $r['saldo']; }
			}
		}
		$q->free_result();
		
		$this->db->select("SUM(a.kredit - a.debet) as saldo",false);
		$kelompok = array(1, 2, 3);
		$this->db->where_not_in('c.kelompok', $kelompok);
		$this->db->where('a.bulan >=',$tanggal_awal_tahun);
		$this->db->where('a.bulan <=',$tanggal_akhir);
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_monthly a');
		$this->db->join('finance_coa c', 'a.id_biaya = c.id', 'left');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data += $r['saldo'];
			}
		}
		$q->free_result();
		return $data;
	}
	
	function have_child($id){
		set_time_limit(0);
		$data = false;
		$this->db->where('parent', $id);
		$q = $this->db->get('finance_coa');	
		if($q->num_rows() > 0){
			$data = true;
		}
		$q->free_result();
		
		return $data;
	}
	

	
	function looping_child_label($sub, $data, $tanggal_awal, $tanggal_akhir, $parent = 0)
	{
		set_time_limit(0);
		$page_uri = base_url().'finance_accounting_report_als/index/';
		$searchform = $tanggal_awal.'/'.$tanggal_akhir;
		$f_label = $sub * 40;
		foreach($data as $r){
			if($r['parent'] == $parent){
				$balance_begin_debet = $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, 'balance_begin_debet', $r['id']);
				$balance_begin_debet += $this->balance_begin_debet($r['id'], $r['tukar'], $tanggal_awal, $r['kelompok']);
				$balance_begin_kredit = $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, 'balance_begin_kredit', $r['id']);
				$balance_begin_kredit += $this->balance_begin_kredit($r['id'], $r['tukar'], $tanggal_awal, $r['kelompok']);
				$balance_period_debet = $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, 'balance_period_debet', $r['id']);
				$balance_period_debet += $this->balance_period_debet($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir);
				$balance_period_kredit = $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, 'balance_period_kredit', $r['id']);
				$balance_period_kredit += $this->balance_period_kredit($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir);
				$balance_ending_debet = $balance_begin_debet + $balance_period_debet;
				$balance_ending_kredit = $balance_begin_kredit + $balance_period_kredit;
				
				$balance_begin_debet = ($balance_begin_debet < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($balance_begin_debet,2)).')</span>':number_format($balance_begin_debet,2);
				$balance_begin_kredit = ($balance_begin_kredit < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($balance_begin_kredit,2)).')</span>':number_format($balance_begin_kredit,2);
				$balance_period_debet = ($balance_period_debet < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($balance_period_debet,2)).')</span>':number_format($balance_period_debet,2);
				$balance_period_kredit = ($balance_period_kredit < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($balance_period_kredit,2)).')</span>':number_format($balance_period_kredit,2);
				$balance_ending_debet = ($balance_ending_debet < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($balance_ending_debet,2)).')</span>':number_format($balance_ending_debet,2);
				$balance_ending_kredit = ($balance_ending_kredit < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($balance_ending_kredit,2)).')</span>':number_format($balance_ending_kredit,2);
				$strong = ($r['id'] == $r['kelompok'].'00000')?' class="text-black"':'';
				echo '<tr '.$strong.'><td><label style="margin-left:'.$f_label.'px;"><a href="'.$page_uri.$r['id'].'/'.$searchform.'" target="blank" class="text-primary-800">'.$r['id'].' - '.$r['nama'].'</a></label></td>
				<td align="right">'.$balance_begin_debet.'</td>
				<td align="right">'.$balance_begin_kredit.'</td>
				<td align="right">'.$balance_period_debet.'</td>
				<td align="right">'.$balance_period_kredit.'</td>
				<td align="right">'.$balance_ending_debet.'</td>
				<td align="right">'.$balance_ending_kredit.'</td>
				</tr>';
				$this->looping_child_label(($sub+1), $data, $tanggal_awal, $tanggal_akhir, $r['id']);
			}
		}
	}
	
	function looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $tipe, $parent)
	{
		set_time_limit(0);
		$msg = 0.00;
		if($tipe == "balance_begin_debet"){
			foreach($data as $r){
				if($r['parent'] == $parent){
					$msg += $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $tipe, $r['id']);
					$msg += $this->balance_begin_debet($r['id'], $r['tukar'], $tanggal_awal, $r['kelompok']);
				}
			}
		}elseif($tipe == "balance_begin_kredit"){
			foreach($data as $r){
				if($r['parent'] == $parent){
					$msg += $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $tipe, $r['id']);
					$msg += $this->balance_begin_kredit($r['id'], $r['tukar'], $tanggal_awal, $r['kelompok']);
				}
			}
		}elseif($tipe == "balance_period_debet"){
			foreach($data as $r){
				if($r['parent'] == $parent){
					$msg += $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $tipe, $r['id']);
					$msg += $this->balance_period_debet($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir);
				}
			}
		}elseif($tipe == "balance_period_kredit"){
			foreach($data as $r){
				if($r['parent'] == $parent){
					$msg += $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $tipe, $r['id']);
					$msg += $this->balance_period_kredit($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir);
				}
			}
		}
		return $msg;
	}
		
	function balance_begin_debet($id_biaya, $tukar, $tanggal_awal, $kelompok){
		set_time_limit(0);
		$tanggal_awal_tahun =  date("Y-01-01", strtotime($tanggal_awal));
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("coalesce(b.saldo, 0.00) as saldo",false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '".$branch."'", 'left');
		$this->db->where("a.id", $id_biaya);
		$this->db->where('b.tanggal <',$tanggal_awal);
		if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
			$this->db->where('b.tanggal >=',$tanggal_awal_tahun);
		}
		$this->db->group_by('a.id');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data += $r['saldo'];
			}
		}
		$q->free_result();
		
		$this->db->select("SUM(debet) as saldo_debet, SUM(kredit) as saldo_kredit,",false);
		$this->db->where('a.id_biaya',$id_biaya);
		$this->db->where('a.tanggal <',$tanggal_awal);
		if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
			$this->db->where('a.tanggal >=',$tanggal_awal_tahun);
		}
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_detail a');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($tukar == '1'){$data += $r['saldo_kredit'];}
				else{$data += $r['saldo_debet'];}
			}
		}
		$q->free_result();
		return $data;
	}
	
	function balance_begin_kredit($id_biaya, $tukar, $tanggal_awal, $kelompok){
		set_time_limit(0);
		$tanggal_awal_tahun =  date("Y-01-01", strtotime($tanggal_awal));
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("SUM(debet) as saldo_debet, SUM(kredit) as saldo_kredit,",false);
		$this->db->where('a.id_biaya',$id_biaya);
		$this->db->where('a.tanggal <',$tanggal_awal);
		if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
			$this->db->where('a.tanggal >=',$tanggal_awal_tahun);
		}
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_detail a');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($tukar == '1'){$data += $r['saldo_debet'];}
				else{$data += $r['saldo_kredit'];}
			}
		}
		$q->free_result();
		return $data;
	}
	
	function balance_period_debet($id_biaya, $tukar, $tanggal_awal, $tanggal_akhir){
		set_time_limit(0);
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("coalesce(b.saldo, 0.00) as saldo",false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '".$branch."'", 'left');
		$this->db->where("a.id", $id_biaya);
		$this->db->where('b.tanggal >=',$tanggal_awal);
		$this->db->where('b.tanggal <=',$tanggal_akhir);
		$this->db->group_by('a.id');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data += $r['saldo'];
			}
		}
		$q->free_result();
		
		$this->db->select("SUM(debet) as saldo_debet, SUM(kredit) as saldo_kredit,",false);
		$this->db->where('a.id_biaya',$id_biaya);
		$this->db->where('a.tanggal >=',$tanggal_awal);
		$this->db->where('a.tanggal <=',$tanggal_akhir);
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_detail a');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($tukar == '1'){$data += $r['saldo_kredit'];}
				else{$data += $r['saldo_debet'];}
			}
		}
		$q->free_result();
		return $data;
	}
	
	function balance_period_kredit($id_biaya, $tukar, $tanggal_awal, $tanggal_akhir){
		set_time_limit(0);
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("SUM(debet) as saldo_debet, SUM(kredit) as saldo_kredit,",false);
		$this->db->where('a.id_biaya',$id_biaya);
		$this->db->where('a.tanggal >=',$tanggal_awal);
		$this->db->where('a.tanggal <=',$tanggal_akhir);
		$this->db->from('finance_coa_general_ledger_detail a');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($tukar == '1'){$data += $r['saldo_debet'];}
				else{$data += $r['saldo_kredit'];}
			}
		}
		$q->free_result();
		return $data;
	}
	
}
