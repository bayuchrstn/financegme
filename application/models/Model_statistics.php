<?php
class Model_statistics extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function ui($what, $about)
    {
        $arr = array();
        $arr['sidebar'] = 'tsd';
        $arr['main_title'] = 'Statistik';
        return $arr;
    }

    function contoh_array_statistik()
    {
        $arr = array();
        $arr['title'] = 'Judul Statistik';
	    $arr['label'] = array('senin', 'selasa', 'rabu', 'kamis');
        $arr['canvas_id'] = 'sswe';
	    $arr['datasets'][] = array(
	            'label' => 'makanan',
	            'data'  => array('26', '4', '7', '9'),
	            'color' => rgb_color_code('red'),
	        );
	    // $arr['datasets'][] = array(
	    //         'label' => 'minuman',
	    //         'data'  => array('21', '4', '9', '6'),
	    //         'color' => rgb_color_code('green'),
	    //     );
        return $arr;
    }

    function task_teknis()
    {
        $cat = $this->db->query("select count(gmd_customer.id) as jumlah, gmd_master.name, customer_type from gmd_customer
left join gmd_master ON (gmd_customer.customer_type=gmd_master.code and gmd_master.category='customer_type')
where customer_type > 0 and gmd_customer.status='customer' and status_active !='0' and customer_type !='12' and gmd_customer.regional='".session_scope_regional()."' group by customer_type")->result_array();
		// pre($cat);

        $arr_jenis = $this->master->arr('jenis_pekerjaan_teknis');
        // pre($arr_jenis);
        // exit;

		$arr_label = array();
		$arr_data = array();
		foreach($arr_jenis as $row=>$val):
			$arr_label[] = $val;

            $sql = "SELECT COUNT(id) as jumlah FROM {PRE}task WHERE task_category='task_teknis' AND category='".$row."' ";
            $qry_sql = $this->db->query($sql)->row_array();
			$arr_data[] = $qry_sql['jumlah'];
		endforeach;
        // pre($arr_label);
        // pre($arr_data);
        // exit;

        // main array
        $arr = array();
        $arr['title'] = 'Statistik Pekerjaan Teknis';
	    $arr['label'] = $arr_label;
        $arr['canvas_id'] = 'sswe';
	    $arr['datasets'][] = array(
	            'label' => 'pekerjaan',
	            'data'  => $arr_data,
	            'color' => rgb_color_code('blue'),
	        );
        // pre($arr);
        return $arr;
    }

}
