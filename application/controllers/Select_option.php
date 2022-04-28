<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_option extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
	}

	function index($code='')
	{
		$this->$code();
	}

	function customer_type($type='html')
	{
		$options = $type=='json' ? array() : '';
		$data = $this->master->arr('customer_type');
		// pre($data);
		if(!empty($data)):
			foreach($data as $code=>$val):

				if ($type=='json') {
					$options[] = array(
						'code'	=> $code,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$code.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function link_type($type='html')
	{
		$options = $type=='json' ? array() : '';
		$data = $this->master->arr('link_type');
		// pre($data);
		if(!empty($data)):
			foreach($data as $code=>$val):
				if ($type=='json') {
					$options[] = array(
						'code'	=> $code,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$code.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function status_kepemilikan($type='html')
	{
		$options = $type=='json' ? array() : '';
		$data = $this->master->arr('item_installed_owner_status');
		// pre($data);
		if(!empty($data)):
			foreach($data as $code=>$val):
				if ($type=='json') {
					$options[] = array(
						'code'	=> $code,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$code.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function usergroup_active($type='html')
	{
		$this->load->model('model_customer', 'customer');
		$options = $type=='json' ? array() : '';
		$data = $this->customer->arr_usergroup_active();
		// pre($data);
		if(!empty($data)):
			foreach($data as $code=>$val):
				if ($type=='json') {
					$options[] = array(
						'code'	=> $code,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$code.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function my_pre_customer($type='html')
	{
		$this->load->model('Model_pre_customer', 'pre_customer');
		$options = $type=='json' ? array() : '';
		$data = $this->pre_customer->get_pre_customer_by_user(my_id());
		// pre($data);
		if(!empty($data)):
			foreach($data as $row):
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row['id'],
						'value'	=> $row['customer_name']
					);
				} else {
					$options .= '<option value="'.$row['id'].'">'.$row['customer_name'].'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function marketing_progress_category($customer_id='',$type='html')
	{
		$this->load->model('Model_marketing_progress', 'marketing_progress');
		$options = $type=='json' ? array() : '';
		$data = $this->marketing_progress->get_category($customer_id)['data'];
		// pre($data);
		if(!empty($data)):
			foreach($data as $row):
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row['code'],
						'value'	=> $row['name']
					);
				} else {
					if($row['code']=='mp_instalasi'):
						// if($this->marketing_progress->boleh_request_installasi($customer_id)):
							$options .= '<option value="'.$row['code'].'">'.$row['name'].'</option>';
						// endif;
					else:
						$options .= '<option value="'.$row['code'].'">'.$row['name'].'</option>';
					endif;
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function marketing_progress_search($mode='',$type='html')
	{
		$this->load->model('Model_marketing_progress', 'marketing_progress');
		$options = $type=='json' ? array() : '';
		$data = $this->marketing_progress->buil_search_param();
		$data = $data[$mode];
		// pre($data);
		if(!empty($data)):
			foreach($data as $row=>$val):
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$row.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function request($req_code, $mode='',$type='html')
	{
		// pre($req_code);
		// pre($mode);
		// pre($selected);
		$this->load->model('request/model_'.$req_code, $req_code);
		$options = $type=='json' ? array() : '';
		$data = $this->$req_code->build_select_option();
		$data = (isset($data[$mode])) ? $data[$mode] : array();
		// pre($data);
		if(!empty($data)):
			foreach($data as $row=>$val):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$row.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function karyawan($mode='', $type='html')
	{
		// pre($req_code);
		// pre($mode);
		// pre($selected);
		$this->load->model('Model_karyawan', 'karyawan');
		$options = $type=='json' ? array() : '';
		$data = $this->karyawan->build_select_option();
		$data = $data[$mode];
		// pre($data);
		if(!empty($data)):
			foreach($data as $row=>$val):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$row.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function customer($mode='',$type='html')
	{
		// pre($req_code);
		// pre($mode);
		// pre($selected);
		$this->load->model('Model_customer', 'customer');
		$options = $type=='json' ? array() : '';
		$data = $this->customer->build_select_option();
		$data = $data[$mode];
		// pre($data);
		if(!empty($data)):
			foreach($data as $row=>$val):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$row.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function user($mode='',$type='html')
	{
		// pre($req_code);
		// pre($mode);
		// pre($selected);
		$this->load->model('Model_user', 'user');
		$options = $type=='json' ? array() : '';
		$data = $this->user->build_select_option();
		$data = $data[$mode];
		// pre($data);
		if(!empty($data)):
			foreach($data as $row=>$val):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$row.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function dds($mode='', $parent='')
	{
		$this->load->model('Model_user', 'user');
		$this->load->model('Model_usergroup', 'usergroup');
		$options = $type=='json' ? array() : '';
		$data = $this->user->dds($mode, $parent);
		// pre($data);
		if(!empty($data)):
			foreach($data as $row=>$val):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row,
						'value'	=> $val
					);
				} else {
					$options .= '<option value="'.$row.'">'.$val.'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function level_jabatan()
	{
		$options = '';
		$options .= '<option value="divisi">Divisi</option>';
		$options .= '<option value="department">Department</option>';
		$options .= '<option value="sub_department">Sub Department</option>';
		echo $options;
	}

	function assign_to()
	{
		$options = '';
		$options .= '<option value="divisi">Divisi</option>';
		$options .= '<option value="department">Department</option>';
		$options .= '<option value="sub_department">Sub Department</option>';
		$options .= '<option value="user">User</option>';
		echo $options;
	}

	function yesno()
	{
		$options = '';
		$options .= '<option value="Y">Ya</option>';
		$options .= '<option value="N">Tidak</option>';
		echo $options;
	}

	function satunol()
	{
		$options = '';
		$options .= '<option value="1">Ya</option>';
		$options .= '<option value="0">Tidak</option>';
		echo $options;
	}

	function active()
	{
		$options = '';
		$options .= '<option value="active">Active</option>';
		$options .= '<option value="non_active">Non Active</option>';
		echo $options;
	}

	function approval()
	{
		$options = '';
		$options .= '<option value="disetujui">Disetujui</option>';
		$options .= '<option value="ditolak">Ditolak</option>';
		echo $options;
	}

	function kosong()
	{
		$options = '';
		echo $options;
	}

	function item_terpasang($location='', $location_id='',$type='html')
	{
		$options = $type=='json' ? array() : '';
		if($location != '' && $location_id != '' ):
			$this->load->model('Model_item_transaction', 'item_transaction');
			$item_terpasang = $this->item_transaction->item_terpasang($location, $location_id);
			// print_r($item_terpasang); exit();
			if(!empty($item_terpasang)):
				foreach($item_terpasang as $row):
					// pre($row);
					$bcn = $row['brand_name'].' - '.$row['category_name'].' - '.$row['item_name'];
					if ($type=='json') {
						$options[] = array(
							'code'	=> $row['item_id'],
							'value'	=> $bcn
						);
					} else {
						$options .= '<option value="'.$row['item_id'].'">'.$bcn.'</option>';
					}
				endforeach;
			endif;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function item_detail_terpasang($location, $location_id, $item,$type='html')
	{
		$options = $type=='json' ? array() : '';
		$this->load->model('Model_item_transaction', 'item_transaction');
		$data = $this->item_transaction->item_detail_terpasang($location, $location_id, $item);
		if(!empty($data)):
			foreach($data as $row):
				// pre($selected);
				$mac = ($row['mac_address'] !='') ? '  ---  '.$row['mac_address'] : '';
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row['id'].'|'.$row['transaction_id'],
						'value'	=> $row['nomor_barang'].$mac
					);
				} else {
					$options .= '<option value="'.$row['id'].'|'.$row['transaction_id'].'">'.$row['nomor_barang'].$mac.'</option>';
					}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function bts($location, $location_id, $item,$type='html')
	{
		$options = $type=='json' ? array() : '';
		$data = $this->db->get('bts')->result_array();
		if(!empty($data)):
			foreach($data as $row):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row['id'],
						'value'	=> $row['bts_name']
					);
				} else {
					$options .= '<option value="'.$row['id'].'">'.$row['bts_name'].'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function regional($type='html')
	{
		$options = $type=='json' ? array() : '';
		$this->db->where('up', '0');
		$data = $this->db->get('regional')->result_array();
		if(!empty($data)):
			if ($type!='json') {
				$options .= '<option value="">Semua regional</option>';
			}
			foreach($data as $row):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row['code'],
						'value'	=> $row['name']
					);
				} else {
					$options .= '<option value="'.$row['code'].'">'.$row['name'].'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function isp($type='html')
	{
		$options = $type=='json' ? array() : '';
		// $this->db->where('up', '0');
		$data = $this->db->get('isp')->result_array();
		if(!empty($data)):
			// $options .= '<option value="">Semua regional</option>';
			foreach($data as $row):
				// pre($selected);
				if ($type=='json') {
					$options[] = array(
						'code'	=> $row['id'],
						'name'	=> $row['name']
					);
				} else {
					$options .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			endforeach;
		endif;
		$result = $type=='json' ? encodeJson($options) : $options;
		echo $result;
	}

	function alert_interval()
	{
		$options = '';
		$options .= '<option value="900">15 Menit</option>';
		$options .= '<option value="1800">30 Menit</option>';
		$options .= '<option value="3600">1 Jam</option>';
		$options .= '<option value="7200">2 Jam</option>';
		$options .= '<option value="10800">3 jam</option>';
		echo $options;
	}

	function alert_max_show()
	{
		$options = '';
		for($i=1; $i<=10; $i++):
			$options .= '<option value="'.$i.'">'.$i.' Kali</option>';
		endfor;
		echo $options;
	}

}
