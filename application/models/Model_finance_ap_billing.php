<?php
class Model_finance_ap_billing extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'c.nama', 'a.no_ref', 'b.nomor', `a.jumlah`);
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
		// $this->db->order_by($order_name, $order_dir);
		if (!empty($order_name) && !empty($order_dir)) {
			$order = "ORDER BY $order_name $order_dir";
		} else {
			$order = "ORDER BY a.`tanggal` ASC,a.`id` ASC";
		}
		$q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS a.`id`,DATE_FORMAT(a.`tanggal`, '%d-%m-%Y') AS tanggalnya,c.`nama` AS nama_perusahaan,a.`no_ref`,b.`nomor`,a.`jumlah` FROM erp_financev2.`gmd_finance_ap_billing` a 
		JOIN erp_financev2.`gmd_finance_ap_invoice` b ON a.`id_ap` =b.`id`
		JOIN inventory_v2.`ms_perusahaan` c ON b.`supplier`=c.`id_perusahaan`
		WHERE (
            `a`.`no_ref` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `b`.`nomor` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
          ) AND (
            a.`tanggal` BETWEEN '" . $this->input->post('searchDateFirst') . "'
            AND '" . $this->input->post('searchDateFinish') . "'
          ) $order $limit");
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$opsi = '<a href="#" onClick="view_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				$row  = array(
					$no . '.',
					$r['tanggalnya'],
					$r['nama_perusahaan'],
					$r['no_ref'],
					$r['nomor'],
					number_format($r['jumlah'], 0),
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

	// function insert()
	// {
	// 	$this->db->trans_start();
	// 	$jumlah = str_replace(",", "", $this->input->post('jumlah'));
	// 	$data = array(
	// 		'tanggal' => $this->input->post('tanggal'),
	// 		//'guna' => $this->input->post('guna'),
	// 		'jumlah' => $jumlah,
	// 		'id_invoice' => $this->input->post('id_invoice'),
	// 		'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
	// 		'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
	// 	);
	// 	$result = $this->db->insert('finance_ap_billing', $data);
	// 	if ($result == true) {
	// 		$this->m_global->cek_bayar_ap($this->input->post('id_invoice'));
	// 		$msg = 1;
	// 	} else {
	// 		$msg = 0;
	// 	}
	// 	$this->db->trans_complete();
	// 	return $msg;
	// }

	// function select()
	// {
	// 	$this->db->select("a.*, c.no_referensi as val_no_invoice", false);
	// 	$this->db->from('finance_ap_billing a');
	// 	$this->db->join('finance_ap_invoice c', "a.id_invoice = c.id", 'left');
	// 	$this->db->join('finance_supplier b', 'c.supplier = b.id', 'left');
	// 	$this->db->where("a.id", $this->input->post('id'));
	// 	$q = $this->db->get();
	// 	return $q->result();
	// }

	// function update()
	// {
	// 	$this->db->trans_start();
	// 	$old_no_invoice = 0;

	// 	$q = $this->db->query("select id_invoice from gmd_finance_ap_billing where id = '" . $this->input->post('id') . "'");
	// 	if ($q->num_rows() > 0) {
	// 		foreach ($q->result_array() as $r) {
	// 			$old_no_invoice = $r['id_invoice'];
	// 		}
	// 	}
	// 	$q->free_result();

	// 	$jumlah = str_replace(",", "", $this->input->post('jumlah'));
	// 	$data = array(
	// 		'tanggal' => $this->input->post('tanggal'),
	// 		//'guna' => $this->input->post('guna'),
	// 		'jumlah' => $jumlah,
	// 		'id_invoice' => $this->input->post('id_invoice'),
	// 	);
	// 	$this->db->where('id', $this->input->post('id'));
	// 	$result = $this->db->update('finance_ap_billing', $data);
	// 	if ($result == true) {
	// 		//OLD TRANSAKSI
	// 		$this->m_global->cek_bayar_ap($old_no_invoice);
	// 		//NEW TRANSAKSI
	// 		$this->m_global->cek_bayar_ap($this->input->post('id_invoice'));
	// 		$msg = 1;
	// 	} else {
	// 		$msg = 0;
	// 	}
	// 	$this->db->trans_complete();
	// 	return $msg;
	// }

	// function delete($id)
	// {
	// 	$this->db->trans_start();
	// 	$old_no_invoice = 0;

	// 	$q = $this->db->query("select id_invoice from gmd_finance_ap_billing where id = '" . $id . "'");
	// 	if ($q->num_rows() > 0) {
	// 		foreach ($q->result_array() as $r) {
	// 			$old_no_invoice = $r['id_invoice'];
	// 		}
	// 	}
	// 	$q->free_result();

	// 	$this->db->where('id', $id);
	// 	$result = $this->db->delete('finance_ap_billing');
	// 	if ($result == true) {
	// 		//OLD TRANSAKSI
	// 		$this->m_global->cek_bayar_ap($old_no_invoice);
	// 		$msg = 1;
	// 	} else {
	// 		$msg = 0;
	// 	}
	// 	$this->db->trans_complete();
	// 	return $msg;
	// }

	function finance_bank()
	{
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('finance_bank');
		return $q;
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

	function select_autocomplite()
	{
		$this->db->select("a.id, a.no_referensi, concat('<div>No Ref: <b>',a.no_referensi,'</b>
			, Inv Date: <b>',date_format(a.tanggal, '%d-%m-%Y'),'</b>
			, Vendor/Supplier: <b>',if(a.supplier = 0,'Lain2',b.nama),'</b>
			<br> Jumlah Tagihan: <b>',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'</b>
			<br> Sisa Tagihan: <b>',CAST(format(a.jumlah - a.bayar,0) AS CHAR CHARACTER SET utf8),'</b></div>') as konten", false);
		$this->db->from("finance_ap_invoice a");
		$this->db->join('finance_supplier b', 'a.supplier = b.id', 'left');
		$this->db->where("a.lunas", '0');
		$this->db->where("(a.no_referensi like '%" . $this->input->post('term') . "%'
		or b.nama like '%" . $this->input->post('term') . "%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}

	function select_detail_ref($no_invoice)
	{
		$data = '';
		$this->db->select("concat('(No Ref): ',a.no_referensi,', (INV DATE): ',date_format(a.tanggal, '%d-%m-%Y'),', (Vendor/Supplier): ',if(a.supplier = 0,'Lain2',b.nama),'
(JUMLAH TAGIHAN): ',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'
(SISA TAGIHAN): ',CAST(format(a.jumlah - a.bayar,0) AS CHAR CHARACTER SET utf8),'') as konten", false);
		$this->db->from("finance_ap_invoice a");
		$this->db->join('finance_supplier b', 'a.supplier = b.id', 'left');
		$this->db->where("a.id", $no_invoice);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['konten'];
			}
		}
		$q->free_result();
		return $data;
	}
}
