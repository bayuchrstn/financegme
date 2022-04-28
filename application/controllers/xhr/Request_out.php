<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_out extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('request/Model_request_out', 'request_out');
        $this->load->model('Model_bcn', 'bcn');
	}

    function index()
    {
        echo 'Request_in';
    }

	function cart($prefix='')
	{
		$this->load->model('Model_bcn', 'bcn');
		$data = array();
		$data['prefix'] = $prefix;
		echo $this->load->view('request/request_out/cart/table', $data, TRUE);
	}

    function current($task_id)
    {
        $data = array();
        $data['task_id'] = $task_id;
        $data['data_out'] = $this->request_out->current('out', $task_id);
        echo $this->load->view('request/request_out/current/table', $data, TRUE);
    }

	function cart_out($prefix='')
    {
        $arr = array();
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['prefix'] = $prefix;
			$data['prefix_mode'] = $prefix;
			echo $this->load->view('request/request_out/cart/form_out', $data, TRUE);
		else:
			$arr['post']  = $_POST;

			// ----------------------CART-------------------------------
			$data = array(
				'id'      => $this->input->post('item_name'),
				'qty'     => paranoid($this->input->post('jumlah')),
				'price'   => '0',
				'name'    => $this->input->post('item_name'),
			);

			if($this->input->post('options')):
				foreach($this->input->post('options') as $key=>$val):
					$data['options'][$key] = $val;
				endforeach;
				$data['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
				$data['options']['note'] = $this->input->post('note');
			endif;
			$this->cart->product_name_rules = '[:print:]';
			$cart_result = $this->cart->insert($data);
			// ----------------------CART-------------------------------

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			$arr['prefix_mode'] = $prefix;

			echo json_encode($arr);
		endif;
    }

    function cart_in($location='', $location_id='', $prefix='')
    {
        $arr = array();
		if(!$this->form_validation->run('sender')):
			$this->load->model('Model_location', 'location');
			$this->load->model('Model_item_transaction', 'item_transaction');
			// pre($location);
			// pre($location_id);
			// pre($prefix);
			$data = array();
			$data['location_name'] = $this->location->location_id_info($location, $location_id);
			$data['location'] = $location;
			$data['location_id'] = $location_id;
            $data['prefix_mode'] = $prefix;
			$data['prefix'] = $prefix;
			// $data['barang_terpasang'] = $this->item_transaction->item_terpasang($location, $location_id);
			echo $this->load->view('request/request_in/cart/form_in', $data, TRUE);
		else:
			$arr['post']  = $_POST;

			$pitem_detail = $this->input->post('item_detail');
			$split = explode('|', $pitem_detail);

			// ----------------------CART-------------------------------
			$data = array(
				'id'      => $split[0],
				'qty'     => '1',
				'price'   => '0',
				'name'    => $split[0],
			);

			if($this->input->post('options')):
				foreach($this->input->post('options') as $key=>$val):
					$data['options'][$key] = $val;
				endforeach;
				$data['options']['condition'] = $this->input->post('condition');
				$data['options']['note'] = $this->input->post('note');
				$data['options']['item'] = $this->input->post('item');
				$data['options']['transaction_id'] =$split[1];
			endif;
			$this->cart->product_name_rules = '[:print:]';
			$cart_result = $this->cart->insert($data);
			// ----------------------CART-------------------------------

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
            $arr['prefix_mode'] = $prefix;
			echo json_encode($arr);
		endif;
    }

	function cart_out_update($rowid='', $prefix='')
	{
        if(!$this->form_validation->run('sender')):
    		$data = array();

    		$data['carts'] = $this->cart->contents();
    		$data['rowid'] = $rowid;
    		$data['prefix_mode'] = $prefix;

            $this->load->model('Model_request', 'request');
            $data['cart_detail'] = $data['carts'][$rowid];
            $this->db->where('id', $data['cart_detail']['id']);
            $data['item_detail'] = $this->db->get('item')->row_array();
            $data['parent_task_detail'] = $this->request->detail($data['cart_detail']['options']['task_parent']);
            echo $this->load->view('request/request_out/cart/form_edit_out', $data, TRUE);
        else:
            $arr = array();
            // ----------------------CART-------------------------------
    		$data = array(
    			'qty'     => paranoid($this->input->post('jumlah')),
    		);

    		if($this->input->post('options')):
    			foreach($this->input->post('options') as $key=>$val):
    				$data['options'][$key] = $val;
    			endforeach;
    			$data['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
    			$data['options']['note'] = $this->input->post('note');
    		endif;
    		$data['rowid'] = $this->input->post('rowid');
    		// pre($data);
    		$this->cart->product_name_rules = '[:print:]';
    		$this->cart->update($data);
    		// ----------------------CART-------------------------------
            $arr['prefix'] = $prefix;
            echo json_encode($arr);
        endif;
	}

	function current_update($mode, $id)
    {
        if($mode=='in'):
            $form = 'form_edit_in';
            $table = 'task_item_in';

            $data_db = array(
                'codition'              => $this->input->post('condition'),
                'note'                  => $this->input->post('note'),
            );

        else:
            $form = 'form_edit_out';
            $table = 'task_item_out';

            $data_db = array(
                    'owner_status'      => $this->input->post('status_kepemilikan'),
                    'note'              => $this->input->post('note'),
                );
        endif;

        $this->db->where('id', $id);
        $detail = $this->db->get($table)->row_array();

        if(!$this->form_validation->run('sender')):
            $data = array();
            $data['detail'] = $detail;
			echo $this->load->view('request/request_replace/current/'.$form, $data, TRUE);
		else:
            $arr = array();
            $arr['post'] = $_POST;
            $arr['detail'] = $detail;

            $this->db->where('id', $this->input->post('id'));
            $this->db->update($table, $data_db);
            echo json_encode($arr);
        endif;
    }

	function current_delete($mode, $id)
    {
        if($mode=='in'):
            $table = 'task_item_in';
        else:
            $table = 'task_item_out';
        endif;

        $arr = array();
        $this->db->where('id', $id);
        $detail = $this->db->get($table)->row_array();

        if(!empty($detail)):
            $arr['detail'] = $detail;
            $this->db->where('id', $id);
            $this->db->delete($table);
        endif;
        echo json_encode($arr);
    }
}
