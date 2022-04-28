<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Now extends MY_Controller {

	public function index()
	{
		// pre(now());
		$tgl = human_datetime(now(), '1');
		$tanpa_detik = substr($tgl, 0, strlen($tgl)-3);
		echo nama_hari(now()).' '.$tanpa_detik;
	}


}
