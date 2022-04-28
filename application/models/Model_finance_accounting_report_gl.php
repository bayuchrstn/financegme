<?php
class Model_finance_accounting_report_gl extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }
	
	function saldo(){
		$this->db->select("*, date_format(tanggal, '%d-%m-%Y') as tanggalnya", false);
		$this->db->from('finance_coa_general_ledger');
		$this->db->where("(tanggal BETWEEN '".$this->input->post('searchDateFirst')."' AND '".$this->input->post('searchDateFinish')."')", NULL, FALSE);
		//$this->db->where('dealer', $_SESSION[base_url().'SESS_ADMIN_DEALER_SELECT']);
		$this->db->order_by('tanggal', 'asc');
		$this->db->order_by('no_trans', 'asc');
		$q = $this->db->get();
		return $q;
	}
	
	function saldo_detail($no_trans){
		$this->db->select("a.*, b.nama as nama_biaya", false);
		$this->db->from('finance_coa_general_ledger_detail a');
		$this->db->where('a.no_trans', $no_trans);
		$this->db->group_start();
		$this->db->like('a.ket', $this->input->post('search_keyword'));
		$this->db->or_like('c.deskripsi', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->join('finance_coa b', 'a.id_biaya = b.id', 'left');
		$this->db->join('finance_coa_general_ledger c', 'a.no_trans = c.no_trans', 'left');
		//$this->db->where('a.dealer', $_SESSION[base_url().'SESS_ADMIN_DEALER_SELECT']);
		$this->db->order_by('a.debet', 'desc');
		$this->db->order_by('a.kredit', 'asc');
		$q = $this->db->get();
		return $q;
	}
		 
}
