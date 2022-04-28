<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Requester_name extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    public function run ($params = array(), $ext)
    {
        $str = (isset($ext['requester_name'])) ? $ext['requester_name'] : '';
        return $str;
    }
}
