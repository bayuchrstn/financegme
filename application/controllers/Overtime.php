<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overtime extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_overtime', 'overtime');
		$this->lang->load('overtime');
		$this->active_root_menu = $this->lang->line('overtime_alltitle');
		$this->browser_title = $this->lang->line('overtime_alltitle');
		$this->modul_name = $this->lang->line('overtime_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('overtime_alltitle') => '#');
		$data = array();
		$data['tabs'] = $this->overtime->tabs();

		$this->js_inject .= $this->load->view('overtime/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('overtime/js', $data, TRUE);
		$this->js_inject .= $this->load->view('overtime/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('time_picker');
		$this->css_include .= $this->load->view('overtime/css', $data, TRUE);

		$data['update_view'] = $this->load->view('overtime/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('overtime/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('overtime/delete', $data, TRUE);
		$data['approve_view'] = $this->load->view('overtime/approve', $data, TRUE);
		$data['detail_view'] = $this->load->view('overtime/detail', $data, TRUE);

		$konten = $this->load->view('overtime/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		$options = array();
		$options['server_side_validation'] = 'overtime_insert';
		$options['table'] = 'overtime';
		$options['data'] = array(
				'author'		=> $this->session->userdata('userid'),
				'status'		=> 'request',
				'note'			=> ($this->input->post('overtime_note')) ? htmlspecialchars($this->input->post('overtime_note')) : '',

				'task_id'		=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_task') : NULL,
				'start'			=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_start') : NULL,
				'finish'		=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_finish') : NULL,
				'date_overtime'	=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_start') : NULL,

				'red'			=> ($this->input->post('overtime_red')=='1') ? $this->input->post('overtime_red') : NULL,
				'red_date'		=> ($this->input->post('overtime_red')=='1') ? $this->input->post('overtime_red_date') : NULL,
				'shift'			=> ($this->input->post('overtime_red')=='1') ? $this->input->post('overtime_shift') : NULL,
				'oncall'			=> $this->input->post('overtime_oncall') ? $this->input->post('overtime_oncall') : NULL,
				'regional'	=> session_scope_regional(),
				'area'		=> session_scope_area(),
			);
		$options['msg_success'] = $this->lang->line('overtime_success_insert');
		$options['msg_failed'] = $this->lang->line('overtime_failed_insert');
		// echo json_encode($options);
		$this->frame->insert($options);
	}

	public function update($id='')
	{
		// have_privileges('update_overtime');
		ajax_only();
		if(!$this->form_validation->run('overtime_update')):
			$detail = $this->overtime->detail($id);
			$arr = array();
			$arr['action'] = base_url().'overtime/update/'.$detail['id'];
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
					'status'		=> 'request',
					'note'			=> ($this->input->post('overtime_note')) ? htmlspecialchars($this->input->post('overtime_note')) : '',

					'task_id'		=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_task') : NULL,
					'start'			=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_start') : NULL,
					'finish'		=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_finish') : NULL,
					'date_overtime'	=> ($this->input->post('overtime_red')!='1') ? $this->input->post('overtime_start') : NULL,
					
					'red'			=> ($this->input->post('overtime_red')=='1') ? $this->input->post('overtime_red') : NULL,
					'red_date'		=> ($this->input->post('overtime_red')=='1') ? $this->input->post('overtime_red_date') : NULL,
					'shift'			=> ($this->input->post('overtime_red')=='1') ? $this->input->post('overtime_shift') : NULL,
					'oncall'			=> $this->input->post('overtime_oncall') ? $this->input->post('overtime_oncall') : NULL,
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('overtime', $data);
			$last_query = $this->db->last_query();
			$this->overtime->add_log_overtime($this->input->post('id'),'update', $last_query);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('overtime_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->overtime->detail($id);
		if($this->form_validation->run('overtime_delete')):
			$arr_msg = array();
			$this->overtime->delete($this->input->post('id'));
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['note'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'overtime/delete/'.$detail['id'];
			// $related = $this->related->overtime($detail['id']);
			$related = FALSE;
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

	public function approve($id='')
	{
		$detail = $this->overtime->detail($id);
		if($this->form_validation->run('overtime_approve')):
			$arr_msg = array();
			$data_approve = array(
				'status' 		=> 'approve',
				'approved_date' => date('Y-m-d H:i:s',time()),
				'id_approve'	=> $this->session->userdata('userid')
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('overtime',$data_approve);
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['user_name'].' '.$this->lang->line('dialog_approved_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'overtime/approve/'.$detail['id'];
			$related = FALSE;
			$arr['data_info'] = $this->data_info($detail);
			$arr['removable'] = (!$related) ? 'yes' : 'no';
			$arr['remove_confirm'] = (!$related) ? $this->lang->line('dialog_confirm_approve') : $this->lang->line('dialog_no_approve');
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		endif;
	}

	public function data_detail($id='')
	{
		$detail = $this->overtime->detail($id);
		$lama_lembur = $detail['red']!='1' ? ($detail['oncall']=='1' ? abs( strtotime($detail['finish']) - strtotime($detail['start']) ) : abs( strtotime($detail['finish']) - strtotime($detail['start']) )-3600 ): '';
		ajax_only();

		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = $detail['red']!='1' ? 
			array(
				$this->lang->line('user_name')			=> $detail['user_name'],
				$this->lang->line('overtime_status')	=> '<b>'.$detail['status'].'</b>',
				$this->lang->line('overtime_task')		=> !empty($detail['task_id']) ? $detail['subject'] : '-',
				$this->lang->line('overtime_oncall') => $detail['oncall']=='1' ? 'Ya' : 'Tidak',
				$this->lang->line('overtime_start')		=> !empty($detail['start']) ? $detail['start'] : '-',
				$this->lang->line('overtime_finish')	=> !empty($detail['finish']) ? $detail['finish'] : '-',
				'Lama lembur'	=> menit_ke_jam($lama_lembur/60),
				$this->lang->line('overtime_note')		=> $detail['note'],
				// 'Email'		=> $detail['email'],
			) :
			array(
				$this->lang->line('user_name')			=> $detail['user_name'],
				$this->lang->line('overtime_status')	=> '<b>'.$detail['status'].'</b>',
				$this->lang->line('overtime_red')		=> 'Yes',
				$this->lang->line('overtime_red_date')	=> $detail['red_date'],
				$this->lang->line('overtime_note')		=> $detail['note'],
				// 'Email'		=> $detail['email'],
			);
		if ($detail['status']=='approve') {
			$data['info'][$this->lang->line('overtime_approved')] = $detail['approved_name'].' / '.$detail['approved_date'];
		}
		$opt = $this->ui->load_template('table_data_info', $data, TRUE);

		$arr = array();
		$related = FALSE;
		$arr['data_info'] = $opt;
		if(!empty($detail)):
			foreach($detail as $field=>$val):
				$arr[$field] = $val;
			endforeach;
		endif;
		echo json_encode($arr);
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = $detail['red']!='1' ? 
			array(
				$this->lang->line('user_name')			=> $detail['user_name'],
				$this->lang->line('overtime_start')		=> $detail['start'],
				$this->lang->line('overtime_finish')	=> $detail['finish'],
				// 'Email'		=> $detail['email'],
			) : 
			array(
				$this->lang->line('user_name')				=> $detail['user_name'],
				$this->lang->line('overtime_red_date')		=> $detail['red_date'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($status='request',$modul='approval_lembur')
	{
		$product = $this->overtime->all($status);
		// pre($arr);
		$arr = array();
		$arr = $this->overtime->data($status);
		$ret = json_encode($arr);
		echo $ret;
	}

	function get_my_task()
	{
		// $userid = $this->session->userdata('userid');
		$result = '';
		$data = $this->overtime->get_my_task();
		if (count($data) > 0) {
			foreach ($data as $row) {
				$result .= '<option value="'.$row['task_id'].'">';
				$result .= $row['subject'].'</option>';
			}
		}
		echo $result;
	}

}

/* End of file Overtime.php */
/* Location: ./application/controllers/Overtime.php */