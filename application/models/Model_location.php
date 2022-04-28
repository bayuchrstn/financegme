<?php
class Model_location extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_all_location()
	{
		return $this->db->get('location')->result_array();
	}

    // general----------------
    function arr_location()
	{
		$arr = array();
		$all = $this->get_all_location();
		if(!empty($all)):
			foreach($all as $row):
				$arr[$row['code']] = $row['name'];
			endforeach;
		endif;
		return $arr;
	}

    function arr_location_id($location, $modul='')
	{
		$arr_table_item_id = array('customer', 'pre_customer', 'bts');
		if($location !='' && in_array($location, $arr_table_item_id)):
			switch ($location) {
				case 'pre_customer':
					$this->scope->where('customer');
					// if(!modul_full_access($modul) && !modul_full_view($modul)):
					// 	$this->db->where('id_am', my_id());
					// endif;
					$this->db->where('status', 'pre_customer');

					$data = $this->db->get('customer')->result_array();
					$arr = arr($data, 'id', 'customer_name');
				break;

				case 'bts':
					$this->scope->where('bts');
					$data = $this->db->get('bts')->result_array();
					$arr = arr($data, 'id', 'bts_name');
				break;

				//customer
				default:
					$this->scope->where('customer');
					// if(!modul_full_access($modul) && !modul_full_view($modul)):
					// 	$this->db->where('id_am', my_id());
					// endif;

					$this->db->where('status', 'customer');
					$data = $this->db->get('customer')->result_array();
					$arr = arr($data, 'id', 'customer_name');
				break;
			}
		else:
			$arr = array();
		endif;
		return $arr;
	}
    // general----------------

	function arr_all_location()
	{
		$arr = array();
		$all = $this->get_all_location();
		if(!empty($all)):
			foreach($all as $row):
				$arr[$row['code']] = $row['name'];
			endforeach;
		endif;
		return $arr;
	}

	function get_location_id($location, $modul='')
	{
		$arr_table_item_id = array('customer', 'pre_customer', 'bts');
		if($location !='' && in_array($location, $arr_table_item_id)):
			switch ($location) {
				case 'pre_customer':
					$this->scope->where('customer');
					if(!modul_full_access($modul) && !modul_full_view($modul)):
						$this->db->where('id_am', my_id());
					endif;
					$this->db->where('status', 'pre_customer')
						->order_by('customer_name','asc');

					$data = $this->db->get('customer')->result_array();
					$arr = arr($data, 'id', 'customer_name');
				break;

				case 'bts':
					$this->scope->where('bts');
					$data = $this->db->get('bts')->result_array();
					$arr = arr($data, 'id', 'bts_name');
				break;

				//customer
				default:
					$this->scope->where('customer');
					if(!modul_full_access($modul) && !modul_full_view($modul)):
						$this->db->where('id_am', my_id());
					endif;

					$this->db->where('status', 'customer')
						->where('status_active !=','0')
						->order_by('customer_name','asc');
					$data = $this->db->get('customer')->result_array();

					$datax = array();
					foreach ($data as $row) {
						$datax[] = array(
							'id' => $row['id'],
							'customer_name' => $row['customer_name'].' - '.$row['service_id']
						);
					}

					$arr = arr($datax, 'id', 'customer_name');
				break;
			}
		else:
			$arr = array();
		endif;
		return $arr;
	}

	function get_location_id_pengajuan_barang($location)
	{
		$arr_table_item_id = array('customer', 'pre_customer', 'bts', 'customer_non');
		if($location !='' && in_array($location, $arr_table_item_id)):
			switch ($location) {
				case 'pre_customer':
					$this->scope->where('customer');
					$this->db->where('status', 'pre_customer');
					$this->db->order_by('customer_name', 'asc');

					$data = $this->db->get('customer')->result_array();
					$arr = arr($data, 'id', 'customer_name');
				break;

				case 'bts':
					$this->scope->where('bts');
					$this->db->order_by('bts_name', 'asc');
					$data = $this->db->get('bts')->result_array();
					$arr = arr($data, 'id', 'bts_name');
				break;

				case 'customer_non':
					$this->scope->where('customer');

					$this->db->where('status', 'customer');
					$this->db->where('status_active', '0');
					$this->db->order_by('customer_name', 'asc');
					$data = $this->db->get('customer')->result_array();

					$datax = array();
					foreach ($data as $row) {
						$datax[] = array(
							'id' => $row['id'],
							'customer_name' => $row['customer_name'].' - '.$row['service_id']
						);
					}

					$arr = arr($datax, 'id', 'customer_name');
					break;

				//customer
				default:
					$this->scope->where('customer');

					$this->db->where('status', 'customer');
					$this->db->where('status_active !=', '0');
					$this->db->order_by('customer_name', 'asc');
					$data = $this->db->get('customer')->result_array();

					$datax = array();
					foreach ($data as $row) {
						$datax[] = array(
							'id' => $row['id'],
							'customer_name' => $row['customer_name'].' - '.$row['service_id']
						);
					}

					$arr = arr($datax, 'id', 'customer_name');
				break;
			}
		else:
			$arr = array();
			if ($location != '') {
				$this->db->where('category', $location);
				$data = $this->db->get('master')->result_array();
				$arr = arr($data,'code','name');
			}
		endif;
		return $arr;
	}

	function location_id_info($location, $location_id)
	{
		$arr_table_item_id = array('customer', 'pre_customer', 'bts', 'customer_non');

		if($location !='' && in_array($location, $arr_table_item_id)):
			switch ($location) {
				case 'pre_customer':
				case 'customer': case '1': case '2': case 'customer_non':
					$this->db->where('id', $location_id);
					$data = $this->db->get('customer')->row_array();
					$opt = $data['customer_name'];
				break;

				case 'bts':
					$this->db->where('id', $location_id);
					$data = $this->db->get('bts')->row_array();
					$opt = $data['bts_name'];
				break;

				//customer
				default:
					$this->db->where('category', $location);
					$this->db->where('code', $location_id);
					$data = $this->db->get('master')->row_array();
                    // pre($this->db->last_query());
					$opt = $data['name'];
				break;
			}
		else:
			$opt = '';
			if ($location != '') {
				$this->db->select('master.code, master.name, location.name as category_name');
				$this->db->where('master.category', $location)
					->where('master.code', $location_id)
					->join('location', 'location.code = master.category', 'left');
				$data = $this->db->get('master')->row_array();
				$opt = is_null($data['category_name']) ? $data['name'] : $data['category_name'].' / '.$data['name'];
			}
		endif;
		return $opt;
	}

    function location_id_data($location, $location_id)
	{
		$arr_table_item_id = array('customer', 'pre_customer', 'bts', 'customer_non');

		if($location !='' && in_array($location, $arr_table_item_id)){
			switch ($location) {
				case 'pre_customer':
				case 'customer_non':
					$this->db->where('id', $location_id);
					$data = $this->db->get('customer')->row_array();
					$opt = $data;
				break;

				case 'bts':
					$this->db->where('id', $location_id);
					$data = $this->db->get('bts')->row_array();
					$opt = $data;
				break;

				//customer
				default:
					$this->db->where('id', $location_id);
					$data = $this->db->get('customer')->row_array();
                    // pre($this->db->last_query());
					$opt = $data;
				break;
			}

			if ($location=='pre_customer' || $location=='customer' || $location=='customer_non') {
				if ( empty($opt['contact_person']) || $opt['contact_person']=='' ) {
					$this->db->where('customer_id', $opt['id']);
					$contact = $this->db->get('contact_person',1,0)->row_array();
					$opt['contact_person'] = $contact['name'];
					$opt['telephone_home'] = $contact['telephone_home'];
					$opt['telephone_mobile'] = $contact['telephone_mobile'];
					$opt['telephone_work'] = $contact['telephone_office'];
					$opt['fax'] = $contact['fax'];
					$opt['email'] = $contact['email'];
				}
			}
		} else {
			$opt = array();
			if ($location != '') {
				$this->db->select('master.code, master.name, location.name as category_name');
				$this->db->where('master.category', $location)
					->where('master.code', $location_id)
					->join('location', 'location.code = master.category', 'left');
				$data = $this->db->get('master')->row_array();
				$location_name = is_null($data['category_name']) ? $data['name'] : $data['category_name'].' / '.$data['name'];
				$opt['location_name'] = $location_name;
			}
		}
		return $opt;
	}

    function show($location, $location_id, $mode='info')
    {
        // pre($location);
        // pre($location_id);
        if($mode=='info'):
            $info = $this->location_id_info($location, $location_id);
        else:
            $info = $this->location_id_data($location, $location_id);
        endif;
		return $info;
    }


}
