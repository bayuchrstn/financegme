<?php
class Model_finance_supplier extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$db = $this->load->database('erp_inventory', TRUE);
		$column_order = array(null, 'a.kode', 'a.nama', 'a.pic', 'a.bank', 'a.norek', 'a.address1', 'a.email');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.kode';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'desc';

		$db->select("SQL_CALC_FOUND_ROWS *", false);
		$db->from('ms_perusahaan a');
		$db->group_start();
		$db->like('a.nama', $this->input->post('search_keyword'));
		$db->group_end();
		$db->order_by($order_name, $order_dir);
		if ($_POST['length'] != -1) $db->limit($_POST['length'], $_POST['start']);
		$q = $db->get();
		$qn = $db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$row = array();
				$row[] = $no . '.';
				$row[] = $r['kode'];
				$row[] = $r['nama'];
				$row[] = $r['pic'];
				$row[] = $r['bank'];
				$row[] = $r['norek'];
				$row[] = $r['address1'];
				$row[] = $r['email'];
				$row[] = '<a href="#" onClick="view_data(\'' . $r['id_perusahaan'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';

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
		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$result = $this->db->insert('finance_supplier', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function select()
	{
		$db = $this->load->database('erp_inventory', TRUE);
		$db->where("id_perusahaan", $this->input->post('id'));
		$q = $db->get("ms_perusahaan");
		return $q->result();
	}

	function update()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
		);
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('finance_supplier', $data);
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
		$result = $this->db->delete('finance_supplier');
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function cek_id_regional($id)
	{
		$db = $this->load->database('erp_inventory', TRUE);
		$data = 0;

		$q = $db->query("select id from gmd_regional where code = '" . $id . "'");
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$data = $r['id'];
			}
		}
		$q->free_result();

		return $data;
	}
}
