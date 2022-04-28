<?php
class Model_finance_report_piutang_by_service extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$tanggal = date('Y-m-d');
		/*
		$this->db->select("a.*, 
		date_format(a.date_invoice, '%d-%m-%Y') as date_invoicenya, 
		date_format(a.date_due, '%d-%m-%Y') as date_duenya, b.customer_id, 
		sum(a.jumlah) as jumlah, sum(a.bayar) as bayar, (sum(a.jumlah) - sum(a.bayar)) as piutang,
		b.nama, b.alamat, b.telp, d.name as nama_kategori", false);
		//$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		if($this->input->post('searchkategori') != '0'){
			$this->db->where('b.kategori', $this->input->post('searchkategori'));
		}
		if($this->input->post('searchkat_inv') == '1'){
			$this->db->where('b.ppn', '1');
		}elseif($this->input->post('searchkat_inv') == '2'){
			$this->db->where('b.ppn', '0');
		}elseif($this->input->post('searchkat_inv') == '3'){
			$this->db->where('b.status_maxi', '1');
		}elseif($this->input->post('searchkat_inv') == '4'){
			$this->db->where('b.status_cabang', '1');
		}
		$this->db->where('a.lunas', '0');
		$this->db->from('finance_invoice_customer AS a');
		$this->db->join('finance_customer_service b', 'a.service_id = b.service_id', 'left');
		$this->db->join('finance_customer c', 'b.customer_id = c.customer_id', 'left');
		$this->db->join('master d', "b.kategori = d.id AND d.category = 'customer_type'", 'left');
		$this->db->order_by('a.service_id', 'asc');
		$this->db->group_by('a.service_id');
		*/
		$where = "";
		if ($this->input->post('searchkategori') != '0') {
			$where .= " AND b.kategori = '" . $this->input->post('searchkategori') . "'";
		}
		if ($this->input->post('searchkat_inv') == '1') {
			$where .= " AND b.ppn = '1'";
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$where .= " AND b.ppn = '0'";
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$where .= " AND b.status_maxi = '1'";
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$where .= " AND b.status_cabang = '1'";
		}
		$q = $this->db->query("SELECT
		  *,
		  SUM(jumlah) AS jumlah,
		  SUM(bayar) AS bayar,
		  SUM(piutang) AS piutang
		FROM
		  (SELECT
			a.*,
			DATE_FORMAT(a.date_invoice, '%d-%m-%Y') AS date_invoicenya,
			DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
			b.customer_id,
			(a.jumlah - a.bayar) AS piutang,
			b.nama,
			b.alamat,
			b.telp,
			d.name AS nama_kategori
		  FROM
			gmd_finance_invoice_customer a
			LEFT JOIN gmd_finance_customer_service2 b
			  ON a.service_id = b.service_id
			LEFT JOIN gmd_finance_customer2 c
			  ON b.customer_id = c.customer_id
			LEFT JOIN gmd_master d
			  ON b.kategori = d.id
			  AND d.category = 'customer_type'
		  WHERE a.lunas = '0'
		  " . $where . "
		  GROUP BY a.id) AS piu
		GROUP BY service_id
		ORDER BY service_id ASC");
		return $q;
	}

	function kategori()
	{
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}
}
