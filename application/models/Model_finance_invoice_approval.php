<?php

use FontLib\Table\Type\post;

class Model_finance_invoice_approval extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$data = '<table class="table datatable-ajax table-striped table-xxs text-size-small">';
		$db = $this->load->database('erp_gmedia', TRUE);
		$tanggal = $ppn = $sort = null;
		if ($this->input->post('searchkat_inv') == '1') {
			$ppn = " WHERE p.`nomor` LIKE '%03.%'";
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$ppn = " WHERE p.`nomor` LIKE '%/GMD-SMG/%'";
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$ppn = " WHERE p.`nomor` LIKE '%07.%'";
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$ppn = " WHERE p.`nomor` LIKE '%/GMD-SLTG/%'";
		}
		if ($this->input->post('sorting') == '1') {
			$sort = " ORDER BY z.`nomor` ASC";
		} elseif ($this->input->post('sorting') == '2') {
			$sort = " ORDER BY z.`nama` ASC";
		}
		$first_date = $this->input->post('searchthn_inv') . '-' . $this->input->post('searchbln_inv') . '-01';
		$second_date = date("Y-m-t", strtotime($first_date));

		$tanggal = " AND a.`tanggal_invoice` BETWEEN '" . $first_date . "' AND '" . $second_date . "'";

		$q = $db->query("SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0 $tanggal
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND (a.`status_invoice` = 0 OR a.`status_invoice` = 1)
		GROUP BY d.`id_arpost_merge`) p $ppn
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			arpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL $tanggal
			AND (a.`status_invoice` = 0 OR a.`status_invoice`= 1)) X
		GROUP BY x.`id`) p $ppn ) z $sort");
		$total = 0;
		if ($q->num_rows() > 0) {
			$no = 0;
			foreach ($q->result_array() as $r) {
				$no++;
				// $ck = ($r['status_invoice'] == '1') ? '' : ' checked="checked"';
				$ck = '';
				$data .= '<tr>
					<td><input type="hidden" name="id_invoice[]" value="' . $r['id'] . '">
					<input type="checkbox" name="checkbox_invoice[]" value="' . $r['id'] . '" ' . $ck . '></td>
					<td>' . $no . '.</td>
					<td class="text-nowrap">' . $r['tanggalnya'] . '</td>
					<td class="text-nowrap"><a id="' . $r['id'] . '" tyle="color:blue" onclick="input_data(this);" >' . $r['nomor'] . '</a></td>
					<td>' . $r['nama'] . '</td>
					<td class="text-right">' . number_format($r['total'], 0) . '</td>
					</tr>';
				$total = $total + $r['total'];
			}
		}
		$q->free_result();
		$data .= '</table>';

		$data2 = array('data' => $data, 'total' => "Sudah Approve<span style='float:right'>Total : Rp " . number_format($total, 0) . "</span></div>");

		return $data2;
	}

	function get_data_table_sudah()
	{
		$data = '<table class="table datatable-ajax table-striped table-xxs text-size-small">';
		$db = $this->load->database('erp_gmedia', TRUE);
		$tanggal = $ppn = $sort = null;
		if ($this->input->post('searchkat_inv') == '1') {
			$ppn = " WHERE p.`nomor` LIKE '%03.%'";
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$ppn = " WHERE p.`nomor` LIKE '%/GMD-SMG/%'";
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$ppn = " WHERE p.`nomor` LIKE '%07.%'";
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$ppn = " WHERE p.`nomor` LIKE '%/GMD-SLTG/%'";
		}
		if ($this->input->post('sorting') == '1') {
			$sort = " ORDER BY z.`nomor` ASC";
		} elseif ($this->input->post('sorting') == '2') {
			$sort = " ORDER BY z.`nama` ASC";
		}
		$first_date = $this->input->post('searchthn_inv') . '-' . $this->input->post('searchbln_inv') . '-01';
		$second_date = date("Y-m-t", strtotime($first_date));

		$tanggal = " AND a.`tanggal_invoice` BETWEEN '" . $first_date . "' AND '" . $second_date . "'";

		$q = $db->query("SELECT * FROM (SELECT * FROM
		(SELECT
		  d.`id_arpost_merge` AS id,
		  a.`nomor`,
		  a.`tanggal`,
		  DATE_FORMAT(a.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  a.`due_date`,
		  b.`nama`,
		  SUM(e.`bw`) AS bw,
		  SUM(e.`lain2`) + e.`materai` AS lain2,
		  SUM(e.`instalasi`) AS instalasi,
		  SUM(e.`ppn`) AS ppn,
		  SUM(e.`total`) + e.`materai` AS total,
		  e.`jml_bayar`,
		  IF(
			SUM(e.`ppn`) = 0,
			'TIDAK',
			IF(
			  SUM(e.`ppn`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  a.`date_printed`,
		  a.`date_email`,
		  a.`date_faktur`,
		  a.`lunas`,
		  a.`status_invoice`,
		  IF(
			a.`flag` = 1,
			'Langganan',
			IF(
			  a.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  e.`status_merge`
		FROM
		  arpost a
		  LEFT JOIN arpost_merge d
			ON a.`id` = d.`id_arpost_merge`
		  LEFT JOIN ms_site b
			ON a.`to_site` = b.`id`
		  LEFT JOIN
			(SELECT
			  z.`id`,
			  SUM(z.`bw`) AS bw,
			  CASE
				WHEN SUM(z.`materai`) >= 6000
				THEN 6000
				WHEN SUM(z.`materai`) < 6000
				THEN SUM(z.`materai`)
			  END AS materai,
			  SUM(z.`lain2`) AS lain2,
			  SUM(z.`ppn2`) AS ppn,
			  SUM(z.`instalasi`) AS instalasi,
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`) AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`merge` AS status_merge
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = 'LG'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'PN'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'BI'
				  THEN 0
				  WHEN c.`jenis_transaksi` = 'MT'
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2
			  FROM
				arpost a
				LEFT JOIN ms_site b
				  ON a.`id_site` = b.`id`
				LEFT JOIN transaksi c
				  ON a.`nomor` = c.`nomor`
				  AND a.`id_order` = c.`id_order`
			  WHERE a.`lunas` = 0
				AND a.`status` = 1
				AND c.`status` = 1
				AND a.`merge` = 1 $tanggal) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE a.`lunas` = 0 $tanggal
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		  AND a.`status_invoice` = 2
		GROUP BY d.`id_arpost_merge`) p $ppn
	  UNION ALL
	  SELECT * FROM
		(SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  DATE_FORMAT(x.`tanggal_invoice`, '%d-%m-%Y') AS tanggalnya,
		  x.`due_date`,
		  x.`nama`,
		  SUM(x.`bw`) AS bw,
		  CASE
			WHEN SUM(x.`materai`) >= 6000
			THEN SUM(x.`lain2`) + 6000
			WHEN SUM(x.`materai`) < 6000
			THEN SUM(x.`lain2`) + SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(
			SUM(x.`ppn2`) = 0,
			'TIDAK',
			IF(
			  SUM(x.`ppn2`) > 0,
			  'STANDAR',
			  'SEDERHANA'
			)
		  ) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(
			x.`flag` = 1,
			'Langganan',
			IF(
			  x.`flag` = 2,
			  'Project',
			  'Langganan'
			)
		  ) AS flag,
		  0 AS status_merge
		FROM
		  (SELECT
			a.*,
			CASE
			  WHEN b.`nama` IS NULL
			  THEN d.`nama`
			  ELSE b.`nama`
			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = 'LG'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'PN'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'BI'
			  THEN 0
			  WHEN c.`jenis_transaksi` = 'MT'
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2
		  FROM
			arpost a
			LEFT JOIN ms_site b
			  ON a.`id_site` = b.`id`
			LEFT JOIN transaksi c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN ms_customers d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`lunas` = 0
			AND a.`status` = 1
			AND c.`status` = 1 AND a.`merge` IS NULL $tanggal
			AND a.`status_invoice` = 2) X
		GROUP BY x.`id`) p $ppn ) z $sort");
		$total = 0;
		if ($q->num_rows() > 0) {
			$no = 0;
			foreach ($q->result_array() as $r) {
				$no++;
				$ck = ($r['status_invoice'] == '1') ? '' : ' checked="checked"';
				$data .= '<tr>
					<td></td>
					<td>' . $no . '.</td>
					<td class="text-nowrap">' . $r['tanggalnya'] . '</td>
					<td class="text-nowrap"><a id="' . $r['id'] . '" tyle="color:blue" onclick="input_data(this);" >' . $r['nomor'] . '</a></td>
					<td>' . $r['nama'] . '</td>
					<td class="text-right">' . number_format($r['total'], 0) . '</td>
					</tr>';
				$total = $total + $r['total'];
			}
		}
		$data2 = null;
		$q->free_result();
		$data .= '</table>';
		$data2 = array('data' => $data, 'total' => "Sudah Approve<span style='float:right'>Total : Rp " . number_format($total, 0) . "</span></div>");
		return $data2;
	}

	function approve_invoice()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$id = $this->input->post('id');
		$inv = explode(',', $id);
		$row = $msg = null;
		if ($this->session->userdata('userid') == '111178' || $this->session->userdata('userid') == '111127' || $this->session->userdata('userid') == '111186' || $this->session->userdata('userid') == '111205' || $this->session->userdata('userid') == '111223') {
			foreach ($inv as $row) {
				$data = array(
					'status_invoice' => '2',
					'date_approve' => date('Y-m-d H:i:s'),
					'id_approve' => $this->session->userdata('userid')
				);
				$db->where('id', $row);
				$db->update('arpost', $data);
				$msg = $this->insert_gl($row);
			}
		}
		return $msg;
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

	function get_bulan($akhir)
	{
		$bulan = substr($akhir, 5, 2);
		if ($bulan == '01') {
			$bulan = 'Januari';
		} else if ($bulan == '02') {
			$bulan = 'Februari';
		} else if ($bulan == '03') {
			$bulan = 'Maret';
		} else if ($bulan == '04') {
			$bulan = 'April';
		} else if ($bulan == '05') {
			$bulan = 'Mei';
		} else if ($bulan == '06') {
			$bulan = 'Juni';
		} else if ($bulan == '07') {
			$bulan = 'Juli';
		} else if ($bulan == '08') {
			$bulan = 'Agustus';
		} else if ($bulan == '09') {
			$bulan = 'September';
		} else if ($bulan == '10') {
			$bulan = 'Oktober';
		} else if ($bulan == '11') {
			$bulan = 'November';
		} else {
			$bulan = 'Desember';
		}
		return $bulan;
	}

	function create_id()
	{
		$invoice_cek = 0;
		$query = $this->db->query("SELECT MAX(id) AS last_id FROM erp_financev2.`gmd_finance_coa_general_ledger`")->row();
		$invoice = $query->last_id;
		while ($invoice_cek < 1) {
			$this->db->where("id = '" . $invoice . "'", NULL, FALSE);
			$q = $this->db->get('finance_coa_general_ledger');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$invoice++;
			}
		}
		return $invoice;
	}

	function insert_gl($id)
	{
		$db = $this->load->database('default', TRUE);
		$tanggal = $tahun = $bulan = $nama = $tgl_inv = null;
		$tanggal = date('Y-m-d');
		$kreditbi = 0;
		$kreditmt = 0;
		$debet = 0;
		$debetmt = 0;
		$kredit = 0;
		$card = $layanan = null;
		$kreditppn = 0;
		$data = $db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`id`=$id")->result();
		foreach ($data as $row) {
			if ($row->merge_type == 1) {
				$detail = $db->query("SELECT a.`id_arpost`,c.`jenis_transaksi`, c.`nominal`, d.`nama`,f.`label` AS nama_layanan
				FROM (SELECT a.`id_arpost` AS id_arpost,b.`id_cust` FROM erp_gmedia.`arpost_merge` a LEFT JOIN erp_gmedia.`arpost` b
				ON a.`id_arpost`=b.`id` WHERE a.`id_arpost_merge`='" . $row->id . "') a
				LEFT JOIN erp_gmedia.`arpost` b ON a.`id_arpost`=b.`id`
				LEFT JOIN erp_gmedia.`transaksi` c ON (b.`nomor`=c.`nomor` AND b.`id_order`=c.`id_order`)
				LEFT JOIN erp_gmedia.`ms_customers` d ON a.`id_cust`=d.`id` LEFT JOIN erp_gmedia.`order_service` e ON c.`id_order_service`=e.`id`
				LEFT JOIN erp_gmedia.`ms_layanan` f ON e.`id_serv`=f.`id` WHERE c.status=1")->result();
			} else {
				$detail = $db->query("SELECT a.`jenis_transaksi`, a.`nominal`, a.`nomor`, c.`nama`,e.`label` AS nama_layanan
				FROM erp_gmedia.`transaksi` a JOIN erp_gmedia.`order_header` b
				ON a.`id_order`=b.`id` JOIN erp_gmedia.`ms_site` c
				ON b.`id_site`=c.`id` JOIN erp_gmedia.`order_service` d
				ON a.`id_order_service` = d.`id` JOIN erp_gmedia.`ms_layanan` e
				ON d.`id_serv` = e.`id` WHERE a.`id_order` = $row->id_order AND a.`nomor` = '" . $row->nomor . "' AND a.`status`=1 GROUP BY a.`id`")->result();
			}
			foreach ($detail as $low) {
				if ($low->jenis_transaksi == "BI") {
					$debet = $debet + $low->nominal;
					$kreditbi = $kreditbi + $low->nominal;
				} else if ($low->jenis_transaksi == "PN") {
					$debet = $debet + $low->nominal;
					$kreditppn = $kreditppn + $low->nominal;
				} else if ($low->jenis_transaksi == "MT") {
					if ($debetmt == 0) {
						$debetmt = $debetmt + $low->nominal;
						$debet = $debet + $debetmt;
						$kreditmt = $kreditmt + $low->nominal;
					}
				} else {
					if ($low->jenis_transaksi == "LG") {
						$layanan = $layanan . ' | ' . $low->nama_layanan;
					}
					$debet = $debet + $low->nominal;
					$kredit = $kredit + $low->nominal;
				}
				$nama = $low->nama;
			}
			$bulan = $this->get_bulan($row->periode_sampai);
			$tahun = substr($row->periode_sampai, 0, 4);
			$tanggal = $tanggal;
			$tgl_inv = $row->tanggal_invoice;
			$no_ref = $row->nomor;
			$kat_gl = 21;
			$deskripsi = "Invoice " . $nama . " periode " . $bulan . " " . $tahun;
			if (!empty($kreditppn)) {
				$ppn = 1;
			} else {
				$ppn = 2;
			}
		}
		if ($this->closing_date_accounting($tgl_inv) == true) {
			$db->from('finance_coa_general_ledger_detail a');
			$db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$db->where('b.no_referensi', $no_ref);
			$q = $db->get();
			if ($q->num_rows() > 0) {
				$msg = 'No referensi sudah pernah di input';
			} else {
				$create_queue_id = $this->create_queue_id();
				$create_gl_id = $this->create_gl_id($kat_gl);
				$branch = 8;
				$area = 2;
				$data = array(
					'id' => $this->create_id(),
					'no_trans' => $create_queue_id,
					'kat_gl' => $kat_gl,
					'jurnal_group' => $create_gl_id,
					'deskripsi' => $deskripsi,
					'tanggal' => $tgl_inv,
					'no_referensi' => $no_ref,
					'ppn' => $ppn,
					'branch' => $branch,
					'area' => $area,
				);
				$db->trans_start();
				$result = $db->insert('finance_coa_general_ledger', $data);
				$result = $db->trans_status();
				$db->trans_complete();
				if (!empty($result)) {
					if ($debet != 0 && $kredit != 0) {
						//debet
						$akun = 112100;
						$card = 22;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tgl_inv,
							'divisi' => 0,
							'debet' => $debet,
							'card_id' => $card,
							'kredit' => 0,
							'ket' => $layanan,
							'branch' => $branch,
							'area' => $area,
						);
						$db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $card, $tgl_inv, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $card, $tgl_inv, $branch, $area);
						//kredit
						$akun = 410000;
						$card = 90;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tgl_inv,
							'divisi' => 0,
							'debet' => 0,
							'card_id' => $card,
							'kredit' => $kredit,
							'ket' => $layanan,
							'branch' => $branch,
							'area' => $area,
						);
						$db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $card, $tgl_inv, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $card, $tgl_inv, $branch, $area);
					}
					if ($kreditbi != 0) {
						//kredit
						$akun = 440000;
						$card = 93;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tgl_inv,
							'divisi' => 0,
							'debet' => 0,
							'card_id' => $card,
							'kredit' => $kreditbi,
							'branch' => $branch,
							'area' => $area,
						);
						$db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $card, $tgl_inv, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $card, $tgl_inv, $branch, $area);
					}
					if ($kreditmt != 0) {
						//kredit
						$akun = 623000;
						$card = 119;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tgl_inv,
							'divisi' => 0,
							'debet' => 0,
							'card_id' => $card,
							'kredit' => $kreditmt,
							'branch' => $branch,
							'area' => $area,
						);
						$db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $card, $tgl_inv, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $card, $tgl_inv, $branch, $area);
					}
					if ($kreditppn != 0) {
						//kredit
						$akun = 213120;
						$card = 75;
						$data = array(
							'no_trans' => $create_queue_id,
							'id_biaya' => $akun,
							'tanggal' => $tgl_inv,
							'divisi' => 0,
							'debet' => 0,
							'card_id' => $card,
							'kredit' => $kreditppn,
							'branch' => $branch,
							'area' => $area,
						);
						$db->insert('finance_coa_general_ledger_detail', $data);
						$this->model_global->update_jurnal_bulanan($akun, $card, $tgl_inv, $branch, $area);
						$this->model_global->update_jurnal_harian($akun, $card, $tgl_inv, $branch, $area);
					}
					$msg = 1;
				} else {
					$msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
				}
			}
		}
		$db->trans_complete();
		return $msg;
	}

	function closing_date_accounting($tanggal)
	{
		$this->db->select("general_ledger as tanggal", false);
		$this->db->where('branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$Q = $this->db->get('finance_close_date');
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				if ($tanggal <= $row['tanggal']) {
					return false;
				} else {
					return true;
				}
			}
		} else {
			return true;
		}
		$Q->free_result();
	}

	function create_queue_id()
	{
		$invoice_cek = 0;
		$userid = str_pad($this->session->userdata('id'), 6, '0', STR_PAD_LEFT);
		$code_queue = 1;
		$code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
		$invoice = date('ymdhis') . $userid . $code_queue_zero;
		while ($invoice_cek < 1) {
			$this->db->where("no_trans = '" . $invoice . "'", NULL, FALSE);
			$q = $this->db->get('finance_coa_general_ledger');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
				$invoice = date('ymdHis') . $userid . $code_queue_zero;
			}
			$q->free_result();
		}
		return $invoice;
	}

	function create_gl_id($id)
	{
		$kode_ju = $this->finance_master_kat_gl_name($id);
		$invoice_cek = 0;
		$code_queue = 1;
		$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
		$invoice = $kode_ju . '-' . date('ymd') . $code_queue_zero;
		while ($invoice_cek < 1) {
			$this->db->where("jurnal_group = '" . $invoice . "'", NULL, FALSE);
			$q = $this->db->get('finance_coa_general_ledger');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
				$invoice = $kode_ju . '-' . date('ymd') . $code_queue_zero;
			}
			$q->free_result();
		}
		return $invoice;
	}

	function finance_master_kat_gl_name($id)
	{
		$data = '';

		$q = $this->db->query("select nama from gmd_finance_master_kat_gl where id = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['nama'];
			}
		}
		$q->free_result();

		return $data;
	}

	function get_header()
	{
		$id = $this->input->post('id');
		$data = $id_head = '';
		$q = $this->db->query("SELECT
		a.`id_header` AS id_head,
		  b.`nama` AS nama_site,
		 c.`nama` AS nama_cust
	  FROM
		erp_gmedia.`arpost` a
		JOIN erp_gmedia.`ms_site` b
		  ON a.`to_site` = b.`id`
		JOIN erp_gmedia.`ms_customers` c
		  ON b.`id_cust` = c.`id`
	  WHERE a.`merge_type` = 1
		AND a.`status` = 1 AND a.`id`=$id
	  UNION
	  ALL
	  SELECT
		*
	  FROM
		(SELECT
		  x.`id_head`,
		  x.`nama_site`,
		  x.`nama_cust`
		FROM
		  (SELECT
			a.`id_header` AS id_head,
	   b.`nama` AS nama_site,
			  d.`nama` AS nama_cust
		  FROM
		  erp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN erp_gmedia.`ms_customers` d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL
			  OR a.`merge` = 0) AND a.`id`=$id ) X ) p");
		$row = $q->row();
		$id_head = $row->id_head;
		$data .= '<input type="radio" id="header" name="header" value="1">' . $row->nama_site . '<br>';
		$data .= '<input type="radio" id="header" name="header" value="2">' . $row->nama_cust . '<br>';
		$data .= '<input type="radio" id="header" name="header" value="3">' . $row->nama_cust . ' | ' . $row->nama_site . '<br>';
		$data .= '</div>';
		$data2 = array('data' => $data, 'id' => $id_head);
		return json_encode($data2);
	}

	function set_header()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$id = $this->input->post('id');
		$id_head = $this->input->post('id_head');
		$data = null;
		$data = array('id_header' => $id_head);
		$db->where('id', $id);
		$db->update('arpost', $data);

		$q = $this->db->query("SELECT
		a.`id_header` AS id_head,
		  b.`id` AS id_site,
		 c.`id` AS id_cust
	  FROM
		erp_gmedia.`arpost` a
		JOIN erp_gmedia.`ms_site` b
		  ON a.`to_site` = b.`id`
		JOIN erp_gmedia.`ms_customers` c
		  ON b.`id_cust` = c.`id`
	  WHERE a.`merge_type` = 1
		AND a.`status` = 1 AND a.`id`=$id
	  UNION ALL
	  SELECT
		*
	  FROM
		(SELECT
		  x.`id_head`,
		  x.`id_site`,
		  x.`id_cust`
		FROM
		  (SELECT
			a.`id_header` AS id_head,
	   		b.`id` AS id_site,
			  d.`id` AS id_cust
		  FROM
		  erp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor`
			  AND a.`id_order` = c.`id_order`
			LEFT JOIN erp_gmedia.`ms_customers` d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL
			  OR a.`merge` = 0) AND a.`id`=$id ) X ) p");
		$query = $q->result();
		foreach ($query as $row) {
			$id_site = $row->id_site;
			$id_cust = $row->id_cust;
		}
		$db->where('id_site', $id_site);
		$db->where('id_cust', $id_cust);
		$db->update('order_header', $data);
		return 1;
	}
}
