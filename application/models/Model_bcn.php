<?php
class Model_bcn extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get_all_brand()
	{
		$this->db->where('up', '0');
		$data = $this->db->get('item_categories')->result_array();
		return $data;
	}

	function get_all_cat($brand)
	{
		$this->db->where('up', $brand);
		$data = $this->db->get('item_categories')->result_array();
		return $data;
	}

	function get_all_name($cat)
	{
		$this->db->where('category_id', $cat);
		$data = $this->db->get('item')->result_array();
		return $data;
	}

	function arr_all_brand()
	{
		$arr = array();
		$all = $this->get_all_brand();
		if(!empty($all)):
			foreach($all as $row):
				$arr[$row['id']] = $row['item_categories'];
			endforeach;
		endif;
		// pre($arr);
		return $arr;
	}

	function arr_all_cat($brand)
	{
		$arr = array();
		$all = $this->get_all_cat($brand);
		if(!empty($all)):
			foreach($all as $row):
				$arr[$row['id']] = $row['item_categories'];
			endforeach;
		endif;
		// pre($arr);
		return $arr;
	}

	function arr_all_name($cat)
	{
		$arr = array();
		$all = $this->get_all_name($cat);
		if(!empty($all)):
			foreach($all as $row):
				$arr[$row['id']] = $row['item_name'];
			endforeach;
		endif;
		// pre($arr);
		return $arr;
	}

	function item_info($item_id, $mode='default')
	{
        // pre($item_id);
        // pre($mode);
		$this->db->where('item.id', $item_id);
		$this->db->select('item.*');
		$this->db->select('brand.item_categories as brand_name');
		$this->db->select('category.item_categories as category_name');
		$this->db->join('item_categories category', 'item.category_id = category.id', 'left');
		$this->db->join('item_categories brand', 'item.brand = brand.id', 'left');
		$data = $this->db->get('item')->row_array();
        // pre($this->db->last_query());
		switch ($mode) {

			default:
				$opt = $data['brand_name'].' / '.$data['category_name'].' / '.$data['item_name'];
			break;
		}
		return $opt;
	}

	function item_detail_info($item_detail_id, $mode='nomor_barang')
	{
		$this->db->where('item_detail.id', $item_detail_id);
		$this->db->select('item_detail.*');
		$data = $this->db->get('item_detail')->row_array();
		// pre($this->db->last_query());

		switch ($mode) {
			case 'nomor_mac':
				$nomor_barang = $data['nomor_barang'];
				$mac_address = ($data['mac_address'] !='') ? ' - '.$data['mac_address'] : '';
				$barcode = $data['barcode']!='' ? ' - '.$data['barcode'] : '';
				return $nomor_barang.$mac_address.$barcode;
			break;

			default:
				return $data[$mode];
			break;
		}

	}

}
