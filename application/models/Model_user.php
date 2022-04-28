<?php
class Model_user extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all_user()
    {
        $this->db->where('level !=', 'su');
        $this->scope->where('users');
        $this->db->select('users.*');
        $this->db->select('usergroup.id as group_id');
        $this->db->select('usergroup.name as group_name');
        $this->db->select('divisi.name as divisi_name');
        $this->db->select('department.name as department_name');
        $this->db->select('sub_department.name as sub_department_name');

        $this->db->select('divisi.id as divisi_id');
        $this->db->select('department.id as department_id');
        $this->db->select('sub_department.id as sub_department_id');
        $this->db->select('jabatan.id as jabatan_id');

        $this->db->select('jabatan.name as jabatan_name');
        $this->db->join('usergroup', 'users.level=usergroup.code', 'left');
        $this->db->join('usergroup divisi', 'divisi.code=users.divisi', 'left');
        $this->db->join('usergroup department', 'department.code=users.department', 'left');
        $this->db->join('usergroup sub_department', 'sub_department.code=users.sub_department', 'left');
        $this->db->join('usergroup jabatan', 'jabatan.code=users.jabatan', 'left');
        $this->db->group_by('users.id');
        $query = $this->db->get('users');
        $data['data'] = $query->result_array();
        $data['last_query'] = $this->db->last_query();
        return $data;
    }

    //notyet
    function get_users_by_departement($dept_code='')
    {
        return $this->db->get('users')->result_array();
    }



    function all_user_array()
    {
        $arr = array();
        $user = $this->all_user();
        if(!empty($user)):
            foreach($user as $row):
                $arr[$row['id']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function assigable_user()
    {
        $arr = array();
        $this->db->where('status', 'active');
        $user = $this->db->get('users')->result_array();
        if(!empty($user)):
            foreach($user as $row):
                $arr[$row['id']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row_array();
    }


    function view_scope()
    {
        $this->db->order_by('order', 'asc');
        $this->db->where('category', 'view_scope');
        $scope = $this->db->get('master')->result_array();
        $arr = array();
        if(!empty($scope)):
            foreach($scope as $row):
                $arr[$row['code']] = $row['name'].' ( '.$row['note'].' )';
            endforeach;
        endif;
        return $arr;
    }

    function get_user_name($id)
    {
        $user = $this->detail($id);
        return $user['name'];
    }

    function valid_username($mode='insert', $username, $current='')
    {
        if($mode == 'insert'):
            $cek = $this->db->query("SELECT * FROM {PRE}users WHERE username = '".$username."' ")->row_array();
            if(empty($cek)):
                return TRUE;
            else:
                return FALSE;
            endif;
        else:
            $cek = $this->db->query("SELECT * FROM {PRE}users WHERE username = '".$username."' AND id != '".$current."'")->row_array();
            if(empty($cek)):
                return TRUE;
            else:
                return FALSE;
            endif;
        endif;
    }

    function update($param=array())
    {


        if($this->input->post('password')):
            $data['password'] = pass_generator($this->input->post('password'));
        elseif(isset($param['password'])):
            $data['password'] = pass_generator($param['password']);
        endif;

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        endif;



        if($this->input->post('email')):
            $data['email'] = $this->input->post('email');
        elseif(isset($param['email'])):
            $data['email'] = $param['email'];
        endif;


        if($this->input->post('status')):
            $data['status'] = $this->input->post('status');
        elseif(isset($param['status'])):
            $data['status'] = $param['status'];
        endif;

        if($this->input->post('divisi')):
            $data['divisi'] = $this->input->post('divisi');
        elseif(isset($param['divisi'])):
            $data['divisi'] = $param['divisi'];
        endif;

        if($this->input->post('department')):
            $data['department'] = $this->input->post('department');
        elseif(isset($param['department'])):
            $data['department'] = $param['department'];
        endif;

        if($this->input->post('sub_department')):
            $data['sub_department'] = $this->input->post('sub_department');
        elseif(isset($param['sub_department'])):
            $data['sub_department'] = $param['sub_department'];
        endif;

        if($this->input->post('jabatan')):
            $data['jabatan'] = $this->input->post('jabatan');
        elseif(isset($param['jabatan'])):
            $data['jabatan'] = $param['jabatan'];
        endif;


        if(!empty($data)):
            if($this->input->post('id')):
                $this->db->where('id', $this->input->post('id'));
            elseif(isset($param['id'])):
                $this->db->where('id', $param['id']);
            endif;
            $update = $this->db->update('users', $data);
        endif;
    }

    function insert($param=array())
    {
        if($this->input->post('username')):
            $data['username'] = $this->input->post('username');
        elseif(isset($param['username'])):
            $data['username'] = $param['username'];
        else:
            $data['username'] = '';
        endif;

        if($this->input->post('password')):
            $data['password'] = pass_generator($this->input->post('password'));
        elseif(isset($param['password'])):
            $data['password'] = pass_generator($param['password']);
        else:
            $data['password'] = '';
        endif;

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        else:
            $data['name'] = '';
        endif;

        if($this->input->post('level')):
            $data['level'] = $this->input->post('level');
        elseif(isset($param['level'])):
            $data['level'] = $param['level'];
        else:
            $data['level'] = '';
        endif;

        if($this->input->post('photo')):
            $data['photo'] = $this->input->post('photo');
        elseif(isset($param['photo'])):
            $data['photo'] = $param['photo'];
        else:
            $data['photo'] = '';
        endif;

        if($this->input->post('email')):
            $data['email'] = $this->input->post('email');
        elseif(isset($param['email'])):
            $data['email'] = $param['email'];
        else:
            $data['email'] = '';
        endif;

        if($this->input->post('registration_date')):
            $data['registration_date'] = $this->input->post('registration_date');
        elseif(isset($param['registration_date'])):
            $data['registration_date'] = $param['registration_date'];
        else:
            $data['registration_date'] = now();
        endif;

        if($this->input->post('registration_key')):
            $data['registration_key'] = $this->input->post('registration_key');
        elseif(isset($param['registration_key'])):
            $data['registration_key'] = $param['registration_key'];
        else:
            $data['registration_key'] = '';
        endif;

        if($this->input->post('status')):
            $data['status'] = $this->input->post('status');
        elseif(isset($param['status'])):
            $data['status'] = $param['status'];
        else:
            $data['status'] = '';
        endif;

        if($this->input->post('departement')):
            $data['departement'] = $this->input->post('departement');
        elseif(isset($param['departement'])):
            $data['departement'] = $param['departement'];
        else:
            $data['departement'] = '';
        endif;

        if($this->input->post('view_scope')):
            $data['view_scope'] = $this->input->post('view_scope');
        elseif(isset($param['view_scope'])):
            $data['view_scope'] = $param['view_scope'];
        else:
            $data['view_scope'] = 'area';
        endif;

        if($this->input->post('regional')):
            $data['regional'] = $this->input->post('regional');
        elseif(isset($param['regional'])):
            $data['regional'] = $param['regional'];
        else:
            $data['regional'] = '';
        endif;

        if($this->input->post('area')):
            $data['area'] = $this->input->post('area');
        elseif(isset($param['area'])):
            $data['area'] = $param['area'];
        else:
            $data['area'] = '';
        endif;

        $insert = $this->db->insert('users', $data);
        $arr['status'] = $insert;
        $arr['last_id'] = $this->db->insert_id();
        return $arr;
    }

    function dds($mode='divisi', $parent='')
    {
        switch ($mode) {
            case 'department':
                if($parent !=''):
                    $this->db->where('up', $parent);
                endif;
                $this->db->where('category', 'department');
            break;

            case 'sub_department':
                if($parent !=''):
                    $this->db->where('up', $parent);
                endif;
                $this->db->where('category', 'sub_department');
            break;

            case 'jabatan':
                if($parent !=''):
                    $this->db->where('up', $parent);
                endif;
                $this->db->where('category', 'jabatan');
            break;


            default:
                $this->db->where('category', 'divisi');
            break;
        }
        $arr = array();

        $data = $this->db->get('usergroup')->result_array();

        if(!empty($data)):
            foreach($data as $row):
                if($mode=='jabatan'):
                    $jabatan_name = $this->usergroup->jabatan_name($row['code']);
                    $arr[$row['code']] = $jabatan_name;
                else:
                    $arr[$row['code']] = $row['name'];
                endif;
            endforeach;
        endif;
        // pre($arr);
        return $arr;
    }

	function select_option($mode='customer')
	{
		$this->load->model('model_usergroup', 'usergroup');
		$arr = array();
		switch ($mode) {
			case 'departement':
				$data = $this->master->arr('departement');
				foreach($data as $key=>$val):
					$arr[$key] = $val;
				endforeach;
			break;

            case 'approval':
                $this->scope->where('users');
				$data = $this->db->get('users')->result_array();
				foreach($data as $row):
					$arr[$row['id']] = $row['name'];
				endforeach;
			break;

            case 'alert_config':
                $this->scope->where('users');
				$data = $this->db->get('users')->result_array();
				foreach($data as $row):
					$arr[$row['id']] = $row['name'];
				endforeach;
			break;

            case 'status':
                $arr['active'] = 'Aktif';
                $arr['non_active'] = 'Non Aktif';
			break;

			//pre customer
			default:
				$data = $this->usergroup->arr_usergroup_reg();
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
		$arr['usergroup'] = $this->select_option('usergroup');
		$arr['departement'] = $this->select_option('departement');
		$arr['approval'] = $this->select_option('approval');
		$arr['status'] = $this->select_option('status');
		$arr['alert_config'] = $this->select_option('alert_config');
		return $arr;
	}


}
