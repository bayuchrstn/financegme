<?php
class Model_form_editor extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function all($modul)
    {
        // $this->db->where('status !=', 'need_approval');
        $this->db->where('modul', $modul);
        return $this->db->get('form')->result_array();
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('form')->row_array();
    }

	function get_modul()
    {
        return $this->db->query('SELECT Distinct(modul) from {PRE}form')->result_array();
    }

	function update($param=array())
	{
		if($this->input->post('modul')):
		    $data['modul'] = htmlspecialchars($this->input->post('modul'));
		elseif(isset($param['modul'])):
		    $data['modul'] = htmlspecialchars($param['modul']);
		endif;

		if($this->input->post('section')):
		    $data['section'] = htmlspecialchars($this->input->post('section'));
		elseif(isset($param['section'])):
		    $data['section'] = htmlspecialchars($param['section']);
		endif;

		if($this->input->post('view')):
		    $data['view'] = htmlspecialchars($this->input->post('view'));
		elseif(isset($param['view'])):
		    $data['view'] = htmlspecialchars($param['view']);
		endif;

		if($this->input->post('form_label')):
		    $data['form_label'] = htmlspecialchars($this->input->post('form_label'));
		elseif(isset($param['form_label'])):
		    $data['form_label'] = htmlspecialchars($param['form_label']);
		endif;

		if($this->input->post('form_name')):
		    $data['form_name'] = htmlspecialchars($this->input->post('form_name'));
		elseif(isset($param['form_name'])):
		    $data['form_name'] = htmlspecialchars($param['form_name']);
		endif;

		if($this->input->post('sort')):
		    $data['sort'] = htmlspecialchars($this->input->post('sort'));
		elseif(isset($param['sort'])):
		    $data['sort'] = htmlspecialchars($param['sort']);
		endif;

		if($this->input->post('form_id')):
		    $data['form_id'] = htmlspecialchars($this->input->post('form_id'));
		elseif(isset($param['form_id'])):
		    $data['form_id'] = htmlspecialchars($param['form_id']);
		endif;

		if($this->input->post('form_class')):
		    $data['form_class'] = htmlspecialchars($this->input->post('form_class'));
		elseif(isset($param['form_class'])):
		    $data['form_class'] = htmlspecialchars($param['form_class']);
		endif;

		if($this->input->post('form_value')):
		    $data['form_value'] = htmlspecialchars($this->input->post('form_value'));
		elseif(isset($param['form_value'])):
		    $data['form_value'] = htmlspecialchars($param['form_value']);
		endif;

		if($this->input->post('form_ext')):
		    $data['form_ext'] = htmlspecialchars($this->input->post('form_ext'));
		elseif(isset($param['form_ext'])):
		    $data['form_ext'] = htmlspecialchars($param['form_ext']);
		endif;

		if($this->input->post('maxlength')):
		    $data['maxlength'] = htmlspecialchars($this->input->post('maxlength'));
		elseif(isset($param['maxlength'])):
		    $data['maxlength'] = htmlspecialchars($param['maxlength']);
		endif;

		if($this->input->post('status')):
		    $data['status'] = htmlspecialchars($this->input->post('status'));
		elseif(isset($param['status'])):
		    $data['status'] = htmlspecialchars($param['status']);
		endif;

		if(!empty($data)):
		    if($this->input->post('id')):
		        $this->db->where('id', $this->input->post('id'));
		    elseif(isset($param['id'])):
		        $this->db->where('id', $param['id']);
		    endif;
		    $update = $this->db->update('form', $data);
		endif;
	}


	function paste($param=array())
	{
		if($this->input->post('modul')):
		    $data['modul'] = htmlspecialchars($this->input->post('modul'));
		elseif(isset($param['modul'])):
		    $data['modul'] = htmlspecialchars($param['modul']);
		else:
		    $data['modul'] = '';
		endif;

		if($this->input->post('section')):
		    $data['section'] = htmlspecialchars($this->input->post('section'));
		elseif(isset($param['section'])):
		    $data['section'] = htmlspecialchars($param['section']);
		else:
		    $data['section'] = '';
		endif;

		if($this->input->post('view')):
		    $data['view'] = htmlspecialchars($this->input->post('view'));
		elseif(isset($param['view'])):
		    $data['view'] = htmlspecialchars($param['view']);
		else:
		    $data['view'] = '';
		endif;

		if($this->input->post('form_label')):
		    $data['form_label'] = htmlspecialchars($this->input->post('form_label'));
		elseif(isset($param['form_label'])):
		    $data['form_label'] = htmlspecialchars($param['form_label']);
		else:
		    $data['form_label'] = '';
		endif;

		if($this->input->post('form_name')):
		    $data['form_name'] = htmlspecialchars($this->input->post('form_name'));
		elseif(isset($param['form_name'])):
		    $data['form_name'] = htmlspecialchars($param['form_name']);
		else:
		    $data['form_name'] = '';
		endif;

		if($this->input->post('sort')):
		    $data['sort'] = htmlspecialchars($this->input->post('sort'));
		elseif(isset($param['sort'])):
		    $data['sort'] = htmlspecialchars($param['sort']);
		else:
		    $data['sort'] = '';
		endif;

		if($this->input->post('form_id')):
		    $data['form_id'] = htmlspecialchars($this->input->post('form_id'));
		elseif(isset($param['form_id'])):
		    $data['form_id'] = htmlspecialchars($param['form_id']);
		else:
		    $data['form_id'] = '';
		endif;

		if($this->input->post('form_class')):
		    $data['form_class'] = htmlspecialchars($this->input->post('form_class'));
		elseif(isset($param['form_class'])):
		    $data['form_class'] = htmlspecialchars($param['form_class']);
		else:
		    $data['form_class'] = '';
		endif;

		if($this->input->post('form_value')):
		    $data['form_value'] = htmlspecialchars($this->input->post('form_value'));
		elseif(isset($param['form_value'])):
		    $data['form_value'] = htmlspecialchars($param['form_value']);
		else:
		    $data['form_value'] = '';
		endif;

		if($this->input->post('form_ext')):
		    $data['form_ext'] = htmlspecialchars($this->input->post('form_ext'));
		elseif(isset($param['form_ext'])):
		    $data['form_ext'] = htmlspecialchars($param['form_ext']);
		else:
		    $data['form_ext'] = '';
		endif;

		if($this->input->post('maxlength')):
		    $data['maxlength'] = htmlspecialchars($this->input->post('maxlength'));
		elseif(isset($param['maxlength'])):
		    $data['maxlength'] = htmlspecialchars($param['maxlength']);
		else:
		    $data['maxlength'] = '';
		endif;

		if($this->input->post('status')):
		    $data['status'] = htmlspecialchars($this->input->post('status'));
		elseif(isset($param['status'])):
		    $data['status'] = htmlspecialchars($param['status']);
		else:
		    $data['status'] = '';
		endif;

		$insert = $this->db->insert('form', $data);
		$arr['status'] = $insert;
		$arr['last_id'] = $this->db->insert_id();
		return $arr;
	}



}
