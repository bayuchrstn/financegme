<?php
class Model_finance_accounting_report_ald extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }
	
	function saldo1($id_biaya, $tukar, $tanggal_akhir){
		set_time_limit(0);
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("coalesce(b.saldo, 0.00) as saldo",false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '".$branch."'", 'left');
		$this->db->where("a.id", $id_biaya);
		$this->db->where('b.tanggal <=',$tanggal_akhir);
		$this->db->group_by('a.id');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data += $r['saldo'];
			}
		}
		
		$this->db->select("SUM(debet) as saldo_debet, SUM(kredit) as saldo_kredit,",false);
		$this->db->where('a.id_biaya',$id_biaya);
		$this->db->where('a.bulan <=',$tanggal_akhir);
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_monthly a');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($tukar == '1'){$data += $r['saldo_kredit'] - $r['saldo_debet'];}
				else{$data += $r['saldo_debet'] - $r['saldo_kredit'];}
			}
		}
		return $data;
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
		
		return $data;
	}
	
	
	function akun_label($sub, $data, $tanggal_awal, $tanggal_akhir, $parent = 0, $total = 0)
	{
		set_time_limit(0);
		$tanggal_awal_tahun =  date("Y-01-01", strtotime($tanggal_akhir));
		$page_uri = base_url().'finance_accounting_report_als/index/';
		$searchform = $tanggal_awal.'/'.$tanggal_akhir;
		$f_label = $sub * 40;
		foreach($data as $r){
			if($r['parent'] == $parent){
				$saldo = $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $r['id']);
				$saldo += $this->saldo($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir, $r['kelompok'], $r['re'], $r['cye']);
				
				if($r['parent'] == 0 && $r['tukar'] == 0){
					$total -= $saldo;
				}elseif($r['parent'] == 0 && $r['tukar'] == 1){
					$total += $saldo;
				}
				$this->akun_label(($sub+1), $data, $tanggal_awal, $tanggal_akhir, $r['id']);
			}
		}
		return $total;
	}
	
	
	function looping_child_label($sub, $data, $searchTanggal, $tanggal_awal, $tanggal_akhir, $parent = 0)
	{
		set_time_limit(0);
		$tanggal_awal_tahun =  date("Y-01-01", strtotime($tanggal_akhir));
		$page_uri = base_url().'finance_accounting_report_als/index/';
		$searchform = $tanggal_awal.'/'.$tanggal_akhir;
		$f_label = $sub * 40;
		foreach($data as $r){
			if($r['parent'] == $parent){
				//$saldo_cummulatif = $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $r['id']);
				//$saldo_cummulatif += $this->saldo($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir, $r['kelompok'], $r['re'], $r['cye']);
				$saldo_cummulatif = $this->saldo($r['id'], $r['tukar'], $searchTanggal, $tanggal_awal, $tanggal_akhir, $r['kelompok'], $r['re'], $r['cye']);
					
				$saldo_cummulatif = ($saldo_cummulatif < 0)?'<span class="text-danger-800">('.str_replace("-", "", number_format($saldo_cummulatif,2)).')</span>':number_format($saldo_cummulatif,2);
				
				$strong = ($r['id'] == $r['kelompok'].'00000' || $this->have_child($r['id']) == true)?' class="text-black"':'';
				$parentnya = ($r['id'] == $r['kelompok'].'00000' || $this->have_child($r['id']) == true)?'Parent':'Detail';
				$drcr = ($r['tukar'] == 1)?'Cr':'Dr';
				echo '<tr'.$strong.'>
				<td class="text-center">'.$r['id'].'</td>
				<td>'.$r['nama'].'</td>
				<td align="right"><a href="'.$page_uri.$r['id'].'/'.$searchform.'" target="blank" class="text-primary-800">'.$saldo_cummulatif.'</a></td>
				<td class="text-center">'.$drcr.'</td>
				<td class="text-center">'.$parentnya.'</td>
				</tr>';
				$this->looping_child_label(($sub+1), $data, $searchTanggal, $tanggal_awal, $tanggal_akhir, $r['id']);
			}
		}
	}
	
	function looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $parent)
	{
		set_time_limit(0);
		$msg = 0.00;
		foreach($data as $r){
			if($r['parent'] == $parent){
				$msg += $this->looping_child_saldo($data, $tanggal_awal, $tanggal_akhir, $r['id']);
				$msg += $this->saldo($r['id'], $r['tukar'], $tanggal_awal, $tanggal_akhir, $r['kelompok'], $r['re'], $r['cye']);
			}
		}
		return $msg;
	}
		
	function saldo($id_biaya, $tukar, $searchTanggal, $tanggal_awal, $tanggal_akhir, $kelompok, $re, $cye){
		set_time_limit(0);
		$tanggal_awal_tahun =  date("Y-01-01", strtotime($tanggal_akhir));
		$branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
		$data = 0.00;
		
		$this->db->select("coalesce(b.saldo, 0.00) as saldo",false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '".$branch."'", 'left');
		$this->db->where("a.id", $id_biaya);
		if($searchTanggal == '3'){
			//$this->db->where('b.tanggal >=',$tanggal_awal);
			$this->db->where('b.tanggal <=',$tanggal_akhir);
			if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
				$this->db->where('b.tanggal >=',$tanggal_awal_tahun);
			}
		}elseif($searchTanggal == '1'){
			$this->db->where('b.tanggal <=',$tanggal_akhir);
			if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
				if($tanggal_awal > $tanggal_awal_tahun){
					$this->db->where('b.tanggal >=',$tanggal_awal);
				}else{
					$this->db->where('b.tanggal >=',$tanggal_awal_tahun);
				}
			}else{
				$this->db->where('b.tanggal >=',$tanggal_awal);
			}
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
		

		if($searchTanggal == '3'){
			//$this->db->where('a.tanggal >=',$tanggal_awal);
			$this->db->where('a.tanggal <=',$tanggal_akhir);
			if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
				$this->db->where('a.tanggal >=',$tanggal_awal_tahun);
			}
		}elseif($searchTanggal == '1'){
			$this->db->where('a.tanggal <=',$tanggal_akhir);
			if($kelompok != '1' && $kelompok != '2' && $kelompok != '3'){
				if($tanggal_awal > $tanggal_awal_tahun){
					$this->db->where('a.tanggal >=',$tanggal_awal);
				}else{
					$this->db->where('a.tanggal >=',$tanggal_awal_tahun);
				}
			}else{
				$this->db->where('a.tanggal >=',$tanggal_awal);
			}
		}		
		
		
		$this->db->where('a.branch', $branch);
		$this->db->from('finance_coa_general_ledger_detail a');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($tukar == '1'){$data += $r['saldo_kredit'] - $r['saldo_debet'];}
				else{$data += $r['saldo_debet'] - $r['saldo_kredit'];}
			}
		}
		$q->free_result();
		//if($re == '1'){$data += $this->re($tanggal_awal_tahun);}
		//if($cye == '1'){$data += $this->cye($tanggal_awal_tahun,$tanggal_akhir);}
		return $data;
	}
	
	
}
