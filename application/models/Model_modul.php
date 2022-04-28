<?php
class Model_modul extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function detail($code)
    {
        $this->db->where('code', $code);
        return $this->db->get('modul')->row_array();
    }

}
