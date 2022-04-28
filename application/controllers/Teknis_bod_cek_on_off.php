<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teknis_bod_cek_on_off extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_teknis_bod_cek_on_off', 'teknis_bod_cek_on_off');
	}

	public function index()
	{}
	
	public function tes_send_mail(){
		$this->teknis_bod_cek_on_off->tes_send_mail();
	}
	
	public function cek_email_on()
	{				
		$this->teknis_bod_cek_on_off->cek_email_on();
	}
	
	public function cek_email_off()
	{
		$this->teknis_bod_cek_on_off->cek_email_off();
	}
	
	public function curl_cid_jogja()
	{
		$table_replace = '';
		$table_structure = '';
		$table_record = '';
		$q = $this->db->query("DESCRIBE gmd_customer_group");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$table_replace .= ($table_replace != '')?',`'.$r['Field'].'`':'`'.$r['Field'].'`';
				$table_structure .= ($table_structure != '')?','.$r['Field'].' '.$r['Type']:$r['Field'].' '.$r['Type'];
			}
			$qd = $this->db->query("select * from gmd_customer_group");
			if($qd->num_rows() > 0){
				$data = '';
				foreach($qd->result_array() as $rk => $rd){
					$data .= ($rk != 0)?',(':'(';
					$data_r = '';
					foreach($q->result_array() as $r){
						$data_rd = str_replace("'", "", $rd[$r['Field']]);
						$data_r .= ($data_r != '')?",'".$data_rd."'":"'".$data_rd."'";
					}
					$data .= $data_r;
					$data .= ')';
				}
				$table_record .= "REPLACE INTO gmd_customer_group_jogja
				(".$table_replace.")
				VALUES ".$data.";";
			}
			$qd->free_result();
		}
		$q->free_result();
		
		
		
		$ch = curl_init();
		$post_data = array('table_structure' => $table_structure, 'table_record' => $table_record);
		//curl_setopt($ch, CURLOPT_URL, "http://localhost/gmedia/gtech/home/rcv_curl_cid" );
		curl_setopt($ch, CURLOPT_URL, "http://gtech.gmedia.id/home/rcv_curl_cid" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));     		
		$output = curl_exec($ch);
		if ($output === FALSE) {
		  echo "cURL Error: " . curl_error($ch);
		}
		curl_close($ch);
		echo $output;
	}
	
	public function curl_sid_jogja()
	{
		$table_record = '';
			$qd = $this->db->query("select * from gmd_customer");
			if($qd->num_rows() > 0){
				$data = '';
				foreach($qd->result_array() as $rk => $rd){
					$data .= ($rk != 0)?',(':'(';
					$data .= "'".str_replace("'", "", $rd['id'])."'";
					$data .= ",'".str_replace("'", "", str_replace(" ", "", $rd['group_id']))."'";
					$data .= ",'".str_replace("'", "", str_replace(" ", "", $rd['customer_id']))."'";
					$data .= ",'".str_replace("'", "", str_replace(" ", "", $rd['service_id']))."'";
					$data .= ",'".str_replace("'", "", $rd['customer_name'])."'";
					$data .= ",'".str_replace("'", "", $rd['customer_address'])."'";
					$data .= ')';
				}
				$table_record .= "REPLACE INTO gmd_customer_jogja
				(`id`,`group_id`,`customer_id`,`service_id`,`customer_name`,`customer_address`)
				VALUES ".$data.";";
			}
			$qd->free_result();
		
		
		$ch = curl_init();
		$post_data = array('table_record' => $table_record);
		//curl_setopt($ch, CURLOPT_URL, "http://localhost/gmedia/gtech/home/rcv_curl_sid" );
		curl_setopt($ch, CURLOPT_URL, "http://gtech.gmedia.id/home/rcv_curl_sid" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));     		
		$output = curl_exec($ch);
		if ($output === FALSE) {
		  echo "cURL Error: " . curl_error($ch);
		}
		curl_close($ch);
		echo $output;
	}
	
	public function curl_inv_jogja()
	{
		$table_record = '';
			$qd = $this->db->query("select * from gmd_finance_invoice_customer");
			if($qd->num_rows() > 0){
				$data = '';
				foreach($qd->result_array() as $rk => $rd){
					$data .= ($rk != 0)?',(':'(';
					$data .= "'".str_replace("'", "", $rd['id'])."'";
					$data .= ",'".str_replace("'", "", str_replace(" ", "", $rd['no_invoice']))."'";
					$data .= ",'".str_replace("'", "", str_replace(" ", "", $rd['date_invoice']))."'";
					$data .= ",'".str_replace("'", "", str_replace(" ", "", $rd['service_id']))."'";
					$data .= ",'".str_replace("'", "", $rd['lunas'])."'";
					$data .= ')';
				}
				$table_record .= "REPLACE INTO gmd_finance_invoice_customer_jogja
				(`id`,`no_invoice`,`date_invoice`,`service_id`,`lunas`)
				VALUES ".$data.";";
			}
			$qd->free_result();
		
		
		$ch = curl_init();
		$post_data = array('table_record' => $table_record);
		//curl_setopt($ch, CURLOPT_URL, "http://localhost/gmedia/gtech/home/rcv_curl_inv_jogja" );
		curl_setopt($ch, CURLOPT_URL, "http://gtech.gmedia.id/home/rcv_curl_inv_jogja" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));     		
		$output = curl_exec($ch);
		if ($output === FALSE) {
		  echo "cURL Error: " . curl_error($ch);
		}
		curl_close($ch);
		echo $output;
	}
	
	public function curl_sid_jogja1()
	{
		$table_replace = '';
		$table_structure = '';
		$table_record = '';
		$q = $this->db->query("DESCRIBE gmd_customer");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$table_replace .= ($table_replace != '')?',`'.$r['Field'].'`':'`'.$r['Field'].'`';
				$table_structure .= ($table_structure != '')?','.$r['Field'].' '.$r['Type']:$r['Field'].' '.$r['Type'];
			}
			$qd = $this->db->query("select * from gmd_customer");
			if($qd->num_rows() > 0){
				$data = '';
				foreach($qd->result_array() as $rk => $rd){
					$data .= ($rk != 0)?',(':'(';
					$data_r = '';
					foreach($q->result_array() as $r){
						$data_rd = str_replace("'", "", $rd[$r['Field']]);
						$data_r .= ($data_r != '')?",'".$data_rd."'":"'".$data_rd."'";
					}
					$data .= $data_r;
					$data .= ')';
				}
				$table_record .= "REPLACE INTO gmd_customer_jogja
				(".$table_replace.")
				VALUES ".$data.";";
			}
			$qd->free_result();
		}
		$q->free_result();
		
		
		
		$ch = curl_init();
		$post_data = array('table_structure' => $table_structure, 'table_record' => $table_record);
		//curl_setopt($ch, CURLOPT_URL, "http://localhost/gmedia/gtech/home/rcv_curl_sid" );
		curl_setopt($ch, CURLOPT_URL, "http://gtech.gmedia.id/home/rcv_curl_sid" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));     		
		$output = curl_exec($ch);
		if ($output === FALSE) {
		  echo "cURL Error: " . curl_error($ch);
		}
		curl_close($ch);
		echo $output;
	}
	
}
