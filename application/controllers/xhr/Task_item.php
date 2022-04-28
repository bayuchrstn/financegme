<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_item extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('Model_task_item', 'task_item');
        $this->load->model('Model_supplier', 'supplier');
        $this->load->model('Model_request', 'request');
        $this->load->model('Model_bcn', 'bcn');
		$this->load->model('Model_item_transaction', 'item_transaction');
	}

	function cekj()
	{
		$anu = $this->task_item->get_data('task_pengadaan', '33349');
		$jumlah = count($anu);
		echo $jumlah;
	}

	// Params
	//1.nama table item
	//2.task id (jika belum ada dikasih angka nol 0 )
	//3.prefix
	//4.target div
	//5.parent modul
    function index($table, $task_id='', $prefix='', $target_div='', $parent_modul='', $mode='html')
    {
		$data = array();
		$data['table'] = $table;
		$data['task_id'] = $task_id;
		$data['prefix'] = $prefix;
		$data['target_div'] = $target_div;
		$data['parent_modul'] = $parent_modul;

		$data['current'] = $this->task_item->get_current($table, $task_id, $prefix, $target_div, $parent_modul);
		$data['cart'] = $this->task_item->get_cart($table, $task_id, $prefix, $target_div, $parent_modul);
		$data['column_data'] = $this->task_item->column_data($table, $parent_modul);

		switch ($mode) {
			case 'json':
				echo json_encode($data);
				break;
			case 'json_cart':
				$x = array();
				$cart = $this->cart->contents();
				// echo '<pre>';
				$task_id = '123';
				$i=0;
				foreach ($cart as $row) {
					if ($row['options']['mode']=='barang' || $row['options']['mode']=='custom') {
						$x[$i] = array(
							'task_id'	=> $task_id,
							'item_id'	=> $row['id'],
							'supplier'	=> '',
							'qty'		=> $row['qty'],
							'price'		=> $row['price'],
							'mode'	=> $row['options']['mode']
						);
						$x[$i]['note'] = $row['options']['mode']=='custom' ? $row['name'] : '';
						$i++;
					}
				}
				print_r($x);
				// echo '</pre>';
				break;			
			default:
				if($this->task_item->is_lock($task_id)):
					$this->load->view('task_item/locked', $data, FALSE);
				else:
		        	$this->load->view('task_item/index', $data, FALSE);
				endif;
				break;
		}

    }

	function insert($table='', $prefix='', $task_id='', $target_div='', $parent_modul='')
	{
		if(!$this->form_validation->run('sender')):
			$properties = $this->task_item->properties($table, $prefix, $task_id, '0', $target_div, $parent_modul);
			// pre($properties);
			$arr = array();
			$data = array();
			// $detail = $this->customer->detail_customer($id);
			$data['table'] = $table;
			$data['prefix'] = $prefix;
			$data['task_id'] = $task_id;
			$data['target_div'] = $target_div;
			$data['parent_modul'] = $parent_modul;

			// echo 'insert form';
			$arr['konten'] = $this->load->view('task_item/insert/'.$parent_modul, $data, TRUE);
			$arr['modal_title'] = $properties['modal_title'];
			$arr['modal_form_action'] = $properties['action_form'];
			$arr['parent_modul'] = $parent_modul;

			// pre($arr);

			echo json_encode($arr);
		else:
			$arr = array();

			$parent_modul = $this->input->post('parent_modul');
			$arr['main_action'] = $this->task_item->$parent_modul('insert');

			//penting
			$arr['task_id'] = $this->input->post('task_id');
			$arr['table'] = $this->input->post('table');
			$arr['prefix'] = $this->input->post('prefix');
			$arr['target_div'] = $this->input->post('target_div');
			$arr['parent_modul'] = $this->input->post('parent_modul');
			$arr['data_post'] = $_POST;
			//penting

			// $arr['data_cart'] = $data_cart;
			// $arr['hook'] = $hook;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan (1)';
			echo json_encode($arr);
		endif;
	}

	function update($table='', $prefix='', $task_id='', $id='', $target_div='', $parent_modul='')
	{
		if(!$this->form_validation->run('sender')):
			$properties = $this->task_item->properties($table, $prefix, $task_id, $id, $target_div, $parent_modul);
			$detail = $this->task_item->detail($table, $prefix, $task_id, $id, $parent_modul);
			// pre($properties);
			// pre($detail);
			// exit;
			$arr = array();
			$data = array();
			// $detail = $this->customer->detail_customer($id);
			$data['table'] = $table;
			$data['prefix'] = $prefix;
			$data['task_id'] = $task_id;
			$data['id'] = $id;
			$data['target_div'] = $target_div;
			$data['parent_modul'] = $parent_modul;
			$data['detail'] = $detail;

			// echo 'insert form';
			$arr['konten'] = $this->load->view('task_item/update/'.$parent_modul, $data, TRUE);
			$arr['modal_title'] = $properties['modal_title_update'];
			$arr['modal_form_action'] = $properties['action_form_update'];
			$arr['properties'] = $properties;

			echo json_encode($arr);
		else:
			$arr = array();

			$parent_modul = $this->input->post('parent_modul');
			$arr['main_action'] = $this->task_item->$parent_modul('update');

			//penting
			$arr['task_id'] = $this->input->post('task_id');
			$arr['table'] = $this->input->post('table');
			$arr['prefix'] = $this->input->post('prefix');
			$arr['target_div'] = $this->input->post('target_div');
			$arr['parent_modul'] = $this->input->post('parent_modul');
			$arr['id'] = $this->input->post('id');
			//penting

			$arr['post'] = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan (3)';
			echo json_encode($arr);
		endif;
	}

	function update_cart($table='', $prefix='', $task_id='', $id='', $target_div='', $parent_modul='')
	{
		if(!$this->form_validation->run('sender')):
			$properties = $this->task_item->properties($table, $prefix, $task_id, $id, $target_div, $parent_modul);
			// pre($properties);
			$cart = $this->cart->contents();
			$detail = $cart[$id];
			$arr = array();
			$data = array();
			// $detail = $this->customer->detail_customer($id);
			$data['table'] = $table;
			$data['prefix'] = $prefix;
			$data['task_id'] = $task_id;
			$data['target_div'] = $target_div;
			$data['parent_modul'] = $parent_modul;
			$data['id'] = $id;
			$data['detail'] = $detail;

			// echo 'insert form';
			$arr['konten'] = $this->load->view('task_item/update_cart/'.$parent_modul, $data, TRUE);
			$arr['modal_title'] = $properties['modal_title_update'];
			$arr['modal_form_action'] = $properties['action_form_update_cart'];

			$arr['properties'] = $properties;
			// $arr['id'] = $id;
			// $arr['detail'] = $detail;

			echo json_encode($arr);
		else:
			$arr = array();

			$parent_modul = $this->input->post('parent_modul');
			$arr['main_action'] = $this->task_item->$parent_modul('update_cart');

			//penting
			$arr['task_id'] = $this->input->post('task_id');
			$arr['table'] = $this->input->post('table');
			$arr['prefix'] = $this->input->post('prefix');
			$arr['target_div'] = $this->input->post('target_div');
			$arr['parent_modul'] = $this->input->post('parent_modul');
			//penting

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan (2)';
			echo json_encode($arr);
		endif;
	}

	function delete($table='', $prefix='', $task_id='', $id='', $target_div='', $parent_modul='')
	{
		$arr = array();
		$arr['table'] = $table;
		$arr['prefix'] = $prefix;
		$arr['task_id'] = $task_id;
		$arr['target_div'] = $target_div;
		$arr['parent_modul'] = $parent_modul;
		$arr['id'] = $id;
		$segment_array = $this->uri->segment_array();
		$arr['segment_array'] = $segment_array;



		switch ($parent_modul) {
			case 'item_in':
				$deleted = $this->db->query("SELECT * FROM {PRE}task_item_in WHERE id='".$id."' ")->row_array();
				$arr['deleted'] = $deleted;
				//////////////////////
				$this->db->where('id', $id);
				$this->db->delete($table);

				///////////////////////////
				$this->item_transaction->cancel_request_in($deleted['transaction_id'], $deleted['item_detail_id']);
			break;

			case 'item_replace_out':
			case 'item_out':
				$deleted = $this->db->query("SELECT * FROM {PRE}task_item_in WHERE id='".$id."' ")->row_array();
				$arr['deleted'] = $deleted;
				//////////////////////
				$this->db->where('item_id', $id);
				$this->db->delete($table);

				///////////////////////////
				// $this->item_transaction->cancel_request_in($deleted['transaction_id'], $deleted['item_detail_id']);
			break;

			default:
				$this->db->where('id', $id);
				$this->db->delete($table);
			break;
		}
		$arr['last_query'] = $this->db->last_query();

		echo json_encode($arr);
	}

	function delete_cart($table='', $prefix='', $task_id='', $rowid='', $target_div='', $parent_modul='')
	{
		$arr = array();
		$arr['table'] = $table;
		$arr['prefix'] = $prefix;
		$arr['task_id'] = $task_id;
		$arr['target_div'] = $target_div;
		$arr['parent_modul'] = $parent_modul;
		$arr['rowid'] = $rowid;

		$data['rowid'] = $rowid;
		$data['qty'] = '0';
		$this->cart->update($data);

		echo json_encode($arr);
	}



}
