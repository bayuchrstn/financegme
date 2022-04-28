<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_product_category', 'product_category');
		$this->lang->load('product_category');
		$this->active_root_menu = $this->lang->line('product_category_alltitle');
		$this->browser_title = $this->lang->line('product_category_alltitle');
		$this->modul_name = $this->lang->line('product_category_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		valid_action('product_category');
		$this->breadcrumb = array(
				$this->lang->line('product_category_alltitle')	=> '#',
			);
		$data = array();

		$this->js_inject .= $this->load->view('product_category/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('product_category/js', $data, TRUE);
		$this->js_inject .= $this->load->view('product_category/valid', $data, TRUE);

		$data['update_view'] = $this->load->view('product_category/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('product_category/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('product_category/delete', $data, TRUE);

		$konten = $this->load->view('product_category/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		ajax_only();
		$arr_msg = array();

		if($this->form_validation->run('product_category_insert')):
			$param = array();
			$param['code'] = code_generator();
			$this->product_category->insert($param);
			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('product_category_success_insert');
			// $arr_msg['last_query'] = $this->db->last_query();
		else:
			$arr_msg['status'] = 'gagal';
			$arr_msg['msg'] = $this->lang->line('product_category_fail_insert');
		endif;

		$arr_msg['datapost'] = $_POST;

		$response = json_encode($arr_msg);
		echo $response;
	}

	public function update($id='')
	{
		valid_action('product_category');
		// ajax_only();
		if(!$this->form_validation->run('product_category_update')):
			$detail = $this->product_category->detail($id);
			$arr = array();
			$arr['action'] = base_url().'product_category/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					if($field=='price'):
						$arr[$field] = currency($val);
					else:
						$arr[$field] = $val;
					endif;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			$arr_msg = array();
			$this->crud->update('product_category', array(), array('id'));
			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('product_category_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->product_category->detail($id);
		// pre($detail); exit;

		if($this->form_validation->run('product_category_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$result_dba = $this->db->delete('product_category');
			$arr_msg['status'] = ($result_dba) ? 'success' : 'failed';
			// $arr_msg['result_dba'] = $result_dba;
			$arr_msg['msg'] = ($result_dba) ? 'Data berhasil dihapus' : 'Data gagal dihapus';
			echo json_encode($arr_msg);
		else:
			// ajax_only();
			$arr = array();
			$arr['action'] = base_url().'product_category/delete/'.$detail['id'];
			$arr['data_info'] = 'Kategori Produk : '.$detail['name'];

			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		endif;
	}

	// function data_info($detail)
	// {
	// 	$data = array();
	// 	$data['label_width'] = '100';
	// 	$data['sparator_width'] = '10';
	// 	$data['info'] = array(
	// 			'product_category Name'		=> $detail['name'],
	// 			// 'Email'		=> $detail['email'],
	// 		);
	// 	$opt = $this->ui->load_template('table_data_info', $data);
	// 	return $opt;
	// }

	public function data()
	{
		$product_category = $this->product_category->all();

		$arr = array();
		$arr['data'] = array();
		if(!empty($product_category)):
			$urut = 0;
			foreach($product_category as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_product_category(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_product_category(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);


				$arr['data'][] = array(
						'x',
						clean_string($row['name'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);

		$ret = json_encode($arr);
		echo $ret;
	}

	function show_product_category_by_category($category)
	{

		$data['product_categorys'] = $this->product_category->show_by_category($category);
		echo $this->load->view('product_category/show_product_category_by_category', $data, TRUE);
	}

}
