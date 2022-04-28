<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('Model_progress', 'progress');
	}

    function index()
    {
		$progress  = array();
        $progress[]  = array(
            'label'             => 'Marketing Progress',
            'code'              => 'marketing_progress',
            'task_id'           => '12',
        );
		$params = array(
			'title'		=> 'Installasi pelanggan harto',
			'category'	=> 'installasi',
			'progress'	=> serialthis($progress),
		);
        $this->progress->init($params);
    }

	function update()
	{
		$params = array(
			'id'		=> '1',
			'task_id'	=> '23434',
			'label'		=> 'Munyuk',
			'code'		=> 'monyet',
		);
        $this->progress->update($params);
	}

	function detail()
	{
		$detail = $this->progress->detail('1');
		$arr_progress = unserialthis($detail['progress']);
		pre($detail);
		pre($arr_progress);
	}

	function cek()
	{
		$detail = $this->progress->check_by_task('3', '45');

	}


}
