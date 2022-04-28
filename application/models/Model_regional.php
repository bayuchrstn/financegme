<?php
class Model_regional extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all($regional)
    {
        $this->db->where('up', $regional);
        return $this->db->get('regional')->result_array();
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('regional')->row_array();
    }

    function arr_regional()
    {
        $arr_regional = array();
        $this->db->where('up', '0');
        $regional = $this->db->get('regional')->result_array();
        if(!empty($regional)):
            foreach($regional as $row):
                $arr_regional[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr_regional;
    }

    function arr_regional_nik()
    {
        $arr_regional = array();
        $this->db->where('up', '0');
        $regional = $this->db->get('regional')->result_array();
        if(!empty($regional)):
            foreach($regional as $row):
                $arr_regional[$row['code']] = $row['code'];
            endforeach;
        endif;
        return $arr_regional;
    }

    function arr_area($regional)
    {
        $arr_area = array();
        $this->db->where('up', $regional);
        $area = $this->db->get('regional')->result_array();
        if(!empty($area)):
            foreach($area as $row):
                $arr_area[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr_area;
    }

    function update($param=array())
    {
        if($this->input->post('up')):
            $data['up'] = $this->input->post('up');
        elseif(isset($param['up'])):
            $data['up'] = $param['up'];
        endif;

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        endif;

        if($this->input->post('timezone')):
            $data['timezone'] = $this->input->post('timezone');
        elseif(isset($param['timezone'])):
            $data['timezone'] = $param['timezone'];
        endif;

        if($this->input->post('code')):
            $data['code'] = $this->input->post('code');
        elseif(isset($param['code'])):
            $data['code'] = $param['code'];
        endif;

        if(!empty($data)):
            if($this->input->post('id')):
                $this->db->where('id', $this->input->post('id'));
            elseif(isset($param['id'])):
                $this->db->where('id', $param['id']);
            endif;
            $update = $this->db->update('regional', $data);
        endif;
    }

    function insert($param=array())
    {
        if($this->input->post('up')):
            $data['up'] = $this->input->post('up');
        elseif(isset($param['up'])):
            $data['up'] = $param['up'];
        else:
            $data['up'] = '0';
        endif;

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        else:
            $data['name'] = '';
        endif;

        if($this->input->post('timezone')):
            $data['timezone'] = $this->input->post('timezone');
        elseif(isset($param['timezone'])):
            $data['timezone'] = $param['timezone'];
        else:
            $data['timezone'] = '';
        endif;

        if($this->input->post('code')):
            $data['code'] = $this->input->post('code');
        elseif(isset($param['code'])):
            $data['code'] = $param['code'];
        else:
            $data['code'] = '';
        endif;

        $insert = $this->db->insert('regional', $data);
        $arr['status'] = $insert;
        $arr['last_id'] = $this->db->insert_id();
        return $arr;
    }

    function get_timezone()
    {
        $session = $this->session->all_userdata();
        $this->db->where('code', $session['scope_regional']);
        $regional = $this->db->get('regional')->row_array();
        $timezone = $regional['timezone'];
        return $timezone;
    }

    function get_regional_name($code)
    {
        $this->db->where('code', $code);
        $regional = $this->db->get('regional')->row_array();
        // pre($this->db->last_query());
        return $regional['name'];
    }

	function set_filter($field='')
	{
		$regional = session_scope_regional();
		$this->db->where('regional', $regional);
	}


}
