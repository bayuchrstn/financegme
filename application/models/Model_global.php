<?php
class Model_global extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function modul_name($id)
	{
		$data = '';

		$this->db->from("modul");
		$this->db->where('code', $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['name'];
			}
		}
		$q->free_result();

		return $data;
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

	function erp_email_info()
	{
		$data = '';

		$q = $this->db->query("select value from gmd_setting where id = '24'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['value'];
			}
		}
		$q->free_result();

		return $data;
	}

	function erp_email_divisi($divisi, $area)
	{
		$data = '';

		$q = $this->db->query("select receiver from gmd_email where code = '" . $divisi . "' AND area = '" . $area . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['receiver'];
			}
		}
		$q->free_result();

		return $data;
	}

	function cek_name_regional($id)
	{
		$data = 0;

		$q = $this->db->query("select name from gmd_regional where code = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['name'];
			}
		}
		$q->free_result();

		return $data;
	}

	function cek_bayar_invoice($no_invoice)
	{
		$this->db->trans_start();
		$bayar = 0;
		$lunas = 0;
		$lunas_tgl = '';

		$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_invoice_billing 
		where no_invoice = '" . $no_invoice . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$bayar += $r['jml'];
			}
		}

		$q = $this->db->query("select a.jumlah, COALESCE((SELECT tanggal FROM gmd_finance_invoice_billing WHERE no_invoice = a.id ORDER BY tanggal DESC LIMIT 1),'') AS tgl_paid from gmd_finance_invoice_customer a
		where a.id = '" . $no_invoice . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				if ($bayar >= $r['jumlah']) {
					$lunas = 1;
					$lunas_tgl = $r['tgl_paid'];
				}
			}
		}

		$data = array(
			'bayar' => $bayar,
			'lunas' => $lunas,
			'date_paid' => $lunas_tgl,
		);
		$this->db->where('id', $no_invoice);
		$this->db->update('finance_invoice_customer', $data);
		$this->db->trans_complete();
	}

	function cek_bayar_ap($no_invoice)
	{
		$bayar = 0;
		$lunas = 0;

		$q = $this->db->query("select sum(jumlah) as jml from gmd_finance_ap_billing 
		where id_ap = '" . $no_invoice . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$bayar += $r['jml'];
			}
		}

		$q = $this->db->query("select a.jumlah, COALESCE((SELECT tanggal FROM gmd_finance_ap_billing WHERE id_invoice = a.id ORDER BY tanggal DESC LIMIT 1),'') AS tgl_paid from gmd_finance_ap_invoice a 
		where a.id = '" . $no_invoice . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				if ($bayar >= $r['jumlah']) {
					$lunas = 1;
					$lunas_tgl = $r['tgl_paid'];
				}
			}
		}

		$data = array(
			'bayar' => $bayar,
			'lunas' => $lunas,
			'date_paid' => $lunas_tgl,
		);
		$this->db->where('id', $no_invoice);
		$this->db->update('gmd_finance_ap_invoice', $data);
	}

	function update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $area, $regional)
	{
		$tanggal_awal = date("Y-m-01", strtotime($tanggal));
		$tanggal_akhir = date("Y-m-t", strtotime($tanggal));

		$debet = 0;
		$kredit = 0;
		$q = $this->db->query("select coalesce(sum(debet),0) as debet, coalesce(sum(kredit),0) as kredit from gmd_finance_coa_general_ledger_detail 
		where id_biaya = '" . $id_biaya . "' AND card_id = '" . $card_id . "' AND (tanggal between '" . $tanggal_awal . "' and '" . $tanggal_akhir . "') and branch = '" . $area . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$debet = $r['debet'];
				$kredit = $r['kredit'];
			}
		}

		$q = $this->db->query("select id from gmd_finance_coa_general_ledger_monthly 
		where id_biaya = '" . $id_biaya . "' AND card_id = '" . $card_id . "' AND bulan = '" . $tanggal_akhir . "' and branch = '" . $area . "'");
		if ($q->num_rows() > 0) {
			$data = array(
				'debet' => $debet,
				'kredit' => $kredit,
			);
			$this->db->where('id_biaya', $id_biaya);
			$this->db->where('card_id', $card_id);
			$this->db->where('bulan', $tanggal_akhir);
			$this->db->where('branch', $area);
			$this->db->update('finance_coa_general_ledger_monthly', $data);
		} else {
			$data = array(
				'id_biaya' => $id_biaya,
				'card_id' => $card_id,
				'bulan' => $tanggal_akhir,
				'debet' => $debet,
				'kredit' => $kredit,
				'branch' => $area,
				'area' => $regional,
			);
			$this->db->insert('finance_coa_general_ledger_monthly', $data);
		}
	}

	function update_jurnal_harian($id_biaya, $card_id, $tanggal, $area, $regional)
	{
		$debet = 0;
		$kredit = 0;
		$q = $this->db->query("select coalesce(sum(debet),0) as debet, coalesce(sum(kredit),0) as kredit from gmd_finance_coa_general_ledger_detail 
		where id_biaya = '" . $id_biaya . "' AND card_id = '" . $card_id . "' AND tanggal = '" . $tanggal . "' AND branch = '" . $area . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$debet = $r['debet'];
				$kredit = $r['kredit'];
			}
		}

		$q = $this->db->query("select id from gmd_finance_coa_general_ledger_daily 
		where id_biaya = '" . $id_biaya . "' AND card_id = '" . $card_id . "' AND tanggal = '" . $tanggal . "' and branch = '" . $area . "'");
		if ($q->num_rows() > 0) {
			$data = array(
				'debet' => $debet,
				'kredit' => $kredit,
			);
			$this->db->where('id_biaya', $id_biaya);
			$this->db->where('card_id', $card_id);
			$this->db->where('tanggal', $tanggal);
			$this->db->where('branch', $area);
			$this->db->update('finance_coa_general_ledger_daily', $data);
		} else {
			$data = array(
				'id_biaya' => $id_biaya,
				'card_id' => $card_id,
				'tanggal' => $tanggal,
				'debet' => $debet,
				'kredit' => $kredit,
				'branch' => $area,
				'area' => $regional,
			);
			$this->db->insert('finance_coa_general_ledger_daily', $data);
		}
	}

	function insert_alert_notif($alert_code, $title, $content, $status, $date_create, $user_id, $url_link, $related_id)
	{
		$data = array(
			'alert_code' => $alert_code,
			'title' => $title,
			'content' => $content,
			'status' => $status,
			'date_create' => $date_create,
			'user_id' => $user_id,
			'url_link' => $url_link,
			'related_id' => $related_id,
		);
		$this->db->insert('alert_notif', $data);
	}

	function kategori()
	{
		$q = $this->db->query("select * from gmd_master where category = 'customer_type'
		order by name asc");
		return $q;
	}

	function master_noc_cat_problem()
	{
		$q = $this->db->query("select * from gmd_master where category = 'noc_cat_problem'
		order by name asc");
		return $q;
	}

	function master_noc_cat_problem_internal()
	{
		$q = $this->db->query("select * from gmd_master where category = 'noc_cat_problem_internal'
		order by name asc");
		return $q;
	}

	function master_noc_cat_problem_external()
	{
		$q = $this->db->query("select * from gmd_master where category = 'noc_cat_problem_external'
		order by name asc");
		return $q;
	}

	function payment_to()
	{
		//$q = $this->db->query("select * from gmd_bank order by name asc");
		$this->db->from("bank");
		//$this->db->where('branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where("(branch = '" . $this->cek_id_regional($this->session->userdata('scope_area')) . "'
		or branch = '0')", NULL, FALSE);
		$q = $this->db->get();
		return $q;
	}

	function get_detail_lokasi($id)
	{
		if ($id == '1') {
			$q = $this->db->query("select *, customer_name as nama from gmd_customer where status = 'customer' order by customer_name asc");
		} elseif ($id == '2') {
			$q = $this->db->query("select *, customer_name as nama from gmd_customer where status = 'pre_customer' order by customer_name asc");
		} elseif ($id == '3') {
			$q = $this->db->query("select *, bts_name as nama from gmd_bts order by bts_name asc");
		}
		return $q;
	}

	function select_autocomplite_customer()
	{
		$this->db->select("*", false);
		$this->db->from("finance_customer a");
		$this->db->where("(customer_id like '%" . $this->input->post('term') . "%'
		or nama like '%" . $this->input->post('term') . "%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}

	function select_autocomplite_coa_id()
	{
		$this->db->select("*", false);
		$this->db->from("finance_coa a");
		$this->db->where("(id like '%" . $this->input->post('term') . "%'
		or nama like '%" . $this->input->post('term') . "%')", NULL, FALSE);
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q->result();
	}

	function gmd_regional()
	{
		$this->db->from("regional");
		$this->db->where('up !=', '0');
		$this->db->order_by('name', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_service_ticket_section()
	{
		$this->db->from("service_ticket_section");
		$this->db->where('section_available', '10');
		$q = $this->db->get();
		return $q;
	}

	function gmd_finance_coa()
	{
		$this->db->from("finance_coa");
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_finance_coa_info($id)
	{
		$data = '';
		$this->db->select("*", false);
		$this->db->from("finance_coa");
		$this->db->where("id", $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['id'] . ' - ' . $r['nama'];
			}
		}
		return $data;
	}

	function gmd_finance_master_cat_setoran()
	{
		$this->db->from("finance_master_cat_setoran");
		$this->db->order_by('id', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_ticket_question_type()
	{
		$this->db->from("ticket_question_type");
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_finance_forecast_cat()
	{
		$this->db->from("finance_forecast_cat");
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_finance_fixcost_cat()
	{
		$this->db->from("finance_fixcost_cat");
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_finance_master_cat_tax_type()
	{
		$this->db->from("gmd_finance_master_cat_tax_type");
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_finance_master_divisi()
	{
		$this->db->from("gmd_finance_master_divisi");
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function gmd_ticket_question($id)
	{
		$this->db->from("ticket_question");
		$this->db->where('type', $id);
		$this->db->order_by('descripton', 'asc');
		$q = $this->db->get();
		return $q;
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

	function finance_bank_name($id)
	{
		$data = '';

		$this->db->where('id', $id);
		$q = $this->db->get('finance_bank');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['name'] . ' - ' . $r['account_name'] . ' - ' . $r['account_number'];
			}
		}
		$q->free_result();

		return $data;
	}

	function data_master($id)
	{
		$this->db->order_by('id', 'asc');
		$this->db->where('category', $id);
		$q = $this->db->get('master');
		return $q;
	}

	function finance_invoice_kategori()
	{
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('finance_invoice_kategori');
		return $q;
	}

	function gmd_finance_supplier()
	{
		$this->db->from("finance_supplier");
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function finance_master_kat_gl()
	{
		$this->db->where('branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('finance_master_kat_gl');
		return $q;
	}

	function gmd_finance_project()
	{
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('finance_project');
		return $q;
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

	function gmd_user_by_sub_dep($sub_dep)
	{
		$this->db->from("users");
		$this->db->where('status', 'active');
		$this->db->where('divisi', 'div_sales_marketing');
		$this->db->where('area', $this->session->userdata('scope_area'));
		$this->db->order_by('name', 'asc');
		$q = $this->db->get();
		return $q;
	}

	function closing_date_kasir($tanggal)
	{
		$this->db->select("kasir as tanggal", false);
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

	function finance_coa_card_name_bank()
	{
		$id = '111200';
		$id2 = '111300';
		$data = null;

		$this->db->from("finance_coa_card_name");
		if ($id != '') {
			$this->db->where("coa = $id OR coa = $id2");
		}
		$this->db->order_by('code_card', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data .= '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
			}
		}
		$q->free_result();

		return $data;
	}

	function finance_coa_card_name_bank_upload()
	{
		// $id = '111200';
		$id2 = '111300';
		$data = null;

		$this->db->from("finance_coa_card_name");
		$this->db->where("coa = $id2");
		$this->db->order_by('code_card', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data .= '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
			}
		}
		$q->free_result();

		return $data;
	}
}
