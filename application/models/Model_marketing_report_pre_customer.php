<?php
class Model_marketing_report_pre_customer extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.date_post', 'c.name', 'a.customer_name', 'a.customer_address'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'id';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS DATE_FORMAT(a.date_post, '%d/%m/%Y') AS tanggal, a.customer_name, a.customer_address, c.name", false);
        $this->db->from('customer a');
		$this->db->join('regional b','a.area = b.code','left');
		$this->db->join('users c','a.id_user = c.id','left');
		$this->db->where("(a.date_post between '".$this->input->post('searchDateTransFirst')." 00:00:00' and '".$this->input->post('searchDateTransFinish')." 23:59:59')", NULL, FALSE);
		$this->db->where('b.id',$this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		if($this->input->post('search_marketing') != '0'){
			$this->db->where('a.id_user',$this->input->post('search_marketing'));
		}
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.date_post', 'ASC');
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$row  = array(
								$no.'.',
								$r['tanggal'],
								$r['name'],
								$r['customer_name'],
								$r['customer_address'],
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
	
}
