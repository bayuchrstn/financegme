<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_detail extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_item', 'item');
		$this->load->model('model_item_detail', 'item_detail');
		$this->load->model('model_item_trace', 'item_trace');
		$this->lang->load('item');
		$this->lang->load('item_detail');
		$this->active_root_menu = $this->lang->line('item_detail_alltitle');
		$this->browser_title = $this->lang->line('item_detail_alltitle');
		$this->modul_name = $this->lang->line('item_detail_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
		// $this->js_include .= $this->ui->js_include('chosen');
		// $this->css_include .= $this->ui->load_css('chosen');
	}

	public function index($id='')
	{
		if ($id=='' || $id=='0') {
			$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('item_alltitle') => '#');
		} else {
			$detail_item = $this->item_detail->detail_item($id);
			$this->breadcrumb = array(
				'Home' => base_url(),
				$this->lang->line('item_alltitle') => base_url().'item_detail',
				$detail_item['item_name'] => '#'
				);
		}

		$company = array(
			'msd' => 'Media Sarana Data',
			'msa' => 'Media Sarana Akses',
		);

		$status_barang = array(
			'available' => 'Tersedia',
			'damage' => 'Rusak',
			'garansi' => 'Garansi',
		);

		if (session_scope_regional()=='01')
			$company['solo']  = 'GMedia Solo';

		// $options = array();
		// $options['modul_code'] = 'item';
		// $this->frame->main_crud($options);
		$arr_klasifikasi = array();
		$klasifikasi_item = $this->master->master_by_category('klasifikasi_item');
		if (!empty($klasifikasi_item)) {
			foreach ($klasifikasi_item as $row) {
				$arr_klasifikasi[$row['code']] = $row['name'];
			}
		}

		$data = array();
		$data['item'] = $id;
		$data['select_company'] = $company;
		$data['select_status'] = $status_barang;
		$data['select_klasifikasi'] = $arr_klasifikasi;
		$data['select_supplier'] = $this->item_detail->arr_supplier();
		$data['select_brand'] = $this->item_detail->arr_category_brand();

		$this->js_inject .= $this->load->view('item_detail/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('item_detail/js', $data, TRUE);
		$this->js_inject .= $this->load->view('item_detail/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');

		$data['update_view'] = $this->load->view('item_detail/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('item_detail/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('item_detail/delete', $data, TRUE);

		$konten = $this->load->view('item_detail/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function get_category($id)
	{
		ajax_only();
		$brand = $this->item_detail->get_category_brand_by_id($id);
		$brand_code = $brand['code_name'];

		$category = $this->item_detail->get_category_only($id);
		$category_id = $category[0]['id'];
		$category_code = $category[0]['code_name'];

		$code = $brand_code.'-'.$category_code.'-'.date('YmdHis').$this->session->userdata('userid');

		$data['category'] = $this->item_detail->arr_category_onselect($id);
		$data['item'] = $this->item_detail->arr_item_category($category_id);
		$data['code'] = $code;
		echo json_encode($data);
	}

	public function get_item_category($id)
	{
		$category = $this->item_detail->get_category_brand_by_id($id);
		$category_code = $category['code_name'];

		$brand = $this->item_detail->get_category_brand_by_id($category['up']);
		$brand_code = $brand['code_name'];

		$code = $brand_code.'-'.$category_code.'-'.date('YmdHis').$this->session->userdata('userid');

		$data['code'] = $code;
		$data['item'] = $this->item_detail->arr_item_category($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$price = $this->input->post('item_price')!='' ? $this->input->post('item_price') : '0';
		$price = preg_replace("/[^0-9]/", "", $price);

		$options = array();
		$options['server_side_validation'] = 'item_detail_insert';
		$options['table'] = 'item_detail';
		$options['data'] = array(
				'item_id'	=> $this->input->post('item_item'),
				'nomor_barang'		=> $this->input->post('item_no_item'),
				'barcode'			=> $this->input->post('item_barcode'),
				'mac_address'		=> $this->input->post('item_mac'),
				'price'			=> $price,
				'datepost'		=> date('Y-m-d H:i:s'),
				'warranty'		=> $this->input->post('item_warranty'),
				'buy_date'		=> $this->input->post('item_date_buy'),
				'user'			=> $this->session->userdata('userid'),
				'item_status'	=> 'available',
				'note'			=> $this->input->post('item_note'),
				'supplier_id'	=> $this->input->post('item_supplier'),
				'brand'			=> $this->input->post('item_brand'),
				'invoice_number'=> $this->input->post('item_invoice'),
				'flag_company'	=> $this->input->post('item_company'),
				'klasifikasi'	=> $this->input->post('item_klasifikasi'),
				'regional'		=> session_scope_regional(),
				'area'			=> session_scope_area(),
			);
		$options['msg_success'] = $this->lang->line('item_success_insert');
		$options['msg_failed'] = $this->lang->line('item_failed_insert');
		// echo json_encode($options);

		//update jml barang on insert
		$this->item_detail->update_jml_barang($this->input->post('item_item'));

		$this->frame->insert($options);
	}

	public function update($id='')
	{
		// valid_action('item');
		ajax_only();
		if(!$this->form_validation->run('item_detail_update')):
			$detail = $this->item_detail->detail($id);
			$id_item = $detail['id_item'];
			$this->item_detail->update_jml_barang($id_item,'0');
			$arr = array();
			$arr['arr_category'] = $this->item_detail->arr_category_onselect($detail['brand_id']);
			$arr['arr_item'] = $this->item_detail->arr_item_category($detail['category_id']);
			$arr['action'] = base_url().'item_detail/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$val = ($field=='price') ? currency($val) : $val;
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			// cekpost();
			$price = $this->input->post('item_price_update')!='' ? $this->input->post('item_price_update') : '0';
			$price = preg_replace("/[^0-9]/", "", $price);

			$arr_msg = array();
			$data = array(
					'barcode'		=> $this->input->post('item_barcode_update'),
					'mac_address'	=> $this->input->post('item_mac_update'),
					'price'			=> $price,
					'warranty'		=> $this->input->post('item_warranty_update'),
					'buy_date'		=> $this->input->post('item_date_buy_update'),
					'note'			=> $this->input->post('item_note_update'),
					'supplier_id'	=> $this->input->post('item_supplier_update'),
					'invoice_number'=> $this->input->post('item_invoice_update'),
					'flag_company'	=> $this->input->post('item_company_update'),
					'klasifikasi'	=> $this->input->post('item_klasifikasi_update'),
				);

			if ($this->input->post('item_status_update'))
				$data['item_status'] = $this->input->post('item_status_update');

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('item_detail', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('item_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->item_detail->detail($id);
		if($this->form_validation->run('item_detail_delete')):
			$id_item = $detail['id_item'];
			$this->item_detail->update_jml_barang($id_item,'-1');
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('item_detail');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['brand_name'].' '.$detail['category_name'].' '.$detail['item_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'item_detail/delete/'.$detail['id'];
			$related = $this->related->item_detail($detail['id']);
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
				'Nama item'		=> $detail['brand_name'].' '.$detail['category_name'].' '.$detail['item_name'],
				'Nomor Barang'	=> $detail['nomor_barang'],
				'MAC Address'	=> $detail['mac_address'],
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($id='0',$status='available')
	{
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');

		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $post_order[0]['column'];
	    $orderBy = $post_columns[$orderByColumnIndex]['data'];
	    $orderType = $post_order[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables
		if ($id=='' || $id=='0') {
			$product = $this->item->all();

			$recordsTotal = count($product);
			if ($post_search['value']) {
				$where_string = "( ";
				$where_string_x = '';
				for($i=0; $i<count($this->input->post('columns')); $i++){
					$column = $post_columns[$i]['name'];
					$searchable = $post_columns[$i]['searchable'];
					if($searchable=='true'):
						// $this->db->or_like($column, $post_search['value']);
						$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
					endif;
				}
				$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
				$where_string .= $where_string_x;
				$where_string .= " )";
				// $this->db->where( $where_string );
				$product = $this->item->all($where_string, $length, $start);
				$total_filtered = count($this->item->all($where_string));
			} else {
				$product = $this->item->all('', $length, $start);
				$total_filtered = $recordsTotal;
			}

			$query_debug = $this->db->last_query();
			$recordsFiltered = $total_filtered;

		} else {
			$product = $this->item_detail->all($id,$status);
			// var_dump($product);
			// exit;
		}


		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = $start ? $start : 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_item_detail(\''.$row['id'].'\');" class="edit_button" ');

				if ($status == 'available') {
					$hidden_form['damage'] = array(
						'label' => 'Damage',
						'url' => 'javascript:void(0);',
						'icon' => 'icon-pencil7',
						'more' => 'onclick="changeStatusItem(\''.$row['id'].'\', \''.$status.'\', \'damage\');" class="edit_button"'
					);

					$hidden_form['garansi'] = array(
						'label' => 'Garansi',
						'url' => 'javascript:void(0);',
						'icon' => 'icon-pencil7',
						'more' => 'onclick="changeStatusItem(\''.$row['id'].'\', \''.$status.'\', \'garansi\');" class="edit_button"'
					);
				}

				if ($status=='damage' || $status=='garansi' || $status=='approved_out') {
					$hidden_form['available'] = array(
						'label' => 'Available',
						'url' => 'javascript:void(0);',
						'icon' => 'icon-pencil7',
						'more' => 'onclick="changeStatusItem(\''.$row['id'].'\', \''.$status.'\', \'available\');" class="edit_button"'
					);
				}

				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_item_detail(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

		        if ($id=='' || $id=='0') {
		        	$total_item = $this->item->count_item_status($row['id']);
		        	$total_item_available = $this->item->count_item_status($row['id'],'available');

		        	$name = '<a href="'.base_url().'item_detail/index/'.$row['id'].'">'.clean_string($row['item_name'], 40).'</a>';
		        	$action = '<a title="view" href="'.base_url().'item_detail/index/'.$row['id'].'"><i class="glyphicon glyphicon-search"></i></a>';

		        	$arr['data'][] = array(
						'id'	=> $urut,
						'item_name'	=> $name,
						'category_name'	=> $row['category_name'],
						'brand_name'	=> $row['brand_name'],
						// clean_string($row['category_name'], 40),
						// clean_string($row['brand_name'], 40),
						'total_item_available'	=> $total_item_available,
						'total_item'	=> $total_item,
						'action'	=> $action
					);
					$arr['draw'] = intval($draw);
					$arr['recordsTotal'] = $recordsTotal;
					$arr['recordsFiltered'] = $recordsFiltered;
					$arr['query_debug'] = $query_debug;
		        } else {
		        	$name = clean_string($row['nomor_barang']);
		        	$lokasi = $this->item_trace->get_item_terpasang_lokasi($row['id']);
		        	$arr['data'][] = array(
						'x',
						$name,
						clean_string($row['mac_address'], 40),
						clean_string($row['barcode'], 40),
						currency($row['price']),
						clean_string($row['buy_date'], 40),
						// clean_string($row['warranty'], 40),
						$status=='install' ? 
						$lokasi['location_name'] : clean_string($row['warranty'], 40),
						clean_string($row['category_name'], 40),
						clean_string($row['brand_name'], 40),
						$action
					);
		        }
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

	public function mac_check_edit()
	{
		$arr = array('status' => 'failed');
		if($this->input->post('mac_address') !='')
		{
			$this->db->where('mac_address', $this->input->post('mac_address'));
			$this->db->where('id !=', $this->input->post('id'));
			$qry = $this->db->get('item_detail');
			$dt = $qry->row_array();

			if(!empty($dt)){
				// $this->form_validation->set_message('mac_check_edit', 'mac address ini sudah ada dalam database');
				// return FALSE;
				$arr = array(
					'status' => 'failed',
					'message'	=> 'mac address ini sudah ada dalam database'
				);
			} else {
				$check_mac = preg_match('/^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$/',  $this->input->post('mac_address'));
			  	if($check_mac){
			  		// return TRUE;
			  		$arr = array(
			  			'status' => 'success'
			  		);
			  	} else {
			  		// $this->form_validation->set_message('mac_check_edit', 'Format penulisan Mac Address Salah');
			  		// return FALSE;
			  		$arr = array(
						'status' => 'failed',
						'message'	=> 'Format penulisan Mac Address Salah'
					);
			  	}
			}
		} else {
			// return TRUE;
			$arr = array(
	  			'status' => 'success'
	  		);
		}
		echo json_encode($arr);
	}

}

/* End of file Item_detail.php */
/* Location: ./application/controllers/Item_detail.php */
