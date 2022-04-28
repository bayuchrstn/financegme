<?php
class Frame
{
    function __construct($options = null) {
        $this->CI =& get_instance();
    }

    function main_crud($options)
    {
        valid_action($options['modul_code']);
		$this->CI->breadcrumb = array(
				$this->CI->lang->line('supplier_alltitle')	=> '#',
			);
		$data = array();

		$this->CI->js_inject .= $this->CI->load->view($options['modul_code'].'/js_table', $data, TRUE);
		$this->CI->js_inject .= $this->CI->load->view($options['modul_code'].'/js', $data, TRUE);
		$this->CI->js_inject .= $this->CI->load->view($options['modul_code'].'/valid', $data, TRUE);

		$data['update_view'] = $this->CI->load->view($options['modul_code'].'/update', $data, TRUE);
		$data['insert_view'] = $this->CI->load->view($options['modul_code'].'/insert', $data, TRUE);
		$data['delete_view'] = $this->CI->load->view($options['modul_code'].'/delete', $data, TRUE);

		$konten = $this->CI->load->view($options['modul_code'].'/index', $data, TRUE);
		$this->CI->admin_view($konten);
    }

    function insert($options)
    {
        ajax_only();
		$arr_msg = array();
		if( $this->CI->form_validation->run($options['server_side_validation']) ):
			$this->CI->db->insert($options['table'], $options['data']);
			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $options['msg_success'];
			// $arr_msg['last_query'] = $this->db->last_query();
		else:
			$arr_msg['status'] = 'failed';
			$arr_msg['msg'] = $options['msg_failed'];
		endif;
		$response = json_encode($arr_msg);
		echo $response;
    }

}
