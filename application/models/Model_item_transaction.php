<?php
class Model_item_transaction extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function where_item_transaction($location, $location_id)
	{
		switch ($location) {
			case 'customer':
			case 'pre_customer':
			case 'customer_non':
			case '1':
				$keyword_one = '1'.$location_id;
				$keyword_two = 'customer'.$location_id;
				$keyword_three = '2'.$location_id;
				$keyword_four = 'pre_customer'.$location_id;
				$by_keyword = "(";
				$by_keyword .= "CONCAT(location, location_id)='".$keyword_one."' OR CONCAT(location, location_id)='".$keyword_two."'";
				// $by_keyword .= " OR CONCAT(location, location_id)='".$keyword_three."' OR CONCAT(location, location_id)='".$keyword_four."'";
				$by_keyword .= " OR CONCAT(location, location_id)='".$keyword_four."'";
				$by_keyword .= ")";
			break;

			case 'bts':
			case '2':
				$keyword_one = '2'.$location_id;
				$keyword_two = 'bts'.$location_id;
				$by_keyword = "(CONCAT(location, location_id)='".$keyword_one."' OR CONCAT(location, location_id)='".$keyword_two."')";
			break;

			default:
				// $by_keyword = 'umum';
				$keyword = $location.$location_id;
				$by_keyword = " CONCAT(location, location_id)='".$keyword."' ";
			break;
		}
		// pre($by_keyword);
		$this->db->where($by_keyword);
	}

	function list_item_terpasang($location, $location_id)
	{
		$this->where_item_transaction($location, $location_id);
		$this->db->where('item_transaction.status', 'install');
		// $this->db->join('Table', 'table.column = table.column', 'left');
		$data = $this->db->get('item_transaction')->result_array();
		// pre($data);
		return $data;
	}

	function item_terpasang($location, $location_id)
	{
		// pre($by_keyword);
		$this->db->order_by('brand.item_categories', 'asc');
		$this->db->order_by('item_categories.item_categories', 'asc');
		$this->db->order_by('item.item_name', 'asc');
		$this->db->group_by('item_transaction.id_item');
		$this->where_item_transaction($location, $location_id);
		$this->db->where('item_transaction.status', 'install');
		$this->db->select('item.id as item_id');
		$this->db->select('item.item_name as item_name');
		$this->db->select('item_categories.item_categories as category_name');
		$this->db->select('brand.item_categories as brand_name');
		$this->db->join('item', 'item.id = item_transaction.id_item', 'left');
		$this->db->join('item_categories', 'item.category_id = item_categories.id', 'left');
		$this->db->join('item_categories brand', 'item.brand = brand.id', 'left');
		$data= $this->db->get('item_transaction')->result_array();
		// $data['query'] = $this->db->last_query();
		// pre($data);
		return $data;
	}

	function item_detail_terpasang($location, $location_id, $item)
	{
		$this->where_item_transaction($location, $location_id);
		$this->db->where('id_item', $item);
		$this->db->where('item_transaction.status', 'install');
		$this->db->select('item_detail.nomor_barang');
		$this->db->select('item_detail.mac_address');
		$this->db->select('item_detail.id');
		$this->db->select('item_transaction.id as transaction_id');
		$this->db->join('item_detail', 'item_detail.id = item_transaction.id_item_detail', 'left');
		return $this->db->get('item_transaction')->result_array();
	}

	function item_detail_info($id)
	{
		$this->db->where('item_detail.id', $id);
		$this->db->select('item_detail.*');
		$this->db->select('cat.item_categories as cat_name');
		$this->db->select('brand.item_categories as brand_name');
		$this->db->select('item.item_name as item_name');
		$this->db->join('item', 'item.id = item_detail.item_id', 'left');
		$this->db->join('item_categories cat', 'cat.id = item.category_id', 'left');
		$this->db->join('item_categories brand', 'brand.id = item.brand', 'left');
		return $this->db->get('item_detail')->row_array();
	}

	function set_status_item_detail($id_item_detail, $status)
	{
		//master
		$this->db->query("UPDATE item_detail set item_status ='".$status."' WHERE id='".$id_item_detail."' ");

		//transaction
		// $this->db->query("UPDATE item_detail set item_status ='".$status."' WHERE id='".$id_item_detail."' ");
	}

	function get_transaction_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('item_transaction')->row_array();
	}

	function masuk($transaction_id)
	{
		$detail = $this->get_transaction_by_id($transaction_id);
	}


	// New
    //contoh penggunaan
    /*
    $this->item_transaction->set_status('12', master, 'available');
    $this->item_transaction->set_status('12', transaction, 'available');
    */

	function set_status($id, $where, $status)
	{
		switch ($where) {
			case 'master':
				$data = array(
						'item_status'	=> $status
					);
				$this->db->where('id', $id);
				$this->db->update('item_detail', $data);
			break;

			case 'transaction':
				$data = array(
						'status'	=> $status
					);
				$this->db->where('id', $id);
				$this->db->update('item_transaction', $data);
			break;

		}
	}

	function item_out_detail($id)
	{
		$this->db->where('task_item_out.id', $id);
		$this->db->select('task_item_out.*');
		$this->db->select('author.name as author_name');
		$this->db->select('user_approval.name as user_approval_name');
		$this->db->select('kepemilikan.name as kepemilikan_name');
		$this->db->join('users author', 'author.id = task_item_out.author', 'left');
		$this->db->join('users user_approval', 'user_approval.id = task_item_out.approved_by', 'left');
		$this->db->join('master kepemilikan', 'kepemilikan.code = task_item_out.owner_status', 'left');
		return $this->db->get('task_item_out')->row_array();
	}

    //function update status barang ketika item barang di request TS masuk ke WH
    function barang_request_in($transaction_id, $id_item_detail)
    {
        $this->set_status($id_item_detail, 'master', 'request_in');
        $this->set_status($transaction_id, 'transaction', 'request_in');
    }

    //ini untuk update status ketika
    //gak jadi request barang masuk ke gudang
    function cancel_request_in($transaction_id, $id_item_detail)
    {
        $this->set_status($id_item_detail, 'master', 'install');
        $this->set_status($transaction_id, 'transaction', 'install');
    }

    //ini untuk update status ketika
    //gudang "menerima" barang masuk gudang / Wh
    function approve_request_in($transaction_id, $id_item_detail)
    {
        $kondisi_barang_kembali = $this->input->post('return_status');

        switch ($kondisi_barang_kembali) {
            case 'garansi':
                $sta_item_detail = 'garansi';
                $sta_treans = 'return';
            break;

            case 'rusak':
                $sta_item_detail = 'damage';
                $sta_treans = 'damage';
            break;

            //baik
            default:
                $sta_item_detail = 'available';
                $sta_treans = 'return';
            break;
        }

        $this->set_status($id_item_detail, 'master', $sta_item_detail);
        $this->set_status($transaction_id, 'transaction', $sta_treans);
    }

}
