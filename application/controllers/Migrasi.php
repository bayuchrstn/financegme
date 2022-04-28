<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrasi extends MY_Controller {
	function __construct()
	{
		parent::__construct();

	}

	function customer_group()
	{

		// create table gmd_customer_group_lawas select * from app_lawas.inv_customer_group;
		// create table gmd_customer_lawas select * from app_lawas.inv_customer;



		$fields_baru = $this->db->field_data('customer_group');
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		$kata = "INSERT INTO gmd_customer_group (";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):
				$fsd .= '`'.$row->name.'`, ';
			endif;
		endforeach;

		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= ") ";

		$kata .= "SELECT ";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):

				switch ($row->name) {
					case 'id_am':
						$fn = '`id_user`, ';
					break;

					case 'regional':
						$fn = 'CONCAT("01"), ';
					break;

					case 'area':
						$fn = 'CONCAT("jogja"), ';
					break;

					default:
						$fn = '`'.$row->name.'`, ';
					break;
				}

				$fsd .= $fn;
			endif;
		endforeach;
		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= " FROM app_lawas.inv_customer_group";



		echo $kata;
	}

	function customer()
	{

		// create table gmd_customer_group_lawas select * from app_lawas.inv_customer_group;
		// create table gmd_customer_lawas select * from app_lawas.inv_customer;



		$fields_baru = $this->db->field_data('customer');
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		$kata = "INSERT INTO gmd_customer (";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):
				$fsd .= '`'.$row->name.'`, ';
			endif;
		endforeach;

		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= ") ";

		$kata .= "SELECT ";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):

				switch ($row->name) {
					case 'id_am':
						$fn = '`id_user`, ';
					break;

					case 'regional':
						$fn = 'CONCAT("01"), ';
					break;

					case 'area':
						$fn = 'CONCAT("jogja"), ';
					break;

					case 'invoice_category':
						$fn = 'CONCAT("invoice_category"), ';
					break;

					case 'product_category':
						$fn = 'CONCAT(""), ';
					break;

					case 'latitude':
						$fn = 'CONCAT(""), ';
					break;

					case 'longitude':
						$fn = 'CONCAT(""), ';
					break;

					default:
						$fn = '`'.$row->name.'`, ';
					break;
				}

				$fsd .= $fn;
			endif;
		endforeach;
		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= " FROM app_lawas.inv_customer";



		echo $kata;
	}

	function customer_product($old_table="app_lawas.inv_customer_service")
	{

		// create table gmd_customer_group_lawas select * from app_lawas.inv_customer_group;
		// create table gmd_customer_lawas select * from app_lawas.inv_customer;



		$fields_baru = $this->db->field_data('customer_product');
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		$kata = "INSERT INTO gmd_customer_product (";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):
				$fsd .= '`'.$row->name.'`, ';
			endif;
		endforeach;

		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= ") ";

		$kata .= "SELECT ";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):

				switch ($row->name) {
					case 'product_id_new':
						$fn = '`product_id`, ';
					break;

					default:
						$fn = '`'.$row->name.'`, ';
					break;
				}

				$fsd .= $fn;
			endif;
		endforeach;
		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= " FROM ".$old_table;

		echo $kata;
	}

	function repair_customer_product($pcod='96')
	{
		$pd = $this->db->query("select * from gmd_customer_product where product_id='".$pcod."'")->result_array();
		foreach($pd as $row):
			// pre($row);
			$sour = $this->db->query("select * from app_lawas.inv_product WHERE up='".$pcod."' AND price='".$row['product_price']."'")->row_array();
			// pre($sour);

			$data['product_id'] = $sour['id'];
			$this->db->where('id', $row['id']);
			$this->db->update('customer_product', $data);
			pre($this->db->last_query());
		endforeach;
	}


	//sebelum ini direpair dulu pakai function diatas repair_customer_product
	function penyesuaian_product_customer()
	{
		$pr = $this->db->get('customer_product')->result_array();
		foreach($pr as $row):
			// pre($row);
			$sour = $this->db->query("select * from gmd_product WHERE code='".$row['product_id']."' ")->row_array();
			// pre($sour);
			$data['product_category'] = $sour['category'];
			$this->db->where('id', $row['customer_id']);
			$this->db->update('customer', $data);
			pre($this->db->last_query());
		endforeach;
	}

	function user($old_table='app_lawas.inv_users')
	{

		$fields_baru = $this->db->field_data('users');
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array();

		$kata = "INSERT INTO gmd_users (";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):
				$fsd .= '`'.$row->name.'`, ';
			endif;
		endforeach;

		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= ") ";

		$kata .= "SELECT ";
		$fsd = '';
		foreach($fields_baru as $row):
			if(!in_array($row->name, $exlude)):

				switch ($row->name) {
					case 'status':
						$fn = '`active`, ';
					break;

					// case 'regional':
					// 	$fn = 'CONCAT("01"), ';
					// break;

					case 'level':
						$fn = 'CONCAT(""), ';
					break;

					case 'divisi':
						$fn = 'CONCAT(""), ';
					break;
					case 'department':
						$fn = 'CONCAT(""), ';
					break;

					case 'sub_department':
						$fn = 'CONCAT(""), ';
					break;

					case 'view_scope':
						$fn = 'CONCAT(""), ';
					break;
					case 'photo':
						$fn = 'CONCAT(""), ';
					break;

					case 'area':
						$fn = 'CONCAT("jogja"), ';
					break;

					case 'registration_date':
						$fn = 'CONCAT(""), ';
					break;

					case 'registration_key':
						$fn = 'CONCAT(""), ';
					break;

					case 'level_old':
						$fn = '`level`, ';
					break;



					default:
						$fn = '`'.$row->name.'`, ';
					break;
				}

				$fsd .= $fn;
			endif;
		endforeach;
		$kata .= substr($fsd, 0, strlen($fsd)-2);
		$kata .= " FROM ".$old_table;




		echo $kata;
	}

}
