<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends MY_Controller {

	public function __construct()
    {
		parent::__construct();

		check_login();
		$this->load->model('model_statistics', 'statistics');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($what='', $about='', $filter='')
	{
		if($what==''){
			show_404(); exit;
		}

		if($about==''){
			redirect(base_url().'statistics/index/'.$what.'/default');
		}

		$data = array();
		$data['what'] = $what;
		$data['about'] = $about;
		$data['filter'] = $filter;
		$arr_filter = un_filter_serialthis($filter);
		$data['arr_filter'] = $arr_filter;
		$ui = $this->statistics->ui($what, $about);
		$data['ui'] = $ui;
		$data['uid'] = 'nhk';

		//ext proprety
		$this->js_include .= $this->ui->js_include('chartjs');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_inject .= $this->load->view('statistics/js', $data, TRUE);


		$this->js_inject .= $this->load->view('timemode_picker/js', $data, TRUE);

		// sidebar control
		$sidebar = ($ui['sidebar'] != '') ? $ui['sidebar'] : '';

		$main_index_view = 'index';
		$konten = $this->load->view('statistics/'.$main_index_view, $data, TRUE);
		$this->admin_view($konten, $sidebar);
	}

	function testing()
	{
		cekpost();
	}

	function bar($what='', $type='default')
	{
		$data_chart = $this->statistics->$what();
		echo $this->load->view('statistics/chart/bar/'.$type, $data_chart, TRUE);
	}


	function dashboard_jumlah_pelanggan()
	{
		$cat = $this->db->query("select count(gmd_customer.id) as jumlah, gmd_master.name, customer_type from gmd_customer
left join gmd_master ON (gmd_customer.customer_type=gmd_master.code and gmd_master.category='customer_type')
where customer_type > 0 and gmd_customer.status='customer' and status_active !='0' and customer_type !='12' and gmd_customer.regional='".session_scope_regional()."' group by customer_type")->result_array();
		// pre($cat);

		$arr_label = array();
		$arr_data = array();
		foreach($cat as $row):
			$arr_label[] = $row['name'];
			$arr_data[] = $row['jumlah'];
		endforeach;

		$arr = array();
	    $arr['label'] = $arr_label;
	    $arr['datasets'][] = array(
	            'label' => 'Jenis Pelanggan',
	            'data'  => $arr_data,
	            'color' => rgb_color_code('blue'),
	        );
		// pre($arr);


		// $arr = array();
	    // $arr['label'] = array('senin', 'selasa', 'rabu', 'kamis');
	    // $arr['datasets'][] = array(
	    //         'label' => 'makanan',
	    //         'data'  => array('2', '4', '7', '9'),
	    //         'color' => rgb_color_code('red'),
	    //     );
	    // $arr['datasets'][] = array(
	    //         'label' => 'minuman',
	    //         'data'  => array('21', '4', '9', '6'),
	    //         'color' => rgb_color_code('green'),
	    //     );
		$data = $arr;
		echo $this->load->view('statistics/chart', $data, TRUE);
	}

	function dashboard_pekerjaan_teknis()
	{
		$cat = $this->db->query("select count(gmd_customer.id) as jumlah, gmd_master.name, customer_type from gmd_customer
left join gmd_master ON (gmd_customer.customer_type=gmd_master.code and gmd_master.category='customer_type')
where customer_type > 0 and gmd_customer.status='customer' and status_active !='0' and customer_type !='12' and gmd_customer.regional='".session_scope_regional()."' group by customer_type")->result_array();
		// pre($cat);

		$arr_label = array();
		$arr_data = array();
		foreach($cat as $row):
			$arr_label[] = $row['name'];
			$arr_data[] = $row['jumlah'];
		endforeach;

		$arr = array();
	    $arr['canvas_id'] = 'chart_pekerjaan_teknis';
	    $arr['label'] = $arr_label;
	    $arr['datasets'][] = array(
	            'label' => 'Jenis Pelanggan',
	            'data'  => $arr_data,
	            'color' => rgb_color_code('blue'),
	        );
		// pre($arr);


		// $arr = array();
	    // $arr['label'] = array('senin', 'selasa', 'rabu', 'kamis');
	    // $arr['datasets'][] = array(
	    //         'label' => 'makanan',
	    //         'data'  => array('2', '4', '7', '9'),
	    //         'color' => rgb_color_code('red'),
	    //     );
	    // $arr['datasets'][] = array(
	    //         'label' => 'minuman',
	    //         'data'  => array('21', '4', '9', '6'),
	    //         'color' => rgb_color_code('green'),
	    //     );

		$data = $arr;
		// echo $this->load->view('statistics/chart/bar', $data, TRUE);
		echo $this->load->view('statistics/chart/bar', $data, TRUE);
	}
}
