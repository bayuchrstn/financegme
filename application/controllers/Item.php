<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_item', 'item');
		$this->lang->load('item');
		$this->active_root_menu = $this->lang->line('item_alltitle');
		$this->browser_title = $this->lang->line('item_alltitle');
		$this->modul_name = $this->lang->line('item_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('item_alltitle') => '#');
		// $options = array();
		// $options['modul_code'] = 'item';
		// $this->frame->main_crud($options);
		$data = array();
		$data['select_brand'] = $this->item->arr_category_brand();

		$this->js_inject .= $this->load->view('item/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('item/js', $data, TRUE);
		$this->js_inject .= $this->load->view('item/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		
		$this->js_inject = '<script type="text/javascript">'.minify_js($this->js_inject).'</script>';

		$data['update_view'] = $this->load->view('item/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('item/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('item/delete', $data, TRUE);

		$konten = $this->load->view('item/index', $data, TRUE);
		$this->admin_view($konten);

	}

	public function get_category($id)
	{
		ajax_only();
		$data = $this->item->arr_category($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$options = array();
		$options['server_side_validation'] = 'item_insert';
		$options['table'] = 'item';
		$options['data'] = array(
				'item_name'	=> ($this->input->post('item_name')) ? htmlspecialchars($this->input->post('item_name')) : '',
				'code_name'		=> ($this->input->post('item_code')) ? htmlspecialchars($this->input->post('item_code')) : '',
				'category_id'			=> $this->input->post('item_category'),
				'brand'		=> $this->input->post('item_brand'),
				'jumlah'			=> '0',
				'input_date'		=> date('Y-m-d H:i:s')
			);
		$options['msg_success'] = $this->lang->line('item_success_insert');
		$options['msg_failed'] = $this->lang->line('item_failed_insert');
		// echo json_encode($options);
		$this->frame->insert($options);
	}

	public function update($id='')
	{
		valid_action('nama_barang');
		ajax_only();
		if(!$this->form_validation->run('item_update')):
			$detail = $this->item->detail($id);
			$arr = array();
			$arr['arr_category'] = $this->item->arr_category($detail['brand']);
			$arr['action'] = base_url().'item/update/'.$detail['id'];
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
					'item_name'	=> ($this->input->post('item_name')) ? htmlspecialchars($this->input->post('item_name')) : '',
					'code_name'		=> ($this->input->post('item_code')) ? htmlspecialchars($this->input->post('item_code')) : '',
					'category_id'			=> $this->input->post('item_category'),
					'brand'		=> $this->input->post('item_brand'),
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('item', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('item_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->item->detail($id);
		if($this->form_validation->run('item_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('item');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['item_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'item/delete/'.$detail['id'];
			$related = $this->related->item($detail['id']);
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
				'Nama item'		=> $detail['item_name'],
				'Kode'			=> $detail['code_name']
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data()
	{
		$product = $this->item->all();
		// param ini dikirim otomatis oleh Jquery datatables
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
			$data = $this->item->all($where_string, $length, $start);
			$total_filtered = count($this->item->all($where_string));
		} else {
			$data = $this->item->all('', $length, $start);
			$total_filtered = $recordsTotal;
		}

		$query_debug = $this->db->last_query();
		$recordsFiltered = $total_filtered;

		$arr = array();
		$arr['data'] = array();
		if(!empty($data)):
			$urut = $start ? $start : 0;
			foreach($data as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_item(\''.$row['id'].'\');" class="edit_button" ');
				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_item(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				// $arr['data'][] = array(
				// 		'x',
				// 		clean_string($row['item_name'], 40),
				// 		clean_string($row['category_name'], 40),
				// 		clean_string($row['brand_name'], 40),
				// 		$action
				// 	);
				$arr['data'][] = array(
					'id'	=> $urut,
					'item_name'	=> $row['item_name'],
					'category_name'	=> $row['category_name'],
					'brand_name' => $row['brand_name'],
					'action'	=> $action,
				);
			endforeach;
		endif;
		// pre($arr);
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $arr['data'],
	        "query_debug" 		=> $query_debug
	    );

		$ret = json_encode($response);
		echo $ret;
	}

}

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */