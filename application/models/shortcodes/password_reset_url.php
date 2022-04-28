<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Password_reset_url extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    public function run ($params = array(), $ext)
    {
        $str = (isset($ext['password_reset_url'])) ? $ext['password_reset_url'] : '';
        return '<a href="'.$str.'">'.$str.'</a>';
    }
}
