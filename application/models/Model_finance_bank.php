<?php
class Model_finance_bank extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.name', 'a.account_name', 'a.account_number');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.name';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS *", false);
		$this->db->from('finance_bank a');
		$this->db->group_start();
		$this->db->like('a.name', $this->input->post('search_keyword'));
		$this->db->or_like('a.account_name', $this->input->post('search_keyword'));
		$this->db->or_like('a.account_number', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where('a.branch', $this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->or_where('a.lock', 1);
		$this->db->group_end();
		$this->db->order_by($order_name, $order_dir);
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$edit = '';
				if ($r['lock'] == 0) {
					$edit = '<a href="#" onClick="view_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				}
				$no++;
				$row = array();
				$row[] = $no . '.';
				$row[] = $r['name'];
				$row[] = $r['account_name'];
				$row[] = $r['account_number'];
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
		$data = array(
			'name' => $this->input->post('name'),
			'account_name' => $this->input->post('account_name'),
			'account_number' => $this->input->post('account_number'),
			'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
		);
		$result = $this->db->insert('finance_bank', $data);
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function select()
	{
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("finance_bank");
		return $q->result();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'account_name' => $this->input->post('account_name'),
			'account_number' => $this->input->post('account_number'),
		);
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('finance_bank', $data);
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
		$result = $this->db->delete('finance_bank');
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
}
