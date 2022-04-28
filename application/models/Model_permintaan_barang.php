<?php
class Model_permintaan_barang extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function daftar_barang_keluar($task_id='')
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_item_out')->result_array();
		return $data;
	}

	function daftar_barang_kembali($task_id='')
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_item_in')->result_array();
		return $data;
	}

    function get_request_id($task_id)
    {
        $this->db->where('up', $task_id);
        return $this->db->get('task')->row_array();
    }

    //list barang ketika membuat laporan installasi
    // function laporan_daftar_barang_keluar($task_id='')
    // {
    //     $request_id = $this->get_request_id($task_id);
    //     return $this->daftar_barang_keluar($request_id['id']);
    // }

    function sudah_request_dipasang($task_id, $task_category)
    {
        $arr_request_id = $this->get_rid($task_id, $task_category);
        $data = array();
        if(!empty($arr_request_id)):
            $this->db->where_in('task_id', $arr_request_id);
            $data = $this->db->get('task_item_out')->result_array();
        endif;
        return $data;
    }

    function barang_dipasang_belum_approved($task_id, $task_category)
    {
        $arr_request_id = $this->get_rid($task_id, $task_category);
        $data = array();
        if(!empty($arr_request_id)):
            $this->db->where_in('task_id', $arr_request_id);
            $this->db->where('status', 'request_out');
            $data = $this->db->get('task_item_out')->result_array();
        endif;
        return $data;
    }

    function sudah_request_kembali($task_id, $task_category)
    {
        $arr_request_id = $this->get_rid($task_id, $task_category);
        $data = array();
        if(!empty($arr_request_id)):
            $this->db->where_in('task_id', $arr_request_id);
            $data = $this->db->get('task_item_in')->result_array();
        endif;
        return $data;
    }

    function barang_kembali_belum_approved($task_id, $task_category)
    {
        $arr_request_id = $this->get_rid($task_id, $task_category);
        $data = array();
        if(!empty($arr_request_id)):
            $this->db->where_in('task_id', $arr_request_id);
            $this->db->where('status', 'request_in');
            $data = $this->db->get('task_item_in')->result_array();
        endif;
        return $data;
    }

    //list barang ketika membuat laporan dismantle
    function laporan_daftar_barang_masuk($task_id='')
    {
        $request_id = $this->get_request_id($task_id);
        return $this->daftar_barang_kembali($request_id['id']);
    }

    //function untuk mencari task id dengan param category dan "parent" task_id
    // result berupa array
    function get_rid($parent_task_id='', $category='request_out')
    {
        $arr_request_id = array();

        //dicari semua request barang keluaranya
        // table : gmd_task
        // param : task_id , task_category = 'request_out'
        $request_id = $this->db->query("SELECT * FROM {PRE}task WHERE up='".$parent_task_id."' AND task_category='".$category."' ")->result_array();
        // pre($this->db->last_query()); exit;
        if(!empty($request_id)):
            foreach($request_id as $row):
                $arr_request_id[] = $row['id'];
            endforeach;
        endif;
        return $arr_request_id;
    }

    function laporan_barang_dipasang($task_id='')
    {
        $arr_request_id = $this->get_rid($task_id, 'request_out');

        //setelah ketemu tasknya , kita cari item barangnya
        $data = array();
        if (!empty($arr_request_id)) :
            $this->db->where_in('task_id', $arr_request_id);
            $this->db->where('status', 'approved');
            $data = $this->db->get('task_item_out')->result_array();
        endif;
        // pre($this->db->last_query());
        return $data;
    }

    function laporan_barang_dipasang_replace($task_id='')
    {
        $arr_request_id = $this->get_rid($task_id, 'request_replace');

        //setelah ketemu tasknya , kita cari item barangnya
        $data = array();
        $this->db->where_in('task_id', $arr_request_id);
        $this->db->where('status', 'approved');
        $data = $this->db->get('task_item_out')->result_array();
        // pre($this->db->last_query());
        return $data;
    }



    function cek_permintaan_barang($task_id='')
    {
        $arr_request_id = $this->get_rid($task_id, 'request_out');
        $data = array();
        $this->db->where_in('task_id', $arr_request_id);
        $this->db->where('status', 'approved');
        $data = $this->db->get('task_item_out')->result_array();
        // pre($this->db->last_query());
        return $data;
    }

    function laporan_barang_dikembalikan($task_id='')
    {
        // pre($task_id); exit;
        $arr_request_id = $this->get_rid($task_id, 'request_in');

        //setelah ketemu tasknya , kita cari item barangnya
        $data = array();
        $this->db->where_in('task_id', $arr_request_id);
        $this->db->where('status', 'diterima');
        $data = $this->db->get('task_item_in')->result_array();
        // pre($this->db->last_query());
        return $data;
    }

    function laporan_barang_dikembalikan_replace($task_id='')
    {
        // pre($task_id); exit;
        $arr_request_id = $this->get_rid($task_id, 'request_replace');

        //setelah ketemu tasknya , kita cari item barangnya
        $data = array();
        $this->db->where_in('task_id', $arr_request_id);
        $this->db->where('status', 'diterima');
        $data = $this->db->get('task_item_in')->result_array();
        // pre($this->db->last_query());
        return $data;
    }
}
