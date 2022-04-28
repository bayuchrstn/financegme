<?php
class Model_finance_coa_card_name extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.coa', 'a.nama');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.name';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, concat(b.id,' - ',b.nama) as nama_coa", false);
		$this->db->from('finance_coa_card_name a');
		$this->db->join('finance_coa b', 'a.coa = b.id', 'left');
		$this->db->group_start();
		$this->db->like('a.nama', $this->input->post('search_keyword'));
		$this->db->or_like('a.coa', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.code_card', 'asc');
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$edit = '<a href="#" onClick="view_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				$no++;
				$row = array();
				$row[] = $no . '.';
				$row[] = $r['nama_coa'];
				$row[] = $r['code_card'];
				$row[] = $r['nama'];
				$row[] = $edit;

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
		$this->db->select("*");
		$this->db->from('finance_coa_card_name a');
		$this->db->where("a.code_card", $this->input->post('card_id'));
		$q = $this->db->get()->result();
		if (!empty($q)) {
			$msg = 2;
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'coa' => $this->input->post('tambah_account_id'),
				'code_card' => $this->input->post('card_id'),
			);
			$result = $this->db->insert('finance_coa_card_name', $data);
			if ($result == true) {
				$msg = 1;
			} else {
				$msg = 0;
			}
		}
		return $msg;
	}

	function select()
	{
		$this->db->select("a.*,b.nama as nama_coa", false);
		$this->db->from('finance_coa_card_name a');
		$this->db->where("a.id", $this->input->post('id'));
		$this->db->join('finance_coa b', 'a.coa = b.id', 'left');
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$this->db->select("*");
		$this->db->from('finance_coa_card_name a');
		$this->db->where("a.code_card", $this->input->post('card_id'));
		$this->db->where("a.id != " . $this->input->post('id'));
		$q = $this->db->get()->result();
		if (!empty($q)) {
			$msg = 2;
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'coa' => $this->input->post('tambah_account_id'),
				'code_card' => $this->input->post('card_id'),
			);
			$this->db->where('id', $this->input->post('id'));
			$result = $this->db->update('finance_coa_card_name', $data);
			if ($result == true) {
				$msg = 1;
			} else {
				$msg = 0;
			}
		}
		return $msg;
	}

	function delete($id)
	{
		if ($this->delete_check($id) == true) {
			$this->db->where('id', $id);
			$result = $this->db->delete('finance_coa_card_name');
			if ($result == true) {
				$msg = 1;
			} else {
				$msg = 0;
			}
		} else {
			$msg = 'Data tidak dapat dihapus, masih digunakan sebagai relasi';
		}
		return $msg;
	}

	function delete_check($id)
	{
		$data = true;
		$this->db->where('card_id', $id);
		$q = $this->db->get('finance_coa_general_ledger_detail');
		if ($q->num_rows() > 0) {
			$data = false;
		}

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
}
