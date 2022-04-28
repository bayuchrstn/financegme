<?php
class Model_item extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
        $this->column_order = array('id','item_name','category_name','brand_name');
    }

    function all($condition_string='', $limit='', $offset='')
    {
        // $this->db->where('up !=', '0');
        // $regional = session_scope_regional();
        // $area = session_scope_area();
        // $this->db->select('item.id AS id,
        //     item.item_name AS item_name,
        //     item.jumlah AS jumlah,
        //     brand.item_categories AS brand_name,
        //     cat.item_categories AS category_name,
        //     (SELECT COUNT("{PRE}item_detail.id") FROM {PRE}item_detail WHERE {PRE}item_detail.item_id = {PRE}item.id AND {PRE}item_detail.regional = "'.$regional.'" AND {PRE}item_detail.area = "'.$area.'") AS jumlah_item,
        //     (SELECT COUNT("{PRE}item_detail.id") FROM {PRE}item_detail WHERE {PRE}item_detail.item_id = {PRE}item.id AND {PRE}item_detail.item_status="available" AND {PRE}item_detail.regional = "'.$regional.'" AND {PRE}item_detail.area = "'.$area.'")
        //         AS jumlah_item_available')
        $this->db->select('item.id AS id,
            item.item_name AS item_name,
            item.jumlah AS jumlah,
            brand.item_categories AS brand_name,
            cat.item_categories AS category_name')
            ->join('item_categories brand','brand.id=item.brand')
            ->join('item_categories cat','cat.id=item.category_id');
        if ($condition_string!='') {
            $this->db->where($condition_string);
        }
        if ($_POST['order']) {
            $this->db->order_by($this->column_order[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
        }
        if ($limit!='' && $offset!='') {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get('item')->result_array();

    }

    function count_item_status($item_id, $status='')
    {
        $regional = session_scope_regional();
        $area = session_scope_area();
        $this->db->where('item_detail.item_id', $item_id)
            ->where('item_detail.regional', $regional)
            ->where('item_detail.area', $area);
        if ($status!='') {
            $this->db->where('item_detail.item_status', $status);
        }
        $query = $this->db->get('item_detail');
        return $query->num_rows();
    }

    function name($value='')
    {
        
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
        return $this->db->get('item')->row_array();
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

    function arr_category($id)
    {
        $this->db->where('up ', $id)
            ->order_by('item_categories','ASC');
        $query = $this->db->get('item_categories')->result_array();
        $arr = array();
        $current = $query;
        if(!empty($current)):
            foreach($current as $row):
                $arr[$row['id']] = $row['item_categories'];
            endforeach;
        endif;
        return $arr;
    }

}
