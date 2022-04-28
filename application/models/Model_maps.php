<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_maps extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function all($maps_type='customer_active')
	{
		// $this->scope->where_regional('bts');
		$this->db->select('maps.*, maps_type.*, m.maps_lat AS maps_lat2, m.maps_lng AS maps_lng2, m.maps_parent AS maps_parent2, customer.customer_name');
		$this->db->join('maps_type','maps_type.maps_type_code = maps.maps_type','left')
			->join('maps m','m.maps_parent = maps.maps_id','left')
			->join('customer','customer.id = maps.maps_customer_id','left')
			->where('maps.maps_type',$maps_type)
			->where('maps.maps_parent',NULL);
		$query = $this->db->get('maps');
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
    	$this->db->select('maps.*, maps_type.*, m.maps_lat AS maps_lat2, m.maps_lng AS maps_lng2, m.maps_parent AS maps_parent2, customer.customer_name');
    	$this->db->join('maps_type','maps_type.maps_type_code = maps.maps_type','left')
    		->join('maps m','m.maps_parent = maps.maps_id','left')
    		->join('customer','customer.id = maps.maps_customer_id','left');
        $this->db->where('maps.maps_id', $id);
        return $this->db->get('maps')->row_array();
    }

    function get_maps_type_icon($icon='')
    {
    	// $this->db->group_by('maps_type_point');
    	$query = $this->db->get('maps_type');
    	return $query->result_array();
    }

    function get_maps_by_point_type($point='point')
    {
    	$this->db->select('maps.*, maps_type.*, m.maps_lat AS maps_lat2, m.maps_lng AS maps_lng2, m.maps_parent AS maps_parent2, customer.customer_name');
		$this->db->join('maps_type','maps_type.maps_type_code = maps.maps_type','left')
			->join('maps m','m.maps_parent = maps.maps_id','left')
			->join('customer','customer.id = maps.maps_customer_id','left')
			->where('maps_type.maps_type_point',$point)
			->where('maps.maps_parent',NULL);
		$query = $this->db->get('maps');
		return $query->result_array();
    }

}

/* End of file Model_maps.php */
/* Location: ./application/models/Model_maps.php */