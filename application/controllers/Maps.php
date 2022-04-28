<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		include_once APPPATH.'third_party/SubnetCalculator.php';
		$this->load->model('model_maps', 'maps');
		$this->lang->load('maps');
		$this->active_root_menu = $this->lang->line('maps_alltitle');
		$this->browser_title = $this->lang->line('maps_alltitle');
		$this->modul_name = $this->lang->line('maps_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index()
	{
		$this->breadcrumb = array('Home' => base_url(),
			$this->lang->line('maps_alltitle') => '#');
		$data = array();

		$this->js_inject .= $this->load->view('maps/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('maps/js', $data, TRUE);
		$this->js_inject .= $this->load->view('maps/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');

		$data['update_view'] = $this->load->view('maps/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('maps/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('maps/delete', $data, TRUE);
		$data['detail_view'] = $this->load->view('maps/detail', $data, TRUE);

		$konten = $this->load->view('maps/index', $data, TRUE);
		$this->admin_view($konten);
	}

	function insert()
	{
		if (!$this->form_validation->run('maps_insert')) {
			$arr['status'] = 'failed';
			$arr['msg'] = 'Data gagal disimpan';
		} else {
			$type_maps = strpos($this->input->post('maps_type'), 'fiber')!==FALSE ? 'line' : (strpos($this->input->post('maps_type'), 'customer')!==FALSE ? 'customer' : 'point');

			$params = array(
				'maps_lat'	=> $this->input->post('maps_lat'),
				'maps_lng'	=> $this->input->post('maps_lng'),
				'maps_desc'	=> $this->input->post('maps_desc'),
				'maps_type'	=> $this->input->post('maps_type')
			);

			switch ($type_maps) {
				case 'line':
					$params['maps_name'] = $this->input->post('maps_name');
					$params['maps_code'] = str_to_code($params['maps_name']);
					$point2 = $params;
					$point2['maps_lat'] = $this->input->post('maps_lat_line_2');
					$point2['maps_lng'] = $this->input->post('maps_lng_line_2');
					break;
				case 'customer':
					$query = $this->db->where('id', $this->input->post('customer'))->get('customer');
					$result = $query->row_array();
					$params['maps_customer_id'] = $this->input->post('customer');
					$params['maps_name'] = $result['customer_name'];
					break;
				
				default:
					$params['maps_name'] = $this->input->post('maps_name');
					break;
			}

			$params['maps_code'] = str_to_code($params['maps_name']);

			$exists = $this->db->where($params)->get('maps')->num_rows();
			if ($exists == 0) :
				$this->db->flush_cache();
				$this->db->insert('maps', $params);
				$maps_id = $this->db->insert_id();

				if ($this->input->post('ip')) {
					$params_ip = array(
						'ipam_maps_id'	=> $maps_id,
						'ipam_ip'		=> $this->input->post('ip'),
						'ipam_subnet'	=> $this->input->post('subnet') ? $this->input->post('subnet') : '32',
						'ipam_ip_type'	=> $this->input->post('ip_type')
					);
				}

				if ($type_maps=='line') {
					$point2['maps_parent'] = $maps_id;
					$this->db->flush_cache();
					$this->db->insert('maps', $point2);
				}
			endif;

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan '.$type_maps;
		}
		echo json_encode($arr);
	}
	function update($id)
	{
		if (!$this->form_validation->run('maps_update')) {
			$detail = $this->maps->detail($id);
			$arr = array();
			$arr['action'] = base_url().'maps/update/'.$detail['maps_id'];

			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		} else {
			$arr_msg = array();

			$data = array(
					'maps_lat'	=> $this->input->post('maps_lat'),
					'maps_lng'	=> $this->input->post('maps_lng'),
					'maps_desc'	=> $this->input->post('maps_desc'),
				);

			if ($this->input->post('maps_customer')) {
				$query = $this->db->where('id', $this->input->post('maps_customer'))->get('customer');
				$result = $query->row_array();
				$data['maps_customer_id'] = $result['id'];
				$data['maps_name'] = $result['customer_name'];
			} else {
				$data['maps_name'] = $this->input->post('maps_name');
			}
			$data['maps_code'] = str_to_code($data['maps_name']);

			$this->db->where('maps_id', $this->input->post('id'));
			$this->db->update('maps', $data);

			if (($this->input->post('maps_lat2')) && ($this->input->post('maps_lng2'))) {
				$data_child = array(
					'maps_name'	=> $data['maps_name'],
					'maps_code'	=> $data['maps_code'],
					'maps_lat'	=> $this->input->post('maps_lat2'),
					'maps_lng'	=> $this->input->post('maps_lng2'),
					'maps_desc'	=> $this->input->post('maps_desc')
				);

				$this->db->flush_cache();
				$this->db->where('maps_parent', $id)
					->update('maps', $data_child);
			}

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = "data berhasil disimpan";
			echo json_encode($arr_msg);
		}
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				$this->lang->line('maps_name')	=> $detail['maps_name'],
				$this->lang->line('maps_coordinate') => $detail['maps_lat'].', '.$detail['maps_lng'],
				// $this->lang->line('maps_type')	=> $detail['maps_type_name']

				// 'Email'		=> $detail['email'],
			);
		if ($detail['maps_parent2']!==null) {
			$data['info'][$this->lang->line('maps_coordinate2')] = $detail['maps_lat2'].', '.$detail['maps_lng2'];
		}
		$data['info'][$this->lang->line('maps_type')] = $detail['maps_type_name'];
		$data['info'][$this->lang->line('maps_desc')] = $detail['maps_desc'];
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($maps_type='customer_active')
	{
		$product = $this->maps->all($maps_type);

		$arr = array();
		$arr['data'] = array();
		if(!empty($product)):
			$urut = 0;
			foreach($product as $row):
				$urut++;

				$hidden_form['detail'] = array('label'=>$this->lang->line('all_detail'), 'url'=>'javascript:void(0);', 'icon'=>'icon-eye', 'more'=>'onclick="detail_maps(\''.$row['maps_id'].'\',\''.$row['maps_type'].'\');" class="edit_button" ');

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_maps(\''.$row['maps_id'].'\',\''.$row['maps_type'].'\');" class="edit_button" ');

				$hidden_form['delete'] = array('label'=>$this->lang->line('all_delete'), 'url'=>'javascript:void(0);', 'icon'=>'icon-trash', 'more'=>'onclick="delete_maps(\''.$row['maps_id'].'\',\''.$row['maps_type'].'\');" class="edit_button" ');


		        $action = $this->actionform->dropdown($hidden_form);

		        if (!empty($row['maps_lat2']) && !empty($row['maps_lng2'])) {
		        	$line2 = ' to '.$row['maps_lat2'].', '.$row['maps_lng2'];
		        } else {
		        	$line2 = '';
		        }

				$arr['data'][] = array(
						'x',
						clean_string($row['maps_customer_id']==null ? $row['maps_name'] : $row['customer_name'], 40),
						$row['maps_lat'].', '.$row['maps_lng'].$line2,
						// clean_string($row['maps_type_name'], 40),
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

	public function delete($id='')
	{
		$detail = $this->maps->detail($id);
		if($this->form_validation->run('maps_delete')):
			$arr_msg = array();
			$this->db->where('maps_id', $this->input->post('id'))
				->or_where('maps_parent', $this->input->post('id'));
			$this->db->delete('maps');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['maps_type'] = $detail['maps_type'];
			$arr_msg['msg'] = $detail['maps_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'maps/delete/'.$detail['maps_id'];
			// $related = $this->related->cuti($detail['maps_id']);
			$related = FALSE;
			$arr['data_info'] = $this->data_info($detail);
			$arr['removable'] = (!$related) ? 'yes' : 'no';
			$arr['remove_confirm'] = (!$related) ? $this->lang->line('dialog_confirm_delete') : $this->lang->line('dialog_no_delete');
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		endif;
	}


	function get_maps_type()
	{
		$data = '';
		// if(allow_modul('cuti_karyawan')){
			$datas = $this->maps->get_maps_type_icon();
			foreach ($datas as $row) {
				$data .= '<option value="'.$row['maps_type_code'].'">';
				$data .= $row['maps_type_name'].'</option>';
			}
		// }
		echo $data;
	}

	function get_customer($status='customer')
	{
		$query = $this->db->where('status', $status)->get('customer');
		$ret = '';
		$data = $query->result_array();
		if (count($data) > 0) {
			foreach ($data as $row) {
				$ret .= '<option value="'.$row['id'].'">';
				$ret .= $row['customer_name'].'</option>';
			}
		}
		echo $ret;
	}
	

	function detail($id)
	{
		ajax_only();
		$detail = $this->maps->detail($id);
		$data['data_info'] = $this->data_info($detail); 
		$data['maps'] = $detail;
		$data['maps_frame'] = base_url().'maps/view_maps/'.$id;
		echo json_encode($data);
	}
	function view_maps($id)
	{
		$detail = $this->maps->detail($id);
		$data = $this->all_setting;
		$data['maps'] = $detail;

		$data['point_script'] = ($detail['maps_type_point'] == 'line') ? "route".$detail['maps_id']." = [new google.maps.LatLng(".$detail['maps_lat'].", ".$detail['maps_lng']."),new google.maps.LatLng(".$detail['maps_lat2'].", ".$detail['maps_lng2'].")];var line_color = '".$detail['maps_type_icon']."';var traceroute".$detail['maps_id']." = new google.maps.Polyline({path:route".$detail['maps_id'].",strokeColor:line_color,strokeOpacity:1.0,strokeWeight:2});var service".$detail['maps_id']." = new google.maps.DirectionsService(),traceroute".$detail['maps_id'].",snap_path".$detail['maps_id']."=[];traceroute".$detail['maps_id'].".setMap(map);for(j=0;j<route".$detail['maps_id'].".length-1;j++){service".$detail['maps_id'].".route({origin:route".$detail['maps_id']."[j],destination:route".$detail['maps_id']."[j+1],travelMode:google.maps.DirectionsTravelMode.WALKING},function(result, status) {if(status == google.maps.DirectionsStatus.OK) {snap_path".$detail['maps_id']." = snap_path".$detail['maps_id'].".concat(result.routes[0].overview_path);traceroute".$detail['maps_id'].".setPath(snap_path".$detail['maps_id'].");} else alert(\"Directions request failed: \"+status);});}" 
		: "var marker = new google.maps.Marker({position: ".$detail['maps_code'].",map: map});";

		$this->parser->parse('maps/maps_view', $data, FALSE);
	}

	function all_maps()
	{
		$data = array();
		$data = $this->all_setting;

		$maps_center = $this->master->master_by_code('maps_center','maps_center_jogja');
		$maps_center = $maps_center['note'];

		$maps_center = str_replace(' ', '', $maps_center);
		$maps_center_pos = explode(',', $maps_center);

		$data['maps_center'] = array(
			'lat'	=> $maps_center_pos[0],
			'lng'	=> $maps_center_pos[1],
		);
		$this->parser->parse('maps/all_maps', $data, FALSE);
	}

	function drop_maps()
	{
		$data = array();
		$data = $this->all_setting;

		$maps_center = $this->master->master_by_code('maps_center','maps_center_jogja');
		$maps_center = $maps_center['note'];

		$maps_center = str_replace(' ', '', $maps_center);
		$maps_center_pos = explode(',', $maps_center);

		$data['maps_center'] = array(
			'lat'	=> $maps_center_pos[0],
			'lng'	=> $maps_center_pos[1],
		);
		$this->parser->parse('maps/drop_map', $data, FALSE);
	}

	function maps_data($point_type)
	{
		// ajax_only();
		$data = $this->maps->get_maps_by_point_type($point_type);
		header("Content-Type: text/xml;charset=iso-8859-1");
		echo "<markers>";
		if (count($data) > 0) :
			foreach ($data as $row) {
				echo '<marker ';
				echo 'id="' . $row['maps_id'] . '" ';
				echo 'name="' . ($row['maps_name']) . '" ';
				echo 'address="' . strToXML($row['maps_desc']) . '" ';
				echo 'lat="' . $row['maps_lat'] . '" ';
				echo 'lng="' . $row['maps_lng'] . '" ';
				echo 'lat2="' . $row['maps_lat2'] . '" ';
				echo 'lng2="' . $row['maps_lng2'] . '" ';
				echo 'type="' . $row['maps_type'] . '" ';
				echo 'type_name="(' . $row['maps_type_name'] . ')" ';
				echo 'type_point="' . $row['maps_type_point'] . '" ';
				echo 'point_icon="' . $row['maps_type_icon'] . '" ';
				echo '/>';
			}
		endif;
		echo "</markers>";

	}

	function test_ping($host)
	{
		exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
        return $rval === 0;
	}

	function ping($host)
	{
		$result = $this->test_ping($host);
		$up = $result ? 'on' : 'off';
		echo $up;
	}

	function subnet($ip,$subnet=32)
	{
		// echo $ip.'/'.$subnet;
		
		if (!filter_var($ip, FILTER_VALIDATE_IP)) {
			exit("Invalid IP address!");
		}
		if (( $subnet < 1 ) || ( $subnet > 32 ) || ( $subnet==31 )) {
			exit("Invalid subnet.");
		}

		$sub = new IPv4\SubnetCalculator($ip,$subnet);
		$result = $sub->getSubnetArrayReport();

		$ip = $result['ip_address']['quads'];
		$netmask = $result['subnet_mask']['quads'];
		$ip_first = $result['ip_address_range'][0];
		$ip_last = $result['ip_address_range'][1];
		$range = $ip_first.' - '.$ip_last;
		$total_ip = $result['number_of_ip_addresses'];
		$usable_ip = $result['number_of_addressable_hosts'];

		$quads_ip_first = explode('.', $ip_first);
		$quads_ip_last = explode('.', $ip_last);

		$list_ip = $sub->getIpListRange();

		$arr = array(
			'ip'	=> $ip,
			'netmask'	=> $netmask,
			'range'	=> $range,
			'host_total'	=> $total_ip,
			'host_usable'	=> $usable_ip,
			'batch_list'	=> $list_ip
		);

		$test = '192.168';
		$resTest = explode('.', $test);
		$arr['test'] = $resTest;
		// echo 'IP : '.$ip.'<br>';
		// echo 'Netmask : '.$netmask.'<br>';
		// echo 'Range : '.$range.'<br>';
		// echo 'Total Host Ip: '.$total_ip.'<br>';
		pre($arr);
	}

}

/* End of file Maps.php */
/* Location: ./application/controllers/Maps.php */