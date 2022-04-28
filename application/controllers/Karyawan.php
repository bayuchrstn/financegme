<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_karyawan', 'karyawan');

		$this->active_root_menu = 'pre_customer';
		$this->browser_title = 'Karyawan - '.$this->app_name;
		$this->modul_name = 'karyawan';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}


	public function index($pre_customer_group='')
	{
		valid_action('karyawan');
		$this->breadcrumb = array(
				'Home' 		=> base_url(),
				'Karyawan'	=> '#',
			);
		$data = array();

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('ajax_upload');

		$this->js_inject .= $this->load->view('karyawan/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('karyawan/js', $data, TRUE);
		$this->js_inject .= $this->load->view('karyawan/valid', $data, TRUE);
		$this->js_inject .= $this->load->view('karyawan/js_upload', $data, TRUE);
		$this->js_include .= $this->ui->js_include('jquery_ui');

		$data['update_view'] = $this->load->view('karyawan/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('karyawan/insert', $data, TRUE);
		// $data['delete_view'] = $this->load->view('karyawan/delete', $data, TRUE);
		$data['search_view'] = $this->load->view('karyawan/search', $data, TRUE);
		$data['show_view'] = $this->load->view('karyawan/show_this', $data, TRUE);
		$data['modal_view'] = $this->load->view('karyawan/modal', $data, TRUE);
		$data['advance_search'] = $this->load->view('karyawan/advance_search', $data, TRUE);

		$konten = $this->load->view('karyawan/index', $data, TRUE);
		$this->admin_view($konten);
	}

	function insert()
	{
		if($this->form_validation->run('input_karyawan')):
			$arr = array();
			$params = array();
			$params['kode_karyawan'] = kode_karyawan($this->input->post('name'));
			$params['nik'] = nik_join();
			$status_insert = $this->crud->insert('people', $params, array('id'));
			if($status_insert):

				if($this->input->post('flag_account')=='Y'):
					$this->karyawan->create_account();
				endif;

				$this->karyawan->new_timeline($params['kode_karyawan'], 'tanggal_masuk', $this->input->post('tanggal_masuk'));
			endif;
			// $arr['post'] = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	public function update($id='')
	{
		// valid_action('marketing_progress');
		ajax_only();
		$detail = $this->karyawan->detail($id);
		if(!$this->form_validation->run( 'update_detail_karyawan' )):
			$arr = array();
			$arr['action'] = base_url().'karyawan/update/'.$detail['id'];

			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			$data = array(
				'name'	=> $this->input->post('name'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
				'alamat_asli'	=> $this->input->post('alamat_asli'),
				'alamat_tinggal'	=> $this->input->post('alamat_tinggal'),
				'pendidikan'	=> $this->input->post('pendidikan'),
				'agama'	=> $this->input->post('agama'),
				'jenis_kelamin'	=> $this->input->post('kelamin'),
				'telephone'	=> $this->input->post('telepon'),
				'handphone'	=> $this->input->post('handphone'),
				'email'	=> $this->input->post('email'),
				'ym'	=> $this->input->post('ym'),
				'status_pernikahan'	=> $this->input->post('status_pernikahan'),
				'jumlah_anak'	=> $this->input->post('jumlah_anak'),
				'asuransi'	=> $this->input->post('asuransi'),
				'bca'	=> $this->input->post('rekening'),
				'departemen'	=> $this->input->post('departemen'),
				'jabatan'	=> $this->input->post('jabatan'),
				'note'	=> $this->input->post('note')
			);

			$this->db->where('id', $this->input->post('id'))
				->update('people',$data);

			$arr['status'] = 'success';
			$arr['msg'] = 'Data behasil disimpan';
			$arr['post'] = $_POST;	
			echo json_encode($arr);
		endif;
	}

	function get_next_nik($regional)
	{
		$get_max_nik = "SELECT MAX(nik_order) AS bigger FROM ".$this->db->dbprefix."people WHERE regional='".$regional."'";
		$qry = $this->db->query($get_max_nik);
		$data_max = $qry->row_array();
		$next_nik = (int) $data_max['bigger']+1;
		$next_nik = sprintf("%03s", $next_nik);
		echo $next_nik;
	}

	function data()
	{
		$where_like = array();
		if ($this->input->post('search_key')) {
			$i=0;
			foreach ($this->input->post('search_key') as $row) {
				$where_like[$row] = $this->input->post('search_value')[$i];
				$i++;
			}
			// echo json_encode($where_like);
			// exit;
		}
		$user = $this->karyawan->data($where_like);
		// pre($this->db->last_query());
		// pre($user);

		$arr = array();
		$arr['data'] = array();
		if(!empty($user)):
			$urut = 0;
			foreach($user as $row):
				$urut++;
				// pre($row);
				$nama = $row['name'];
				$nik = $row['nik'];
				$departemen = $row['departemen_name'];
				$jabatan = $row['jabatan_name'];

				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$arr['data'][] = array(
						$this->input->post('search_key') ? $urut : 'x',
						$row['nik_order'],
						$nama,
						$nik,
						$departemen,
						$jabatan,
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		echo json_encode($arr);
	}


	function ext($mode='pendidikan', $person_id)
	{
		$data = array();
		$data['ext'] = $this->karyawan->get_ext($mode, $person_id);
		$data['person_id'] = $person_id;

		//get from data master
		$data['agama'] = $this->master->master_by_category('agama');
		$data['pendidikan'] = $this->master->master_by_category('pendidikan');
		$data['golongan_darah'] = $this->master->master_by_category('golongan_darah');
		$data['departemen'] = $this->master->master_by_category('departement');
		$data['jabatan'] = $this->master->master_by_category('jabatan');
		$data['status_pernikahan'] = $this->master->master_by_category('status_pernikahan');
		$data['jenis_kelamin'] = $this->master->master_by_category('jenis_kelamin');
		//end get from data master
		
		switch ($mode) {
			case 'detail':
				$data['detail'] = $this->karyawan->detail($person_id);
				$data['detail']['action'] = base_url().'karyawan/update/'.$data['detail']['id'];
				echo $this->parser->parse('karyawan/detail_karyawan/index', $data, TRUE);
				break;

			case 'dokumen':
				echo $this->load->view('karyawan/dokumen/index', $data, TRUE);
			break;

			case 'pengalaman_kerja':
				echo $this->load->view('karyawan/pengalaman_kerja/index', $data, TRUE);
			break;

			default:
				echo $this->load->view('karyawan/riwayat_pendidikan/index', $data, TRUE);
			break;
		}
	}

	function input_ext($type, $person_id)
	{
		if(!$this->form_validation->run( 'input_karyawan_ext' )):
			$arr = array();
			// pre($type);
			switch ($type) {
				case 'pengalaman_kerja':
					$folder_vieww = 'pengalaman_kerja';
					$modal_title = 'Tambah Pengalaman Kerja';
				break;

				case 'dokumen':
					$folder_vieww = 'dokumen';
					$modal_title = 'Tambah Dokumen';
				break;

				default:
					$folder_vieww = 'riwayat_pendidikan';
					$modal_title = 'Tambah Riwayat Pendidikan';
				break;
			}
			// pre($folder_vieww);

			$data['detail'] = array();
			$arr['person_id'] = $person_id;
			$arr['type'] = $type;
			$arr['modal_title'] = $modal_title;
			$arr['action'] = base_url().'karyawan/input_ext/'.$type.'/'.$person_id;
			$arr['form'] = $this->load->view('karyawan/'.$folder_vieww.'/insert', $data, TRUE);
			echo json_encode($arr);
		else:
			$arr = array();
			$data = array(
					'person_id'		=> $this->input->post('person_id'),
					'nama'			=> ($this->input->post('nama')) ? $this->input->post('nama') : '',
					'kota'			=> ($this->input->post('kota')) ? $this->input->post('kota') : '',
					'gelar'			=> ($this->input->post('gelar')) ? $this->input->post('gelar') : '',
					'mulai'			=> ($this->input->post('mulai')) ? $this->input->post('mulai') : '',
					'selesai'		=> ($this->input->post('selesai')) ? $this->input->post('selesai') : '',
					'jabatan'		=> ($this->input->post('jabatan')) ? $this->input->post('jabatan') : '',
					'jobdesc'		=> ($this->input->post('jobdesc')) ? $this->input->post('jobdesc') : '',
					'gaji'			=> ($this->input->post('gaji')) ? $this->input->post('gaji') : '',
					'dokumen_name'	=> ($this->input->post('dokumen_name')) ? $this->input->post('dokumen_name') : '',
					'type'			=> $this->input->post('type'),
				);

			if($this->input->post('namafile') && $this->input->post('namafile') !=''):
				$data['file_name'] = $this->input->post('namafile');
			else:
				$data['file_name'] = '';
			endif;

			$insert_result = $this->db->insert('people_ext', $data);
			if($insert_result):
				$arr['status'] = 'success';
				$arr['msg'] = 'Data berhasil disimpan';
			else:
				$arr['status'] = 'failed';
				$arr['msg'] = 'Data gagal disimpan';
			endif;
			$arr['type'] = $type;
			$arr['kode_karyawan'] = $person_id;
			// $arr['post'] = $_POST;
			// $arr['data'] = $data;
			echo json_encode($arr);
		endif;
	}

	function update_ext($id)
	{
		// ajax_only();
		$detail = $this->karyawan->detail_ext($id);
		if(!$this->form_validation->run( 'update_karyawan_ext' )):
			$arr = array();
			$arr['action'] = base_url().'karyawan/update_ext/'.$detail['id'];
			switch ($detail['type']) {
				case 'pengalaman_kerja':
					$modal_title = 'Update Pengalaman Kerja';
					$folder_vieww = 'pengalaman_kerja';
				break;

				case 'dokumen':
					$modal_title = 'Update Dokumen';
					$folder_vieww = 'dokumen';
				break;

				default:
					$modal_title = 'Update Pendidikan';
					$folder_vieww = 'riwayat_pendidikan';
				break;
			}
			$arr['modal_title'] = $modal_title;
			$data['detail'] = $detail;
			$arr['forms'] = $this->load->view('karyawan/'.$folder_vieww.'/update', $data, TRUE);

			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			switch ($detail['type']) {
				case 'pengalaman_kerja':
					$data = array(
							'nama'			=> $this->input->post('nama'),
							'kota'			=> $this->input->post('kota'),
							'mulai'			=> $this->input->post('mulai'),
							'selesai'		=> $this->input->post('selesai'),
							'jabatan'		=> $this->input->post('jabatan'),
							'jobdesc'		=> $this->input->post('jobdesc'),
							'gaji'			=> $this->input->post('gaji')
						);
				break;

				case 'dokumen':
				$data = array(
						'nama'				=> 'doc',
						'dokumen_name'		=> $this->input->post('dokumen_name'),
					);
				break;

				default:
					$data = array(
							'nama'		=> $this->input->post('nama'),
							'kota'		=> $this->input->post('kota'),
							'mulai'		=> $this->input->post('mulai'),
							'selesai'	=> $this->input->post('selesai'),
							'gelar'		=> $this->input->post('gelar'),
						);
				break;
			}

			$this->db->where('id', $this->input->post('id'));
			$update_status = $this->db->update('people_ext', $data);

			if($update_status):
				$arr['status'] = 'success';
				$arr['msg'] = 'Data behasil disimpan';
			else:
				$arr['status'] = 'failed';
				$arr['msg'] = 'Data gagal disimpan';
			endif;

			$arr['ext_type'] = $detail['type'];
			$arr['id'] = $detail['id'];
			$arr['kode_karyawan'] = $detail['person_id'];
			// $arr['post'] = $_POST;
			$arr['dblast'] = $this->db->last_query();
			// $arr['data'] = $data;
			echo json_encode($arr);
		endif;
	}

	function delete_ext()
	{
		$arr = array();
		$id = $this->input->post('id');
		$detail = $this->karyawan->detail_ext($id);
		// $arr['post'] = $_POST;
		$arr['detail'] = $detail;
		$this->db->where('id', $detail['id']);
		$this->db->delete('people_ext');
		echo json_encode($arr);
	}

	function widget_statistik_karyawan($code='karyawan_all')
	{
		switch ($code) {
			case 'karyawan_reg1':
				$regional = '01';
				break;
			case 'karyawan_reg2':
				$regional = '02';
				break;
			case 'karyawan_reg3':
				$regional = '03';
				break;
			
			default:
				$regional = '';
				break;
		}

		$this->db->select('{PRE}people.*, COUNT(*) AS jumlah, IF({PRE}master.name IS NULL, UPPER({PRE}people.jabatan), {PRE}master.name) AS nama_jabatan')
			->join('master','master.code = people.jabatan','left')
			->where('people.status_karyawan','aktif');
		if ($regional!='') {
			$this->db->where('people.regional', $regional);
		}
		$this->db->group_by('people.jabatan');
		$query = $this->db->get('people')->result_array();

		$arr_label = array();
		$arr_data = array();
		$total = 0;
		foreach ($query as $row) {
			$arr_label[] = $row['nama_jabatan'];
			$arr_data[] = $row['jumlah'];
			$total = $total+$row['jumlah'];
		}

		$data = array(
			'id'	=> 'widget_statistik_karyawan_'.$code,
			'label'	=> $arr_label,
			'datasets'	=> array(
				array(
					'label'	=> 'Jumlah Karyawan',
					'data'	=> $arr_data,
					'color'	=> rgb_color_code('blue'),
				),
			),
			'total'	=> $total,
		);

		echo $this->load->view('karyawan/chart_karyawan', $data, TRUE);
	}

	function widget_ulang_tahun($code='karyawan_reg1')
	{
		// $month = date('m');
		// echo $month;
		switch ($code) {
			case 'ultah_reg1':
				$regional = '01';
				break;
			case 'ultah_reg2':
				$regional = '02';
				break;
			case 'ultah_reg3':
				$regional = '03';
				break;
			
			default:
				$regional = '';
				break;
		}

		$data['ultah'] = $this->karyawan->get_ulang_tahun($regional);
		// echo 'Hallo Reg'.$regional;
		$this->load->view('karyawan/widget_ultah', $data, FALSE);
		// print_r($_SESSION);

	}

	function test()
	{
		$tabs = array();
		$tabs = array(
		    array(
		        'label'         => 'Regional 1',
		        'id'            => 'ultah_reg1',
		        'content'       => '',
		    ),
		    array(
		        'label'         => 'Regional 2',
		        'id'            => 'ultah_reg2',
		        'content'       => '',
		    ),
		    array(
		        'label'         => 'Regional 3',
		        'id'            => 'ultah_reg3',
		        'content'       => '',
		    ),
		);
		// echo serialthis($tabs);

		$serialthis = 'YTozOntpOjA7YTozOntzOjU6ImxhYmVsIjtzOjEwOiJSZWdpb25hbCAxIjtzOjI6ImlkIjtzOjEwOiJ1bHRhaF9yZWcxIjtzOjc6ImNvbnRlbnQiO3M6MDoiIjt9aToxO2E6Mzp7czo1OiJsYWJlbCI7czoxMDoiUmVnaW9uYWwgMiI7czoyOiJpZCI7czoxMDoidWx0YWhfcmVnMiI7czo3OiJjb250ZW50IjtzOjA6IiI7fWk6MjthOjM6e3M6NToibGFiZWwiO3M6MTA6IlJlZ2lvbmFsIDMiO3M6MjoiaWQiO3M6MTA6InVsdGFoX3JlZzMiO3M6NzoiY29udGVudCI7czowOiIiO319';

		$data = $this->db->list_fields('people');

		echo '<pre>';
		// print_r(unserialthis($serialthis));
		print_r($data);
		echo '</pre>';
	}
}
