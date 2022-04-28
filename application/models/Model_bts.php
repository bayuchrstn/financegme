<?php
class Model_bts extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all()
    {
        // $this->db->where('regional', my_regional());
		$this->scope->where_regional('bts');
        return $this->db->get('bts')->result_array();
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
        $this->db->where('id', $id);
        return $this->db->get('bts')->row_array();
    }

}
