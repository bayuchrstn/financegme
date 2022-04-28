<?php
defined('BASEPATH') or exit('No direct script access allowed');

class finance_ap_report_od extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_global', 'm_global');
		$this->load->model('model_finance_ap_report_od', 'finance_ap_report_od');
		$this->lang->load('finance_ap_report_od');
		$this->active_root_menu = $this->lang->line('finance_ap_report_od_alltitle');
		$this->browser_title = $this->lang->line('finance_ap_report_od_alltitle');
		$this->modul_name = $this->lang->line('finance_ap_report_od_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		// $options = array();
		// $options['modul_code'] = 'bts';
		// $this->frame->main_crud($options);

		$this->breadcrumb = array('Home' => base_url(), $this->lang->line('finance_ap_report_od_alltitle') => '#');
		$data = array();

		//$this->js_inject .= $this->load->view('finance_ap_report_od/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('finance_ap_report_od/js', $data, TRUE);
		//$this->js_inject .= $this->load->view('finance_ap_report_od/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('flexigridMaster');
		$this->js_include .= $this->ui->load_css('flexigridMaster');
		$this->js_include .= $this->ui->load_css('MaterialIcons');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('custom_page');
		$this->js_include .= $this->ui->js_include('mask_money');
		//$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('custom_page');

		$data['title_page_table'] = $this->lang->line('finance_ap_report_od_alltitle');

		$konten = $this->load->view('finance_ap_report_od/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function print_report()
	{
		$data['title_page_table'] = $this->lang->line('finance_ap_report_od_alltitle');

		$this->load->view('finance_ap_report_od/report', $data);
	}

	public function get_supplier()
	{
		$param = $this->input->post('searchTerm');
		if (!empty($param)) {
			echo $this->finance_ap_report_od->get_supp($param);
		} else {
			echo $this->finance_ap_report_od->get_supp();
		}
	}
}
