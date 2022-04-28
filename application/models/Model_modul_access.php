<?php
class Model_modul_access extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function where($table='')
    {
        $this->db->where($table.'.regional', session_scope_regional());
        $this->db->where($table.'.area', session_scope_area());
    }

	function run()
	{
		
	}



}
