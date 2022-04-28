<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('master');
		$this->active_root_menu = 'Data Master';
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index($category='')
	{
		valid_action($category);
		$this->js_include .= '<script type="text/javascript" src="'.base_url().'assets/js/datatables/extensions/row_reorder.min.js"></script>';

		$modul = $this->master->master_valid_modul($category);
		if(empty($modul)):
			show_404();
			exit;
		endif;

		$data['category'] = $modul['code'];
		$data['master_name'] = $modul['name'];

		$this->breadcrumb = array(
				'Dashboard'	=> base_url(),
				$data['master_name']	=> '#',
			);

		$this->set_shortcut($data['master_name']);
		$this->browser_title = $data['master_name'];
		$this->modul_name = $data['master_name'];

		$data['view_insert'] = $this->load->view('master/insert', $data, TRUE);
		$data['view_update'] = $this->load->view('master/update', $data, TRUE);
		$data['view_delete'] = $this->load->view('master/delete', $data, TRUE);

		$this->js_inject .= $this->load->view('master/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('master/js', $data, TRUE);
		$this->js_inject .= $this->load->view('master/valid', $data, TRUE);

		$konten = $this->load->view('master/index', $data, TRUE);
		$this->admin_view($konten);

	}

	public function data($category='')
	{
		$master = $this->master->master_by_category($category);
		// pre($this->db->last_query());
		// pre($master);

		$arr = array();
		$arr['data'] = array();
		if(!empty($master)):
			$urut = 0;
			foreach($master as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_master(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_master(\''.$row['id'].'\');" ');
		        $action = $this->actionform->dropdown($hidden_form);

		        switch ($category) {
		        	case 'trial_questions':
		        	case 'ticket_questions':
		        		$arr['data'][] = array(
							'urut'	=> $urut,
							'id'	=> $row['id'],
							'name' => $row['name'],
							'note'	=> $row['note'],
							'action' => $action,
						);
		        		break;
		        	
		        	default:
		        		$arr['data'][] = array(
							'x',
							$row['name'],
							$action,
						);
		        		break;
		        }
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;

	}

	function reorder()
	{
		$dt = $this->input->post('dt');
		$fix_data = substr($dt, 0, strlen($dt)-1);
		$data = explode(',', $fix_data);
		if(!empty($data)):
			foreach($data as $row):
				$part = explode(':', $row);
				// pre($part);
				// pre($row);
				$sql = "UPDATE {PRE}master SET `order`='".$part[1]."' WHERE id='".$part[0]."' ";
				$this->db->query($sql);
				pre($this->db->last_query());
			endforeach;
		endif;
	}

	function insert()
	{
		ajax_only();
		if($this->form_validation->run('master_insert')):
			$arr_msg = array();
			$code = ($this->input->post('code')) ? $this->input->post('code') : code_generator();

			$data = array(
				'code'				=> $code,
				'name'				=> htmlspecialchars($this->input->post('name')),
				'category'			=> $this->input->post('category'),
				'note'	=> $this->input->post('note') ? $this->input->post('note') : '',
				'category_name'		=> $this->input->post('category_name')
			);
			// pre($data);
			$this->db->insert('master', $data);

			$arr_msg['status'] = 'sukses';
			$arr_msg['datapost'] = $_POST;
			$arr_msg['data'] = $data;
			$arr_msg['msg'] = 'New '.$this->input->post('category').' '.$this->lang->line('dialog_insert_success');

			$response = json_encode($arr_msg);
			echo $response;
		endif;
	}

	function set_shortcut($master_name)
	{
		$fa = '<a onclick="input_master();" href="javascript:void(0);" class="btn btn-labeled btn-labeled-right bg-blue heading-btn legitRipple">Input '.$master_name.' <b><i class="icon-plus3"></i></b></a>';
		$this->feature_action =  $fa;
	}

	function update($id)
	{
		if($this->form_validation->run('master_update')):
			$data = array(
					'name' => htmlspecialchars($this->input->post('name')),
					'note'	=> $this->input->post('note') ? $this->input->post('note') : '',
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('master', $data);

			$arr_msg['status'] = 'sukses';
			$arr_msg['datapost'] = $_POST;
			$arr_msg['data'] = $data;
			$arr_msg['msg'] = $this->input->post('category_name').' '.$this->lang->line('dialog_update_success');

			$response = json_encode($arr_msg);
			echo $response;
		else:
			$detail = $this->master->detail($id);
			$arr = array();
			$arr['action'] = base_url().'master/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		endif;

	}

	function delete($id='')
	{
		ajax_only();
		$detail = $this->master->detail($id);
		if($this->form_validation->run('master_delete')):
			$arr_msg = array();
			$related = $this->related->master($detail['code'], $detail['category']);
			if($related):
				$arr_msg['status'] = 'failed';
				$arr_msg['msg'] = $this->lang->line('dialog_delete_failed');
				echo json_encode($arr_msg);
				exit;
			endif;
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('master');
			$arr_msg['status'] = 'success';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['category_name'].' '.$detail['name'].' '.$this->lang->line('dialog_delete_success');
			echo json_encode($arr_msg);
		else:
			$arr = array();
			$arr['data_info'] = $this->data_info($detail);
			$arr['action'] = base_url().'master/delete/'.$detail['id'];
			$related = $this->related->master($detail['code'], $detail['category']);
			$arr['removable'] = (!$related) ? 'yes' : 'no';
			$arr['remove_confirm'] = (!$related) ? $this->lang->line('dialog_confirm_delete') : $this->lang->line('dialog_no_delete');
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		endif;
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '80';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				$detail['category_name']		=> $detail['name'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}
}
