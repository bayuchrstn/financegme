<?php
class Model_finance_transaksi_kasir_out extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'c.nama', 'd.nama', 'a.jumlah', 'b.name', 'a.deskripsi'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.tanggal';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, d.nama as nama_biaya, b.name as nama_kas", false);
        $this->db->from('finance_transaksi_kasir a');
		$this->db->join('finance_bank b','a.kas_bank = b.id','left');
		$this->db->join('finance_master_divisi c','a.divisi_cat = c.id','left');
		$this->db->join('finance_fixcost_cat d','a.fixcost_cat = d.id','left');
		$this->db->group_start();
		$this->db->like('a.deskripsi', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where('a.tipe','0');
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where("(a.tanggal between '".$this->input->post('searchDateFirst')."' and '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		if($this->input->post('searchkas_bank') != '0'){
			$this->db->where('a.kas_bank',$this->input->post('searchkas_bank'));
		}
		$this->db->order_by($order_name, $order_dir);
        if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
				if($r['coa_id'] != '0'){
					$opsi = '';
				}
				$row  = array(
									$no.'.',
									$r['tanggalnya'],
									$r['nama_divisi'],
									$r['nama_biaya'],
									number_format($r['jumlah'],2),
									$r['nama_kas'],
									$r['deskripsi'],
									$opsi,
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
	 
	function insert(){
		$this->db->trans_start();
		if($this->model_global->closing_date_kasir($this->input->post('tanggal')) == true){
			$jumlah = str_replace(",", "", $this->input->post('jumlah'));
			$data = array( 
						'tanggal' => $this->input->post('tanggal'),
						'kas_bank' => $this->input->post('kas_bank'),
						'fixcost_cat' => $this->input->post('fixcost_cat'),
						'tipe' => '0',
						'jumlah' => $jumlah,
						'deskripsi' => $this->input->post('deskripsi'),
						'divisi_cat' => $this->input->post('divisi_cat'),
						//'karyawan' => $this->input->post('karyawan'),
						//'departement' => $this->cek_id_department($this->input->post('departement')),
						'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
						'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
					);
			$result=$this->db->insert('finance_transaksi_kasir', $data);	
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}
	 
	function select(){
		//$this->db->select("a.*, b.code", false);
		//$this->db->where("a.id", $this->input->post('id'));
		//$this->db->join('gmd_master b','b.id = a.departement','left');
		$q = $this->db->query("select a.*, round(a.jumlah) as jumlah from gmd_finance_transaksi_kasir a 
		where a.id = '".$this->input->post('id')."'");
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
		if($this->model_global->closing_date_kasir($this->input->post('tanggal')) == true && $this->model_global->closing_date_kasir($this->select_date($this->input->post('id'))) == true){
			$jumlah = str_replace(",", "", $this->input->post('jumlah'));
			$data = array( 
						'tanggal' => $this->input->post('tanggal'),
						'fixcost_cat' => $this->input->post('fixcost_cat'),
						'kas_bank' => $this->input->post('kas_bank'),
						'jumlah' => $jumlah,
						'deskripsi' => $this->input->post('deskripsi'),
						'divisi_cat' => $this->input->post('divisi_cat'),
						//'karyawan' => $this->input->post('karyawan'),
						//'departement' => $this->cek_id_department($this->input->post('departement')),
					);
			$this->db->where('id', $this->input->post('id'));
			$result=$this->db->update('finance_transaksi_kasir', $data);	
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}
	
	function delete($id)
	{
		$this->db->trans_start();
		if($this->model_global->closing_date_kasir($this->select_date($id)) == true){
			$this->db->where('id', $id);
			$result=$this->db->delete('finance_transaksi_kasir');
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}
	
	function finance_bank(){
		$this->db->group_start();
		$this->db->where('branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->or_where('lock', 1);
		$this->db->group_end();
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('finance_bank');
		return $q;
	}
	
	function departement(){
		$this->db->where('category', 'departement');
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('master');
		return $q;
	}
	
	function cek_id_regional($id){
		$data = 0;
		
		$q = $this->db->query("select id from gmd_regional where code = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	
	function cek_id_department($id){
		$data = 0;
		
		$q = $this->db->query("select id from gmd_master where code = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	
	function get_karyawan($id){
		$data = '<option value=""></option>';
		
		$q = $this->db->query("select id, name from gmd_people where departemen = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<option value="'.$r['id'].'">'.$r['name'].'</option>';
			}
		}
		$q->free_result();
		
		return $data;
	}
	 
	function select_date($id){
		$this->db->select("a.tanggal", false);
		$this->db->from('finance_transaksi_kasir a');
		$this->db->where("a.id", $id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach ($q->result_array() as $r){
				return $r['tanggal'];
			}
		}
		$q->free_result();
	}
	 
}
