<?php

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $tz = ($this->session->userdata('timezone')) ? $this->session->userdata('timezone') : 'Asia/jakarta';
        date_default_timezone_set($tz);
        // basic_auth_login(); // login with basic auth
        //bearer token
        $this->token = getBearerToken();
		$this->is_valid_token = jwt_helper::validate($this->token);
		$this->tokenArray = $this->is_valid_token ? json_decode(json_encode(jwt_helper::decode($this->token)), true) : array();
		// end bearer token

        $this->load->model('model_theme', 'theme');
        $this->load->model('model_setting', 'setting');
		$this->load->model('model_related', 'related');
		$this->load->model('model_log', 'activity');
		$this->load->model('Model_myprofil', 'myprofil');
		$this->load->model('Model_actionform', 'actionform');
        $this->load->model('model_regional', 'regional');
        $this->load->model('model_master', 'master');
        $this->load->model('model_scope', 'scope');
        $this->load->model('model_counter', 'counter');
        $this->load->model('model_form_element', 'form_element');
        $this->load->model('model_meta', 'meta');
		$this->load->model('Model_attachment', 'attachment');
		$this->load->model('Model_crud', 'crud');
		$this->load->model('Model_permintaan_barang', 'permintaan_barang');
		$this->load->model('Model_email', 'emailer');
		$this->load->model('Model_info', 'info');
		$this->load->model('Model_modul', 'modul');
		$this->load->model('Model_progress', 'progress');
        $this->load->model('Model_alert', 'alert');
        $this->load->model('Model_alert_notif','alert_notif');

        //need
        $this->all_setting = $this->setting->all();
		$this->browser_title = '';
		$this->app_name = $this->all_setting['company_name'];
		$this->breadcrumb = array();
		$this->js_inject = '';
		$this->html_inject = '';
		$this->active_submenu = '';
		$this->active_root_menu = '';
		$this->search_form = '';
		$this->advanced_search_form = '';
		$this->css_include = '';
		$this->css_inject = '';
		$this->js_include = '';
		$this->selected_menu = '';
		$this->selected_submenu = '';
		$this->list_save = '';

		$this->listadd_title = '';
		$this->listadd_search = '';
		$this->listadd_lists = '';
		$this->listadd_add_privileges = '';
		$this->listadd_add = '';
		$this->listadd_form = '';
		$this->open_menu = '';

        // $this->all_session = $this->is_valid_token ? $this->tokenArray['sub'] : $this->session->all_userdata();

        //need
        $this->whoami = $this->myprofil->getdata();

        if ($this->is_valid_token) {
        	$this->all_session = $this->whoami;
        	$this->all_session['scope_regional'] = $this->all_session['regional'];
        	$this->all_session['scope_area'] = $this->all_session['area'];
        } else {
        	$this->all_session = $this->session->all_userdata();
        }
        // $this->all_session = $this->is_valid_token ? $this->whoami : $this->session->all_userdata();

        $this->modul_name = '';


        defined('FILE_PATH_ATTACHMENT')      OR define('FILE_PATH_ATTACHMENT', substr(BASEPATH, 0, strlen(BASEPATH)-7).'attachment/');
        defined('URL_ATTACHMENT')      OR define('URL_ATTACHMENT', base_url().'attachment');
        defined('TEXTTHEME')      OR define('TEXTTHEME', 'text-indigo');
        defined('TEXT_THEME')      OR define('TEXT_THEME', 'text-indigo');
        defined('BGTHEME')      OR define('BGTHEME', 'bg-indigo');
        defined('BG_THEME')      OR define('BG_THEME', 'bg-indigo');
        defined('BORDER_THEME')      OR define('BORDER_THEME', 'border-indigo');

    }


	function admin_view($konten, $sidebar='')
	{
        // pre($this->js_inject);
        $healthy = array('<script type="text/javascript">', '</script>');
        $yummy = array('', '');
        $js_page = replace_this($this->js_inject, $healthy, $yummy);
        $js_page = filter_serialthis($js_page);

        // test
        $js_page = str_replace('<script type="text/javascript">', '', $this->js_inject);
        $js_page = str_replace('</script>', '', $js_page);

        // $js_page = filter_serialthis($js_page);
        $js_page = '';
        // end test

        $this->session->set_userdata('js_page', $js_page);
        // $this->session->set_flashdata('js_page', $js_page);

        $mn['arr_menu'] = $this->all_session['arr_menu'];
        // pre($mn['arr_menu']);
        $mn['breadcrumb'] = $this->breadcrumb;
        $mn['active_root_menu'] = $this->active_root_menu;
        $mn['app_name'] = $this->app_name;
        $mn['browser_title'] = ($this->browser_title !='') ? $this->browser_title : $this->app_name;

		$template['navbar'] = $this->load->view('flat/navbar', $mn, TRUE);
		$template['sidebar'] = ($sidebar !='') ? $this->load->view('sidebar/'.$sidebar, $mn, TRUE) : '';
		$template['modal'] = $this->load->view('flat/modal', $mn, TRUE);
        $template['css_include'] = $this->css_include;
        $template['js_include'] = $this->js_include;
        // $template['js_inject'] = $this->js_inject;
        $template['js_page'] = '<script type="text/javascript" src="'.base_url().'javascript"></script>';
		$template['main_content'] = $konten;
		$template['js_inject'] = $this->js_inject;
		$this->load->view('flat/main', $template);
	}

    function login_view($data)
	{
		// $template['main_content'] = $konten;
        // pre($data);
        $data['data'] = $data;
		$this->load->view('flat/login', $data);
	}

	function print_view($konten)
	{
		$template['js_inject'] = $this->js_inject;
		$template['js_include'] = $this->js_include;
		$template['css_inject'] = $this->css_inject;
		$template['html_inject'] = $this->html_inject;
		$template['main_content'] = $konten;
		$this->load->view(ADMIN_FOLDER.'/v3/cetak', $template);
	}

	function bootstrap_minimal($konten)
	{
		$template['js_inject'] = $this->js_inject;
		$template['js_include'] = $this->js_include;
		$template['css_inject'] = $this->css_inject;
		$template['html_inject'] = $this->html_inject;
		$template['main_content'] = $konten;
		$this->load->view(ADMIN_FOLDER.'/v3/main_clean', $template);
	}

	function clean_view($konten)
	{
		$template['clean_content'] = $konten;
		$this->load->view(ADMIN_FOLDER.'/v3/clean', $template);
	}

	function no_bs($konten)
	{
		$template['js_inject'] = $this->js_inject;
		$template['js_include'] = $this->js_include;
		$template['css_inject'] = $this->css_inject;
		$template['html_inject'] = $this->html_inject;
		$template['main_content'] = $konten;
		$this->load->view(ADMIN_FOLDER.'/v3/no_bs', $template);
	}

	function css_view($konten)
	{
		$template['js_inject'] = '';
		$template['css_inject'] = $this->css_inject;
		$template['js_include'] = '';
		$template['html_inject'] = '';
		$template['main_content'] = $konten;
		$this->load->view(ADMIN_FOLDER.'/v3/css_view', $template);
	}


}
