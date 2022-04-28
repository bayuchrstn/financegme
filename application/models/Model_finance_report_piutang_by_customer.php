<?php
class Model_finance_report_piutang_by_customer extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		if ($this->input->post('search_cust') != '') {
			$q = $this->db->query("SELECT * FROM (SELECT
		a.*,
		DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS date_invoicenya,
		DATE_FORMAT(a.`due_date`, '%d-%m-%Y') AS date_duenya,
		COALESCE(a.`jml_bayar`, 0) AS bayar,
		COALESCE(a.`jml_piutang`,0) AS jumlah,
		b.`nama` AS nama_cust,
		b.`idcust`,
		c.`nama` AS nama_site,
		IF(
		  c.`alamat` = '',
		  c.`alamat2`,
		  c.`alamat3`
		) AS alamat,
		c.`phonewakil`,
		d.`ppn` AS ppnnya
	  FROM
		erp_gmedia.`arpost` a
		JOIN erp_gmedia.`ms_customers` b
		  ON a.`id_cust` = b.`id`
		JOIN erp_gmedia.`ms_site` c
		  ON a.`id_site` = c.`id`
		JOIN erp_gmedia.`order_header` d
		ON a.`id_order`=d.`id`
    WHERE a.`status`=1 AND a.`status_invoice` > 1 AND a.`id_order` IS NOT NULL AND a.`id_cust`='" . $this->input->post('search_cust') . "' 
	AND a.`tanggal_invoice` LIKE '%" . $this->input->post('searchkat_inv') . "%'
		  UNION ALL
		  SELECT
		a.*,
		DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS date_invoicenya,
		DATE_FORMAT(a.`due_date`, '%d-%m-%Y') AS date_duenya,
		COALESCE(a.`jml_bayar`, 0) AS bayar,
		COALESCE(a.`jml_piutang`,0) AS jumlah,
		d.`nama` AS nama_cust,
		d.`idcust`,
		c.`nama` AS nama_site,
		IF(
		  c.`alamat` = '',
		  c.`alamat2`,
		  c.`alamat3`
		) AS alamat,
		c.`phonewakil`,
		a.`ppn` AS ppnnya
		FROM erp_gmedia.`arpost` a
		JOIN erp_gmedia.`arpost_merge` b
		ON a.`id`=b.`id_arpost_merge`
		JOIN erp_gmedia.`ms_site` c
		ON a.`to_site`=c.`id`
		JOIN erp_gmedia.`ms_customers` d
		ON c.`id_cust`=d.`id`
		WHERE a.`status`=1 AND a.`status_invoice` > 1 AND a.`merge_type`=1 AND d.`id`='" . $this->input->post('search_cust') . "' 
		AND a.`tanggal_invoice` LIKE '%" . $this->input->post('searchkat_inv') . "%'
		GROUP BY a.`id`) z
		ORDER BY z.`tanggal_invoice` ASC,z.`nama_cust` ASC");
			return $q;
		} else {
			return false;
		}
	}

	function kategori()
	{
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}

	function select_customer()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		if (!empty($this->input->post('searchTerm'))) {
			$db->select("a.id,a.nama,a.status,a.idcust");
			$db->from("ms_customers a");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->like('a.nama', '' . $this->input->post('searchTerm') . '');
			$db->where('a.status', '1');
			$db->order_by('a.nama', 'ASC');
			$q = $db->get();
			$data2 = $q->result();
		} else {
			$db->select("a.id,a.nama,a.status,a.idcust");
			$db->from("ms_customers a");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->where('a.status', '1');
			$db->order_by('a.nama', 'ASC');
			$q = $db->get();
			$data2 = $q->result();
		}
		$data = array();
		$no = 0;
		foreach ($data2 as $row) {
			$no++;
			$data[] = array("id" => $row->id, "text" => $no . '. ' . $row->nama);
			$idcust = $row->idcust;
		}
		$data3 = array("hasil" => $data, "custid" => $idcust);
		return json_encode($data3);
	}
}
