<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget_tabgen extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		// $this->load->model('model_regional', 'regional');
		// $this->active_root_menu = $this->lang->line('regional_alltitle');
		// $this->browser_title = $this->lang->line('regional_alltitle');
		// $this->modul_name = $this->lang->line('regional_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function request_out()
	{
		$tabs = array();

		$tabs[] = array(
				'label'         => 'Request',
				'id'            => 'dashboard_ro_request',
				'content'       => '',
			);

		$tabs[] = array(
				'label'         => 'Approved',
				'id'            => 'dashboard_ro_approved',
				'content'       => '',
			);

		$ser = serialthis($tabs);
		echo $ser;
	}

}
