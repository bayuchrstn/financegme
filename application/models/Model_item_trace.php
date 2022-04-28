<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_item_trace extends CI_Model {

	function barang_customer($status='', $search='')
	{
		$search = trim($search);
		$arr = array();
		$this->db->select('item_transaction.id');
		$this->db->from('item_transaction')
			->join('customer','customer.id = item_transaction.location_id');

		if ($status!='') {
			$this->db->where('item_transaction.status', $status);
		}

		$this->db->group_start()
			->where('item_transaction.location', '1')
			->or_where('item_transaction.location', 'customer')
			->or_where('item_transaction.location', 'pre_customer')
			->group_end();
		$recordsTotal = $this->db->get()->num_rows();

		$this->db->select('item_transaction.id as id_transaction, item_transaction.id_item_detail, item_transaction.id_item, item_transaction.location, item_transaction.location_id, item_transaction.status as status_barang, item.item_name, customer.customer_name, category.item_categories as category_name, brand.item_categories as brand_name, item_detail.nomor_barang, item_detail.barcode, item_detail.mac_address');
		$this->db->from('item_transaction');
		$this->db->join('item', 'item.id = item_transaction.id_item', 'left')
			->join('item_detail','item_detail.id = item_transaction.id_item_detail','left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left')
			->join('customer','customer.id = item_transaction.location_id');

		if ($status!='') {
			$this->db->where('item_transaction.status', $status);
		}

		$this->db->group_start()
			->where('item_transaction.location', '1')
			->or_where('item_transaction.location', 'customer')
			->or_where('item_transaction.location', 'pre_customer')
			->group_end();
		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('customer.customer_name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search);

		if(modul_full_access('item_trace') || modul_full_view('item_trace')) {
			$this->db->or_like('item_detail.invoice_number', $search)
				->or_like('item_detail.buy_date', $search);
		}

		$this->db->group_end();
		$this->db->order_by('item_transaction.id_item_detail', 'asc');
		$query = $this->db->get();

		$recordsFiltered = $query->num_rows();
		$data = $query->result_array();

		$arr = array(
			'recordsTotal'	=> $recordsTotal,
			'recordsFiltered'	=> $recordsFiltered,
			'data'	=> $data,
		);
		return $arr;
	}

	function barang_bts($status='', $search='')
	{
		$search = trim($search);
		$arr = array();
		$this->db->select('item_transaction.id');
		$this->db->from('item_transaction');
		$this->db->join('bts','bts.id = item_transaction.location_id');
		$this->db->group_start()
			->where('item_transaction.location', 'bts')
			->or_where('item_transaction.location', '2')
			->group_end();		

		if ($status!='') {
			$this->db->where('item_transaction.status', $status);
		}

		$recordsTotal = $this->db->get()->num_rows();

		$this->db->select('item_transaction.id as id_transaction, item_transaction.id_item_detail, item_transaction.id_item, item_transaction.location, item_transaction.location_id, item_transaction.status as status_barang, item.item_name, bts.bts_name as customer_name, category.item_categories as category_name, brand.item_categories as brand_name, item_detail.nomor_barang, item_detail.barcode, item_detail.mac_address');
		$this->db->from('item_transaction');
		$this->db->join('item', 'item.id = item_transaction.id_item', 'left')
			->join('item_detail','item_detail.id = item_transaction.id_item_detail','left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left')
			->join('bts','bts.id = item_transaction.location_id');
		$this->db->group_start()
			->where('item_transaction.location', 'bts')
			->or_where('item_transaction.location', '2')
			->group_end();

		if ($status!='') {
			$this->db->where('item_transaction.status', $status);
		}

		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('bts.bts_name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search);
		
		if(modul_full_access('item_trace') ||modul_full_view('item_trace')) {
			$this->db->or_like('item_detail.invoice_number', $search)
				->or_like('item_detail.buy_date', $search);
		}

		$this->db->group_end();
		$this->db->order_by('item_transaction.id_item_detail', 'asc');
		$query = $this->db->get();

		$recordsFiltered = $query->num_rows();
		$data = $query->result_array();

		$arr = array(
			'recordsTotal'	=> $recordsTotal,
			'recordsFiltered'	=> $recordsFiltered,
			'data'	=> $data,
		);
		return $arr;
	}

	function barang_master($status='', $search='')
	{
		$search = trim($search);
		$arr = array();
		$this->db->select('item_transaction.id');
		$this->db->from('item_transaction');
		$this->db->join('master','master.code = item_transaction.location_id AND master.category = item_transaction.location');
		$this->db->group_start()
			->where('item_transaction.location', 'nap')
			->or_where('item_transaction.location', 'gmedia')
			->or_where('item_transaction.location', 'noc_jogja')
			->or_where('item_transaction.location', 'noc_jakarta')
			->group_end();		

		if ($status!='') {
			$this->db->where('item_transaction.status', $status);
		}

		$recordsTotal = $this->db->get()->num_rows();

		$this->db->select('item_transaction.id as id_transaction, item_transaction.id_item_detail, item_transaction.id_item, item_transaction.location, item_transaction.location_id, item_transaction.status as status_barang, item.item_name, master.name as customer_name, category.item_categories as category_name, brand.item_categories as brand_name, item_detail.nomor_barang, item_detail.barcode, item_detail.mac_address');
		$this->db->from('item_transaction');
		$this->db->join('item', 'item.id = item_transaction.id_item', 'left')
			->join('item_detail','item_detail.id = item_transaction.id_item_detail','left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left')
			->join('master','master.code = item_transaction.location_id AND master.category = item_transaction.location');
		$this->db->group_start()
			->where('item_transaction.location', 'nap')
			->or_where('item_transaction.location', 'gmedia')
			->or_where('item_transaction.location', 'noc_jogja')
			->or_where('item_transaction.location', 'noc_jakarta')
			->group_end();

		if ($status!='') {
			$this->db->where('item_transaction.status', $status);
		}

		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('master.name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search);

		if(modul_full_access('item_trace') ||modul_full_view('item_trace')) {
			$this->db->or_like('item_detail.invoice_number', $search)
				->or_like('item_detail.buy_date', $search);
		}
		$this->db->group_end();
		$this->db->order_by('item_transaction.id_item_detail', 'asc');
		$query = $this->db->get();

		$recordsFiltered = $query->num_rows();
		$data = $query->result_array();

		$arr = array(
			'recordsTotal'	=> $recordsTotal,
			'recordsFiltered'	=> $recordsFiltered,
			'data'	=> $data,
		);
		return $arr;
	}

	function barang_available()
	{
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');
		$draw = $this->input->post('draw');
		$start  = $this->input->post('start');
		$length = $this->input->post('length');

		$orderByColumnIndex  = $post_order[0]['column'];
	    $orderBy = $post_columns[$orderByColumnIndex]['name'];
	    $orderType = $post_order[0]['dir'];

		// Edit Here
		$this->db->where('item_detail.item_status', 'available');
		$recordsTotal = $this->db->get('item_detail')->num_rows();

		if( $post_search['value'] ):
			// search
			$post_search['value'] = trim($post_search['value']);
			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
				$column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
			}
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";

			// new search
			$search = trim($post_search['value']);
			$this->db->group_start()
				->like('item.item_name', $search)
				->or_like('category.item_categories', $search)
				->or_like('brand.item_categories', $search)
				->or_like('item_detail.nomor_barang', $search)
				->or_like('item_detail.barcode', $search)
				->or_like('item_detail.mac_address', $search);
			
			if(modul_full_access('item_trace') ||modul_full_view('item_trace')) {
				$this->db->or_like('item_detail.invoice_number', $search)
					->or_like('item_detail.buy_date', $search);
			}

			$this->db->group_end();
			// end search

			// sort
			$this->db->order_by($orderBy, $orderType);

			// next query
			// $this->db->where( $where_string );
			$this->db->where('item_detail.item_status', 'available');
			$this->db->select('item_detail.id as item_detail_id, item_detail.*, item.item_name, category.item_categories as category_name, brand.item_categories as brand_name');
			$this->db->join('item', 'item.id = item_detail.item_id', 'left')
				->join('item_categories as category','category.id = item.category_id','left')
				->join('item_categories as brand','brand.id = item.brand','left');
			$query = $this->db->get('item_detail', $length, $start);


			// $this->db->where( $where_string );
			$search = $post_search['value'];
			$this->db->group_start()
				->like('item.item_name', $search)
				->or_like('category.item_categories', $search)
				->or_like('brand.item_categories', $search)
				->or_like('item_detail.nomor_barang', $search)
				->or_like('item_detail.barcode', $search)
				->or_like('item_detail.mac_address', $search);
			
			if(modul_full_access('item_trace') ||modul_full_view('item_trace')) {
				$this->db->or_like('item_detail.invoice_number', $search)
					->or_like('item_detail.buy_date', $search);
			}

			$this->db->group_end();

			$this->db->where('item_detail.item_status', 'available');
			$this->db->select('item_detail.*, category.item_categories as category_name, brand.item_categories as brand_name');
			$this->db->join('item', 'item.id = item_detail.item_id', 'left')
				->join('item_categories as category','category.id = item.category_id','left')
				->join('item_categories as brand','brand.id = item.brand','left');
			$recordsFiltered = $this->db->get('item_detail')->num_rows();
		else:
			// sort
			$this->db->order_by($orderBy, $orderType);

			// next query
			$this->db->where('item_detail.item_status', 'available');
			$this->db->select('item_detail.id as item_detail_id, item_detail.*, item.item_name, category.item_categories as category_name, brand.item_categories as brand_name');
			$this->db->join('item', 'item.id = item_detail.item_id', 'left')
				->join('item_categories as category','category.id = item.category_id','left')
				->join('item_categories as brand','brand.id = item.brand','left');

			$query = $this->db->get("item_detail", $length, $start);
			$recordsFiltered = $recordsTotal;
		endif;

		$data['data'] = $query->result_array();
		$data['draw'] = intval($draw);
		$data['recordsTotal'] = $recordsTotal;
		$data['recordsFiltered'] = $recordsFiltered;
		return $data;
	}

	function detail($id_transaction)
	{
		$lokasi = $this->db->select('location')->where('id',$id_transaction)->get('item_transaction')->row()->location;
		$this->db->select('item_transaction.id as id_transaction, item_transaction.id_item_detail, item_transaction.id_item, item_transaction.location, item_transaction.location_id, item_transaction.status as status_barang, item_transaction.date_install, item.item_name, category.item_categories as category_name, brand.item_categories as brand_name, item_detail.nomor_barang, item_detail.barcode, item_detail.mac_address');

		if ($lokasi=='bts' || $lokasi=='2') {
			$this->db->select('bts.bts_name AS location_name');
			$this->db->join('bts', 'bts.id = item_transaction.location_id', 'left');
		} elseif ($lokasi=='1' || $lokasi=='customer' || $lokasi=='pre_customer') {
			$this->db->select('customer.customer_name AS location_name');
			$this->db->join('customer', 'customer.id = item_transaction.location_id', 'left');
		} else {
			$this->db->select('master.name AS location_name');
			$this->db->join('master', 'master.code = item_transaction.location_id AND master.category = item_transaction.location', 'left');
		}

		$this->db->from('item_transaction');
		$this->db->join('item', 'item.id = item_transaction.id_item', 'left')
			->join('item_detail','item_detail.id = item_transaction.id_item_detail','left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$this->db->where('item_transaction.id', $id_transaction);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}

	function get_item_garansi($length=10, $start=0, $search='')
	{
		$arr = array();
		$this->db->select('item_detail.id');
		$this->db->where('item_status', 'garansi');
		$this->db->join('item', 'item.id = item_detail.item_id', 'left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$recordsTotal = $this->db->get('item_detail')->num_rows();

		$this->db->select('item_detail.id');
		$this->db->where('item_status', 'garansi');
		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search)
			->group_end();
		$this->db->join('item', 'item.id = item_detail.item_id', 'left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$recordsFiltered = $this->db->get('item_detail')->num_rows();

		$this->db->select('item_detail.id as item_detail_id, item.item_name, category.item_categories as category_name, brand.item_categories as brand_name, item_detail.nomor_barang, item_detail.barcode, item_detail.mac_address');
		$this->db->where('item_status', 'garansi');
		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search)
			->group_end();
		$this->db->join('item', 'item.id = item_detail.item_id', 'left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$data = $this->db->get('item_detail', $length, $start)->result_array();

		$arr = array(
			'recordsTotal'	=> $recordsTotal,
			'recordsFiltered'	=> $recordsFiltered,
			'data'	=> $data
		);
		return $arr;
	}

	function get_item_approved_out($length=10, $start=0, $search='')
	{
		$arr = array();
		$this->db->select('item_detail.id');
		$this->db->where('item_status', 'approved_out');
		$this->db->join('item', 'item.id = item_detail.item_id', 'left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$recordsTotal = $this->db->get('item_detail')->num_rows();

		$this->db->select('item_detail.id');
		$this->db->where('item_status', 'approved_out');
		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search)
			->group_end();
		$this->db->join('item', 'item.id = item_detail.item_id', 'left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$recordsFiltered = $this->db->get('item_detail')->num_rows();

		$this->db->select('item_detail.id as item_detail_id, item.item_name, category.item_categories as category_name, brand.item_categories as brand_name, item_detail.nomor_barang, item_detail.barcode, item_detail.mac_address');
		$this->db->where('item_status', 'approved_out');
		$this->db->group_start()
			->like('item.item_name', $search)
			->or_like('category.item_categories', $search)
			->or_like('brand.item_categories', $search)
			->or_like('item_detail.nomor_barang', $search)
			->or_like('item_detail.barcode', $search)
			->or_like('item_detail.mac_address', $search)
			->group_end();
		$this->db->join('item', 'item.id = item_detail.item_id', 'left')
			->join('item_categories as category','category.id = item.category_id','left')
			->join('item_categories as brand','brand.id = item.brand','left');
		$data = $this->db->get('item_detail', $length, $start)->result_array();

		$arr = array(
			'recordsTotal'	=> $recordsTotal,
			'recordsFiltered'	=> $recordsFiltered,
			'data'	=> $data
		);
		return $arr;
	}

	function tabs()
	{
		$arr = array();

		$status_code = $this->db->select('status')->group_by('status')->get('item_transaction')->result_array();

		if(modul_full_access('item_trace') ||modul_full_view('item_trace')) {
			$arr[] = array(
				'label'	=> 'Available',
				'id'	=>'available',
				'table_columns'	=> array(
					array('label'   => '#', 'width'=>'5'),
					array('label'	=> $this->lang->line('item_detail_name') ),
					array('label'	=> $this->lang->line('item_detail_no_item')),
					array('label'	=> $this->lang->line('item_detail_mac')),
					array('label'	=> $this->lang->line('all_action'), 'width'=>'80'),
				)
			);
			$arr[] = array(
				'label'	=> 'Approved Out',
				'id'	=>'approved_out',
				'table_columns'	=> array(
					array('label'   => '#', 'width'=>'5'),
					array('label'	=> $this->lang->line('item_detail_name') ),
					array('label'	=> $this->lang->line('item_detail_no_item')),
					array('label'	=> $this->lang->line('item_detail_mac')),
					array('label'	=> $this->lang->line('all_action'), 'width'=>'80'),
				)
			);
		}

		$i = 0;
		foreach ($status_code as $row) {
			switch ($row['status']) {
				case 'install':
				case 'damage':
				case 'return':
					$status_name = array(
						'install'	=> 'Terpasang',
						'damage'	=> 'Rusak',
						'return'	=> 'Kembali'
					);
					$arr[] = array(
						'label'	=> $status_name[$row['status']],
						'id'	=> $row['status'],
						'table_columns'	=> array(
							array('label'   => '#', 'width'=>'5'),
							array('label'	=> $this->lang->line('item_detail_name') ),
							array('label'	=> $this->lang->line('item_detail_no_item')),
							array('label'	=> $this->lang->line('item_detail_mac')),
							array('label'	=> $this->lang->line('customer_customer_name')),
							array('label'	=> $this->lang->line('all_action'), 'width'=>'80'),
						)
					);
					break;
				
				default:
					// code...
					break;
			}

		}

		if(modul_full_access('item_trace') ||modul_full_view('item_trace')) {
			$arr[] = array(
				'label'	=> 'Garansi',
				'id'	=>'garansi',
				'table_columns'	=> array(
					array('label'   => '#', 'width'=>'5'),
					array('label'	=> $this->lang->line('item_detail_name') ),
					array('label'	=> $this->lang->line('item_detail_no_item')),
					array('label'	=> $this->lang->line('item_detail_mac')),
					array('label'	=> $this->lang->line('all_action'), 'width'=>'80'),
				)
			);
		}
		return $arr;
	}

	function get_item_terpasang_lokasi($item_detail)
	{
		$this->db->where('id_item_detail', $item_detail);
		$this->db->where('status', 'install');
		$this->db->order_by('id', 'desc');
		$q = $this->db->get('item_transaction');
		$data = $q->row_array();
		if (!empty($data)) {
			$lokasi = $data['location'];
			if ($lokasi=='bts' || $lokasi=='2') {
				$this->db->select('bts.bts_name AS location_name');
				$this->db->where('id', $data['location_id']);
				$q2 = $this->db->get('bts');
				$data['location_name'] = $q2->row()->location_name;
			} elseif ($lokasi=='1' || $lokasi=='customer' || $lokasi=='pre_customer') {
				$this->db->select('customer.customer_name AS location_name');
				$this->db->where('id', $data['location_id']);
				$q2 = $this->db->get('customer');
				$data['location_name'] = $q2->row()->location_name;
			} else {
				$this->db->select('master.name AS location_name');
				$this->db->where('code', $data['location_id']);
				$this->db->where('category', $lokasi);
				$q2 = $this->db->get('master');
				$data['location_name'] = $q2->row()->location_name;
			}

			if (!isset($data['kepemilikan'])) {
				$this->db->select('master.name AS kepemilikan');
				$this->db->where('location', $lokasi);
				$this->db->where('location_id', $data['location_id']);
				$this->db->join('task_item_out', 'task_item_out.task_id = task.id');
				$this->db->join('master', 'master.code = task_item_out.owner_status AND master.category = \'item_installed_owner_status\'', 'left');
				$this->db->order_by('task.id', 'desc');
				$q2 = $this->db->get('task');
				$data_kepemilikan = $q2->row_array();
				$data['kepemilikan'] = !empty($data_kepemilikan) ? $data_kepemilikan['kepemilikan'] : '';
			}
		}
		return $data;
	}

}

/* End of file Model_item_trace.php */
/* Location: ./application/models/Model_item_trace.php */