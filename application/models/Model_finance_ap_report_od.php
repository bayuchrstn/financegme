<?php
class Model_finance_ap_report_od extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$kondisi = null;
		$tanggal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		if ($this->input->post('searchTanggal') == '1') {
			//$tanggal_akhir = $this->input->post('searchDateFinish');
		} elseif ($this->input->post('searchTanggal') == '3') {
			$tanggal_akhir = $this->input->post('searchDateFinish2');
		}

		if ($this->input->post('searchkategori') != '') {
			$kondisi = " AND a.`supplier` = '" . $this->input->post('searchkategori') . "'";
		}
		if ($this->input->post('searchTanggal') == '1') {
			$kondisi .= " AND (a.`tanggal` BETWEEN '" . $this->input->post('searchDateFirst') . "' AND '" . $this->input->post('searchDateFinish') . "') AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $this->input->post('searchDateFinish') . "')";
		} elseif ($this->input->post('searchTanggal') == '2') {
			$kondisi .= " AND (a.`date_paid` = '' OR a.`date_paid` IS NULL)";
		} elseif ($this->input->post('searchTanggal') == '3') {
			$kondisi .= " AND a.`tanggal` <= '" . $this->input->post('searchDateFinish2') . "' AND (a.`date_paid` = '' OR a.`date_paid` IS NULL OR a.`date_paid` > '" . $this->input->post('searchDateFinish2') . "')";
		}

		$q = $this->db->query("SELECT
		a.*,
		DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS date_invoicenya,
		DATE_FORMAT(a.date_due, '%d-%m-%Y') AS date_duenya,
		b.nama AS nama_supplier,
		COALESCE(
		  (SELECT
			SUM(jumlah)
		  FROM
			erp_financev2.`gmd_finance_ap_billing`
		  WHERE id_ap = a.id
			AND tanggal <= '" . $tanggal_akhir . "'),
		  0
		) AS bayar,
		DATEDIFF('" . $tanggal . "', a.date_due) AS aging
	  FROM
		erp_financev2.`gmd_finance_ap_invoice` AS `a`
		LEFT JOIN inventory_v2.`ms_perusahaan` `b`
		  ON `a`.`supplier` = `b`.`id_perusahaan`
	  WHERE `a`.`branch` = '" . $this->cek_id_regional($this->session->userdata('scope_area')) . "' AND a.`status` != 9
		$kondisi
	  GROUP BY `a`.`id`
	  ORDER BY `b`.`nama` ASC,
		`a`.`tanggal` ASC,
		`a`.`no_referensi` ASC");
		return $q;
	}

	function insert()
	{
		$customer_id = strtoupper($this->input->post('customer_id'));
		$service_id = strtoupper($this->input->post('service_id'));
		$q = $this->db->query("select customer_id from gmd_marketing_customer where customer_id = '" . $customer_id . "'");
		if ($q->num_rows() > 0) {
			$data = array(
				'nama' => strtoupper($this->input->post('customer_group_name')),
			);
			$this->db->where('customer_id', $customer_id);
			$this->db->update('marketing_customer', $data);
		} else {
			$data = array(
				'customer_id' => $customer_id,
				'nama' => strtoupper($this->input->post('customer_group_name')),
			);
			$this->db->insert('marketing_customer', $data);
		}

		$q = $this->db->query("select service_id from gmd_marketing_customer_service where service_id = '" . $service_id . "'");
		if ($q->num_rows() > 0) {
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
		} else {
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
		$result = $this->db->insert('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function select()
	{
		$this->db->select('a.*, FORMAT(a.jumlah, 0) as jumlah, 
		b.customer_id, b.nama, b.alamat, b.telp, b.kategori, b.produk, c.nama as customer_group_name', false);
		$this->db->from('finance_invoice_customer a');
		$this->db->join('marketing_customer_service as b', 'a.service_id = b.service_id', 'left');
		$this->db->join('marketing_customer as c', 'b.customer_id = c.customer_id', 'left');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$customer_id = strtoupper($this->input->post('customer_id'));
		$service_id = strtoupper($this->input->post('service_id'));
		$q = $this->db->query("select customer_id from gmd_marketing_customer where customer_id = '" . $customer_id . "'");
		if ($q->num_rows() > 0) {
			$data = array(
				'nama' => strtoupper($this->input->post('customer_group_name')),
			);
			$this->db->where('customer_id', $customer_id);
			$this->db->update('marketing_customer', $data);
		} else {
			$data = array(
				'customer_id' => $customer_id,
				'nama' => strtoupper($this->input->post('customer_group_name')),
			);
			$this->db->insert('marketing_customer', $data);
		}

		$q = $this->db->query("select service_id from gmd_marketing_customer_service where service_id = '" . $service_id . "'");
		if ($q->num_rows() > 0) {
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
		} else {
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
		$result = $this->db->update('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('finance_invoice_customer');
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function cek_id_regional($id)
	{
		$data = 0;

		$q = $this->db->query("select id from gmd_regional where code = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['id'];
			}
		}
		$q->free_result();

		return $data;
	}

	function cek_bayar($id)
	{
		$data = 0;

		$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_transaksi_kasir 
		where id_ref = '" . $id . "' and transaksi = '1'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data += $r['jml'];
			}
		}

		return $data;
	}

	function produk()
	{
		$q = $this->db->query("select a.*, b.name as nama_category from gmd_product a
		left join gmd_product_category b on a.category = b.code
		order by b.name asc, a.name asc");
		return $q;
	}

	function kategori()
	{
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}

	function select_autocomplite_service()
	{
		$this->db->select("a.*, b.nama as customer_group_name, c.id as id_produk, c.name, d.name, e.id as id_kategori, e.name", false);
		$this->db->from("marketing_customer_service a");
		$this->db->join('marketing_customer b', 'a.customer_id = b.customer_id', 'left');
		$this->db->join('product c', 'a.produk = c.id', 'left');
		$this->db->join('product_category d', 'c.category = d.code', 'left');
		$this->db->join('master e', "a.kategori = e.id AND e.category = 'customer_type'", 'left');
		$this->db->where("(a.service_id like '%" . $this->input->post('term') . "%'
		OR a.nama like '%" . $this->input->post('term') . "%'
		OR a.alamat like '%" . $this->input->post('term') . "%'
		OR a.telp like '%" . $this->input->post('term') . "%'
		OR b.customer_id like '%" . $this->input->post('term') . "%'
		or b.nama like '%" . $this->input->post('term') . "%'
		or c.name like '%" . $this->input->post('term') . "%'
		or d.name like '%" . $this->input->post('term') . "%'
		or e.name like '%" . $this->input->post('term') . "%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}

	function select_autocomplite_customer()
	{
		$this->db->select("a.*", false);
		$this->db->from("marketing_customer a");
		$this->db->where("(a.customer_id like '%" . $this->input->post('term') . "%'
		or a.nama like '%" . $this->input->post('term') . "%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}

	function get_supp($param = '')
	{
		$q = $this->db->query("SELECT * FROM inventory_v2.`ms_perusahaan` a WHERE a.`status`=1 AND a.`nama` LIKE '%$param%' ORDER BY a.`nama` ASC LIMIT 10")->result();
		$data = array();
		foreach ($q as $row) {
			$data[] = array(
				"id" => $row->id_perusahaan,
				"text" => $row->nama
			);
		}
		return json_encode($data);
	}
}
