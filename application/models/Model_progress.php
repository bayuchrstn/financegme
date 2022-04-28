<?php
class Model_progress extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function init($params=array())
    {
        $arr = array();
        $data = array(
            'title'         => 'default progress',
            'progress'      => '',
            'location'      => '',
            'location_id'   => '',
            'category'      => 'pre_survey',
            'status'        => 'progress',
            'task_id'       => '',
            'label'         => '',
            'code'          => '',
            'show_url'      => '',
        );
        $data = array_replace($data, $params);

        $result = $this->db->insert('progress', $data);
        if($result):
            $progress_id = $this->db->insert_id();
            $this->db->query("UPDATE {PRE}task SET progress_id='".$progress_id."' WHERE id='".$params['task_id']."' ");
            $arr['progress_id'] = $progress_id;
        else:
            $arr['progress_id'] = '';
        endif;
        return $arr;
    }

    function update($params=array())
    {
        $id = $params['id'];
        $task_id = $params['task_id'];
        $label = $params['label'];
        $code = $params['code'];
        $show_url = $params['show_url'];

        $detail = $this->detail($id);
        // $arr_current_progress = unserialthis($detail['progress']);
        // $arr_current_progress[$code.'_'.$task_id]  = array(
        //     'label'             => $label,
        //     'code'              => $code,
        //     'task_id'           => $task_id,
        //     'show_url'           => $show_url,
        // );

        $data = array(
            // 'progress'       => serialthis($arr_current_progress),
            // 'status'         => 'progress',
            'task_id'           => $detail['task_id'].','.$task_id,
            'label'             => $detail['label'].','.$label,
            'code'              => $detail['code'].','.$code,
            'show_url'          => $detail['show_url'].','.$show_url,
        );
        $exist = $this->exist($id, $task_id);
        if(!empty($detail) && !$exist ):
            $this->db->where('id', $id);
            $this->db->update('progress', $data);
            $last = $this->db->last_query();
        else:
            $last = 'no update';
        endif;
        return $last;
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('progress')->row_array();
    }

    function exist($id, $task_id)
    {
        // pre($id);
        // pre($task_id);
        $fis = "FIND_IN_SET('".$task_id."', task_id)";
        $this->db->where($fis);
        $this->db->where('id', $id);
        $data = $this->db->get('progress')->row_array();
        // pre($this->db->last_query());
        return (empty($data)) ? FALSE : TRUE;
    }


}
