<?php
class Model_invoice extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function tabs()
	{
		$arr = array();
		$jenis_invoice = $this->db->get('invoice_category')->result_array();
        // pre($this->db->last_query());
		$urut = 0;
		foreach($jenis_invoice as $kat):
			$urut++;
			$show_tab = ($urut=='1') ? 'selected' : $urut;
			$arr[$show_tab] = array(
				'name'	=> $kat['name'],
				'code'	=> $kat['code'],
				'table_columns' => array(
					array('label'   => '#', 'width'=>'5'),
					array('label'   => 'Nama Pelanggan'),
					array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
				)
			);
		endforeach;
		return $arr;
	}

    function main_title($arr_filter, $status_invoice)
    {
        // pre($arr_filter);
        // pre($status_invoice);
        switch ($status_invoice) {
            case 'ready':
                $status_title = 'sudah diedit';
            break;

            case 'approved':
                $status_title = 'sudah diapprove';
            break;

            case 'printed':
                $status_title = 'sudah dicetak';
            break;

            default:
                $status_title = 'belum diedit';
            break;
        }
        return 'Invoice '.$status_title.' '.number_to_month($arr_filter['bulan']).' '.$arr_filter['tahun'];
    }

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Permintaan Barang Keluar' => '#'
			);
		$arr['main_action'] = array(
				'<a onclick="open_modal_generate();" href="javascript:void(0)"><i class="icon-magic-wand"></i> Generate Invoice</a>',
				'<a onclick="asearch();" href="javascript:void(0)"><i class="icon-file-plus"></i> Custom Invoice</a>',
				'<a onclick="open_bulan_selector();" href="javascript:void(0)"><i class="icon-calendar52"></i> Filter Invoice</a>',
				'<a onclick="search_invoice();" href="javascript:void(0)"><i class="icon-search4"></i> Search Invoice</a>',
			);
		$arr['table_column'] = array();
		return $arr;
	}

    function get_invoice_template($invoice_category='')
    {
        if($invoice_category==''):
            return 'non_ppn';
        else:
            $this->db->where('code', $invoice_category);
            $data = $this->db->get('invoice_category')->row_array();
            return $data['template'];
        endif;
    }

    function get_info_date()
    {
        return '1 September 2017';
    }

    function get_info_due_date()
    {
        return '15 September 2017';
    }

    function get_info_periode()
    {
        return '1 - 30 September 2017';
    }

    function get_ppn()
    {
        return '1';
    }

    function get_ppn_mode()
    {
        return '';
    }

    function get_item($id_customer)
    {

        $gm = " SELECT
                    gmd_customer_product.*, gmd_product.*
                FROM gmd_customer_product
                LEFT JOIN gmd_product ON (gmd_customer_product.product_id=gmd_product.id)
                WHERE
                    gmd_customer_product.customer_id ='".$id_customer."'";
        $query = $this->db->query($gm);
        // pre($this->db->last_query());
        $dt = $query->result_array();
        // pre($dt);

        return '';
    }

    function get_diskon()
    {
        return '';
    }

    function get_prorate()
    {
        return '';
    }

    function filtering($filter='')
	{
		if($filter !=''):
			$filter = un_filter_serialthis($filter);
			// pre($filter);
			$this->db->where('invoice_month', $filter['bulan']);
			$this->db->where('invoice_year', $filter['tahun']);
		endif;
	}

    function where_status($category)
    {
        switch ($category) {
            case 'edit':
                $this->db->where('flag_edit', '0');
                $this->db->where('flag_approved', '0');
                $this->db->where('flag_print', '0');
            break;

            case 'ready':
                $this->db->where('flag_edit', '1');
                $this->db->where('flag_approved', '0');
                $this->db->where('flag_print', '0');
            break;

            case 'approved':
                $this->db->where('flag_edit', '1');
                $this->db->where('flag_approved', '1');
                $this->db->where('flag_print', '0');
            break;

            //printed
            default:
                $this->db->where('flag_edit', '1');
                $this->db->where('flag_approved', '1');
                $this->db->where('flag_print', '1');
            break;
        }
    }

	function data($status, $category, $filter)
	{
        // pre($category);

        $status = ($status=='index') ? 'edit' : $status;
        // pre($status);

        $this->filtering($filter);


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
        $this->scope->where('invoice');
		$this->where_status($status);
		$this->db->where('invoice.category', $category);
		$this->db->select('COUNT({PRE}invoice.id) as total');
		// $this->db->join('customer', 'customer.group_id = customer_group.id', 'left');
		$qryrecordsTotal = $this->db->get('invoice')->row_array();
		// pre($this->db->last_query());
		$recordsTotal = $qryrecordsTotal['total'];
        // pre($recordsTotal);
		// Total record

        if( $post_search['value'] ):
            //pencarian disini
            // search
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
			// search

            $this->filtering($filter);
            $this->scope->where('invoice');
    		$this->where_status($status);
            $this->db->where( $where_string );
    		$this->db->where('invoice.category', $category);
			$this->db->select('invoice.*');
			$this->db->select('customer.customer_name as customer_name');
			$this->db->join('customer', 'customer.id = invoice.id_customer', 'left');
            $query = $this->db->get("invoice", $length, $start);
            $last = $this->db->last_query();

            $this->filtering($filter);
            $this->scope->where('invoice');
    		$this->where_status($status);
            $this->db->where( $where_string );
    		$this->db->where('invoice.category', $category);
			$this->db->select('invoice.*');
			$this->db->select('customer.customer_name as customer_name');
			$this->db->join('customer', 'customer.id = invoice.id_customer', 'left');
            $total_filtered = $this->db->get("invoice")->num_rows();
            // pre($this->db->last_query());
            $recordsFiltered = $total_filtered;

        else:
            //bukan pencarian

            $this->filtering($filter);
            $this->scope->where('invoice');
    		$this->where_status($status);
    		$this->db->where('invoice.category', $category);
			$this->db->select('invoice.*');
			$this->db->select('customer.customer_name as customer_name');
			$this->db->join('customer', 'customer.id = invoice.id_customer', 'left');
			$query = $this->db->get("invoice", $length, $start);
			$recordsFiltered = $recordsTotal;
            $last = $this->db->last_query();
        endif;

        $data = $query->result_array();

        $formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'index'				=> $urut,
					'customer_name'		=> $row['customer_name'],
					'action'			=> $action,
				);
			endforeach;
		endif;
        // pre($formated_data);

        $response = array(
	        "draw" 				    => intval($draw),
	        "recordsTotal" 		      => $recordsTotal,
	        "recordsFiltered" 	    => $recordsFiltered,
	        "data" 				    => $formated_data,
	        "last" 				    => $last,
	        "status" 				=> $status,
	        "category" 				=> $category,
	        "filter" 				=> $filter,
	    );
	    echo json_encode($response);
	}

    function detail($id)
    {
        $this->db->where('invoice.id', $id);
        $this->db->select('invoice.*');
        $this->db->select('customer.customer_id');
        $this->db->select('customer.invoice_name');
        $this->db->select('customer.invoice_address');
        $this->db->select('customer.invoice_attention');
        $this->db->select('customer.invoice_phone');
            $this->db->join('customer', 'customer.id = invoice.id_customer', 'left');
        $data = $this->db->get('invoice')->row_array();
        return $data;
    }

    function get_items($serialize_items='')
    {
        $arr = array();
        $arr_items = unserialize($serialize_items);
        if(!empty($arr_items)):
            foreach($arr_items as $item):
                $item = $item;
                $item['sort'] = (isset($item['sort'])) ? $item['sort'] : '0';
                $arr[] = $item;
            endforeach;
        endif;

        return $arr;
    }


    // generate nomor invoice
    // $id_customer = no primary key pelanggan
    // $cid = customer id (human view)
    function invoice_number($id_customer, $cid, $month, $year, $msa='no')
    {
        $arr_customer_id = explode('.', $cid);
        //pre($arr_customer_id);

        $ci_zero = (isset($arr_customer_id[0]) && $arr_customer_id[0] !='') ? $arr_customer_id[0] : '';
        $ci_one = (isset($arr_customer_id[1]) && $arr_customer_id[1] !='') ? '.'.$arr_customer_id[1] : '';

        $urut = $this->get_max($id_customer, $month, $year, $msa);
        return 'INV/'.$ci_zero.$ci_one.'/'.subzero($urut, 3).'.'.$month.substr($year, -2);

        // return $arr_customer_id;
    }

    //function untuk mendapatkan nomor invoice
    function get_max($id_customer, $month='', $year='', $msa="no")
    {
        $sql_invoice_group = "SELECT group_id FROM {PRE}customer WHERE id='".$id_customer."'";
        $invoice_group = $this->db->query($sql_invoice_group)->row_array();
        // pre($invoice_group);

        //MSA Filter
        if($msa=='yes'):
            $where_msa = " AND flag_msa='1'";
        else:
            $where_msa = "";
        endif;
        //MSA Filter

        $sql_id_group = "SELECT id FROM {PRE}customer WHERE invoice_flag='1' AND group_id='".$invoice_group['group_id']."'".$where_msa;
        $css = $this->db->query($sql_id_group)->result_array();
        // pre($sql_id_group);
        // pre($css);

        $gid = '';
        foreach($css as $csss):
            // pre($csss['id']);
            $gid .= "'".$csss['id']."',";
        endforeach;
        $gid = substr($gid, 0, strlen($gid)-1);
        // pre($gid);

    	$gm = "SELECT id FROM {PRE}invoice WHERE id_customer IN (".$gid.") ";
    	$query = $this->db->query($gm);
    	$dt = $query->result_array();
    	// pre($gm);

    	if(!empty($dt)):
            $tmp = "SELECT (`invoice_order`+1) as mxa FROM {PRE}invoice WHERE id_customer IN (".$gid.") AND flag_onetime !='1' ORDER BY `invoice_order` DESC LIMIT 1";
            // pre($tmp);
            $query_tmp = $this->db->query($tmp);
            $dt_tmp = $query_tmp->row_array();

            $max = $dt_tmp['mxa'];
    	else:
            $tmp = "SELECT IFNULL( (SELECT (`max`+1) FROM {PRE}mmc WHERE id_customer IN (".$gid.") AND `max` !='' ORDER BY `max` DESC LIMIT 1 ) ,'1') as mxa";
    		// pre($tmp);
            $query_tmp = $this->db->query($tmp);
            $dt_tmp = $query_tmp->row_array();

            $max = $dt_tmp['mxa'];
    	endif;

    	return $max;
    }

}
