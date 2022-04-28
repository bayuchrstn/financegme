<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schedule_cek_db extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('my_func_helper');
		$this->load->model('model_global', 'm_global');
	}

	public function index()
	{}
	

	public function cek_gl()
	{
		$msg = '';
		$detial_debet = 0.00;
		$detial_kredit = 0.00;
		$detial_jumlah = 0.00;
		$monthly_debet = 0.00;
		$monthly_kredit = 0.00;
		$monthly_jumlah = 0.00;
		$daily_debet = 0.00;
		$daily_kredit = 0.00;
		$daily_jumlah = 0.00;
        $q = $this->db->query("SELECT
		  'detial' AS title, SUM(debet) AS debet, SUM(kredit) AS kredit, (SUM(debet) - SUM(kredit)) AS jumlah
		FROM
		  gmd_finance_coa_general_ledger_detail
		UNION
		ALL
		SELECT
		  'monthly' AS title, SUM(debet) AS debet, SUM(kredit) AS kredit, (SUM(debet) - SUM(kredit)) AS jumlah
		FROM
		  gmd_finance_coa_general_ledger_monthly
		UNION
		ALL
		SELECT
		  'daily' AS title, SUM(debet) AS debet, SUM(kredit) AS kredit, (SUM(debet) - SUM(kredit)) AS jumlah
		FROM
		  gmd_finance_coa_general_ledger_daily");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				if($r['title'] == 'detial'){
					$detial_debet = $r['debet'];
					$detial_kredit = $r['kredit'];
					$detial_jumlah = $r['jumlah'];
				}elseif($r['title'] == 'monthly'){
					$monthly_debet = $r['debet'];
					$monthly_kredit = $r['kredit'];
					$monthly_jumlah = $r['jumlah'];
				}elseif($r['title'] == 'daily'){
					$daily_debet = $r['debet'];
					$daily_kredit = $r['kredit'];
					$daily_jumlah = $r['jumlah'];
				}
				
			}
		}
		$q->free_result();
		
		if($detial_jumlah != '0.00'){
			$msg .= 'Detail jumlah : tidak balance<br>';
		}
		if($monthly_jumlah != '0.00'){
			$msg .= 'Monthly jumlah : tidak balance<br>';
		}
		if($daily_jumlah != '0.00'){
			$msg .= 'Daily jumlah : tidak balance<br>';
		}
		if($detial_debet != $monthly_debet){
			$msg .= 'Monthly debet : tidak sama<br>';
		}
		if($detial_debet != $daily_debet){
			$msg .= 'Daily debet : tidak sama<br>';
		}
		if($detial_kredit != $monthly_kredit){
			$msg .= 'Monthly kredit : tidak sama<br>';
		}
		if($detial_kredit != $daily_kredit){
			$msg .= 'Daily kredit : tidak sama<br>';
		}
		
		if($msg != ''){
			$from_email = $this->m_global->erp_email_info();
			$to      = 'edi.santoso@gmedia.co.id';
			$subject = 'ERP#SCHEDULE CEK#GL';
			$message = '<div style="color:#000000; font-family:Trebuchet MS;">
						'.base_url().'<br>
						'.$msg.'
						</div>';
			$headers = "Content-Type: text/html; charset=iso-8859-1\r\n";
			$headers .= 'From: <'.$from_email.'>' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					
			mail($to, $subject, $message, $headers);
		}
	}

	
}
