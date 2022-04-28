<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_alert_notif extends CI_Model {

	// datatables
	var $table = 'alert_notif';
    var $column_order = array('date_create','title','content'); //set column field database for datatable orderable
    var $column_search = array('title','content'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($this->input->post('search')['value'])
            //if ($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                }
                else
                {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if($this->input->post('order')) // here order processing
        {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($condition = array())
    {
        $this->_get_datatables_query();

        if (sizeof($condition) > 0) {
            $this->db->where($condition);
        }

        if($this->input->post('length') != -1)
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($condition = array())
    {
        $this->_get_datatables_query();

        if (sizeof($condition) > 0) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($condition = array())
    {
        $this->db->from($this->table);

        if (sizeof($condition) > 0) {
            $this->db->where($condition);
        }

        return $this->db->count_all_results();
    }

    // end datatables function

    function detail($id)
    {
    	$arr = array();
    	$this->db->where('id', $id)
    		->where('user_id', my_id());
    	$query = $this->db->get('alert_notif');
    	$num_rows = $query->num_rows();
    	$data = $query->row_array();
    	$arr = $num_rows>0 ? $data : array();
    	return $arr;
    }

    function update($id, $mode='read')
    {
    	$arr = array();
    	$data = $this->detail($id);
    	switch ($mode) {
    		case 'delete':
    			$arr = array(
    				'is_hidden' => 1
    			);
    			break;

    		case 'unread':
    			$arr = array(
    				'status'	=> 'unread'
    			);
    			break;
    		case 'starred':
    			$arr = array('is_starred'=>1);
    			break;
    		case 'unstarred':
    			$arr = array('is_starred'=>0);
    			break;
    		
    		default:
    			$arr = array(
    				'status'	=> 'read',
    				'date_read'	=> date('Y-m-d H:i:s'),
    			);
    			break;
    	}
    	$this->db->where('id', $data['id'])->update('alert_notif', $arr);
    }
    function insert( $params=array() )
    {
    	$data = array();
    	// alert_code, title, content, user_id(array), url_link
    	$alert_code = isset($params['alert_code']) ? $params['alert_code'] : ( $this->input->post('alert_code') ? $this->input->post('alert_code') : 'general' );
    	$title = isset($params['title']) ? $params['title'] : $this->input->post('title');
    	$content = isset($params['content']) ? $params['content'] : ( $this->input->post('content') ? $this->input->post('content') : '' );
    	$date_create = date('Y-m-d H:i:s');
    	$status = 'unread';
    	$url_link = isset($params['url_link']) ? $params['url_link'] : $this->input->post('url_link');
    	$is_hidden = 0;

    	$user_id = isset($params['user_id']) ? $params['user_id'] : ( $this->input->post('user_id') ? $this->input->post('user_id') : 0 );
    	if (is_array($user_id)) {
            if (count($user_id) > 0) :
        		for ($i = 0; $i < count($user_id); $i++) {
        			$data[$i] = array(
    		    		'alert_code'	=> $alert_code,
    		    		'title'	=> $title,
    		    		'content'	=> $content,
    		    		'date_create'	=> $date_create,
    		    		'user_id'	=> $user_id[$i]['user_id'],
    		    		'status'	=> $status,
                        'related_id'    => !empty($params['related_id']) ? $params['related_id'] : NULL,
    		    		'url_link'	=> $url_link,
    		    		'is_hidden'	=> $is_hidden
    		    	);
        		}
        		$this->db->insert_batch('alert_notif', $data);
            endif;
    	} else {
    		$data = array(
	    		'alert_code'	=> $alert_code,
	    		'title'	=> $title,
	    		'content'	=> $content,
	    		'date_create'	=> $date_create,
	    		'user_id'	=> $user_id,
	    		'status'	=> $status,
                'related_id'    => !empty($params['related_id']) ? $params['related_id'] : NULL,
	    		'url_link'	=> $url_link,
	    		'is_hidden'	=> $is_hidden
	    	);
	    	$this->db->insert('alert_notif', $data);
    	}
    	// pre($data);
    }

    function tabs()
    {
    	$arr = array();
    	$arr['selected'] = array(
			'name'=>'Belum dibaca',
			'code'=>'unread',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
	            array('label'	=> 'Judul'),
	            array('label'   => 'Content'),
	            array('label'   => 'Tanggal'),
	            // array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Sudah dibaca',
			'code'=>'read',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
	            array('label'	=> 'Judul'),
	            array('label'   => 'Content'),
	            array('label'   => 'Tanggal'),
	            // array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Berbintang',
			'code'=>'starred',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
	            array('label'	=> 'Judul'),
	            array('label'   => 'Content'),
	            array('label'   => 'Tanggal'),
	            // array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
    	return $arr;
    }
    
    function set_ui()
    {
    	$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Notifikasi' => '#'
			);

		$arr['main_action'] = array(
				// '<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
			);

		$arr['table_column'] = array(
			array('label'   => '#', 'width'=>'5'),
            array('label'	=> 'Judul'),
            array('label'   => 'Content'),
            array('label'   => 'Tanggal'),
            // array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
		);
		return $arr;
    }

    function get_user_by_modul($code)
    {
    	$condition = array(
    		'modul.code'	=> $code,
    		'users.status'	=> 'active'
    	);
    	$this->db->select('users.id AS user_id');
		$this->db->where('modul.code', $code)
            -> where('users.regional', session_scope_regional() )
			->join('privileges', 'privileges.modul = modul.code')
			->join('usergroup','privileges.user_group_id = usergroup.code')
			->join('users',
				'users.jabatan = usergroup.code OR users.sub_department = usergroup.code OR users.department = usergroup.code OR users.divisi = usergroup.code');
		$this->db->group_by('users.id');  
		$query = $this->db->get('modul');
		$data = $query->result_array();
		return $data;
    }

    function get_user_task($task_id)
    {
    	$condition = array(
    		'users.status'	=> 'active',
    		'task_user_assigned.task_id'	=> $task_id
    	);
    	$this->db->select('task_user_assigned.user_id')
    		->join('users','users.id = task_user_assigned.user_id')
    		->where($condition)
    		->group_by('task_user_assigned.user_id');
    	$query = $this->db->get('task_user_assigned');
    	$data = $query->result_array();
    	return $data;
    }

    function get_user_by_column($column_name, $value)
    {
        $this->db->select('users.id AS user_id');
        $this->db->where($column_name, $value)
            -> where('users.regional', session_scope_regional() );
        $query = $this->db->get('users');
        $data = $query->result_array();
        return $data;
    }

}

/* End of file Model_alert_notif.php */
/* Location: ./application/models/Model_alert_notif.php */