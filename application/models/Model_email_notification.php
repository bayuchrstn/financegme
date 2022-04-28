<?php
class Model_email_notification extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all()
    {
        return $this->db->get('email_template')->result_array();
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('email_template')->row_array();
    }

    function get_agent_email()
    {
        $arr = array();
        $this->db->where('level', 'agent');
        $this->db->where('status', 'active');
        $agent = $this->db->get('users')->result_array();
        if(!empty($agent)):
            foreach($agent as $row):
                $arr[$row['email']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function tag_placeholder()
    {
        $arr = array();
        $this->db->where('category', 'email_placeholders');
        $tags = $this->db->get('master')->result_array();
        if(!empty($tags)):
            foreach($tags as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function get_data($code)
    {
        $arr = array();
        $this->db->where('code', $code);
        $email = $this->db->get('email_template')->row_array();
        if(!empty($email)):
            foreach($email as $row=>$val):
                $arr[$row] = $val;
            endforeach;
        endif;
        // pre($arr);
        return $arr;
    }

    function update($param=array())
    {
    if($this->input->post('code')):
        $data['code'] = $this->input->post('code');
    elseif(isset($param['code'])):
        $data['code'] = $param['code'];
    endif;

    if($this->input->post('name')):
        $data['name'] = $this->input->post('name');
    elseif(isset($param['name'])):
        $data['name'] = $param['name'];
    endif;

    if($this->input->post('description')):
        $data['description'] = $this->input->post('description');
    elseif(isset($param['description'])):
        $data['description'] = $param['description'];
    endif;

    if($this->input->post('subject')):
        $data['subject'] = $this->input->post('subject');
    elseif(isset($param['subject'])):
        $data['subject'] = $param['subject'];
    endif;

    if($this->input->post('body_fake')):
        $data['body'] = $this->input->post('body_fake');
    elseif(isset($param['body_fake'])):
        $data['body'] = $param['body_fake'];
    endif;

    if($this->input->post('status')):
        $data['status'] = $this->input->post('status');
    elseif(isset($param['status'])):
        $data['status'] = $param['status'];
    endif;

    if($this->input->post('receiver_mode')):
        $data['receiver_mode'] = $this->input->post('receiver_mode');
    elseif(isset($param['receiver_mode'])):
        $data['receiver_mode'] = $param['receiver_mode'];
    endif;

    if($this->input->post('receiver')):
        $data['receiver'] = $this->input->post('receiver');
    elseif(isset($param['receiver'])):
        $data['receiver'] = $param['receiver'];
    endif;

    if(!empty($data)):
        if($this->input->post('id')):
            $this->db->where('id', $this->input->post('id'));
        elseif(isset($param['id'])):
            $this->db->where('id', $param['id']);
        endif;
        $update = $this->db->update('email_template', $data);
    endif;
    }

}
