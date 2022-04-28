<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipman extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		include_once APPPATH.'third_party/SubnetCalculator.php';

		$this->load->model('model_ipman', 'ipman');
		$this->lang->load('ipman');
		$this->active_root_menu = $this->lang->line('ipman_alltitle');
		$this->browser_title = $this->lang->line('ipman_alltitle');
		$this->modul_name = $this->lang->line('ipman_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index()
	{
		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('ipman_alltitle') => '#');
		$data = array();

		$this->js_inject .= $this->load->view('ipman/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('ipman/js', $data, TRUE);
		$this->js_inject .= $this->load->view('ipman/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');

		// $data['update_view'] = $this->load->view('ipman/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('ipman/insert', $data, TRUE);
		// $data['delete_view'] = $this->load->view('ipman/delete', $data, TRUE);
		$data['detail_view'] = $this->load->view('ipman/detail', $data, TRUE);

		$konten = $this->load->view('ipman/index', $data, TRUE);
		$this->admin_view($konten);
	}
	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				'IP'		=> $detail['ip_address'].'/'.$detail['netmask'],
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data()
	{
		$product = $this->ipman->data();

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_detail'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="detail_ipman(\''.$row['ip_address'].'\',\''.$row['netmask'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				$arr['data'][] = array(
						'x',
						$row['ip_address'].'/'.$row['netmask'],
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

	function detail($ip, $netmask=32, $offset=0)
	{
		// ajax_only();
		$arr = array();
		$error = false;
		if (!filter_var($ip, FILTER_VALIDATE_IP)) {
			// exit("Invalid IP address!");
			$error = 'Invalid IP address!';
		}
		if (( $netmask < 1 ) || ( $netmask > 32 ) || ( $netmask==31 )) {
			// exit("Invalid netmask.");
			$error = 'Invalid netmask.';
		}

		$sub = new IPv4\SubnetCalculator($ip,$netmask);
		$result = $sub->getSubnetArrayReport();

		$ip_first = $result['ip_address_range'][0];
		$ip_last = $result['ip_address_range'][1];

		$quads_ip_first = explode('.', $ip_first);
		$quads_ip_last = explode('.', $ip_last);

		$list_ip = $sub->getIpListRange();

		$arr = array(
			'ip'	=> $result['ip_address']['quads'],
			'netmask'	=> $result['subnet_mask']['quads'],
			'range'	=> $ip_first.' - '.$ip_last,
			'total_ip'	=> $result['number_of_ip_addresses'],
			'usable'	=> $result['number_of_addressable_hosts'],
		);

		if ($arr['total_ip'] <= 256) {
			$arr['list_ip'] = $list_ip;
		} else {
			for ($i = 0; $i < 256; $i++) {
				$urutan = ($offset*256)+$i;
				$arr['list_ip'][$i] = $list_ip[$urutan];
			}
		}

		$head_ip = explode('.', $arr['list_ip'][0]);
		$arr['ip_head'] = $head_ip[0].'.'.$head_ip[1].'.'.$head_ip[2];
		foreach ($arr['list_ip'] as $value) {
			$tail_ip = explode('.', $value);
			$arr['ip_tail'][] = '.'.$tail_ip[3];
		}

		echo json_encode($arr);
		// pre($arr);
	}

	function insert()
	{
		if ($this->form_validation->run('ipman_insert') == TRUE) {
			$ip = $this->input->post('ip');
			$netmask = !$this->input->post('netmask') ? 32 : $this->input->post('netmask');
			$params = array(
				'ip_address'	=> $ip,
				'netmask'		=> $netmask
			);

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
		} else {
			$arr['status'] = 'failed';
			$arr['msg'] = 'Data gagal disimpan';
		}
		echo json_encode($arr);
	}

	function delete($id)
	{
		ajax_only();
		if ($this->form_validation->run('ipman_update')) {
			# code...
		} else {
			# code...
			$detail = $this->ipman->detail($id);
			$arr = array();
			$arr['action'] = base_url().'ipman/update/'.$detail['id'];
		}
	}
}

/* End of file Ipman.php */
/* Location: ./application/controllers/Ipman.php */