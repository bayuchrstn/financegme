<?php
class Model_master_noc_cat_problem extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'name'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'name';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS *", false);
        $this->db->from('master a');
		$this->db->group_start();
		$this->db->like('name', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where('category', 'noc_cat_problem');
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
				$row = array();
				$row[] = $no.'.';
				$row[] = $r['name'];
				$row[] = '<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
	 
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
		$name = trim($this->input->post('name'));
		$code = strtolower($name);
		$code = str_replace(" ", "_", $code);
		
        $this->db->from('master');
		$this->db->where('code', $code);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$msg = 'Nama kategori telah digunakan';
		}else{
			$data = array( 
						'code' => $code,
						'name' => $name,
						'category' => 'noc_cat_problem',
						'category_name' => 'Kategori Masalah NOC',
					);
			$result=$this->db->insert('master', $data);	
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}
		return $msg;
	}
	 
	function select(){
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("master");
		return $q->result();
	}
	 
	function update(){
		$name = trim($this->input->post('name'));
		$code = strtolower($name);
		$code = str_replace(" ", "_", $code);
		
        $this->db->from('master');
		$this->db->where('id !=', $this->input->post('id'));
		$this->db->where('code', $code);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$msg = 'Nama kategori telah digunakan';
		}else{
			$data = array( 
						'code' => $code,
						'name' => $name,
					);
			$this->db->where('id', $this->input->post('id'));
			$result=$this->db->update('master', $data);	
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}
		return $msg;
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$result=$this->db->delete('master');
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
