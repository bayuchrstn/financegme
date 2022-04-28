<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_overtime extends CI_Model {

    function __construct()
    {
        parent:: __construct();
    }

    function all($status='request')
    {
        // $this->db->where('regional', my_regional());
        $this->db->select('over.id AS id, task_id, start, finish, over.status AS status, note, approved_date, id_approve, red, red_date, date_overtime, shift, user.id AS user_id, user.name AS user_name, user.level AS user_level, user.email AS user_email, user.regional AS user_regional, user.area AS user_area, approved.name AS approved_name, approved.level AS approved_level, approved.email AS approved_email, approved.regional AS approved_regional, approved.area AS approved_area')
            ->from('overtime over')
            ->join('users user','user.id = over.author')
            ->join('users approved','approved.id = over.id_approve','LEFT')
            ->where('over.status', $status)
            ->where('over.regional', session_scope_regional())
            ->where('over.area', session_scope_area());
        return $this->db->get()->result_array();
    }

    function data($status='request', $modul='approval_lembur')
    {
        $post_order = $this->input->post('order');
        $post_columns = $this->input->post('columns');
        $post_search = $this->input->post('search');
        $draw = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length');

        $recordsTotal = $this->db->where('status', $status)->get('overtime')->num_rows();

        if( $post_search['value'] ):
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

            // Edit Here
            for($i=0; $i<count($post_order); $i++):
                $orderByColumnIndex  = $post_order[$i]['column'];
                $orderBy = $post_columns[$orderByColumnIndex]['name'];
                $orderType = $post_order[$i]['dir'];
                $this->db->order_by($orderBy, $orderType);
            endfor;

            $this->db->where( $where_string );
            $this->db->select('over.id AS id, task_id, start, finish, over.status AS status, note, approved_date, id_approve, red, red_date, date_overtime, shift, user.id AS user_id, user.name AS user_name, user.level AS user_level, user.email AS user_email, user.regional AS user_regional, user.area AS user_area, approved.name AS approved_name, approved.level AS approved_level, approved.email AS approved_email, approved.regional AS approved_regional, approved.area AS approved_area')
            ->from('overtime over')
            ->join('users user','user.id = over.author')
            ->join('users approved','approved.id = over.id_approve','LEFT')
            ->where('over.status', $status)
            ->where('over.regional', session_scope_regional())
            ->where('over.area', session_scope_area())
            ->limit($length, $start);
            $query = $this->db->get();

            $total_filtered = $query->num_rows();
            $recordsFiltered = $total_filtered;
        else:
            for($i=0; $i<count($post_order); $i++):
                $orderByColumnIndex  = $post_order[$i]['column'];
                $orderBy = $post_columns[$orderByColumnIndex]['name'];
                $orderType = $post_order[$i]['dir'];
                $this->db->order_by($orderBy, $orderType);
            endfor;

            $this->db->select('over.id AS id, task_id, start, finish, over.status AS status, note, approved_date, id_approve, red, red_date, date_overtime, shift, user.id AS user_id, user.name AS user_name, user.level AS user_level, user.email AS user_email, user.regional AS user_regional, user.area AS user_area, approved.name AS approved_name, approved.level AS approved_level, approved.email AS approved_email, approved.regional AS approved_regional, approved.area AS approved_area')
            ->from('overtime over')
            ->join('users user','user.id = over.author')
            ->join('users approved','approved.id = over.id_approve','LEFT')
            ->where('over.status', $status)
            ->where('over.regional', session_scope_regional())
            ->where('over.area', session_scope_area())
            ->limit($length, $start);
            $query = $this->db->get();
            $recordsFiltered = $recordsTotal;
        endif;
        $data = $query->result_array();
        $formated_data = array();
        if(!empty($data)):
            $urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
            foreach($data as $row):
                $urut++;

                $hidden_form['detail'] = array('label'=>'Detail', 'url'=>'javascript:void(0);', 'icon'=>'icon-stack3', 'more'=>'onclick="detail_overtime(\''.$row['id'].'\');" class="edit_button" ');

                if ($row['status']!='approve' && (have_privileges('update_lembur') || $row['user_id']==my_id())) {
                    $hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_overtime(\''.$row['id'].'\');" class="edit_button" ');
                }

                if ($row['status']!='approve' && (have_privileges('delete_overtime') || $row['user_id']==my_id()) ) {
                    $hidden_form['delete'] = array('label'=>$this->lang->line('overtime_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_overtime(\''.$row['id'].'\');" class="edit_button" ');
                }

                if ( (modul_full_access($modul) || modul_full_view($modul)) && $row['status']!='approve') {
                    $hidden_form['approve'] = array('label'=>$this->lang->line('overtime_approve'), 'url'=>'javascript:void(0);', 'icon'=>'icon-check', 'more'=>'onclick="approve_overtime(\''.$row['id'].'\');" class="edit_button" ');
                }
                $action = $this->actionform->dropdown($hidden_form);
                $formated_data[] = array(
                        'urut'  => $urut ,
                        'name'  => clean_string($row['user_name'], 40),
                        'date_start' => clean_string($row['start'], 20),
                        'date_end'  =>clean_string($row['finish'], 20),
                        'status'    => clean_string($row['status'], 10),
                        'libur' => $row['red']=='1' ? 'ya' : 'tidak',
                        'action'    => $action
                    );
            endforeach;
        endif;

        $response = array(
            // "query"  => $last_query,
            "draw"              => intval($draw),
            "recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $formated_data
        );

        return $response;
    }

    function detail($id)
    {
        $this->db->select('over.id AS id, task_id, start, finish, over.status AS status, over.note, approved_date, id_approve, red, red_date, date_overtime,oncall, shift, user.id AS user_id, user.name AS user_name, user.level AS user_level, user.email AS user_email, user.regional AS user_regional, user.area AS user_area, approved.name AS approved_name, approved.level AS approved_level, approved.email AS approved_email, approved.regional AS approved_regional, approved.area AS approved_area,
            task.subject, task.location, task.location_id')
            ->from('overtime over')
            ->join('users user','user.id = over.author')
            ->join('users approved','approved.id = over.id_approve','LEFT')
            ->join('task','task.id = over.task_id','left')
            ->where('over.id', $id);
        return $this->db->get()->row_array();
    }

    function get_my_task()
    {
        $userid = my_id();
        $this->db->select('task_user_assigned.*, task.subject')
            ->join('task', 'task.id = task_user_assigned.task_id', 'left');
        $this->db->where('task_user_assigned.user_id', $userid);
        $query = $this->db->get('task_user_assigned');
        return $query->result_array();
    }

    function tabs()
    {
        $arr = array();

        $arr['selected'] = array(
            'name'=>'Request',
            'code'=>'request',
            'table_columns' => array(
                array('label'   => '#', 'width'=>'5'),
                array('label'   => $this->lang->line('user_name') ),
                array('label'   => $this->lang->line('overtime_start') ),
                array('label'   => $this->lang->line('overtime_finish') ),
                array('label'   => $this->lang->line('overtime_red')),
                array('label'   => $this->lang->line('all_action'), 'width'=>'80' ),
            )
        );
        $arr[] = array(
            'name'=>'Approved',
            'code'=>'approve',
            'table_columns' => array(
                array('label'   => '#', 'width'=>'5'),
                array('label'   => $this->lang->line('user_name') ),
                array('label'   => $this->lang->line('overtime_start') ),
                array('label'   => $this->lang->line('overtime_finish') ),
                array('label'   => $this->lang->line('overtime_red')),
                array('label'   => $this->lang->line('all_action'), 'width'=>'80' ),
            )
        );
        return $arr;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('overtime');
        $last_query = $this->db->last_query();
        $this->add_log_overtime($id,'delete',$last_query);
    }

    function add_log_overtime($id, $mode='delete', $query='')
    {
        $arr = array(
            'overtime_id'   => $id,
            'log_user'  => my_id(),
            'log_desc'  => $mode.'_overtime|'.$query
        );
        $this->db->insert('overtime_log', $arr);
    }
}

/* End of file Model_overtime.php */
/* Location: ./application/models/Model_overtime.php */