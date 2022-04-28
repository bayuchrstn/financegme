<?php
class Model_response extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function count_response($ticketid)
    {
        $this->db->where('ticketid', $ticketid);
        return $this->db->get('response')->num_rows();
    }

    function lists($ticketid, $limit, $offset)
    {
        $this->db->order_by('id', 'asc');
        $this->db->where('ticketid', $ticketid);
        return $this->db->get('response', $limit, $offset)->result_array();
    }




}
