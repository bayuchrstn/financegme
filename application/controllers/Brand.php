<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_brand', 'brand');
		$this->lang->load('brand');
		$this->active_root_menu = $this->lang->line('brand_alltitle');
		$this->browser_title = $this->lang->line('brand_alltitle');
		$this->modul_name = $this->lang->line('brand_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('brand_alltitle') => '#');
		// $options = array();
		// $options['modul_code'] = 'brand';
		// $this->frame->main_crud($options);
		$data = array();

		$this->js_inject .= $this->load->view('brand/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('brand/js', $data, TRUE);
		$this->js_inject .= $this->load->view('brand/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');

		$data['update_view'] = $this->load->view('brand/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('brand/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('brand/delete', $data, TRUE);

		$konten = $this->load->view('brand/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		$options = array();
		$options['server_side_validation'] = 'brand_insert';
		$options['table'] = 'item_categories';
		$options['data'] = array(
				'up'				=> '0',
				'item_categories'	=> ($this->input->post('brand_name')) ? htmlspecialchars($this->input->post('brand_name')) : '',
				'code_name'		=> ($this->input->post('brand_code')) ? htmlspecialchars($this->input->post('brand_code')) : '',
				'note'			=> null,
				'satuan'		=> null,
				'order'			=> null
			);
		$options['msg_success'] = $this->lang->line('brand_success_insert');
		$options['msg_failed'] = $this->lang->line('brand_failed_insert');
		// echo json_encode($options);
		$this->frame->insert($options);
	}

	public function update($id='')
	{
		valid_action('brand');
		ajax_only();
		if(!$this->form_validation->run('brand_update')):
			$detail = $this->brand->detail($id);
			$arr = array();
			$arr['action'] = base_url().'brand/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			// cekpost();
			$arr_msg = array();
			$data = array(
					'item_categories'			=> htmlspecialchars($this->input->post('brand_name')),
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('item_categories', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('brand_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->brand->detail($id);
		if($this->form_validation->run('brand_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('item_categories');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['item_categories'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'brand/delete/'.$detail['id'];
			$related = $this->related->brand($detail['id']);
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
				'Nama Brand'		=> $detail['item_categories'],
				'Kode'				=> $detail['code_name']
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data()
	{
		$product = $this->brand->all();

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_brand(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_brand(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				$arr['data'][] = array(
						'x',
						clean_string($row['item_categories'], 40),
						clean_string($row['code_name'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

}
