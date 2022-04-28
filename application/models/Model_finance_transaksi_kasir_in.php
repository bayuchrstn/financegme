<?php
class Model_finance_transaksi_kasir_in extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'a.jumlah', 'b.name', 'c.nama', 'a.deskripsi'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.tanggal';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya,b.name as nama_kas,
		if(a.setoran_cat = 0, 'Lain-lain', c.nama) as setoran", false);
        $this->db->from('finance_transaksi_kasir a');
		$this->db->join('finance_bank b','a.kas_bank = b.id','left');
		$this->db->join('finance_master_cat_setoran c','a.setoran_cat = c.id','left');
		$this->db->group_start();
		$this->db->like('a.deskripsi', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where("(a.tanggal between '".$this->input->post('searchDateFirst')."' and '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		$this->db->where('a.tipe','1');
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		if($this->input->post('searchkas_bank') != '0'){
			$this->db->where('a.kas_bank',$this->input->post('searchkas_bank'));
		}
		$this->db->order_by($order_name, $order_dir);
        if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
				if($r['coa_id'] != '0'){
					$opsi = '';
				}
				$row  = array(
								$no.'.',
								$r['tanggalnya'],
								number_format($r['jumlah'],2),
								//$r['id_refnya'],
								//$r['transaksinya'],
								$r['nama_kas'],
								$r['setoran'],
								$r['deskripsi'],
								$opsi,
							);

	 
				$data[] = $row;
			}
		}
		$q->free_result();
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $n,
                        "recordsFiltered" => $n,
                        "data" => $data,
                );
        echo json_encode($output);
	}
	 
	function insert(){
		$this->db->trans_start();
		if($this->model_global->closing_date_kasir($this->input->post('tanggal')) == true){
			$jumlah = str_replace(",", "", $this->input->post('jumlah'));
			$data = array( 
						'tanggal' => $this->input->post('tanggal'),
						'kas_bank' => $this->input->post('kas_bank'),
						'tipe' => '1',
						'jumlah' => $jumlah,
						'deskripsi' => $this->input->post('deskripsi'),
						'setoran_cat' => $this->input->post('setoran_cat'),
						'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
						'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
					);
			$result=$this->db->insert('finance_transaksi_kasir', $data);	
			if($result==true)
			{
				/*
				if($this->input->post('transaksi') == '1'){
					$jml = 0;
					
					$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_transaksi_kasir 
					where id_ref = '".$this->input->post('id_ref')."' 
					and transaksi = '".$this->input->post('transaksi')."'");
					if($q->num_rows() > 0){
						foreach($q->result_array() as $r){
							$jml += $r['jml'];
						}
					}
					
					$data = array( 
								'bayar' => $jml,
							);
					$this->db->where('id', $this->input->post('id_ref'));
					$this->db->update('finance_invoice_customer', $data);	
				}
				*/
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}
	 
	function select(){
		$this->db->select("a.*, round(a.jumlah) as jumlah", false);
		$this->db->from('finance_transaksi_kasir a');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
		if($this->model_global->closing_date_kasir($this->input->post('tanggal')) == true && $this->model_global->closing_date_kasir($this->select_date($this->input->post('id'))) == true){
			$jumlah = str_replace(",", "", $this->input->post('jumlah'));
			$data = array( 
						'tanggal' => $this->input->post('tanggal'),
						'kas_bank' => $this->input->post('kas_bank'),
						'jumlah' => $jumlah,
						'deskripsi' => $this->input->post('deskripsi'),
						'setoran_cat' => $this->input->post('setoran_cat'),
					);
			$this->db->where('id', $this->input->post('id'));
			$result=$this->db->update('finance_transaksi_kasir', $data);	
			if($result==true)
			{
				/*
				//OLD TRANSAKSI
				if($old_transaksi == '1'){
					$jml = 0;
					
					$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_transaksi_kasir 
					where id_ref = '".$old_id_ref."' 
					and transaksi = '".$old_transaksi."'");
					if($q->num_rows() > 0){
						foreach($q->result_array() as $r){
							$jml += $r['jml'];
						}
					}
					
					$data = array( 
								'bayar' => $jml,
							);
					$this->db->where('id', $old_id_ref);
					$this->db->update('finance_invoice_customer', $data);	
				}
				//NEW TRANSAKSI
				if($this->input->post('transaksi') == '1'){
					$jml = 0;
					
					$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_transaksi_kasir 
					where id_ref = '".$this->input->post('id_ref')."' 
					and transaksi = '".$this->input->post('transaksi')."'");
					if($q->num_rows() > 0){
						foreach($q->result_array() as $r){
							$jml += $r['jml'];
						}
					}
					
					$data = array( 
								'bayar' => $jml,
							);
					$this->db->where('id', $this->input->post('id_ref'));
					$this->db->update('finance_invoice_customer', $data);	
				}
				*/
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}
	
	function delete($id)
	{
		$this->db->trans_start();
		if($this->model_global->closing_date_kasir($this->select_date($id)) == true){
			/*
			$old_transaksi = 0;
			$old_id_ref = 0;
			
			$q = $this->db->query("select transaksi, id_ref from gmd_finance_transaksi_kasir where id = '".$id."'");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$old_transaksi = $r['transaksi'];
					$old_id_ref = $r['id_ref'];
				}
			}
			$q->free_result();
			*/
			$this->db->where('id', $id);
			$result=$this->db->delete('finance_transaksi_kasir');
			if($result==true)
			{
				/*
				//OLD TRANSAKSI
				if($old_transaksi == '1'){
					$jml = 0;
					
					$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_transaksi_kasir 
					where id_ref = '".$old_id_ref."' 
					and transaksi = '".$old_transaksi."'");
					if($q->num_rows() > 0){
						foreach($q->result_array() as $r){
							$jml += $r['jml'];
						}
					}
					
					$data = array( 
								'bayar' => $jml,
							);
					$this->db->where('id', $old_id_ref);
					$this->db->update('finance_invoice_customer', $data);	
				}
				*/
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
		}
		$this->db->trans_complete();
		return $msg;
	}
	
	function finance_bank(){
		$this->db->group_start();
		$this->db->where('branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->or_where('lock', 1);
		$this->db->group_end();
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('finance_bank');
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
	 
	function select_autocomplite(){
		if($this->input->post('transaksi') == '1'){
			$this->db->select("a.id, a.no_invoice, concat('<div>No Invoice: <b>',a.no_invoice,'</b>
			, Inv Date: <b>',date_format(a.date_invoice, '%d-%m-%Y'),'</b>
			, Due Date: <b>',date_format(a.date_due, '%d-%m-%Y'),'</b>
			<br> Service ID: <b>',a.service_id,'</b>
			, Cust. ID: <b>',b.customer_id,'</b>
			, Customer: <b>',b.nama,'</b>
			<br> Jumlah Tagihan: <b>',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'</b></div>') as konten", false);
			$this->db->from("finance_invoice_customer a");
			$this->db->join('marketing_customer_service as b', 'a.service_id = b.service_id', 'left');
			$this->db->where("(a.no_invoice like '%".$this->input->post('term')."%'
		or b.nama like '%".$this->input->post('term')."%'
		OR a.no_invoice like '%".$this->input->post('term')."%'
		OR a.service_id like '%".$this->input->post('term')."%'
		OR b.customer_id like '%".$this->input->post('term')."%')", NULL, FALSE);
			$q = $this->db->get();
		}
		return $q->result();
	}
	 
	function select_detail_ref($trx, $id_ref){
		$data = '';
		if($trx == '1'){
			$this->db->select("concat('(NO INVOICE): ',a.no_invoice,', (INV DATE): ',date_format(a.date_invoice, '%d-%m-%Y'),', (DUE DATE): ',date_format(a.date_due, '%d-%m-%Y'),'
(SERVICE ID): ',a.service_id,', (CUST. ID): ',b.customer_id,', (CUSTOMER): ',b.nama,'
(JUMLAH TAGIHAN): ',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'') as konten", false);
			$this->db->from("finance_invoice_customer a");
			$this->db->join('marketing_customer_service as b', 'a.service_id = b.service_id', 'left');
			$this->db->where("a.id", $id_ref);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$data = $r['konten'];
				}
			}
			$q->free_result();
		}
		return $data;
	}
	 
	function select_date($id){
		$this->db->select("a.tanggal", false);
		$this->db->from('finance_transaksi_kasir a');
		$this->db->where("a.id", $id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach ($q->result_array() as $r){
				return $r['tanggal'];
			}
		}
		$q->free_result();
	}
	 
}
