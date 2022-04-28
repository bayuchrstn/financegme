<?php
class Model_teknis_bod_cek_on_off extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
		$this->load->library('email');
    }
	
	function tes_send_mail(){
		$ci = get_instance();
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://erp.gmedia.id";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "info@erp.gmedia.id";
		$config['smtp_pass'] = "pL,okm,./";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$config['starttls'] = true;
		$config['useragent'] = 'Gmedia Tech';
		$ci->email->initialize($config);
		$ci->email->from('info@erp.gmedia.id', 'Gmedia');
		$list = array('edi.santoso@gmedia.co.id');
		$ci->email->to($list);
		$ci->email->subject('judul email 2');
		$ci->email->message('isi email');
		if ($this->email->send()) {
			echo 'Email sent.';
		} else {
			show_error($this->email->print_debugger());
		}
	}
	
	function cek_email_on()
	{
		$tanggal = date('Y-m-d H:i:s');
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.subject, b.body, b.area, c.customer_name, c.customer_id, c.service_id,
		date_format(b.date_created, '%d/%m/%Y %H:%i') as date_creatednya, 
		date_format(b.date_start, '%d %M %Y %H:%i:%s') as date_startnya, 
		date_format(b.date_due, '%d %M %Y %H:%i:%s') as date_duenya,
		TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration,
		d.name as nama_admin", false);
        $this->db->from('task_bod a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('users d','b.author = d.id','left');
		$this->db->where("b.date_start <= DATE_ADD('".$tanggal."', INTERVAL 30 MINUTE)",NULL, FALSE);
		//$this->db->where("b.date_start >= '".$tanggal."'",NULL, FALSE);
		$this->db->where("a.email_on", '0');
        $q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				
				$from_email = $this->m_global->erp_email_info();
				$divisi_email = $this->m_global->erp_email_divisi('support', $r['area']);
				$to      = $divisi_email;
				
				
				$ci = get_instance();
				$config['protocol'] = "smtp";
				$config['smtp_host'] = "ssl://erp.gmedia.id";
				$config['smtp_port'] = "465";
				$config['smtp_user'] = "info@erp.gmedia.id";
				$config['smtp_pass'] = "pL,okm,./";
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";
				$config['starttls'] = true;
				$config['useragent'] = 'Gmedia Tech';
				
				$ci->email->initialize($config);
				$ci->email->from($from_email, 'Gmedia');
				$list = array($divisi_email);
				$ci->email->to($list);
				$ci->email->cc('appsjogja@gmedia.co.id');
				$ci->email->bcc('edi.santoso@gmedia.co.id');
				$ci->email->subject('ERP#Reminder.BOD#Aktivasi#'.$r['customer_name'].'');
				$ci->email->message('<div style="color:#000000; font-family:Trebuchet MS;">
							<h4>Reminder Aktivasi BOD</h4>
							<table border="0">
							<tr><td>Nama pelanggan</td><td>: '.$r['customer_name'].'</td></tr>
							<tr><td>Customer ID / Service ID</td><td>: '.$r['customer_id'].' / '.$r['service_id'].'</td></tr>
							<tr><td>Mulai</td><td>: '.$r['date_startnya'].'</td></tr>
							<tr><td>Selesai</td><td>: '.$r['date_duenya'].'</td></tr>
							<tr><td>Keterangan</td><td>: '.$r['body'].'</td></tr>
							<tr><td>Eksekutor</td><td>: '.$r['nama_admin'].'</td></tr>
							</table>
							</div>');
				
				if ($this->email->send()) {
					$data = array( 
								'email_on' => 1,
							);
					$this->db->where('id', $r['id']);
					$this->db->update('task_bod', $data);
				}
			}
		}
		$q->free_result();
	}

	function cek_email_off()
	{
		$tanggal = date('Y-m-d H:i:s');
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.subject, b.body, b.area, c.customer_name, c.customer_id, c.service_id,
		date_format(b.date_created, '%d/%m/%Y %H:%i') as date_creatednya, 
		date_format(b.date_start, '%d %M %Y %H:%i:%s') as date_startnya, 
		date_format(b.date_due, '%d %M %Y %H:%i:%s') as date_duenya,
		TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration,
		d.name as nama_admin", false);
        $this->db->from('task_bod a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->join('users d','b.author = d.id','left');
		$this->db->where("b.date_due <= '".$tanggal."'",NULL, FALSE);
		//$this->db->where("b.date_due >= '".$tanggal."'",NULL, FALSE);
		$this->db->where("a.email_off", '0');
        $q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				
				$from_email = $this->m_global->erp_email_info();
				$divisi_email = $this->m_global->erp_email_divisi('support', $r['area']);
				$to      = $divisi_email;
				
				
				$ci = get_instance();
				$config['protocol'] = "smtp";
				$config['smtp_host'] = "ssl://erp.gmedia.id";
				$config['smtp_port'] = "465";
				$config['smtp_user'] = "info@erp.gmedia.id";
				$config['smtp_pass'] = "pL,okm,./";
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";
				$config['starttls'] = true;
				$config['useragent'] = 'Gmedia Tech';
				
				$ci->email->initialize($config);
				$ci->email->from($from_email, 'Gmedia');
				$list = array($divisi_email);
				$ci->email->to($list);
				$ci->email->cc('appsjogja@gmedia.co.id');
				$ci->email->bcc('edi.santoso@gmedia.co.id');
				$ci->email->subject('ERP#Reminder.BOD#Non aktif#'.$r['customer_name'].'');
				$ci->email->message('<div style="color:#000000; font-family:Trebuchet MS;">
							<h4>Reminder Non Aktif BOD</h4>
							<table border="0">
							<tr><td>Nama pelanggan</td><td>: '.$r['customer_name'].'</td></tr>
							<tr><td>Customer ID / Service ID</td><td>: '.$r['customer_id'].' / '.$r['service_id'].'</td></tr>
							<tr><td>Mulai</td><td>: '.$r['date_startnya'].'</td></tr>
							<tr><td>Selesai</td><td>: '.$r['date_duenya'].'</td></tr>
							<tr><td>Keterangan</td><td>: '.$r['body'].'</td></tr>
							<tr><td>Eksekutor</td><td>: '.$r['nama_admin'].'</td></tr>
							</table><br>
							Harap segera di non aktifkan.
							</div>');
				
				if ($this->email->send()) {
					$data = array( 
								'email_off' => 1,
							);
					$this->db->where('id', $r['id']);
					$this->db->update('task_bod', $data);	
				}
			}
		}
		$q->free_result();
	}
	 
}
