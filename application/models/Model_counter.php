<?php
class Model_counter extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get($category='patient')
    {
        $this->db->where('category', $category);
        $lastest = $this->db->get('counter')->row_array();
        $lastest = (int) $lastest['lastest'];
        return $lastest + 1;
    }

    function set($category='patient')
    {
        $sql = "UPDATE {PRE}counter SET lastest=lastest+1 WHERE category='".$category."'";
        $this->db->query($sql);
    }

}
