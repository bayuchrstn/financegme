<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_trace extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_customer','customer');
		$this->load->model('model_marketing_fee','marketing_fee');
		$this->load->model('model_item_trace','item_trace');
		$this->load->model('model_item_detail','item_detail');
		$this->lang->load('customer');
		$this->lang->load('item_detail');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index()
	{
		$data = array();

		$data['tabs'] = $this->item_trace->tabs();

		$this->js_inject .= $this->load->view('item_trace/js', $data, TRUE);
		$this->js_inject .= $this->load->view('item_trace/js_table', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');

		$data['detail_view'] = $this->load->view('item_trace/detail', $data, TRUE);

		$konten = $this->load->view('item_trace/index', $data, TRUE);
		$this->admin_view($konten);
	}

	function data($status='')
	{
		$data = array();
		$arr = array();
		$draw = $this->input->post('draw') ? $this->input->post('draw') : 0;
		$search = $this->input->post('search')['value'] ? $this->input->post('search')['value'] : '';
		$limit = $this->input->post('length') ? $this->input->post('length') : 10;
		$offset = $this->input->post('start') ? $this->input->post('start') : 0;

		if ($status=='garansi') {
			$barang_garansi = $this->item_trace->get_item_garansi($limit, $offset,$search);
			$arr['data'] = $barang_garansi['data'];
			$arr['recordsFiltered'] = $barang_garansi['recordsFiltered'];
			$arr['recordsTotal'] = $barang_garansi['recordsTotal'];
		} elseif ($status=='available') {
			$arr = $this->item_trace->barang_available();
		} elseif ($status=='approved_out') {
			$barang_out = $this->item_trace->get_item_approved_out($limit, $offset,$search);
			$arr['data'] = $barang_out['data'];
			$arr['recordsFiltered'] = $barang_out['recordsFiltered'];
			$arr['recordsTotal'] = $barang_out['recordsTotal'];
		} else {
			// barang customer
			$barang_customer = $this->item_trace->barang_customer($status, $search);

			$i = 0;
			$arr['data'] = array();
			for ($j = $offset; $j < ($offset+$limit); $j++) {
				if (isset($barang_customer['data'][$j])) :
					$arr['data'][$i]['urut'] = $offset+$i+1;
					foreach ($barang_customer['data'][$j] as $key => $value) {
						$arr['data'][$i][$key] = $value;
					}
					$i++;
				endif;
			}
			$arr['recordsTotal'] = $barang_customer['recordsTotal'];
			$arr['recordsFiltered'] = $barang_customer['recordsFiltered'];

			if (($offset+$limit) > $arr['recordsFiltered']) {
				// barang bts
				$barang_bts = $this->item_trace->barang_bts($status, $search);

				$start_index = ($offset+$limit) - $arr['recordsFiltered'] - $limit;
				$start_index = $start_index < 0 ? 0 : $start_index;
				$new_limit = ($offset+$limit) - $arr['recordsFiltered'];
				$new_limit = $new_limit < $limit ? $new_limit : $limit;
				for ($k = 0; $k < $new_limit; $k++) {
					if (isset($barang_bts['data'][$start_index+$k])) {
						$arr['data'][$i]['urut'] = $offset+$i+1;
						foreach ($barang_bts['data'][$start_index+$k] as $key => $value) {
							$arr['data'][$i][$key] = $value;
						}
						$i++;
					}
				}
				$arr['recordsTotal'] += $barang_bts['recordsTotal'];
				$arr['recordsFiltered'] += $barang_bts['recordsFiltered'];
			}


			if (($offset+$limit) > $arr['recordsFiltered']) {
				// barang master
				$barang_master = $this->item_trace->barang_master($status, $search);

				$start_index = ($offset+$limit) - $arr['recordsFiltered'] - $limit;
				$start_index = $start_index < 0 ? 0 : $start_index;
				$new_limit = ($offset+$limit) - $arr['recordsFiltered'];
				$new_limit = $new_limit < $limit ? $new_limit : $limit;
				for ($k = 0; $k < $new_limit; $k++) {
					if (isset($barang_master['data'][$start_index+$k])) {
						$arr['data'][$i]['urut'] = $offset+$i+1;
						foreach ($barang_master['data'][$start_index+$k] as $key => $value) {
							$arr['data'][$i][$key] = $value;
						}
						$i++;
					}
				}
				$arr['recordsTotal'] += $barang_master['recordsTotal'];
				$arr['recordsFiltered'] += $barang_master['recordsFiltered'];
			}
		}

		$arr['draw'] = $draw;

		echo json_encode($arr);
	}

	function detail($id_transaction,$status='')
	{
		$data = array();
		if ($status=='garansi' || $status=='available' || $status=='approved_out') {
			$detail = $this->item_detail->detail($id_transaction);
		} else {
			$detail = $this->item_trace->detail($id_transaction);
		}
		foreach ($detail as $key => $value) {
			$data[$key] = is_null($value) ? '' : $value;
		}
		$id_item_detail = $status=='garansi' || $status=='available' || $status=='approved_out' ? $data['id'] : $data['id_item_detail'];
		$data['item_terpasang'] = $this->item_trace->get_item_terpasang_lokasi($id_item_detail);
		echo json_encode($data);
	}

}

/* End of file Item_trace.php */
/* Location: ./application/controllers/Item_trace.php */