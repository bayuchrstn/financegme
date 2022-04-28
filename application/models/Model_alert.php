<?php
class Model_alert extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function data()
    {
        $arr = array();
        $this->scope->where('alert');

        //divisi
        $ddsju = "(find_in_set('".my_divisi()."', divisi) OR find_in_set('".my_department()."', department) OR find_in_set('".my_sub_department()."', sub_department) OR find_in_set('".my_jabatan()."', jabatan) OR find_in_set('".my_id()."', user_id) )";
        $this->db->where($ddsju);

        $hidden_from = "find_in_set('".my_id()."', hidden_from) = 0 ";
        $this->db->where($hidden_from);

        $data = $this->db->get('alert')->result_array();

        return $data;
    }

    function data_config()
    {
        $arr = array();
        $this->scope->where('alert_config');
        $data = $this->db->get('alert_config')->result_array();
        return $data;
    }

    function create($params = array())
    {
        $data = array();
        $data['title'] = 'ERP GMEDIA';
        $data['date_post'] = now();
        $data['max_show'] = '3';
        $data['time_interval'] = '30000';
        $data['regional'] = session_scope_regional();
        $data['area'] = session_scope_area();
        // pre($data);
        $final_data = array_replace($data, $params);
        // pre($final_data);
        $this->db->insert('alert', $final_data);
    }

    function get()
    {
        $arr = array();
        $this->scope->where('alert');

        //divisi
        $ddsju = "(find_in_set('".my_divisi()."', divisi) OR find_in_set('".my_department()."', department) OR find_in_set('".my_sub_department()."', sub_department) OR find_in_set('".my_jabatan()."', jabatan) OR find_in_set('".my_id()."', user_id) )";
        $this->db->where($ddsju);

        $hidden_from = "find_in_set('".my_id()."', hidden_from) = 0 ";
        $this->db->where($hidden_from);

        $data = $this->db->get('alert')->result_array();
        // pre($this->db->last_query());
        if(!empty($data)):
            foreach($data as $row):

                $reads = $this->get_read_count($row['id']);

                $max_show = ($row['max_show'] !='') ? $row['max_show'] : '3';
                if($reads < $max_show):
                // if(TRUE):

                    $starting_date = split_date($row['date_post']);
                    $unix_starting_date = mktime($starting_date['jam'],$starting_date['menit'],0,$starting_date['bulan'],$starting_date['tanggal'],$starting_date['tahun']);
                    $unix_sekarang = mktime(date('H'),date('i'),0,date('m'),date('d'),date('Y') );
                    $selisih = $unix_sekarang - $unix_starting_date;

                    $interval = (int) $row['time_interval'];
                    //300 = 5menit
                    $hasil_bagi = ($selisih / $interval);
            		// pre($hasil_bagi);

                    //jika kelipatan
            		if(is_int($hasil_bagi)){

                        $log = unserialize($row['user_read']);
                        $sekarang_tanpa_detik = substr(now(), 0, -3);

                        if( !in_array($sekarang_tanpa_detik, $log[my_id()]) ){
                            	// $data = array(
                				// 	'dp'	=> now()
                				// );
                				// $this->db->insert('te', $data);
                            $arr[] = $row;
                            $this->set_read($row['id']);
                		}

            		}


                endif;
            endforeach;
        endif;
        return $arr;
    }

    function get_read($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('alert_read')->row_array();
    }

    function detail($alert_id)
    {
        $this->db->where('id', $alert_id);
        return $this->db->get('alert')->row_array();
    }

    function detail_config($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('alert_config')->row_array();
    }

    function get_read_count_old($alert_id)
    {
        $detail = $this->detail($alert_id);
        pre($detail);
		$alert = explode(',', $detail['user_read']);
        // pre($alert);
        $jumlah = array_count_values($alert);
        // pre($jumlah);
        return (isset($jumlah[my_id()])) ? $jumlah[my_id()] : '0';
    }

    function get_read_count($alert_id)
    {
        $detail = $this->detail($alert_id);
        // pre($detail);
		$log = unserialize($detail['user_read']);

        // $sekarang_tanpa_detik = substr(now(), 0, -3);
        if( isset($log[my_id()]) ){
			return count($log[my_id()]);
		} else {
            return '0';
        }
    }

    function cek_interval($date_start, $date_end, $interval_second=300)
    {
        $date_start_mod = strtotime($date_start);
        $date_end_mod = strtotime($date_end);

        $interval = $date_start_mod - $date_end_mod;
        $interval = abs($interval);

        $result = $interval<=$interval_second ? true : false;
        return $result;
    }

    // function get_read_count_old($alert_id='12')
    // {
    //     $my_read = $this->get_read(my_id());
	// 	$alert = explode(',', $my_read['alert_id']);
    //     $jumlah = array_count_values($alert);
    //     return (isset($jumlah[$alert_id])) ? $jumlah[$alert_id] : '0';
    // }

    function set_read($alert_id='')
    {
        $detail = $this->detail($alert_id);
        $sekarang_tanpa_detik = substr(now(), 0, -3);
        if($detail['user_read']==''):
            $arr = array();
            $arr[my_id()] = array($sekarang_tanpa_detik);
            $enco = serialize($arr);

            $data = array(
                'user_read'           => $enco,
            );
            $this->db->where('id', $detail['id']);
            $this->db->update('alert', $data);
        else:
            if($detail['user_read'] !=''):
                $arr_log = unserialize($detail['user_read']);
                $arr_log[my_id()][] = $sekarang_tanpa_detik;
                $enco = serialize($arr_log);

                $data = array(
                    'user_read'          => $enco,
                );
                $this->db->where('id', $detail['id']);
                $this->db->update('alert', $data);
            endif;
        endif;
    }

    function get_groups_by_code($comma='', $category='')
    {
        $arr = explode(',', $comma);
        $this->db->where_in('code', $arr);
        $this->db->where('category', $category);
        return $this->db->get('usergroup')->result_array();
    }

    function get_user_by_code($comma='')
    {
        $arr = explode(',', $comma);
        $this->db->where_in('id', $arr);
        return $this->db->get('users')->result_array();
    }

    function get_group_name($comma='', $category='')
    {
        $arr_name = array();
        $data = ($category=='user_id') ? $this->get_user_by_code($comma, $category) : $this->get_groups_by_code($comma, $category);
        if(!empty($data)):
            foreach($data as $row):
                $arr_name[] = '<span class="mb-5 label label-default">'.$row['name'].'</span>';
            endforeach;
        endif;
        $name = (!empty($arr_name)) ? implode(' ', $arr_name) : '';
        return $name;
    }

    function detail_by_code($code)
    {
        $this->db->where('code', $code);
        return $this->db->get('alert_config')->row_array();
    }

    function get_config($code, $params = array())
    {
        $jangan = array('id', 'code', 'name', 'note');
        $arr = array();
        $detail = $this->detail_by_code($code);
        if(!empty($detail)):
            foreach($detail as $key=>$val):
                if(!in_array($key, $jangan)):
                    $arr[$key] = $val;
                endif;
            endforeach;
            $arr['date_post'] = now();
            $arr['regional'] = session_scope_regional();
            $arr['area'] = session_scope_area();
            $arr['active'] = '1';
        endif;
        $final_data = array_replace($arr, $params);
        return $final_data;
    }

}
