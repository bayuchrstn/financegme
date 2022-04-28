<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bts extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_bts', 'bts');
		$this->lang->load('bts');
		$this->active_root_menu = $this->lang->line('bts_alltitle');
		$this->browser_title = $this->lang->line('bts_alltitle');
		$this->modul_name = $this->lang->line('bts_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('bts_alltitle') => '#');
		$data = array();

		$this->js_inject .= $this->load->view('bts/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('bts/js', $data, TRUE);
		$this->js_inject .= $this->load->view('bts/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');

		$this->js_inject = '<script type="text/javascript">'.minify_js($this->js_inject).'</script>';

		$data['update_view'] = $this->load->view('bts/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('bts/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('bts/delete', $data, TRUE);

		$konten = $this->load->view('bts/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		// $options = array();
		// $options['server_side_validation'] = 'bts_insert';
		// $options['table'] = 'bts';
		// $options['data'] = array(
		// 		'bts_name'			=> ($this->input->post('bts_name')) ? htmlspecialchars($this->input->post('bts_name')) : '',
		// 		'bts_address'		=> ($this->input->post('bts_address')) ? htmlspecialchars($this->input->post('bts_address')) : '',
		// 		'bts_note'			=> ($this->input->post('bts_note')) ? htmlspecialchars($this->input->post('bts_note')) : ''
		// 	);
		// $options['msg_success'] = $this->lang->line('bts_success_insert');
		// $options['msg_failed'] = $this->lang->line('bts_failed_insert');
		// $this->frame->insert($options);
		$arr = array();
		$params = array();
		$params['regional'] = session_scope_regional();
		$params['area'] = session_scope_area();
		$this->crud->insert('bts', $params, array('id'));
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);

	}

	public function update($id='')
	{
		valid_action('bts');
		ajax_only();
		if(!$this->form_validation->run('bts_update')):
			$detail = $this->bts->detail($id);
			$arr = array();
			$arr['action'] = base_url().'bts/update/'.$detail['id'];
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
					'bts_name'			=> htmlspecialchars($this->input->post('bts_name')),
					'bts_address'		=> htmlspecialchars($this->input->post('bts_address')),
					'bts_note'			=> htmlspecialchars($this->input->post('bts_note'))
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('bts', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = "data berhasil disimpan";
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->bts->detail($id);
		if($this->form_validation->run('bts_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('bts');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['bts_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'bts/delete/'.$detail['id'];
			$related = $this->related->bts($detail['id']);
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
				'BTS Name'		=> $detail['bts_name'],
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data()
	{
		$product = $this->bts->all();

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_bts(\''.$row['id'].'\');" class="edit_button" ');
				// $hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_bts(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				$arr['data'][] = array(
						'x',
						clean_string($row['bts_name'], 40),
						clean_string($row['bts_address'], 140),
						clean_string($row['bts_note'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

	function test_json()
	{
		$id = 36;
		$detail = $this->bts->detail($id);
		echo json_encode($detail);
	}

}
