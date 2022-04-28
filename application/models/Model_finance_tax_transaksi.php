<?php
class Model_finance_tax_transaksi extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'jenis', 'b.nama', 'a.tanggal_faktur', 'c.name', 'faktur', 'a.nama_pkp', 'a.no_seri_faktur', 'a.jumlah', 'a.deskripsi');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.nama as nama_type, 
			DATE_FORMAT(a.tanggal_faktur, '%d-%m-%Y') AS tanggal_fakturnya, 
			if(a.tipe = 0, 'Keluaran', 'Masukan') as jenis, 
			if(a.msa = 0, 'MSD', 'MSA') as faktur, 
			c.name as nama_cabang", false);
		$this->db->from('finance_transaksi_tax a');
		$this->db->join('finance_master_cat_tax_type b', 'a.tax_type = b.id', 'left');
		$this->db->join('regional c', 'a.cabang = c.id', 'left');
		$this->db->group_start();
		$this->db->like('a.deskripsi', $this->input->post('search_keyword'));
		$this->db->or_like('a.no_seri_faktur', $this->input->post('search_keyword'));
		$this->db->group_end();
		//$this->db->where('a.tipe','0');
		$this->db->where('a.branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where("(a.tanggal_faktur between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
		if ($this->input->post('searchtype') != '0') {
			$this->db->where('a.tax_type', $this->input->post('searchtype'));
		}
		$this->db->order_by($order_name, $order_dir);
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$opsi = '<a href="#" onClick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				$row  = array(
					$no . '.',
					$r['jenis'],
					$r['nama_type'],
					$r['tanggal_fakturnya'],
					$r['nama_cabang'],
					$r['faktur'],
					$r['nama_pkp'],
					$r['no_seri_faktur'],
					number_format($r['jumlah'], 0),
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

	function insert()
	{
		$data = array();
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array(
			'tipe' => $this->input->post('tipe'),
			'tanggal_faktur' => $this->input->post('tanggal_faktur'),
			'nama_pkp' => $this->input->post('nama_pkp'),
			'no_seri_faktur' => $this->input->post('no_seri_faktur'),
			'deskripsi' => $this->input->post('deskripsi'),
			'tax_type' => $this->input->post('tax_type'),
			'msa' => $this->input->post('msa'),
			'cabang' => $this->input->post('cabang'),
			'jumlah' => $jumlah,
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
			'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
		);
		$result = $this->db->insert('finance_transaksi_tax', $data);
		if ($result == true) {
			$msg = 1;
			// $this->insert_gl($data);
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function create_queue_id()
	{
		$invoice_cek = 0;
		$userid = str_pad($this->session->userdata('userid'), 6, '0', STR_PAD_LEFT);
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
		$kode_ju = $this->model_global->finance_master_kat_gl_name($id);
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
	//ini sedang dikerjakan
	function insert_gl($data)
	{
		$tanggal = $data['tanggal_faktur'];
		$no_ref = $data['no_seri_faktur'];
		$jumlah = $data['jumlah'];
		$tax = $data['tax_type'];
		$msg = null;
		$this->db->trans_start();
		if ($this->model_global->closing_date_accounting($tanggal) == true) {
			$this->db->from('finance_coa_general_ledger_detail a');
			$this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
			$this->db->where('b.no_referensi', $no_ref);
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$msg = 'No referensi sudah pernah di input';
			} else {
				$bulan = $this->get_bulan($tanggal);
				$tahun = substr($tanggal, 0, 4);
				if ($tax == 1) {
					$deskripsi = "Pembayaran PPh 23 Periode " . $bulan . " " . $tahun;
					$akundebet = " 200303";
					$akunkredit = " 102003";
				} else if ($tax == 2) {
					$deskripsi = "Pembayaran PPN Periode " . $bulan . " " . $tahun;
					$akundebet  = "200305";
					$akunkredit  = "102003";
				}
				$create_queue_id = $this->create_queue_id();
				$create_gl_id = $this->create_gl_id(19);
				$branch = $this->model_global->cek_id_regional($this->session->userdata('scope_area'));
				$area = $this->model_global->cek_id_regional($this->session->userdata('scope_regional'));
				$data = array(
					'no_trans' => $create_queue_id,
					'kat_gl' => 19,
					'jurnal_group' => $create_gl_id,
					'deskripsi' => $deskripsi,
					'tanggal' => $tanggal,
					'no_referensi' => $no_ref,
					'ppn' => 0,
					'project' => 0,
					'branch' => $branch,
					'area' => $area,
				);
				$result = $this->db->insert('finance_coa_general_ledger', $data);
				if ($result == true) {
					//hutang
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $akundebet,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'debet' => $jumlah,
						'kredit' => 0,
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->model_global->update_jurnal_bulanan($akundebet, $tanggal, $branch, $area);
					$this->model_global->update_jurnal_harian($akundebet, $tanggal, $branch, $area);
					//pembayaran
					$data = array(
						'no_trans' => $create_queue_id,
						'id_biaya' => $akunkredit,
						'tanggal' => $tanggal,
						'divisi' => 0,
						'debet' => 0,
						'kredit' => $jumlah,
						'branch' => $branch,
						'area' => $area,
					);
					$this->db->insert('finance_coa_general_ledger_detail', $data);
					$this->model_global->update_jurnal_bulanan($akunkredit, $tanggal, $branch, $area);
					$this->model_global->update_jurnal_harian($akunkredit, $tanggal, $branch, $area);
				}
			}
		}
		$this->db->trans_complete();
		return $msg;
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

	function save_data_import()
	{
		$this->db->trans_start();

		if (isset($_POST['tax_no_seri'])) {
			foreach ($_POST['tax_no_seri'] as $k => $v) {
				$this->db->select("id", false);
				$this->db->from('finance_transaksi_tax');
				$this->db->where('no_seri_faktur', trim($_POST['tax_no_seri'][$k]));
				$q = $this->db->get();
				if ($q->num_rows() > 0) {
					$jumlah = str_replace(", ", "", $_POST['tax_jumlah'][$k]);
					$data = array(
						'tipe' => $this->input->post('tipe'),
						'tanggal_faktur' => $_POST['tax_tanggal'][$k],
						'nama_pkp' => $_POST['tax_nama_pkp'][$k],
						//'no_seri_faktur' => $_POST['tax_no_seri'][$k],
						//'deskripsi' => $_POST['tax_jumlah'][$k],
						'tax_type' => $this->input->post('tax_type'),
						'msa' => $this->input->post('msa'),
						'cabang' => $this->input->post('cabang'),
						'jumlah' => $jumlah,
						'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
						'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
					);
					$this->db->where('no_seri_faktur', trim($_POST['tax_no_seri'][$k]));
					$result = $this->db->update('finance_transaksi_tax', $data);
				} else {
					$jumlah = str_replace(", ", "", $_POST['tax_jumlah'][$k]);
					$data = array(
						'tipe' => $this->input->post('tipe'),
						'tanggal_faktur' => $_POST['tax_tanggal'][$k],
						'nama_pkp' => $_POST['tax_nama_pkp'][$k],
						'no_seri_faktur' => trim($_POST['tax_no_seri'][$k]),
						//'deskripsi' => $_POST['tax_jumlah'][$k],
						'tax_type' => $this->input->post('tax_type'),
						'msa' => $this->input->post('msa'),
						'cabang' => $this->input->post('cabang'),
						'jumlah' => $jumlah,
						'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
						'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
					);
					$result = $this->db->insert('finance_transaksi_tax', $data);
				}
				$q->free_result();
			}
		}
		$msg = 1;
		$this->db->trans_complete();
		return $msg;
	}

	function select()
	{
		$this->db->select("a.*, round(a.jumlah) as jumlah", false);
		$this->db->from("finance_transaksi_tax a");
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array(
			'tipe' => $this->input->post('tipe'),
			'tanggal_faktur' => $this->input->post('tanggal_faktur'),
			'nama_pkp' => $this->input->post('nama_pkp'),
			'no_seri_faktur' => $this->input->post('no_seri_faktur'),
			'msa' => $this->input->post('msa'),
			'deskripsi' => $this->input->post('deskripsi'),
			'tax_type' => $this->input->post('tax_type'),
			'cabang' => $this->input->post('cabang'),
			'jumlah' => $jumlah,
		);
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('finance_transaksi_tax', $data);
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
		$result = $this->db->delete('finance_transaksi_tax');
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function finance_bank()
	{
		$this->db->group_start();
		$this->db->where('branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->or_where('lock', 1);
		$this->db->group_end();
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('finance_bank');
		return $q;
	}

	function departement()
	{
		$this->db->where('category', 'departement');
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('master');
		return $q;
	}

	function cek_id_regional($id)
	{
		$data = 0;

		$q = $this->db->query("select id from gmd_regional where code = '"  . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['id'];
			}
		}
		$q->free_result();

		return $data;
	}

	function cek_id_department($id)
	{
		$data = 0;

		$q = $this->db->query("select id from gmd_master where code  = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['id'];
			}
		}
		$q->free_result();

		return $data;
	}

	function get_karyawan($id)
	{
		$data =  '<option value=""></option>';

		$q = $this->db->query("select id, name from gmd_people where departemen = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data .= '<option value="' . $r['id'] . '">' . $r['name'] . '</option>';
			}
		}
		$q->free_result();

		return $data;
	}

	function insert_generate($no_faktur, $nama_pkp, $tanggal_faktur, $deskripsi, $jumlah, $id)
	{
		$data = array(
			'tipe' => 0,
			'tanggal_faktur' => $tanggal_faktur,
			'nama_pkp' => $nama_pkp,
			'no_seri_faktur' => $no_faktur,
			'deskripsi' => $deskripsi,
			'tax_type' => 2,
			'msa' => 0,
			'cabang' => 8,
			'jumlah' => $jumlah,
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
			'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
			'id_inv' => $id
		);
		$result = $this->db->insert('finance_transaksi_tax', $data);
		if ($result == true) {
			$msg = 1;
			// $this->insert_gl($data);
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function update_no($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('finance_tax_nomor', $data);
	}

	function get_tax($id)
	{
		$this->db->select('*');
		$this->db->where('id_inv', $id);
		$this->db->from('finance_transaksi_tax');
		return $this->db->get();
	}
}
