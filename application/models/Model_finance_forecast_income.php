<?php
class Model_finance_forecast_income extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'b.nama', 'a.deskripsi', 'a.jumlah'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.tanggal';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.nama as nama_type, 
			DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya", false);
        $this->db->from('finance_forecast a');
		$this->db->join('finance_forecast_cat b','a.tipe_detail = b.id','left');
		//$this->db->join('regional c','a.cabang = c.id','left');
		$this->db->group_start();
		$this->db->like('a.deskripsi', $this->input->post('search_keyword'));
		//$this->db->or_like('a.no_seri_faktur', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where('a.tipe','3');
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where("(a.tanggal between '".$this->input->post('searchDateFirst')."' and '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		if($this->input->post('searchtype') != '0'){
			$this->db->where('a.tipe_detail',$this->input->post('searchtype'));
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
				$row  = array(
									$no.'.',
									$r['tanggalnya'],
									$r['nama_type'],
									number_format($r['jumlah'],0),
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
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'tipe' => 3,
					'tanggal' => $this->input->post('tanggal'),
					'deskripsi' => $this->input->post('deskripsi'),
					'tipe_detail' => $this->input->post('tipe_detail'),
					'jumlah' => $jumlah,
					'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
					'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
				);
		$result=$this->db->insert('finance_forecast', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	 
	function select(){
		$this->db->select("a.*, round(a.jumlah) as jumlah", false);
		$this->db->from("finance_forecast a");
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'tanggal' => $this->input->post('tanggal'),
					'deskripsi' => $this->input->post('deskripsi'),
					'tipe_detail' => $this->input->post('tipe_detail'),
					'jumlah' => $jumlah,
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_forecast', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	
	function delete($id)
	{
			$this->db->where('id', $id);
			$result=$this->db->delete('finance_forecast');
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
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
	
}
