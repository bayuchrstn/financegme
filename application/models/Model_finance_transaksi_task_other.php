<?php
class Model_finance_transaksi_task_other extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$page = ($this->input->post('page')) ? $this->input->post('page') : 1;
		$rp = ($this->input->post('rp')) ? $this->input->post('rp') : 10;
		$sortname = ($this->input->post('sortname')) ? $this->input->post('sortname') : 'a.id';
		$sortorder = ($this->input->post('sortorder')) ? $this->input->post('sortorder') : 'asc';
		
		header("Content-type: application/json");
		$jsonData = array('page'=>$page,'total'=>0,'rows'=>array());
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya", false);
		$this->db->where("(a.deskripsi like '%".$this->input->post('searchKeyword')."%')", NULL, FALSE);
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		//$this->db->where('a.regional',$this->session->userdata('scope_regional'));
		$this->db->order_by($sortname, $sortorder);
		$q = $this->db->get('finance_transaksi_task_other a', $rp, (($page-1)*$rp));
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$no = (($page-1)*$rp);
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$opsi = '<a href="#" onclick="update_data(\''.$r['id'].'\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> <a href="#" onclick="delete_data(\''.$r['id'].'\', \''.$r['dropbox_path'].'\')"><i class="icon-trash text-danger"></i></a>';
				if($r['kasir'] != '0'){
					$opsi = '<em>Close</em>';
				}
				$entry  = array('id' =>$r['id'],
								'cell'=>array(
									'no' => $no,
									'a.tanggal' => $r['tanggalnya'],
									'a.jumlah' => number_format($r['jumlah'],2),
									'a.deskripsi' => $r['deskripsi'],
									'edit' => $opsi,
									)
								);
				$jsonData['rows'][] = $entry;
			}
		}
		$q->free_result();
		$jsonData['total'] = $n;
		echo json_encode($jsonData); 
	}
	 
	function insert(){
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'tanggal' => $this->input->post('tanggal'),
					'jumlah' => $jumlah,
					'deskripsi' => $this->input->post('deskripsi'),
					'karyawan' => $this->input->post('karyawan'),
					'departement' => $this->cek_id_department($this->input->post('departement')),
					'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
					'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
					'dropbox_url' => $this->input->post('dropbox_url'),
					'dropbox_path' => $this->input->post('dropbox_path'),
				);
		$result=$this->db->insert('finance_transaksi_task_other', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	 
	function select(){
		//$this->db->select("a.*, b.code", false);
		//$this->db->where("a.id", $this->input->post('id'));
		//$this->db->join('gmd_master b','b.id = a.departement','left');
		$q = $this->db->query("select a.*, b.code from gmd_finance_transaksi_task_other a 
		left join gmd_master b on a.departement = b.id 
		where a.id = '".$this->input->post('id')."'");
		return $q->result();
	}
	 
	function update(){
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'tanggal' => $this->input->post('tanggal'),
					'jumlah' => $jumlah,
					'deskripsi' => $this->input->post('deskripsi'),
					'karyawan' => $this->input->post('karyawan'),
					'departement' => $this->cek_id_department($this->input->post('departement')),
					'dropbox_url' => $this->input->post('dropbox_url'),
					'dropbox_path' => $this->input->post('dropbox_path'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_transaksi_task_other', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	 
	function save_dropbox(){
		$data = array( 
					'dropbox_url' => $this->input->post('dropbox_url'),
					'dropbox_path' => $this->input->post('dropbox_path'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_transaksi_task_other', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	
	function delete($id)
	{
		$token = 'fp63YFaxx9AAAAAAAAAAB8bjagdLG_V4g55T1uGDqO1QevtsP4LaAtVdprXc7KLz';
		$dropbox_path = '';
		
		$q = $this->db->query("select dropbox_path from gmd_finance_transaksi_task_other 
		where id = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$dropbox_path = $r['dropbox_path'];
			}
		}
		/*Delete file*/
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.dropboxapi.com/2/files/delete_v2",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\"path\": \"".$dropbox_path."\"}",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$token,
			"content-type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);

		if ($err) {
			$msg = 'Hapus data attachment gagal';
		} else {
			$this->db->where('id', $id);
			$result=$this->db->delete('finance_transaksi_task_other');
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}
		return $msg;
	}
	
	function bank(){
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('bank');
		return $q;
	}
	
	function departement(){
		$this->db->where('category', 'departement');
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('master');
		return $q;
	}
	
	function cek_id_regional($id){
		$data = 0;
		
		$q = $this->db->query("select id from gmd_regional where code = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	
	function cek_id_department($id){
		$data = 0;
		
		$q = $this->db->query("select id from gmd_master where code = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	
	function get_karyawan($id){
		$data = '<option value=""></option>';
		
		$q = $this->db->query("select id, name from gmd_people where departemen = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<option value="'.$r['id'].'">'.$r['name'].'</option>';
			}
		}
		$q->free_result();
		
		return $data;
	}
	
}
