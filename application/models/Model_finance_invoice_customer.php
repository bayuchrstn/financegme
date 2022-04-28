<?php
class Model_finance_invoice_customer extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		set_time_limit(0);

		$kondisi = '';
		$kondisi2 = '';
		$kondisippn = '';
		$keyword = '';
		$keyword = $this->input->post('search_keyword');
		$sort = $this->input->post('sortid');
		$kondisi .= "a.`tanggal` between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "' ";
		if ($this->input->post('searchkat_inv') == '1') {
			$kondisippn = " WHERE p.`nomor` LIKE '%03.%'";
		} elseif ($this->input->post('searchkat_inv') == '2') {
			$kondisippn = " WHERE p.`nomor` LIKE '%/GMD-SMG/%'";
		} elseif ($this->input->post('searchkat_inv') == '3') {
			$kondisippn = " WHERE p.`nomor` LIKE '%07.%'";
		} elseif ($this->input->post('searchkat_inv') == '4') {
			$kondisippn = " WHERE p.`nomor` LIKE '%/GMD-SLTG/%'";
		} else {
			$kondisippn = "";
		}
		if ($this->input->post('searchstatus_inv') != '') {
			$kondisi .= " AND a.`status_invoice` = " . $this->input->post('searchstatus_inv') . " ";
		}
		if ($this->input->post('searchlunas') != '') {
			$kondisi .= " AND a.`lunas` = " . $this->input->post('searchlunas') . " ";
			$kondisi2 = " AND a.`lunas` = " . $this->input->post('searchlunas') . " ";
		}
		if (!empty($sort)) {
			if ($sort == 1) {
				$sort = ' ORDER BY vb.`idcust` ASC';
			} else if ($sort == 2) {
				$sort = ' ORDER BY vb.`idcust` DESC';
			} else if ($sort == 3) {
				$sort = ' ORDER BY vb.`servid` ASC';
			} else {
				$sort = ' ORDER BY vb.`servid` DESC';
			}
		}
		$q = $this->db->query('SELECT * FROM (SELECT * FROM (
		SELECT
		d.`id_arpost_merge` AS id,
		a.`nomor`,
		a.`tanggal`,
		a.`tanggal_invoice`,
		a.`due_date`,
		c.`nama` AS nama_cust,
		b.`nama` AS nama_site,
		SUM(e.`bw`) AS bw,
		SUM(e.`lain2`)+e.`materai` AS lain2,
		SUM(e.`instalasi`) AS instalasi,
		SUM(e.`ppn`) AS ppn,
		SUM(e.`total`)+e.`materai` AS total,
		e.`jml_bayar`,
		IF(SUM(e.`ppn`) = 0, "TIDAK", IF(SUM(e.`ppn`) > 0, "STANDAR", "SEDERHANA")) AS jenis_ppn,
		a.`date_printed`,
		a.`date_email`,
		a.`date_faktur`,
		a.`date_edited`,
		a.`date_approve`,
		a.`lunas`,
		a.`status_invoice`,
		IF(a.`flag` = 1, "Langganan", IF(a.`flag` = 2, "Project", "Langganan")) AS flag,
		e.`status_merge`,
		c.`idcust`,
		e.`servid`
		FROM
		  erp_gmedia.`arpost` a
		  LEFT JOIN erp_gmedia.`arpost_merge` d
			ON a.`id` = d.`id_arpost_merge`
			LEFT JOIN erp_gmedia.`ms_site` b
			ON a.`to_site` = b.`id`
			LEFT JOIN erp_gmedia.`ms_customers` c
			ON b.`id_cust` = c.`id`
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
			  SUM(z.`bw`) + SUM(z.`lain2`) + SUM(z.`ppn2`) + SUM(z.`instalasi`)  AS total,
			  z.`jml_bayar`,
			  z.`date_printed`,
			  z.`date_email`,
			  z.`date_faktur`,
			  z.`date_edited`,
			  z.`date_approve`,
			  z.`merge` AS status_merge,
			  z.`servid`
			FROM
			  (SELECT
				a.*,
				CASE
				  WHEN c.`jenis_transaksi` = "LG"
				  THEN c.`nominal`
				  ELSE 0
				END AS bw,
				CASE
				  WHEN c.`jenis_transaksi` = "PN"
				  THEN c.`nominal`
				  ELSE 0
				END AS ppn2,
				CASE
				  WHEN c.`jenis_transaksi` = "BI"
				  THEN c.`nominal`
				  ELSE 0
				END AS instalasi,
				CASE
				  WHEN c.`jenis_transaksi` = "MT"
				  THEN c.`nominal`
				  ELSE 0
				END AS materai,
				CASE
				  WHEN c.`jenis_transaksi` = "LG"
				  THEN 0
				  WHEN c.`jenis_transaksi` = "PN"
				  THEN 0
				  WHEN c.`jenis_transaksi` = "BI"
				  THEN 0
				  WHEN c.`jenis_transaksi` = "MT"
				  THEN 0
				  ELSE c.`nominal`
				END AS lain2,
				d.`servid`
			  FROM
			  erp_gmedia.`arpost` a
				LEFT JOIN erp_gmedia.`ms_site` b
				  ON a.`id_site` = b.`id`
				  LEFT JOIN erp_gmedia.`transaksi` c
				  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
				  LEFT JOIN erp_gmedia.`order_service`d
				  ON a.`id_order`=d.`id_order` AND  a.`id_site`=d.`id_site`
			  WHERE d.`status`=1 AND a.`status` = 1 ' . $kondisi2 . '
				AND c.`status` = 1
				AND a.`merge` = 1
				) z
			GROUP BY z.`id`) e
			ON d.`id_arpost` = e.`id`
		WHERE ' . $kondisi . ' AND (b.`nama` LIKE "%' . $keyword . '%" ESCAPE "!" OR 
			a.`nomor` LIKE "%' . $keyword . '%" ESCAPE "!" OR c.`nama` LIKE "%' . $keyword . '%" ESCAPE "!") 
		  AND a.`id_order` IS NULL
		  AND a.`status` = 1
		GROUP BY d.`id_arpost_merge`) p ' . $kondisippn . '
		UNION ALL
	  SELECT * FROM (
		 SELECT
		  x.`id`,
		  x.`nomor`,
		  x.`tanggal`,
		  x.`tanggal_invoice`,
		  x.`due_date`,
		  x.`nama_cust`,
		  x.`nama_site`,
		  SUM(x.`bw`) AS bw,
		  CASE
		  WHEN SUM(x.`materai`) >= 6000
		  THEN SUM(x.`lain2`)+6000
		  WHEN SUM(x.`materai`) < 6000
		  THEN SUM(x.`lain2`)+SUM(x.`materai`)
		  END AS lain2,
		  SUM(x.`instalasi`) AS instalasi,
		  SUM(x.`ppn2`) AS ppn,
		  SUM(x.`bw`) + SUM(x.`lain2`) + SUM(x.`ppn2`) + SUM(x.`instalasi`) + SUM(x.`materai`) AS total,
		  x.`jml_bayar`,
		  IF(SUM(x.`ppn2`) = 0, "TIDAK", IF(SUM(x.`ppn2`) > 0, "STANDAR", "SEDERHANA")) AS jenis_ppn,
		  x.`date_printed`,
		  x.`date_email`,
		  x.`date_faktur`,
		  x.`date_edited`,
		  x.`date_approve`,
		  x.`lunas`,
		  x.`status_invoice`,
		  IF(x.`flag` = 1, "Langganan", IF(x.`flag` = 2, "Project", "Langganan")) AS flag,
		  0 AS status_merge,
		  x.`idcust`,
		  x.`servid`
		FROM
		  (SELECT
			a.*,
			d.`nama` AS nama_cust,
			b.`nama` AS nama_site,
			CASE
    			WHEN b.`nama` IS NULL
    			THEN d.`nama`
    			ELSE b.`nama`
    			END AS nama,
			CASE
			  WHEN c.`jenis_transaksi` = "LG"
			  THEN c.`nominal`
			  ELSE 0
			END AS bw,
			CASE
			  WHEN c.`jenis_transaksi` = "PN"
			  THEN c.`nominal`
			  ELSE 0
			END AS ppn2,
			CASE
			  WHEN c.`jenis_transaksi` = "BI"
			  THEN c.`nominal`
			  ELSE 0
			END AS instalasi,
			CASE
			  WHEN c.`jenis_transaksi` = "MT"
			  THEN c.`nominal`
			  ELSE 0
			END AS materai,
			CASE
			  WHEN c.`jenis_transaksi` = "LG"
			  THEN 0
			  WHEN c.`jenis_transaksi` = "PN"
			  THEN 0
			  WHEN c.`jenis_transaksi` = "BI"
			  THEN 0
			  WHEN c.`jenis_transaksi` = "MT"
			  THEN 0
			  ELSE c.`nominal`
			END AS lain2,
			d.`idcust`,
			e.`servid`
		  FROM
		  erp_gmedia.`arpost` a
			LEFT JOIN erp_gmedia.`ms_site` b
			  ON a.`id_site` = b.`id`
			LEFT JOIN erp_gmedia.`transaksi` c
			  ON a.`nomor` = c.`nomor` AND a.`id_order`=c.`id_order`
			  LEFT JOIN erp_gmedia.`ms_customers` d
				ON a.`id_cust` = d.`id`
			LEFT JOIN erp_gmedia.`order_service` e
				ON a.`id_order`=e.`id_order` AND a.`id_site`=e.`id_site` AND c.id_order_service = e.id
		  WHERE e.`status`!=9 AND d.`status`=1 AND ' . $kondisi . '
		  AND (b.`nama` LIKE "%' . $keyword . '%" ESCAPE "!" OR 
			a.`nomor` LIKE "%' . $keyword . '%" ESCAPE "!" OR d.`nama` LIKE "%' . $keyword . '%" ESCAPE "!") 
			AND a.`status` = 1
			AND c.`status` = 1
			AND (a.`merge` IS NULL OR a.`merge` = 0)) X GROUP BY x.`id` ) p ' . $kondisippn . ' ) vb ' . $sort);
		$qn = $this->db->query("SELECT FOUND_ROWS() AS ttl");
		$n = $qn->row()->ttl;
		$data = array();

		$no = 0;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$a = null;
				$no++;
				//$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
				//$bayar = $this->cek_bayar($r['id']);
				//$edit = '<a href="#" onclick="update_data(\''.$r['id'].'\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> <a href="#" onclick="delete_data(\''.$r['id'].'\')"><i class="icon-trash text-danger"></i></a> <a href="#" onclick="print_invoice(\''.$r['id'].'\')"><i class="material-icons">&#xE8AD;</i></a>';

				if ($r['jml_bayar'] > 0) {
					//$edit = '<a href="#" onclick="update_data(\''.$r['id'].'\')"><i class="material-icons" style="font-size:20px; color:blue">&#xE5D2;</i></a>';
					//$edit .= '<a href="#" onclick="print_invoice(\''.$r['id'].'\')"><i class="material-icons" style="font-size:20px; color:green">&#xE8AD;</i></a>';
				}
				$status_invoice = '';
				$edit = '';

				if (!empty($r['date_printed']) && !empty($r['date_email']) && !empty($r['date_faktur'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Printed</span></a>';
					$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Email</span></a>';
					$edit .= '<a href="#" "><span class="label label-default">Faktur</span></a>';
				} elseif (!empty($r['date_printed']) && !empty($r['date_email'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Printed</span></a>';
					$edit .= '<a href="#" "><span class="label label-default">Email</span></a>';
					$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
				} elseif (!empty($r['date_printed']) && !empty($r['date_faktur'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Printed</span></a>';
					$edit .= '<a href="#" "><span class="label label-default">Faktur</span></a>';
					$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
				} elseif (!empty($r['date_email']) && !empty($r['date_faktur'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Email</span></a>';
					$edit .= '<a href="#" "><span class="label label-default">Faktur</span></a>';
					$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
				} elseif (!empty($r['date_email'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default" >Email</span></a>';
					$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
				} elseif (!empty($r['date_faktur'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default">Faktur</span></a>';
					$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
				} elseif (!empty($r['date_printed'])) {
					if ($r['status_merge'] == '1') {
						$edit .= '<a href="#" "><span class="label label-default" style="margin-right:5px">Merge</span></a>';
					}
					$edit .= '<a href="#" "><span class="label label-default">Printed</span></a>';
					$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
				} else {
					if ($r['status_merge'] == 1 && $r['status_invoice'] == 0) {
						$edit .= '<a href="#" title="split" onclick="pisahinv(\'' . $r['id'] . '\')"><i class="icon-split position-left text-slate-800"></i></a>';
						$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					} else if ($r['status_merge'] == 1 && $r['status_invoice'] >  0) {
						$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
						$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					} else if ($r['status_merge'] == 0 && $r['status_invoice'] == 0) {
						$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
						$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left" ></i></a>';
						$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					} else if ($r['status_merge'] == 0 && $r['status_invoice'] > 0 && !empty($r['date_edited']) && empty($r['date_approve'])) {
						$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
						$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left" style="color:green"></i></a>';
						$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					} else if ($r['status_merge'] == 0 && $r['status_invoice'] > 0 && empty($r['date_edited']) && !empty($r['date_approve'])) {
						$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
						$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left"></i></a>';
						$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					} else if ($r['status_merge'] == 0 && $r['status_invoice'] > 0 && !empty($r['date_edited']) && !empty($r['date_approve'])) {
						$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
						$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left" style="color:green"></i></a>';
						$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					} else if ($r['status_merge'] == 0 && $r['status_invoice'] > 0 && empty($r['date_edited']) && empty($r['date_approve'])) {
						$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
						$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left"></i></a>';
						$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					}
					// if ($r['status_invoice'] == '0' && !empty($r['date_edited']) && $r['status_merge'] == 1) {
					// 	$edit .= '<a href="#" title="split" onclick="pisahinv(\'' . $r['id'] . '\')"><i class="icon-split position-left text-slate-800"></i></a>';
					// 	// $edit .= '<a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
					// 	$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					// } elseif ($r['status_invoice'] == '0' && !empty($r['date_edited']) && $r['status_merge'] != 1) {
					// 	$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left" style="color:green"></i></a>';
					// 	// $edit .= '<a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
					// 	$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					// } elseif (($r['status_invoice'] == '1' || !empty($r['date_edited'])) && $r['status_merge'] == 1) {
					// 	$edit .= '<a href="#" title="split" onclick="pisahinv(\'' . $r['id'] . '\')"><i class="icon-split position-left text-slate-800"></i></a>';
					// 	$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					// } elseif (($r['status_invoice'] == '2' && !empty($r['date_edited'])) && $r['status_merge'] != 1) {
					// 	$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
					// 	$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left" style="color:green"></i></a>';
					// 	$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					// } elseif ($r['status_invoice'] == '2' && !empty($r['date_edited'])) {
					// 	$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
					// 	$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					// } elseif (($r['status_invoice'] == '2') && $r['status_merge'] != 1) {
					// 	$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
					// 	$edit .= '<a href="#" title="edited" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left" ></i></a>';
					// 	$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					// } elseif ($r['status_invoice'] == '2') {
					// 	$a = "<input type='checkbox' class='check_invoice' name='invoice' value=" . $r['id'] . ">";
					// 	$edit .= '<a href="#"><span class="label label-danger">Approved</span></a>';
					// } elseif ($r['status_invoice'] == '0' && $r['status_merge'] == 1) {
					// 	$edit .= '<a href="#" title="split" onclick="pisahinv(\'' . $r['id'] . '\')"><i class="icon-split position-left text-slate-800"></i></a>';
					// 	// $edit .= '<a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
					// 	$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					// } elseif ($r['status_invoice'] == '0' && $r['status_merge'] != 1) {
					// 	$edit .= '<a href="#" title="edit" onclick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
					// 	$edit .= '<a href="#" onclick="approve(\'' . $r['id'] . '\')"><span class="label label-primary">Need Approve</span></a>';
					// }
				}
				if ($r['status_invoice'] == 2 || $r['status_invoice'] == 3) {
					$link = '<a id="' . $r['id'] . '" style="color:blue" onclick="head_data(this);" >' . $r['nomor'] . '</a>';
				} else {
					$link = '<a style="color:black">' . $r['nomor'] . '</a>';
				}

				$row  = array(
					$a,
					$no . '.',
					$r['tanggal_invoice'],
					$r['due_date'],
					$link,
					$r['idcust'],
					$r['servid'],
					$r['nama_cust'],
					$r['nama_site'],
					$r['jenis_ppn'],
					$r['flag'],
					//'nama_produk' => $r['nama_produk'],
					number_format($r['bw'], 0),
					number_format($r['instalasi'], 0),
					number_format($r['lain2'], 0),
					number_format($r['ppn'], 0),
					number_format($r['total'], 0),
					//$status_invoice,
					$edit,
				);


				$data[] = $row;
			}
		}
		$q->free_result();

		$output = array(
			"data" => $data,
		);
		echo json_encode($output);
	}

	function update_data()
	{
		$data = array();
		$date = date('Y-m-d H:i:s');
		$id_order_service = $tgl_transaksi = '';
		$msg = $att_contact = $att_site = $id_contact = 0;
		$id_user = $this->session->userdata('userid');
		$db = $this->load->database('erp_gmedia', TRUE);
		$id = $this->input->post('id');
		$service_id = $this->input->post('service_id');
		$nomor = $this->input->post('service_id_val');
		$id_cust = $this->input->post('id_cust');
		$site_id = $this->input->post('site_id');
		$id_contact = $this->input->post('id_contact');
		$alamat = $this->input->post('alamat');
		$id_order = $this->input->post('id_order');
		$npwp = $this->input->post('npwp');
		$attention = $this->input->post('attention');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$tanggal_invoice = $this->input->post('tanggal_invoice');
		$tanggal = (new DateTime($tanggal_invoice))->format('Y-m-01');
		$due_date = $this->input->post('due_date');
		$periode_dari = $this->input->post('periode_dari');
		$periode_sampai = $this->input->post('periode_sampai');
		// order_service[]: 1323
		// pilih_tambah[]: LG
		// tambah_service_produk[]: MAXi Easy 5Mbps
		// tambah_note[]: 
		// tambah_jumlah[]: 500,000
		$ppnnya = $this->input->post('ppnnya');
		$ppnnya = (float) str_replace(",", "", $ppnnya);
		$total_tagihan = $this->input->post('total_tagihan');
		$total_tagihan = (float) str_replace(",", "", $total_tagihan);
		$att_lama = $this->db->query("SELECT attention_display FROM erp_gmedia.`order_header` WHERE id=$id_order AND id_site=$site_id")->row();
		if ($att_lama->attention_display == 0 || $att_lama->attention_display == 1) {
			$data = array(
				'id_cust' => $id_cust,
				'id_site' => $site_id,
				'nama' => $attention,
				'email' => $email,
				'phone' => $phone,
				'id_user' => $this->session->userdata('userid'),
				'flag' => 'f',
				'status' => 1
			);
			$db->insert('ms_contact', $data);
			$id_contact = $db->insert_id();
			$data = array('attention_display' => $id_contact);
			$db->where('id', $id_order);
			$db->where('id_site', $site_id);
			$db->update('order_header', $data);
		}
		$att_contact = $this->db->query("SELECT a.* FROM erp_gmedia.`ms_contact` a JOIN erp_gmedia.`order_header` b 
		ON a.`id_cust`=b.`id_cust` AND a.`id_site`=b.`id_site` WHERE a.`id`=b.`attention_display` AND b.`id`=$id_order")->row();
		$att_site = $this->db->query("SELECT a.* FROM erp_gmedia.`ms_contact` a JOIN erp_gmedia.`order_header` b
		ON a.`id_cust` = b.`id_cust` AND a.`id_site` = b.`id_site` WHERE b.`id_site` = $site_id AND b.`attention_display` != $id_contact")->row();
		if (!empty($att_contact)) {
			if ($att_contact->nama == $attention && $att_contact->email == $email && $att_contact->phone == $phone && $id_contact > 0) {
			} else {
				$data = array(
					'id_cust' => $id_cust,
					'id_site' => $site_id,
					'nama' => $attention,
					'email' => $email,
					'phone' => $phone,
					'id_user' => $this->session->userdata('userid'),
					'flag' => 'f',
					'status' => 1
				);
				$db->insert('ms_contact', $data);
				$id_contact = $db->insert_id();
			}
		} else {
			if (!empty($att_site)) {
				if ($att_site->wakil == $attention && $att_site->phonewakil == $phone && $att_site->emailwakil == $email) {
				} else {
					$data = array(
						'id_cust' => $id_cust,
						'id_site' => $site_id,
						'nama' => $attention,
						'email' => $email,
						'phone' => $phone,
						'id_user' => $this->session->userdata('userid'),
						'flag' => 'f',
						'status' => 1
					);
					$db->insert('ms_contact', $data);
					$id_contact = $db->insert_id();
				}
			}
		}
		$data = array(
			'id_address' => $alamat,
			'id_contact' => $id_contact,
			'tanggal_invoice' => $tanggal_invoice,
			'due_date' => $due_date,
			'periode_dari' => $periode_dari,
			'periode_sampai' => $periode_sampai,
			'jml_piutang' => $total_tagihan,
			'date_edited' => $date,
			'status_invoice' => 1
		);
		$db->trans_start();
		$db->where('id', $id);
		$db->where('id_site', $site_id);
		$db->where('id_cust', $id_cust);
		$db->update('arpost', $data);
		$db->trans_complete();
		$db->trans_start();
		$data = array('address_display' => $alamat, 'attention_display' => $id_contact);
		$db->where('id', $id_order);
		$db->update('order_header', $data);
		$db->trans_complete();
		$db->trans_start();
		$data = array('taxno' => $npwp);
		$db->where('id', $site_id);
		$db->update('ms_site', $data);
		$db->trans_complete();
		if (isset($_POST['tambah_service_produk'])) {
			$db->query("UPDATE transaksi SET status='9',id_user=$id_user,timestamp='" . $date . "' WHERE id_cust=$id_cust AND nomor='" . $nomor . "' AND id_cust=$id_cust AND id_order=$service_id");
			foreach ($_POST['tambah_service_produk'] as $k => $v) {
				$nominal = (float) str_replace(",", "", $_POST['tambah_jumlah'][$k]);
				if (!empty($_POST['order_service'][$k])) {
					$id_order_service = $_POST['order_service'][$k];
				}
				$tgl_transaksi = $_POST['tgl_transaksi'][$k];
				$data = array(
					'id_order' => $service_id,
					'id_cust' => $id_cust,
					'id_order_service' => $id_order_service,
					'nomor' => $nomor,
					'tanggal' => $tgl_transaksi,
					'nominal' => $nominal,
					'jenis_transaksi' => $_POST['pilih_tambah'][$k],
					'keterangan' => $_POST['tambah_note'][$k],
					'flag' => 'D',
					'status' => 1,
					'id_user' => $id_user,
					'timestamp' => $date
				);
				$db->insert('transaksi', $data);
			}
			//ppn
			$data = array(
				'id_order' => $service_id,
				'id_cust' => $id_cust,
				'id_order_service' => $id_order_service,
				'nomor' => $nomor,
				'tanggal' => $tgl_transaksi,
				'nominal' => $ppnnya,
				'jenis_transaksi' => 'PN',
				'flag' => 'D',
				'status' => 1,
				'id_user' => $id_user,
				'timestamp' => $date
			);
			$db->insert('transaksi', $data);
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}


	function insert_data()
	{
		$this->db->trans_start();
		$z = 1;
		$no_trans = 0;
		$customer_id = strtoupper($this->input->post('customer_inv'));
		$service_id = strtoupper($this->input->post('service_inv'));
		$bw = (float) str_replace(",", "", $this->input->post('bw'));
		$instalasi = (float) str_replace(",", "", $this->input->post('instalasi'));
		$lain2 = (float) str_replace(",", "", $this->input->post('lain2'));
		$potongan = (float) str_replace(",", "", $this->input->post('potongan'));
		//$mf = (float)str_replace(",", "", $this->input->post('mf'));
		$ppnnya = (float) str_replace(",", "", $this->input->post('ppnnya'));
		$region = $this->input->post('region');
		$tgl = $this->input->post('date_inv');
		$jenis = $this->input->post('tipe_inv');
		$bulan = substr($tgl, 5, 2);
		$tahun = substr($tgl, 0, 4);
		if (!empty($ppnnya)) {
			$ppn = 1;
		} else {
			$ppn = 2;
		}

		$service = $bw  + $instalasi  + $lain2 - $potongan;
		/*
		if($this->input->post('ppn') == '1'){
			$q = $this->db->query("select floor(".$service." * 0.1) as ppn");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $k => $r){
					$ppn = $r['ppn'];
				}
			}
			$q->free_result();
		}
		*/
		//$ppn = (float)str_replace(",", "", $this->input->post('ppn'));
		$no_invoice = $this->generate_noinvoice($region, $ppn, $flag = '', $bulan, $tahun);
		//$pph2223 = (float)str_replace(",", "", $this->input->post('pph2223'));
		$jumlah = (float) str_replace(",", "", $this->input->post('total_tagihan'));
		$id_serv = (int) (substr($customer_id, 3, 4));
		$id_serv2 = $id_serv . '-' . $z;
		$data = array(
			'no_invoice' => $no_invoice,
			'periode_invoice' => $this->input->post('period'),
			'date_invoice' => $this->input->post('date_inv'),
			'date_due' => $this->input->post('date_due_inv'),
			'service_id' => $service_id,
			'product_desc' => $this->input->post('service_produk'),
			'product_note' => $this->input->post('service_note'),
			'bw' => $bw,
			'instalasi' => $instalasi,
			'lain2' => $lain2,
			'potongan' => $potongan,
			'jenis_potongan' => $this->input->post('jenis_potongan'),
			'ppn' => $ppnnya,
			'jumlah' => $jumlah,
			'manual' => '1',
			'id_serv' => $id_serv2,
			'date_create' => date('Y-m-d H:i:s'),
			'project' => $jenis,
			'branch' => 8,
			'tgl_awal' => $this->input->post('tgl_awal'),
			'attention' => $this->input->post('nama_att'),
			'telp' => $this->input->post('phone_inv')
		);
		$result = $this->db->insert('finance_invoice_customer', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		$this->db->trans_start();
		if ($result == true) {
			$this->db->where('no_invoice', $insert_id);
			$this->db->delete('finance_invoice_customer_add');
			if (isset($_POST['tambah_service_produk'])) {
				foreach ($_POST['tambah_service_produk'] as $k => $v) {
					$bw = (float) str_replace(",", "", $_POST['tambah_bw'][$k]);
					$instalasi = (float) str_replace(",", "", $_POST['tambah_instalasi'][$k]);
					$lain2 = (float) str_replace(",", "", $_POST['tambah_lain2'][$k]);
					if (!empty($bw)) {
						$z++;
						$data = array(
							'no_invoice' => $insert_id,
							'description' => $_POST['tambah_service_produk'][$k],
							'bw' => $bw,
							'instalasi' => $instalasi,
							'lain2' => $lain2,
							'id_serv' => $id_serv . '-' . $z,
							'periode_invoice' => $_POST['tambah_period'][$k],
						);
					} else {
						$data = array(
							'no_invoice' => $insert_id,
							'description' => $_POST['tambah_service_produk'][$k],
							'bw' => $bw,
							'instalasi' => $instalasi,
							'lain2' => $lain2,
							'periode_invoice' => $_POST['tambah_period'][$k],
						);
					}
					$this->db->insert('finance_invoice_customer_add', $data);

					//$service += $bw + $colo + $instalasi + $perangkat + $lain2;
					$jumlah += $bw  + $instalasi + $lain2;
				}
				$data2 = array(
					'no_invoice' => $insert_id,
					'id_site' => $service_id,
					'date_invoice' => $this->input->post('date_inv'),
					'header_inv' => 1
				);
				$this->db->insert('finance_invoice_customer_detail', $data2);
				/*
				if($this->input->post('ppn') == '1'){
					$q = $this->db->query("select floor(".$service." * 0.1) as ppn");
					if($q->num_rows() > 0){
						foreach($q->result_array() as $k => $r){
							$ppn = $r['ppn'];
						}
					}
					$q->free_result();
				}
				//$jumlah += $service_add;
				$data = array( 
							//'ppn' => $ppn,
							'jumlah' => $jumlah,
						);
				$this->db->where('id', $this->input->post('id'));
				$this->db->update('finance_invoice_customer', $data);	
				*/
			}
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}


	function generate_noinvoice($region, $ppn, $flag = '', $bulan = '', $tahun = '')
	{

		//GENERATE NOMOR INVOICE
		$count = 0;

		$date = $tahun . '-' . $bulan . '-01';
		if ($ppn == 1) {
			$ppnflag = 1;
		} else {
			$ppnflag = $ppn;
		}
		$count = $this->last_no_invoice($region, $ppnflag, $flag, $date)->row();

		$cr = $cr2 = '';
		if ($region == 3) {
			$cr = '03';
			$cr2 = 'GMD-SMG';
		} else if ($region == 7) {
			$cr = '07';
			$cr2 = 'GMD-SLTG';
		}

		$next_inv = '';
		if (empty($count)) {
			$next_inv = '0001';
			$next_inv2 = 1;
		} else {

			$next_inv2 = $count->count + 1;
			$digit = strlen(trim($next_inv2));
			$selisih_gigit = (4 - $digit);
			$nol = '';
			for ($m = 0; $m < $selisih_gigit; $m++) {
				$nol .= '0';
			}
			$next_inv .= $nol . $next_inv2;
		}

		if (empty($tahun)) {
			$tahun = date("y");
			$tahun = date("y");
		} else {
			$tahun = substr($tahun, -2);
		}
		if (empty($bulan)) {
			$bulan = date("m");
		}
		if ($ppn == 1) {
			$next = $cr . '.' . $next_inv . '-' . $bulan . $tahun;
		} else {
			$next = $next_inv . '/' . $cr2 . '/' . $bulan . '/' . $tahun;
		}
		// echo $next;exit;
		if (empty($count)) {
			$this->insert_nomor('nomor', array('count' => $next_inv2, 'id_region' => $region, 'ppn' => $ppnflag, 'periode' => $date));
		} else {
			$this->update_arr('nomor', array('count' => $next_inv2), array('id_region' => $region, 'ppn' => $ppnflag, 'periode' => $date));
		}
		return $next;
	}

	function insert_nomor($table, $data, $lastid = '')
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$db1->insert($table, $data);
		$afftectedRows = $db1->affected_rows();
		$insertid = $db1->insert_id();
		if (!empty($lastid)) {
			return $insertid;
		} else {
			return $afftectedRows;
		}
	}

	function update_arr($table, $data, $arr)
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$db1->where($arr);
		$db1->update($table, $data);
	}

	function update1($table, $data, $id)
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$db1->where('id', $id);
		$db1->update($table, $data);
	}

	function last_no_invoice($region = '', $ppn = '', $flag = '', $date = '')
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$query = "SELECT 
					  * 
					FROM
					  nomor  
					WHERE id_region = '" . $region . "' 
					  AND ppn = '" . $ppn . "' 
					  AND status != '9' 
					  AND periode = '" . $date . "'";
		return $db1->query($query);
	}

	function update_gl($table, $data, $id)
	{
		$this->db->where('no_trans', $id);
		$this->db->update($table, $data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
	}

	function select($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$query = $q = $alamat = null;
		$q = $db->query("SELECT
		a.`id` AS arpost,
		a.`flag`,
		a.`tanggal_invoice`,
		a.`periode_dari`,
		a.`periode_sampai`,
		a.`due_date`,
		b.`id`,
		b.`id_order`,
		b.`id_cust`,
		i.`idcust`,
		j.`id` AS id_site,
		b.`id_order_service`,
		i.`nama` AS nama_cust,
		i.`idcust`,
		j.`nama` AS nama_site,
		l.`address_display` AS id_address,
		l.`attention_display` AS id_contact,
		IF(a.`id_contact` = 0, j.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, j.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, j.`emailwakil`,k.`email`) AS email,
		j.`taxno`,
		b.`nomor`,
		l.`label_note`,
		b.`tanggal`,
		b.`nominal`,
		b.`jenis_transaksi`,
		CASE
		  WHEN b.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN b.`jenis_transaksi` = 'MT'
		  OR b.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN b.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN b.`jenis_transaksi` = 'LG'
		  THEN e.`label`
		  WHEN b.`jenis_transaksi` = 'LL'
		  THEN d.`layanan`
		  WHEN b.`jenis_transaksi` = 'BR'
		  THEN h.`nama_barang`
		  WHEN b.`jenis_transaksi` = 'BJ'
		  THEN g.`service`
		  WHEN b.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		IF(b.`jenis_transaksi` = 'PN',ROUND(b.`nominal`,2),0) AS ppnnya,
		b.`status`,
		b.`timestamp`,
		c.`servid`,
		ROUND(m.ppn,0) AS ppn
	  FROM
		arpost a
		LEFT JOIN transaksi b
		  ON a.`nomor` = b.`nomor`
		  AND a.`id_order` = b.`id_order`
		LEFT JOIN order_service c
		  ON b.`id_order_service` = c.`id`
		LEFT JOIN order_lain d
		  ON b.`id_order` = d.`id_order`
		LEFT JOIN ms_layanan e
		  ON c.`id_serv` = e.`id`
		LEFT JOIN order_barang f
		  ON b.`id_order` = f.`id_order`
		LEFT JOIN order_jasa g
		  ON g.`id_order` = b.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang` = h.`id_header`
		LEFT JOIN ms_customers i
		ON a.`id_cust`=i.`id`
		LEFT JOIN order_header l
		ON a.`id_order`=l.`id`
		LEFT JOIN ms_site j
		ON l.`id_site`=j.`id`
		LEFT JOIN ms_contact k
		ON k.`id`=a.`id_contact`
		LEFT JOIN (SELECT nomor,SUM(COALESCE(nominal,0)) AS ppn FROM transaksi WHERE  transaksi.`jenis_transaksi`='PN' AND transaksi.`status`=1 GROUP BY transaksi.nomor) m ON m.nomor=b.nomor
	  WHERE a.`status` = 1
		AND b.`status` = 1
		AND a.`merge` IS NULL
		  AND a.`id` = $id
		GROUP BY b.`id`");

		$query = $db->query("SELECT * FROM arpost a JOIN order_header b ON a.`id_order`=b.`id` JOIN ms_site c ON b.`id_site`=c.`id` WHERE c.`status`=1 AND a.`id`=$id")->row();
		$alamat .= '<label>Alamat</label>
		<select class="form-control" type="text" id="alamat" name="alamat">';
		if (!empty($query->alamat) && !empty($query->kota)) {
			$alamat .= '<option value="1">' . $query->alamat . ' , ' . $query->kota . '</option>';
		} elseif (!empty($query->alamat)) {
			$alamat .= '<option value="1">' . $query->alamat . '</option>';
		}
		if (!empty($query->alamat2)) {
			$alamat .= '<option value="2">' . $query->alamat2 . ' , ' . $query->kota2 . '</option>';
		} elseif (!empty($query->alamat2)) {
			$alamat .= '<option value="2">' . $query->alamat2 . '</option>';
		}
		if (!empty($query->alamat3)) {
			$alamat .= '<option value="3">' . $query->alamat3 . ' , ' . $query->kota3 . '</option>';
		} elseif (!empty($query->alamat3)) {
			$alamat .= '<option value="3">' . $query->alamat3 . '</option>';
		}
		$alamat .= '</select>
    	</div>';
		$data = array('alamat' => $alamat, 'data' => json_encode($q->result()));
		return $data;
	}

	function select_merge($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$q = $db->query("SELECT
		a.`id_arpost_merge` AS armerge,
		a.`id` AS arpost,
		a.`flag`,
		c.`id`,
		c.`id_order`,
		c.`id_cust`,
		c.`id_order_service`,
		c.`nomor`,
		c.`tanggal`,
		c.`nominal`,
		c.`jenis_transaksi`,
		CASE
		  WHEN c.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN c.`jenis_transaksi` = 'MT' OR c.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN c.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN c.`jenis_transaksi` = 'LG'
		  THEN f.`label`
		  WHEN c.`jenis_transaksi` = 'LL'
		  THEN e.`layanan`
		  WHEN c.`jenis_transaksi` = 'BR'
		  THEN j.`nama_barang`
		  WHEN c.`jenis_transaksi` = 'BJ'
		  THEN h.`service`
		  WHEN c.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		c.`status`,
		c.`timestamp`
		FROM (SELECT b.`id_arpost_merge`,a.`id`,a.`id_order`,a.`nomor`,a.`status`,b.`status` AS merge_status,a.`flag` FROM arpost a JOIN arpost_merge b ON a.`id`=b.`id_arpost`) a 
		LEFT JOIN transaksi c
		ON a.`id_order`=c.`id_order` AND a.`nomor`=c.`nomor`
		LEFT JOIN order_service d
		  ON c.`id_order_service` = d.`id`
		LEFT JOIN order_lain e
		  ON c.`id_order` = e.`id_order`
		LEFT JOIN ms_layanan f
		  ON d.`id_serv` = f.`id`
		LEFT JOIN order_barang g
		ON c.`id_order`=g.`id_order`
		LEFT JOIN order_jasa h
		ON h.`id_order`=c.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` j
		ON g.`id_barang`=j.`id_header`
		WHERE a.`status`=1 AND c.`status`=1 AND a.`merge_status`= 1 AND a.`id_arpost_merge`=$id
		GROUP BY c.`id`");
		return $q->result();
	}

	function invoice_belum_edit($id)
	{
		$this->db->trans_start();
		$data = array(
			'status_invoice' => 1,
		);
		$this->db->where('id', $id);
		$result = $this->db->update('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function invoice_sudah_edit($id)
	{
		$this->db->trans_start();
		$data = array(
			'status_invoice' => 0,
		);
		$this->db->where('id', $id);
		$result = $this->db->update('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function invoice_sudah_approve($id)
	{
		$this->db->trans_start();
		$data = array(
			//'status_invoice' => 2,
			'status_invoice' => 3,
			'date_printed' => date('Y-m-d H:i:s'),
		);
		$this->db->where('id', $id);
		$result = $this->db->update('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function invoice_sudah_print($id)
	{
		$this->db->trans_start();
		$data = array(
			'status_invoice' => 2,
			'date_printed' => '',
		);
		$this->db->where('id', $id);
		$result = $this->db->update('finance_invoice_customer', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		$this->db->trans_complete();
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

		$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_invoice_billing 
		where no_invoice = '" . $id . "'");
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
		if (!empty($this->input->post('searchTerm'))) {
			$this->db->select("a.*, if(a.cid = 0, b.nama, c.nama) as customer_group_name, 
		FORMAT(a.bandwith, 0) as bandwith, FORMAT(a.colocation, 0) as colocation, FORMAT(a.instalasi, 0) as instalasi, FORMAT(a.perangkat, 0) as perangkat, FORMAT(a.lain2, 0) as lain2", false);
			$this->db->from("finance_customer_service2 a");
			$this->db->join('finance_customer2 b', 'a.customer_id = b.customer_id', 'left');
			$this->db->join('finance_customer2 c', "a.cid = c.id", 'left');
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$this->db->like('a.nama', '' . $this->input->post('searchTerm') . '');
			$this->db->where('a.status_service', '0');
			$this->db->group_by('a.customer_id', 'b.customer_id');
			$q = $this->db->get();
			$data2 = $q->result();
		} else {
			$this->db->select("a.*, if(a.cid = 0, b.nama, c.nama) as customer_group_name, 
		FORMAT(a.bandwith, 0) as bandwith, FORMAT(a.colocation, 0) as colocation, FORMAT(a.instalasi, 0) as instalasi, FORMAT(a.perangkat, 0) as perangkat, FORMAT(a.lain2, 0) as lain2", false);
			$this->db->from("finance_customer_service2 a");
			$this->db->join('finance_customer2 b', 'a.customer_id = b.customer_id', 'left');
			$this->db->join('finance_customer2 c', "a.cid = c.id", 'left');
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$this->db->where('a.status_service', '0');
			$this->db->group_by('a.customer_id', 'b.customer_id');
			$q = $this->db->get();
			$data2 = $q->result();
		}
		$data = array();
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->service_id, "text" => $row->nama);
		}
		return json_encode($data);
	}
	function select_autocomplite_service2()
	{
		$this->db->select("a.*, if(a.cid = 0, b.nama, c.nama) as customer_group_name, 
		FORMAT(a.bandwith, 0) as bandwith, FORMAT(a.colocation, 0) as colocation, FORMAT(a.instalasi, 0) as instalasi, FORMAT(a.perangkat, 0) as perangkat, FORMAT(a.lain2, 0) as lain2", false);
		$this->db->from("finance_customer_service2 a");
		$this->db->join('finance_customer2 b', 'a.customer_id = b.customer_id', 'left');
		$this->db->join('finance_customer2 c', "a.cid = c.id", 'left');
		//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
		//OR a.nama like '%".$this->input->post('term')."%'
		//OR b.customer_id like '%".$this->input->post('term')."%'
		//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
		$this->db->where('a.service_id', '' . $this->input->post('service_id_val') . '');
		$this->db->where('a.status_service', '0');
		$this->db->group_by('a.customer_id', 'b.customer_id');
		$q = $this->db->get();
		return $q->result();
	}

	function select_customer()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		if (!empty($this->input->post('searchTerm'))) {
			$db->select("a.id,a.nama,a.status,b.idcust");
			$db->from("ms_site a");
			$db->join("ms_customers b", "a.id_cust=b.id", "left");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->like('a.nama', '' . $this->input->post('searchTerm') . '');
			$db->where('a.status', '1');
			$q = $db->get();
			$data2 = $q->result();
		} else {
			$db->select("a.id,a.nama,a.status,b.idcust");
			$db->from("ms_site a");
			$db->join("ms_customers b", "a.id_cust=b.id", "left");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->where('a.status', '1');
			$q = $db->get();
			$data2 = $q->result();
		}
		$data = array();
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->id, "text" => $row->nama);
			$idcust = $row->idcust;
		}
		$data3 = array("hasil" => $data, "custid" => $idcust);
		return json_encode($data3);
	}

	function select_autocomplite_layanan()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		if (!empty($this->input->post('searchTerm'))) {
			$db->select("*");
			$db->from("ms_layanan");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->like('label', '' . $this->input->post('searchTerm') . '');
			$db->where('status', '1');
			$q = $db->get();
			$data2 = $q->result();
		} else {
			$db->select("*");
			$db->from("ms_layanan");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->where('status', '1');
			$q = $db->get();
			$data2 = $q->result();
		}
		$data = array();
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->label, "text" => $row->label);
		}
		return json_encode($data);
	}

	function select_autocomplite_layanan2()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		if (!empty($this->input->post('searchTerm'))) {
			$db->select("*");
			$db->from("ms_layanan");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->like('label', '' . $this->input->post('searchTerm') . '');
			$db->where('status', '1');
			$q = $db->get();
			$data2 = $q->result();
		} else {
			$db->select("*");
			$db->from("ms_layanan");
			//$this->db->where("(a.service_id like '%".$this->input->post('term')."%'
			//OR a.nama like '%".$this->input->post('term')."%'
			//OR b.customer_id like '%".$this->input->post('term')."%'
			//or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$db->where('status', '1');
			$q = $db->get();
			$data2 = $q->result();
		}
		$data = array();
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->label, "text" => $row->label);
		}
		return json_encode($data);
	}

	function select_autocomplite_service_add($id)
	{
		$data = '';

		$this->db->where('service_id', $id);
		$this->db->from('finance_customer_service_add');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$data .= '<tr class="remove">';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_produk[]" value="' . $r['description'] . '" /><br><input class="form-control" type="text" style="width:270px;" readonly="readonly" name="tambah_service_note[]" value="' . $r['note'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_bw[]" value="' . number_format($r['bw'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_instalasi[]" value="' . number_format($r['instalasi'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" readonly="readonly" name="tambah_lain2[]" value="' . number_format($r['lain2'], 0) . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" style="width:150px;" readonly="readonly" name="tambah_period[]" value="' . $r['periode_invoice'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;display:none"><input class="form-control" type="text" style="width:150px;" hidden="true" name="tambah_period[]" value="' . $r['tgl_awal'] . '" /></td>';
				$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
				$data .= '</tr>';
			}
		}
		$q->free_result();
		return $data;
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

	function select_data_detail_invoice()
	{
		$data = null;
		$id = $this->input->post('id');
		$q = $this->db->query("SELECT
		a.`id` AS arpost,
		a.`flag`,
		a.`tanggal_invoice`,
		a.`periode_dari`,
		a.`periode_sampai`,
		b.`id`,
		b.`id_order`,
		b.`id_cust`,
		b.`id_order_service`,
		i.`nama` AS nama_cust,
		i.`idcust`,
		j.`nama` AS nama_site,
		CASE
		WHEN a.`id_address`=1
		THEN j.`alamat`
		WHEN a.`id_address`=2
		THEN j.`alamat2`
		WHEN a.`id_address`=3
		THEN j.`alamat3`
		ELSE j.`alamat`
		END AS `alamat`,
		CASE
		WHEN a.`id_address`=1
		THEN j.`kota`
		WHEN a.`id_address`=2
		THEN j.`kota2`
		WHEN a.`id_address`=3
		THEN j.`kota3`
		ELSE j.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, j.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, j.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, j.`emailwakil`,k.`email`) AS email,
		j.`taxno`,
		b.`nomor`,
		b.`tanggal`,
		b.`nominal`,
		b.`jenis_transaksi`,
		b.`keterangan`,
		CASE
		  WHEN b.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN b.`jenis_transaksi` = 'MT'
		  OR b.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN b.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN b.`jenis_transaksi` = 'LG'
		  THEN e.`label`
		  WHEN b.`jenis_transaksi` = 'LL'
		  THEN d.`layanan`
		  WHEN b.`jenis_transaksi` = 'BR'
		  THEN h.`nama_barang`
		  WHEN b.`jenis_transaksi` = 'BJ'
		  THEN g.`service`
		  WHEN b.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		b.`status`,
		b.`timestamp`
	  FROM
		erp_gmedia.`arpost` a
		LEFT JOIN erp_gmedia.`transaksi` b
		  ON a.`nomor` = b.`nomor`
		  AND a.`id_order` = b.`id_order`
		LEFT JOIN erp_gmedia.`order_service` c
		  ON b.`id_order_service` = c.`id`
		LEFT JOIN erp_gmedia.`order_lain` d
		  ON b.`id_order` = d.`id_order`
		LEFT JOIN erp_gmedia.`ms_layanan` e
		  ON c.`id_serv` = e.`id`
		LEFT JOIN erp_gmedia.`order_barang` f
		  ON b.`id_order` = f.`id_order`
		LEFT JOIN erp_gmedia.`order_jasa` g
		  ON g.`id_order` = b.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang` = h.`id_header`
		LEFT JOIN erp_gmedia.`ms_customers` i
		ON a.`id_cust`=i.`id`
		LEFT JOIN erp_gmedia.`ms_site` j
		ON a.`id_site`=j.`id`
		LEFT JOIN erp_gmedia.`ms_contact` k
		ON a.`id_contact`=k.`id`
	  WHERE a.`status` = 1
		AND b.`status` = 1
		AND a.`merge` IS NULL
		AND a.`id` = $id
	  GROUP BY b.`id`");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				if ($r['jenis_transaksi'] == 'LG') {
					$data .= '<tr class="remove">';
					$data .= '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value="' . $r['id_order_service'] . '"><input type="hidden" name="tgl_transaksi[]" value="' . $r['tanggal'] . '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="LG">Layanan</option></select></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="' . $r['detail'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;width:200px"><input class="form-control" type="text" name="tambah_note[]" value="' . $r['keterangan'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" name="tambah_jumlah[]" value="' . number_format($r['nominal'], 0) . '" /></td>';
					$data .= '<td><button type="button" class="button">X</button></td>';
					$data .= '</tr>';
				} elseif ($r['jenis_transaksi'] == 'MT') {
					$data .= '<tr class="remove">';
					$data .= '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value="' . $r['id_order_service'] . '"><input type="hidden" name="tgl_transaksi[]" value="' . $r['tanggal'] . '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="MT">Materai</option></select></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="' . $r['detail'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;width:200px"><input class="form-control" type="text" name="tambah_note[]" value="' . $r['keterangan'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" name="tambah_jumlah[]" value="' . number_format($r['nominal'], 0) . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
					$data .= '</tr>';
				} elseif ($r['jenis_transaksi'] == 'BI') {
					$data .= '<tr class="remove">';
					$data .= '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value="' . $r['id_order_service'] . '"><input type="hidden" name="tgl_transaksi[]" value="' . $r['tanggal'] . '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="BI">Instalasi</option></select></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="' . $r['detail'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;width:200px"><input class="form-control" type="text" name="tambah_note[]" value="' . $r['keterangan'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" name="tambah_jumlah[]" value="' . number_format($r['nominal'], 0) . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
					$data .= '</tr>';
				} elseif ($r['jenis_transaksi'] == 'LL') {
					$data .= '<tr class="remove">';
					$data .= '<td style="vertical-align:middle;"><input type="hidden" name="order_service[]" value="' . $r['id_order_service'] . '"><input type="hidden" name="tgl_transaksi[]" value="' . $r['tanggal'] . '"><select class="form-control" type="text" name="pilih_tambah[]"><option value="LL">Lain-Lain</option></select></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" readonly="readonly" name="tambah_service_produk[]" value="' . $r['detail'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;width:200px"><input class="form-control" type="text" name="tambah_note[]" value="' . $r['keterangan'] . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><input class="form-control price" type="text" name="tambah_jumlah[]" value="' . number_format($r['nominal'], 0) . '" /></td>';
					$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
					$data .= '</tr>';
				} elseif ($r['jenis_transaksi'] == 'PN') {
					continue;
				}
				$data .= '</tr>';
			}
		}
		$q->free_result();
		return $data;
	}

	function invoice_info()
	{
		set_time_limit(0);
		$data = '';

		$q = $this->db->query("SELECT * FROM `gmd_finance_customer_service2` b WHERE NOT EXISTS
							(SELECT a.`id_site` AS service_id FROM `gmd_finance_invoice_customer_detail` a
							WHERE b.`service_id` = a.`id_site` AND " . date('m') . " = DATE_FORMAT(a.`date_invoice`, '%m')
							AND " . date('Y') . " = DATE_FORMAT(a.`date_invoice`, '%Y') ) AND b.`billing_cycle` <= 3 AND b.`status_service` = 0");
		// $this->db->select("a.*, 
		// date_format(a.date_invoice, '" . date('Y') . "-" . date('m') . "-%d') as date_invoicenya, 
		// date_format(a.date_due, '" . date('Y') . "-" . date('m') . "-%d') as date_duenya,
		// IF(a.ppn = 1, ((a.bandwith + a.colocation + a.instalasi + a.perangkat + a.lain2) * 0.1),0) as ppn,
		// COUNT(b.id) AS jml", false);
		// $this->db->where('a.branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		// //$this->db->where('a.date_invoice <=', ''.date('Y').'-'.date('m').'-'.date('t').'');
		// $this->db->where('a.date_invoice <', '' . date('Y') . '-' . date('m') . '-01');
		// $this->db->where('a.billing_cycle', '1');
		// $this->db->where('a.status_service', '0');
		// //$this->db->where("(a.billing_cycle = '1' OR (a.billing_cycle = '0' AND DATE_FORMAT(a.date_invoice, '%m%Y') = '".date('m').date('Y')."'))", NULL, FALSE);
		// $this->db->from('finance_customer_service2 AS a');
		// $this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		// AND '" . date('m') . "' = DATE_FORMAT(b.date_invoice, '%m') 
		// AND '" . date('Y') . "' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		// $this->db->order_by('a.service_id', 'desc');
		// $this->db->group_by('a.service_id');
		// $this->db->having('jml', '0');
		// $q = $this->db->get();
		// $this->db->trans_complete();
		if ($q->num_rows() != 0) {
			echo '<a href="' . base_url() . $this->uri->segment(1) . '/list_invoice"><em style="color:#ff0000;">Terdapat <strong>' . $q->num_rows() . '</strong> layanan belum terbit invoice dibulan <strong>' . date('M') . ' ' . date('Y') . '</strong></em></a>';
		} else {
			echo '<em>Semua layanan dibulan <strong>' . date('M') . ' ' . date('Y') . '</strong> telah terbit invoice</em>';
		}
	}


	//generate auto bag pembuatan id invoice
	function invoice_create_queue_id($bulan, $cust_id)
	{
		$invoice_cek = 0;
		$this->db->select("CONVERT(TRIM(LEADING '0' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(no_invoice, '/', -1), '.', 1)),SIGNED) AS no_urut", false);
		$this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(no_invoice, '/', 2), '/', -1) = '" . $cust_id . "'", NULL, FALSE);
		//$this->db->where("DATE_FORMAT(date_invoice, '%m%Y') = '042018'", NULL, FALSE);
		$this->db->order_by('no_urut', 'desc');
		$this->db->limit(1);
		$q = $this->db->get('finance_invoice_customer');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$code_queue = $r['no_urut'] + 1;
			}
		} else {
			$code_queue = 1;
		}

		$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);

		$invoice = 'INV/' . $cust_id . '/' . $code_queue_zero . '.' . $bulan;
		while ($invoice_cek < 1) {
			$this->db->where("no_invoice = '" . $invoice . "'", NULL, FALSE);
			$this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(no_invoice, '/', 2), '/', -1) = '" . $cust_id . "'", NULL, FALSE);
			$this->db->where("DATE_FORMAT(date_invoice, '%m%y') = '" . $bulan . "'", NULL, FALSE);
			$q = $this->db->get('finance_invoice_customer');
			if ($q->num_rows() == 0) {
				$invoice_cek = 1;
			} else {
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
				$invoice = 'INV/' . $cust_id . '/' . $code_queue_zero . '.' . $bulan;
			}
			$q->free_result();
		}
		return $invoice;
	}

	function invoice_create()
	{
		set_time_limit(0);
		$data = '';
		$date = date_create("" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-01");
		$date_finish = date_format($date, "t");

		$this->db->trans_start();
		$this->db->select("a.*, SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE(a.customer_id,'/','.'), '.', 2), '/', 1) AS cust_id,
		date_format('" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-01', '%m%y') as bulan_invoicenya, 
		date_format(a.date_invoice, '" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-%d') as date_invoicenya, 
		date_format(a.date_due, '" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "-%d') as date_duenya,
		IF(a.ppn = 1, round(((a.bandwith + coalesce(sum(e.bw),0)) + (a.colocation + coalesce(sum(e.colo),0)) + (a.instalasi + coalesce(sum(e.instalasi),0)) + 
		(a.perangkat + coalesce(sum(e.perangkat),0)) + (a.lain2 + coalesce(sum(e.lain2),0))) * 0.1),0) as ppn,
		COUNT(b.id) AS jml,
		if(a.mf_cycle = '1', a.mf, if(DATE_FORMAT(a.date_invoice, '%m%Y') = '" . $this->input->post('searchBulan') . $this->input->post('searchTahun') . "', a.mf, 0)) as mf", false);
		// $this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where('a.branch', 8);
		// $this->db->where('a.date_invoice >=', ''.$this->input->post('searchTahun').'-'.$this->input->post('searchBulan').'-01');
		// $this->db->where('a.date_invoice <=', ''.$this->input->post('searchTahun').'-'.$this->input->post('searchBulan').'-'.$date_finish.'');
		$this->db->where('a.date_invoice <', '' . $this->input->post('searchTahun') . '-' . $this->input->post('searchBulan') . '-01');
		$this->db->where('a.billing_cycle', '1');
		$this->db->where('a.status_service', '0');
		//$this->db->where("(a.billing_cycle = '1' OR (a.billing_cycle = '0' AND DATE_FORMAT(a.date_invoice, '%m%Y') = '".$this->input->post('searchBulan').$this->input->post('searchTahun')."'))", NULL, FALSE);
		$this->db->from('finance_customer_service2 AS a');
		$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		AND '" . $this->input->post('searchBulan') . "' = DATE_FORMAT(b.date_invoice, '%m') 
		AND '" . $this->input->post('searchTahun') . "' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->join('finance_customer_service_add e', 'a.id = e.service_id', 'left');
		//$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		//AND '03' = DATE_FORMAT(b.date_invoice, '%m') 
		//AND '2018' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->order_by('a.date_invoice', 'asc');
		$this->db->order_by('a.service_id', 'asc');
		$this->db->group_by('a.id');
		$this->db->having('jml', '0');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$inv = $this->invoice_create_queue_id($r['bulan_invoicenya'], $r['cust_id']);
				//$inv = 'INV/'.$cust_id.'/'.$urut_zero;
				$jumlah = $r['bandwith'] + $r['colocation'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'] + $r['ppn'];

				$datasql = "('" . $inv . "', '" . $r['date_invoicenya'] . "', '" . $r['date_duenya'] . "', '" . $r['service_id'] . "', '" . $r['product_description'] . "', '" . $r['bandwith'] . "', '" . $r['colocation'] . "', '" . $r['instalasi'] . "', '" . $r['perangkat'] . "', '" . $r['lain2'] . "', '" . $r['mf'] . "', '" . $r['ppn'] . "', '" . $jumlah . "', '" . date('Y-m-d H:i:s') . "', '" . $this->cek_id_regional($this->session->userdata('scope_area')) . "')";
				$this->db->query("insert into gmd_finance_invoice_customer (no_invoice, date_invoice, date_due, service_id, product_desc, bw, colo, instalasi, perangkat, lain2, mf, ppn, jumlah, date_create, branch) values " . $datasql . "");


				$this->db->where('service_id', $r['id']);
				$this->db->from('finance_customer_service_add');
				$this->db->order_by('id', 'asc');
				$qr = $this->db->get();
				if ($qr->num_rows() > 0) {
					foreach ($qr->result_array() as $kr => $rr) {
						$this->db->query("insert into gmd_finance_invoice_customer_add (no_invoice, description, note, bw, colo, instalasi, perangkat, lain2) values ((SELECT id FROM gmd_finance_invoice_customer WHERE no_invoice = '" . $inv . "' order by id asc limit 1), '" . $rr['description'] . "', '" . $rr['note'] . "', '" . $rr['bw'] . "', '" . $rr['colo'] . "', '" . $rr['instalasi'] . "', '" . $rr['perangkat'] . "', '" . $rr['lain2'] . "')");
					}
				}
			}
		}
		$q->free_result();
		$this->db->trans_complete();
		return 1;
	}

	function invoice_create_cust($cust_id, $serv_id, $bulan, $tahun, $tgl, $flag)
	{
		// $cust_id = '01.0790.0119';
		// $serv_id = 'P-rhsxqjv';
		// $bulan = '01';
		// $tahun = '2019';
		// $tgl = '16';
		// $flag = 'project';

		set_time_limit(0);
		$data = '';
		$date = date_create("" . $tahun . "-" . $bulan . "-01");
		$start_billing = $tahun . "-" . $bulan . "-" . $tgl;
		$date_finish = date_format($date, "t");


		$this->db->trans_start();
		$this->db->select("a.*, SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE(a.customer_id,'/','.'), '.', 2), '/', 1) AS cust_id,
		date_format('" . $tahun . "-" . $bulan . "-01', '%m%y') as bulan_invoicenya, 
		date_format(a.date_invoice, '" . $tahun . "-" . $bulan . "-%d') as date_invoicenya, 
		date_format(a.date_due, '" . $tahun . "-" . $bulan . "-%d') as date_duenya,
		IF(a.ppn = 1, round(((a.bandwith + coalesce(sum(e.bw),0)) + (a.colocation + coalesce(sum(e.colo),0)) + (a.instalasi + coalesce(sum(e.instalasi),0)) + 
		(a.perangkat + coalesce(sum(e.perangkat),0)) + (a.lain2 + coalesce(sum(e.lain2),0))) * 0.1),0) as ppn,
		COUNT(b.id) AS jml,
		if(a.mf_cycle = '1', a.mf, if(DATE_FORMAT(a.date_invoice, '%m%Y') = '" . $bulan . $tahun . "', a.mf, 0)) as mf", false);
		$this->db->where('a.branch', 8);
		$this->db->where('a.date_invoice >=', '' . $tahun . '-' . $bulan . '-01');
		$this->db->where('a.date_invoice <=', '' . $tahun . '-' . $bulan . '-' . $date_finish);
		$this->db->where('a.status_service', '0');
		$this->db->where('a.service_id', $serv_id);
		if ($flag == 'so') {
			$this->db->where('a.billing_cycle', '1');
		} else {
			$this->db->where('a.billing_cycle', '0');
		}
		$this->db->where('a.customer_id', $cust_id);
		$this->db->from('finance_customer_service2 AS a');
		$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		AND '" . $bulan . "' = DATE_FORMAT(b.date_invoice, '%m') 
		AND '" . $tahun . "' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->join('finance_customer_service_add e', 'a.id = e.service_id', 'left');
		$this->db->order_by('a.date_invoice', 'asc');
		$this->db->order_by('a.service_id', 'asc');
		$this->db->group_by('a.id');
		$this->db->having('jml', '0');
		$q = $this->db->get();
		// print_r($q->result_array());exit;
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$prorate = 0;
				if ($flag == 'so') {
					//PRORATE//////////////////////
					$arr = explode('-', $start_billing);
					$hari = cal_days_in_month(CAL_GREGORIAN, $arr[1], $arr[0]);
					$prorate = 0;
					$prorate = ((($hari - $arr[2]) + 1) / $hari) * ($r['bandwith']);
					$prorate = $this->round_up($prorate);
					//////////////////////////////
				}
				$inv = $this->invoice_create_queue_id($r['bulan_invoicenya'], $r['cust_id']);

				// $jumlah = $r['bandwith'] + $r['colocation'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'] + $r['ppn'];
				$jumlah = $prorate + $r['colocation'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'] + $r['ppn'];


				$datasql = "('" . $inv . "', '" . $r['date_invoicenya'] . "', '" . $r['date_duenya'] . "', '" . $r['service_id'] . "', '" . $r['product_description'] . "', '" . $prorate . "', '" . $r['colocation'] . "', '" . $r['instalasi'] . "', '" . $r['perangkat'] . "', '" . $r['lain2'] . "', '" . $r['mf'] . "', '" . $r['ppn'] . "', '" . $jumlah . "', '" . date('Y-m-d H:i:s') . "', '8')";
				$this->db->query("insert into gmd_finance_invoice_customer (no_invoice, date_invoice, date_due, service_id, product_desc, bw, colo, instalasi, perangkat, lain2, mf, ppn, jumlah, date_create, branch) values " . $datasql . "");


				$this->db->where('service_id', $r['id']);
				$this->db->from('finance_customer_service_add');
				$this->db->order_by('id', 'asc');
				$qr = $this->db->get();
				// print_r($qr->result_array());exit;
				if ($qr->num_rows() > 0) {
					foreach ($qr->result_array() as $kr => $rr) {
						$this->db->query("insert into gmd_finance_invoice_customer_add (no_invoice, description, note, bw, colo, instalasi, perangkat, lain2) values ((SELECT id FROM gmd_finance_invoice_customer WHERE no_invoice = '" . $inv . "' order by id asc limit 1), '" . $rr['description'] . "', '" . $rr['note'] . "', '" . $rr['bw'] . "', '" . $rr['colo'] . "', '" . $rr['instalasi'] . "', '" . $rr['perangkat'] . "', '" . $rr['lain2'] . "')");

						if ($rr['description'] == 'Biaya Instalasi') {
							$this->db->query("delete from gmd_finance_invoice_customer_add where id = '" . $rr['id'] . "'");
						}
					}
				}
			}
		}
		$q->free_result();
		$this->db->trans_complete();
		return 1;
	}

	function invoice_create_cust_test()
	{
		$cust_id = '01.0790.0119';
		$serv_id = '';
		$bulan = '01';
		$tahun = '2019';
		$tgl = '16';
		$flag = 'project';
		set_time_limit(0);
		$data = '';
		$date = date_create("" . $tahun . "-" . $bulan . "-01");
		$start_billing = $tahun . "-" . $bulan . "-" . $tgl;
		$date_finish = date_format($date, "t");

		$this->db->trans_start();
		$this->db->select("a.*, SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE(a.customer_id,'/','.'), '.', 2), '/', 1) AS cust_id,
		date_format('" . $tahun . "-" . $bulan . "-01', '%m%y') as bulan_invoicenya, 
		date_format(a.date_invoice, '" . $tahun . "-" . $bulan . "-%d') as date_invoicenya, 
		date_format(a.date_due, '" . $tahun . "-" . $bulan . "-%d') as date_duenya,
		IF(a.ppn = 1, round(((a.bandwith + coalesce(sum(e.bw),0)) + (a.colocation + coalesce(sum(e.colo),0)) + (a.instalasi + coalesce(sum(e.instalasi),0)) + 
		(a.perangkat + coalesce(sum(e.perangkat),0)) + (a.lain2 + coalesce(sum(e.lain2),0))) * 0.1),0) as ppn,
		COUNT(b.id) AS jml,
		if(a.mf_cycle = '1', a.mf, if(DATE_FORMAT(a.date_invoice, '%m%Y') = '" . $bulan . $tahun . "', a.mf, 0)) as mf", false);
		$this->db->where('a.branch', 8);
		$this->db->where('a.date_invoice >=', '' . $tahun . '-' . $bulan . '-01');
		$this->db->where('a.date_invoice <=', '' . $tahun . '-' . $bulan . '-' . $date_finish);
		$this->db->where('a.status_service', '0');
		if ($flag == 'so') {
			$this->db->where('a.billing_cycle', '1');
			$this->db->where('a.service_id', $serv_id);
		} else {
			$this->db->where('a.billing_cycle', '0');
			$this->db->where('a.service_id', '');
		}
		$this->db->where('a.customer_id', $cust_id);
		$this->db->from('finance_customer_service2 AS a');
		$this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
		AND '" . $bulan . "' = DATE_FORMAT(b.date_invoice, '%m') 
		AND '" . $tahun . "' = DATE_FORMAT(b.date_invoice, '%Y')", 'left');
		$this->db->join('finance_customer_service_add e', 'a.id = e.service_id', 'left');
		$this->db->order_by('a.date_invoice', 'asc');
		$this->db->order_by('a.service_id', 'asc');
		$this->db->group_by('a.id');
		$this->db->having('jml', '0');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $k => $r) {
				$prorate = 0;
				if ($flag == 'so') {
					//PRORATE//////////////////////
					$arr = explode('-', $start_billing);
					$hari = cal_days_in_month(CAL_GREGORIAN, $arr[1], $arr[0]);
					$prorate = 0;
					$prorate = ((($hari - $arr[2]) + 1) / $hari) * ($r['bandwith']);
					$prorate = $this->round_up($prorate);
					//////////////////////////////
				}
				$inv = $this->invoice_create_queue_id($r['bulan_invoicenya'], $r['cust_id']);

				// $jumlah = $r['bandwith'] + $r['colocation'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'] + $r['ppn'];
				$jumlah = $prorate + $r['colocation'] + $r['instalasi'] + $r['perangkat'] + $r['lain2'] + $r['ppn'];


				$datasql = "('" . $inv . "', '" . $r['date_invoicenya'] . "', '" . $r['date_duenya'] . "', '" . $r['service_id'] . "', '" . $r['product_description'] . "', '" . $prorate . "', '" . $r['colocation'] . "', '" . $r['instalasi'] . "', '" . $r['perangkat'] . "', '" . $r['lain2'] . "', '" . $r['mf'] . "', '" . $r['ppn'] . "', '" . $jumlah . "', '" . date('Y-m-d H:i:s') . "', '8')";
				$this->db->query("insert into gmd_finance_invoice_customer (no_invoice, date_invoice, date_due, service_id, product_desc, bw, colo, instalasi, perangkat, lain2, mf, ppn, jumlah, date_create, branch) values " . $datasql . "");


				$this->db->where('service_id', $r['id']);
				$this->db->from('finance_customer_service_add');
				$this->db->order_by('id', 'asc');
				$qr = $this->db->get();
				// print_r($qr->result_array());exit;
				if ($qr->num_rows() > 0) {
					foreach ($qr->result_array() as $kr => $rr) {
						$this->db->query("insert into gmd_finance_invoice_customer_add (no_invoice, description, note, bw, colo, instalasi, perangkat, lain2) values ((SELECT id FROM gmd_finance_invoice_customer WHERE no_invoice = '" . $inv . "' order by id asc limit 1), '" . $rr['description'] . "', '" . $rr['note'] . "', '" . $rr['bw'] . "', '" . $rr['colo'] . "', '" . $rr['instalasi'] . "', '" . $rr['perangkat'] . "', '" . $rr['lain2'] . "')");

						if ($rr['description'] == 'Biaya Instalasi') {
							$this->db->query("delete from gmd_finance_invoice_customer_add where id = '" . $rr['id'] . "'");
						}
					}
				}
			}
		}
		$q->free_result();
		$this->db->trans_complete();
		return 1;
	}

	function invoice_delete()
	{

		$this->db->trans_start();
		$msg = '';
		$this->db->select('id');
		$this->db->where("DATE_FORMAT(date_invoice, '%Y-%m') = '" . $this->input->post('searchTahun') . "-" . $this->input->post('searchBulan') . "'", NULL, FALSE);
		$this->db->where("bayar", '0');
		$this->db->where("manual", '0');
		$this->db->from('finance_invoice_customer');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$this->db->where('id', $r['id']);
				$result = $this->db->delete('finance_invoice_customer');

				$this->db->where('no_invoice', $r['id']);
				$this->db->delete('finance_invoice_customer_add');

				$msg = 1;
			}
		}
		$q->free_result();






		//$dn = '2';
		//$qd = $this->db->query("delete from gmd_finance_invoice_customer where DATE_FORMAT(date_invoice, '%Y-%m') = '".$this->input->post('searchTahun')."-".$this->input->post('searchBulan')."' and bayar = '0' and manual = '0'");
		//$qd = $this->db->query("delete from gmd_finance_invoice_customer where DATE_FORMAT(date_invoice, '%Y-%m') = '2018-03';");
		//$qd->free_result();
		//$dn = $data;

		$this->db->trans_complete();
		return 1;

		//return $this->input->post('searchTahun')."-".$this->input->post('searchBulan');
	}

	function select_data()
	{
		$this->db->select("a.*, 
		b.customer_id, 
		if(b.invoice_name = '', b.nama, b.invoice_name) as nama,
		if(b.invoice_address = '', b.alamat, b.invoice_address) as alamat,
		if(b.invoice_phone = '', b.telp, b.invoice_phone) as telp,
		if(b.invoice_attention = '', b.cp, b.invoice_attention) as cp,
		if(a.jenis_potongan = 0, 'Diskon', 'Potongan') as jenis_potongan,
		if(b.ppn = 1 AND b.jenis_ppn = 0,1,0) as ppnnya, if(b.ppn = 1 AND b.jenis_ppn = 1,1,0) as jenis_ppn, 
		b.barcode, b.kategori, b.produk, b.product_description, b.payment_to, c.nama as customer_group_name, 
		date_format(a.date_invoice, '%d-%m-%Y') as date_invoicenya, 
		date_format(a.date_due, '%d-%m-%Y') as date_duenya, 
		date_format(LAST_DAY(a.date_invoice),'%d') as product_note_last_day,
		date_format(a.date_invoice,'%m') as product_note_m,
		date_format(a.date_invoice, '%Y') as product_note_y, 
		floor((a.bw + a.colo + a.instalasi + a.perangkat + a.lain2) * 0.1) as ppn_head,
		(1 + COALESCE((SELECT COUNT(id) FROM gmd_finance_invoice_customer_add WHERE no_invoice = a.id), 0)) as jml_det,
		b.ppn as ppn_tax", false);
		$this->db->from('finance_invoice_customer a');
		$this->db->join('finance_customer_service2 as b', 'a.service_id = b.service_id', 'left');
		$this->db->join('finance_customer2 as c', 'b.customer_id = c.customer_id', 'left');
		$this->db->where("a.id", $this->uri->segment(3));
		$this->db->limit('1');
		$q = $this->db->get();
		return $q;
	}
	function round_up($value, $places = 0)
	{
		// echo 'a2';exit;
		$mult = pow(10, abs($places));
		return $places < 0 ?
			ceil($value / $mult) * $mult : ceil($value * $mult) / $mult;
	}
	function get_total()
	{
		return $this->db->query('SELECT SUM(a.`jumlah`) AS jumlah FROM `gmd_finance_invoice_customer` a LEFT JOIN `gmd_finance_customer_service2` b ON a.`service_id`=b.`service_id` WHERE lunas!=1')->row();
	}

	function get_ppn($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->select('b.ppn');
		$db->from('arpost a');
		$db->join('order_header b', 'a.id_order=b.id', 'LEFT');
		$db->where('a.id', $id);
		$q = $db->get();
		$ppn = $q->row();
		if (!empty($ppn)) {
			return $ppn->ppn;
		} else {
			return false;
		}
	}

	function get_ppn_merge($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->select('ppn');
		$db->from('arpost');
		$db->where('id', $id);
		$q = $db->get();
		$ppn = $q->row();
		if (!empty($ppn)) {
			return $ppn->ppn;
		} else {
			return false;
		}
	}

	function get_data_cetak($id)
	{
		return $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`id`=$id")->result();
	}

	function get_data_detail_project($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		return $db->query("SELECT
		'' AS armerge,
		  a.`id` AS arpost,
		  a.`flag`,
		  b.`id`,
		  b.`id_order`,
		  b.`id_cust`,
		  b.`id_order_service`,
		  b.`nomor`,
		  b.`tanggal`,
		  b.`nominal`,
		  b.`jenis_transaksi`,
		  c.`servid`,
		  CASE
			WHEN b.`jenis_transaksi` = 'PN'
			THEN 'Biaya PPN'
			WHEN b.`jenis_transaksi` = 'MT' OR b.`jenis_transaksi` = 'MB'
			THEN 'Biaya Materai'
			WHEN b.`jenis_transaksi` = 'BI'
			THEN 'Biaya Instalasi'
			WHEN b.`jenis_transaksi` = 'LG'
			THEN e.`label`
			WHEN b.`jenis_transaksi` = 'LL'
			THEN d.`layanan`
			WHEN b.`jenis_transaksi` = 'BR'
			THEN h.`nama_barang`
			WHEN b.`jenis_transaksi` = 'BJ'
			THEN g.`service`
			WHEN b.`jenis_transaksi` = 'PB'
			THEN 'Pembayaran'
		  END AS detail,
		  b.`status`,
		  b.`timestamp`,
		  CASE
		WHEN a.`id_address`=1
		THEN i.`kota`
		WHEN a.`id_address`=2
		THEN i.`kota2`
		WHEN a.`id_address`=3
		THEN i.`kota3`
		ELSE i.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, i.`wakil`,l.`nama`) AS attention,
		IF(a.`id_contact` = 0, i.`phonewakil`,l.`phone`) AS phone,
		IF(a.`id_contact` = 0, i.`emailwakil`,l.`email`) AS email,
		CASE
		WHEN a.`id_address`=1
		THEN i.`alamat`
		WHEN a.`id_address`=2
		THEN i.`alamat2`
		WHEN a.`id_address`=3
		THEN i.`alamat3`
		ELSE i.`alamat`
		END AS `alamat`,
		CASE
		WHEN a.`id_header`=1
		THEN i.`nama`
		WHEN a.`id_header`=2
		THEN j.`nama`
		WHEN a.`id_header`=3
		THEN CONCAT(j.`nama`,' | ',i.`nama`)
		END AS nama,
		 j.`idcust` AS cust_id,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai` 
		FROM
		  arpost a
		  LEFT JOIN transaksi b
			ON a.`nomor` = b.`nomor`
			AND a.`id_order` = b.`id_order`
		  LEFT JOIN order_service c
			ON b.`id_order_service` = c.`id`
		  LEFT JOIN order_lain d
			ON b.`id_order` = d.`id_order`
		  LEFT JOIN ms_layanan e
			ON c.`id_serv` = e.`id`
		  LEFT JOIN order_barang f
		  ON b.`id_order`=f.`id_order`
		  LEFT JOIN order_jasa g
		  ON g.`id_order`=b.`id_order`
		  LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang`=h.`id_header`
		  LEFT JOIN order_header k
		  ON a.`id_order`=k.`id`
		  LEFT JOIN ms_site i
		  ON k.`id_site`=i.`id`
		  LEFT JOIN ms_customers j
		  ON a.`id_cust`=j.`id`
		  LEFT JOIN ms_contact l
		  ON l.`id`=a.`id_contact`
		WHERE a.`status` = 1
		  AND b.`status` = 1
		  AND a.`merge` IS NULL
		  AND a.`id` = $id
		GROUP BY b.`id` ORDER BY b.`jenis_transaksi`,c.`servid`")->result();
	}

	function get_data_detail($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		return $db->query("SELECT ret.armerge,ret.arpost,ret.flag,id,ret.id_order,ret.id_cust,ret.id_order_service,
		ret.nomor,ret.tanggal,SUM(ret.nominal) AS nominal,ret.jenis_transaksi,ret.servid,ret.detail,ret.keterangan,ret.status,ret.timestamp,ret.kota,ret.attention,
		ret.phone,ret.email,ret.alamat,ret.nama,ret.cust_id,ret.tanggal_invoice,ret.due_date,ret.periode_dari,ret.periode_sampai,ret.voucher,ret.nilai_voucher FROM (
			SELECT
		'' AS armerge,
		  a.`id` AS arpost,
		  a.`flag`,
		  b.`id`,
		  b.`id_order`,
		  b.`id_cust`,
		  b.`id_order_service`,
		  b.`nomor`,
		  b.`tanggal`,
		  b.`nominal`,
		  b.`jenis_transaksi`,
		  c.`servid`,
		  CASE
			WHEN b.`jenis_transaksi` = 'PN'
			THEN 'Biaya PPN'
			WHEN b.`jenis_transaksi` = 'MT' OR b.`jenis_transaksi` = 'MB'
			THEN 'Biaya Materai'
			WHEN b.`jenis_transaksi` = 'BI'
			THEN 'Biaya Instalasi'
			WHEN b.`jenis_transaksi` = 'LG'
			THEN e.`label`
			WHEN b.`jenis_transaksi` = 'LL'
			THEN d.`layanan`
			WHEN b.`jenis_transaksi` = 'BR'
			THEN h.`nama_barang`
			WHEN b.`jenis_transaksi` = 'BJ'
			THEN g.`service`
			WHEN b.`jenis_transaksi` = 'PB'
			THEN 'Pembayaran'
		  END AS detail,
		  b.`keterangan`,
		  b.`status`,
		  b.`timestamp`,
		CASE
		WHEN a.`id_address`=1
		THEN i.`kota`
		WHEN a.`id_address`=2
		THEN i.`kota2`
		WHEN a.`id_address`=3
		THEN i.`kota3`
		ELSE i.`kota`
		END AS `kota`,
		IF(a.`id_contact` = 0, i.`wakil`,k.`nama`) AS attention,
		IF(a.`id_contact` = 0, i.`phonewakil`,k.`phone`) AS phone,
		IF(a.`id_contact` = 0, i.`emailwakil`,k.`email`) AS email,
		CASE
		WHEN a.`id_address`=1
		THEN i.`alamat`
		WHEN a.`id_address`=2
		THEN i.`alamat2`
		WHEN a.`id_address`=3
		THEN i.`alamat3`
		ELSE i.`alamat`
		END AS `alamat`,
		CASE
		WHEN a.`id_header`=1
		THEN i.`nama`
		WHEN a.`id_header`=2
		THEN j.`nama`
		WHEN a.`id_header`=3
		THEN CONCAT(j.`nama`,' | ',i.`nama`)
		END AS nama,
		 j.`idcust` AS cust_id,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai`,i.`voucher`,l.`nilai_voucher`
		FROM
		  arpost a
		  LEFT JOIN transaksi b
			ON a.`nomor` = b.`nomor`
			AND a.`id_order` = b.`id_order`
		  LEFT JOIN order_service c
			ON b.`id_order_service` = c.`id`
		  LEFT JOIN order_lain d
			ON b.`id_order` = d.`id_order`
		  LEFT JOIN ms_layanan e
			ON c.`id_serv` = e.`id`
		  LEFT JOIN order_barang f
		  ON b.`id_order`=f.`id_order`
		  LEFT JOIN order_jasa g
		  ON g.`id_order`=b.`id_order`
		  LEFT JOIN inventory_v2.`ms_header_barang` h
		  ON f.`id_barang`=h.`id_header`
		  LEFT JOIN ms_site i
		  ON a.`id_site`=i.`id`
		  LEFT JOIN ms_customers j
		  ON a.`id_cust`=j.`id`
		  LEFT JOIN ms_contact k
		  ON a.`id_contact`=k.`id`
		  LEFT JOIN order_header l
		  ON a.`id_order`=l.`id`
		WHERE a.`status` = 1
		  AND b.`status` = 1
		  AND a.`merge` IS NULL
		  AND a.`id` = $id
		GROUP BY b.`id` ORDER BY b.`jenis_transaksi`,c.`servid`) ret GROUP BY ret.`jenis_transaksi`,ret.`servid` ")->result();
	}

	function get_data_detail_merge($id)
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		return $db->query("SELECT
		a.`id_arpost_merge` AS armerge,
		a.`id` AS arpost,
		a.`flag`,
		c.`id`,
		c.`id_order`,
		c.`id_cust`,
		c.`id_order_service`,
		(SELECT aa.`nomor` FROM arpost aa WHERE id=$id) AS nomor,
		c.`tanggal`,
		c.`nominal`,
		c.`jenis_transaksi`,
		d.`servid`,
		CASE
		  WHEN c.`jenis_transaksi` = 'PN'
		  THEN 'Biaya PPN'
		  WHEN c.`jenis_transaksi` = 'MT' OR c.`jenis_transaksi` = 'MB'
		  THEN 'Biaya Materai'
		  WHEN c.`jenis_transaksi` = 'BI'
		  THEN 'Biaya Instalasi'
		  WHEN c.`jenis_transaksi` = 'LG'
		  THEN f.`label`
		  WHEN c.`jenis_transaksi` = 'LL'
		  THEN e.`layanan`
		  WHEN c.`jenis_transaksi` = 'BR'
		  THEN j.`nama_barang`
		  WHEN c.`jenis_transaksi` = 'BJ'
		  THEN h.`service`
		  WHEN c.`jenis_transaksi` = 'PB'
		  THEN 'Pembayaran'
		END AS detail,
		(SELECT b.`label_note` FROM order_header b WHERE b.`id`=c.`id_order`) AS keterangan,
		c.`status`,
		c.`timestamp`,
		a.`to_site`,
		i.`attention_display`,
		CASE 
		WHEN i.`attention_display`=0
		THEN k.`wakil`
		WHEN i.`attention_display`>0
		THEN j.`nama`
		END AS attention,
		 CASE 
		WHEN i.`attention_display`=0
		THEN k.`phonewakil`
		WHEN i.`attention_display`>0
		THEN j.`phone`
		END AS phone,
		 CASE 
		WHEN i.`attention_display`=0
		THEN k.`emailwakil`
		WHEN i.`attention_display`>0
		THEN j.`email`
		END AS email,
		(SELECT CASE 
		WHEN a.`id_address`=1 THEN b.`alamat`
		WHEN a.`id_address`=2 THEN b.`alamat2`
		WHEN a.`id_address`=3 THEN b.`alamat3`
		ELSE b.`alamat2`
		END AS alamat FROM arpost a JOIN ms_site b ON a.`to_site`=b.`id` WHERE a.`id`=$id) alamat,
		k.`kota2` AS kota,
		(SELECT aa.`tanggal_invoice` FROM arpost aa WHERE id=$id) AS tanggal_invoice,
		(SELECT aa.`due_date` FROM arpost aa WHERE id=$id) AS due_date,
		(SELECT CASE 
		WHEN a.`id_header`=1 THEN b.`nama`
		WHEN a.`id_header`=2 THEN c.`nama`
		WHEN a.`id_header`=3 THEN CONCAT(c.`nama`,' | ',b.`nama`)
		END AS nama FROM arpost a JOIN ms_site b ON a.`to_site`=b.`id` JOIN ms_customers c ON b.`id_cust`=c.`id` WHERE a.`id`=$id) nama,
		l.`idcust` AS cust_id,a.`periode_dari`,a.`periode_sampai`,k.`voucher`,i.`nilai_voucher`
		FROM (SELECT b.`id_arpost_merge`,a.`id`,a.`id_order`,a.`nomor`,a.`status`,b.`status` AS merge_status,a.`flag`,
		a.`to_site`,a.`tanggal_invoice`,a.`due_date`,a.`periode_dari`,a.`periode_sampai`,a.`id_address`
		FROM arpost a 
		JOIN arpost_merge b ON a.`id`=b.`id_arpost` WHERE b.`status`=1 AND a.`status`=1) a 
		LEFT JOIN transaksi c
		ON a.`id_order`=c.`id_order` AND a.`nomor`=c.`nomor`
		LEFT JOIN order_service d
		  ON c.`id_order_service` = d.`id`
		LEFT JOIN order_lain e
		  ON c.`id_order` = e.`id_order`
		LEFT JOIN ms_layanan f
		  ON d.`id_serv` = f.`id`
		LEFT JOIN order_barang g
		ON c.`id_order`=g.`id_order`
		LEFT JOIN order_jasa h
		ON h.`id_order`=c.`id_order`
		LEFT JOIN inventory_v2.`ms_header_barang` j
		ON g.`id_barang`=j.`id_header`
		LEFT JOIN order_header i
		ON i.`id_site`=a.`to_site`
		LEFT JOIN ms_contact j
		ON i.`attention_display` = j.`id`
		LEFT JOIN ms_site k
		ON k.`id`=a.`to_site`
		LEFT JOIN ms_customers l
		ON c.`id_cust`=l.`id`
		WHERE a.`status`=1 AND c.`status`=1 AND a.`merge_status`= 1 AND a.`id_arpost_merge`=$id
		GROUP BY c.`id` ORDER BY a.`periode_dari`,c.`jenis_transaksi`,d.`servid`")->result();
	}

	function get_data_lain($id_order)
	{
		return $this->db->query("SELECT a.`layanan` AS detail,a.`biaya` AS nominal FROM erp_gmedia.`order_lain` a WHERE a.`status`=1 AND a.`id_order` = $id_order")->result();
	}

	function update_inv($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('finance_invoice_customer', $data);
	}

	function get_faktur_kosong()
	{
		$this->db->select('count(no_faktur) AS no_faktur');
		$this->db->where('status', 0);
		$this->db->from('finance_tax_nomor');
		$q = $this->db->get();
		$nofak = $q->row();
		if (!empty($nofak)) {
			return $nofak->no_faktur;
		} else {
			return false;
		}
	}

	function get_faktur()
	{
		$this->db->select('*');
		$this->db->where('status', 0);
		$this->db->from('finance_tax_nomor');
		$this->db->order_by('id', 'ASC');
		$this->db->LIMIT(1);
		return $this->db->get();
	}

	function get_customer_id($id)
	{
		$this->db->select('id');
		$q = $this->db->query('SELECT b.`idcust` FROM erp_gmedia.`ms_site` a JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id` WHERE a.`id`=' . $id)->row();
		if (!empty($q)) {
			return $q->idcust;
		} else {
			return false;
		}
	}

	//generate

	function get_generate_order($idsite = '')
	{
		$qp = '';
		if (!empty($idsite)) {
			$qp = ' AND order_header.id_site="' . $idsite . '"';
		}
		return $this->db->query("SELECT erp_gmedia.`order_header`.*
							FROM erp_gmedia.`order_header`
							INNER JOIN erp_gmedia.`ms_customers` ON erp_gmedia.`ms_customers`.id=erp_gmedia.`order_header`.id_cust
							WHERE erp_gmedia.`order_header`.STATUS='3' AND erp_gmedia.`order_header`.periode_tagih!='0' AND erp_gmedia.`ms_customers`.status!='9' " . $qp . "
							ORDER BY erp_gmedia.`ms_customers`.idcust ASC");
	}

	function get_from_arr($table, $data)
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$db1->where($data);
		$data = $db1->get($table);
		return $data;
	}

	function get_transaksi($id = '', $idcust = '', $nomor = '', $flag = '', $date = '', $date2 = '', $periode = '', $id_order = '', $jenis = '', $id_order_service = '', $sort = '')
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->where('status !=', 9);
		if (!empty($id)) {
			$db->where('id', $id);
		}
		if (!empty($idcust)) {
			$db->where('id_cust', $idcust);
		}
		if (!empty($nomor)) {
			$db->where('nomor', $nomor);
		}
		if (!empty($flag)) {
			$db->where('flag', $flag);
		}
		if (!empty($id_order)) {
			$db->where('id_order', $id_order);
		}
		if (!empty($date)) {
			$db->where('tanggal >=', $date);
		}
		if (!empty($date2)) {
			$db->where('tanggal <=', $date2);
		}
		if (!empty($periode)) {
			$db->where('tanggal', $periode);
		}
		if (!empty($jenis)) {
			$db->where('jenis_transaksi', $jenis);
		}
		if (!empty($id_order_service)) {
			$db->where('id_order_service', $id_order_service);
		}
		if (empty($sort)) {
			//important! (don't change this line)/////
			$db->order_by('id', 'desc');
			//////////////////////////////////////////
		} else {
			$db->order_by('id', 'asc');
		}
		$db->from('transaksi');
		return $db->get();
	}

	function get_transaksi2($table = '', $nomor = '', $id_order = '')
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->where('status !=', 9);
		if (!empty($nomor)) {
			$db->where('nomor', $nomor);
		}
		if (!empty($id_order)) {
			$db->where('id_order', $id_order);
		}
		$db->from($table);
		return $db->get();
	}
	function get($table = '', $id = '', $order = '', $label = '')
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->where('status !=', 9);
		if (!empty($id)) {
			$db->where('id', $id);
		}
		if (!empty($order)) {
			$db->order_by('id', $order);
		}
		if (!empty($label)) {
			$db->where('label', $label);
		}
		$db->from($table);
		return $db->get();
	}

	function insert($table, $data, $id = '')
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$insert = $db1->insert($table, $data);
		if (!empty($id)) {
			$insert_id = $db1->insert_id();
			return  $insert_id;
		}
	}

	function sum_lain($id)
	{
		return $this->db->query("SELECT SUM(biaya) AS jml FROM erp_gmedia.`order_lain` WHERE id_order='" . $id . "' AND status='1'");
	}

	function get_order($table = '', $id = '', $id_order = '', $flag = '', $id_site = '')
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->where('status !=', 9);
		if (!empty($id)) {
			$db->where('id', $id);
		}
		if (!empty($id_order)) {
			$db->where('id_order', $id_order);
		}
		if (!empty($flag)) {
			$db->where('flag', $flag);
		}
		if (!empty($id_site)) {
			$db->where('id_site', $id_site);
		}
		//important! (don't change this line)/////
		$db->order_by('id', 'desc');
		//////////////////////////////////////////
		$db->from($table);
		return $db->get();
	}

	function get_arpost($id = '', $idcust = '', $nomor = '', $id_order = '', $tanggal = '', $periode1 = '', $periode2 = '', $aksi = '', $flag = '', $flagdp = '')
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->where('status !=', 9);
		if (!empty($id)) {
			$db->where('id', $id);
		}
		if (!empty($idcust)) {
			$db->where('id_cust', $idcust);
		}
		if (!empty($nomor)) {
			$db->where('nomor', $nomor);
		}
		if (!empty($id_order)) {
			$db->where('id_order', $id_order);
		}
		if (!empty($tanggal)) {
			$db->where('tanggal', $tanggal);
		}
		if (!empty($periode1)) {
			$db->where('tanggal >=', $periode1);
		}
		if (!empty($periode2)) {
			$db->where('tanggal <=', $periode2);
		}
		if (!empty($aksi)) {
			$db->where('aksi', $aksi);
		}
		if (!empty($flagdp)) {
			$db->where('flag_dp', $flagdp);
		} else {
			$db->where('flag_dp', 1);
		}
		if (!empty($flag)) {
			//jika ini arpost project order
			if ($flag == 1) {
				$db->where('periode_dari IS NOT NULL', null, false);
				//jika ini arpost sales order
			} else {
				$db->where('periode_dari IS NULL', null, false);
			}
		}
		//important! (don't change this line)/////
		$db->order_by('id', 'desc');
		//////////////////////////////////////////
		$db->from('arpost');
		return $db->get();
	}

	function get_sum_transaksi($id, $date = '', $date2 = '', $kode = '', $nomor = '', $flag = '')
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		if ($kode) {
			if ($date) {
				if ($nomor) {
					$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
						WHERE transaksi.`status`!='9' AND transaksi.`tanggal`>='" . $date . "' AND transaksi.`tanggal`<='" . $date2 . "' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
				} else {
					$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
						WHERE transaksi.`status`!='9' AND transaksi.`tanggal`>='" . $date . "' AND transaksi.`tanggal`<='" . $date2 . "' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.flag='" . $flag . "'";
				}
			} else {
				if ($nomor) {
					$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
				} else {
					$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.flag='" . $flag . "'";
				}
			}
		} else {
			if ($date) {
				$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.`tanggal`>='" . $date . "' AND transaksi.`tanggal`<='" . $date2 . "' AND transaksi.id_order='" . $id . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
			} else {
				if ($nomor) {
					$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
				} else {
					$q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.flag='" . $flag . "'";
				}
			}
		}
		// echo $q;exit;
		return $db1->query($q);
	}

	function update($table, $data, $id)
	{
		$db1 = $this->load->database('erp_gmedia', TRUE);
		$db1->where('id', $id);
		$db1->update($table, $data);
	}

	function get_namasite($id, $group)
	{
		return $this->db->query("SELECT c.`nama` AS nama_site, c.`id` AS id_site, c.`alamat3`
		FROM erp_gmedia.`setting_merge` a
		JOIN erp_gmedia.`ms_site` c ON a.`id_site` = c.`id` WHERE a.`id_cust` = $id AND a.`group_cust` = $group")->result();
	}

	function get_setting_merge()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$db->select('id_cust,id_site');
		$db->from('setting_merge');
		$db->group_by('id_cust,group_cust');
		return $db->get();
	}

	// function update_tosite()
	// {
	// 	$db = $this->load->database('erp_gmedia', TRUE);
	// 	$id = null;
	// 	$q = $db->query("SELECT b.`id_arpost_merge`,a.`id`,a.`id_order`,a.`nomor`,a.`status`,b.`status` AS merge_status,a.`flag`,a.`to_site` FROM arpost a JOIN arpost_merge b ON a.`id`=b.`id_arpost`")->result();
	// 	foreach ($q as $row) {
	// 		$id = $db->query("SELECT a.`to_site` FROM erp_gmedia.`arpost` a WHERE a.`id`=$row->id_arpost_merge")->row();
	// 		if (!empty($id)) {
	// 			$db->query("UPDATE erp_gmedia.`arpost` a SET a.`to_site`=$id->to_site WHERE a.`id`=$row->id");
	// 		}
	// 	}
	// }

	//untuk update informasi kontak
	function update_contact()
	{
		$db = $this->load->database('erp_gmedia', TRUE);
		$data = $arpost = $contact = $msg = null;
		$arpost = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`status`=1")->result();
		$contact = $this->db->query("SELECT * FROM (
			SELECT b.`id` AS id_order,b.`id_site`,c.`id` AS id_contact FROM erp_gmedia.`order_header` b JOIN erp_gmedia.`ms_contact` c ON b.`attention_display`=c.`id` 
					WHERE c.`flag`='f' GROUP BY c.`id`
			UNION ALL
			SELECT f.`id` AS id_order,f.`id_site`,g.`id` AS id_contact FROM erp_gmedia.`order_header` f JOIN erp_gmedia.`ms_contact` g ON f.`id_site`=g.`id_site` WHERE g.`flag`='f' GROUP BY f.`id_site` ) z GROUP BY z.`id_contact` ")->result();

		foreach ($arpost as $row) {
			foreach ($contact as $low) {
				if ($row->id_site == $low->id_site && $row->id_order == $low->id_order) {
					$data = array(
						'id_contact' => $low->id_contact
					);
					$db->where('id', $row->id);
					$db->update('arpost', $data);
				}
			}
		}
		$msg = 'done';
		return $msg;
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
			LEFT JOIN erp_gmedia.`ms_customers` d
			  ON a.`id_cust` = d.`id`
		  WHERE a.`status` = 1
			AND (a.`merge` IS NULL
			  OR a.`merge` = 0) AND a.`id`=$id ) X ) p");
		$query = $q->result();
		foreach ($query as $row) {
			$id_head = $row->id_head;
			$data .= '<input type="radio" id="header" name="header" value="1">' . $row->nama_site . '<br>';
			$data .= '<input type="radio" id="header" name="header" value="2">' . $row->nama_cust . '<br>';
			$data .= '<input type="radio" id="header" name="header" value="3">' . $row->nama_cust . ' | ' . $row->nama_site . '<br>';
		}
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

	function get_cust_site()
	{
		$data = null;
		$q = $this->db->query("SELECT b.`id`,c.`nama` AS nama_cust,b.`nama` AS nama_site FROM erp_gmedia.`order_header` a 
			LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`= b.`id` 
			LEFT JOIN erp_gmedia.`ms_customers` c ON a.`id_cust`=c.`id` WHERE a.`status`=3 AND a.`periode_tagih`!='0' AND c.`status`!=9 AND (
						c.`nama` LIKE '%" . $this->input->post('searchTerm') . "%' ESCAPE '!' OR b.`nama` LIKE '%" . $this->input->post('searchTerm') . "%' ESCAPE '!' )
						ORDER BY c.`nama` ASC LIMIT 25");
		$data2 = $q->result();
		$data = array();
		$data[] = array("id" => 0, "text" => 'All');
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->id, "text" => $row->nama_cust . ' => ' . $row->nama_site);
		}
		return json_encode($data);
	}
}
