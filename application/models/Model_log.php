<?php
class Model_log extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function create($id_user='', $note='', $kueri='', $parent='', $parent_id='')
    {

        $data = array(
            'id_user'       => $id_user,
            'note'          => $note,
            'kueri'         => $kueri,
            'date_post'     => now(),
            'session_id'    => session_id(),
            'ip_address'    => $_SERVER['REMOTE_ADDR'],
            'user_agent'    => $this->input->user_agent(),
            'parent'        => $parent,
            'parent_id'     => $parent_id
        );
        $this->db->insert('log', $data);
    }

    function detail_activity($log_id)
    {
        $this->db->where('log.id', $log_id);
        $this->db->select('log.*');
        $this->db->select('users.first_name');
        $this->db->select('users.last_name');
        $this->db->join('users', 'log.id_user = users.id', 'left');
        $detail = $this->db->get('log')->row_array();
        return $detail;
    }
}
