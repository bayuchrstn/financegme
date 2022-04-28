<?php
class Model_ticket_action extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get_action_lists()
    {
        $this->db->where('flag_show_list', 'Y');
        return $this->db->get('ticket_action')->result_array();
    }

}
