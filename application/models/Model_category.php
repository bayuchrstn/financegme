<?php
class Model_category extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all()
    {
        $this->db->select('a.id AS id, a.item_categories AS item_categories, a.code_name AS code_name,a.up AS up, b.item_categories AS brand_name')->from('item_categories a');
        $this->db->join('item_categories b','b.id = a.up');
        $this->db->where('a.up !=', '0');
        return $this->db->get()->result_array();
        // $this->db->where('up !=', '0');
        // return $this->db->get('item_categories')->result_array();

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

    function get_category_brand()
    {
        $this->db->where('up', '0')
            ->order_by('item_categories','ASC');
        return $this->db->get('item_categories')->result_array();
    }

    function arr_category_brand()
    {
        $arr = array();
        $current = $this->get_category_brand();
        if(!empty($current)):
            foreach($current as $row):
                $arr[$row['id']] = $row['item_categories'];
            endforeach;
        endif;
        return $arr;
    }

}
