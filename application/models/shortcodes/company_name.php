<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Company_name extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    public function run ($params = array(), $ext)
    {
        $setting = $this->all_setting;
        return $setting['company_name'];
    }
}
