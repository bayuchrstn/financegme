<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance_transaksi_task_other extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_finance_transaksi_task_other', 'finance_transaksi_task_other');
		$this->lang->load('finance_transaksi_task_other');
		$this->active_root_menu = $this->lang->line('finance_transaksi_task_other_alltitle');
		$this->browser_title = $this->lang->line('finance_transaksi_task_other_alltitle');
		$this->modul_name = $this->lang->line('finance_transaksi_task_other_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),$this->lang->line('finance_transaksi_task_other_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_transaksi_task_other/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_transaksi_task_other/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_transaksi_task_other/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('custom_page');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_transaksi_task_other_alltitle');
		//$data['update_view'] = $this->load->view('finance_transaksi_task_other/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('finance_transaksi_task_other/form', $data, TRUE);
		//$data['delete_view'] = $this->load->view('finance_transaksi_task_other/delete', $data, TRUE);

		$konten = $this->load->view('finance_transaksi_task_other/index', $data, TRUE);
		$this->admin_view($konten);
	}
	
	public function get_data_table()
	{
		$this->finance_transaksi_task_other->get_data_table();
	}
	
	public function insert_data()
	{
		echo $this->finance_transaksi_task_other->insert();
	}
	
	public function select_data()
	{
		echo json_encode($this->finance_transaksi_task_other->select());
	}
	
	public function edit_data()
	{
		echo $this->finance_transaksi_task_other->update();
	}
	
	public function delete_data()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_transaksi_task_other->delete($id);
	}
	
	public function get_karyawan()
	{
		$id = $this->uri->segment(3);
		echo $this->finance_transaksi_task_other->get_karyawan($id);
	}
	
	public function save_dropbox()
	{
		echo $this->finance_transaksi_task_other->save_dropbox();
	}
	
	public function upload_dropbox()
	{
		$token = 'fp63YFaxx9AAAAAAAAAAHT8R_v1X9SBQOgSBIggU2wSMg4PrhCUe8LTc-8MCQcLi';
		
		if (!$_FILES) {
		  exit();
		}
		
		$filename = date('YmdHis').'_'.$_FILES['kwitansi_file']['name'];
		$filepath = $_FILES['kwitansi_file']['tmp_name'];
		$folder_path = '/taskother/'.date('Ym');
		// print_r($_FILES['file_gambar']);
		
		/*curl upload*/
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://content.dropboxapi.com/2/files/upload",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => file_get_contents($filepath),
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$token,
			"content-type: application/octet-stream",
			"dropbox-api-arg: {\"path\": \"".$folder_path."/".$filename."\",\"mode\": \"add\",\"autorename\": true,\"mute\": false}"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		  exit();
		}
		
		$decode_response = json_decode($response,true);
		$id = $decode_response['id'];
		$path = $decode_response['path_lower'];
		
		/*curl shorten url*/
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.dropboxapi.com/2/sharing/create_shared_link",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\"path\": \"".$path."\",    \"short_url\": true}",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$token,
			"content-type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		  exit();
		} 
		
		$decode_response = json_decode($response, true);
		header("Content-Type: application/json");
		echo json_encode($decode_response);
	}
	
	public function get_thumbnail_dropbox()
	{
		$token = 'fp63YFaxx9AAAAAAAAAAHT8R_v1X9SBQOgSBIggU2wSMg4PrhCUe8LTc-8MCQcLi';
		$path = $_POST['path'];
		
		/* get thumbnail */
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://content.dropboxapi.com/2/files/get_thumbnail",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$token,
			"content-type: text/plain",
			"dropbox-api-arg: {\"path\": \"".$path."\",\"format\": \"jpeg\",\"size\": \"w128h128\",\"mode\": \"bestfit\"}"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo 'data:image/jpg;charset=utf8;base64,'.base64_encode($response);
		}
	}
	
	public function delete_dropbox()
	{
		$token = 'fp63YFaxx9AAAAAAAAAAHT8R_v1X9SBQOgSBIggU2wSMg4PrhCUe8LTc-8MCQcLi';
		$path = $_POST['path'];
		/*Delete file*/
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.dropboxapi.com/2/files/delete_v2",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\"path\": \"".$path."\"}",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$token,
			"content-type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}
	
}
