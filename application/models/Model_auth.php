<?php
class Model_auth extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function valid_username($username)
    {
        $this->db->where('username', $username);
        $res = $this->db->get('customer')->result_array();
        if(empty($res)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    function valid_email($email)
    {
        $this->db->where('email', $email);
        $res = $this->db->get('customer')->result_array();
        if(empty($res)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    

}
