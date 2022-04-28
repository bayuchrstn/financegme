<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timemode_picker extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        // $this->load->model('request/Model_request_in', 'request_in');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function index($mode='')
    {
        // pre($mode);
		switch ($mode) {
			case 'tanggal':
				$mode = $mode;
			break;

			case 'bulan':
				$mode = $mode;
			break;

			case 'tahun':
				$mode = $mode;
			break;

			default:
				$mode = 'tanggal';
			break;
		}
		$this->load->view('timemode_picker/'.$mode, '');
    }



}
