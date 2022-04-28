<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_product', 'product');
		$this->lang->load('product');
		$this->active_root_menu = $this->lang->line('product_alltitle');
		$this->browser_title = $this->lang->line('product_alltitle');
		$this->modul_name = $this->lang->line('product_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		valid_action('product');
		$this->breadcrumb = array(
				$this->lang->line('product_alltitle')	=> '#',
			);
		$data = array();

		$this->js_inject .= $this->load->view('product/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('product/js', $data, TRUE);
		$this->js_inject .= $this->load->view('product/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		// $this->js_include .= $this->ui->js_include('chosen');
		// $this->css_include .= $this->ui->load_css('chosen');

		$data['update_view'] = $this->load->view('product/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('product/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('product/delete', $data, TRUE);

		$konten = $this->load->view('product/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		ajax_only();
		$arr_msg = array();

		if($this->form_validation->run('product_insert')):
			$param = array();
			if($this->input->post('flag_fixprice')):
				$param['flag_fixprice'] = 'Y';
				// $param['price'] = paranoid($this->input->post('price'));
			else:
				$param['flag_fixprice'] = 'N';
				// $param['price'] = '';
			endif;

			if($this->input->post('flag_internet_service')):
				$param['flag_internet_service'] = 'Y';
			else:
				$param['flag_internet_service'] = 'N';
			endif;

			$this->product->insert($param);
			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('product_success_insert');
			// $arr_msg['last_query'] = $this->db->last_query();
		else:
			$arr_msg['status'] = 'gagal';
			$arr_msg['msg'] = $this->lang->line('product_fail_insert');
		endif;

		$arr_msg['datapost'] = $_POST;

		$response = json_encode($arr_msg);
		echo $response;
	}

	public function update($id='')
	{
		valid_action('product');
		ajax_only();
		if(!$this->form_validation->run('product_update')):
			$detail = $this->product->detail($id);
			$arr = array();
			$arr['action'] = base_url().'product/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					if($field=='price'):
						$arr[$field] = currency($val);
					else:
						$arr[$field] = $val;
					endif;
				endforeach;
			endif;
			echo json_encode($arr);
		else:
			$arr_msg = array();

			$param = array();
			if($this->input->post('flag_fixprice')):
				$param['flag_fixprice'] = 'Y';
				// $param['price'] = paranoid($this->input->post('price'));
			else:
				$param['flag_fixprice'] = 'N';
				// $param['price'] = '';
			endif;

			if($this->input->post('flag_internet_service')):
				$param['flag_internet_service'] = 'Y';
			else:
				$param['flag_internet_service'] = 'N';
			endif;

			$this->product->update($param);
			$arr_msg['status'] = 'success';
			$arr_msg['last_query'] = $this->db->last_query();
			$arr_msg['msg'] = $this->lang->line('product_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->product->detail($id);
		if($this->form_validation->run('product_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('product');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'product/delete/'.$detail['id'];
			$related = $this->related->product($detail['code']);
			$arr['data_info'] = $this->data_info($detail);
			$arr['removable'] = (!$related) ? 'yes' : 'no';
			$arr['remove_confirm'] = (!$related) ? $this->lang->line('dialog_confirm_delete') : $this->lang->line('dialog_no_delete');
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		endif;
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				'product Name'		=> $detail['name'],
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($category)
	{
		$product = $this->product->all($category);

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_product(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_product(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);
				$price = ($row['flag_fixprice']=='Y') ? currency($row['price']) : '';

				if($row['flag_fixprice']=='Y'){
					$flag_fixprice = 'Fix Price '.$price;
				} else {
					$flag_fixprice = $price;
				}

				if($row['flag_internet_service']=='Y'){
					$flag_internet_service = '<span class="label label-success">Y</span>';
				} else {
					$flag_internet_service = '<span class="label label-warning">N</span>';
				}

				$arr['data'][] = array(
						'x',
						clean_string($row['name'], 40),
						clean_string($row['note'], 100),
						$price,
						$flag_internet_service,
						$action,
						$row['sort']
					);
			endforeach;
		endif;
		// pre($arr);

		$ret = json_encode($arr);
		echo $ret;
	}

	function show_product_by_category($category)
	{
		$data['products'] = $this->product->show_by_category($category);
		echo $this->load->view('product/show_product_by_category', $data, TRUE);
	}

	function picker()
	{
		echo $this->load->view('customer_product_picker/selector', '', TRUE);
	}

}
