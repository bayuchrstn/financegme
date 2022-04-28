<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cuti extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function all()
	{
		// $this->scope->where_regional('bts');
		$this->db->select('cuti.*, cuti_category.*, cuti_status.*')
			->select('people.name AS people_name,
				users.name AS author_name')
			->join('users','users.id = cuti.cuti_user','left')
			->join('people','people.id = cuti.cuti_people_id','left')
			->join('cuti_status','cuti_status.cuti_status_id = cuti.cuti_status')
			->join('cuti_category','cuti_category.cuti_category_id = cuti.cuti_category');
		$query = $this->db->get('cuti');
		return $query->result_array();
	}

	function arr_product()
    {
        $arr = array();
        $current = $this->all();
        if(!empty($current)):
            foreach($current as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function detail($id)
    {
    	$this->db->select('cuti.*, cuti_category.*, cuti_status.*')
			->select('people.name AS people_name,
				users.name AS author_name')
			->join('users','users.id = cuti.cuti_user','left')
			->join('people','people.id = cuti.cuti_people_id','left')
			->join('cuti_status','cuti_status.cuti_status_id = cuti.cuti_status')
			->join('cuti_category','cuti_category.cuti_category_id = cuti.cuti_category');
        $this->db->where('cuti.id', $id);
        return $this->db->get('cuti')->row_array();
    }

    function cuti_category()
    {
    	$query = $this->db->get('cuti_category');
    	return $query->result_array();
    }

    function get_people()
    {
    	return $this->db->get('people')->result_array();
    }
}

/* End of file Model_cuti.php */
/* Location: ./application/models/Model_cuti.php */