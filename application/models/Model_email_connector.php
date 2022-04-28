<?php
class Model_email_connector extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function check_by_uid($uid)
    {
        $ada = $this->db->get_where('email_connector', array('uid'=>$uid))->result_array();
        // pre($this->db->last_query());
        // pre($ada);
        if(!empty($ada)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    function ready_to_insert()
    {
        $this->db->where('YEAR(datetime)', date('Y'));
        $this->db->where('MONTH(datetime)', date('m'));
        $this->db->where('DAY(datetime)', date('d'));
        $this->db->where('ticket_number !=', '-');
        $this->db->where('flag_insert', '0');
        return $this->db->get('email_connector')->result_array();
    }

    function set_flag_insert($uid)
    {
        $this->db->query("UPDATE {PRE}email_connector SET flag_insert='1' WHERE uid='".$uid."'");
    }

    function get_ticket_id($ticket_number)
    {
        $ticket = $this->db->get_where('tickets', array('number'=>$ticket_number))->row_array();
        return $ticket['id'];
    }

}
