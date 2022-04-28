<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class regional extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_regional', 'regional');
		$this->active_root_menu = $this->lang->line('regional_alltitle');
		$this->browser_title = $this->lang->line('regional_alltitle');
		$this->modul_name = $this->lang->line('regional_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index($regional='0')
	{
		valid_action('regional');
		$detail_regional = $this->regional->detail($regional);
		// pre($detail_regional);

		if($regional=='0'):
			$this->breadcrumb = array(
					$this->lang->line('all_home')			=> base_url(),
					$this->lang->line('regional_alltitle')	=> '#',
				);
		else:
			$this->breadcrumb = array(
				$this->lang->line('all_home')			=> base_url(),
				$this->lang->line('regional_alltitle')	=> base_url().'regional',
				$detail_regional['name']				=> '#',
			);
		endif;

		$data = array();
		$data['regional'] = $regional;
		$data['detail_regional'] = $detail_regional;

		$this->js_inject .= $this->load->view('regional/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('regional/js', $data, TRUE);
		$this->js_inject .= $this->load->view('regional/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');

		$data['update_view'] = $this->load->view('regional/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('regional/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('regional/delete', $data, TRUE);

		$konten = $this->load->view('regional/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		ajax_only();
		$arr_msg = array();
		if($this->form_validation->run('regional_insert')):
			$this->regional->insert();
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('regional_success_insert');
		else:
			$arr_msg['status'] = 'gagal';
			$arr_msg['msg'] = $this->lang->line('regional_fail_insert');
		endif;
		$arr_msg['datapost'] = $_POST;
		$response = json_encode($arr_msg);
		echo $response;
	}

	public function update($id='')
	{
		valid_action('regional');
		ajax_only();
		if(!$this->form_validation->run('regional_update')):
			$detail = $this->regional->detail($id);

			// pre($detail);
			$arr = array();
			$arr['action'] = base_url().'regional/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			$arr_msg = array();
			$this->regional->update();
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('regional_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->regional->detail($id);
		if($this->form_validation->run('regional_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('regional');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['regional_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'regional/delete/'.$detail['id'];
			$related = $this->related->regional($detail['code']);
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
				'regional Name'		=> $detail['name'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($regional)
	{
		$regional_all = $this->regional->all($regional);

		$arr = array();
		$arr['data'] = array();
		if(!empty($regional_all)):
			$urut = 0;
			foreach($regional_all as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_regional(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_regional(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				if($regional=='0' || $regional==''):
					$name = '<a href="'.base_url().'regional/index/'.$row['id'].'">'.clean_string($row['name'], 40).'</a>';
				else:
					$name = clean_string($row['name'], 40);
				endif;
				$arr['data'][] = array(
						'x',
						$name,
						clean_string($row['code'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);

		$ret = json_encode($arr);
		echo $ret;
	}

	function arr_area($regional, $selected_area)
	{
		$this->db->where('code', $regional);
		$regional = $this->db->get('regional')->row_array();
		$data['arr_area'] = $this->regional->arr_area($regional['id']);
		$data['selected_area'] = $selected_area;
		echo $this->load->view('regional/arr_area', $data, TRUE);
	}

	function regional_picker($selected_regional='01', $selected_area='')
	{
		$selected_regional_info = $this->db->query("SELECT * FROM {PRE}regional WHERE code='".$selected_regional."'")->row_array();

		$regional_options = '';
		$regional_lists = $this->db->query("SELECT * FROM {PRE}regional WHERE up='0'")->result_array();
		if(!empty($regional_lists)):
			foreach($regional_lists as $row):
				$selected = ($selected_regional==$row['code']) ? 'selected' : '';
				$regional_options .= '<option '.$selected.' value="'.$row['code'].'">'.$row['name'].'</option>';
			endforeach;
		endif;

		$area_options = '';
		$area_lists = $this->db->query("SELECT * FROM {PRE}regional WHERE up='".$selected_regional_info['id']."'")->result_array();
		if(!empty($area_lists)):
			foreach($area_lists as $row):
				$selected = ($selected_area==$row['code']) ? 'selected' : '';
				$area_options .= '<option '.$selected.' value="'.$row['code'].'">'.$row['name'].'</option>';
			endforeach;
		endif;

		$opt = array();
		$opt['regional_options'] = $regional_options;
		$opt['area_options'] = $area_options;
		// pre($opt);
		echo json_encode($opt);
	}

}
