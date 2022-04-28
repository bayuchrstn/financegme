<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class New_account_activation_url extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    public function run ($params = array(), $ext)
    {
        $str = (isset($ext['new_account_activation_url'])) ? $ext['new_account_activation_url'] : '';
        return '<a href="'.$str.'">'.$str.'</a>';
    }
}
