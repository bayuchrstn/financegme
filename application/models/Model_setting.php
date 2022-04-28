<?php
class Model_setting extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    // function tabs()
    // {
    //     $this->db->group_by();
    //     $qry = $this->db->get('setting');
	// 	$tabs = $qry->result_array();
	// 	return $tabs;
    // }

    function all()
    {
        $arr = array();
        $all = $this->db->get('setting')->result_array();
        if(!empty($all)):
            foreach($all as $row):
                $arr[$row['setting']] = $row['value'];
            endforeach;
        endif;
        return $arr;
    }

    function get_setting($setting_name)
    {
    	$this->db->where('setting', $setting_name);
    	$qry = $this->db->get('setting');
		$setting_data = $qry->row_array();
		return $setting_data['value'];

    }

    function by_category($category)
    {
        $this->db->order_by('sort', 'asc');
        $this->db->where('category', $category);
    	$qry = $this->db->get('setting');
		return $qry->result_array();
    }

    function by_code($code)
    {
        $this->db->where('setting', $code);
    	$qry = $this->db->get('setting');
		$setting_data = $qry->row_array();
		return $setting_data['value'];
    }

}
