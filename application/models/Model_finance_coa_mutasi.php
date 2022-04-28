<?php
class Model_finance_coa_mutasi extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function coa_detail()
	{
		$data = '';
		
		$this->db->where("parent", '0');
		$this->db->order_by('id', 'asc');
		$q = $this->db->get('finance_coa');
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<option value="'.$r['id'].'" >'.$r['id'].' - '.$r['nama'].'</option>';
				$this->db->where("parent", $r['id']);
				$this->db->order_by('id', 'asc');
				$q2 = $this->db->get('finance_coa');
				if($q2->num_rows() > 0){
					foreach($q2->result_array() as $r2){
						$spasi = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						$spasi2 = '&nbsp;&nbsp;&nbsp;';
						$spasi3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						$data .= '<option value="'.$r2['id'].'" style="padding-left:45px;">'.$spasi.'|_'.$r2['id'].' - '.$r2['nama'].'</option>';
						$this->db->where("parent", $r2['id']);
						$this->db->order_by('id', 'asc');
						$q3 = $this->db->get('finance_coa');
						if($q3->num_rows() > 0){
							foreach($q3->result_array() as $r3){
								$data .= '<option value="'.$r3['id'].'" style="padding-left:90px;">'.$spasi.$spasi.$spasi2.'|_'.$r3['id'].' - '.$r3['nama'].'</option>';
								$this->db->where("parent", $r3['id']);
								$this->db->order_by('id', 'asc');
								$q4 = $this->db->get('finance_coa');
								if($q4->num_rows() > 0){
									foreach($q4->result_array() as $r4){
										$data .= '<option value="'.$r4['id'].'" style="padding-left:135px;">'.$spasi.$spasi.$spasi.$spasi3.'|_'.$r4['id'].' - '.$r4['nama'].'</option>';
										$this->db->where("parent", $r4['id']);
										$this->db->order_by('id', 'asc');
										$q5 = $this->db->get('finance_coa');
										if($q5->num_rows() > 0){
											foreach($q5->result_array() as $r5){
												$data .= '<option value="'.$r5['id'].'" style="padding-left:180px;">'.$spasi.$spasi.$spasi.$spasi.$spasi3.$spasi2.'|_'.$r5['id'].' - '.$r5['nama'].'</option>';
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

	function select_card_from()
	{
		$data = '<option value="">=== Pilih Card ===</option><option value="0">No Card</option>';
		$this->db->where("coa", $this->input->post('coa_from'));
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('finance_coa_card_name');
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<option value="'.$r['id'].'" >'.$r['nama'].'</option>';
			}
		}
		$q->free_result();
		
		return $data; 
	}

	function select_card_to()
	{
		$data = '<option value="">=== Pilih Card ===</option><option value="0">No Card</option>';
		$this->db->where("coa", $this->input->post('coa_to'));
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('finance_coa_card_name');
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<option value="'.$r['id'].'" >'.$r['nama'].'</option>';
			}
		}
		$q->free_result();
		
		return $data; 
	}
	 
	function update(){
		$this->db->trans_start();
		$this->db->query("UPDATE gmd_finance_coa_general_ledger_detail SET id_biaya = '".$this->input->post('coa_to')."', card_id = '".$this->input->post('card_to')."' WHERE id_biaya = '".$this->input->post('coa_from')."' AND card_id = '".$this->input->post('card_from')."'");
		//$this->db->query("UPDATE gmd_finance_coa_saldo SET id_biaya = '".$this->input->post('coa_to')."', card_id = '".$this->input->post('card_to')."' WHERE id_biaya = '".$this->input->post('coa_from')."' AND card_id = '".$this->input->post('card_from')."'");
		if($this->input->post('coa_to') != $this->input->post('coa_from')){
		//$this->db->query("UPDATE gmd_finance_coa_saldo SET id_biaya = '".$this->input->post('coa_to')."' WHERE id_biaya = '".$this->input->post('coa_from')."'");
		$this->db->query("UPDATE gmd_finance_coa_general_ledger_daily SET id_biaya = '".$this->input->post('coa_to')."' WHERE id_biaya = '".$this->input->post('coa_from')."'");
		$this->db->query("UPDATE gmd_finance_coa_general_ledger_monthly SET id_biaya = '".$this->input->post('coa_to')."' WHERE id_biaya = '".$this->input->post('coa_from')."'");
	}
		$msg = 1;
		$this->db->trans_complete();
		return $msg;
	}

	
}
