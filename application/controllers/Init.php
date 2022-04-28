<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Init extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Model_init', 'init');
	}

	public function index($url_referer = '')
	{
		$ref = base64_decode(urldecode($url_referer));
		$redirect_url = ($url_referer != '') ? $ref : base_url() . 'finance_dashboard';
		$sessions = $this->is_valid_token ? $this->tokenArray['sub'] : $this->session->all_userdata();

		$this->set_modul_access();
		$this->set_menu();
		$this->set_timezone();
		$this->set_regional_name();
		$this->set_area_name();
		$this->set_regional_picker();
		redirect($redirect_url);
	}

	function set_menu($up = '0', $type = 'session')
	{
		if (is_admin()) :
			$this->db->order_by('menu_order', 'asc');
			$this->db->where('flag_menu', 'yes');
			$data_menu = $this->db->get('modul')->result_array();
		elseif (is_admin_regional()) :
			$this->db->order_by('menu_order', 'asc');
			$this->db->where('flag_menu', 'yes');
			$this->db->where('su_only !=', '1');
			$data_menu = $this->db->get('modul')->result_array();
		else :
			$my_privileges =  $this->init->arr_privileges();
			if (!empty($my_privileges)) :
				$this->db->order_by('menu_order', 'asc');
				$this->db->where('flag_menu', 'yes');
				$this->db->where_in('code', $my_privileges);
				$data_menu = $this->db->get('modul')->result_array();
			else :
				$data_menu = array();
			endif;
		endif;

		// pre($this->db->last_query());
		// pre($data_menu);
		// exit;
		$menu = $this->init->buildTree($data_menu, '0');
		// pre($menu);
		// return $menu;
		switch ($type) {
			case 'json':
				echo json_encode(array('menu' => $menu));
				break;

			default:
				$this->session->set_userdata('arr_menu', $menu);
				break;
		}
	}

	function set_timezone()
	{
		$timezone = $this->regional->get_timezone();
		$this->session->set_userdata('timezone', $timezone);
	}

	function set_modul_access($mode = 'session')
	{
		$arr = array();
		$arr['full_access'] = array();
		$session = $this->all_session;

		$this->db->where('user_group_id', $session['level']);
		$this->db->where('view', 'full_access');
		$ada = $this->db->get('modul_access')->result_array();
		if (!empty($ada)) :
			foreach ($ada as $row) :
				$arr['full_access'][] = $row['modul'];
			endforeach;
		endif;

		$arr['full_view'] = array();
		$this->db->where('user_group_id', $session['level']);
		$this->db->where('view', 'full_view');
		$ada = $this->db->get('modul_access')->result_array();
		if (!empty($ada)) :
			foreach ($ada as $row) :
				$arr['full_view'][] = $row['modul'];
			endforeach;
		endif;

		switch ($mode) {
			case 'json':
				echo json_encode(array('modul_access' => $arr));
				break;

			default:
				$this->session->set_userdata('modul_access', $arr);
				break;
		}
	}

	function set_regional_name()
	{
		$session = $this->session->all_userdata();
		// pre($session['scope_regional']);
		$name = $this->regional->get_regional_name($session['scope_regional']);
		// pre($name);
		$this->session->set_userdata('scope_regional_name', $name);
	}

	function set_area_name()
	{
		$session = $this->session->all_userdata();
		$name = $this->regional->get_regional_name($session['scope_area']);
		$this->session->set_userdata('scope_area_name', $name);
	}

	function set_regional_picker()
	{
		$all_session = $this->session->all_userdata();
		$scope = $all_session['view_scope'];
		$scope_regional = $all_session['scope_regional'];

		$arr = array();
		$arr['current_regional_area'] = array(
			'regional_name'		=> $all_session['scope_regional_name'],
			'area_name'			=> $all_session['scope_area_name'],
		);

		if ($scope != 'area') :

			if ($scope == 'regional') :
				$this->db->where('code', $scope_regional);
			endif;

			$this->db->where('up', '0');
			$regional_lists_picker = $this->db->get('regional')->result_array();

			if (!empty($regional_lists_picker)) :
				foreach ($regional_lists_picker as $row) :
					$arr['picker'][] = $row;
				endforeach;
			endif;
		else :
			$arr['picker'] = array();
		endif;
		// pre($arr);
		// exit;
		$this->session->set_userdata('regional_area_picker', $arr);
	}

	function rescope($area = '0', $url_referer = '')
	{
		$area = $this->db->query("SELECT * FROM {PRE}regional WHERE code='" . $area . "'")->row_array();
		if (empty($area)) :
			show_404();
		endif;
		$regional = $this->db->query("SELECT * FROM {PRE}regional WHERE id='" . $area['up'] . "'")->row_array();
		// pre($regional['code']); exit;
		if (session_view_scope() != 'area') :
			if (session_view_scope() == 'regional') :
				if ($regional['code'] != session_scope_regional()) :
					show_404();
				else :
					$this->session->set_userdata('scope_regional', $regional['code']);
					$this->session->set_userdata('scope_area', $area['code']);
				endif;
			else :
				$this->session->set_userdata('scope_regional', $regional['code']);
				$this->session->set_userdata('scope_area', $area['code']);
			endif;
		else :
			show_404();
		endif;
		redirect(base_url() . 'init/index/' . $url_referer);
	}
}
