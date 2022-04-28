<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function get_menu($parent='0',$divisi){
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->where('parent',$parent);
		$db->where('user',$divisi);
		$db->where('status','1');
        $data = $db->get('menu');
        return $data;
	}
}
