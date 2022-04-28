<?php
class Model_attachment extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function insert($table='task', $id, $items=array())
	{
		if(!empty($items)):
			foreach($items as $item=>$val):
				// pre($item);
				$data = array(
					$table.'_id'	=> $id,
					'author'		=> my_id(),
					'date_post'		=> now(),
					'file_name'		=> $val,
				);
				// pre($data);
				$this->db->insert($table.'_attachment', $data);
			endforeach;
		endif;
	}

	function get($table='task', $id)
	{
		$this->db->where($table.'_id', $id);
		$data = $this->db->get($table.'_attachment')->result_array();
		return $data;
	}

}
