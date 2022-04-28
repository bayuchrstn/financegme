<?php
class Model_request extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function set_timeline($task_id, $code='', $author_type='users', $note='')
    {
        $data = array(
            'task_id'           => $task_id,
            'author'            => my_id(),
            'author_type'       => $author_type,
            'date_post'         => now(),
            'code'              => $code,
            'note'              => $note,
        );
        $this->db->insert('task_log', $data);
    }

    function get_timeline($task_id)
    {
        $arr = array();
        $this->db->order_by('id', 'asc');
        $this->db->where('task_id', $task_id);
        $data = $this->db->get('task_log')->result_array();
        if(!empty($data)):
            foreach($data as $row):
                $row['author_name'] = $this->author_name($row['author_type'], $row['author']);
                $arr[] = $row;
            endforeach;
        endif;

        return $arr;
    }

    function author_name($author_type, $author)
    {
        $this->db->where('id', $author);
        $author = $this->db->get($author_type)->row_array();
        switch ($author_type) {

            default:
                $author_name = $author['name'];
            break;
        }

        return $author_name;
    }

	function referensi($mode='insert', $what='', $selected='')
	{
        // pre($what);
		$data = array();
		$data['refmode'] = $mode;
		$data['what'] = $what;
		$data['selected'] = $selected;
		$data['arr_ref'] = $this->request->arr_ref($what);
        // pre($data);
		// if($selected!=''):
		// 	$data['selected_task'] = $this->detail($selected);
		// endif;
		echo $this->load->view('request/referensi', $data, TRUE);
	}

    function approval($task_id)
    {
        $cek = $this->db->query("SELECT * FROM {PRE}task_approval WHERE task_id='".$task_id."' AND author='".my_id()."' ")->row_array();
        $data = array(
            'task_id'   => $task_id,
            'author'    => my_id(),
            'status'    => $this->input->post('approval_status'),
            'date_post' => now(),
            'note'      => $this->input->post('approval_note'),
        );
        if(empty($cek)):
            $this->db->insert('task_approval', $data);
        else:
            $this->db->where('id', $cek['id']);
            $this->db->update('task_approval', $data);
        endif;
    }

	function arr_ref($what)
	{
        $this->load->model('Model_location', 'location');
        // pre($what);
		$arr = array();

		switch ($what) {
            //BOQ
            case 'boq':
                $this->db->where('task.task_category', 'task_report');
                $this->db->where('task.category', 'survey');
                $this->db->where('task.flock', 'n');
                $this->db->select('task.*');
                $data = $this->db->get('task')->result_array();
                // pre($this->db->last_query());
                $arr[''] = '';
                if(!empty($data)):
                    foreach($data as $row):
                        $location = $this->location->location_id_info($row['location'], $row['location_id']);
                        $arr[$row['id']] = $row['subject'].' - '.$location;
                    endforeach;
                endif;
            break;

            case 'request_in':
                $this->db->group_by('pelaksana.task_id');

                $where_category = "(task.category='dismantle' )";
                // $where_category = "(task.category='installasi' OR task.category='replace')";

                $this->db->where($where_category);
                $this->db->where('pelaksana.user_id', my_id());
                $this->db->where('task_category', 'task_teknis');
                $this->db->where('task.status !=', 'selesai');
                $this->db->where('task.flock', 'n');
                $this->db->select('task.*');
                $this->db->join('task_user_assigned pelaksana', 'pelaksana.task_id = task.id', 'left');
                $data = $this->db->get('task')->result_array();
                // pre($this->db->last_query());
                $arr[''] = '';
                if(!empty($data)):
                    foreach($data as $row):
                        $arr[$row['id']] = $row['subject'];
                    endforeach;
                endif;
            break;

            case 'request_out':
                $this->db->group_by('pelaksana.task_id');

                $where_category = "(task.category='installasi_new' OR task.category='installasi' )";
                // $where_category = "(task.category='installasi' OR task.category='replace')";

                $this->db->where($where_category);
                $this->db->where('pelaksana.user_id', my_id());
                $this->db->where('task_category', 'task_teknis');
                $this->db->where('task.status !=', 'selesai');
                $this->db->where('task.flock', 'n');
                $this->db->select('task.*');
                $this->db->join('task_user_assigned pelaksana', 'pelaksana.task_id = task.id', 'left');
                $data = $this->db->get('task')->result_array();
                // pre($this->db->last_query());
                $arr[''] = '';
                if(!empty($data)):
                    foreach($data as $row):
                        $arr[$row['id']] = $row['subject'];
                    endforeach;
                endif;
            break;

			//request barang keluar
			default:
				$this->db->group_by('pelaksana.task_id');

				$where_category = "(task.category='installasi' OR task.category='replace' OR task.category='general' )";
				// $where_category = "(task.category='installasi' OR task.category='replace')";

				$this->db->where($where_category);
				$this->db->where('pelaksana.user_id', my_id());
				$this->db->where('task_category', 'task_teknis');
                $this->db->where('task.flock', 'n');
                $this->db->where('task.status !=', 'selesai');
				$this->db->select('task.*');
				$this->db->join('task_user_assigned pelaksana', 'pelaksana.task_id = task.id', 'left');
				$data = $this->db->get('task')->result_array();
				// pre($this->db->last_query());
				$arr[''] = '';
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['subject'];
					endforeach;
				endif;
			break;
		}


		return $arr;
	}

    // flock detector
    function is_flock($task_id)
    {
        $detail = $this->detail($task_id);
        if($detail['flock']=='y'):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

	function filter_boleh_laporan()
	{
		$arr = array();
        $category = $this->input->post('category');

        // task_id adalah id dari task teknis / simbah
        $task_id = $this->input->post('id');

        // dicek dulu flock apa gak ?
        if($this->is_flock($this->input->post('id'))):
            $arr['allow_report'] = '0';
            $arr['msg'] = 'Belum boleh lapoan, data masih terkunci';
            return $arr;
            exit;
        endif;

        switch ($category) {

            case 'replace':
                // apakah sudah request barang dipasang?
                $daftar_barang_direquest = $this->permintaan_barang->sudah_request_dipasang($task_id,'request_replace');
                if(empty($daftar_barang_direquest)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'Gagal, belum request barang dipasang';
                    return $arr;
                    exit;
                endif;

                // apakah sudah request barang kebali?
                $daftar_barang_direquest = $this->permintaan_barang->sudah_request_kembali($task_id,'request_replace');
                if(empty($daftar_barang_direquest)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'Gagal, belum request barang kembali';
                    return $arr;
                    exit;
                endif;

                //cek dulu apakan ada request barang dipasang yang belum diaprove gudang?
                $barang_dipasang_belum_approved = $this->permintaan_barang->barang_dipasang_belum_approved($task_id, 'request_replace');
                if(!empty($barang_dipasang_belum_approved)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'gagal, ada request barang dipasang yang belum diapprove gudang';
                    return $arr;
                    exit;
                endif;

                //cek dulu apakan ada request barang kembali yang belum diaprove gudang?
                $barang_kembali_belum_approved = $this->permintaan_barang->barang_kembali_belum_approved($task_id, 'request_replace');
                if(!empty($barang_kembali_belum_approved)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'gagal, ada request barang kembali yang belum diapprove gudang';
                    return $arr;
                    exit;
                endif;

            break;

            case 'installasi_new':
                // apakah sudah request barang dipasang?
                $daftar_barang_direquest = $this->permintaan_barang->sudah_request_dipasang($task_id, 'request_out');
                if(empty($daftar_barang_direquest)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'Gagal, belum request barang dipasang';
                    return $arr;
                    exit;
                endif;

                //cek dulu apakan ada request barang dipasang yang belum diaprove gudang?
                $barang_dipasang_belum_approved = $this->permintaan_barang->barang_dipasang_belum_approved($task_id, 'request_out');
                if(!empty($barang_dipasang_belum_approved)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'gagal, ada request barang dipasang yang belum diapprove gudang';
                    return $arr;
                    exit;
                endif;

            break;

            case 'installasi':
                // apakah sudah request barang dipasang?
                $daftar_barang_direquest = $this->permintaan_barang->sudah_request_dipasang($task_id, 'request_out');
                if(empty($daftar_barang_direquest)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'Gagal, belum request barang dipasang';
                    return $arr;
                    exit;
                endif;

                //cek dulu apakan ada request barang dipasang yang belum diaprove gudang?
                $barang_dipasang_belum_approved = $this->permintaan_barang->barang_dipasang_belum_approved($task_id, 'request_out');
                if(!empty($barang_dipasang_belum_approved)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'gagal, ada request barang dipasang yang belum diapprove gudang';
                    return $arr;
                    exit;
                endif;

            break;

            case 'dismantle':
                // apakah sudah request barang kebali?
                $daftar_barang_direquest = $this->permintaan_barang->sudah_request_kembali($task_id, 'request_in');
                if(empty($daftar_barang_direquest)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'Gagal, belum request barang kembali';
                    return $arr;
                    exit;
                endif;

                //cek dulu apakan ada request barang kembali yang belum diaprove gudang?
                $barang_kembali_belum_approved = $this->permintaan_barang->barang_kembali_belum_approved($task_id, 'request_in');
                if(!empty($barang_kembali_belum_approved)):
                    $arr['allow_report'] = '0';
                    $arr['msg'] = 'gagal, ada request barang kembali yang belum diapprove gudang';
                    return $arr;
                    exit;
                endif;

            break;

            default:
                # code...
                break;
        }

        $arr['allow_report'] = '1';
        $arr['msg'] = 'Tidak boleh';
        return $arr;
	}

	function info_modul($request_code)
	{
		// $this->db->where('up', '1001');
        $this->db->where('note', 'req');
		$this->db->where('code', $request_code);
		$data = $this->db->get('modul')->row_array();
		// pre($this->db->last_query());
		return $data;
	}

	function detail($id)
	{
		$this->db->where('task.id', $id);
        $this->db->select('task.*');
        $this->db->select('author.name as author_name');
        $this->db->join('users author', 'author.id=task.author', 'left');
		$data = $this->db->get('task')->row_array();
		// pre($this->db->last_query());
		return $data;
	}

	function check_task_ext($task_id, $table)
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get($table)->result_array();
		return $data;
	}

	function task_ext($task_id, $table, $params=array())
	{
		$fields = $this->db->field_data($table);
		if(!empty($fields)):
			$data = array();
			foreach($fields as $row):
				if($row->name !='id' and $row->name !='task_id'):
					// pre($row);

					if(isset($params[$row->name])):
						$data[$row->name] = $params[$row->name];
					elseif($this->input->post($row->name)):
						$data[$row->name] = htmlspecialchars($this->input->post($row->name));
					else:
						$data[$row->name] = '';
					endif;

				endif;
			endforeach;
			// pre($data);

			$cek = $this->check_task_ext($task_id, $table);
			if(empty($cek)):
				$data['task_id'] = $task_id;
				$this->db->insert($table, $data);
				// pre($this->db->last_query());
			else:
				$this->db->where('task_id', $task_id);
				$this->db->update($table, $data);
				// pre($this->db->last_query());
			endif;

		endif;
	}

	function task_ext_partial($task_id, $table, $params=array())
	{
        $res = array();
		$fields = $this->db->field_data($table);
		if(!empty($fields)):
			$data = array();
			foreach($fields as $row):
				if($row->name !='id' and $row->name !='task_id'):
					// pre($row);

					if(isset($params[$row->name])):
						$data[$row->name] = $params[$row->name];
					elseif($this->input->post($row->name)):
						$data[$row->name] = htmlspecialchars($this->input->post($row->name));
					endif;

				endif;
			endforeach;
			// pre($data);

			$cek = $this->check_task_ext($task_id, $table);

			if(empty($cek)):
				$data['task_id'] = $task_id;
				$this->db->insert($table, $data);
                $res['last_query'] = $this->db->last_query();
			else:
				$this->db->where('task_id', $task_id);
				$this->db->update($table, $data);
                $res['last_query'] = $this->db->last_query();
			endif;

		endif;
        return $res;
	}

	function where_location($keyword='')
	{
		//customer
		$this->db->like('customer_name', $keyword);
		$qry_cs = $this->db->get('customer');
		$dt_cs = $qry_cs->result_array();
		$jumlah_arr = count($dt_cs); //pre($jumlah_arr);

		$opt_cs = "";

		if(!empty($dt_cs)){

			if($jumlah_arr > 1){
				$opt_cs .= "( ";
			}

			$opt_csx = '';
			foreach($dt_cs as $dtcs){
				$opt_csx .= "(`for`='customer' and `target`='".$dtcs['id']."') OR ";
			}

			$opt_cs .= substr($opt_csx, 0, strlen($opt_csx)-4);

			if($jumlah_arr > 1){
				$opt_cs .= " )";
			}
		}

		//BTS
		$this->db->like('bts_name', $keyword);
		$qry_bts = $this->db->get('bts');
		$dt_bts = $qry_bts->result_array();
		//pre($this->db->last_query());
		$jumlah_arr_bts = count($dt_bts);
		$opt_bts = "";
		if(!empty($dt_bts)){

			if($jumlah_arr_bts > 1){
				$opt_bts .= "( ";
			}

			$opt_btsx = '';
			foreach($dt_bts as $dtbts){
				$opt_btsx .= "(`for`='bts' and `target`='".$dtbts['id']."') OR ";
			}

			$opt_bts .= substr($opt_btsx, 0, strlen($opt_btsx)-4);

			if($jumlah_arr_bts > 1){
				$opt_bts .= " )";
			}

		}

		$or_join = ($opt_bts !='') ? 'OR' : '';

		if($opt_cs !='' && $opt_bts != ''):
			$join = '(';
			$join .= $opt_cs;
			$join .= $or_join;
			$join .= $opt_bts;
			$join .= ')';
		elseif($opt_cs !='' && $opt_bts == ''):
			$join = $opt_cs;
		elseif($opt_cs =='' && $opt_bts != ''):
			$join = $opt_bts;
		else:
			$join = '';
		endif;

		//pre($join);

		return $join;

	}

	function get_user_assigned($task_id)
	{
		$arr = array();
		$this->db->where('task_user_assigned.task_id', $task_id);
		$this->db->select('users.name as name');
		$this->db->join('users', 'users.id = task_user_assigned.user_id', 'left');
		$data = $this->db->get('task_user_assigned')->result_array();
		if(!empty($data)):
			foreach($data as $row):
				$arr[] = $row['name'];
			endforeach;
		endif;
		return $arr;
	}

	function global_list($task_category, $params=array())
	{
		$this->db->order_by('id', 'desc');
		$this->db->where('task_category', 'marketing_progress');
		$this->db->select('task.*');
		$this->db->select('author.name as author_name');
		$this->db->join('users author', 'author.id = task.author', 'left');
		$data = $this->db->get('task')->result_array();
		return $data;
	}

	function allow_update($task_category, $owner)
	{
		$allow = TRUE;
		switch ($task_category) {

			// case 'approval_install':
			case 'task_teknis':
				if(!is_admin() && !is_admin_regional() && $owner != my_id() && !have_privileges('update_task_teknis') ):
					$allow = FALSE;
				endif;
			break;

			//task teknis
			default:
				$allow = TRUE;
			break;
		}
		return $allow;
	}

	function get_task_report($task_id)
	{
		$arr = array();
		$this->db->where('up', $task_id);
		$this->db->where('task_category', 'task_report');
		$this->db->select('task.id as id_report');
		$this->db->select('task.*');
		$this->db->select('task_report.*, users.name AS author');
		$this->db->join('task_report', 'task_report.task_id = task.id', 'left');
        $this->db->join('users', 'users.id = task.author', 'left');
		$detail = $this->db->get('task')->row_array();


		if(!empty($detail)):
			foreach($detail as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;

		return $arr;
	}

	function get_child($id_parent)
	{
		$this->db->where('up', $id_parent);
		$dt = $this->db->get('task')->row_array();
		return $dt;
	}

    function insert($params=array())
    {
        // pre($params);
        $arr = array();
        $data = array(
            'up' => (isset($params['up']) && $params['up'] !='') ? $params['up'] : (($this->input->post('up')) ? $this->input->post('up') : ''),
            'progress_id' => (isset($params['progress_id']) && $params['progress_id'] !='') ? $params['progress_id'] : (($this->input->post('progress_id')) ? $this->input->post('progress_id') : ''),
            'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : (($this->input->post('task_category')) ? $this->input->post('task_category') : ''),
            'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : (($this->input->post('category')) ? $this->input->post('category') : ''),
            'author' => (isset($params['author']) && $params['author'] !='') ? $params['author'] : my_id(),
            'date_created' => (isset($params['date_created']) && $params['date_created'] !='') ? $params['date_created'] : now(),
            'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : (($this->input->post('status')) ? $this->input->post('status') : ''),
            'date_start' => (isset($params['date_start']) && $params['date_start'] !='') ? $params['date_start'] : (($this->input->post('date_start')) ? $this->input->post('date_start') : now()),
            'date_due' => (isset($params['date_due']) && $params['date_due'] !='') ? $params['date_due'] : (($this->input->post('date_due')) ? $this->input->post('date_due') : ''),
            'subject' => (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : (($this->input->post('subject')) ? $this->input->post('subject') : ''),
            'body' => (isset($params['body']) && $params['body'] !='') ? $params['body'] : (($this->input->post('body_fake')) ? $this->input->post('body_fake') : ''),
            'regional' => (isset($params['regional']) && $params['regional'] !='') ? $params['regional'] : (($this->input->post('regional')) ? $this->input->post('regional') : session_scope_regional()),
            'area' => (isset($params['area']) && $params['area'] !='') ? $params['area'] : (($this->input->post('area')) ? $this->input->post('area') : session_scope_area()),
            'location' => (isset($params['location']) && $params['location'] !='') ? $params['location'] : (($this->input->post('location')) ? $this->input->post('location') : ''),
            'location_id' => (isset($params['location_id']) && $params['location_id'] !='') ? $params['location_id'] : (($this->input->post('location_id')) ? $this->input->post('location_id') : ''),
            'location_id' => (isset($params['location_id']) && $params['location_id'] !='') ? $params['location_id'] : (($this->input->post('location_id')) ? $this->input->post('location_id') : ''),
            'note'  => isset($params['note']) ? $params['note'] : NULL,
            'flock' => (isset($params['flock']) && $params['flock'] !='') ? $params['flock'] : (($this->input->post('flock')) ? $this->input->post('flock') : 'n'),
        );
        // pre($data);
        $this->db->insert('task', $data);
        $arr['last_query'] = $this->db->last_query();
        $arr['last_id'] = $this->db->insert_id();

        return $arr;
    }

    function update($params=array())
    {
        $data = array();
        $fields = $this->db->field_data('task');

        foreach($fields as $row):
            if($row->name !='id'):
                // pre($row);

                if(isset($params[$row->name])):
                    $data[$row->name] = $params[$row->name];
                elseif($this->input->post($row->name)):
                    $data[$row->name] = htmlspecialchars($this->input->post($row->name));
                endif;

            endif;
        endforeach;

        if(!empty($data) && $this->input->post('id')):

            $ider = (isset($params['id'])) ? $params['id'] : $this->input->post('id');

            $this->db->where('id', $ider);
            $update_result = $this->db->update('task', $data);
        endif;

        $res = array();
        $res['last_query'] = $this->db->last_query();
        return($res);
    }

    function save_task_ext($table_name='task_customer_care', $param=array(), $exlude=array(), $allow_empty=FALSE)
    {
        $fields = $this->db->field_data($table_name);

        if($allow_empty):
            pre('ini diupdate ketika ada yg baru saja');
        else:
            foreach($fields as $row):
                if(!in_array($row->name, $exlude)):
                    pre($row->name);
                endif;
            endforeach;
        endif;
    }

    function up_info($task_id)
    {
        $arr = array();
        $this->db->where('id', $task_id);
        $data = $this->db->get('task')->row_array();
        $arr['id'] = $data['id'];
        $arr['subject'] = $data['subject'];
        return $arr;
    }

}
