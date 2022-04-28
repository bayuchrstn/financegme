<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_cuti', 'cuti');
		$this->lang->load('cuti');
		$this->active_root_menu = $this->lang->line('cuti_alltitle');
		$this->browser_title = $this->lang->line('cuti_alltitle');
		$this->modul_name = $this->lang->line('cuti_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index()
	{
		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('cuti_alltitle') => '#');
		$data = array();

		if(allow_modul('cuti_karyawan')){
			$data['people'] = $this->cuti->get_people();
		}
		$data['cuti_category'] = $this->cuti->cuti_category();

		$this->js_inject .= $this->load->view('cuti/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('cuti/js', $data, TRUE);
		$this->js_inject .= $this->load->view('cuti/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');

		$data['update_view'] = $this->load->view('cuti/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('cuti/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('cuti/delete', $data, TRUE);
		$data['update_status_view'] = $this->parser->parse('cuti/update_status', $data, TRUE);

		$konten = $this->load->view('cuti/index', $data, TRUE);
		$this->admin_view($konten);
	}
	function insert()
	{
		ajax_only();
		$arr = array();
		if (!$this->form_validation->run('insert_cuti')) {
			$arr['status'] = 'failed';
			$arr['msg'] = 'Data gagal disimpan';
		} else {
			$params = array(
				'cuti_status' => 1,
				'cuti_people_id' => !($this->input->post('karyawan')) ? $this->input->post('karyawan') : $this->session->userdata('userid'),
				'cuti_category'	=> $this->input->post('cuti_category'),
				'cuti_date_start'	=> $this->input->post('cuti_date_start'),
				'cuti_date_end'	=> $this->input->post('cuti_date_end'),
				'cuti_date_length'	=> date_diff( date_create($this->input->post('cuti_date_start')), date_create($this->input->post('cuti_date_end')) )->format('%a') + 1,
				'cuti_note'	=> $this->input->post('cuti_note'),
				'cuti_user'	=> $this->session->userdata('userid'),
			);
			$params['cuti_regional'] = session_scope_regional();
			$params['cuti_area'] = session_scope_area();
			// $this->crud->insert('cuti', $params, array('cuti_id'));

			$check_cuti = $this->db->where($params)->get('cuti')->num_rows();
			if ($check_cuti == 0) {
				$this->db->flush_cache();
				$this->db->insert('cuti', $params);
				$cuti_id = $this->db->insert_id();
				$cuti_history = array(
					'cuti_history_cuti_id' => $cuti_id,
					'cuti_history_status'	=> $params['cuti_status'],
					'cuti_history_note'	=> $params['cuti_note'],
					'cuti_history_user'	=> $params['cuti_user']
				);
				$this->db->insert('cuti_history', $cuti_history);
			}

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
		}
		echo json_encode($arr);
	}
	public function update($id='')
	{
		valid_action('cuti');
		ajax_only();
		if(!$this->form_validation->run('cuti_update')):
			$detail = $this->cuti->detail($id);
			$arr = array();
			$arr['action'] = base_url().'cuti/update/'.$detail['id'];

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
					// 'cuti_people_id'			=> htmlspecialchars($this->input->post('cuti_name')),
					// 'cuti_status'		=> htmlspecialchars($this->input->post('cuti_status')),
					'cuti_date_start'	=> $this->input->post('cuti_date_start'),
					'cuti_date_end'		=> $this->input->post('cuti_date_end'),
					'cuti_date_length'	=> date_diff( date_create($this->input->post('cuti_date_start')), date_create($this->input->post('cuti_date_end')) )->format('%a') + 1,
					'cuti_note'		=> htmlspecialchars($this->input->post('cuti_note'))
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('cuti', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = "data berhasil disimpan";
			echo json_encode($arr_msg);
		endif;
	}
	function update_status($id,$status)
	{
		ajax_only();
		$data = array(
			'id'	=> $id,
			'status'	=> $status
		);
		$status_change = $status==4 ? $this->parser->parse('cuti/update_status/cancel', $data, TRUE) : $this->parser->parse('cuti/update_status/accept', $data, TRUE);

		if (!$this->form_validation->run('cuti_update_status')) {
			$detail = $this->cuti->detail($id);
			$arr = array();
			$arr['action'] = base_url().'cuti/update_status/'.$detail['id'].'/'.$status;

			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			$arr['data_info'] = $status_change.$this->data_info($arr);
			// pre($arr);
		} else {
			$params['cuti_status'] = $status;
			$this->db->where('id', $id)->update('cuti',$params);
			$this->db->flush_cache();
			$cuti_history = array(
				'cuti_history_cuti_id' => $id,
				'cuti_history_status'	=> $params['cuti_status'],
				'cuti_history_note'	=> NULL,
				'cuti_history_user'	=> $this->input->post('sender')
			);
			$this->db->insert('cuti_history', $cuti_history);
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
		}
		echo json_encode($arr);
	}


	public function delete($id='')
	{
		$detail = $this->cuti->detail($id);
		if($this->form_validation->run('cuti_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('cuti');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['cuti_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'cuti/delete/'.$detail['id'];
			$related = $this->related->cuti($detail['id']);
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

	function detail($id)
	{
		ajax_only();
		$detail = $this->cuti->detail($id);
		$data = $this->data_info($detail);
		echo json_encode($data);
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				$this->lang->line('cuti_name')	=> $detail['people_name'],
				$this->lang->line('cuti_category') => $detail['cuti_category_name'],
				$this->lang->line('cuti_date') => ($detail['cuti_date_start']==$detail['cuti_date_end']) ? $detail['cuti_date_start'] : $detail['cuti_date_start'].' sampai '.$detail['cuti_date_end'],
				$this->lang->line('cuti_length')	=> $detail['cuti_date_length']

				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data()
	{
		$product = $this->cuti->all();

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_cuti(\''.$row['id'].'\');" class="edit_button" ');


				if ($row['cuti_status']!=4) {
					$hidden_form['cancel'] = array('label'=>$this->lang->line('cuti_cancel_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-cancel-circle2', 'more'=>'onclick="update_cuti_status(\''.$row['id'].'\',4);" class="edit_button" ');
				}
				if (allow_modul('cuti_acc_manager') && $row['cuti_status']!=2) {
					$hidden_form['acc_manager'] = array('label'=>$this->lang->line('cuti_acc_manager_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-checkmark', 'more'=>'onclick="update_cuti_status(\''.$row['id'].'\',2);" class="edit_button" ');
				} 
				if ( allow_modul('cuti_acc_hr') && $row['cuti_status']!=3 ) {
					$hidden_form['acc_hr'] = array('label'=>$this->lang->line('cuti_acc_hrd_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-checkmark', 'more'=>'onclick="update_cuti_status(\''.$row['id'].'\',3);" class="edit_button" ');
				}

		        $action = $this->actionform->dropdown($hidden_form);

		        $cuti_date_start = default_date_format($row['cuti_date_start']);
		        $cuti_date_end = default_date_format($row['cuti_date_end']);

				$arr['data'][] = array(
						'x',
						clean_string($row['people_name'], 40),
						($row['cuti_date_start']==$row['cuti_date_end']) ? $cuti_date_start : $cuti_date_start.' - '.$cuti_date_end,
						$row['cuti_date_length'].' hari',
						clean_string($row['cuti_status_name'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

	function get_people()
	{
		$data = '';
		if(allow_modul('cuti_karyawan')){
			$data = $this->cuti->get_people();
			foreach ($data as $row) {
				$data .= '<option value="'.$row['id'].'">';
				$data .= $row['name'].'</option>';
			}
		}
		echo $data;
	}
}

/* End of file Cuti.php */
/* Location: ./application/controllers/Cuti.php */