<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_picker extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_location', 'location');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($selected_location='', $selected_location_id='', $modul_view='select_customer')
	{
		$arr = array();
		$arr['location'] = $this->arr_to_option($this->get_location());
		$arr['location_id'] = $this->arr_to_option($this->get_location_id($selected_location, $modul_view));
		$arr['selected_location'] = $selected_location;
		// $arr['selected_item'] = $selected_item;
		// $arr['selected_item_id'] = $selected_item_id;
		echo json_encode($arr);
	}

	function all($selected_location='', $selected_location_id='', $modul_view='')
	{
		$arr = array();
		$arr['location'] = $this->arr_to_option($this->get_location());
		$arr['location_id'] = $this->arr_to_option($this->get_location_id_pengajuan_barang($selected_location));
		$arr['selected_location'] = $selected_location;
		echo json_encode($arr);
	}

	// general ******************************************************************************************
	function general($selected_location='', $selected_location_id='', $mode='')
	{
		$arr = array();
		$arr['location'] = $this->arr_to_option($this->get_location_general());
		$arr['location_id'] = $this->arr_to_option($this->get_location_id_general($selected_location));
		$arr['selected_location'] = $selected_location;
		echo json_encode($arr);
	}

	function get_location_general()
	{
		$loc = $this->location->arr_location();
		// pre($loc);
		return $loc;
	}

	function get_location_id_general($item)
	{
		return $this->location->arr_location_id($item);
	}

	// end general ******************************************************************************************

	function get_location()
	{
		// $array = array(
		// 	''				=> 'Pilih Lokasi',
		// 	'customer'		=> 'Customer',
		// 	'pre_customer'	=> 'Pre Customer',
		// 	'bts'			=> 'BTS',
		// );
		$loc = $this->location->arr_all_location();
		// pre($loc);
		return $loc;
	}

	function get_location_id($item, $modul_view='')
	{
		return $this->location->get_location_id($item, $modul_view);
	}

	function get_location_id_pengajuan_barang($item )
	{
		return $this->location->get_location_id_pengajuan_barang($item);
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
