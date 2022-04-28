<?php
class Model_brand extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all()
    {
        // $this->db->where('regional', my_regional());
        $this->db->where('up', '0');
        return $this->db->get('item_categories')->result_array();
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
        return $this->db->get('item_categories')->row_array();
    }

}
