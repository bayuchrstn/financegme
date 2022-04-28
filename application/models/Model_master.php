<?php
class Model_master extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function master_by_category($category)
    {
    	$this->db->where('category', $category);
        $this->db->order_by('order', 'asc');
		$query = $this->db->get('master');
		//pre($this->db->last_query());
        return $query->result_array();
    }

    function detail($id)
    {
    	$this->db->where('id', $id);
		$query = $this->db->get('master');
        return $query->row_array();
    }

    function arr($category)
    {
        $arr = array();
        $dt = $this->master_by_category($category);
        if(!empty($dt)):
            foreach($dt as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function master_by_code($category, $code)
    {
    	$this->db->where('category', $category);
    	$this->db->where('code', $code);
		$query = $this->db->get('master');
		//pre($this->db->last_query());
        return $query->row_array();
    }

    function master_name_by_code($category, $code)
    {
        // pre($category);
        // pre($code);
        $master = $this->master_by_code($category, $code);
        return $master['name'];
    }

    function get_status_category()
    {
        $this->db->group_by('category');
        //$this->db->select('category');
        $query = $this->db->get('master');
        return $query->result_array();
    }

    function get_one_category($target='')
    {
        if($target !=''):
            $this->db->where('category', $target);
        endif;
        $master = $this->db->get('master', 1)->row_array();
        return $master['category'];
    }

    function master_name($category='')
    {
        $category = $this->db->get_where('master', array('category'=>$category))->row_array();
        // pre($this->db->last_query());
        return $category['category_name'];
    }

    function master_valid_modul($code)
    {
        $this->db->where('code', $code);
        return $this->db->get('modul')->row_array();
    }

}
