<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_transaction extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Model_item_transaction', 'item_transaction');
	}

	function out_detail($id)
	{
		$this->load->model('Model_bcn', 'bcn');
		$detail = $this->item_transaction->item_out_detail($id);
		// pre($detail);
		$options = array();
		$options['component'] = 'component/table/table_data_info';
		$options['label_width'] = '150';
		$options['sparator_width'] = '10';
		$options['data_row'] = array();
		$options['data_row']['Nama Barang']						= $this->bcn->item_info($detail['item_id'], 'default');
		$options['data_row']['User Request']					= $detail['author_name'];
		$options['data_row']['Tanggal Request']					= format_date($detail['date_post']);
		$options['data_row']['Status Kepemilikan']				= $detail['kepemilikan_name'];

		if($detail['approved_by'] !=''):
			$options['data_row']['User Approve']					= $detail['user_approval_name'];
			$options['data_row']['Tanggal Approve']					= format_date($detail['approved_date']);
			$options['data_row']['Item Barang']						= format_date($detail['approved_date']);
		endif;
		echo $this->ui->load_component($options);
	}

	function out_edit($id)
	{
		$data['detail'] = $this->item_transaction->item_out_detail($id);
		echo $this->load->view('item_transaction/out_edit', $data, TRUE);
	}

}
