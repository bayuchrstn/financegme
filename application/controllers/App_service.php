<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class app_service extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_global', 'm_global');
		$this->lang->load('finance_customer');
	}

	public function index()
	{
		echo 1;
	}

	public function auth_login_app(){
		$hasil = array();
		if(isset($_POST["gmediaapp_username"]) && isset($_POST["gmediaapp_password"])){
			$username = $_POST["gmediaapp_username"];
			$password = pass_generator($_POST["gmediaapp_password"]);
			//$username = 'sales1';
			//$password = pass_generator('123');
			
			$this->db->select("a.*",false);
			$this->db->from('users AS a');
			$this->db->where('a.username', $username);
			$this->db->where('a.password', $password);
			//$this->db->join('product_category f', 'e.category = f.code', 'left');
			$this->db->limit(1);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				$hasil["status"] = 1;
				foreach($q->result_array() as $r){
					$entry  = array(
										'user_id' => $r['id'],
										'user_full_name' => $r['name'],
										//'position' => $r['position'],
									);
					$hasil['data_user'] = $entry;
					$entry  = array('101','102','103');
					$hasil['data_privilages'] = $entry;
				}
			}else{
				$hasil["status"]= 0;
			}
		}else{
			$hasil["status"]= 2;
		}
		
		echo json_encode($hasil);
	}

	public function marketing_pre_customer(){
		//if(isset($_POST["gmediaapp_user_id"])){
			$hasil = array();
			$user_id = my_id();
			
			$this->db->select("a.*",false);
			$this->db->from('gmd_customer AS a');
			$this->db->where('a.status', 'pre_customer');
			$this->db->where('a.id_user', $user_id);
			//$this->db->join('product_category f', 'e.category = f.code', 'left');
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					array_push($hasil  , array(
										'id' => $r['id'],
										'customer_name' => $r['customer_name'],
										'customer_address' => $r['customer_address'],
										'telephone_home' => $r['telephone_home'],
									));
				}
			}
			echo json_encode(array('data' => $hasil));
		//}
	}

	public function gappcust_product_cat(){
		//if(isset($_POST["gmediaapp_user_id"])){
			$hasil = array();
			//$user_id = my_id();
			
			$this->db->select("a.*",false);
			$this->db->from('product_category AS a');
			$this->db->order_by('a.sort', 'ASC');
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					array_push($hasil  , array(
										'code' => $r['code'],
										'name' => $r['name'],
									));
				}
			}
			echo json_encode(array('data' => $hasil));
		//}
	}

	public function gappcust_product_detail(){
		//if(isset($_POST["gmediaapp_user_id"])){
			$hasil = array();
			//$user_id = my_id();
			
			$this->db->select("a.*,
			  SUBSTR(a.price, 1, (LENGTH(a.price) - 3)) AS price_one,
			  SUBSTR(a.price, -3) AS price_two",false);
			$this->db->from('product AS a');
			$this->db->where('a.category', $_POST["code"]);
			$this->db->order_by('a.sort', 'ASC');
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					array_push($hasil  , array(
										'code' => $r['code'],
										'name' => $r['name'],
										'note' => $r['note'],
										'price' => $r['price'],
										'price_one' => $r['price_one'],
										'price_two' => $r['price_two'],
										'value' => $r['value'],
										'satuan_bandwidth' => $r['satuan_bandwidth'],
									));
				}
			}
			echo json_encode(array('data' => $hasil));
		//}
	}

}
