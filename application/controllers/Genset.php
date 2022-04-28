<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Genset extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function sss()
	{
		$options = array();
		$options['component'] = 'component/tab/tab_default';
		$options['tab_id'] = 'tab1';
		$options['tab_padding'] = 'no';
		$options['max'] = '8';
		$options['selected_tab'] = 'focus_data_pasien';
		$options['tabs'] = array();

		$options['tabs'][] = array(
				'label'         => 'Survey',
				'id'            => 'survey',
				'content'       => 'dashboard_widget_survey',
			);

		$options['tabs'][] = array(
				'label'         => 'Installasi',
				'id'            => 'installasi',
				'content'       => 'dashboard_widget_installasi',
			);

		$options['tabs'][] = array(
				'label'         => 'Dismantle',
				'id'            => 'dismantle',
				'content'       => 'dashboard_widget_dismantle',
			);
		$options['tabs'][] = array(
				'label'         => 'Replace',
				'id'            => 'replace',
				'content'       => 'dashboard_widget_replace',
			);
		$options['tabs'][] = array(
				'label'         => 'General',
				'id'            => 'general',
				'content'       => 'dashboard_widget_general',
			);
		pre($options);
	}



	function arrtoser()
	{
		$tabs = array();

		// request barang keluar
		// $tabs[] = array(
		// 		'label'         => 'Request',
		// 		'id'            => 'dashboard_ro_request',
		// 		'content'       => '',
		// 	);
		//
		// $tabs[] = array(
		// 		'label'         => 'Approved',
		// 		'id'            => 'dashboard_ro_approved',
		// 		'content'       => '',
		// 	);

		// request barang masuk
		$tabs[] = array(
				'label'         => 'Request',
				'id'            => 'dashboard_ri_request',
				'content'       => '',
			);

		$tabs[] = array(
				'label'         => 'Approved',
				'id'            => 'dashboard_ri_approved',
				'content'       => '',
			);



		//marketing request

		// $tabs[] = array(
		// 		'label'         => 'Admin Sales',
		// 		'id'            => 'dashboard_mr_admin_sales',
		// 		'content'       => '',
		// 	);
		//
		// $tabs[] = array(
		// 		'label'         => 'Belum Dijadwalkan',
		// 		'id'            => 'dashboard_mr_belum_dijadwalkan',
		// 		'content'       => '',
		// 	);
		//
		// $tabs[] = array(
		// 		'label'         => 'Sudah Dijadwalkan',
		// 		'id'            => 'dashboard_mr_sudah_dijadwalkan',
		// 		'content'       => '',
		// 	);

		//task teknis

		// $tabs[] = array(
		// 		'label'         => 'Survey',
		// 		'id'            => 'survey',
		// 		'content'       => 'dashboard_widget_survey',
		// 	);
		//
		// $tabs[] = array(
		// 		'label'         => 'Installasi',
		// 		'id'            => 'installasi',
		// 		'content'       => 'dashboard_widget_installasi',
		// 	);
		//
		// $tabs[] = array(
		// 		'label'         => 'Dismantle',
		// 		'id'            => 'dismantle',
		// 		'content'       => 'dashboard_widget_dismantle',
		// 	);
		// $tabs[] = array(
		// 		'label'         => 'Replace',
		// 		'id'            => 'replace',
		// 		'content'       => 'dashboard_widget_replace',
		// 	);
		// $tabs[] = array(
		// 		'label'         => 'General',
		// 		'id'            => 'general',
		// 		'content'       => 'dashboard_widget_general',
		// 	);
		// pre($tabs);
		$ser = serialthis($tabs);
		echo $ser;
	}

	function sertoarr()
	{
		$ser = 'YToxOntzOjQ6InRhYnMiO2E6NTp7aTowO2E6Mzp7czo1OiJsYWJlbCI7czo2OiJTdXJ2ZXkiO3M6MjoiaWQiO3M6Njoic3VydmV5IjtzOjc6ImNvbnRlbnQiO3M6MjM6ImRhc2hib2FyZF93aWRnZXRfc3VydmV5Ijt9aToxO2E6Mzp7czo1OiJsYWJlbCI7czoxMDoiSW5zdGFsbGFzaSI7czoyOiJpZCI7czoxMDoiaW5zdGFsbGFzaSI7czo3OiJjb250ZW50IjtzOjI3OiJkYXNoYm9hcmRfd2lkZ2V0X2luc3RhbGxhc2kiO31pOjI7YTozOntzOjU6ImxhYmVsIjtzOjk6IkRpc21hbnRsZSI7czoyOiJpZCI7czo5OiJkaXNtYW50bGUiO3M6NzoiY29udGVudCI7czoyNjoiZGFzaGJvYXJkX3dpZGdldF9kaXNtYW50bGUiO31pOjM7YTozOntzOjU6ImxhYmVsIjtzOjc6IlJlcGxhY2UiO3M6MjoiaWQiO3M6NzoicmVwbGFjZSI7czo3OiJjb250ZW50IjtzOjI0OiJkYXNoYm9hcmRfd2lkZ2V0X3JlcGxhY2UiO31pOjQ7YTozOntzOjU6ImxhYmVsIjtzOjc6IkdlbmVyYWwiO3M6MjoiaWQiO3M6NzoiZ2VuZXJhbCI7czo3OiJjb250ZW50IjtzOjI0OiJkYXNoYm9hcmRfd2lkZ2V0X2dlbmVyYWwiO319fQ==
';
		$arr = unserialthis($ser);
		pre($arr);
	}

	function form_db($table='regional', $modul='xxx', $suffix='insert')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');


		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				// echo '$lang[\''.$table.'_'.$row->name.'\'] = \''.$row->name.'\';<br>';
				echo "INSERT INTO gmd_form (modul, section, view, form_name, form_id, form_class, maxlength) VALUES ('".$modul."', 'main', 'component/form/input_text', '".$row->name."', '".$row->name."', 'form-control', '500');<br>";
			endif;
		endforeach;

	}

	function aki($table='task', $modul='xxx', $suffix='insert')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');


		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				// echo '$lang[\''.$table.'_'.$row->name.'\'] = \''.$row->name.'\';<br>';
				echo " '".$row->name."'  => (isset([dolar]params['".$row->name."']) && [dolar]params['".$row->name."'] !='') ? [dolar]params['".$row->name."'] : '',<br>";
			endif;
		endforeach;

	}

	function cus($table='customer', $modul='xxx', $suffix='insert')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array();


		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):

				echo " ".$row->name." ,<br>";
			endif;
		endforeach;

	}

	///migrasi product
	function product_migrasi()
	{
		$customer = "SELECT *
						FROM gmd_customer

						ORDER BY `order` ASC , `group_order` ASC
					";
		// pre($customer);
		// exit;

		$query = $this->db->query($customer);
		$data = $query->result_array();
		foreach($data as $row):
			$sid = $this->db->query("
									SELECT * FROM {PRE}customer_product
									LEFT JOIN {PRE}
									WHERE customer_id='".$row['id']."'
			")->result_array();
			// pre($row);
			if(!empty($sid)):
				pre($row['customer_name']);
			endif;

		endforeach;
	}

	function cek_product()
	{
		$ad = $this->db->query('select distinct(product_id) as pid from gmd_customer_product')->result_array();
		foreach($ad as $rt):
			// pre($rt);

			$ada = $this->db->query("SELECT * FROM {PRE}product WHERE code='".$rt['pid']."'")->row_array();
			// if(empty($ada)):
			// 	pre($rt['pid']);
			// endif;
			$ppp = $ada['name'];

			echo $rt['pid'].' ---  '.$ppp.'<hr>';

		endforeach;
	}

	function repair_product($pcod='96')
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

	function cse()
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


}
