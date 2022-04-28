<?php
class Model_finance_request_billing extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'd.date_created', 'c.name', 'a.customer_id', 'a.service_id', 'a.customer_name'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.tanggal';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.id, a.customer_id, a.service_id, 
		DATE_FORMAT(d.date_created, '%d/%m/%Y') AS tanggal, d.subject, a.customer_name, c.name, d.id as id_task", false);
        $this->db->from('customer a');
		$this->db->join('regional b','a.area = b.code','left');
		$this->db->join('users c','a.id_user = c.id','left');
		$this->db->join('task d','a.id = d.location_id','left');
		$this->db->where("(a.customer_id like '%".$this->input->post('search_keyword')."%' OR
		a.service_id like '%".$this->input->post('search_keyword')."%' OR
		a.customer_name like '%".$this->input->post('search_keyword')."%' OR
		c.name like '%".$this->input->post('search_keyword')."%')",NULL, FALSE);
		$this->db->where('b.id',$this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where('d.category','mp_billing');
		$this->db->where('a.status','pre_customer');
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.date_post', 'ASC');
        if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\', \''.$r['id_task'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				$row  = array(
								$no.'.',
								$r['tanggal'],
								$r['name'],
								$r['customer_id'],
								$r['service_id'],
								$r['customer_name'],
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
		$customer_id = strtoupper($this->input->post('customer_id'));
		$customer_id = str_replace(" ", "", $customer_id);
		$this->db->from('finance_request_billing a');
		$this->db->where('customer_id', $customer_id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$msg = 'Customer ID telah digunakan';
		}else{
			$data = array( 
							'customer_id' => $customer_id,
							'nama' => strtoupper($this->input->post('nama')),
							'alamat' => strtoupper($this->input->post('alamat')),
							'telp' => strtoupper($this->input->post('telp')),
							'kategori' => $this->input->post('kategori'),
							//'branch' => $this->m_global->cek_id_regional($this->session->userdata('scope_area')),
					);
			$result=$this->db->insert('finance_request_billing', $data);	
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
		$this->db->select("a.*, CONCAT('<strong>Customer ID</strong> : ', a.customer_id, 
		'<br><strong>Service ID</strong> : ', a.service_id, 
		'<br><strong>Nama Customer</strong> : ', a.customer_name, 
		'<br><strong>Alamat</strong> : ', a.customer_address, 
		'<br><strong>Note</strong> : ', COALESCE((select body from gmd_task where id = '".$this->input->post('id_task')."'),'')) AS detail_customer", false);
		$this->db->from('customer a');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
			$data = array( 
						'customer_id' => $this->input->post('customer_id'),
						'service_id' => $this->input->post('service_id'),
						'status' => $this->input->post('status'),
						'tanggal_billing' => $this->input->post('tanggal_billing'),
					);
			$this->db->where('id', $this->input->post('id'));
			$result=$this->db->update('customer', $data);	
			if($result==true)
			{
				if($this->input->post('status') == 'customer'){
					$data = array( 
								'status' => $this->input->post('status'),
							);
					$this->db->where('customer_id', $this->input->post('customer_id'));
					$this->db->update('gmd_customer_group', $data);	
				}
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		$this->db->trans_complete();
		return $msg;
	}
	
	function delete()
	{
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->delete('finance_request_billing');
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
	
	function cek_child($id){
		$data = 0;
		
		$this->db->from('finance_request_billing_service');
		$this->db->where("customer_id", $id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$data = 1;
		}
				
		return $data;
	}
	 
	 
}
