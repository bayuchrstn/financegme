<?php
class Model_finance_customer_data_aktif extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_table()
    {
        $column_order = array(null, 'a.nomor', 'b.nama', 'c.nama', 'email_billing', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';
        $kondisi = $order = $limit = null;
        if (!empty($this->input->post('searchbranch'))) {
            $kondisi .= " AND c.`id_region`='" . $this->input->post('searchbranch') . "'";
        }
        if (!empty($this->input->post('searchppn'))) {
            if ($this->input->post('searchppn') == 2) {
                $kondisi .= " AND a.`ppn`='" . $this->input->post('searchppn') . "'";
            } else {
                $kondisi .= " AND a.`ppn`!='2'";
            }
        }
        if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
        // $this->db->order_by($order_name, $order_dir);
        if (!empty($order_name) && !empty($order_dir)) {
            $order = " ORDER BY $order_name $order_dir";
        } else {
            $order = " ORDER BY z.urutan ASC";
        }
        $q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS 
        a.*,
          c.nama,
          CASE WHEN a.`attention_display`=0
          THEN c.`emailwakil`
          WHEN a.`attention_display`=1
          THEN c.`email_billing`
          ELSE f.`email`
          END AS email_billing,
          b.`nama` AS cust,
          b.`idcust`,
          d.id_serv,
          e.`label` AS nama_layanan
        FROM
          erp_gmedia.order_header a
           JOIN erp_gmedia.ms_customers b
            ON b.`id` = a.`id_cust`
           JOIN erp_gmedia.ms_site c
            ON c.`id` = a.`id_site` AND b.`id`=c.`id_cust`
           JOIN erp_gmedia.order_service d
            ON d.`id_order` = a.`id` AND d.status = '1'
           JOIN erp_gmedia.ms_layanan e
          ON d.`id_serv`=e.`id`
          LEFT JOIN erp_gmedia.ms_contact f
          ON c.`id`=f.`id_site` AND a.attention_display=f.id
        WHERE a.`status` = '3' AND (
            `c`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `c`.`email_billing` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `b`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `e`.`label` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
          ) $kondisi $order $limit");
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a><a href="#" onclick="view_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-eye2 position-left text-slate-800"></i></a>';
                $materai = 'Tanpa Materai';
                if ($r['materai'] == 2) {
                    $materai = 'Pakai Materai';
                }

                $installasi = 'Digabung';
                if ($r['installasi'] == 2) {
                    $installasi = 'Dipisah';
                }
                $row  = array(
                    $no . '.',
                    $r['nomor'] . '<br>' . $r['nama_layanan'],
                    $r['idcust'] . '<br>' . $r['cust'],
                    $r['nama'],
                    $r['email_billing'],
                    $materai,
                    $installasi,
                    $edit,
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

    function get_from_arr($table, $data)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where($data);
        $data = $db1->get($table);
        return $data;
    }

    function update_arr($table, $data, $arr)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where($arr);
        $db1->update($table, $data);
    }

    function last_no_invoice($region = '', $ppn = '', $flag = '', $date = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $query = "SELECT 
					  * 
					FROM
					  nomor  
					WHERE id_region = '" . $region . "' 
					  AND ppn = '" . $ppn . "' 
					  AND status != '9' 
					  AND periode = '" . $date . "'";
        return $db1->query($query);
    }

    function insert_nomor($table, $data, $lastid = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->insert($table, $data);
        $afftectedRows = $db1->affected_rows();
        $insertid = $db1->insert_id();
        if (!empty($lastid)) {
            return $insertid;
        } else {
            return $afftectedRows;
        }
    }

    function generate_noinvoice($region, $ppn, $flag = '', $bulan = '', $tahun = '')
    {

        //GENERATE NOMOR INVOICE
        $count = 0;

        $date = $tahun . '-' . $bulan . '-01';
        if ($ppn == 1) {
            $ppnflag = 1;
        } else {
            $ppnflag = $ppn;
        }
        $count = $this->last_no_invoice($region, $ppnflag, $flag, $date)->row();

        $cr = $cr2 = '';
        if ($region == 3) {
            $cr = '03';
            $cr2 = 'GMD-SMG';
        } else if ($region == 7) {
            $cr = '07';
            $cr2 = 'GMD-SLTG';
        }

        $next_inv = '';
        if (empty($count)) {
            $next_inv = '0001';
            $next_inv2 = 1;
        } else {

            $next_inv2 = $count->count + 1;
            $digit = strlen(trim($next_inv2));
            $selisih_gigit = (4 - $digit);
            $nol = '';
            for ($m = 0; $m < $selisih_gigit; $m++) {
                $nol .= '0';
            }
            $next_inv .= $nol . $next_inv2;
        }

        if (empty($tahun)) {
            $tahun = date("y");
            $tahun = date("y");
        } else {
            $tahun = substr($tahun, -2);
        }
        if (empty($bulan)) {
            $bulan = date("m");
        }
        if ($ppn == 1) {
            $next = $cr . '.' . $next_inv . '-' . $bulan . $tahun;
        } else {
            $next = $next_inv . '/' . $cr2 . '/' . $bulan . '/' . $tahun;
        }
        // echo $next;exit;
        if (empty($count)) {
            $this->insert_nomor('nomor', array('count' => $next_inv2, 'id_region' => $region, 'ppn' => $ppnflag, 'periode' => $date));
        } else {
            $this->update_arr('nomor', array('count' => $next_inv2), array('id_region' => $region, 'ppn' => $ppnflag, 'periode' => $date));
        }
        return $next;
    }

    function update()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $id = $this->input->post('id');
        $id_site = $this->input->post('id_site');
        $npwp = $this->input->post('npwp');
        $email = $this->input->post('email');
        $materai = $this->input->post('materai');
        $alamat = $this->input->post('alamat');
        $inv_int = $this->input->post('inv_int');
        $data = array(
            "materai" => $materai
        );
        $db->where('id', $id);
        $db->update('order_header', $data);
        $data = array(
            "taxno" => $npwp,
            "alamat2" => $alamat,
            "email_billing" => $email
        );
        $db->where('id', $id_site);
        $db->update('ms_site', $data);
        $q = $this->db->query("SELECT * FROM erp_gmedia.order_header WHERE id=$id")->row();
        if ($q->attention_display == 0) {
            $data = array(
                "emailwakil" => $email
            );
            $db->where('id', $id_site);
            $db->update('ms_site', $data);
        } else if ($q->attention_display == 1) {
            $data = array(
                "email_billing" => $email
            );
            $db->where('id', $id_site);
            $db->update('ms_site', $data);
        } else {
            $data = array(
                "email" => $email
            );
            $db->where('id', $q->attention_display);
            $db->update('ms_contact', $data);
        }

        //CEK APAKAH ADA PERUBAHAN PADA DATA INSTALLASI
        if ($inv_int != $q->installasi) {
            //jika invoice installasi digabung
            if ($inv_int == 1) {
                $getdp = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'DP', 'flag' => 'C', 'status' => '1'))->row();
                $getinstall = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'BI', 'status' => '1'))->row();
                $getpninstall = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'BIPN', 'status' => '1'))->row();
                $getmaterai2 = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'MTBI', 'status' => '1'))->row();
                $getmaterai = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'MT', 'status' => '1'))->row();
                $getlangganan = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'LG', 'status' => '1'))->row();
                $getpnlangganan = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'PN', 'status' => '1'))->row();
                $jml_piutang = $getinstall->nominal + $getpninstall->nominal + $getlangganan->nominal + $getpnlangganan->nominal + $getmaterai->nominal - $getdp->nominal;

                if ($q->flag == 1) {
                    $getarpost = $this->get_from_arr('arpost', array('id_order' => $q->id, 'flag_installasi' => '1', 'flag_dp' => '1', 'status' => '1'))->row();
                    $this->update_arr('arpost', array('jml_piutang' => $jml_piutang), array('id' => $getarpost->id, 'flag_installasi' => '1'));
                }

                $getarpost2 = $this->get_from_arr('arpost', array('id_order' => $q->id, 'flag_installasi' => '2', 'status' => '1'))->row();
                $db->where('id', $getarpost2->id);
                $db->where('flag_installasi', '2');
                $db->delete('arpost', $data);

                $getlg = $this->get_from_arr('transaksi', array('jenis_transaksi' => 'LG', 'status' => '1'))->row();
                $this->update_arr('transaksi', array('nomor' => $getlg->nomor), array('id' => $getinstall->id));

                if ($getpninstall->id) {
                    $db->where('id', $getpninstall->id);
                    $db->delete('transaksi');
                    $db->where('id', $getmaterai2->id);
                    $db->delete('transaksi');
                    $this->update_arr('transaksi', array('nominal' => ($getpnlangganan->nominal + $getpninstall->nominal)), array('id' => $getpnlangganan->id));
                }
                $this->update_arr('order_header', array('installasi' => 1), array('id' => $q->id));
                //jika invoice installasi dipisah			
            } else if ($inv_int == 2) {
                $getdp = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'DP', 'flag' => 'C', 'status' => '1'))->row();
                $getinstall = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'BI', 'status' => '1'))->row();
                $getlangganan = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'LG', 'status' => '1'))->row();
                $getpnlangganan = $this->get_from_arr('transaksi', array('id_order' => $q->id, 'jenis_transaksi' => 'PN', 'status' => '1'))->row();

                $t = $getlangganan->tanggal;
                $ex = explode('-', $t);
                $bul = $ex[1];
                $tah = $ex[0];
                $site = $this->db->query("SELECT * FROM ms_site WHERE id=$q->id_site")->row();
                $next_inv = $this->generate_noinvoice($site->id_region, $q->ppn, 1, $bul, $tah);
                $this->update_arr('transaksi', array('nomor' => $next_inv), array('id' => $getinstall->id, 'status' => '1'));

                $instal = $getinstall->nominal;
                $pninstal = $getinstall->nominal * 0.1;
                $lg = $getlangganan->nominal;
                $pnlg = $getlangganan->nominal * 0.1;
                if ($q->ppn == 1 or $q->ppn == 3) {
                    $this->update_arr('transaksi', array('nominal' => $pnlg), array('id' => $getpnlangganan->id, 'status' => '1'));

                    $datas = array(
                        'id_order' => $q->id,
                        'id_cust' => $q->id_cust,
                        'id_order_service' => $getinstall->id_order_service,
                        'nomor' => $next_inv,
                        'tanggal' => $getinstall->tanggal,
                        'nominal' => $pninstal,
                        'jenis_transaksi' => 'BIPN',
                        'flag' => 'D',
                        'id_user' => $this->session->userdata('id'),
                        'timestamp' => date('Y-m-d H:i:s')
                    );
                    $db->insert('transaksi', $datas);
                    $materai = 0;
                    $jml_piutang = $lg + $pnlg - $getdp->nominal;
                    if ($q->materai == 2) {
                        $materai = 3000;
                        if ($jml_piutang >= 1000000) {
                            $materai = 6000;
                        }
                        $datas = array(
                            'id_order' => $q->id,
                            'id_cust' => $q->id_cust,
                            'id_order_service' => $getinstall->id_order_service,
                            'nomor' => $next_inv,
                            'tanggal' => $getinstall->tanggal,
                            'nominal' => $materai,
                            'jenis_transaksi' => 'MTBI',
                            'flag' => 'D',
                            'id_user' => $this->session->userdata('id'),
                            'timestamp' => date('Y-m-d H:i:s')
                        );
                        $db->insert('transaksi', $datas);
                    }
                    $jml_piutang = $jml_piutang + $materai;
                } else {
                    $jml_piutang = $lg + $materai - $getdp->nominal;
                }

                if ($q->flag == 1) {
                    $getarpost = $this->get_from_arr('arpost', array('id_order' => $q->id, 'status' => '1'))->row();
                    $this->update_arr('arpost', array('jml_piutang' => $jml_piutang), array('id' => $getarpost->id));

                    $datas2 = array(
                        'id_order' => $q->id,
                        'id_cust' => $q->id_cust,
                        'id_site' => $q->id_site,
                        'nomor' => $next_inv,
                        'tanggal' => $getarpost->tanggal,
                        'tanggal_invoice' => $getarpost->tanggal_invoice,
                        'periode_dari' => $getarpost->periode_dari,
                        'periode_sampai' => $getarpost->periode_sampai,
                        'due_date' => $getarpost->due_date,
                        'jml_piutang' => $jml_piutang,
                        'flag_installasi' => '2',
                        'id_user' => $this->session->userdata('id')
                    );
                } else {
                    $cekweekend = date('N', strtotime(date("Y-m-01")));
                    $extgl = explode('-', date("Y-m-01"));
                    if ($cekweekend == 6) {
                        $tgl_invoice = $extgl[0] . '-' . $extgl[1] . '-03';
                    } else if ($cekweekend == 7) {
                        $tgl_invoice = $extgl[0] . '-' . $extgl[1] . '-02';
                    } else {
                        $hol = $this->get_from_arr('hrd.hol', array('hol_tgl' => date("Y-m-01")))->num_rows();
                        if ($hol > 0) {
                            // $tgl_invoice = $this->input->post('tahun').'-'.$this->input->post('bulan').'-02';		
                            $tgl_invoice = $extgl[0] . '-' . $extgl[1] . '-02';
                        } else {
                            // $tgl_invoice = $periode;
                            $tgl_invoice = date("Y-m-01");
                        }
                    }
                    $due = date('Y-m-d', strtotime($tgl_invoice . ' + 9 days'));
                    $datas2 = array(
                        'id_order' => $q->id,
                        'id_cust' => $q->id_cust,
                        'id_site' => $q->id_site,
                        'nomor' => $next_inv,
                        'tanggal' => date("Y-m-01"),
                        'tanggal_invoice' => $tgl_invoice,
                        'due_date' => $due,
                        'jml_piutang' => $jml_piutang,
                        'flag_installasi' => '2',
                        'id_user' => $this->session->userdata('id')
                    );
                }
                $db->insert('arpost', $datas2);

                $this->update_arr('order_header', array('installasi' => 2), array('id' => $q->id));
            }
        }
        return 1;
    }

    function select()
    {

        $id = $this->input->post('id');
        $q = $this->db->query("SELECT a.id,a.id_site,b.taxno AS npwp,b.alamat2,a.materai,a.installasi,CASE WHEN a.`attention_display`=0
        THEN b.`emailwakil`
        WHEN a.`attention_display`=1
        THEN b.`email_billing`
        ELSE c.`email`
        END AS email_cust FROM erp_gmedia.`order_header` a LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`=b.`id` LEFT JOIN erp_gmedia.`ms_contact` c ON b.`id`=c.`id_site` AND a.`attention_display` = c.`id` WHERE a.`id`=$id");
        return $q->result();
    }

    function view_data()
    {
        $no = 0;
        $detail = $restitusi  = $stat = $compliment_check = $ppn = $periode_tagih = $periode_bayar = $satuan_dp = null;
        $compliment_class = 'btn-default off';
        $compliment_label = '<label class="btn btn-primary toggle-on">On</label>
            <label class="btn btn-default active toggle-off">Off</label>';
        $query = $this->db->query("SELECT *,b.`nama` AS nama_cust,b.`datebirth` AS cust_datebirth,c.`nama` AS nama_site,c.`phone` AS site_phone,
        c.`taxno` AS site_taxno,c.`alamat` AS site_alamat,c.`email` AS site_email,e.`nama` AS nama_cp,e.`jabatan` AS jabatan_cp,
        e.`datebirth` AS tgl_cp,e.`phone` AS phone_cp,e.`email` AS email_cp,e.`flag` AS flag_cp,c.`wakil` AS site_wakil,
        c.`jobwakil` AS site_jobwakil,c.`emailwakil` AS site_emailwakil,c.`datebirth` AS site_datebirthwakil,c.`phonewakil` AS site_phonewakil,
        g.`label` AS ms_layanan_label,a.`tanggal` AS tgl_start_billing,a.`flag` AS order_header_flag,h.`nama` AS nama_sales,
        a.`file_ktp` AS oh_file_ktp,a.`file_npwp` AS oh_file_npwp,a.`file_sign_baa` AS oh_file_sign_baa
        FROM erp_gmedia.`order_header` a 
        LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust`=b.`id`
        LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site`=c.`id`
        LEFT JOIN erp_gmedia.`ms_region` d ON c.`id_region`=d.`id`
        LEFT JOIN erp_gmedia.`ms_contact` e ON e.`id_cust`=a.`id_cust` AND e.`id_site`=a.`id_site`
        LEFT JOIN erp_gmedia.`order_service` f ON a.`id`=f.`id_order`
        LEFT JOIN erp_gmedia.`ms_layanan` g ON f.`id_serv`=g.`id`
        LEFT JOIN hrd.`ms_employee` h ON a.`id_sales`=h.`pin` AND h.`id_divisi`=6 AND h.`cabang`='Semarang & Salatiga'
        WHERE a.`id`='" . $this->input->post('id') . "' AND f.`status`=1 ");
        $q = $query->row();
        if (!empty($q->restitusi)) {
            if ($q->restitusi == 1) {
                $restitusi = 'Low';
            } else if ($q->restitusi == 2) {
                $restitusi = 'Medium';
            } else if ($q->restitusi == 3) {
                $restitusi = 'High';
            }
        }
        $detail .= '<div role="tabpanel">
                        <ul class="nav nav-tabs nav-tabs-highlight" role="tablist">
                            <li class="nav-item active"><a class="nav-link" href="components.html#home11" aria-controls="home11" role="tab" data-toggle="tab">Data Company</a></li>
                            <li class="nav-item"><a class="nav-link" href="components.html#profile11" aria-controls="profile11" role="tab" data-toggle="tab">Data Site</a></li>
                            <li class="nav-item"><a class="nav-link" href="components.html#messages11" aria-controls="messages11" role="tab" data-toggle="tab">Data Order</a></li>
                            <li class="nav-item"><a class="nav-link" href="components.html#invoice" aria-controls="invoice" role="tab" data-toggle="tab">Daftar Invoice</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home11">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Customer Id</b></label>
                                        <input class="form-control" type="text" value="' . $q->idcust . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Company Name</b></label>
                                        <input class="form-control" type="text" value="' . $q->nama_cust . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Date Anniversary</b></label>
                                        <input class="form-control" type="text" value="' . $q->cust_datebirth . '" readonly placeholder="00-00-0000">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Restitusi</b></label>
                                        <input class="form-control" type="text" value="' . $restitusi . '" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile11">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Region</b></label>
                                        <input class="form-control" type="text" value="' . $q->region . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Company Group</b></label>
                                        <input class="form-control" type="text" value="' . $q->nama_site . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Phone</b></label>
                                        <input class="form-control" type="text" value="' . $q->site_phone . '" readonly placeholder="Phone Number">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Tag Reg Number</b></label>
                                        <input class="form-control" type="text" value="' . $q->site_taxno . '" readonly placeholder="Tax Number">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-9 col-sm-9">
                                        <label><b>Alamat NPWP</b></label>
                                        <input class="form-control" type="text" value="' . $q->site_alamat . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Kota</b></label>
                                        <input class="form-control" type="text" value="' . $q->kota . '" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-9 col-sm-9">
                                        <label><b>Alamat Penagihan/Pengiriman</b></label>
                                        <input class="form-control" type="text" value="' . $q->alamat2 . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Kota</b></label>
                                        <input class="form-control" type="text" value="' . $q->kota2 . '" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-9 col-sm-9">
                                        <label><b>Alamat Installasi</b></label>
                                        <input class="form-control" type="text" value="' . $q->alamat3 . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Kota</b></label>
                                        <input class="form-control" type="text" value="' . $q->kota3 . '" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Email</b></label>
                                        <input class="form-control" type="text" value="' . $q->site_email . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Email Billing</b></label>
                                        <input class="form-control" type="text" value="' . $q->email_billing . '" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <p style="margin:0 10px 5px"><b>Represented By</b></p>
                                    <div class="col-md-3 col-sm-3">
                                        <input class="form-control" type="text" value="' . $q->site_wakil . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input class="form-control" type="text" value="' . $q->site_jobwakil . '" readonly placeholder="Jabatan">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <input class="form-control" type="text" value="' . $q->site_emailwakil . '" readonly placeholder="Email">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input class="form-control" type="text" value="' . $q->site_phonewakil . '" readonly placeholder="Phone Number">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input class="form-control" type="text" value="' . $q->site_datebirthwakil . '" readonly placeholder="Datebirth">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <p style="margin:0 10px 5px"><b>Contact Person</b></p>';
        foreach ($query->result() as $con) {
            if ($con->flag_cp == 't') {
                $stat = 'Teknis';
            } else if ($con->flag_cp == 'f') {
                $stat = 'Finance';
            }
            $detail .= '<div class="col-md-2 col-sm-2">
                            <input class="form-control" type="text" value="' . $con->nama_cp . '" readonly>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <input class="form-control" type="text" value="' . $con->jabatan_cp . '" readonly placeholder="Jabatan">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <input class="form-control" type="text" value="' . $con->email_cp . '" readonly placeholder="Email">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <input class="form-control" type="text" value="' . $con->phone_cp . '" readonly placeholder="Phone Number">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <input class="form-control" type="text" value="' . $con->tgl_cp . '" readonly placeholder="Datebirth">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <input class="form-control" type="text" value="' . $stat . '" readonly placeholder="Contact For">
                        </div>
                        <br><br>';
        };
        if (!empty($q->compliment)) {
            if ($q->compliment == 2) {
                $compliment_check = 'checked';
                $compliment_class = 'btn-primary';
                $compliment_label = '<label class="btn btn-primary active toggle-on">On</label>
            <label class="btn btn-default toggle-off">Off</label>';
            }
        }
        if (!empty($q->ppn)) {
            if ($q->ppn == 3) {
                $ppn = 'Include';
            } else if ($q->ppn == 1) {
                $ppn = 'Exclude';
            } else if ($q->ppn == 2) {
                $ppn = 'Non';
            }
        }
        if (!empty($q->periode_tagih)) {
            if ($q->periode_tagih == 1) {
                $periode_tagih = 'Bulanan';
            } else  if ($q->periode_tagih == 3) {
                $periode_tagih = 'Tri Wulan';
            } else  if ($q->periode_tagih == 4) {
                $periode_tagih = 'Catur Wulan';
            } else  if ($q->periode_tagih == 6) {
                $periode_tagih = 'Semester';
            } else if ($q->periode_tagih == 12) {
                $periode_tagih = 'Tahunan';
            } else if ($q->periode_tagih == 0) {
                $periode_tagih = 'One Time Project';
            }
        }
        if (!empty($q->order_header_flag)) {
            if ($q->order_header_flag == 1) {
                $periode_bayar = 'Pre-Paid';
            } else if ($q->order_header_flag == 2) {
                $periode_bayar = 'Post-Paid';
            }
        }
        if (!empty($q->satuan_dp)) {
            if ($q->satuan_dp == 1) {
                $satuan_dp = '%';
            } else if ($q->satuan_dp == 2) {
                $satuan_dp = 'Rp';
            }
        }
        $detail .= '</div>
                            </div>
                            <div class="tab-pane" id="messages11">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Service Id</b></label>
                                        <input class="form-control" type="text" value="' . $q->servid . '" readonly>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label><b>Nama Layanan</b></label>
                                        <input class="form-control" type="text" value="' . $q->ms_layanan_label . '" readonly>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label><b>Info BAK/BAA</b></label>
                                        <input class="form-control" type="text" value="' . $q->baa . '" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Mulai Kontrak</b></label>
                                        <input class="form-control" type="text" value="' . $q->start_kontrak . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Akhir Kontrak</b></label>
                                        <input class="form-control" type="text" value="' . $q->end_kontrak . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Start Billing</b></label>
                                        <input class="form-control" type="text" value="' . $q->tgl_start_billing . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>RFS</b></label>
                                        <input class="form-control" type="text" value="' . $q->rfs . '" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Biaya Installasi</b></label>
                                        <input class="form-control" type="text" value="' . $this->Kamus_model->uang($q->biaya_installasi) . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Diskon Installasi</b></label>
                                        <input class="form-control" type="text" value="' . $this->Kamus_model->uang($q->diskon_installasi) . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Biaya Langganan</b></label>
                                        <input class="form-control" type="text" value="' . $this->Kamus_model->uang($q->biaya_langganan) . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Compliment</b></label>
                                        <div class="toggle btn ' . $compliment_class . ' ios" data-toggle="toggle" disabled="disabled" style="width: 0px; height: 0px;"><input type="checkbox" ' . $compliment_check . ' data-toggle="toggle" data-style="ios" disabled="">
                                        <div class="toggle-group">
                                            ' . $compliment_label . '
                                            <span class="toggle-handle btn btn-default"></span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>PPn</b></label>
                                        <input class="form-control" type="text" value="' . $ppn . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Periode Penagihan</b></label>
                                        <input class="form-control" type="text" value="' . $periode_tagih . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Periode Pembayaran</b></label>
                                        <input class="form-control" type="text" value="' . $periode_bayar . '" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label><b>Down Payment</b></label>
                                        <input class="form-control" type="text" value="' . $this->Kamus_model->uang($q->dp) . '" readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label><b>Satuan DP</b></label>
                                        <input class="form-control" type="text" value="' . $satuan_dp . '" readonly>
                                    </div>
                                </div>';
        $lain = $this->db->query("SELECT * FROM erp_gmedia.`order_lain` a WHERE a.`id_order`='" . $this->input->post('id') . "'")->result();
        if (!empty($lain)) {
            $l = 0;
            foreach ($lain as $rowl) {
                $l++;
                $detail .= '<div class="row" style="margin-top: 10px;">
                                                            <div class="col-md-3 col-sm-3">
                                                                <label><b>Layanan Tambahan ' . $l . '</b></label>
                                                                    <input type="text" disabled name="tambah[]" class="form-control" value="' . $rowl->layanan . '">
                                                            </div>
                                                            <div class="col-md-2 col-sm-2">
                                                                <label><b>Biaya Tambahan ' . $l . '</b></label>
                                                                    <input type="text" disabled name="tambahbiaya[]" class="rupiah form-control" value="' . $this->Kamus_model->uang($rowl->biaya) . '">
                                                            </div>
                                                        </div>';
            }
        }

        $detail .= '<div class="row" style="margin-top: 10px;">';
        if ($q->oh_file_ktp) {
            $detail .= '<div class="col-md-4 col-sm-4">
            <label><b>KTP</b></label>
        							<ul class="clist clist-angle">';
            $detail .= '<li><a target="_blank" href="https://erpsmg.gmedia.id/invoice/uploaded_file/npwpktp/' . $q->oh_file_ktp . '">File KTP</a></li>';

            $detail .= '</ul>
        				</div>';
        }
        if ($q->oh_file_npwp) {
            $detail .= '<div class="col-sm-4">
            <label><b>NPWP</b></label>
        							<ul class="clist clist-angle">';
            $detail .= '<li><a target="_blank" href="https://erpsmg.gmedia.id/invoice/uploaded_file/npwpktp/' . $q->oh_file_npwp . '">File NPWP</a></li>';

            $detail .= '</ul>
        				</div>';
        }
        if ($q->oh_file_sign_baa) {
            $detail .= '<div class="col-sm-4">
            <label><b>Sign BAA</b></label>
        							<ul class="clist clist-angle">';
            $detail .= '<li><a target="_blank" href="https://erpsmg.gmedia.id/invoice/uploaded_file/npwpktp/' . $q->oh_file_sign_baa . '">File Signed BAA</a></li>';

            $detail .= '</ul>
        				</div>';
        }
        $detail .= '
        			</div>';

        $detail .= '<div class="row" style="margin-top: 10px;">';
        $file = $this->db->query("SELECT * FROM erp_gmedia.`order_file` a WHERE a.`flag`=1 AND a.`status`!=9 AND a.`id_order`='" . $this->input->post('id') . "'")->result();
        if ($file) {
            $detail .= '<div class="col-sm-6">
            <label><b>Uploaded FB :</b></label>
        							<ul class="clist clist-angle">';
            foreach ($file as $row) {
                if (!empty($row->file)) {
                    if ($row->flag == 2) {
                        $detail .= '<li><a target="_blank" href="' . $row->file . '">file FB</a></li>';
                    } else {
                        $detail .= '<li><a target="_blank" href="https://erpsmg.gmedia.id/invoice/uploaded_file/quotation/' . $row->file . '">' . $row->file . '</a></li>';
                    }
                }
            }
            $detail .= '</ul>
        						</div>';
        }
        $file2 = $this->db->query("SELECT * FROM erp_gmedia.`order_file` a WHERE a.`flag`=2 AND a.`status`!=9 AND a.`id_order`='" . $this->input->post('id') . "'")->result();
        if ($file2) {

            $detail .= '<div class="col-sm-6">
            <label><b>Uploaded BAA :</b></label>
        							<ul class="clist clist-angle">';
            foreach ($file2 as $row) {
                // if (strpos($row->file, 'http://') !== false) { 
                if (!empty($row->file)) {
                    if ($row->flag == 2) {
                        $detail .= '<li><a target="_blank" href="' . $row->file . '">file BAA</a></li>';
                    } else {
                        $detail .= '<li><a target="_blank" href="https://erpsmg.gmedia.id/invoice/uploaded_file/quotation/' . $row->file . '">' . $row->file . '</a></li>';
                    }
                }
            }
            $detail .= '</ul>
        						</div>';
        }
        $detail .= '
                    </div>';


        $detail .= '<div class="row" style="margin-top: 10px;">
                                    <div class="col-md-6 col-sm-6">
                                        <label><b>Note</b></label>
                                        <input class="form-control" type="text" value="' . $q->note . '" readonly>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label><b>Sales</b></label>
                                        <input class="form-control" type="text" value="' . $q->nama_sales . '" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="invoice">
                                <div class="col-md-12 col-sm12">
                                    <table class="table table-striped table-bordered bootstrap-datatable datatable" id="history">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice</th>
                                                <th>Periode</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
        $q = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`status`!=9 AND a.`nomor` IS NOT NULL AND a.`id_order` =" . $this->input->post("id") . " ORDER BY a.`tanggal` ASC")->result();
        foreach ($q as $tab) {
            $no++;
            $detail .= '<tr>
                                    <td>' . $no . '</td>
                                    <td><a id="' . $tab->id . '" style="color:blue" onclick="cetak(this);" >' . $tab->nomor . '</a></td>
                                    <td>' . $tab->periode_dari . '</td>
                                    </tr>';
        }
        $detail .= '</tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>';
        return $detail;
    }
}
