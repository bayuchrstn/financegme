<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_customer', 'customer');
		$this->load->model('model_user', 'user');
		$this->load->model('model_product', 'product');
		$this->lang->load('customer');

		$this->active_root_menu = 'Customer';
		$this->browser_title = $this->lang->line('customer_alltitle').' - '.$this->app_name;
		$this->modul_name = 'Customer ';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		if($this->uri->segment(2)=='r'):
			$modul_code = 'customer_report';
		else:
			$modul_code = 'customer';
		endif;

		valid_action($modul_code);
		$this->breadcrumb = array(
			'Home' => base_url(),
			'Customer'	=> '#',
		);
		$data = array();

		// pre($this->uri->segment(2,'index'));

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('bootstrap_multiselect');
		$this->js_inject .= $this->load->view('customer/js_table_server', $data, TRUE);
		$this->js_inject .= $this->load->view('customer/js', $data, TRUE);
		$this->js_inject .= $this->load->view('customer/valid', $data, TRUE);
		$this->js_inject .= $this->load->view('customer_product_picker/js', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('wysiwyg');
		$this->js_include .= $this->ui->js_include('datatables_key_table');

		$data['update_view'] = $this->load->view('customer/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('customer/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('customer/delete', $data, TRUE);
		$data['search_view'] = $this->load->view('customer/search', $data, TRUE);
		$data['marketing_progress_view'] = $this->load->view('customer/marketing_progress', $data, TRUE);
		$data['show_view'] = $this->load->view('customer/show_this', $data, TRUE);

		$konten = $this->load->view('customer/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function r()
	{
		$this->index();
	}

	public function rv($customer_group_id='')
	{
		$this->v($customer_group_id);
	}

	public function v($customer_group_id='')
	{
		if($this->uri->segment(2)=='rv'):
			$customer_url = base_url().'customer/r';
			$modul_code = 'customer_report';
		else:
			$customer_url = base_url().'customer';
			$modul_code = 'customer';
		endif;

		valid_action($modul_code);
		$customer_group_detail = $this->customer->customer_group_detail($customer_group_id);
		// pre($customer_group_detail);


		$this->breadcrumb = array(
				$this->lang->line('all_home')			=> base_url(),
				$this->lang->line('customer_alltitle')	=> $customer_url,
				$customer_group_detail['customer_name']	=> '#',
			);
		$data = array();
		$data['customer_group_detail'] = $customer_group_detail;
		// $data['arr_product'] = $this->product->arr_product();
		$this->js_include .= $this->ui->js_include('bootstrap_multiselect');

		$this->js_inject .= $this->load->view('customer/js_table_v', $data, TRUE);
		$this->js_inject .= $this->load->view('customer/js', $data, TRUE);
		$this->js_inject .= $this->load->view('customer_product_picker/js', $data, TRUE);
		$this->js_inject .= $this->load->view('customer/valid', $data, TRUE);

		// $data['product_view'] = $this->load->view('customer/product', $data, TRUE);
		$data['update_view'] = $this->load->view('customer/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('customer/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('customer/delete', $data, TRUE);
		$data['show_view'] = $this->load->view('customer/show_this', $data, TRUE);
		$konten = $this->load->view('customer/v', $data, TRUE);
		$this->admin_view($konten);
	}

	function show($customer_id, $view='detail', $mode='echo')
	{
		// pre($customer_id);
		// pre($view);
		// pre($mode);

		$data = array();
		switch ($view) {
			case 'item_terpasang':
				$this->load->model('Model_bcn', 'bcn');
				$data = $this->customer->show($customer_id, $view);
			break;

			case 'pre_customer':
				$data = $this->customer->show($customer_id, $view);
			break;

			case 'pre_customer':
				// $this->load->model('Model_bcn', 'bcn');
				$data = $this->customer->show($customer_id, $view);
			break;

			default:
				$data = $this->customer->show($customer_id, $view);
			break;
		}
		if($mode=='echo'):
			echo $this->load->view('customer/show/'.$view, $data, TRUE);
		else:
			return $this->load->view('customer/show/'.$view, $data, TRUE);
		endif;
	}

	function new_customer_mode()
	{
		$arr = array();
		if($this->input->post('mode')=='existing'):
			$this->db->where('id', $this->input->post('existing_customer'));
			$usergroup_info = $this->db->get('customer_group')->row_array();
			if(!empty($usergroup_info)):
				foreach($usergroup_info as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
		endif;
		// pre($arr);
		echo json_encode($arr);
	}

	public function insert()
	{
		// ajax_only();
		$arr_msg = array();
		if($this->form_validation->run('customer_insert')):
			// cekpost();

			$this->customer->save_customer_sid('x');

			// $param['service_id'] = 'ini service dari param';
			// $param['customer_name'] = 'suip';
			// $insert = $this->customer->insert_customer_group();
			// if($insert['status']=='1'):
			// 	$param_service_id['group_id'] = $insert['last_id'];
			// 	$this->customer->insert_service_id($param_service_id);
				// $arr_msg['status'] = 'sukses';
				// $arr_msg['msg'] = $this->lang->line('customer_success_insert');
			// else:
			// 	$arr_msg['status'] = 'failed';
			// 	$arr_msg['msg'] = $this->lang->line('customer_fail_insert');
			// endif;
		else:
			$arr_msg['status'] = 'failed';
			$arr_msg['msg'] = $this->lang->line('customer_fail_insert');
		endif;

		$response = json_encode($arr_msg);
		echo $response;
	}

	public function update($id='')
	{
		valid_action('customer');
		if(!$this->form_validation->run('customer_update')):
			$detail = $this->customer->detail($id);
			$arr = array();
			$arr['action'] = base_url().'customer/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		else:
			$arr_msg = array();
			$this->customer->update_customer_group();
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('customer_success_update');
			echo json_encode($arr_msg);
		endif;
	}



	function data_info($detail)
	{
		$options = array();
		$options['component'] = 'component/table/table_data_info';
		$options['label_width'] = '150';
		$options['sparator_width'] = '10';
		$options['data_row'] = array();

		// $options['data_row'][$this->lang->line('customer_group_id')] = $detail['group_id'];
		$options['data_row'][$this->lang->line('customer_customer_id')] = $detail['customer_id'];
		$options['data_row'][$this->lang->line('customer_service_id')] = $detail['service_id'];
		$options['data_row'][$this->lang->line('customer_customer_name')] = $detail['customer_name'];
		$options['data_row'][$this->lang->line('customer_customer_address')] = $detail['customer_address'];
		$options['data_row'][$this->lang->line('customer_telephone_home')] = $detail['telephone_home'];
		$options['data_row'][$this->lang->line('customer_telephone_mobile')] = $detail['telephone_mobile'];
		$options['data_row'][$this->lang->line('customer_telephone_work')] = $detail['telephone_work'];
		$options['data_row'][$this->lang->line('customer_contact_person')] = $detail['contact_person'];
		$options['data_row'][$this->lang->line('customer_fax')] = $detail['fax'];
		$options['data_row'][$this->lang->line('customer_email')] = $detail['email'];
		$options['data_row'][$this->lang->line('customer_customer_type')] = $detail['mcustomer_type'];
		$options['data_row'][$this->lang->line('customer_status')] = $detail['status'];
		$options['data_row'][$this->lang->line('customer_note')] = $detail['note'];
		$options['data_row'][$this->lang->line('customer_id_user')] = $detail['author_name'];
		$options['data_row'][$this->lang->line('customer_id_am')] = $detail['am_name'];
		// $options['data_row'][$this->lang->line('customer_date_post')] = $detail['date_post'];
		$options['data_row'][$this->lang->line('customer_registration_date')] = $detail['registration_date'];
		// $options['data_row'][$this->lang->line('customer_root')] = $detail['root'];
		// $options['data_row'][$this->lang->line('customer_mrtg')] = $detail['mrtg'];
		// $options['data_row'][$this->lang->line('customer_ip_address')] = $detail['ip_address'];
		$options['data_row'][$this->lang->line('customer_contract_status')] = $detail['contract_status'];
		$options['data_row'][$this->lang->line('customer_contract')] = $detail['contract'];
		// $options['data_row'][$this->lang->line('customer_need_approval')] = $detail['need_approval'];
		// $options['data_row'][$this->lang->line('customer_need_approval_trial')] = $detail['need_approval_trial'];
		// $options['data_row'][$this->lang->line('customer_need_approval_install')] = $detail['need_approval_install'];
		$options['data_row'][$this->lang->line('customer_link_type')] = $detail['mlink_type'];
		$options['data_row'][$this->lang->line('customer_status_active')] = $detail['status_active'];
		// $options['data_row'][$this->lang->line('customer_sid')] = $detail['sid'];
		// $options['data_row'][$this->lang->line('customer_order')] = $detail['order'];
		// $options['data_row'][$this->lang->line('customer_group_order')] = $detail['group_order'];
		// $options['data_row'][$this->lang->line('customer_invoice_counter')] = $detail['invoice_counter'];
		// $options['data_row'][$this->lang->line('customer_password')] = $detail['password'];
		// $options['data_row'][$this->lang->line('customer_invoice_flag')] = $detail['invoice_flag'];
		// $options['data_row'][$this->lang->line('customer_invoice_group')] = $detail['invoice_group'];
		// $options['data_row'][$this->lang->line('customer_invoice_parent')] = $detail['invoice_parent'];
		// $options['data_row'][$this->lang->line('customer_invoice_name')] = $detail['invoice_name'];
		// $options['data_row'][$this->lang->line('customer_invoice_address')] = $detail['invoice_address'];
		// $options['data_row'][$this->lang->line('customer_invoice_attention')] = $detail['invoice_attention'];
		// $options['data_row'][$this->lang->line('customer_invoice_phone')] = $detail['invoice_phone'];
		// $options['data_row'][$this->lang->line('customer_tanggal_billing')] = $detail['tanggal_billing'];
		// $options['data_row'][$this->lang->line('customer_invoice_root')] = $detail['invoice_root'];
		// $options['data_row'][$this->lang->line('customer_invoice_no_attention')] = $detail['invoice_no_attention'];
		// $options['data_row'][$this->lang->line('customer_ppn')] = $detail['ppn'];
		// $options['data_row'][$this->lang->line('customer_ppn_mode')] = $detail['ppn_mode'];
		// $options['data_row'][$this->lang->line('customer_nmc')] = $detail['nmc'];
		// $options['data_row'][$this->lang->line('customer_free')] = $detail['free'];
		// $options['data_row'][$this->lang->line('customer_billing_month')] = $detail['billing_month'];
		// $options['data_row'][$this->lang->line('customer_billing_year')] = $detail['billing_year'];
		// $options['data_row'][$this->lang->line('customer_cabang')] = $detail['cabang'];

		return $this->ui->load_component($options);
	}

	function data()
	{
		// $this->output->enable_profiler(TRUE)
		// echo 's';
		echo $this->customer->data();
	}

	function data_report()
	{
		echo $this->customer->data('report');
	}

	function sid_info($arr_sid, $group_id)
	{
		if(isset($arr_sid[$group_id]['sid_count'])):
			return $arr_sid[$group_id]['sid_count'];
		else:
			return '';
		endif;
	}

	public function datav($customer_group_id)
	{
		$customer = $this->customer->datav($customer_group_id);
		// pre($this->db->last_query());
		// pre($customer);
		// exit;

		$arr = array();
		$arr['data'] = array();
		if(!empty($customer)):
			$urut = 0;
			foreach($customer as $row):
				$urut++;

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$customer_name = '<a onclick="show_this('.$row['id'].');" href="#">'.clean_string($row['customer_name'], 40).'</a>';

				if($row['status_active']=='0'):
					$status = '<span class="label label-danger">non active</span>';
				else:
					$status = '<span class="label label-success">active</span>';
				endif;

				$arr['data'][] = array(
						'x',
						$customer_name,
						clean_string($row['customer_address'], 40),
						clean_string($row['service_id'], 40),
						$status,
						$action
					);
			endforeach;
		endif;
		// pre($arr);

		$ret = json_encode($arr);
		echo $ret;
	}

	public function datarv($customer_group_id)
	{
		$customer = $this->customer->datav($customer_group_id);
		// pre($this->db->last_query());
		// pre($customer);
		// exit;

		$arr = array();
		$arr['data'] = array();
		if(!empty($customer)):
			$urut = 0;
			foreach($customer as $row):
				$urut++;

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="show_this(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-eye"></i> Detail</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				// $customer_name = '<a onclick="show_this('.$row['id'].');" href="#">'.clean_string($row['customer_name'], 40).'</a>';
				$customer_name = clean_string($row['customer_name'], 40);

				if($row['status_active']=='0'):
					$status = '<span class="label label-danger">non active</span>';
				else:
					$status = '<span class="label label-success">active</span>';
				endif;

				$arr['data'][] = array(
						'x',
						$customer_name,
						clean_string($row['customer_address'], 40),
						clean_string($row['service_id'], 40),
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
		$serv = $this->customer->get_Service_by_group($group_id);
		// pre($this->db->last_query());
		// pre($customer);
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
						$row['customer_id'],
						$row['service_id'],
						$row['customer_name'],
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
		$cek = $this->db->get('customer')->result_array();
		if(empty($cek)):
			echo 'true';
		else:
			echo 'false';
		endif;
	}

	function valid_email()
	{
		$this->db->where('email', $this->input->post('email'));
		$cek = $this->db->get('customer')->result_array();
		if(empty($cek)):
			echo 'true';
		else:
			echo 'false';
		endif;
	}

	function focus($customer_id)
	{
		$detail = $this->customer->detail_customer($customer_id);

		$arr = array();
		$arr['modal_title'] = $this->lang->line('customer_focus_title');
		$arr['modal_icon'] = $this->theme->icon('customer');
		$arr['modal_size'] = 'modal-full';

		//content focus
		$options = array();
	    $options['component'] = 'component/tab/tab_default';
	    $options['tab_id'] = 'tab1';
	    $options['tab_padding'] = 'no';
	    $options['max'] = '8';
	    $options['selected_tab'] = 'focus_data_customer';
	    $options['tabs'] = array();

		$options['tabs'][] = array(
                'label'         => $this->lang->line('customer_focus_tab_detail_customer'),
                'id'            => 'focus_data_customer',
                'content'       => $this->data_info($detail),
            );

		// $options['tabs'][] = array(
        //         'label'         => $this->lang->line('patient_focus_tab_product_service'),
        //         'id'            => 'product_service',
        //         'content'       => $this->info_layanan($detail),
        //     );
		// $options['tabs'][] = array(
        //         'label'         => $this->lang->line('patient_focus_tab_perangkat'),
        //         'id'            => 'perangkat',
        //         'content'       => $this->info_perangkat($detail),
        //     );
		//
		// $options['tabs'][] = array(
        //         'label'         => $this->lang->line('patient_focus_tab_mp'),
        //         'id'            => 'mp',
        //         'content'       => $this->info_mp($detail),
        //     );
		//
		// $options['tabs'][] = array(
        //         'label'         => $this->lang->line('patient_focus_tab_dok'),
        //         'id'            => 'dok',
        //         'content'       => $this->info_dokumen($detail),
        //     );


		$content = $this->ui->load_component($options);

		$arr['modal_content'] = $content;
		echo json_encode($arr);
	}

	function customer_update_global($id='')
	{
		$arr = array();
		if(!$this->form_validation->run('customer_update_global')):
			$detail = $this->customer->detail_customer($id);
			$data['detail'] = $detail;
			echo $this->load->view('customer/update/customer_update_global', $data, TRUE);
		else:
			$update_result = $this->crud->update('customer', array(), array('id'));
			// $arr['post'] = $_POST;
			// $arr['update_result'] = $update_result;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function customer_update_product($id='')
	{
		$arr = array();
		if(!$this->form_validation->run('customer_update_product')):
			$detail = $this->customer->detail_customer($id);
			$data['detail'] = $detail;
			$data['current_product'] = $this->customer->get_product_serialize($detail['id']);
			echo $this->load->view('customer/update/customer_update_product', $data, TRUE);
		else:
			$params = array();
			$result_update = $this->crud->update('customer', $params, array('id'));
			$result_sid = $this->customer->save_customer_sid($this->input->post('id'));
			// $arr['post'] = $_POST;
			// $arr['last_query'] = $this->db->last_query();
			// $arr['update_result'] = $update_result;
			// $res_sid = $this->customer->save_customer_sid($this->input->post('id'));
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function customer_update_invoice_marketing($id='')
	{
		$arr = array();
		if(!$this->form_validation->run('customer_update_product')):
			$detail = $this->customer->detail_customer($id);
			$data['detail'] = $detail;
			echo $this->load->view('customer/update/customer_update_invoice_marketing', $data, TRUE);
		else:
			$params = array();
			// $result_update = $this->crud->update('customer', $params, array('id'));
			// $arr['post'] = $_POST;
			// $arr['last_query'] = $this->db->last_query();
			// $arr['update_result'] = $update_result;
			// $res_sid = $this->customer->save_customer_sid($this->input->post('id'));
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function customer_update_teknis($id='')
	{
		$arr = array();
		if(!$this->form_validation->run('customer_update_teknis')):
			$detail = $this->customer->detail_customer($id);
			$data['detail'] = $detail;
			echo $this->load->view('customer/update/customer_update_teknis', $data, TRUE);
		else:
			$arr = array();
			$params = array();
			$result_update = $this->crud->update('customer', $params, array('id', 'sender'));
			$arr['post'] = $_POST;
			$arr['last_query'] = $this->db->last_query();
			// $arr['update_result'] = $update_result;
			// $res_sid = $this->customer->save_customer_sid($this->input->post('id'));
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function customer_update_item($mode='index')
	{
		switch ($mode) {
			case 'insert':

			break;

			case 'update':

			break;

			default:
				$this->load->view('customer/update/customer_update_item', '', FALSE);
			break;
		}
	}

	public function non_active()
	{

		$modul = $this->modul->detail('pelanggan_non_aktif');
		valid_action($modul['code']);

		$this->breadcrumb = array(
			'Home' => base_url(),
			'Customer'	=> '#',
		);

		$data = array();
		$data['modul'] = $modul;

		// $this->js_include .= $this->ui->js_include('jquery_ui');
		// $this->js_include .= $this->ui->js_include('bootstrap_multiselect');
		// $this->js_inject .= $this->load->view('customer/js_table_server', $data, TRUE);
		// $this->js_inject .= $this->load->view('customer/js', $data, TRUE);
		// $this->js_inject .= $this->load->view('customer/valid', $data, TRUE);
		// $this->js_inject .= $this->load->view('customer_product_picker/js', $data, TRUE);
		// $this->js_include .= $this->ui->js_include('mask_money');
		// $this->js_include .= $this->ui->js_include('wysiwyg');
		// $this->js_include .= $this->ui->js_include('datatables_key_table');
		//
		// $data['update_view'] = $this->load->view('customer/update', $data, TRUE);
		// $data['insert_view'] = $this->load->view('customer/insert', $data, TRUE);
		// $data['delete_view'] = $this->load->view('customer/delete', $data, TRUE);
		// $data['search_view'] = $this->load->view('customer/search', $data, TRUE);
		// $data['marketing_progress_view'] = $this->load->view('customer/marketing_progress', $data, TRUE);
		// $data['show_view'] = $this->load->view('customer/show_this', $data, TRUE);

		$konten = $this->load->view('customer/non_active', $data, TRUE);
		$this->admin_view($konten);
	}

	function customer_by_id($id,$type='json')
	{
		$arr = array();
		$data = $this->customer->detail($id);
		$arr['result'] = 'failed';
		if (count($data) > 0) {
			$arr['result'] = 'success';
			foreach ($data as $key => $value) {
				$arr[$key] = $value;
			}
		}
		if ($type=='json') {
			echo json_encode($arr);
		} else {
			return $arr;
		}
	}

	function get_marketing_progress()
	{
		$this->load->model('model_customer', 'm_customer');

		$customer_id = $this->input->post('customerId');
		$marketing_progress = $this->m_customer->get_marketing_progress($customer_id)->result();

		header("Content-type: application/json");
		echo json_encode($marketing_progress);
	}
}
