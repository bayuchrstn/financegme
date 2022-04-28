<?php
class Model_finance_report_buku_bank extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_table()
    {
        $this->db->select("SQL_CALC_FOUND_ROWS a.*,IF(a.tipe = 'CR', a.jumlah,0) AS penambahan,
        IF(a.tipe = 'DB', a.jumlah,0) AS pengurangan,", false);
        $this->db->from('gmd_finance_buku_bank a');
        $this->db->group_start();
        $this->db->like('IFNULL(a.keterangan,"")', $this->input->post('search_keyword'));
        $this->db->like('IFNULL(a.detail,"")', $this->input->post('search_keyword'));
        $this->db->group_end();
        if ($this->input->post('id_biaya') != '') {
            $this->db->where('a.id_rek', $this->input->post('id_biaya'));
        }
        $this->db->where("(a.tanggal_transaksi BETWEEN '" . $this->input->post('searchDateFirst') . "' AND '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
        $this->db->order_by('a.tanggal_transaksi', 'asc');
        $this->db->order_by('a.id', 'asc');
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];

        $saldo = 0;
        if ($this->input->post('id_biaya') != '') {
            $saldo += $this->saldo_awal($this->input->post('id_biaya'));
        }
        $saldo_awal = $saldo;
        $row  = array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '<strong>' . number_format($saldo_awal, 2) . '</strong>',
            '',
            ''
        );


        $data[] = $row;

        $penambahan = 0.00;
        $pengurangan = 0.00;
        $keterangan = null;
        $detail = null;
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $penambahan += $r['penambahan'];
                $pengurangan += $r['pengurangan'];
                if ($this->input->post('id_biaya') != '') {
                    $saldo += $r['penambahan'] - $r['pengurangan'];
                }
                if (!empty($r['penambahan'])) {
                    $keterangan = '<p style="color:blue">' . $r['keterangan'] . '</p>';
                    $detail = '<p style="color:blue">' . $r['detail'] . '</p>';
                }
                if (!empty($r['pengurangan'])) {
                    $keterangan = '<p style="color:red">' . $r['keterangan'] . '</p>';
                    $detail = '<p style="color:red">' . $r['detail'] . '</p>';
                }
                $row  = array(
                    $no . '.',
                    date('d-M-Y', strtotime($r['tanggal_transaksi'])),
                    $keterangan,
                    $r['cabang'],
                    $r['tipe'],
                    number_format($r['pengurangan'], 2),
                    number_format($r['penambahan'], 2),
                    number_format($saldo, 2),
                    $detail,
                    '<a href="#" onClick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>'
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
            '<strong>' . number_format($pengurangan, 2) . '</strong>',
            '<strong>' . number_format($penambahan, 2) . '</strong>',
            '<strong>' . number_format($saldo, 2) . '</strong>',
            '',
            ''
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

    function saldo_awal($id_rek)
    {
        $data = 0.00;
        $tanggal_awal_tahun = date("Y-01-01", strtotime($this->input->post('searchDateFirst')));
        $tanggal_akhir = $this->input->post('searchDateFinish');
        $tanggal_awal = $this->input->post('searchDateFirst');
        $branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
        $this->db->select("saldo_awal");
        $this->db->where('id_rek', $this->input->post('id_biaya'));
        $this->db->where('tanggal >=', $tanggal_awal_tahun);
        $this->db->where('tanggal <', $tanggal_akhir);
        $q = $this->db->get('finance_buku_bank_saldo a');
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $data += $r['saldo_awal'];
            }
        }
        $q = $this->db->query("SELECT SUM(a.`penambahan`) as kredit,SUM(a.`pengurangan`) as debet FROM (SELECT IF(b.tipe = 'CR', b.jumlah,0) AS penambahan,
        IF(b.tipe = 'DB', b.jumlah,0) AS pengurangan FROM erp_financev2.`gmd_finance_buku_bank` b WHERE (b.tanggal_transaksi >= '$tanggal_awal_tahun' AND b.tanggal_transaksi < '$tanggal_awal') AND b.id_rek = $id_rek)a");
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                //if($tukar == '1'){$data += $r['saldo_kredit'] - $r['saldo_debet'];}
                //else{$data += $r['saldo_debet'] - $r['saldo_kredit'];}
                $data += $r['debet'] - $r['kredit'];
            }
        }
        return $data;
    }


    function cek_kelompok($id)
    {
        $data = 0;

        $this->db->where('id', $id);
        $q = $this->db->get('finance_coa');
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                if ($r['kelompok'] == '1' || $r['kelompok'] == '2' || $r['kelompok'] == '3') {
                    $data = 1;
                }
            }
        }

        return $data;
    }

    function import_file_excel($data_array, $id_rek = null)
    {
        $input_post = $data_array['input_post'];
        $sheet_name_validate = explode(',', $input_post['id_confirmed']);
        $data = array();
        $i = 0;
        $now = date('Y-m-d H:i:s');
        foreach ($data_array['data'] as $key => $value) {

            if (in_array($value['sheet_name'], $sheet_name_validate)) {

                foreach ($value['sheet_data'] as $row_index => $row_value) {
                    if ($row_index > 0) {
                        if ($row_index < count($value['sheet_data'])) {
                            $data[$i]['id_rek'] = $id_rek;
                            $data[$i]['tanggal_transaksi'] = date('Y-m-d', strtotime(str_replace('/', '-', $row_value[1] . (substr($row_value[0], 5, 5)))));
                            $data[$i]['keterangan'] = $row_value[2];
                            $data[$i]['cabang'] = $row_value[3];
                            $data[$i]['jumlah'] = str_replace(',', '', substr($row_value[4], 0, -3));
                            $data[$i]['saldo'] = $row_value[5];
                            $data[$i]['tipe'] = substr($row_value[4], -2);
                            $data[$i]['periode_dari'] = date('Y-m-d', strtotime(str_replace('/', '-', substr($row_value[0], 0, 10))));
                            $data[$i]['periode_sampai'] = date('Y-m-d', strtotime(str_replace('/', '-', substr($row_value[0], 13, 10))));
                            $data[$i]['insert_at'] = $now;
                            $data[$i]['insert_by'] = $this->session->userdata('userid');
                            $i++;
                        }
                    }
                }
            }
        }

        $insert = $this->db->insert_batch('finance_buku_bank', $data);
        if ($insert) {
            my_json(array("status" => "success", "message" => "data import faktur pajak telah tersimpan"));
        } else {
            my_json(array("status" => "false", "message" => "maaf data ada yang sama coba cek kembali"));
        }
    }

    function import_file_excel_bni($data_array, $id_rek = null)
    {
        $input_post = $data_array['input_post'];
        $sheet_name_validate = explode(',', $input_post['id_confirmed']);
        $data = array();
        $i = 0;
        $tipe = null;
        $now = date('Y-m-d H:i:s');
        foreach ($data_array['data'] as $key => $value) {

            if (in_array($value['sheet_name'], $sheet_name_validate)) {

                foreach ($value['sheet_data'] as $row_index => $row_value) {

                    if ($row_index > 0) {
                        if ($row_index < count($value['sheet_data'])) {
                            if (!empty($row_value[0])) {
                                if ($row_value[3] == 'C') {
                                    $tipe = 'CR';
                                } else if ($row_value[3] == 'D') {
                                    $tipe = 'DB';
                                }
                                $data[$i]['id_rek'] = $id_rek;
                                $data[$i]['tanggal_transaksi'] = date('Y-m-d', strtotime(str_replace('/', '-', substr($row_value[0], 0, 10))));
                                $data[$i]['keterangan'] = $row_value[1];
                                $data[$i]['jumlah'] = str_replace(',', '', $row_value[2]);
                                $data[$i]['saldo'] = str_replace(',', '', $row_value[4]);
                                $data[$i]['tipe'] = $tipe;
                                $data[$i]['insert_at'] = $now;
                                $data[$i]['insert_by'] = $this->session->userdata('userid');
                                $i++;
                            }
                        }
                    }
                }
            }
        }

        $insert = $this->db->insert_batch('finance_buku_bank', $data);
        if ($insert) {
            my_json(array("status" => "success", "message" => "data import telah tersimpan"));
        } else {
            my_json(array("status" => "false", "message" => "maaf data ada yang sama coba cek kembali"));
        }
    }

    function import_file_excel_bri($data_array, $id_rek = null)
    {
        $input_post = $data_array['input_post'];
        $sheet_name_validate = explode(',', $input_post['id_confirmed']);
        $data = array();
        $i = $jumlah = 0;
        $tipe = $UNIX_DATE = null;
        $now = date('Y-m-d H:i:s');
        foreach ($data_array['data'] as $key => $value) {

            if (in_array($value['sheet_name'], $sheet_name_validate)) {

                foreach ($value['sheet_data'] as $row_index => $row_value) {
                    if ($row_index > 0) {
                        if ($row_index < count($value['sheet_data'])) {
                            if (!empty($row_value[0])) {
                                if (empty($row_value[2])) {
                                    $tipe = 'CR';
                                    $jumlah = str_replace(',', '', $row_value[3]);
                                } else {
                                    $tipe = 'DB';
                                    $jumlah = str_replace(',', '', $row_value[2]);
                                }
                                $UNIX_DATE = ($row_value[0] - 25569) * 86400;
                                $data[$i]['id_rek'] = $id_rek;
                                $data[$i]['tanggal_transaksi'] = date('Y-m-d', $UNIX_DATE);
                                $data[$i]['keterangan'] = $row_value[1];
                                $data[$i]['jumlah'] = $jumlah;
                                $data[$i]['saldo'] = str_replace(',', '', $row_value[4]);
                                $data[$i]['tipe'] = $tipe;
                                $data[$i]['detail'] = $row_value[5];
                                $data[$i]['insert_at'] = $now;
                                $data[$i]['insert_by'] = $this->session->userdata('userid');
                                $i++;
                            }
                        }
                    }
                }
            }
        }

        $insert = $this->db->insert_batch('finance_buku_bank', $data);
        if ($insert) {
            my_json(array("status" => "success", "message" => "data import telah tersimpan"));
        } else {
            my_json(array("status" => "false", "message" => "maaf data ada yang sama coba cek kembali"));
        }
    }

    function import_file_excel_bca($data_array, $id_rek = null)
    {
        $input_post = $data_array['input_post'];
        $sheet_name_validate = explode(',', $input_post['id_confirmed']);
        $data = array();
        $i = $jumlah = 0;
        $tipe = $UNIX_DATE = null;
        $now = date('Y-m-d H:i:s');
        foreach ($data_array['data'] as $key => $value) {

            if (in_array($value['sheet_name'], $sheet_name_validate)) {

                foreach ($value['sheet_data'] as $row_index => $row_value) {
                    if ($row_index > 0) {
                        if ($row_index < count($value['sheet_data'])) {
                            if (!empty($row_value[0])) {
                                $UNIX_DATE = ($row_value[0] - 25569) * 86400;
                                $data[$i]['id_rek'] = $id_rek;
                                $data[$i]['tanggal_transaksi'] = date('Y-m-d', $UNIX_DATE);
                                $data[$i]['keterangan'] = $row_value[1];
                                $data[$i]['cabang'] = $row_value[2];
                                $data[$i]['jumlah'] = str_replace(',', '', $row_value[4]);
                                $data[$i]['saldo'] = str_replace(',', '', $row_value[6]);
                                $data[$i]['tipe'] = $row_value[5];
                                $data[$i]['detail'] = $row_value[7];
                                $data[$i]['insert_at'] = $now;
                                $data[$i]['insert_by'] = $this->session->userdata('userid');
                                $i++;
                            }
                        }
                    }
                }
            }
        }

        $insert = $this->db->insert_batch('finance_buku_bank', $data);
        if ($insert) {
            my_json(array("status" => "success", "message" => "data import telah tersimpan"));
        } else {
            my_json(array("status" => "false", "message" => "maaf data ada yang sama coba cek kembali"));
        }
    }

    function select()
    {
        $this->db->select("a.detail", false);
        $this->db->from('finance_buku_bank a');
        $this->db->where("a.id", $this->input->post('id'));
        $q = $this->db->get();
        return $q->result();
    }

    function update()
    {
        $msg = 0;
        $ket = $this->input->post('ket');
        $id = $this->input->post('id');
        $data = array('detail' => $ket);
        $this->db->where('id', $id);
        $result = $this->db->update('finance_buku_bank', $data);
        if ($result == true) {
            $msg = 1;
        }
        return $msg;
    }
}
