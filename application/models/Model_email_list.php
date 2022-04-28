<?php
class Model_email_list extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function info_modul($request_code)
	{
		$this->db->where('code', $request_code);
		$data = $this->db->get('modul')->row_array();
		// pre($this->db->last_query());
		return $data;
	}

    function data($category)
    {
        $this->db->where('category', $category);
        $this->scope->where('email');
		$data = $this->db->get('email')->result_array();
		// pre($this->db->last_query());
		return $data;
    }

    function detail($id)
    {
        $this->db->where('id', $id);
		$data = $this->db->get('email')->row_array();
        return $data;
    }

    function tabs()
	{
		$arr = array();

		$arr['selected'] = array(
			'name'=>'Customer Call / Visit',
			'code'=>'customer_care',
			'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
                    array('label'   => 'Nama'),
                    array('label'   => 'Kode'),
                    array('label'   => 'Penerima'),
                    array('label'   => 'Catatan'),
                    array('label'   => 'Action', 'width'=>'80'),
    			)
		);

        $arr[''] = array(
			'name'=>'Lap. Pekerjaan',
			'code'=>'laporan_pekerjaan',
			'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
                    array('label'   => 'Nama'),
                    array('label'   => 'Kode'),
                    array('label'   => 'Penerima'),
                    array('label'   => 'Catatan'),
                    array('label'   => 'Action', 'width'=>'80'),
    			)
		);

		return $arr;
	}

    function get_by_category($category)
    {
        $arr = array();
        $this->db->where('category', $category)
            ->where('regional',session_scope_regional() )
            ->where('area', session_scope_area() );
        $emails = $this->db->get('email')->result_array();
        if(!empty($emails)):
            foreach($emails as $row):
                $arr[$row['receiver']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

}
