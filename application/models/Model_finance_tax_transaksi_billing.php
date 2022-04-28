<?php
class Model_finance_tax_transaksi_billing extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.tanggal', 'b.nama', 'faktur', 'a.jumlah'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.tanggal';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, b.nama as nama_type,
		  if(a.msa = 0, 'MSD', 'MSA') as faktur", false);
		$this->db->from('finance_transaksi_tax_billing a');
		$this->db->join('finance_master_cat_tax_type b', 'a.tax_type = b.id', 'left');
		$this->db->group_start();
		$this->db->like('b.nama', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where("(a.tanggal between '".$this->input->post('searchDateFirst')."' and '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->group_by('a.id');
		$this->db->order_by($order_name, $order_dir);
		$this->db->order_by('a.id', 'asc');
        if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$opsi = '<a href="#" onClick="update_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
				$row  = array(
									$no.'.',
									$r['tanggalnya'],
									$r['nama_type'],
									$r['faktur'],
									number_format($r['jumlah'],0),
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
	 
	function insert(){
		$this->db->trans_start();
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'tanggal' => $this->input->post('tanggal'),
					'tax_type' => $this->input->post('tax_type'),
					'msa' => $this->input->post('msa'),
					'jumlah' => $jumlah,
					'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
					'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
				);
		$result=$this->db->insert('finance_transaksi_tax_billing', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}
	 
	function select(){
		$this->db->select("a.*", false);
		$this->db->from('finance_transaksi_tax_billing a');
		$this->db->where("a.id", $this->input->post('id'));
		$q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		$data = array( 
					'tanggal' => $this->input->post('tanggal'),
					'tax_type' => $this->input->post('tax_type'),
					'msa' => $this->input->post('msa'),
					'jumlah' => $jumlah,
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_transaksi_tax_billing', $data);	
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}
	
	function delete($id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$result=$this->db->delete('finance_transaksi_tax_billing');
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}
	 
	function save_data_import(){
		$this->db->trans_start();
		
		if(isset($_POST['tax_jumlah'])){
			foreach($_POST['tax_jumlah'] as $k => $v){
				$this->db->select("id", false);
				$this->db->from('finance_transaksi_tax_billing');
				$this->db->where('tanggal',trim($_POST['tax_tanggal'][$k]));
				$this->db->where('jumlah',trim($_POST['tax_jumlah'][$k]));
				$this->db->where('tax_type',$this->input->post('tax_type'));
				$this->db->where('msa',$this->input->post('msa'));
				$q = $this->db->get();
				if($q->num_rows() == 0){
					$jumlah = str_replace(",", "", $_POST['tax_jumlah'][$k]);
					$data = array( 
								'tanggal' => $_POST['tax_tanggal'][$k],
								'tax_type' => $this->input->post('tax_type'),
								'msa' => $this->input->post('msa'),
								'jumlah' => $jumlah,
								'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
								'regional' => $this->cek_id_regional($this->session->userdata('scope_regional')),
							);
					$result=$this->db->insert('finance_transaksi_tax_billing', $data);	
				}
				$q->free_result();
			}
		}
		$msg = 1;
		$this->db->trans_complete();
		return $msg;
	}
	 
	function finance_bank(){
		$this->db->order_by('name', 'asc');
		$q = $this->db->get('finance_bank');
		return $q;
	}
	
	function cek_id_regional($id){
		$data = 0;
		
		$q = $this->db->query("select id from gmd_regional where code = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	 
	function select_autocomplite(){
			$this->db->select("a.id, a.no_referensi, concat('<div>No Ref: <b>',a.no_referensi,'</b>
			, Inv Date: <b>',date_format(a.tanggal, '%d-%m-%Y'),'</b>
			, Vendor/Supplier: <b>',if(a.supplier = 0,'Lain2',b.nama),'</b>
			<br> Jumlah Tagihan: <b>',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'</b>
			<br> Sisa Tagihan: <b>',CAST(format(a.jumlah - a.bayar,0) AS CHAR CHARACTER SET utf8),'</b></div>') as konten", false);
			$this->db->from("finance_ap_invoice a");
			$this->db->join('finance_supplier b', 'a.supplier = b.id', 'left');
			$this->db->where("a.lunas", '0');
			$this->db->where("(a.no_referensi like '%".$this->input->post('term')."%'
		or b.nama like '%".$this->input->post('term')."%')", NULL, FALSE);
			$q = $this->db->get();
		return $q->result();
	}
	 
	function select_detail_ref($no_invoice){
		$data = '';
			$this->db->select("concat('(No Ref): ',a.no_referensi,', (INV DATE): ',date_format(a.tanggal, '%d-%m-%Y'),', (Vendor/Supplier): ',if(a.supplier = 0,'Lain2',b.nama),'
(JUMLAH TAGIHAN): ',CAST(format(a.jumlah,0) AS CHAR CHARACTER SET utf8),'
(SISA TAGIHAN): ',CAST(format(a.jumlah - a.bayar,0) AS CHAR CHARACTER SET utf8),'') as konten", false);
			$this->db->from("finance_ap_invoice a");
			$this->db->join('finance_supplier b', 'a.supplier = b.id', 'left');
			$this->db->where("a.id", $no_invoice);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$data = $r['konten'];
				}
			}
			$q->free_result();
		return $data;
	}
	
}
