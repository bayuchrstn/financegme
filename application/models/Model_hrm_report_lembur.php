<?php
class Model_hrm_report_lembur extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'b.name', 'start', 'finish', 'a.difftime'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'id';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS b.name, IF(a.red = 1, a.red_date, a.start) AS `start`, IF(a.red = 1, a.red_date, a.finish) AS `finish`, IF(
    a.red = 1, '24:00:00', TIMEDIFF(a.finish, a.start)) AS difftime", false);
        $this->db->from('gmd_overtime a');
		$this->db->join('gmd_users b','a.author = b.id','left');
		$this->db->where("((a.date_overtime between '".$this->input->post('searchDateTransFirst')." 00:00:00' and '".$this->input->post('searchDateTransFinish')." 23:59:59') OR 
		(a.red_date between '".$this->input->post('searchDateTransFirst')."' and '".$this->input->post('searchDateTransFinish')."'))", NULL, FALSE);
		$this->db->where("a.approved_date IS NOT NULL", NULL, FALSE);
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.date_overtime', 'ASC');
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
								$r['start'],
								$r['finish'],
								$r['name'],
								$r['difftime'],
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
