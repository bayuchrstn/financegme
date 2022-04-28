<?php
class Model_raw extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function customer($customer_id)
    {
        $detail = $this->customer->detail_customer($customer_id);
        return $detail;
    }

    function get_task($id)
    {
        $arr = array();
        $this->db->where('task.id', $id);
        $this->db->select('task.*');
        $this->db->select('author.name as author_name');
        $this->db->join('users author', 'author.id=task.author', 'left');
		$data = $this->db->get('task')->row_array();
		// pre($this->db->last_query());
        if(!empty($data)):
            foreach($data as $key=>$val):
                $arr[$key] = $val;
            endforeach;

            //task_category
            switch (variable) {
                case 'value':
                # code...
                break;

                default:
                # code...
                break;
            }

        endif;


		return $arr;
    }


}
