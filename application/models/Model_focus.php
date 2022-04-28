<?php
class Model_focus extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get_row($table, $column_key, $key)
    {
        $this->db->where($column_key, $key);
        return $this->db->get($table)->row_array();
    }

    function customer($customer_id)
    {
        $this->lang->load('customer');
        $arr = array();
        $row = $this->get_row('customer', 'id', $customer_id);
        $arr[$this->lang->line('customer_name')] = $row['name'];
        $arr[$this->lang->line('customer_email')] = $row['email'];
        $arr[$this->lang->line('customer_telephone')] = $row['telephone'];
        $arr[$this->lang->line('customer_username')] = $row['username'];
        return $arr;
    }

    function user($user_id)
    {
        $this->lang->load('user');
        $arr = array();
        $row = $this->get_row('users', 'id', $user_id);
        $arr[$this->lang->line('user_name')] = $row['name'];
        $arr[$this->lang->line('user_email')] = $row['email'];
        return $arr;
    }

}
