<?php
class Model_task_report extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get_report_ext($report_id)
    {
        $data = $this->db->query("SELECT * FROM {PRE}task_report WHERE task_id='".$report_id."'")->row_array();
        // pre($this->db->last_query());
        return $data;
    }

    function set_report_ext($report_id)
    {
        $cek = $this->db->query("SELECT * FROM {PRE}task_report WHERE task_id='".$report_id."'")->result_array();
        if(empty($cek)):
            $data = array(
                'task_id'                       => $report_id,
                'owncloud'                      => $this->input->post('owncloud'),
            );
            $this->db->insert('task_report', $data);
        else:
            $data = array(
                'owncloud'                      => $this->input->post('owncloud'),
            );
            $this->db->where('task_id', $report_id);
            $this->db->update('task_report', $data);
        endif;
    }

    function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
		if(!empty($task_detail)):
			foreach($task_detail as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;
		return $arr;
	}

    function get_pre_survey_data($report_id)
    {
        $data = $this->db->query("SELECT * FROM {PRE}task_report_presurvey WHERE task_id='".$report_id."'")->row_array();
        // pre($this->db->last_query());
        return $data;
    }

    function set_pre_survey_data($report_id)
    {
        $cek = $this->db->query("SELECT * FROM {PRE}task_report_presurvey WHERE task_id='".$report_id."'")->result_array();
        if(empty($cek)):
            $data = array(
                'task_id'                       => $report_id,
                'status_coverage'               => $this->input->post('status_coverage'),
                'koordinat'                     => $this->input->post('koordinat'),
                'jarak_opd_pelanggan'           => $this->input->post('jarak_opd_pelanggan'),
                'estimasi_waktu_pengerjaan'     => $this->input->post('estimasi_waktu_pengerjaan'),
                'jenis_tower'                   => $this->input->post('jenis_tower'),
                'tinggi_tower'                  => $this->input->post('tinggi_tower'),
                'estimasi_biaya'                => $this->input->post('estimasi_biaya'),
                'nama_vendor'                   => $this->input->post('nama_vendor'),
                'note'                          => $this->input->post('note'),
            );
            $this->db->insert('task_report_presurvey', $data);
        else:
            $data = array(
                'status_coverage'               => $this->input->post('status_coverage'),
                'koordinat'                     => $this->input->post('koordinat'),
                'jarak_opd_pelanggan'           => $this->input->post('jarak_opd_pelanggan'),
                'estimasi_waktu_pengerjaan'     => $this->input->post('estimasi_waktu_pengerjaan'),
                'jenis_tower'                   => $this->input->post('jenis_tower'),
                'tinggi_tower'                  => $this->input->post('tinggi_tower'),
                'estimasi_biaya'                => $this->input->post('estimasi_biaya'),
                'nama_vendor'                   => $this->input->post('nama_vendor'),
                'note'                          => $this->input->post('note'),
            );
            $this->db->where('task_id', $report_id);
            $this->db->update('task_report_presurvey', $data);
        endif;
    }

    // function get_link_field($modul, $section)
    // {
    //     $this->db->where('modul', $modul);
    //     $this->db->where('section', $section);
    //     $fields = $this->db->get('form')->result_array();
    //     foreach($_POST as $post):
    //     endforeach;
    // }

    function get_survey_link($report_id, $ps='')
    {
        $this->db->where('task_id', $report_id);
        $this->db->where('ps', $ps);
        return $this->db->get('task_report_survey_link')->row_array();
    }

    function get_install_link($report_id, $ps='')
    {
        $this->db->where('task_id', $report_id);
        $this->db->where('ps', $ps);
        return $this->db->get('task_report_install_link')->row_array();
    }

    function set_survey_link($report_id, $ps='')
    {
        $cek = $this->db->query("SELECT * FROM {PRE}task_report_survey_link WHERE task_id='".$report_id."' AND ps='".$ps."' ")->result_array();
        if(empty($cek)):
            $data = array(
                'task_id'                               => $report_id,
                'ps'                                    => $ps,
                // ------------------------------------------------
                'jenis'                                 => ($ps=='primary') ? $this->input->post('primary_link_type') : $this->input->post('secondary_link_type'),
                'fo_distribusi'                         => ($this->input->post('fo_distribusi_'.$ps) !='') ? $this->input->post('fo_distribusi_'.$ps) : '',
                'fo_jarak_odp_server'                   => ($this->input->post('fo_jarak_odp_server_'.$ps) !='') ? $this->input->post('fo_jarak_odp_server_'.$ps) : '',
                'fo_start_point'                        => ($this->input->post('fo_start_point_'.$ps) !='') ? $this->input->post('fo_start_point_'.$ps) : '',
                'fo_end_point'                          => ($this->input->post('fo_end_point_'.$ps) !='') ? $this->input->post('fo_end_point_'.$ps) : '',
                'fo_jenis_kabel'                        => ($this->input->post('fo_jenis_kabel_'.$ps) !='') ? $this->input->post('fo_jenis_kabel_'.$ps) : '',
                'fo_status_kabel'                       => ($this->input->post('fo_status_kabel_'.$ps) !='') ? $this->input->post('fo_status_kabel_'.$ps) : '',
                'fo_tiang_7'                            => ($this->input->post('fo_tiang_7_'.$ps) !='') ? $this->input->post('fo_tiang_7_'.$ps) : '',
                'fo_tiang_9'                            => ($this->input->post('fo_tiang_9_'.$ps) !='') ? $this->input->post('fo_tiang_9_'.$ps) : '',
                'fo_accessories'                        => ($this->input->post('fo_accessories_'.$ps) !='') ? $this->input->post('fo_accessories_'.$ps) : '',
                'wireless_bts'                          => ($this->input->post('wireless_bts_'.$ps) !='') ? $this->input->post('wireless_bts_'.$ps) : '',
                'wireless_bts_jarak'                    => ($this->input->post('wireless_bts_jarak_'.$ps) !='') ? $this->input->post('wireless_bts_jarak_'.$ps) : '',
                'wireless_bts_alternative'              => ($this->input->post('wireless_bts_alternative_'.$ps) !='') ? $this->input->post('wireless_bts_alternative_'.$ps) : '',
                'wireless_bts_jarak_alternative'        => ($this->input->post('wireless_bts_jarak_alternative_'.$ps) !='') ? $this->input->post('wireless_bts_jarak_alternative_'.$ps) : '',
                'wireless_jenis_tower'                  => ($this->input->post('wireless_jenis_tower_'.$ps) !='') ? $this->input->post('wireless_jenis_tower_'.$ps) : '',
                'wireless_tinggi_tower'                 => ($this->input->post('wireless_tinggi_tower_'.$ps) !='') ? $this->input->post('wireless_tinggi_tower_'.$ps) : '',
                'wireless_kabel'                        => ($this->input->post('wireless_kabel_'.$ps) !='') ? $this->input->post('wireless_kabel_'.$ps) : '',
                'wireless_access_point'                 => ($this->input->post('wireless_access_point_'.$ps) !='') ? $this->input->post('wireless_access_point_'.$ps) : '',
                'wireless_tangga'                       => ($this->input->post('wireless_tangga_'.$ps) !='') ? $this->input->post('wireless_tangga_'.$ps) : '',
                'note'                                  => ($this->input->post('note_'.$ps) !='') ? $this->input->post('note_'.$ps) : '',
                // ------------------------------------------------

            );
            $this->db->insert('task_report_survey_link', $data);
        else:
            $data = array(
                'task_id'                               => $report_id,
                'ps'                                    => $ps,
                // ------------------------------------------------
                'jenis'                                 => ($ps=='primary') ? $this->input->post('primary_link_type') : $this->input->post('secondary_link_type'),
                'fo_distribusi'                         => ($this->input->post('fo_distribusi_'.$ps) !='') ? $this->input->post('fo_distribusi_'.$ps) : '',
                'fo_jarak_odp_server'                   => ($this->input->post('fo_jarak_odp_server_'.$ps) !='') ? $this->input->post('fo_jarak_odp_server_'.$ps) : '',
                'fo_start_point'                        => ($this->input->post('fo_start_point_'.$ps) !='') ? $this->input->post('fo_start_point_'.$ps) : '',
                'fo_end_point'                          => ($this->input->post('fo_end_point_'.$ps) !='') ? $this->input->post('fo_end_point_'.$ps) : '',
                'fo_jenis_kabel'                        => ($this->input->post('fo_jenis_kabel_'.$ps) !='') ? $this->input->post('fo_jenis_kabel_'.$ps) : '',
                'fo_status_kabel'                       => ($this->input->post('fo_status_kabel_'.$ps) !='') ? $this->input->post('fo_status_kabel_'.$ps) : '',
                'fo_tiang_7'                            => ($this->input->post('fo_tiang_7_'.$ps) !='') ? $this->input->post('fo_tiang_7_'.$ps) : '',
                'fo_tiang_9'                            => ($this->input->post('fo_tiang_9_'.$ps) !='') ? $this->input->post('fo_tiang_9_'.$ps) : '',
                'fo_accessories'                        => ($this->input->post('fo_accessories_'.$ps) !='') ? $this->input->post('fo_accessories_'.$ps) : '',
                'wireless_bts'                          => ($this->input->post('wireless_bts_'.$ps) !='') ? $this->input->post('wireless_bts_'.$ps) : '',
                'wireless_bts_jarak'                    => ($this->input->post('wireless_bts_jarak_'.$ps) !='') ? $this->input->post('wireless_bts_jarak_'.$ps) : '',
                'wireless_bts_alternative'              => ($this->input->post('wireless_bts_alternative_'.$ps) !='') ? $this->input->post('wireless_bts_alternative_'.$ps) : '',
                'wireless_bts_jarak_alternative'        => ($this->input->post('wireless_bts_jarak_alternative_'.$ps) !='') ? $this->input->post('wireless_bts_jarak_alternative_'.$ps) : '',
                'wireless_jenis_tower'                  => ($this->input->post('wireless_jenis_tower_'.$ps) !='') ? $this->input->post('wireless_jenis_tower_'.$ps) : '',
                'wireless_tinggi_tower'                 => ($this->input->post('wireless_tinggi_tower_'.$ps) !='') ? $this->input->post('wireless_tinggi_tower_'.$ps) : '',
                'wireless_kabel'                        => ($this->input->post('wireless_kabel_'.$ps) !='') ? $this->input->post('wireless_kabel_'.$ps) : '',
                'wireless_access_point'                 => ($this->input->post('wireless_access_point_'.$ps) !='') ? $this->input->post('wireless_access_point_'.$ps) : '',
                'wireless_tangga'                       => ($this->input->post('wireless_tangga_'.$ps) !='') ? $this->input->post('wireless_tangga_'.$ps) : '',
                'note'                                  => ($this->input->post('note_'.$ps) !='') ? $this->input->post('note_'.$ps) : '',
                // ------------------------------------------------

            );
            $this->db->where('task_id', $report_id);
            $this->db->where('ps', $ps);
            $this->db->update('task_report_survey_link', $data);
        endif;
    }

    function set_install_link($report_id, $ps='')
    {
        $cek = $this->db->query("SELECT * FROM {PRE}task_report_install_link WHERE task_id='".$report_id."' AND ps='".$ps."' ")->result_array();
        if(empty($cek)):
            $data = array(
                'task_id'                               => $report_id,
                'ps'                                    => $ps,
                // ------------------------------------------------
                'jenis'                                 => ($ps=='primary') ? $this->input->post('primary_link_type') : $this->input->post('secondary_link_type'),
                'fo_odp' => ($this->input->post('fo_odp_'.$ps) !='') ? $this->input->post('fo_odp_'.$ps) : '',
                'fo_jenis_kabel' => ($this->input->post('fo_jenis_kabel_'.$ps) !='') ? $this->input->post('fo_jenis_kabel_'.$ps) : '',
                'fo_jarak_kabel' => ($this->input->post('fo_jarak_kabel_'.$ps) !='') ? $this->input->post('fo_jarak_kabel_'.$ps) : '',
                'fo_ont_onu' => ($this->input->post('fo_ont_onu_'.$ps) !='') ? $this->input->post('fo_ont_onu_'.$ps) : '',
                'fo_serial_number_ont_onu' => ($this->input->post('fo_serial_number_ont_onu_'.$ps) !='') ? $this->input->post('fo_serial_number_ont_onu_'.$ps) : '',
                'fo_mac_address_fo_ont_onu' => ($this->input->post('fo_mac_address_fo_ont_onu_'.$ps) !='') ? $this->input->post('fo_mac_address_fo_ont_onu_'.$ps) : '',
                'fo_power_optic_odp' => ($this->input->post('fo_power_optic_odp_'.$ps) !='') ? $this->input->post('fo_power_optic_odp_'.$ps) : '',
                'fo_power_optic_roset' => ($this->input->post('fo_power_optic_roset_'.$ps) !='') ? $this->input->post('fo_power_optic_roset_'.$ps) : '',
                'fo_ip_ptv_privat' => ($this->input->post('fo_ip_ptv_privat_'.$ps) !='') ? $this->input->post('fo_ip_ptv_privat_'.$ps) : '',
                'wireless_bts' => ($this->input->post('wireless_bts_'.$ps) !='') ? $this->input->post('wireless_bts_'.$ps) : '',
                'wireless_jarak' => ($this->input->post('wireless_jarak_'.$ps) !='') ? $this->input->post('wireless_jarak_'.$ps) : '',
                'wireless_signal_strenght' => ($this->input->post('wireless_signal_strenght_'.$ps) !='') ? $this->input->post('wireless_signal_strenght_'.$ps) : '',
                'wireless_kualitas_signal' => ($this->input->post('wireless_kualitas_signal_'.$ps) !='') ? $this->input->post('wireless_kualitas_signal_'.$ps) : '',
                'wireless_antena' => ($this->input->post('wireless_antena_'.$ps) !='') ? $this->input->post('wireless_antena_'.$ps) : '',
                'wireless_radio' => ($this->input->post('wireless_radio_'.$ps) !='') ? $this->input->post('wireless_radio_'.$ps) : '',
                'wireless_jenis_kabel' => ($this->input->post('wireless_jenis_kabel_'.$ps) !='') ? $this->input->post('wireless_jenis_kabel_'.$ps) : '',
                'wireless_jarak_kabel' => ($this->input->post('wireless_jarak_kabel_'.$ps) !='') ? $this->input->post('wireless_jarak_kabel_'.$ps) : '',
                // ------------------------------------------------

            );
            $this->db->insert('task_report_install_link', $data);
        else:
            $data = array(
                'task_id'                               => $report_id,
                'ps'                                    => $ps,
                // ------------------------------------------------
                'jenis'                                 => ($ps=='primary') ? $this->input->post('primary_link_type') : $this->input->post('secondary_link_type'),
                'fo_odp' => ($this->input->post('fo_odp_'.$ps) !='') ? $this->input->post('fo_odp_'.$ps) : '',
                'fo_jenis_kabel' => ($this->input->post('fo_jenis_kabel_'.$ps) !='') ? $this->input->post('fo_jenis_kabel_'.$ps) : '',
                'fo_jarak_kabel' => ($this->input->post('fo_jarak_kabel_'.$ps) !='') ? $this->input->post('fo_jarak_kabel_'.$ps) : '',
                'fo_ont_onu' => ($this->input->post('fo_ont_onu_'.$ps) !='') ? $this->input->post('fo_ont_onu_'.$ps) : '',
                'fo_serial_number_ont_onu' => ($this->input->post('fo_serial_number_ont_onu_'.$ps) !='') ? $this->input->post('fo_serial_number_ont_onu_'.$ps) : '',
                'fo_mac_address_fo_ont_onu' => ($this->input->post('fo_mac_address_fo_ont_onu_'.$ps) !='') ? $this->input->post('fo_mac_address_fo_ont_onu_'.$ps) : '',
                'fo_power_optic_odp' => ($this->input->post('fo_power_optic_odp_'.$ps) !='') ? $this->input->post('fo_power_optic_odp_'.$ps) : '',
                'fo_power_optic_roset' => ($this->input->post('fo_power_optic_roset_'.$ps) !='') ? $this->input->post('fo_power_optic_roset_'.$ps) : '',
                'fo_ip_ptv_privat' => ($this->input->post('fo_ip_ptv_privat_'.$ps) !='') ? $this->input->post('fo_ip_ptv_privat_'.$ps) : '',
                'wireless_bts' => ($this->input->post('wireless_bts_'.$ps) !='') ? $this->input->post('wireless_bts_'.$ps) : '',
                'wireless_jarak' => ($this->input->post('wireless_jarak_'.$ps) !='') ? $this->input->post('wireless_jarak_'.$ps) : '',
                'wireless_signal_strenght' => ($this->input->post('wireless_signal_strenght_'.$ps) !='') ? $this->input->post('wireless_signal_strenght_'.$ps) : '',
                'wireless_kualitas_signal' => ($this->input->post('wireless_kualitas_signal_'.$ps) !='') ? $this->input->post('wireless_kualitas_signal_'.$ps) : '',
                'wireless_antena' => ($this->input->post('wireless_antena_'.$ps) !='') ? $this->input->post('wireless_antena_'.$ps) : '',
                'wireless_radio' => ($this->input->post('wireless_radio_'.$ps) !='') ? $this->input->post('wireless_radio_'.$ps) : '',
                'wireless_jenis_kabel' => ($this->input->post('wireless_jenis_kabel_'.$ps) !='') ? $this->input->post('wireless_jenis_kabel_'.$ps) : '',
                'wireless_jarak_kabel' => ($this->input->post('wireless_jarak_kabel_'.$ps) !='') ? $this->input->post('wireless_jarak_kabel_'.$ps) : '',
                // ------------------------------------------------

            );
            $this->db->where('task_id', $report_id);
            $this->db->where('ps', $ps);
            $this->db->update('task_report_install_link', $data);
        endif;
    }

    function get_attachment_parent($task_id, $i=0)
    {
        $data = array();
        $this->db->select('task.id, task.up');
        $this->db->where('task.id', $task_id);
        // $this->db->join('task_attachment', 'task_attachment.task_id = task.id', 'left');
        // $this->db->join('users', 'users.id = task_attachment.author', 'left');
        $query = $this->db->get('task');
        $data = $query->row_array();

        //get attachment
        $this->db->select('task_attachment.file_name, users.name as author_name');
        $this->db->where('task_attachment.task_id', $task_id);
        $this->db->join('users', 'users.id = task_attachment.author', 'left');
        $query2 = $this->db->get('task_attachment');
        $data['attachment'] = $query2->result_array();

        if ($data['up'] != '') {
            $data['parent'] = $this->get_attachment_parent($data['up'], $i+1);
        }

        return $data;
    }

}
