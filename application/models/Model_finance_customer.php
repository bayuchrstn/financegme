<?php
class Model_finance_customer extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_tablea()
	{
		$page = ($this->input->post('page')) ? $this->input->post('page') : 1;
		$rp = ($this->input->post('rp')) ? $this->input->post('rp') : 10;
		$sortname = ($this->input->post('sortname')) ? $this->input->post('sortname') : 'a.id';
		$sortorder = ($this->input->post('sortorder')) ? $this->input->post('sortorder') : 'asc';

		header("Content-type: application/json");
		$jsonData = array('page' => $page, 'total' => 0, 'rows' => array());

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, d.name as nama_kategori", false);
		$this->db->where("(a.nama like '%" . $this->input->post('searchKeyword') . "%'
		OR a.alamat like '%" . $this->input->post('searchKeyword') . "%'
		OR a.telp like '%" . $this->input->post('searchKeyword') . "%'
		OR a.customer_id like '%" . $this->input->post('searchKeyword') . "%')", NULL, FALSE);
		//$this->db->where('a.branch',$this->m_global->cek_id_regional($this->session->userdata('scope_area')));
		if ($this->input->post('searchkategori') != '0') {
			$this->db->where('a.kategori', $this->input->post('searchkategori'));
		}
		$this->db->from('finance_customer2 AS a');
		$this->db->order_by($sortname, $sortorder);
		$this->db->order_by('a.id', 'desc');
		$this->db->limit($rp, (($page - 1) * $rp));
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$no = (($page - 1) * $rp);
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$bayar = $this->cek_child($r['customer_id']);
				$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> <a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-trash text-danger"></i></a>';
				if ($bayar > 0) {
					$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>';
				}
				$entry  = array(
					'id' => $r['id'],
					'cell' => array(
						'no' => $no . '.',
						'a.customer_id' => $r['customer_id'],
						'a.nama' => $r['nama'],
						'a.alamat' => $r['alamat'],
						'a.telp' => $r['telp'],
						'edit' => $edit,
					)
				);
				$jsonData['rows'][] = $entry;
			}
		}
		$q->free_result();
		/*
		if(count($jsonData['rows']) < $rp){
			$jsonData_push = $jsonData['rows'];
			for ($row_i = 1; $row_i <= ($rp - count($jsonData_push)); $row_i++){
							$entry_sub = array();
							foreach($jsonData_push[0]['cell'] as $jsonData_x3 => $jsonData_v3) {
								$entry_sub[$jsonData_x3] = '';
							}
							$entry  = array('id' =>'', 'cell'=>$entry_sub);
							$jsonData['rows'][] = $entry;
			}
		}
		*/
		$jsonData['total'] = $n;
		echo json_encode($jsonData);
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.customer_id', 'a.nama', 'a.alamat', 'a.telp');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.*", false);
		$this->db->from('finance_customer2 a');
		$this->db->group_start();
		$this->db->like('a.nama', $this->input->post('search_keyword'));
		$this->db->or_like('a.alamat', $this->input->post('search_keyword'));
		$this->db->or_like('a.telp', $this->input->post('search_keyword'));
		$this->db->or_like('a.customer_id', $this->input->post('search_keyword'));
		$this->db->group_end();
		if ($this->input->post('searchkategori') != '0') {
			$this->db->where('a.kategori', $this->input->post('searchkategori'));
		}
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.id', 'desc');
		if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$bayar = $this->cek_child($r['customer_id']);
				$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onclick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
				if ($bayar > 0) {
					$edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a>';
				}
				$row  = array(
					$no . '.',
					$r['customer_id'],
					$r['nama'],
					$r['alamat'],
					$r['telp'],
					$edit,
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
		$customer_id = strtoupper($this->input->post('customer_id'));
		$customer_id = str_replace(" ", "", $customer_id);
		$this->db->from('finance_customer a');
		$this->db->where('customer_id', $customer_id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$msg = 'Customer ID telah digunakan';
		} else {
			$data = array(
				'customer_id' => $customer_id,
				'nama' => strtoupper($this->input->post('nama')),
				'alamat' => strtoupper($this->input->post('alamat')),
				'telp' => strtoupper($this->input->post('telp')),
				'kategori' => $this->input->post('kategori'),
				//'branch' => $this->m_global->cek_id_regional($this->session->userdata('scope_area')),
			);
			$result = $this->db->insert('finance_customer', $data);
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
		$this->db->from('finance_customer2 a');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$this->db->trans_start();
		$customer_id = strtoupper($this->input->post('customer_id'));
		$customer_id = str_replace(" ", "", $customer_id);
		$this->db->from('finance_customer2 a');
		$this->db->where('customer_id', $customer_id);
		$this->db->where('id !=', $this->input->post('id'));
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$msg = 'Customer ID telah digunakan';
		} else {
			$data = array(
				'customer_id' => $customer_id,
				'nama' => strtoupper($this->input->post('nama')),
				'alamat' => strtoupper($this->input->post('alamat')),
				'telp' => strtoupper($this->input->post('telp')),
				'kategori' => $this->input->post('kategori'),
				//'branch' => $this->m_global->cek_id_regional($this->session->userdata('scope_area')),
			);
			$this->db->where('id', $this->input->post('id'));
			$result = $this->db->update('finance_customer2', $data);
			if ($result == true) {
				$data = array(
					'customer_id' => $customer_id,
				);
				$this->db->where('customer_id', $this->input->post('customer_id_old'));
				$this->db->update('finance_customer_service2', $data);
				$msg = 1;
			} else {
				$msg = 0;
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function delete()
	{
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->delete('finance_customer2');
		if ($result == true) {
			$msg = 1;
		} else {
			$msg = 0;
		}
		return $msg;
	}

	function cek_child($id)
	{
		$data = 0;

		$this->db->from('finance_customer_service2');
		$this->db->where("customer_id", $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$data = 1;
		}

		return $data;
	}
}
