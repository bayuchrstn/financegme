<?php
class Model_product_category extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all()
    {
        return $this->db->get('product_category')->result_array();
    }

	function detail($id)
    {
		$this->db->where('id', $id);
        return $this->db->get('product_category')->row_array();
    }

	function insert($param=array())
	{
		if($this->input->post('code')):
		    $data['code'] = htmlspecialchars($this->input->post('code'));
		elseif(isset($param['code'])):
		    $data['code'] = htmlspecialchars($param['code']);
		else:
		    $data['code'] = '';
		endif;

		if($this->input->post('name')):
		    $data['name'] = htmlspecialchars($this->input->post('name'));
		elseif(isset($param['name'])):
		    $data['name'] = htmlspecialchars($param['name']);
		else:
		    $data['name'] = '';
		endif;

		if($this->input->post('regional')):
		    $data['regional'] = htmlspecialchars($this->input->post('regional'));
		else:
		    $data['regional'] = '';
		endif;

		$insert = $this->db->insert('product_category', $data);
		$arr['status'] = $insert;
		$arr['last_id'] = $this->db->insert_id();
		return $arr;
	}

	function update($param=array())
	{
		if($this->input->post('code')):
		    $data['code'] = htmlspecialchars($this->input->post('code'));
		elseif(isset($param['code'])):
		    $data['code'] = htmlspecialchars($param['code']);
		endif;

		if($this->input->post('name')):
		    $data['name'] = htmlspecialchars($this->input->post('name'));
		elseif(isset($param['name'])):
		    $data['name'] = htmlspecialchars($param['name']);
		endif;

		if($this->input->post('regional')):
		    $data['regional'] = htmlspecialchars($this->input->post('regional'));
		elseif(isset($param['regional'])):
		    $data['regional'] = htmlspecialchars($param['regional']);
		endif;

		if(!empty($data)):
		    if($this->input->post('id')):
		        $this->db->where('id', $this->input->post('id'));
		    elseif(isset($param['id'])):
		        $this->db->where('id', $param['id']);
		    endif;
		    $update = $this->db->update('product_category', $data);
		endif;
	}

}
