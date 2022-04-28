<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_customer extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->owner_filter('id_user');
		$this->load->model('model_pre_customer', 'pre_customer');
		$this->load->model('model_customer', 'customer');
		$this->load->model('model_marketing_progress', 'mp');
		$this->load->model('model_user', 'user');
		$this->load->model('model_product', 'product');
		$this->lang->load('customer');
		$this->lang->load('pre_customer');
		$this->lang->load('marketing_progress');

		$this->active_root_menu = 'pre_customer';
		$this->browser_title = $this->lang->line('pre_customer_alltitle').' - '.$this->app_name;
		$this->modul_name = 'pre_customer ';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function owner_filter($field='')
	{
		$this->session->set_userdata('owner_filter', $field);
	}

	public function index($pre_customer_group='')
	{
		$this->load->model('model_master','master');
		valid_action('pre_customer');
		$this->breadcrumb = array(
				'Home' => base_url(),
				$this->lang->line('pre_customer_alltitle')	=> '#',
			);
		$data = array();

		$data['maps_center'] = $this->master->master_by_code( 'maps_center','maps_center_'.session_scope_area() );

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('bootstrap_multiselect');
		$this->js_inject .= $this->load->view('pre_customer/js_table_server', $data, TRUE);
		$this->js_inject .= $this->load->view('pre_customer/js', $data, TRUE);
		$this->js_inject .= $this->load->view('pre_customer/valid', $data, TRUE);
		$this->js_inject .= $this->load->view('customer_product_picker/js', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('wysiwyg');
		$this->js_include .= $this->ui->js_include('datatables_key_table');
		$this->js_include .= $this->ui->js_include('typeahead');
		$this->js_include .= $this->ui->js_include('google_maps');

		$data['update_view'] = $this->load->view('pre_customer/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('pre_customer/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('pre_customer/delete', $data, TRUE);
		$data['search_view'] = $this->load->view('pre_customer/search', $data, TRUE);
		$data['marketing_progress_view'] = $this->load->view('pre_customer/marketing_progress', $data, TRUE);
		$data['show_view'] = $this->load->view('customer/show_this', $data, TRUE);
		$data['modal_view'] = $this->load->view('pre_customer/modal', $data, TRUE);

		$konten = $this->load->view('pre_customer/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function view()
	{
		valid_action('pre_customer');
		$this->breadcrumb = array(
				'Home' 			=> base_url(),
				'Pre Customer'	=> '#',
			);
		$data = array();

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('bootstrap_multiselect');
		$this->js_inject .= $this->load->view('pre_customer/js_table_view', $data, TRUE);
		$this->js_inject .= $this->load->view('pre_customer/js', $data, TRUE);
		$this->js_inject .= $this->load->view('pre_customer/valid', $data, TRUE);
		$this->js_inject .= $this->load->view('customer_product_picker/js', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('wysiwyg');
		$this->js_include .= $this->ui->js_include('datatables_key_table');

		// $data['product_view'] = $this->load->view('pre_customer/product', $data, TRUE);
		$data['modal'] = $this->load->view('pre_customer/modal', $data, TRUE);

		$data['marketing_progress_view'] = $this->load->view('pre_customer/marketing_progress', $data, TRUE);

		$konten = $this->load->view('pre_customer/view', $data, TRUE);
		$this->admin_view($konten);
	}

	// form insert pre customer
	function new_customer_mode($mode='new', $existing_customer='')
	{
		// pre($mode);
		// pre($existing_customer);
		// $arr = array();
		$data = array();
		if($mode=='picker'):
			echo $this->load->view('pre_customer/insert/new_customer_mode_picker', $data, TRUE);
		elseif($mode == 'new'):
			$arr['mode'] = 'new_customer';
			$arr['existing'] = '0';
			echo $this->load->view('pre_customer/insert/new_customer_mode_new', $data, TRUE);
		else:
			$customer = $this->customer->detail_customer($existing_customer);
			$this->db->where('id', $customer['group_id']);
			$data['existing_customer_info'] = $this->db->get('customer_group')->row_array();
			echo $this->load->view('pre_customer/insert/new_customer_mode_existing', $data, TRUE);
		endif;
	}

	public function v($pre_customer_group_id='')
	{
		valid_action('pre_customer');
		$pre_customer_group_detail = $this->pre_customer->pre_customer_group_detail($pre_customer_group_id);
		// pre($pre_customer_group_detail);
		$this->breadcrumb = array(
				$this->lang->line('all_home')			=> base_url(),
				$this->lang->line('pre_customer_alltitle')	=> base_url().'pre_customer',
				$pre_customer_group_detail['pre_customer_name']	=> '#',
			);
		$data = array();
		$data['pre_customer_group_detail'] = $pre_customer_group_detail;
		// $data['arr_product'] = $this->product->arr_product();
		$this->js_include .= $this->ui->js_include('bootstrap_multiselect');

		$this->js_inject .= $this->load->view('pre_customer/js_table_v', $data, TRUE);
		$this->js_inject .= $this->load->view('pre_customer/js', $data, TRUE);
		$this->js_inject .= $this->load->view('pre_customer/valid', $data, TRUE);

		// $data['product_view'] = $this->load->view('pre_customer/product', $data, TRUE);
		$data['update_view'] = $this->load->view('pre_customer/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('pre_customer/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('pre_customer/delete', $data, TRUE);

		$konten = $this->load->view('pre_customer/v', $data, TRUE);
		$this->admin_view($konten);
	}

	public function marketing_progress($id='')
	{
		$detail = $this->customer->detail_customer($id);
		if(!$this->form_validation->run('customer_marketing_progress')):
			// $options = '';
			// $arr_options = $this->mp->get_category($id);
			// if(!empty($arr_options)):
			// 	foreach($arr_options as $option):
			// 		$options .= '<option value="'.$option['code'].'">'.$option['name'].'</option>';
			// 	endforeach;
			// endif;
			// echo $options;

			$arr = array();
			$data = array();
			$data['detail'] = $detail;
			$arr['action'] = base_url().'customer/marketing_progress/'.$detail['id'];
			$arr['html'] = $this->load->view('pre_customer/marketing_progress', $data, TRUE);
			echo json_encode($arr);
		else:
			$arr_msg = array();
			// $this->customer->update_customer_group();
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('customer_success_update');
			echo json_encode($arr_msg);
		endif;
	}

	function new_pre_customer_mode()
	{
		$arr = array();
		if($this->input->post('mode')=='existing'):
			$this->db->where('id', $this->input->post('existing_pre_customer'));
			$usergroup_info = $this->db->get('pre_customer_group')->row_array();
			if(!empty($usergroup_info)):
				foreach($usergroup_info as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
		endif;
		// $arr['pre_customer_name'] = 'haha';
		// pre($arr);
		echo json_encode($arr);
	}

	public function insert_new()
	{
		$arr = array();

		// customer group
		$params = array();
		$params['status'] = 'pre_customer';
		$params['id_user'] = my_id();
		$params['id_am'] = my_id();
		$params['date_post'] = now();
		$params['regional'] = session_scope_regional();
		$params['area'] = session_scope_area();
		$customer_group_res = $this->crud->insert('customer_group', $params, array('id'));
		$arr['customer_group_res'] = $customer_group_res;
		//
		if($customer_group_res['status']==TRUE):
			$params_cs = array();
			$params_cs['group_id'] = $customer_group_res['last_id'];
			$params_cs['status'] = 'pre_customer';
			$params_cs['id_user'] = my_id();
			$params_cs['id_am'] = my_id();
			$params_cs['date_post'] = now();
			$params_cs['regional'] = session_scope_regional();
			$params_cs['area'] = session_scope_area();
			$params_cs['status_active'] = '1';
			$params_cs['harga_isp_lama'] = paranoid($this->input->post('harga_isp_lama'));
			$customer_res = $this->crud->insert('customer', $params_cs, array('id'));
			$sid_res = $this->customer->save_customer_sid($customer_res['last_id']);
			$cp_res = $this->customer->save_cp($customer_res['last_id']);
		endif;


		$arr['post'] = $_POST;
		$arr['customer_res'] = $customer_res;
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	public function insert_existing()
	{
		$arr = array();
		$params_cs = array();
		$params_cs['group_id'] = $this->input->post('current_cg_id');
		$params_cs['customer_id'] = $this->input->post('current_cg_customer_id');
		$params_cs['customer_name'] = ($this->input->post('customer_name') !='') ? $this->input->post('customer_name') : $this->input->post('current_cg_customer_name');
		$params_cs['customer_address'] = ($this->input->post('customer_address') !='') ? $this->input->post('customer_address') : $this->input->post('current_cg_customer_address');
		$params_cs['telephone_home'] = ($this->input->post('telephone_home') !='') ? $this->input->post('telephone_home') : $this->input->post('current_cg_telephone_home');
		$params_cs['telephone_mobile'] = ($this->input->post('telephone_mobile') !='') ? $this->input->post('telephone_mobile') : $this->input->post('current_cg_telephone_mobile');
		$params_cs['telephone_work'] = ($this->input->post('telephone_work') !='') ? $this->input->post('telephone_work') : $this->input->post('current_cg_telephone_work');
		$params_cs['contact_person'] = ($this->input->post('contact_person') !='') ? $this->input->post('contact_person') : $this->input->post('current_cg_contact_person');
		$params_cs['fax'] = ($this->input->post('fax') !='') ? $this->input->post('fax') : $this->input->post('current_cg_fax');
		$params_cs['email'] = ($this->input->post('email') !='') ? $this->input->post('email') : $this->input->post('current_cg_email');
		$params_cs['customer_type'] = ($this->input->post('customer_type') !='') ? $this->input->post('customer_type') : '';
		$params_cs['link_type'] = ($this->input->post('link_type') !='') ? $this->input->post('link_type') : '';
		$params_cs['contract_status'] = ($this->input->post('contract_status') !='') ? $this->input->post('contract_status') : '';
		$params_cs['contract'] = ($this->input->post('contract') !='') ? $this->input->post('contract') : '';
		$params_cs['ppn'] = ($this->input->post('ppn') !='') ? $this->input->post('ppn') : '';
		$params_cs['nmc'] = ($this->input->post('nmc') !='') ? $this->input->post('nmc') : '';
		$params_cs['status'] = 'pre_customer';
		$params_cs['status_active'] = '1';
		$params_cs['id_user'] = my_id();
		$params_cs['id_am'] = my_id();
		$params_cs['date_post'] = now();
		$params_cs['regional'] = session_scope_regional();
		$params_cs['area'] = session_scope_area();
		$params_cs['harga_isp_lama'] = paranoid($this->input->post('harga_isp_lama'));
		$customer_res = $this->crud->insert('customer', $params_cs, array('id'));
		$res_sid = $this->customer->save_customer_sid($customer_res['last_id']);
		$cp_res = $this->customer->save_cp($customer_res['last_id']);

		$arr['params_cs'] = $params_cs;
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	function isp($mode='form', $select_target='' )
	{
		// $this->output->enable_profiler(TRUE);
		$arr = array();
		$data = array();
		switch ($mode) {
			case 'insert':
				$data['name'] = $this->input->post('name');
				$this->db->insert('isp', $data);

				$arr['post'] = $_POST;
				$arr['status'] = 'success';
				$arr['msg'] = 'Isp berhasil disimpan';

				$arr['select_target'] = $this->input->post('select_target');
				$arr['isp_lama_name'] = $this->db->insert_id();
				echo json_encode($arr);
			break;

			default:
				$data['select_target'] = $select_target;
				$arr['html'] = $this->load->view('pre_customer/isp', $data, TRUE);
				echo json_encode($arr);
			break;
		}
	}

	public function update($id='')
	{
		// ajax_only();

		$detail = $this->customer->detail_customer($id);
		if(!$this->form_validation->run('customer_update')):
			$arr = array();
			$data = array();
			$data['detail'] = $detail;
			$data['prefix'] = 'update';
			$arr['action'] = base_url().'pre_customer/update/'.$detail['id'];
			$data['current_product'] = $this->customer->get_product_serialize($detail['id']);
			$arr['html'] = $this->load->view('pre_customer/form_grid_update', $data, TRUE);

			// if(!empty($detail)):
			// 	foreach($detail as $field=>$val):
			// 		$arr[$field] = $val;
			// 	endforeach;
			// endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			$arr_msg = array();

			$params = array();
			$params['ppn'] = $this->input->post('ppn');
			$params['nmc'] = $this->input->post('nmc');
			$params['contract_status'] = $this->input->post('contract_status');
			$params['koordinat'] = $this->input->post('koordinat');
			$params['harga_isp_lama'] = paranoid($this->input->post('harga_isp_lama'));
			$update_result = $this->crud->update('customer', $params, array('id'));
			$cp_res = $this->customer->save_cp($this->input->post('id'));
			$res_sid = $this->customer->save_customer_sid($this->input->post('id'));
			// $arr_msg['update_result'] = $update_result;


			$arr_msg['post'] = $_POST;
			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = 'Data berhasil disimpan';
			// $arr_msg['last'] = $this->db->last_query();
			$arr_msg['res_sid'] = $res_sid;
			echo json_encode($arr_msg);
		endif;
	}

	public function set_product($id='')
	{
		valid_action('pre_customer');
		if(!$this->form_validation->run('pre_customer_set_product')):
			$detail = $this->pre_customer->detail($id);

			$all_product = $this->pre_customer->get_product($detail['id']);
			$arr = array();
			$arr['action'] = base_url().'pre_customer/set_product/'.$detail['id'];
			$arr['data_info'] = $this->data_info($detail);
			$arr['products'] = $all_product;
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		else:
			$arr_msg = array();
			$id_pre_customer = $this->input->post('id_pre_customer');
			$product_code = $this->input->post('code_product');

			if(empty($product_code)):
				$sql_delete = "DELETE FROM {PRE}pre_customer_product WHERE pre_customer_id='".$id_pre_customer."' ";
				$this->db->query($sql_delete);
			else:
				$sql_delete = "DELETE FROM {PRE}pre_customer_product WHERE pre_customer_id='".$id_pre_customer."' AND product_code NOT IN ('".join("','", $product_code)."')";
				$this->db->query($sql_delete);
				foreach($product_code as $pcode):
					$sql_cek = "SELECT * FROM {PRE}pre_customer_product WHERE pre_customer_id='".$id_pre_customer."' AND product_code='".$pcode."' ";
					$cek = $this->db->query($sql_cek)->result_array();
					if(empty($cek)):
						$sql_insert = "INSERT INTO {PRE}pre_customer_product (pre_customer_id, 	product_code) VALUES ('".$id_pre_customer."', '".$pcode."') ";
						$this->db->query($sql_insert);
					endif;
				endforeach;
			endif;
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('pre_customer_success_update_product');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		if($this->form_validation->run('pre_customer_delete')):
			$arr_msg = array();
			$detail = $this->pre_customer->detail($id);
			$data = array(
					'flag_delete'	=> '1'
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pre_customer', $data);
			$arr_msg['status'] = 'success';
			$arr_msg['post'] = $_POST;
			$arr_msg['msg'] = 'pre_customer '.$detail['name'].' '.$this->lang->line('dialog_delete_success');
			echo json_encode($arr_msg);

		else:
			ajax_only();
			$detail = $this->pre_customer->detail($id);
			$arr = array();
			$arr['action'] = base_url().'pre_customer/delete/'.$detail['id'];
			$related = $this->related->pre_customer($detail['id']);
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
		$data['label_width'] = '80';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				'Name'		=> $detail['name'],
				'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	function data_server()
	{
		echo $this->pre_customer->data();
	}

	function data_view()
	{
		echo $this->pre_customer->data_view();
	}

	function sid_info($arr_sid, $group_id)
	{
		if(isset($arr_sid[$group_id]['sid_count'])):
			return $arr_sid[$group_id]['sid_count'];
		else:
			return '';
		endif;
	}

	public function data_service_id($pre_customer_group_id)
	{
		$pre_customer = $this->pre_customer->service_id_lists($pre_customer_group_id);
		// pre($this->db->last_query());
		// pre($pre_customer);
		// exit;

		$arr = array();
		$arr['data'] = array();
		if(!empty($pre_customer)):
			$urut = 0;
			foreach($pre_customer as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_pre_customer(\''.$row['id'].'\');" class="edit_button" ');
				// $hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_pre_customer(\''.$row['id'].'\');" ');

				$action = $this->actionform->dropdown($hidden_form);

				// $pre_customer_name = '<a href="'.base_url().'pre_customer/v/'.$row['id'].'">'.clean_string($row['pre_customer_name'], 40).'</a>';
				$pre_customer_name = clean_string($row['pre_customer_name'], 40);

				if($row['status_active']=='0'):
					$status = '<span class="label label-danger">non active</span>';
				else:
					$status = '<span class="label label-success">active</span>';
				endif;

				$arr['data'][] = array(
						'x',
						$pre_customer_name,
						clean_string($row['telephone_work'], 40),
						$status,
						$action
					);
			endforeach;
		endif;
		// pre($arr);

		$ret = json_encode($arr);
		echo $ret;
	}

	public function data_service($group_id)
	{
		$serv = $this->pre_customer->get_Service_by_group($group_id);
		// pre($this->db->last_query());
		// pre($pre_customer);
		// exit;

		$arr = array();
		$arr['data'] = array();
		if(!empty($serv)):
			$urut = 0;
			foreach($serv as $row):
				$urut++;
				$hidden_form['update'] = array('label'=>'Update', 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_user(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				$arr['data'][] = array(
						$urut,
						$row['pre_customer_id'],
						$row['service_id'],
						$row['pre_customer_name'],
						$action
					);
			endforeach;
		endif;
		// pre($arr);

		$ret = json_encode($arr);
		echo $ret;
	}

	function valid_username()
	{
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get('pre_customer')->result_array();
		if(empty($cek)):
			echo 'true';
		else:
			echo 'false';
		endif;
	}

	function valid_email()
	{
		$this->db->where('email', $this->input->post('email'));
		$cek = $this->db->get('pre_customer')->result_array();
		if(empty($cek)):
			echo 'true';
		else:
			echo 'false';
		endif;
	}

	function widget($mode='default')
	{
		$data = array();
		switch ($mode) {
			default:
				$data['new_pre_customer'] = $this->pre_customer->widget($mode);
				$view = 'widget';
			break;
		}
		$this->load->view('pre_customer/'.$view, $data);
	}

	function get_pre_customer_timeline($location_id='5023')
	{
		$data = array();
		$marketing_progress = $this->pre_customer->data_marketing_progress($location_id);
		// echo count($marketing_progress);
		$i=0;
		foreach ($marketing_progress as $value) {
			if ($value['category']=='mp_trial') {
				$marketing_progress[$i]['child'] = array(
					'is_trial'	=> 'true'
				);
			} else {
				$marketing_progress[$i]['child'] = $this->pre_customer->child_marketing_progress($value['id']);
			}
			$i++;
		}
		$data = $marketing_progress;
		echo encodeJson($data);
	}

	function sample_maps()
	{
		$data = array();
		$this->load->model('model_master','master');
		$data['maps_center'] = $this->master->master_by_code( 'maps_center','maps_center_'.session_scope_area() );
		$this->load->view('pre_customer/sample_maps', $data, FALSE);
	}

	function timeline($customer_id, $mode='echo')
	{
		$timeline = $this->pre_customer->timeline($customer_id);

		if ($mode=='json') {
			echo json_encode($timeline); exit;
		}

		$data['timeline'] = $timeline;
		$this->load->view('pre_customer/timeline', $data, FALSE);
	}

}
