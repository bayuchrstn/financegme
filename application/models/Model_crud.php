<?php
class Model_crud extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function insert($table='patient', $params=array(), $except=array('xxx'))
    {
		$fields = $this->db->field_data($table);
		// pre($params);
		foreach ($fields as $field):
			if(!in_array($field->name, $except)):

				if(isset($params[$field->name])):
					$data[$field->name] = $params[$field->name];
				elseif($this->input->post($field->name)):
					$data[$field->name] = htmlspecialchars($this->input->post($field->name));
				else:
					$data[$field->name] = '';
				endif;

			endif;
		endforeach;
		// pre($data);
		$insert = $this->db->insert($table, $data);
		$arr['status'] = $insert;
		$arr['error'] = $this->db->error();
		$arr['last_id'] = $this->db->insert_id();
		// pre($arr);
		return $arr;
    }

	function update($table='patient', $params=array(), $except=array('xxx'))
    {
		$data = array();
		$fields = $this->db->field_data($table);
		// pre($params);
		foreach ($fields as $field):
			if(!in_array($field->name, $except)):

				if(isset($params[$field->name])):
					$data[$field->name] = $params[$field->name];
				elseif($this->input->post($field->name)):
					$data[$field->name] = htmlspecialchars($this->input->post($field->name));
				// else:
				// 	$data[$field->name] = '';
				endif;

			endif;
		endforeach;
		// pre($data);
		if(!empty($data)):
		    if(isset($params['id'])):
				$this->db->where('id', $params['id']);
		    elseif($this->input->post('id')):
				$this->db->where('id', $this->input->post('id'));
		    endif;
		    $update = $this->db->update($table, $data);
		endif;

		$arr['status'] = $update;
		$arr['error'] = $this->db->error();
		// pre($arr);
		return $arr;
    }


}
