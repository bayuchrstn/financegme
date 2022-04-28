<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_product_picker extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		// $this->load->model('model_item_picker', 'item_picker');
		// $this->lang->load('item');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($product_category='', $product_id='',$type='html')
	{
		// pre($product_category);
		// pre($product_id);
		$arr = array();
		$arr['product_category'] = $this->option_product_category($type);
		$arr['product_lists'] = $this->product_lists($product_category, $product_id,$type);
		// pre($arr);
		echo json_encode($arr);
	}

	function option_product_category($type='html')
	{
		$options = $type=='html' ? '' : array();
		if(!is_admin()):
			$wh = "regional='' OR regional='".session_scope_regional()."' OR regional is null";
			$this->db->where($wh);
		endif;
		$pc = $this->db->get('product_category')->result_array();
		$pc = arr($pc, 'code', 'name');
		if(!empty($pc)):

			switch ($type) {
				case 'json':
					foreach ($pc as $key => $value) {
						$options[$key] = $value;
					}
					break;
				
				default:
					foreach($pc as $key=>$val):
						$options .= '<option value="'.$key.'">'.$val.'</option>';
					endforeach;
					break;
			}

		endif;
		return $options;
	}

	function product_lists($product_category, $product_id='',$type='html')
	{
		if($product_id !='' && $product_id!='0'):
			$current = un_filter_serialthis($product_id);
		else:
			$current = array();
		endif;
		// pre($current);
		$dt_current = array();
		$html = $type=='html' ? '' : array();
		$product = $this->get_product_by_category($product_category);
		if(!empty($product)):
			switch ($type) {
				case 'json':
					$html = $product;
					break;
				
				default:
					$html .= '<table class="table table-product-picker table-bordered">';
					foreach($product as $row):
						// pre($row);

						if($product_id !=''):
							$row['checked'] = (array_key_exists($row['code'], $current)) ? 'checked' : '';
							$row['current_val'] = (isset($current[$row['code']]['product_value'])) ? $current[$row['code']]['product_value'] : '';
							$row['current_satuan'] = (isset($current[$row['code']]['satuan_bandwidth'])) ? $current[$row['code']]['satuan_bandwidth'] : '';
							$row['current_price'] = (isset($current[$row['code']]['product_price'])) ? $current[$row['code']]['product_price'] : '';
							$row['current_note'] = (isset($current[$row['code']]['product_note'])) ? $current[$row['code']]['product_note'] : '';
						else:
							$row['checked'] = '';
							$row['current_val'] = '';
							$row['current_satuan'] = 'Mbps';
							$row['current_price'] = '';
							$row['current_note'] = '';
						endif;

						$html .= $this->load->view('customer_product_picker/selector', $row, TRUE);
						$dt_current[] = $row;
					endforeach;
					$html .= '</table>';

					if ($product_category=='fo') {
						$dt_pro['data'] = $current;
						$html .= $this->load->view('customer_product_picker/site_fo', $dt_pro, TRUE);
					}

					$html .= $this->load->view('customer_product_picker/jst', '', TRUE);
					break;
			}
			
		endif;
		return $html;
	}

	function get_product_by_category($product_category)
	{
		$this->db->order_by('sort', 'asc');

		$wh = "(product.regional='' OR product.regional='".session_scope_regional()."' OR product.regional is null)";
		$this->db->where($wh);

		$this->db->where('product.category', $product_category);
		$this->db->select('product.*');
		$this->db->select('product_category.flag_packet');
		$this->db->join('product_category', 'product_category.code = product.category', 'left');
		return $this->db->get('product')->result_array();
	}

}
