<?php
class Model_comment extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get($parent='')
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('parent', $parent);
        $this->db->select('comment.*');
        $this->db->select('author.name as author_name');
        $this->db->join('users author', 'author.id = comment.author');
        $data = $this->db->get('comment')->result_array();
        return $data;
    }

}
