<?php
class Model_scope extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function where($table='')
    {
        $this->db->where($table.'.regional', session_scope_regional());
        $this->db->where($table.'.area', session_scope_area());
    }

	function where_regional($table='')
    {
        $this->db->where($table.'.regional', session_scope_regional());
    }

    function filter($table='')
    {
        $this->db->where($table.'.regional', session_scope_regional());
        $this->db->where($table.'.area', session_scope_area());
    }

	function owner_filter($modul='marketing_progress', $filter)
	{
		switch($modul){

			//marketing progress
			default:
				//jika anggota group marketing progress view dibikin menampilan marker user ybs
				if(my_level()=='VTVYM1486956488'):
					$this->session->set_userdata('data_owner_filter', $filter);
				endif;
		}
	}

	function remove_owner_filter()
	{
		$this->session->unset_userdata('data_owner_filter');
	}

}
