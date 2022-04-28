<?php
class Model_finance_coa extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'a.jumlah', 'b.name', 'c.nama', 'a.deskripsi');
		$order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
		$order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

		$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
			if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
			if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
			if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
			coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
		$this->db->group_start();
		$this->db->like('a.nama', $this->input->post('search_keyword'));
		$this->db->like('a.id', $this->input->post('search_keyword'));
		$this->db->group_end();
		if ($this->input->post('searchlevelsearchlevel') != '') {
			$this->db->where('a.level', $this->input->post('searchlevel'));
		}
		$this->db->where('a.parent', '0');
		$this->db->group_by('a.id');
		$this->db->order_by('a.id', 'asc');
		$this->db->order_by('header', 'asc');
		$this->db->order_by('level1', 'asc');
		$this->db->order_by('level2', 'asc');
		$this->db->order_by('level3', 'asc');
		//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$data = array();
		$no = $_POST['start'];
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$no++;
				$opsi = '';

				$row  = array(
					$r['header'],
					$r['level1'],
					$r['level2'],
					$r['level3'],
					($r['saldo'] == '0.00') ? '' : '(' . $r['tanggal'] . ') Rp. ' . number_format($r['saldo'], 2),
					$opsi,
				);
				$data[] = $row;


				//child 1
				$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
					if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
					if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
					if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
					coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
				$this->db->from('finance_coa a');
				$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
				$this->db->group_start();
				$this->db->like('a.nama', $this->input->post('search_keyword'));
				$this->db->like('a.id', $this->input->post('search_keyword'));
				$this->db->group_end();
				if ($this->input->post('searchlevelsearchlevel') != '') {
					$this->db->where('a.level', $this->input->post('searchlevel'));
				}
				$this->db->where('a.parent', $r['id']);
				$this->db->group_by('a.id');
				$this->db->order_by('a.id', 'asc');
				$this->db->order_by('header', 'asc');
				$this->db->order_by('level1', 'asc');
				$this->db->order_by('level2', 'asc');
				$this->db->order_by('level3', 'asc');
				//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
				$q2 = $this->db->get();
				$qn2 = $this->db->query('SELECT FOUND_ROWS() AS ttl');
				$n2 = $qn2->row()->ttl;
				$no2 = $_POST['start'];
				if ($q2->num_rows() > 0) {
					foreach ($q2->result_array() as $r2) {
						$no++;
						$opsi = '<a href="#" onClick="update_data(\'' . $r2['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r2['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
						if ($r2['kunci'] == '1') {
							$opsi = '<a href="#" onClick="update_data(\'' . $r2['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
						}
						$row  = array(
							$r2['header'],
							$r2['level1'],
							$r2['level2'],
							$r2['level3'],
							($r2['saldo'] == '0.00') ? '' : '(' . $r2['tanggal'] . ') Rp. ' . number_format($r2['saldo'], 2),
							$opsi,
						);
						$data[] = $row;

						//child 2
						$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
							if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
							if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
							if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
							coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
						$this->db->from('finance_coa a');
						$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
						$this->db->group_start();
						$this->db->like('a.nama', $this->input->post('search_keyword'));
						$this->db->like('a.id', $this->input->post('search_keyword'));
						$this->db->group_end();
						if ($this->input->post('searchlevelsearchlevel') != '') {
							$this->db->where('a.level', $this->input->post('searchlevel'));
						}
						$this->db->where('a.parent', $r2['id']);
						$this->db->group_by('a.id');
						$this->db->order_by('a.id', 'asc');
						$this->db->order_by('header', 'asc');
						$this->db->order_by('level1', 'asc');
						$this->db->order_by('level2', 'asc');
						$this->db->order_by('level3', 'asc');
						//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
						$q3 = $this->db->get();
						$qn3 = $this->db->query('SELECT FOUND_ROWS() AS ttl');
						$n3 = $qn3->row()->ttl;
						$no3 = $_POST['start'];
						if ($q3->num_rows() > 0) {
							foreach ($q3->result_array() as $r3) {
								$no++;
								$opsi = '<a href="#" onClick="update_data(\'' . $r3['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r3['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
								if ($r3['kunci'] == '1') {
									$opsi = '<a href="#" onClick="update_data(\'' . $r3['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
								}

								$row  = array(
									$r3['header'],
									$r3['level1'],
									$r3['level2'],
									$r3['level3'],
									($r3['saldo'] == '0.00') ? '' : '(' . $r3['tanggal'] . ') Rp. ' . number_format($r3['saldo'], 2),
									$opsi,
								);
								$data[] = $row;

								//child 3
								$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
									if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
									if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
									if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
									coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
								$this->db->from('finance_coa a');
								$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
								$this->db->group_start();
								$this->db->like('a.nama', $this->input->post('search_keyword'));
								$this->db->like('a.id', $this->input->post('search_keyword'));
								$this->db->group_end();
								if ($this->input->post('searchlevelsearchlevel') != '') {
									$this->db->where('a.level', $this->input->post('searchlevel'));
								}
								$this->db->where('a.parent', $r3['id']);
								$this->db->group_by('a.id');
								$this->db->order_by('a.id', 'asc');
								$this->db->order_by('header', 'asc');
								$this->db->order_by('level1', 'asc');
								$this->db->order_by('level2', 'asc');
								$this->db->order_by('level3', 'asc');
								//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
								$q4 = $this->db->get();
								$qn4 = $this->db->query('SELECT FOUND_ROWS() AS ttl');
								$n4 = $qn4->row()->ttl;
								$no4 = $_POST['start'];
								if ($q4->num_rows() > 0) {
									foreach ($q4->result_array() as $r4) {
										$no++;
										$opsi = '<a href="#" onClick="update_data(\'' . $r4['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r4['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
										if ($r4['kunci'] == '1') {
											$opsi = '<a href="#" onClick="update_data(\'' . $r4['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
										}

										$row  = array(
											$r4['header'],
											$r4['level1'],
											$r4['level2'],
											$r4['level3'],
											($r4['saldo'] == '0.00') ? '' : '(' . $r4['tanggal'] . ') Rp. ' . number_format($r4['saldo'], 2),
											$opsi,
										);
										$data[] = $row;

										//child 4
										$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
											if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
											if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
											if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
											coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
										$this->db->from('finance_coa a');
										$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
										$this->db->group_start();
										$this->db->like('a.nama', $this->input->post('search_keyword'));
										$this->db->like('a.id', $this->input->post('search_keyword'));
										$this->db->group_end();
										if ($this->input->post('searchlevelsearchlevel') != '') {
											$this->db->where('a.level', $this->input->post('searchlevel'));
										}
										$this->db->where('a.parent', $r4['id']);
										$this->db->group_by('a.id');
										$this->db->order_by('a.id', 'asc');
										$this->db->order_by('header', 'asc');
										$this->db->order_by('level1', 'asc');
										$this->db->order_by('level2', 'asc');
										$this->db->order_by('level3', 'asc');
										//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
										$q5 = $this->db->get();
										$qn5 = $this->db->query('SELECT FOUND_ROWS() AS ttl');
										$n5 = $qn5->row()->ttl;
										$no5 = $_POST['start'];
										if ($q5->num_rows() > 0) {
											foreach ($q5->result_array() as $r5) {
												$no++;
												$opsi = '<a href="#" onClick="update_data(\'' . $r5['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r5['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
												if ($r5['kunci'] == '1') {
													$opsi = '<a href="#" onClick="update_data(\'' . $r5['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
												}

												$row  = array(
													$r5['header'],
													$r5['level1'],
													$r5['level2'],
													$r5['level3'],
													($r5['saldo'] == '0.00') ? '' : '(' . $r5['tanggal'] . ') Rp. ' . number_format($r5['saldo'], 2),
													$opsi,
												);
												$data[] = $row;

												//child 5
												$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
													if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
													if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
													if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
													coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
												$this->db->from('finance_coa a');
												$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
												$this->db->group_start();
												$this->db->like('a.nama', $this->input->post('search_keyword'));
												$this->db->like('a.id', $this->input->post('search_keyword'));
												$this->db->group_end();
												if ($this->input->post('searchlevelsearchlevel') != '') {
													$this->db->where('a.level', $this->input->post('searchlevel'));
												}
												$this->db->where('a.parent', $r5['id']);
												$this->db->group_by('a.id');
												$this->db->order_by('a.id', 'asc');
												$this->db->order_by('header', 'asc');
												$this->db->order_by('level1', 'asc');
												$this->db->order_by('level2', 'asc');
												$this->db->order_by('level3', 'asc');
												//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
												$q6 = $this->db->get();
												$qn6 = $this->db->query('SELECT FOUND_ROWS() AS ttl');
												$n6 = $qn6->row()->ttl;
												$no6 = $_POST['start'];
												if ($q6->num_rows() > 0) {
													foreach ($q6->result_array() as $r6) {
														$no++;
														$opsi = '<a href="#" onClick="update_data(\'' . $r6['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r6['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
														if ($r6['kunci'] == '1') {
															$opsi = '<a href="#" onClick="update_data(\'' . $r6['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
														}

														$row  = array(
															$r6['header'],
															$r6['level1'],
															$r6['level2'],
															$r6['level3'],
															($r6['saldo'] == '0.00') ? '' : '(' . $r6['tanggal'] . ') Rp. ' . number_format($r6['saldo'], 2),
															$opsi,
														);
														$data[] = $row;

														//child 6
														$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.level = 0, concat(a.id,' - ',a.nama),'') as header, 
															if(a.level = 1, concat(a.id,' - ',a.nama),'') as level1, 
															if(a.level = 2, concat(a.id,' - ',a.nama),'') as level2, 
															if(a.level = 3, concat(a.id,' - ',a.nama),'') as level3, 
															coalesce(sum(b.saldo), 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
														$this->db->from('finance_coa a');
														$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
														$this->db->group_start();
														$this->db->like('a.nama', $this->input->post('search_keyword'));
														$this->db->like('a.id', $this->input->post('search_keyword'));
														$this->db->group_end();
														if ($this->input->post('searchlevelsearchlevel') != '') {
															$this->db->where('a.level', $this->input->post('searchlevel'));
														}
														$this->db->where('a.parent', $r6['id']);
														$this->db->group_by('a.id');
														$this->db->order_by('a.id', 'asc');
														$this->db->order_by('header', 'asc');
														$this->db->order_by('level1', 'asc');
														$this->db->order_by('level2', 'asc');
														$this->db->order_by('level3', 'asc');
														//if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
														$q7 = $this->db->get();
														$qn7 = $this->db->query('SELECT FOUND_ROWS() AS ttl');
														$n7 = $qn7->row()->ttl;
														$no7 = $_POST['start'];
														if ($q7->num_rows() > 0) {
															foreach ($q7->result_array() as $r7) {
																$no++;
																$opsi = '<a href="#" onClick="update_data(\'' . $r7['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r7['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
																if ($r7['kunci'] == '1') {
																	$opsi = '<a href="#" onClick="update_data(\'' . $r7['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
																}

																$row  = array(
																	$r7['header'],
																	$r7['level1'],
																	$r7['level2'],
																	$r7['level3'],
																	($r7['saldo'] == '0.00') ? '' : '(' . $r7['tanggal'] . ') Rp. ' . number_format($r7['saldo'], 2),
																	$opsi,
																);
																$data[] = $row;
															}
														}
														$q7->free_result();
													}
												}
												$q6->free_result();
											}
										}
										$q5->free_result();
									}
								}
								$q4->free_result();
							}
						}
						$q3->free_result();
					}
				}
				$q2->free_result();
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


	function get_data_tablea()
	{
		$data = '';

		$this->db->select("*", false);
		$this->db->where("parent", '0');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get('finance_coa');
		if ($q->num_rows() > 0) {
			$data .= '<ul style="list-style:none;">';
			foreach ($q->result_array() as $r) {
				$data .= '<li><b>' . $r['id'] . '</b> | <b>' . strtoupper($r['nama']) . '</b>';
				$this->db->select("a.*, coalesce(b.saldo, 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
				$this->db->from('finance_coa a');
				$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
				$this->db->where("a.parent", $r['id']);
				$this->db->group_by('a.id');
				$this->db->order_by('a.id', 'asc');
				$q2 = $this->db->get();
				if ($q2->num_rows() > 0) {
					$data .= '<ul style="list-style:none;">';
					foreach ($q2->result_array() as $r2) {
						$edit = ' <a href="#" onclick="update_data(\'' . $r2['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#003399;">&#xE5D2;</i></a>';
						$delete = ' <a href="#" onclick="delete_data(\'' . $r2['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#bc0606;">&#xE92B;</i></a>';
						if ($r2['kunci'] == '1') {
							$delete = '';
						}
						$data .= '<li>' . $r2['id'] . ' | ' . $edit . $delete . $r2['nama'];
						$data .= (($r2['saldo'] != '0.00' && $r2['saldo'] != '0') ? '<span style="color:blue; margin-left:20px;">(' . $r2['tanggal'] . ') Rp ' . number_format($r2['saldo'], 2) . '</span>' : '');
						$this->db->select("a.*, coalesce(b.saldo, 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
						$this->db->from('finance_coa a');
						$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
						$this->db->where("a.parent", $r2['id']);
						$this->db->group_by('a.id');
						$this->db->order_by('a.id', 'asc');
						$q3 = $this->db->get();
						if ($q3->num_rows() > 0) {
							$data .= '<ul style="list-style:none;">';
							foreach ($q3->result_array() as $r3) {
								$edit = ' <a href="#" onclick="update_data(\'' . $r3['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#003399;">&#xE5D2;</i></a>';
								$delete = ' <a href="#" onclick="delete_data(\'' . $r3['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#bc0606;">&#xE92B;</i></a>';
								if ($r3['kunci'] == '1') {
									$delete = '';
								}
								$data .= '<li>' . $r3['id'] . ' | ' . $edit . $delete . $r3['nama'];
								$data .= (($r3['saldo'] != '0.00' && $r3['saldo'] != '0') ? '<span style="color:blue; margin-left:20px;">(' . $r3['tanggal'] . ') Rp ' . number_format($r3['saldo'], 2) . '</span>' : '');
								$this->db->select("a.*, coalesce(b.saldo, 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
								$this->db->from('finance_coa a');
								$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
								$this->db->where("a.parent", $r3['id']);
								$this->db->group_by('a.id');
								$this->db->order_by('a.id', 'asc');
								$q4 = $this->db->get();
								if ($q4->num_rows() > 0) {
									$data .= '<ul style="list-style:none;">';
									foreach ($q4->result_array() as $r4) {
										$edit = ' <a href="#" onclick="update_data(\'' . $r4['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#003399;">&#xE5D2;</i></a>';
										$delete = ' <a href="#" onclick="delete_data(\'' . $r4['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#bc0606;">&#xE92B;</i></a>';
										if ($r4['kunci'] == '1') {
											$delete = '';
										}
										$data .= '<li>' . $r4['id'] . ' | ' . $edit . $delete . $r4['nama'];
										$data .= (($r4['saldo'] != '0.00' && $r4['saldo'] != '0') ? '<span style="color:blue; margin-left:20px;">(' . $r4['tanggal'] . ') Rp ' . number_format($r4['saldo'], 2) . '</span>' : '');
										$this->db->select("a.*, coalesce(b.saldo, 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
										$this->db->from('finance_coa a');
										$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
										$this->db->where("a.parent", $r4['id']);
										$this->db->group_by('a.id');
										$this->db->order_by('a.id', 'asc');
										$q5 = $this->db->get();
										if ($q5->num_rows() > 0) {
											$data .= '<ul style="list-style:none;">';
											foreach ($q5->result_array() as $r5) {
												$edit = ' <a href="#" onclick="update_data(\'' . $r5['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#003399;">&#xE5D2;</i></a>';
												$delete = ' <a href="#" onclick="delete_data(\'' . $r5['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#bc0606;">&#xE92B;</i></a>';
												if ($r5['kunci'] == '1') {
													$delete = '';
												}
												$data .= '<li>' . $r5['id'] . ' | ' . $edit . $delete . $r5['nama'];
												$data .= (($r5['saldo'] != '0.00' && $r5['saldo'] != '0') ? '<span style="color:blue; margin-left:20px;">(' . $r5['tanggal'] . ') Rp ' . number_format($r5['saldo'], 2) . '</span>' : '');
												$this->db->select("a.*, coalesce(b.saldo, 0.00) as saldo, coalesce(date_format(b.tanggal,'%d/%m/%y'),'') as tanggal", false);
												$this->db->from('finance_coa a');
												$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
												$this->db->where("a.parent", $r5['id']);
												$this->db->group_by('a.id');
												$this->db->order_by('a.id', 'asc');
												$q6 = $this->db->get();
												if ($q6->num_rows() > 0) {
													$data .= '<ul style="list-style:none;">';
													foreach ($q6->result_array() as $r6) {
														$edit = ' <a href="#" onclick="update_data(\'' . $r6['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#003399;">&#xE5D2;</i></a>';
														$delete = ' <a href="#" onclick="delete_data(\'' . $r6['id'] . '\')"><i class="material-icons" style="font-size:18px; color:#bc0606;">&#xE92B;</i></a>';
														if ($r6['kunci'] == '1') {
															$delete = '';
														}
														$data .= '<li>' . $r6['id'] . ' | ' . $edit . $delete . $r6['nama'];
														$data .= (($r6['saldo'] != '0.00' && $r6['saldo'] != '0') ? '<span style="color:blue; margin-left:20px;">(' . $r6['tanggal'] . ') Rp ' . number_format($r6['saldo'], 2) . '</span>' : '');
														$data .= '</li>';
													}
													$data .= '</ul>';
												}
												$data .= '</li>';
											}
											$data .= '</ul>';
										}
										$data .= '</li>';
									}
									$data .= '</ul>';
								}
								$data .= '</li>';
							}
							$data .= '</ul>';
						}
						$data .= '</li>';
					}
					$data .= '</ul>';
				}
				$data .= '</li>';
			}
			$data .= '</ul>';
		}
		$q->free_result();

		return $data;
	}

	function insert()
	{
		$number = $this->input->post('group_type') . $this->input->post('number');
		if ($number < 100000) {
			$msg = 'Account number harus lebih besar dari 100000';
		} else {
			$this->db->where('id', $number);
			$q = $this->db->get('finance_coa');
			if ($q->num_rows() > 0) {
				$msg = 'Account number telah digunakan';
			} else {
				$saldo = str_replace(",", "", $this->input->post('saldo'));
				$data = array(
					'id' => $number,
					'nama' => $this->input->post('nama'),
					'parent' => $this->input->post('parent'),
					'kelompok' => $this->input->post('group_type'),
					'tukar' => $this->input->post('tukar'),
					'level' => $this->input->post('level'),
					//'tanggal' => $this->input->post('tanggal'),
					//'saldo' => $saldo,
					//'komponen' => $this->input->post('komponen'),
				);
				$result = $this->db->insert('finance_coa', $data);
				if ($result == true) {
					$this->update_saldo_coa($this->m_global->cek_id_regional($this->session->userdata('scope_area')), $number, $number, $saldo, $this->input->post('tanggal'));
					$msg = 1;
				} else {
					$msg = 0;
				}
			}
		}
		return $msg;
	}

	function select()
	{
		$this->db->select("a.*, RIGHT(a.id, 5) as account_number, coalesce(b.saldo, 0.00) as saldo, coalesce(b.tanggal,'') as tanggal", false);
		$this->db->from('finance_coa a');
		$this->db->join('finance_coa_saldo b', "a.id = b.id_biaya AND b.branch = '" . $this->m_global->cek_id_regional($this->session->userdata('scope_area')) . "'", 'left');
		$this->db->where("a.id", $this->input->post('id'));
		$this->db->group_by('a.id');
		$q = $this->db->get();
		return $q->result();
	}

	function update()
	{
		$this->db->trans_start();
		$number = $this->input->post('group_type') . $this->input->post('number');
		if ($number < 100000) {
			$msg = 'Account number harus lebih besar dari 100000';
		} else {
			$this->db->where('id', $number);
			$this->db->where('id !=', $this->input->post('id'));
			$q = $this->db->get('finance_coa');
			if ($q->num_rows() > 0) {
				$msg = 'Account number telah digunakan';
			} else {
				$saldo = str_replace(",", "", $this->input->post('saldo'));
				$data = array(
					'id' => $number,
					'nama' => $this->input->post('nama'),
					'parent' => $this->input->post('parent'),
					'kelompok' => $this->input->post('group_type'),
					'tukar' => $this->input->post('tukar'),
					'level' => $this->input->post('level'),
					//'tanggal' => $this->input->post('tanggal'),
					//'saldo' => $saldo,
				);
				$this->db->where('id', $this->input->post('id'));
				$result = $this->db->update('finance_coa', $data);
				if ($result == true) {
					$this->update_saldo_coa($this->m_global->cek_id_regional($this->session->userdata('scope_area')), $this->input->post('id'), $number, $saldo, $this->input->post('tanggal'));
					$this->db->query("UPDATE gmd_finance_coa SET parent = '" . $number . "' WHERE parent = '" . $this->input->post('id') . "'");
					$this->db->query("UPDATE gmd_finance_coa_general_ledger_detail SET id_biaya = '" . $number . "' WHERE id_biaya = '" . $this->input->post('id') . "'");
					$this->db->query("UPDATE gmd_finance_coa_general_ledger_daily SET id_biaya = '" . $number . "' WHERE id_biaya = '" . $this->input->post('id') . "'");
					$this->db->query("UPDATE gmd_finance_coa_general_ledger_monthly SET id_biaya = '" . $number . "' WHERE id_biaya = '" . $this->input->post('id') . "'");
					// $this->db->query("UPDATE gmd_finance_coa_automatic SET coa = '" . $number . "' WHERE coa = '" . $this->input->post('id') . "'");
					$msg = 1;
				} else {
					$msg = 0;
				}
			}
		}
		$this->db->trans_complete();
		return $msg;
	}

	function delete($id)
	{
		if ($this->delete_check($id) == true) {
			$this->db->where('id', $id);
			$result = $this->db->delete('finance_coa');
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
		$this->db->where('parent', $id);
		$q = $this->db->get('finance_coa');
		if ($q->num_rows() > 0) {
			$data = false;
		}
		$this->db->where('id_biaya', $id);
		$q = $this->db->get('finance_coa_general_ledger_detail');
		if ($q->num_rows() > 0) {
			$data = false;
		}
		$this->db->where('id_biaya', $id);
		$this->db->where("(debet + kredit) != '0.00'", NULL, FALSE);
		$q = $this->db->get('finance_coa_general_ledger_daily');
		if ($q->num_rows() > 0) {
			$data = false;
		}
		$this->db->where('id_biaya', $id);
		$this->db->where("(debet + kredit) != '0.00'", NULL, FALSE);
		$q = $this->db->get('finance_coa_general_ledger_monthly');
		if ($q->num_rows() > 0) {
			$data = false;
		}
		$this->db->where('coa', $id);
		$q = $this->db->get('finance_coa_automatic');
		if ($q->num_rows() > 0) {
			$data = false;
		}
		$this->db->where('id_biaya', $id);
		$this->db->where("saldo != '0.00'", NULL, FALSE);
		$q = $this->db->get('finance_coa_saldo');
		if ($q->num_rows() > 0) {
			$data = false;
		}

		return $data;
	}

	function select_parent($id, $pilih, $group_number)
	{
		$data = '';

		$this->db->where("parent", '0');
		$this->db->where("id !=", $id);
		//$this->db->like("kelompok", $group_number);
		$this->db->order_by('id', 'asc');
		$q = $this->db->get('finance_coa');
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $r) {
				$slc = ($r['id'] == $pilih) ? 'selected="selected"' : '';
				$data .= '<option value="' . $r['id'] . '" ' . $slc . '>' . $r['id'] . ' - ' . $r['nama'] . '</option>';
				$this->db->where("parent", $r['id']);
				$this->db->where("id !=", $id);
				$this->db->order_by('id', 'asc');
				$q2 = $this->db->get('finance_coa');
				if ($q2->num_rows() > 0) {
					foreach ($q2->result_array() as $r2) {
						$spasi = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						$spasi2 = '&nbsp;&nbsp;&nbsp;';
						$spasi3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						$slc = ($r2['id'] == $pilih) ? 'selected="selected"' : '';
						$data .= '<option value="' . $r2['id'] . '" ' . $slc . ' style="padding-left:45px;">' . $spasi . '|_' . $r2['id'] . ' - ' . $r2['nama'] . '</option>';
						$this->db->where("parent", $r2['id']);
						$this->db->where("id !=", $id);
						$this->db->order_by('id', 'asc');
						$q3 = $this->db->get('finance_coa');
						if ($q3->num_rows() > 0) {
							foreach ($q3->result_array() as $r3) {
								$slc = ($r3['id'] == $pilih) ? 'selected="selected"' : '';
								$data .= '<option value="' . $r3['id'] . '" ' . $slc . ' style="padding-left:90px;">' . $spasi . $spasi . $spasi2 . '|_' . $r3['id'] . ' - ' . $r3['nama'] . '</option>';
								$this->db->where("parent", $r3['id']);
								$this->db->where("id !=", $id);
								$this->db->order_by('id', 'asc');
								$q4 = $this->db->get('finance_coa');
								if ($q4->num_rows() > 0) {
									foreach ($q4->result_array() as $r4) {
										$slc = ($r4['id'] == $pilih) ? 'selected="selected"' : '';
										$data .= '<option value="' . $r4['id'] . '" ' . $slc . ' style="padding-left:135px;">' . $spasi . $spasi . $spasi . $spasi3 . '|_' . $r4['id'] . ' - ' . $r4['nama'] . '</option>';
										$this->db->where("parent", $r4['id']);
										$this->db->where("id !=", $id);
										$this->db->order_by('id', 'asc');
										$q5 = $this->db->get('finance_coa');
										if ($q5->num_rows() > 0) {
											foreach ($q5->result_array() as $r5) {
												$slc = ($r5['id'] == $pilih) ? 'selected="selected"' : '';
												$data .= '<option value="' . $r5['id'] . '" ' . $slc . ' style="padding-left:180px;">' . $spasi . $spasi . $spasi . $spasi . $spasi3 . $spasi2 . '|_' . $r5['id'] . ' - ' . $r5['nama'] . '</option>';
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		$q->free_result();

		return $data;
	}

	function get_number_type($id)
	{
		$this->db->select("*, RIGHT(id, 5) as account_number", false);
		$this->db->where("id", $id);
		$q = $this->db->get("finance_coa");
		return $q->result();
	}

	function update_saldo_coa($branch, $id_biaya_old, $id_biaya, $saldo, $tanggal)
	{
		$this->db->where('branch', $branch);
		$this->db->where('id_biaya', $id_biaya_old);
		$result = $this->db->delete('finance_coa_saldo');
		if ($result == true) {
			$data = array(
				'branch' => $branch,
				'id_biaya' => $id_biaya,
				'saldo' => $saldo,
				'tanggal' => $tanggal,
			);
			$this->db->insert('finance_coa_saldo', $data);
		}
	}
}
