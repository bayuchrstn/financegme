<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alert extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('Model_alert', 'alert');
	}

	function tes()
	{
		$starting_date = split_date();
		$unix_starting_date = mktime($starting_date['jam'], $starting_date['menit'], 0, $starting_date['bulan'], $starting_date['tanggal'], $starting_date['tahun']);
		$unix_sekarang = mktime(date('H'), date('i'), 0, date('m'), date('d'), date('Y'));
		$selisih = $unix_sekarang - $unix_starting_date;

		pre($unix_sekarang);
		pre($unix_starting_date);
		pre($selisih);

		$hasil_bagi = ($selisih / 300);
		// pre($hasil_bagi);

		if (is_int($hasil_bagi)) {
			$cek = $this->db->query("SELECT * FROM {PRE}te WHERE dp like'" . substr(now(), 0, -3) . "%' ")->row_array();
			if (empty($cek)) :
				$data = array(
					'dp'	=> now()
				);
				$this->db->insert('te', $data);
			endif;
		}
	}

	function index()
	{
		$data = array();
		$alerts = $this->alert->get();
		// pre($alerts); exit;
		// echo json_encode($alerts);
		$data['alerts'] = $alerts;
		$this->load->view('alert/notifikasi', $data);
	}

	// function ts($alert_id='12')
	// {
	// 	$this->alert->set_read($alert_id);
	// }

	function tg($alert_id = '7')
	{
		$rolas = $this->alert->detail($alert_id);
		pre($rolas);

		$log = unserialize($rolas['user_read']);
		pre($log);

		$ada = in_array('2018-01-24 02:32', $log['1']);
		if ($ada) :
			pre('ada');
		else :
			pre('tidak');
		endif;
	}

	function find_key_value($array, $key, $val)
	{
		foreach ($array as $user => $values) :
			pre($user[1]);
		endforeach;
	}
}
