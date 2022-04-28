<?php
class Model_meta extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get_by_key($table, $id, $key)
	{
		$this->db->where('meta_key', $key);
		$this->db->where($table.'_id', $id);
		$data = $this->db->get($table.'_meta')->row_array();
		return $data['meta_value'];
	}

	function get_all($table, $id)
	{
		// $this->db->where('meta_key', $key);
		$this->db->where($table.'_id', $id);
		$data = $this->db->get($table.'_meta')->result_array();
		return $data;
	}

	// biar dinamis filter input dilakukan pas manggil function ini
	function set($table, $id, $key, $value)
	{
		$cek = $this->db->query('SELECT * FROM {PRE}'.$table.'_meta WHERE '.$table.'_id=\''.$id.'\' AND meta_key=\''.$key.'\' ')->result_array();
		if(empty($cek)):
			$data = array(
				$table.'_id'	=> $id,
				'meta_key'		=> $key,
				'meta_value'	=> $value,
			);
			// pre($data);
			$this->db->insert($table.'_meta', $data);
		else:
			$data = array(
				'meta_value'	=> $value,
			);
			// pre($data);
			$this->db->where('meta_key', $key);
			$this->db->where($table.'_id', $id);
			$this->db->update($table.'_meta', $data);
		endif;
		// pre($this->db->last_query());
	}

}
