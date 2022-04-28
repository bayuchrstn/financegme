<?php
class Model_item_detail extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
        $this->load->model('model_scope','scope');
        // $this->get_scope_area = '';
    }

    function all($id,$status='')
    {
        // $this->db->where('up !=', '0');
        $this->db->select('item_detail.id AS id,
            nomor_barang,
            barcode,
            mac_address,
            price,
            warranty,
            buy_date,
            item.id AS id_item,
            item.item_name AS item_name,
            item.jumlah AS jumlah,
            brand.item_categories AS brand_name,
            cat.item_categories AS category_name')
            ->join('item','item.id = item_detail.item_id')
            ->join('item_categories brand','brand.id=item.brand')
            ->join('item_categories cat','cat.id=item.category_id');
        $this->db->where('item_detail.item_id',$id);
        $this->db->where('item_detail.item_status',$status);
        $this->scope->filter('item_detail');
        return $this->db->get('item_detail')->result_array();

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
        $this->db->select('item_detail.id AS id,
            nomor_barang,
            barcode,
            mac_address,
            price,
            warranty,
			item_status,
            buy_date,
            supplier_id,
            invoice_number,
            item_detail.note AS note,
            flag_company,
            klasifikasi,
            item.id AS id_item,
            item.item_name AS item_name,
            item.jumlah AS jumlah,
            brand.item_categories AS brand_name,
            brand.id AS brand_id,
            cat.item_categories AS category_name,
            cat.id AS category_id')
            ->join('item','item.id = item_detail.item_id')
            ->join('item_categories brand','brand.id=item.brand')
            ->join('item_categories cat','cat.id=item.category_id');
        $this->db->where('item_detail.id', $id);
        $data = $this->db->get('item_detail')->row_array();
        $data['buy_date_custom'] = date('d F Y', strtotime($data['buy_date']));
        return $data;
    }

    function detail_item($id)
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

    function get_category_brand_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('item_categories')->row_array();
    }

    function get_category_only($id)
    {
        $this->db->where('up ', $id)
            ->order_by('item_categories','ASC');
        $query = $this->db->get('item_categories')->result_array();
        return $query;
    }
    function get_item_category($id)
    {
        $this->db->where('category_id',$id);
        $query = $this->db->get('item')->result_array();
        return $query;
    }

    function get_supplier()
    {
        $this->db->order_by('supplier_name','ASC');
        $query = $this->db->get('supplier')->result_array();
        return $query;
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
                // $arr = array('id' => $row['id'],
                //     'name' => $row['item_categories']);
            endforeach;
        endif;
        return $arr;
    }

    function arr_category_onselect($id)
    {
        $this->db->where('up ', $id)
            ->order_by('item_categories','ASC');
        $query = $this->db->get('item_categories')->result_array();
        $arr = array();
        $current = $query;
        if(!empty($current)):
            foreach($current as $row):
                $arr[] = array('id' => $row['id'],
                    'name' => $row['item_categories']);
            endforeach;
        endif;
        return $arr;
    }

    function status_item()
    {
        $this->db->group_by('item_status');
       return $this->db->get('item_detail')->result_array();
    }

    function arr_item_category($id)
    {
        $this->db->where('category_id',$id);
        $result = $this->db->get('item')->result_array();
        $arr = array();
        if(!empty($result)):
            foreach($result as $row):
                $arr[$row['id']] = $row['item_name'];
            endforeach;
        endif;
        return $arr;
    }

    function arr_item_category_onselect($id)
    {
        $this->db->where('category_id',$id);
        $result = $this->db->get('item')->result_array();
        $arr = array();
        if(!empty($result)):
            foreach($result as $row):
                // $arr[$row['id']] = $row['item_name'];
                $arr = array('id' => $row['id'],
                    'name' => $row['item_name']);
            endforeach;
        endif;
        return $arr;
    }

    function arr_supplier()
    {
        $result = $this->get_supplier();
        $arr = array();
        if(!empty($result)):
            foreach($result as $row):
                $arr[$row['id']] = $row['supplier_name'];
            endforeach;
        endif;
        return $arr;
    }

    function count_jml_barang($id)
    {
        $this->db->select('COUNT(*) AS jumlah')
            ->where('item_id',$id);
        return $this->db->get('item_detail')->row_array();
    }

    function update_jml_barang($id='',$val='1')
    {
        $val = intval($val);
        $result = $this->count_jml_barang($id);
        $this->db->where('id',$id);
        // $result = $this->db->get('item')->row_array();
        $jumlah = $result['jumlah'];
        $total = $jumlah+($val);
        $this->db->update('item',array('jumlah' => $total));
    }

}
