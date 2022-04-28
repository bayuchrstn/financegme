<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('usergroup');

		$this->load->model('model_usergroup', 'usergroup');
		$this->active_root_menu = 'User / Usergroup';

		$this->modul_name = $this->lang->line('usergroup_alltitle');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
 	}

	public function index($category='', $category_id='')
	{
		valid_action('usergroup');
		$this->breadcrumb = array(
				$this->lang->line('usergroup_alltitle')	=> '#',
			);
		$data['privileges_tree'] = $this->usergroup->privileges_tree();
		$data['category'] = $category;
		$data['category_id'] = $category_id;
		$ui = $this->usergroup->ui($category);
		$data['ui'] = $ui;
		$this->browser_title = $ui['main_title'];
		// pre($category);
		$this->js_inject .= $this->load->view('usergroup/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('usergroup/js', $data, TRUE);
		$this->js_inject .= $this->load->view('usergroup/valid', $data, TRUE);

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('jquery_tree');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('jquery_tree');

		$data['modal_view'] = $this->load->view('usergroup/modal', $data, TRUE);
		$data['privileges_view'] = $this->load->view('usergroup/privileges', $data, TRUE);

		$konten = $this->load->view('usergroup/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert($mode)
	{
		ajax_only();
		if(!$this->form_validation->run('usergroup_insert')):
			$arr = array();
			$data = array();
			switch ($mode) {
				default:
					$arr['html'] = $this->load->view('usergroup/insert_form/'.$mode, $data, TRUE);
				break;
			}

			echo json_encode($arr);
		else:
			$arr = array();
			$data = array();

			$code = str_to_code($this->input->post('name'));
			$data['code'] = $code;
			$data['regional'] = session_scope_regional();
			$data['area'] = session_scope_area();

			switch ($mode) {
				case 'divisi':
					$data['category'] = 'divisi';
					$data['up'] = '0';
					$data['name'] = $this->input->post('name');
				break;

				case 'department':
					$data['category'] = 'department';
					$data['up'] = $this->input->post('divisi');
					$data['name'] = $this->input->post('name');
				break;

				case 'sub_department':
					$data['category'] = 'sub_department';
					$data['up'] = $this->input->post('department');
					$data['name'] = $this->input->post('name');
				break;

				default:

				break;
			}

			$this->db->insert('usergroup', $data);

			$arr['code'] = $code;
			$arr['data'] = $data;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	public function update($id='')
	{
		$detail = $this->usergroup->detail($id);
		if(!$this->form_validation->run('usergroup_update')):
			ajax_only();
			$arr = array();
			$data = array();
			$data['detail'] = $detail;
			$arr['action'] = base_url().'usergroup/update/'.$detail['id'];
			switch ($detail['category']) {
				case 'sub_department':
					$department = $detail['department_data'];
					$divisi = $detail['divisi_data'];
					$data['detail']['divisi'] = $divisi['code'];
					$arr['html'] = $this->load->view('usergroup/update_form/'.$detail['category'], $data, TRUE);
				break;

				case 'jabatan':
					switch ($detail['jabatan_struktur']) {

						default:
							# code...
							break;
					}

					$arr['html'] = $this->load->view('usergroup/update_jabatan/'.$detail['jabatan_struktur'], $data, TRUE);
				break;

				default:
					$arr['html'] = $this->load->view('usergroup/update_form/'.$detail['category'], $data, TRUE);
				break;
			}

			echo json_encode($arr);
		else:
			$arr_msg = array();

			$data = array();
			switch ($detail['category']) {
				case 'divisi':
					$data['name'] = $this->input->post('name');
				break;

				case 'department':
					$data['up'] = $this->input->post('divisi');
					$data['name'] = $this->input->post('name');
				break;

				case 'sub_department':
					$data['up'] = $this->input->post('department');
					$data['name'] = $this->input->post('name');
				break;

				case 'jabatan':
					switch ($this->input->post('jabatan_struktur')) {
						case 'divisi':
							$data['up'] = $this->input->post('divisi');
						break;

						case 'department':
							$data['up'] = $this->input->post('department');
						break;

						case 'sub_department':
							$data['up'] = $this->input->post('sub_department');
						break;

						default:
							# code...
							break;
					}
					$data['name'] = $this->input->post('name');
				break;

				default:
				break;
			}

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('usergroup', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr_msg);
		endif;
	}

	//ini input jabatan via divisi, department or sub_department
	public function jabatan($id='')
	{
		$detail = $this->usergroup->detail($id);
		if(!$this->form_validation->run('usergroup_update')):
			ajax_only();
			$arr = array();
			$data = array();
			$data['detail'] = $detail;
			$arr['action'] = base_url().'usergroup/jabatan/'.$detail['id'];
			switch ($detail['category']) {
				case 'department':
					$divisi = $detail['divisi_data'];
					$data['detail']['divisi'] = $divisi['code'];
					$arr['html'] = $this->load->view('usergroup/insert_jabatan/'.$detail['category'], $data, TRUE);
				break;

				case 'sub_department':
					$department = $detail['department_data'];
					$divisi = $detail['divisi_data'];
					$data['detail']['divisi'] = $divisi['code'];
					$arr['html'] = $this->load->view('usergroup/insert_jabatan/'.$detail['category'], $data, TRUE);
				break;

				default:
					$arr['html'] = $this->load->view('usergroup/insert_jabatan/'.$detail['category'], $data, TRUE);
				break;
			}

			echo json_encode($arr);
		else:
			$arr_msg = array();

			$data = array();
			$code = str_to_code($this->input->post('name'));

			$data['regional'] = session_scope_regional();
			$data['area'] = session_scope_area();
			$data['category'] = 'jabatan';

			switch ($detail['category']) {
				case 'divisi':
					$data['up'] = $this->input->post('divisi');
					$data['jabatan_struktur'] = 'divisi';
					$data['code'] = $code.'_'.$this->input->post('divisi').'_'.session_scope_regional().'_'.session_scope_area();
					$data['name'] = $this->input->post('name');
				break;

				case 'department':
					$data['up'] = $this->input->post('department');
					$data['jabatan_struktur'] = 'department';
					$data['code'] = $code.'_'.$this->input->post('department').'_'.session_scope_regional().'_'.session_scope_area();
					$data['name'] = $this->input->post('name');
				break;

				case 'sub_department':
					$data['up'] = $this->input->post('sub_department');
					$data['jabatan_struktur'] = 'sub_department';
					$data['code'] = $code.'_'.$this->input->post('sub_department').'_'.session_scope_regional().'_'.session_scope_area();
					$data['name'] = $this->input->post('name');
				break;

				default:
				break;
			}

			$this->db->insert('usergroup', $data);

			$arr_msg['data'] = $data;
			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr_msg);
		endif;
	}

	public function insert_jabatan()
	{
		if(!$this->form_validation->run('usergroup_insert')):
			ajax_only();
			$arr = array();
			$data = array();
			$arr['html'] = $this->load->view('usergroup/insert_jabatan/main', $data, TRUE);
			echo json_encode($arr);
		else:
			$arr = array();
			$data = array();
			$code = str_to_code($this->input->post('name'));

			$data['regional'] = session_scope_regional();
			$data['area'] = session_scope_area();
			$data['category'] = 'jabatan';

			$level_jabatan = $this->input->post('level_jabatan');

			switch ($level_jabatan) {
				case 'divisi':
					$data['up'] = $this->input->post('divisi');
					$data['jabatan_struktur'] = 'divisi';
					$data['code'] = $code.'_'.$this->input->post('divisi').'_'.session_scope_regional().'_'.session_scope_area();
					$data['name'] = $this->input->post('name');
				break;

				case 'department':
					$data['up'] = $this->input->post('department');
					$data['jabatan_struktur'] = 'department';
					$data['code'] = $code.'_'.$this->input->post('department').'_'.session_scope_regional().'_'.session_scope_area();
					$data['name'] = $this->input->post('name');
				break;

				case 'sub_department':
					$data['up'] = $this->input->post('sub_department');
					$data['jabatan_struktur'] = 'sub_department';
					$data['code'] = $code.'_'.$this->input->post('sub_department').'_'.session_scope_regional().'_'.session_scope_area();
					$data['name'] = $this->input->post('name');
				break;

				default:
				break;
			}

			$this->db->insert('usergroup', $data);

			$arr['data'] = $data;
			$arr['post'] = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function set_privileges($id)
	{
		if(!$this->form_validation->run('usergroup_privileges')):
			ajax_only();
			$detail = $this->usergroup->detail($id);
			$arr = array();
			$arr['data_info'] = $this->data_info($detail);
			$arr['action'] = base_url().'usergroup/set_privileges/'.$detail['id'];
			$arr['current_privileges'] = $this->usergroup->privileges_comma($detail['code']);
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		else:
			$arr_msg = array();
			$usergroup = $this->input->post('usergroup_code');
			$modul = $this->input->post('privileges');

			if(empty($modul)):
				$sql_delete = "DELETE FROM {PRE}privileges WHERE user_group_id='".$usergroup."' ";
				$this->db->query($sql_delete);
			else:
				$sql_delete = "DELETE FROM {PRE}privileges WHERE user_group_id='".$usergroup."' AND modul NOT IN ('".join("','", $modul)."')";
				$this->db->query($sql_delete);
				foreach($modul as $pcode):
					$sql_cek = "SELECT * FROM {PRE}privileges WHERE user_group_id='".$usergroup."' AND modul='".$pcode."' ";
					$cek = $this->db->query($sql_cek)->result_array();
					if(empty($cek)):
						$sql_insert = "INSERT INTO {PRE}privileges (user_group_id, modul) VALUES ('".$usergroup."', '".$pcode."') ";
						$this->db->query($sql_insert);
					endif;
				endforeach;
			endif;

			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('usergroup_success_update_privileges');
			echo json_encode($arr_msg);
		endif;
	}

	function detail($id='')
	{
		ajax_only();
		cekvar($id);
		$data = $this->usergroup->detail($id);
		cekvar($id);
		echo json_encode($data);
	}

	public function delete($id='')
	{
		if($this->form_validation->run('usergroup_delete')):
			$arr_msg = array();
			$detail = $this->usergroup->detail($id);

			$this->db->where('id', $this->input->post('id'));
			$delete = $this->db->delete('usergroup');
			if(!$delete):
				$error = $this->db->error();
				$arr_msg['status'] = 'failed';
				$arr_msg['detail'] = $detail;
				$arr_msg['msg'] = $error['message'];
			else:
				$arr_msg['status'] = 'success';
				$arr_msg['msg'] = $this->lang->line('dialog_delete_success');
			endif;
			echo json_encode($arr_msg);

		else:
			ajax_only();
			$detail = $this->usergroup->detail($id);
			$arr = array();
			$arr['data_info'] = $this->data_info($detail);
			$arr['action'] = base_url().'usergroup/delete/'.$detail['id'];
			// $related = $this->related->usergroup($detail['code']);
			$related = FALSE;
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

	public function modul_view($id='')
	{
		$detail = $this->usergroup->detail($id);
		$modul_view = $this->usergroup->get_modul_view();
		$modul_access = $this->usergroup->get_modul_access($detail['code']);

		if(!$this->form_validation->run('usergroup_modul_access')):
			$data['modul_view'] = $this->usergroup->get_modul_view();
			$data['detail'] = $detail;
			$data['modul_access'] = $modul_access;
			echo $this->load->view('usergroup/modul_view', $data, TRUE);
		else:
			$arr = array();
			// $arr['post'] = $_POST;
			$this->usergroup->save_modul_access($this->input->post('modul_access'), $this->input->post('usergroup'));
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '80';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				'Usergroup'		=> $detail['name'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($category='', $category_id='')
	{
		$usergroup = $this->usergroup->all_usergroup($category, $category_id);
		// pre($this->db->last_query());
		$arr = array();
		$arr['data'] = array();
		if(!empty($usergroup)):
			$urut = 0;
			foreach($usergroup as $row):
				$urut++;

				switch ($category) {
		            case 'divisi':
		                $link = base_url('usergroup/index/department/'.$row['code']);
						$rname = '<a href="'.$link.'">'.$row['name'].'</a>';
		            break;

		            case 'department':
		                $link = base_url('usergroup/index/sub_department/'.$row['code']);
						$rname = '<a href="'.$link.'">'.$row['name'].'</a>';
		            break;

		            case 'sub_department':
		               $link = base_url('usergroup/index/department/'.$row['code']);
					   $rname = $row['name'];
		            break;

					case 'jabatan':
						// $parent = $this->usergroup->get_one_by_code($row['up']);
						//   	$rname = $row['name'].' '.$parent['name'];
					   	$rname = $this->usergroup->jabatan_name($row['code']);
		            break;

		            default:
		                $link = base_url('usergroup/index/department/'.$row['code']);
		            break;
		        }

				// $rname = ($category=='sub_department' || $category=='jabatan') ? $row['name'] : '<a href="'.$link.'">'.$row['name'].'</a>';

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_usergroup(\''.$row['id'].'\');" ');
				$hidden_form['privileges'] = array('label'=>$this->lang->line('all_privileges'), 'url'=>'javascript:void(0);', 'icon'=>'icon-equalizer3', 'more'=>'onclick="update_privileges(\''.$row['id'].'\');" ');
				$hidden_form['modul_view'] = array('label'=>'Modul View', 'url'=>'javascript:void(0);', 'icon'=>'icon-eye', 'more'=>'onclick="modul_view(\''.$row['id'].'\');" ');

				if($category!='jabatan'):
					$hidden_form['jabatan'] = array('label'=>'Jabatan', 'url'=>'javascript:void(0);', 'icon'=>'icon-user-tie', 'more'=>'onclick="input_jabatan(\''.$row['id'].'\');" ');
				endif;
				$action = $this->actionform->dropdown($hidden_form);
				$arr['data'][] = array(
						'x',
						$rname,
						$action
					);
			endforeach;
		endif;
		$ret = json_encode($arr);
		echo $ret;
	}


}
