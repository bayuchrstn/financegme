<?php
class Model_finance_invoice_kategori extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$page = ($this->input->post('page')) ? $this->input->post('page') : 1;
		$rp = ($this->input->post('rp')) ? $this->input->post('rp') : 10;
		$sortname = ($this->input->post('sortname')) ? $this->input->post('sortname') : 'a.id';
		$sortorder = ($this->input->post('sortorder')) ? $this->input->post('sortorder') : 'asc';
		
		header("Content-type: application/json");
		$jsonData = array('page'=>$page,'total'=>0,'rows'=>array());
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*", false);
		$this->db->where("(a.nama like '%".$this->input->post('searchKeyword')."%')", NULL, FALSE);
		$this->db->order_by($sortname, $sortorder);
		$q = $this->db->get('finance_invoice_kategori a', $rp, (($page-1)*$rp));
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$no = (($page-1)*$rp);
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$entry  = array('id' =>$r['id'],
								'cell'=>array(
									'no' => $no.'.',
									'a.nama' => $r['nama'],
									'edit' => '<a href="#" onclick="update_data(\''.$r['id'].'\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> <a href="#" onclick="delete_data(\''.$r['id'].'\')"><i class="icon-trash text-danger"></i></a>',
									)
								);
				$jsonData['rows'][] = $entry;
			}
		}
		$q->free_result();
		$jsonData['total'] = $n;
		echo json_encode($jsonData); 
	}
	 
	function insert(){
		$data = array( 
					'nama' => $this->input->post('nama'),
				);
		$result=$this->db->insert('finance_invoice_kategori', $data);	
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
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("finance_invoice_kategori");
		return $q->result();
	}
	 
	function update(){
		$data = array( 
					'nama' => $this->input->post('nama'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_invoice_kategori', $data);	
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
		$result=$this->db->delete('finance_invoice_kategori');
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

}
