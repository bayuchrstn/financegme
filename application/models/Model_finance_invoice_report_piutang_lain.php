<?php
class Model_finance_invoice_report_piutang_lain extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		set_time_limit(0);
		$tanggal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		if($this->input->post('searchTanggal') == '1'){
			$tanggal_akhir = $this->input->post('searchDateFinish');
		}elseif($this->input->post('searchTanggal') == '3'){
			$tanggal_akhir = $this->input->post('searchDateFinish2');
		}
		$this->db->select("a.*, 
		date_format(a.date_invoice, '%d-%m-%Y') as date_invoicenya, 
		date_format(a.date_due, '%d-%m-%Y') as date_duenya, b.customer_id, 
		(a.pph2223) as jumlah_pph2223, 
		COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."' AND guna = '1'),0) AS bayar_pph2223,
		(a.pph2223 - COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."' AND guna = '1'),0)) AS piutang_pph2223,
		(a.bupot_ppn) as jumlah_bupot_ppn,
		COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."' AND guna = '2'),0) AS bayar_bupot_ppn,
		(a.bupot_ppn - COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."' AND guna = '2'),0)) AS piutang_bupot_ppn,
		if(b.invoice_name = '', b.nama, b.invoice_name) as nama, b.alamat, b.telp, d.name as nama_kategori, concat(f.name,' - ',e.name) as nama_produk, DATEDIFF('".$tanggal."', a.date_due) as aging", false);
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		//$this->db->where('a.pph2223 != ', '0');
		$this->db->where("(a.pph2223 != '0' OR a.bupot_ppn != '0')", NULL, FALSE);
		
		if($this->input->post('searchkategori') != ''){
			$this->db->where('b.kategori', $this->input->post('searchkategori'));
		}
		if($this->input->post('searchmsa') != ''){
			$this->db->where('b.msa', $this->input->post('searchmsa'));
		}
		if($this->input->post('searchppn') != ''){
			$this->db->where('b.ppn', $this->input->post('searchppn'));
		}
		if($this->input->post('searchmaxi') != ''){
			$this->db->where('b.status_maxi', $this->input->post('searchmaxi'));
		}
		if($this->input->post('searchcabang') != ''){
			$this->db->where('b.status_cabang', $this->input->post('searchcabang'));
		}
			
		//$this->db->where("a.date_invoice >= '2018-07-01'", NULL, FALSE);
		if($this->input->post('searchTanggal') == '1'){
			$this->db->where("(a.date_invoice between '".$this->input->post('searchDateFirst')."' and '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
			//$this->db->where("(a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		}elseif($this->input->post('searchTanggal') == '2'){
			//$this->db->where("(a.date_paid = '' OR a.date_paid IS NULL)", NULL, FALSE);
		}elseif($this->input->post('searchTanggal') == '3'){
			$this->db->where("a.date_invoice <= '".$this->input->post('searchDateFinish2')."'", NULL, FALSE);
			//$this->db->where("(a.date_paid = '' OR a.date_paid IS NULL OR a.date_paid > '".$this->input->post('searchDateFinish2')."')", NULL, FALSE);
		}
		//$this->db->where('a.lunas', '0');
		$this->db->from('finance_invoice_customer AS a');
		$this->db->join('finance_customer_service b', 'a.service_id = b.service_id', 'left');
		//$this->db->join('finance_customer c', 'b.customer_id = c.customer_id', 'left');
		$this->db->join('master d', "b.kategori = d.id AND d.category = 'customer_type'", 'left');
		$this->db->join('product e', 'b.produk = e.id', 'left');
		$this->db->join('product_category f', 'e.category = f.code', 'left');
		$this->db->group_by('a.id');
		$this->db->having('piutang_pph2223 != 0 OR piutang_bupot_ppn != 0 ');
		$this->db->order_by('b.customer_id', 'asc');
		$this->db->order_by('b.service_id', 'asc');
		$this->db->order_by('a.date_invoice', 'asc');
		$this->db->order_by('a.no_invoice', 'asc');
		$q = $this->db->get();
		return $q; 
	}
	 
	function get_data_table1()
	{
		$tanggal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		if($this->input->post('searchTanggal') == '1'){
			//$tanggal_akhir = $this->input->post('searchDateFinish');
		}elseif($this->input->post('searchTanggal') == '3'){
			$tanggal_akhir = $this->input->post('searchDateFinish2');
		}
		
		$this->db->select("a.*, 
		date_format(a.date_invoice, '%d-%m-%Y') as date_invoicenya, 
		date_format(a.date_due, '%d-%m-%Y') as date_duenya, b.customer_id, 
		(a.jumlah - COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."'),0)) as piutang,
		COALESCE((select sum(jumlah) from gmd_finance_invoice_billing where no_invoice = a.id AND tanggal <= '".$tanggal_akhir."'),0) AS bayar,
		if(b.invoice_name = '', b.nama, b.invoice_name) as nama, b.alamat, b.telp, d.name as nama_kategori, concat(f.name,' - ',e.name) as nama_produk, DATEDIFF('".$tanggal."', a.date_due) as aging", false);
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		if($this->input->post('searchkategori') != '0'){
			$this->db->where('b.kategori', $this->input->post('searchkategori'));
		}
		/*
		if($this->input->post('searchkat_inv') == '1'){
			$this->db->where('b.ppn', '1');
		}elseif($this->input->post('searchkat_inv') == '2'){
			$this->db->where('b.ppn', '0');
		}elseif($this->input->post('searchkat_inv') == '3'){
			$this->db->where('b.status_maxi', '1');
		}elseif($this->input->post('searchkat_inv') == '4'){
			$this->db->where('b.status_cabang', '1');
		}
		*/
			if(isset($_POST['searchkat_inv'])){
				$payment_to = '';
				foreach($_POST['searchkat_inv'] as $k => $v){
					$visi = "";
					if($v == '1'){
						$visi = "b.ppn = '1'";
					}elseif($v == '2'){
						$visi = "b.ppn = '0'";
					}elseif($v == '3'){
						$visi = "b.status_maxi = '1'";
					}elseif($v == '4'){
						$visi = "b.status_cabang = '1'";
					}
					$payment_to .= ($k == 0)?$visi:' OR '.$visi;
				}
				if($payment_to != ''){
					$this->db->where("(".$payment_to.")", NULL, FALSE);
				}
			}
			
		if($this->input->post('searchTanggal') == '1'){
			$this->db->where("(a.date_invoice between '".$this->input->post('searchDateFirst')."' and '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		}elseif($this->input->post('searchTanggal') == '3'){
			$this->db->where("a.date_invoice <= '".$this->input->post('searchDateFinish2')."'", NULL, FALSE);
		}
		//$this->db->where('a.lunas', '0');
		$this->db->from('finance_invoice_customer AS a');
		$this->db->join('finance_customer_service b', 'a.service_id = b.service_id', 'left');
		//$this->db->join('finance_customer c', 'b.customer_id = c.customer_id', 'left');
		$this->db->join('master d', "b.kategori = d.id AND d.category = 'customer_type'", 'left');
		$this->db->join('product e', 'b.produk = e.id', 'left');
		$this->db->join('product_category f', 'e.category = f.code', 'left');
		$this->db->group_by('a.id');
		$this->db->having('piutang != 0');
		$this->db->order_by('b.customer_id', 'asc');
		$this->db->order_by('b.service_id', 'asc');
		$this->db->order_by('a.date_invoice', 'asc');
		$this->db->order_by('a.no_invoice', 'asc');
		$q = $this->db->get();
		return $q; 
	}
	 
	function insert(){
		$customer_id = strtoupper($this->input->post('customer_id'));
		$service_id = strtoupper($this->input->post('service_id'));
		$q = $this->db->query("select customer_id from gmd_marketing_customer where customer_id = '".$customer_id."'");
		if($q->num_rows() > 0){
			$data = array( 
						'nama' => strtoupper($this->input->post('customer_group_name')),
					);
			$this->db->where('customer_id', $customer_id);
			$this->db->update('marketing_customer', $data);	
		}else{
			$data = array( 
						'customer_id' => $customer_id,
						'nama' => strtoupper($this->input->post('customer_group_name')),
					);
			$this->db->insert('marketing_customer', $data);	
		}
		
		$q = $this->db->query("select service_id from gmd_marketing_customer_service where service_id = '".$service_id."'");
		if($q->num_rows() > 0){
			$data = array( 
						'customer_id' => $customer_id,
						'kategori' => strtoupper($this->input->post('kategori')),
						'produk' => strtoupper($this->input->post('produk')),
						'nama' => strtoupper($this->input->post('nama')),
						'alamat' => strtoupper($this->input->post('alamat')),
						'telp' => strtoupper($this->input->post('telp')),
					);
			$this->db->where('service_id', $service_id);
			$this->db->update('marketing_customer_service', $data);	
		}else{
			$data = array( 
						'customer_id' => $customer_id,
						'service_id' => $service_id,
						'kategori' => strtoupper($this->input->post('kategori')),
						'produk' => strtoupper($this->input->post('produk')),
						'nama' => strtoupper($this->input->post('nama')),
						'alamat' => strtoupper($this->input->post('alamat')),
						'telp' => strtoupper($this->input->post('telp')),
					);
			$this->db->insert('marketing_customer_service', $data);	
		}
		
		
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'no_invoice' => strtoupper($this->input->post('no_invoice')),
					'date_invoice' => $this->input->post('date_invoice'),
					'date_due' => $this->input->post('date_due'),
					'service_id' => $service_id,
					'jumlah' => $jumlah,
					//'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
				);
		$result=$this->db->insert('finance_invoice_customer', $data);	
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
		$this->db->select('a.*, FORMAT(a.jumlah, 0) as jumlah, 
		b.customer_id, b.nama, b.alamat, b.telp, b.kategori, b.produk, c.nama as customer_group_name',false);
		$this->db->from('finance_invoice_customer a');
		$this->db->join('marketing_customer_service as b', 'a.service_id = b.service_id', 'left');
		$this->db->join('marketing_customer as c', 'b.customer_id = c.customer_id', 'left');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$customer_id = strtoupper($this->input->post('customer_id'));
		$service_id = strtoupper($this->input->post('service_id'));
		$q = $this->db->query("select customer_id from gmd_marketing_customer where customer_id = '".$customer_id."'");
		if($q->num_rows() > 0){
			$data = array( 
						'nama' => strtoupper($this->input->post('customer_group_name')),
					);
			$this->db->where('customer_id', $customer_id);
			$this->db->update('marketing_customer', $data);	
		}else{
			$data = array( 
						'customer_id' => $customer_id,
						'nama' => strtoupper($this->input->post('customer_group_name')),
					);
			$this->db->insert('marketing_customer', $data);	
		}
		
		$q = $this->db->query("select service_id from gmd_marketing_customer_service where service_id = '".$service_id."'");
		if($q->num_rows() > 0){
			$data = array( 
						'customer_id' => $customer_id,
						'kategori' => strtoupper($this->input->post('kategori')),
						'produk' => strtoupper($this->input->post('produk')),
						'nama' => strtoupper($this->input->post('nama')),
						'alamat' => strtoupper($this->input->post('alamat')),
						'telp' => strtoupper($this->input->post('telp')),
					);
			$this->db->where('service_id', $service_id);
			$this->db->update('marketing_customer_service', $data);	
		}else{
			$data = array( 
						'customer_id' => $customer_id,
						'service_id' => $service_id,
						'kategori' => strtoupper($this->input->post('kategori')),
						'produk' => strtoupper($this->input->post('produk')),
						'nama' => strtoupper($this->input->post('nama')),
						'alamat' => strtoupper($this->input->post('alamat')),
						'telp' => strtoupper($this->input->post('telp')),
					);
			$this->db->insert('marketing_customer_service', $data);	
		}
		
		
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'no_invoice' => strtoupper($this->input->post('no_invoice')),
					'date_invoice' => $this->input->post('date_invoice'),
					'date_due' => $this->input->post('date_due'),
					'service_id' => $service_id,
					'jumlah' => $jumlah,
					//'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_invoice_customer', $data);	
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
		$this->db->where('id', $id);
		$result=$this->db->delete('finance_invoice_customer');
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
	
	function cek_bayar($id){
		$data = 0;
				
		$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_transaksi_kasir 
		where id_ref = '".$id."' and transaksi = '1'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data += $r['jml'];
			}
		}
				
		return $data;
	}
	
	function produk(){
		$q = $this->db->query("select a.*, b.name as nama_category from gmd_product a
		left join gmd_product_category b on a.category = b.code
		order by b.name asc, a.name asc");
		return $q;
	}
	
	function kategori(){
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}
	 
	function select_autocomplite_service(){
		$this->db->select("a.*, b.nama as customer_group_name, c.id as id_produk, c.name, d.name, e.id as id_kategori, e.name", false);
		$this->db->from("marketing_customer_service a");
		$this->db->join('marketing_customer b', 'a.customer_id = b.customer_id', 'left');
		$this->db->join('product c', 'a.produk = c.id', 'left');
		$this->db->join('product_category d', 'c.category = d.code', 'left');
		$this->db->join('master e', "a.kategori = e.id AND e.category = 'customer_type'", 'left');
		$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
		OR a.nama like '%".$this->input->post('term')."%'
		OR a.alamat like '%".$this->input->post('term')."%'
		OR a.telp like '%".$this->input->post('term')."%'
		OR b.customer_id like '%".$this->input->post('term')."%'
		or b.nama like '%".$this->input->post('term')."%'
		or c.name like '%".$this->input->post('term')."%'
		or d.name like '%".$this->input->post('term')."%'
		or e.name like '%".$this->input->post('term')."%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}
	 
	function select_autocomplite_customer(){
		$this->db->select("a.*", false);
		$this->db->from("marketing_customer a");
		$this->db->where("(a.customer_id like '%".$this->input->post('term')."%'
		or a.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}
	 
}
