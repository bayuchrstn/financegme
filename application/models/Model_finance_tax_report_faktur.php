<?php 
class Model_finance_tax_report_faktur extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal_faktur, '%d-%m-%Y') AS tanggalnya,
		  IF(a.tipe = 1, 'Masukan / Bukti Potong', 'Keluaran / Terbit') AS tipenya,
		  if(a.msa = 0, 'MSD', 'MSA') as faktur, 
		  b.nama AS nama_kat,
		  c.name AS nama_cab", false);
		$this->db->from('finance_transaksi_tax a');
		$this->db->group_start();
		$this->db->like('a.no_seri_faktur', $this->input->post('search_keyword'));
		$this->db->or_like('a.nama_pkp', $this->input->post('search_keyword'));
		$this->db->or_like('a.deskripsi', $this->input->post('search_keyword'));
		$this->db->group_end();
		if($this->input->post('searchtipe') != ''){
			$this->db->where('a.tipe', $this->input->post('searchtipe'));
		}
		if($this->input->post('searchtax_type') != ''){
			$this->db->where('a.tax_type', $this->input->post('searchtax_type'));
		}
		if($this->input->post('searchcabang') != ''){
			$this->db->where('a.cabang', $this->input->post('searchcabang'));
		}
		if($this->input->post('searchmsa') != ''){
			$this->db->where('a.msa', $this->input->post('searchmsa'));
		}
		$this->db->where("(a.tanggal_faktur BETWEEN '".$this->input->post('searchDateFirst')."' AND '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		$this->db->order_by('a.tanggal_faktur', 'asc');
		$this->db->where('a.branch', $this->model_global->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->join('finance_master_cat_tax_type b', 'a.tax_type = b.id', 'left');
		$this->db->join('regional c', 'a.cabang = c.id', 'left');
		$q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		
		$total = 0;
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$total += $r['jumlah'];
				$row  = array(
								$no.'.',
								$r['tanggalnya'],
								$r['tipenya'],
								$r['nama_kat'],
								$r['nama_cab'],
								$r['faktur'],
								$r['no_seri_faktur'],
								$r['nama_pkp'],
								number_format($r['jumlah'],0),
							);

	 
				$data[] = $row;
			}
		}
		$q->free_result();
		$row  = array(
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'<strong>'.number_format($total,0).'</strong>',
					);


		$data[] = $row;
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $n,
                        "recordsFiltered" => $n,
                        "data" => $data,
                );
        echo json_encode($output);
	}
	
	function saldo_detail(){
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');
		if($this->input->post('searchTanggal') == '1'){
			$tanggal_awal = $this->input->post('searchDateFirst');
			$tanggal_akhir = $this->input->post('searchDateFinish');
		}elseif($this->input->post('searchTanggal') == '3'){
			$tanggal_awal = $this->input->post('searchDateFinish2');
			$tanggal_akhir = $this->input->post('searchDateFinish2');
		}
		$q = $this->db->query("SELECT 
		  *, date_format(tanggal, '%d-%m-%Y') as tanggalnya 
		FROM
		  (SELECT 
			concat('1', id) as idnya, tanggal, deskripsi as ket, IF(tipe = 1, jumlah, 0.00) AS saldo_m, IF(tipe = 0, jumlah, 0.00) AS saldo_k 
		  FROM
			gmd_finance_transaksi_kasir 
		  WHERE kas_bank = '".$this->input->post('searchKasBank')."'
			AND branch = '".$this->model_global->cek_id_regional($this->session->userdata('scope_area'))."'
			AND (
			  tanggal BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'
			)
		) AS kasnya 
		ORDER BY tanggal ASC, saldo_m DESC, saldo_k ASC ");
		return $q;
	}
	
}
