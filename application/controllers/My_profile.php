<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_profile extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
	}

	function update()
	{
		if($this->form_validation->run('update_profile')):
			$arr_msg = array();
			$data = array(
					'name' 			=> htmlspecialchars($this->input->post('name')),
					'email'  		=> htmlspecialchars($this->input->post('email'))
				);
			if( $this->input->post('password') !='' ):
				$data['password'] = pass_generator($this->input->post('password'));
			endif;

			$this->db->where('id', my_id());
			$this->db->update('users', $data);

			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('dialog_update_profile_success');
			$arr_msg['new_name'] = htmlspecialchars($this->input->post('name'));
			$response = json_encode($arr_msg);
			echo $response;
		else:
			$arr_msg = array();
			$arr['my_name'] = my_name();
			$arr['my_email'] = my_email();
			$arr['my_username'] = my_username();
			echo json_encode($arr);
		endif;
	}
}
