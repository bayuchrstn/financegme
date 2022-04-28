<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_supplier', 'supplier');
		$this->lang->load('supplier');
		$this->active_root_menu = $this->lang->line('supplier_alltitle');
		$this->browser_title = $this->lang->line('supplier_alltitle');
		$this->modul_name = $this->lang->line('supplier_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		$options = array();
		$options['modul_code'] = 'supplier';
		$this->frame->main_crud($options);
	}

	public function insert()
	{
		$options = array();
		$options['server_side_validation'] = 'supplier_insert';
		$options['table'] = 'supplier';
		$options['data'] = array(
				'supplier_name'			=> ($this->input->post('supplier_name')) ? htmlspecialchars($this->input->post('supplier_name')) : '',
				'supplier_address'		=> ($this->input->post('supplier_address')) ? htmlspecialchars($this->input->post('supplier_address')) : '',
				'supplier_telephone'	=> ($this->input->post('supplier_telephone')) ? htmlspecialchars($this->input->post('supplier_telephone')) : '',
				'regional'				=> my_regional()
			);
		$options['msg_success'] = $this->lang->line('supplier_success_insert');
		$options['msg_failed'] = $this->lang->line('supplier_failed_insert');
		$this->frame->insert($options);
	}

	public function update($id='')
	{
		valid_action('supplier');
		ajax_only();
		if(!$this->form_validation->run('supplier_update')):
			$detail = $this->supplier->detail($id);
			$arr = array();
			$arr['action'] = base_url().'supplier/update/'.$detail['id'];
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
					'supplier_name'			=> htmlspecialchars($this->input->post('supplier_name')),
					'supplier_address'		=> htmlspecialchars($this->input->post('supplier_address')),
					'supplier_telephone'	=> htmlspecialchars($this->input->post('supplier_telephone')),
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('supplier', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('supplier_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->supplier->detail($id);
		if($this->form_validation->run('supplier_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('supplier');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['supplier_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'supplier/delete/'.$detail['id'];
			$related = $this->related->supplier($detail['id']);
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
				'supplier Name'		=> $detail['supplier_name'],
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data()
	{
		$product = $this->supplier->all();

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_supplier(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_supplier(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				$arr['data'][] = array(
						'x',
						clean_string($row['supplier_name'], 40),
						clean_string($row['supplier_address'], 140),
						clean_string($row['supplier_telephone'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

}
