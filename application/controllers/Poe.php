<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poe extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		// $this->load->model('model_customer', 'customer');
		// $this->load->model('model_cli', 'cli');
		// $this->lang->load('customer');
	}

	function index()
	{
		// cekpost();
		$filter = array();
		if(!empty($_POST)):
			foreach($_POST as $post=>$val):
				if($post !='filtered_page'):
					$filter[$post] = $val;
				endif;
			endforeach;
		endif;
		// pre($filter);
		// exit;
		$filter = filter_serialthis($filter);
		// echo $filter;
		if( $this->input->post('filtered_page') ){
			redirect( $this->input->post('filtered_page').$filter);
		}
	}

	function invoice()
	{
		$filter = array();
		$filter['bulan'] = $this->input->post('bulan_switcher');
		$filter['tahun'] = $this->input->post('tahun_switcher');
		$filter = filter_serialthis($filter);
		redirect(base_url().'invoice/'.$this->input->post('status_switcher').'/'.$filter);
	}
}
