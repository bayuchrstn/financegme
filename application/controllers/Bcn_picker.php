<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bcn_picker extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_bcn', 'bcn');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($selected_brand='', $selected_category='', $selected_name='')
	{
		$arr = array();
		$all_brand = $this->get_brand();
		$arr['brand'] = $this->arr_to_option($all_brand);

		reset($all_brand);
		$first_brand = key($all_brand);
		if($selected_brand !=''):
			$selected_brand = $selected_brand;
		else:
			$selected_brand = $first_brand;
		endif;
		// pre($selected_brand);
		$arr['selected_brand'] = $selected_brand;

		$all_cat = $this->get_category($selected_brand);
		$arr['category'] = $this->arr_to_option($all_cat);
		reset($all_cat);
		$first_cat = key($all_cat);
		if($selected_category !=''):
			$selected_category = $selected_category;
		else:
			$selected_category = $first_cat;
		endif;
		// pre($selected_category);
		$arr['selected_category'] = $selected_category;

		$all_name = $this->get_name($selected_category);
		$arr['name'] = $this->arr_to_option($all_name);
		reset($all_name);
		$first_name = key($all_name);
		if($selected_name !=''):
			$selected_name = $selected_name;
		else:
			$selected_name = $first_name;
		endif;
		$arr['selected_name'] = $selected_name;

		// pre($arr);
		echo json_encode($arr);
	}

	function get_brand()
	{
		return $this->bcn->arr_all_brand();
	}

	function get_category($brand)
	{
		return $this->bcn->arr_all_cat($brand);
	}

	function get_name($cat)
	{
		return $this->bcn->arr_all_name($cat);
	}

	function arr_to_option($arr)
	{
		$options = '';
		if(!empty($arr)):
			foreach($arr as $key=>$val):
				$options .= '<option value="'.$key.'">'.$val.'</option>';
			endforeach;
		endif;
		return $options;
	}

	function item_id_info($item, $item_id)
	{
		$data = array();
		switch ($item) {
			case 'medicine':
				$this->db->where('item_category', 'medicine');
				$this->db->where('id', $item_id);
				$data = $this->db->get('items')->row_array();
			break;

			case 'bhp':
				$this->db->where('item_category', 'bhp');
				$this->db->where('id', $item_id);
				$data = $this->db->get('items')->row_array();
			break;

			default:
				$this->db->where('id', $item_id);
				$data = $this->db->get($item)->row_array();
			break;
		}
		echo json_encode($data);
	}

}
