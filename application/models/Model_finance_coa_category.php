<?php
class Model_finance_coa_category extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$page = ($this->input->post('page')) ? $this->input->post('page') : 1;
		$rp = ($this->input->post('rp')) ? $this->input->post('rp') : 10;
		$sortname = ($this->input->post('sortname')) ? $this->input->post('sortname') : 'a.id';
		$sortorder = ($this->input->post('sortorder')) ? $this->input->post('sortorder') : 'asc';
		
		header("Content-type: application/json");
		$jsonData = array('page'=>$page,'total'=>0,'rows'=>array());
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, if(a.tukar = 1, 'Debet (-), Kredit (+)', 'Debet (+), Kredit (-)') as mekanisme,
		if(COALESCE((SELECT count(id) from gmd_finance_coa where kelompok = a.kelompok and tukar != a.tukar),0) > 0,1,0) as cek_mekanisme", false);
		$this->db->where("(a.nama like '%".$this->input->post('searchKeyword')."%')", NULL, FALSE);
		$this->db->where('a.parent','0');
		$this->db->order_by($sortname, $sortorder);
		$q = $this->db->get('finance_coa a', $rp, (($page-1)*$rp));
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
		$no = (($page-1)*$rp);
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$delete = '<a href="#" onclick="delete_data(\''.$r['id'].'\')"><i class="icon-trash text-danger"></i></a>';
				if($r['kunci'] == '1'){
					$delete = '';
				}
				$sty_clr = '';
				if($r['cek_mekanisme'] == '1'){
					$sty_clr = ' style="color:#ff0000;"';
				}
				$entry  = array('id' =>$r['id'],
								'cell'=>array(
									'no' => $no.'.',
									'a.kelompok' => $r['kelompok'],
									'a.nama' => $r['nama'],
									'mekanisme' => '<span '.$sty_clr.'>'.$r['mekanisme'].'</span>',
									'edit' => '<a href="#" onclick="update_data(\''.$r['id'].'\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a> '.$delete,
									)
								);
				$jsonData['rows'][] = $entry;
			}
		}
		$q->free_result();
		$jsonData['total'] = $n;
		echo json_encode($jsonData); 
	}
	 
	function insert(){
		$this->db->where('kelompok', $this->input->post('kelompok'));
		$q = $this->db->get('finance_coa');
		if($q->num_rows() > 0){
			$msg = 'Group number telah digunakan';
		}else{
			$data = array( 
						'id' => $this->input->post('kelompok').'00000',
						'nama' => $this->input->post('nama'),
						'kelompok' => $this->input->post('kelompok'),
						'tukar' => $this->input->post('tukar'),
					);
			$result=$this->db->insert('finance_coa', $data);	
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}
		return $msg;
	}
	 
	function select(){
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("finance_coa");
		return $q->result();
	}
	 
	function update(){
		$this->db->where('kelompok', $this->input->post('kelompok'));
		$this->db->where('kelompok !=', $this->input->post('kelompok_lama'));
		$q = $this->db->get('finance_coa');
		if($q->num_rows() > 0){
			$msg = 'Group number telah digunakan';
		}else{
			$data = array( 
						'id' => $this->input->post('kelompok').'00000',
						'nama' => $this->input->post('nama'),
						'kelompok' => $this->input->post('kelompok'),
						'tukar' => $this->input->post('tukar'),
					);
			$this->db->where('id', $this->input->post('id'));
			$result=$this->db->update('finance_coa', $data);	
			if($result==true)
			{
				$this->db->query("UPDATE gmd_finance_coa SET kelompok = '".$this->input->post('kelompok')."', tukar = '".$this->input->post('tukar')."', parent = '".$this->input->post('kelompok')."00000', id = CONCAT('".$this->input->post('kelompok')."', RIGHT(id, 5)) WHERE kelompok = '".$this->input->post('kelompok_lama')."' AND parent != '0'");
				
				$this->db->query("UPDATE gmd_finance_coa_general_ledger_detail SET id_biaya = CONCAT('".$this->input->post('kelompok')."', RIGHT(id_biaya, 5)) WHERE LEFT(id_biaya, 1) = '".$this->input->post('kelompok_lama')."'");		
				
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}
		return $msg;
	}
	
	function delete($id)
	{
		if($this->delete_check($id) == true){
			$this->db->where('id', $id);
			$result=$this->db->delete('finance_coa');
			if($result==true)
			{
				$msg = 1;
			}
			else
			{
				$msg = 0;
			}
		}else{
			$msg = 'Data tidak dapat dihapus, masih digunakan sebagai relasi';	
		}
		return $msg;
	}
	
	function delete_check($id){
		$data = true;
		$this->db->where('parent', $id);
		$q = $this->db->get('finance_coa');	
		if($q->num_rows() > 0){
			$data = false;
		}
		
		return $data;
	}
	
}
