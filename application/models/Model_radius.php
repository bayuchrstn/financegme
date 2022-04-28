<?php
class Model_radius extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function connect($db_array=array())
    {
        $default = array(
            'hostname'  => 'your_hostname',
            'username'  => 'your_username',
            'password'  => 'your_password',
            'database'  => 'your_database'
        );

        $hostname = !empty($db_array['hostname']) ? $db_array['hostname'] : $default['hostname'];
        $username = !empty($db_array['username']) ? $db_array['username'] : $default['username'];
        $password = !empty($db_array['password']) ? $db_array['password'] : $default['password'];
        $database = !empty($db_array['database']) ? $db_array['database'] : $default['database'];

		$config['hostname'] = $hostname;
		$config['username'] = $username;
		$config['password'] = $password;
		$config['database'] = $database;
		$config['dbdriver'] = "mysqli";
		$config['dbprefix'] = "";
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;

		$other_db = $this->load->database($config, TRUE);
        return $other_db;
    }
}