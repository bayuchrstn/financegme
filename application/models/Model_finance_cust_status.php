<?php
class Model_finance_cust_status extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'c.name', 'a.customer_id', 'a.service_id', 'a.customer_name'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.tanggal';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.id, a.customer_id, a.service_id, a.customer_name, c.name", false);
        $this->db->from('customer a');
		$this->db->join('regional b','a.area = b.code','left');
		$this->db->join('users c','a.id_user = c.id','left');
		$this->db->where("(a.customer_id like '%".$this->input->post('search_keyword')."%' OR
		a.service_id like '%".$this->input->post('search_keyword')."%' OR
		a.customer_name like '%".$this->input->post('search_keyword')."%' OR
		c.name like '%".$this->input->post('search_keyword')."%')",NULL, FALSE);
		if($this->input->post('search_status') == '0'){
			$this->db->where('a.status_active', '0');
		}elseif($this->input->post('search_status') == '1'){
			$this->db->where("(a.status_active = '' OR a.status_active = '1')",NULL, FALSE);
		}
		$this->db->where('b.id',$this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where('a.status','customer');
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
				$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				$row  = array(
								$no.'.',
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
		$this->db->from('finance_cust_status a');
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
			$result=$this->db->insert('finance_cust_status', $data);	
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
		'<br><strong>Alamat</strong> : ', a.customer_address) AS detail_customer,
		IF(a.status_active = 1 OR a.status_active = '', 1, 0) AS status_activenya", false);
		$this->db->from('customer a');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
			$data = array( 
						'status_active' => $this->input->post('status_active'),
						'nonaktif_date' => $this->input->post('nonaktif_date'),
						'nonaktif_reason' => $this->input->post('nonaktif_reason'),
					);
			$this->db->where('id', $this->input->post('id'));
			$result=$this->db->update('customer', $data);	
			if($result==true)
			{
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
		$result=$this->db->delete('finance_cust_status');
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
		
		$this->db->from('finance_cust_status_service');
		$this->db->where("customer_id", $id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$data = 1;
		}
				
		return $data;
	}
	 
	 
}
