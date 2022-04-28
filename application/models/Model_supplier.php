<?php
class Model_supplier extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all()
    {
        $this->db->where('regional', my_regional());
        return $this->db->get('supplier')->result_array();
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
        return $this->db->get('supplier')->row_array();
    }

}
