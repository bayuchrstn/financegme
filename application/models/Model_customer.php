<?php
class Model_customer extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_customer_name_by_array($arr)
	{
		$this->db->where_in('id', $arr);
		$this->db->select('customer_name, id');
		return $this->db->get('customer')->result_array();
	}

    function show_usergroup_active()
    {
        // $this->db->where('status', 'customer');
		$this->scope->where('customer_group');
        return $this->db->get('customer_group')->result_array();
    }

    function arr_usergroup_active()
    {
        $arr = array();
        $usergroup = $this->show_usergroup_active();
        if($usergroup):
            foreach($usergroup as $row):
                // pre($row);
                $arr[$row['id']] = $row['customer_name'];
            endforeach;
        endif;
        return $arr;
    }

    function get_customer_email($service_id)
    {
        $this->db->where('customer.id', $service_id);
        $this->db->select('customer_group.email');
        $this->db->join("customer_group", "customer.group_id=customer_group.id", "left");
        $dt = $this->db->get('customer')->row_array();
        // pre($dt['email']);
        return $dt['email'];
    }

    function all_customer()
    {
        // $this->db->where('status !=', 'need_approval');
        $this->db->where('status', 'customer');
        return $this->db->get('customer_group')->result_array();
    }

	function show($customer_id, $view)
	{
		$res = array();
		switch ($view) {

			case 'item_terpasang':
				$res['item_terpasang'] = $this->csi($customer_id);
			break;

			default:
				$res['customer_info'] = $this->detail_customer($customer_id);
			break;
		}
		return $res;
	}

    function all_service_id_info()
    {
        $arr = array();
        $this->db->where('status', 'customer');
        $this->db->group_by('group_id');
        $this->db->select('count(id) as jumlah_service');
        $this->db->select('customer.group_id');
        $this->db->select('customer.customer_name');
        $this->db->select('customer.customer_address');
        $sid =  $this->db->get('customer')->result_array();
        if(!empty($sid)):
            foreach($sid as $row):
                $arr[$row['group_id']] = array(
                    'sid_count'     => $row['jumlah_service'],
                    'keyword'       => $row['customer_name'].$row['customer_address'],
                );
            endforeach;
        endif;
        return $arr;
    }

    function datav($customer_group_id)
    {
        $this->db->where('group_id', $customer_group_id);
        return $this->db->get('customer')->result_array();
    }

    function get_product($customer_id)
    {
        $arr = array();
        $this->db->where('customer_id', $customer_id);
        $current = $this->db->get('customer_product')->result_array();
        if($current):
            foreach($current as $row):
                // pre($row);
                $arr[] = $row['product_code'];
            endforeach;
        endif;
        return $arr;
    }

	function get_product_serialize($customer_id)
    {
        $arr = array();
        $this->db->where('customer_id', $customer_id);
        $current = $this->db->get('customer_product')->result_array();
        if($current):
            foreach($current as $row):
                // pre($row);
                $arr[$row['product_id']] = $row;
            endforeach;
        endif;
		$opt = filter_serialthis($arr);
        return $opt;
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('customer_group')->row_array();
    }

    function get_customer_product($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->select('customer_product.*');
        $this->db->select('product.name as product_name, product.category as product_category');
        $this->db->join('product', 'product.code = customer_product.product_id', 'left');
        $current = $this->db->get('customer_product')->result_array();
        return $current;
    }

    function layanan_show($customer_id)
    {
        $arr = array();
        $produk = $this->get_customer_product($customer_id);
        if(!empty($produk)):
            foreach($produk as $row):
                // pre($row);
                $arr[] = array(
                    'product_category'  => $row['product_category'],
                    'product_name'                  => $row['product_name'],
                    'value'                         => $row['product_value'],
                    'satuan_bandwidth'              => $row['satuan_bandwidth'],
                    'product_price'                 => $row['product_price'],
                    'product_note'  => $row['product_note']
                );
            endforeach;
        endif;
        return $arr;
    }

	function detail_customer($id)
    {
        $arr = array();
        $this->db->where('customer.id', $id);
		$this->db->select('customer.*');
		$this->db->select('customer_type.name as mcustomer_type');
		$this->db->select('link_type.name as mlink_type');
		$this->db->select('author.name as author_name');
		$this->db->select('am.name as am_name, am.email as am_email');
		$this->db->select('product_category.name as product_category_name');
		$this->db->join('master customer_type', 'customer_type.code = customer.customer_type AND customer_type.category=\'customer_type\'', 'left');
		$this->db->join('master link_type', 'link_type.code = customer.link_type AND link_type.category=\'link_type\'', 'left');
		$this->db->join('users author', 'author.id = customer.id_user', 'left');
		$this->db->join('users am', 'am.id = customer.id_am', 'left');
		$this->db->join('product_category', 'product_category.code = customer.product_category', 'left');
        $detail = $this->db->get('customer')->row_array();
        if(!empty($detail)):
            $arr['layanan'] = $this->layanan_show($detail['id']);
            foreach($detail as $key=>$val):
                $arr[$key] = $val;
            endforeach;

            if ( empty($arr['contact_person']) || $arr['contact_person']=='' ) {
                $this->db->where('customer_id', $arr['id']);
                $contact = $this->db->get('contact_person',1,0)->row_array();
                $arr['contact_person'] = $contact['name'];
                $arr['telephone_home'] = $contact['telephone_home'];
                $arr['telephone_mobile'] = $contact['telephone_mobile'];
                $arr['telephone_work'] = $contact['telephone_office'];
                $arr['fax'] = $contact['fax'];
                $arr['email'] = $contact['email'];
            }

        endif;
        return $arr;
    }

    function valid_username($mode='insert', $username, $current='')
    {
        if($mode == 'insert'):
            $cek = $this->db->query("SELECT * FROM {PRE}customer WHERE username = '".$username."' ")->row_array();
            if(empty($cek)):
                return TRUE;
            else:
                return FALSE;
            endif;
        else:
            $cek = $this->db->query("SELECT * FROM {PRE}customer WHERE username = '".$username."' AND id != '".$current."'")->row_array();
            if(empty($cek)):
                return TRUE;
            else:
                return FALSE;
            endif;
        endif;
    }

    function customer_group_detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('customer_group')->row_array();
    }

    function save_customer_sid($customer_id='')
    {

		$res = array();
        //build array param
        $sid = $this->input->post('product_code');
        $product_value = $this->input->post('product_value');
        $product_satuan = $this->input->post('satuan_bandwith');
        $product_price = $this->input->post('product_price');

        // $res['string_key'] = array(
        //     // 'sid'              => $sid,
        //     'product_value'    => $product_value,
        //     'product_satuan'   => $product_satuan,
        //     'product_price'    => $product_price,
        // );

        $data = array();

		$string_key = "";
        if(!empty($sid)):
			$urut = 0;
            foreach($sid as $product_id):
				$string_key .= "'".$product_id."', ";
                $data[$product_id] = array(
	                	'product_value'   => (isset($product_value[$product_id])) ? $product_value[$product_id] : '',
	                  	'product_satuan'  => (isset($product_satuan[$product_id])) ? $product_satuan[$product_id] : '',
	                  	'product_price'  => (isset($product_price[$product_id])) ? $product_price[$product_id] : '',
	                );
				$urut++;
            endforeach;
        endif;
		// pre($data);

        $res['data'] = $data;
		$string_key = substr($string_key, 0, strlen($string_key)-2);

        //jika data post kosong target dihapus semua
        if(empty($data)):
            $sql_delete = "DELETE FROM {PRE}customer_product WHERE customer_id='".$customer_id."' ";
            $this->db->query($sql_delete);
        else:
            //hapus data yang ada di target tapi nggak ada di datapost
            $sql_delete = "DELETE FROM {PRE}customer_product WHERE customer_id='".$customer_id."' AND product_id NOT IN (".$string_key.")";
			// pre($sql_delete);
			$this->db->query($sql_delete);

            //looping data post
            foreach($data as $key=>$val):
                // pre($key);
                // pre($val);

                // cek apakah site fo
                $product_note = '';
                $this->db->where('code', $key);
                $fo = $this->db->get('product')->row_array();
                if (!empty($fo)) {
                    if ($fo['category']=='fo') {
                        $product_note_name = $this->input->post('product_note_name');
                        $product_note_post = $this->input->post('product_note');
                        $arr_fo = array();
                        $c = 0;
                        foreach ($product_note_name as $name_fo) {
                            $arr_fo[$name_fo] = $product_note_post[$c];
                            $c++;
                        }
                        $c = 0;
                        $product_note = json_encode($arr_fo);
                    }
                }

                $satuan_bandwidth = (isset($val['product_satuan']) && $val['product_satuan'] !='') ? $val['product_satuan'] : '';
                $valu = (isset($val['product_value']) && $val['product_value'] !='') ? $val['product_value'] : '';

                //cek di target ada apa tidak?
                $sql_cek = "SELECT * FROM {PRE}customer_product WHERE customer_id='".$customer_id."' AND product_id='".$key."' ";
                $cek = $this->db->query($sql_cek)->row_array();
                // pre($cek);
                //jika tidak ada maka di insert
                if(empty($cek)):
					$data = array(
							'customer_id'		=> $customer_id,
							'product_id'		=> $key,
							'product_value'		=> htmlspecialchars($valu),
							'currency'			=> 'IDR',
							'product_price'		=> paranoid($val['product_price']),
							'satuan_bandwidth'	=> $satuan_bandwidth,
                            'product_note'  => $product_note
						);
                  	if($val['product_price'] !=''):
                		$this->db->insert('customer_product', $data);
                  	endif;

                //jika ada maka diupdate
                else:
					$data = array(
							// 'customer_id'	=> $customer_id,
							// 'product_id'		=> $key,
							'product_value'		=> htmlspecialchars($val['product_value']),
							'currency'			=> 'IDR',
							'product_price'		=> paranoid($val['product_price']),
							'satuan_bandwidth'	=> $satuan_bandwidth
						);
					if($val['product_value'] !='' && $val['product_price'] !=''):
						$this->db->where('id', $cek['id']);
                		$this->db->update('customer_product', $data);
                  	endif;
                endif;

            endforeach;
        endif;

        ///flag maxi+++++++++++++++++++++++++++++++++++++++++++++
        $product_category = $this->input->post('product_category');
        switch ($product_category) {
            case 'maxi':
            case 'maxi_value':
            case 'gforce':
            case 'broadband':
                $data_maxi['flag_maxi'] = '1';
            break;

            default:
                $data_maxi['flag_maxi'] = '';
            break;
        }

        $this->db->where('id', $customer_id);
        $this->db->update('customer', $data_maxi);
        $res['maxi_update'] = $this->db->last_query();
        ///flag maxi+++++++++++++++++++++++++++++++++++++++++++++

        return json_encode($res);
    }

	function data($view_mode='')
	{
		// param ini dikirim otomatis oleh Jquery datatables
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');

		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $post_order[0]['column'];
	    $orderBy = $post_columns[$orderByColumnIndex]['data'];
	    $orderType = $post_order[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// Total record
		$this->db->where('customer_group.regional', session_scope_regional());
        $this->db->where('customer_group.area', session_scope_area());
		$this->db->where('customer_group.status', 'customer');
		$this->db->select('COUNT({PRE}customer_group.id) as total');
		// $this->db->join('customer', 'customer.group_id = customer_group.id', 'left');
		$qryrecordsTotal = $this->db->get('customer_group')->row_array();
		// pre($this->db->last_query());
		$recordsTotal = $qryrecordsTotal['total'];
		// Total record

		if( $post_search['value'] ):
			// where
			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
	            $column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					// $this->db->or_like($column, $post_search['value']);
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
	        }
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";
			$this->db->where( $where_string );
			// where

			$this->db->group_by('customer_group.id');
			$this->db->where('customer_group.regional', session_scope_regional());
	        $this->db->where('customer_group.area', session_scope_area());

			$this->db->where('customer_group.status', 'customer');

			$this->db->select('customer_group.id');
			$this->db->select('customer_group.customer_id');
			$this->db->select('customer_group.customer_name');
			$this->db->select('customer_group.customer_address');

			$this->db->join('customer', 'customer.group_id = customer_group.id', 'left');
			$query = $this->db->get("customer_group",$length, $start);
			// pre($this->db->last_query());

			//mencari total data ketika dalam mode pencarian
			$this->db->where( $where_string );
			$this->db->group_by('customer_group.id');
			$this->db->where('customer_group.regional', session_scope_regional());
	        $this->db->where('customer_group.area', session_scope_area());
			$this->db->where('customer_group.status', 'customer');

			$this->db->select('customer_group.id');
			$this->db->select('customer_group.customer_id');
			$this->db->select('customer_group.customer_name');
			$this->db->select('customer_group.customer_address');

			$this->db->join('customer', 'customer.group_id = customer_group.id', 'left');
			$total_filtered = $this->db->get("customer_group")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			$this->db->group_by('customer_group.id');

			$this->db->where('customer_group.regional', session_scope_regional());
	        $this->db->where('customer_group.area', session_scope_area());
			$this->db->where('customer_group.status', 'customer');

			$this->db->select('customer_group.id');
			$this->db->select('customer_group.customer_id');
			$this->db->select('customer_group.customer_name');
			$this->db->select('customer_group.customer_address');

			$this->db->join('customer', 'customer.group_id = customer_group.id');
			$query = $this->db->get("customer_group",$length, $start);
			// pre($this->db->last_query());
			$recordsFiltered = $recordsTotal;
		endif;
		$data = $query->result_array();
		// pre($data);
		$query_debug = $this->db->last_query();

		//Array dari database diedit dulu biar sesuai dengan output table
		//proses custom data dilakukan di sini
		//contoh dalam case ini adalah membuat marketing progress bar

		$formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;

				// pre($row);

				//focus customer
				if($view_mode=='report'):
					$pre_customer_name = '<a href="'.base_url().'customer/rv/'.$row['id'].'">'.clean_string($row['customer_name'], 40).'</a>';
				else:
					$pre_customer_name = '<a href="'.base_url().'customer/v/'.$row['id'].'">'.clean_string($row['customer_name'], 40).'</a>';
				endif;

				//action form
				// $button['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_customer(\''.$row['id'].'\');" class="edit_button" ');
				$button['search'] = array('label'=>$this->lang->line('all_asearch'), 'url'=>'javascript:void(0);', 'icon'=>'icon-search4', 'more'=>'onclick="search_customer(\''.$row['id'].'\');" class="edit_button" ');
				$action = $this->actionform->dropdown($button);

				$formated_data[] = array(
					'id'					=> $urut,
					'customer_name'			=> $pre_customer_name,
					'customer_id'			=> $row['customer_id'],
					'customer_address'		=> $row['customer_address'],
					'action'				=> $action,
				);
			endforeach;
		endif;
		// pre($formated_data);
		//
		// exit;

		//terakhir .... Create JSON nya
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data,
	        "query_debug" 		=> $query_debug
	    );
	    return json_encode($response);
	}

	function csi($customer_id)
	{
		$keyword_one = '1'.$customer_id;
		$keyword_two = 'customer'.$customer_id;
		$by_keyword = "(CONCAT(location, location_id)='".$keyword_one."' OR CONCAT(location, location_id)='".$keyword_two."')";
		$this->db->where($by_keyword);
		$this->db->where('item_transaction.status', 'install');
		// $this->db->join('Table', 'table.column = table.column', 'left');
		$data = $this->db->get('item_transaction')->result_array();
		// pre($data);
		return $data;
	}

	function get_jenis_link($customer_id)
	{
		$this->db->where('id', $customer_id);
		$data = $this->db->get('customer')->row_array();
		return $data['link_type'];
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {

			case 'contract' :
                $arr['tidak_kontrak'] = 'Tidak kontrak';
                $arr['kontrak'] = 'Kontrak';
			break;

			case 'am' :
				// $this->db->where('departement', 'mkt');
                $this->db->where('level', 'mkt');
				$data = $this->db->get('users')->result_array();
				if(!empty($data)):
                    foreach($data as $row):
                        $arr[$row['id']] = $row['name'];
                    endforeach;
                endif;
			break;

			case 'customer_type' :
                $data = $this->master->arr('customer_type');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;

			case 'link_type' :
                $data = $this->master->arr('link_type');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;

			//pre customer
			default:
				$data = $this->master->arr('pendidikan');
				if(!empty($data)):
					foreach($data as $row=>$val):
						$arr[$row] = $val;
					endforeach;
				endif;
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['contract'] = $this->select_option('contract');
		$arr['customer_type'] = $this->select_option('customer_type');
		$arr['link_type'] = $this->select_option('link_type');
		$arr['am'] = $this->select_option('am');

		return $arr;
	}

    function save_cp($customer_id)
    {
        $arr = array();
		$cart = $this->cart->contents();

        if(!empty($cart)):
    		foreach($cart as $row):

                $data = array(
                        'customer_id'               => $customer_id,
                        'name'                      => $row['name'],
                        'telephone_home'            => $row['options']['telephone_home'],
                        'telephone_mobile'          => $row['options']['telephone_mobile'],
                        'telephone_office'          => $row['options']['telephone_office'],
                        'fax'                       => $row['options']['fax'],
                        'email'                     => $row['options']['email'],
                    );

                $sql_cek = "SELECT * FROM {PRE}contact_person WHERE customer_id='".$customer_id."' AND name='".$row['name']."' ";
                $cek = $this->db->query($sql_cek)->result_array();
                if(empty($cek)):
                    $success_insert = $this->db->insert('contact_person', $data);
                endif;

    		endforeach;

            $this->cart->destroy();
        endif;
		return $arr;
    }

    function is_maxi()
    {

    }

    function init_mp($customer_id='')
    {
        $this->db->where('status', '1');
        $this->db->where('customer_id', $customer_id);
        $active_mp = $this->db->get('mp')->row_array();
        if(empty($active_mp)):
            $data = array(
                'customer_id'   => $customer_id,
                'progress'      => '',
                'status'        => '1',
            );
            $this->db->insert('mp', $data);
            $active_mp_id = $this->db->insert_id();
        else:
            $active_mp_id = $active_mp['id'];
        endif;
        return $active_mp_id;
    }

    function show_customer_value($location_id, $modul='product_price')
    {
        $query = $this->db->select('product_price')
            ->where('customer_id', $location_id)
            ->get('customer_product');
        $data = $query->row_array();
        if (!modul_full_access($modul) && !modul_full_view($modul)) {
            return false;
        } else{
            if ($query->num_rows() > 0) {
                return currency($data['product_price']);
            } else {
                return currency();
            }
        }
    }

    function get_user_marketing()
    {
        $data = array();
        $this->db->select('users.id, users.name')
            ->from('customer')
            ->join('users','users.id = customer.id_am')
            ->where('users.active','1')
            ->where('users.level <>', 'su')
            ->where('users.regional', session_scope_regional())
            ->where('users.area', session_scope_area())
            ->group_by('customer.id_am')
            ->order_by('users.name');
        $query = $this->db->get();
        $data['data']  = $query->result_array();
        $data['query'] = $this->db->last_query();
        return $data;
    }

	function get_marketing_progress($customer_id)
	{
		$this->db->select('task.*, master.order, master.name');
		$this->db->from('task');
		$this->db->join('master', 'task.category = master.code AND task.category <> "general"');
		$this->db->where('task.location_id', $customer_id);
		$this->db->limit(1);
		$this->db->order_by('master.order', 'DESC');

		return $this->db->get();
	}
}
