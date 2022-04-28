<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Finance_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function check_user($username, $password)
    {
        $db = $this->load->database('absen', TRUE);
        $query = $db->get_where('ms_user', array('username' => $username, 'password' => $password, 'status' => 1));
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function update_session($username, $session)
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('username', $username);
        $db->update('ms_user', $session);
    }
    function get_username()
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('session', $this->session->userdata('session'));
        $db->where('username', $this->session->userdata('email'));
        $data = $db->get('ms_user')->row();
        if (empty($data->email)) {
            redirect('marketing/process_logout');
        }
        $data = $this->db->get('ms_user');
        return $data->result();
    }
    function get_username2()
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('session_id_erp', $this->session->userdata('session'));
        $db->where('username', $this->session->userdata('username'));
        $data = $db->get('ms_user');
        return $data->row();
    }
    function get_login()
    {
        if (
            $this->session->userdata('login') != TRUE
            || $this->session->userdata('session') == ''
            || $this->session->userdata('email') == ''
        ) {
            $this->session->set_flashdata('message', 'Anda harus login dulu');
            $this->session->set_flashdata('notifikasi', 'error');
            redirect('marketing/process_logout');
        } else {
            $this->get_username();
        }
    }

    function get_ms_user($id = '', $email = '')
    {
        $db = $this->load->database('absen', TRUE);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($email)) {
            $db->where('username', $email);
        }
        $db->from('ms_user');
        $db->order_by('username', 'asc');
        return $db->get();
    }

    function get_opt_bank()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('ms_bank');
        $db1->where('status', 1);
        $result[''] = '';
        $hasil = $db1->get();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->bank . ' - ' . $row->rekening . ' - ' . $row->an;
        }
        return $result;
    }

    function get_sum_payment2($no)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT SUM(harga_dasar) AS sum_hd, SUM(ppn) AS sum_ppn FROM `payment_detail` WHERE no_invoice='" . $no . "' AND status='1'");
    }
    function get_customers_fin($start = '', $end = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $query = "SELECT ms_customers.* FROM ms_customers
		INNER JOIN `order_header` ON order_header.`id_cust`=ms_customers.`id`
		WHERE `order_header`.`status`='1' AND ms_customers.`status`='1'";
        if (!empty($start)) {
            $query .= ' ms_customers.timestamp >= "' . $start . '"';
        }
        if (!empty($end)) {
            $query .= ' ms_customers.timestamp <= "' . $end . '"';
        }
        $query .= ' ORDER BY ms_customers.`nama`';
        return $db1->query($query);
    }
    function get_transaksi_distinct()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT DISTINCT `transaksi`.nomor AS nomor FROM `transaksi` 
		WHERE transaksi.`status`!='9'");
    }
    function get_transaksi_distinct_order()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT `transaksi`.nomor FROM `transaksi` 
		ORDER BY nomor DESC");
    }
    function sum_transaksi_langganan($nomor)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT SUM(nominal) AS jml FROM transaksi WHERE nomor='" . $nomor . "' AND jenis_transaksi='LG' AND status='1'");
    }
    function get_transaksi22($idcust = '', $date = '', $date2 = '', $inv = '', $ppn = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->select('transaksi.*, ms_site.nama, ms_customers.idcust');
        $db->from('transaksi');
        $db->join('order_header', 'order_header.id = transaksi.id_order', 'inner');
        $db->join('ms_site', 'ms_site.id = order_header.id_site', 'inner');
        $db->join('ms_customers', 'ms_customers.id = ms_site.id_cust', 'inner');
        if (!empty($idcust)) {
            $db->where('transaksi.id_cust', $idcust);
        }
        if (!empty($date)) {
            $db->where('transaksi.tanggal >=', $date);
        }
        if (!empty($date2)) {
            $db->where('transaksi.tanggal <=', $date2);
        }
        if (!empty($inv)) {
            $db->where('transaksi.nomor', $inv);
        }
        if (!empty($ppn)) {
            if ($ppn == 1) {
                $db->where('order_header.ppn', 1);
                $db->or_where('order_header.ppn', 3);
            } else {
                $db->where('order_header.ppn', 2);
            }
        }
        $db->order_by('transaksi.nomor', 'asc');
        return $query = $db->get();
        // return $db->query('select transaksi.*, ms_site.nama from transaksi inner join order_header on order_header.id=transaksi.id_order inner join ms_site on ms_site.id=order_header.id_site where transaksi.id_cust="'.$id_cust.'"');
    }
    function get_transaksi2($id = '', $idcust = '', $date = '', $date2 = '', $inv = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($idcust)) {
            $db->where('id_cust', $idcust);
        }
        if (!empty($date)) {
            $db->where('tanggal >=', $date);
        }
        if (!empty($date2)) {
            $db->where('tanggal <=', $date2);
        }
        if (!empty($inv)) {
            $db->where('nomor', $inv);
        }
        $db->from('transaksi');
        return $db->get();
    }
    function get_transaksi($id = '', $idcust = '', $nomor = '', $flag = '', $date = '', $date2 = '', $periode = '', $id_order = '', $jenis = '', $id_order_service = '', $sort = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($idcust)) {
            $db->where('id_cust', $idcust);
        }
        if (!empty($nomor)) {
            $db->where('nomor', $nomor);
        }
        if (!empty($flag)) {
            $db->where('flag', $flag);
        }
        if (!empty($id_order)) {
            $db->where('id_order', $id_order);
        }
        if (!empty($date)) {
            $db->where('tanggal >=', $date);
        }
        if (!empty($date2)) {
            $db->where('tanggal <=', $date2);
        }
        if (!empty($periode)) {
            $db->where('tanggal', $periode);
        }
        if (!empty($jenis)) {
            $db->where('jenis_transaksi', $jenis);
        }
        if (!empty($id_order_service)) {
            $db->where('id_order_service', $id_order_service);
        }
        if (empty($sort)) {
            //important! (don't change this line)/////
            $db->order_by('id', 'desc');
            //////////////////////////////////////////
        } else {
            $db->order_by('id', 'asc');
        }
        $db->from('transaksi');
        return $db->get();
    }
    function get_arpost_order()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        // $db->where('status !=', 9);		
        $db->order_by('nomor', 'desc');
        $db->from('arpost');
        return $db->get();
    }
    function get_arpost2($id = '', $nomor = '', $idcust = '', $aksi = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($nomor)) {
            $db->where('nomor', $nomor);
        }
        if (!empty($idcust)) {
            $db->where('id_cust', $idcust);
        }
        if (!empty($aksi)) {
            $db->where('aksi', $aksi);
        }
        $db->from('arpost');
        return $db->get();
    }
    function get_arpost_query($periode1 = '', $periode2 = '', $aksi = '', $flag = '', $flagdp = '', $region = '', $ppn = '', $site = '', $pph = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $query = "";
        if (!empty($region) or !empty($ppn)) {
            $query .= "(select arpost.* from arpost ";
            if (!empty($pph)) {
                $query .= " left join payment_header on payment_header.no_invoice=arpost.nomor";
            }

            $query .= " where arpost.status='1' ";

            if (!empty($region)) {
                $query .= " AND arpost.id_region='" . $region . "' ";
            }
            if ($periode1) {
                $query .= " AND arpost.tanggal >= '" . $periode1 . "'";
            }
            if ($periode2) {
                $query .= " AND arpost.tanggal <= '" . $periode2 . "'";
            }
            if (!empty($aksi)) {
                $query .= " AND arpost.`aksi`='" . $aksi . "'";
            }
            if (!empty($ppn)) {
                if ($ppn == 1) {
                    $query .= " AND (arpost.`ppn`='1' OR arpost.`ppn`='3')";
                } else {
                    $query .= " AND arpost.ppn='2' ";
                }
            }
            if (!empty($pph)) {
                if ($pph == 1) {
                    $query .= " AND payment_header.pph='0'";
                } else {
                    $query .= " AND payment_header.pph!='0'";
                }
            }
            $query .= ") union all (";
        }
        $query .= "SELECT arpost.* FROM arpost left JOIN ms_customers ON ms_customers.id=arpost.id_cust AND ms_customers.status!='9' ";
        if (!empty($pph)) {
            $query .= " left join payment_header on payment_header.no_invoice=arpost.nomor";
        }
        if (!empty($region) or !empty($ppn) or !empty($site)) {
            $query .= " INNER JOIN order_header ON order_header.`id`=arpost.`id_order`
			INNER JOIN ms_site ON ms_site.`id`=order_header.`id_site`
			 WHERE arpost.`status`!='9'  AND order_header.`status`!='9' ";
        } else {
            $query .= " WHERE arpost.`status`!='9' ";
        }
        if ($site) {
            $query .= " AND order_header.id_site = '" . $site . "'";
        }
        if ($periode1) {
            $query .= " AND arpost.tanggal >= '" . $periode1 . "'";
        }
        if ($periode2) {
            $query .= " AND arpost.tanggal <= '" . $periode2 . "'";
        }
        if (!empty($flag)) {
            $query .= " AND arpost.`flag`='" . $flag . "'";
        }
        if (!empty($aksi)) {
            $query .= " AND arpost.`aksi`='" . $aksi . "'";
        }
        if (!empty($flagdp)) {
            $query .= " AND arpost.`flag_dp`='" . $flagdp . "'";
        }
        if (!empty($region)) {
            $query .= " AND ms_site.`id_region`='" . $region . "'";
        }
        if (!empty($ppn)) {
            if ($ppn == 1) {
                $query .= " AND (order_header.`ppn`='1' OR order_header.`ppn`='3')";
            } else {
                $query .= " AND order_header.`ppn`='2'";
            }
        }
        if (!empty($pph)) {
            if ($pph == 1) {
                $query .= " AND payment_header.pph='0'";
            } else {
                $query .= " AND payment_header.pph!='0'";
            }
        }
        $query .= " AND arpost.nomor IS NOT NULL ORDER BY ms_customers.nama ASC ";
        if (!empty($region) or !empty($ppn) or !empty($site)) {
            $query .= " ,order_header.id_site ASC";
        }
        if (!empty($region) or !empty($ppn)) {
            $query .= " )";
        }
        // echo $query;exit;
        return $db->query($query);
    }
    function get_arpost($id = '', $idcust = '', $nomor = '', $id_order = '', $tanggal = '', $periode1 = '', $periode2 = '', $aksi = '', $flag = '', $flagdp = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($idcust)) {
            $db->where('id_cust', $idcust);
        }
        if (!empty($nomor)) {
            $db->where('nomor', $nomor);
        }
        if (!empty($id_order)) {
            $db->where('id_order', $id_order);
        }
        if (!empty($tanggal)) {
            $db->where('tanggal', $tanggal);
        }
        if (!empty($periode1)) {
            $db->where('tanggal >=', $periode1);
        }
        if (!empty($periode2)) {
            $db->where('tanggal <=', $periode2);
        }
        if (!empty($aksi)) {
            $db->where('aksi', $aksi);
        }
        if (!empty($flagdp)) {
            $db->where('flag_dp', $flagdp);
        } else {
            $db->where('flag_dp', 1);
        }
        if (!empty($flag)) {
            //jika ini arpost project order
            if ($flag == 1) {
                $db->where('periode_dari IS NOT NULL', null, false);
                //jika ini arpost sales order
            } else {
                $db->where('periode_dari IS NULL', null, false);
            }
        }
        //important! (don't change this line)/////
        $db->order_by('id', 'desc');
        //////////////////////////////////////////
        $db->from('arpost');
        return $db->get();
    }
    function update_tr($data, $id, $flag)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id', $id);
        $db1->where('flag', $flag);
        $db1->update('transaksi', $data);
    }

    function get_order($table = '', $id = '', $id_order = '', $flag = '', $id_site = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($id_order)) {
            $db->where('id_order', $id_order);
        }
        if (!empty($flag)) {
            $db->where('flag', $flag);
        }
        if (!empty($id_site)) {
            $db->where('id_site', $id_site);
        }
        //important! (don't change this line)/////
        $db->order_by('id', 'desc');
        //////////////////////////////////////////
        $db->from($table);
        return $db->get();
    }
    function get_merah($ppn = '', $kota = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $query = "SELECT arpost.* FROM arpost
			INNER JOIN order_header ON order_header.`id`=arpost.`id_order`
			INNER JOIN ms_customers ON ms_customers.`id`=arpost.`id_cust`
			WHERE arpost.`status`!='9' AND order_header.`status`!='9' AND (arpost.jml_piutang > arpost.jml_bayar OR arpost.jml_bayar IS NULL)";
        if ($ppn == 1) {
            $query .= " AND (order_header.`ppn`='1' OR order_header.`ppn`='3')";
        } else if ($ppn > 1) {
            $query .= " AND order_header.`ppn`='2'";
        }
        if (!empty($kota)) {
            $query .= " AND ms_customers.`id_region`='" . $kota . "'";
        }
        // echo $query;exit;
        return $db->query($query);
    }
    function get_transaksi_perjenis($id, $flag)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        if ($flag == 1) {
            return $db1->query("SELECT transaksi.* FROM transaksi
			INNER JOIN order_header ON order_header.`id`=transaksi.`id_order`
			WHERE transaksi.id_cust='" . $id . "' AND (order_header.`biaya_barang` IS NOT NULL OR order_header.`biaya_jasa` IS NOT NULL)");
        } else if ($flag == 2) {
            return $db1->query("SELECT transaksi.* FROM transaksi
			INNER JOIN order_header ON order_header.`id`=transaksi.`id_order`
			WHERE transaksi.id_cust='" . $id . "' AND order_header.`biaya_barang` IS NULL AND order_header.`biaya_jasa` IS NULL");
        }
    }
    function get_sum_perjenis($order, $flag, $jenis)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT SUM(transaksi.nominal) AS total FROM `transaksi` 
		WHERE transaksi.`status`!='9' AND transaksi.`id_order`='" . $order . "' AND transaksi.`flag`='" . $flag . "' AND transaksi.`jenis_transaksi`='" . $jenis . "'");
    }
    function get_sum_payment($id, $flag)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT COALESCE(SUM(transaksi.nominal),0) AS total FROM `transaksi` 
		WHERE transaksi.`status`!='9' AND transaksi.`flag`='" . $flag . "' AND transaksi.`id_tr`='" . $id . "'");
    }
    function get_sum_service($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT SUM(order_service.biaya_langganan) AS total FROM `order_service` 
		WHERE order_service.`status`!='9' AND order_service.`id_order`='" . $id . "'");
    }
    function get_sum_transaksi($id, $date = '', $date2 = '', $kode = '', $nomor = '', $flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        if ($kode) {
            if ($date) {
                if ($nomor) {
                    $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
						WHERE transaksi.`status`!='9' AND transaksi.`tanggal`>='" . $date . "' AND transaksi.`tanggal`<='" . $date2 . "' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
                } else {
                    $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
						WHERE transaksi.`status`!='9' AND transaksi.`tanggal`>='" . $date . "' AND transaksi.`tanggal`<='" . $date2 . "' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.flag='" . $flag . "'";
                }
            } else {
                if ($nomor) {
                    $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
                } else {
                    $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.jenis_transaksi='" . $kode . "' AND transaksi.flag='" . $flag . "'";
                }
            }
        } else {
            if ($date) {
                $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.`tanggal`>='" . $date . "' AND transaksi.`tanggal`<='" . $date2 . "' AND transaksi.id_order='" . $id . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
            } else {
                if ($nomor) {
                    $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.nomor='" . $nomor . "' AND transaksi.flag='" . $flag . "'";
                } else {
                    $q = "SELECT SUM(transaksi.nominal) AS total, transaksi.id_order_service FROM `transaksi` 
					WHERE transaksi.`status`!='9' AND transaksi.id_order='" . $id . "' AND transaksi.flag='" . $flag . "'";
                }
            }
        }
        // echo $q;exit;
        return $db1->query($q);
    }
    function get_generate_order($idorder = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $qp = '';
        if (!empty($idorder)) {
            $qp = ' AND order_header.id="' . $idorder . '"';
        }
        return $db1->query("SELECT order_header.*
							FROM `order_header`
							INNER JOIN ms_customers ON ms_customers.id=order_header.id_cust
							WHERE order_header.STATUS='3' AND order_header.periode_tagih!='0' AND ms_customers.status!='9' " . $qp . "
							ORDER BY ms_customers.idcust ASC");
    }

    function get_muka($id = '', $date = '', $date2 = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($date)) {
            $db->where('tanggal >=', $date);
            $db->where('tanggal <=', $date2);
        }
        $db->from('muka');
        return $db->get();
    }
    function get_note($id = '', $id_arpost = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($id_arpost)) {
            $db->where('id_arpost', $id_arpost);
        }
        $db->from('note_penagihan');
        return $db->get();
    }
    function get($table = '', $id = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        $db->from($table);
        return $db->get();
    }
    function insert($table, $data, $lastid = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->insert($table, $data);
        if (!empty($lastid)) {
            return $this->db->insert_id();
        }
    }
    function delete($table, $id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id', $id);
        $db1->delete($table);
    }
    function delete_arr($table, $arr)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where($arr);
        $db1->delete($table);
    }
    function update($table, $data, $id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id', $id);
        $db1->update($table, $data);
    }
    function update_arr($table, $data, $arr)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where($arr);
        $db1->update($table, $data);
    }
    function get_from_arr($table, $data, $db = '')
    {
        if (!empty($db)) {
            $db1 = $this->load->database($db, TRUE);
        } else {
            $db1 = $this->load->database('erp_gmedia', TRUE);
        }
        $db1->where($data);
        $data = $db1->get($table);
        return $data;
    }
    function sum_lain($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT SUM(biaya) AS jml FROM order_lain WHERE id_order='" . $id . "' AND status='1'");
    }
    function sum_lain2($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT SUM(biaya) AS jml FROM order_lain WHERE id_site='" . $id . "' AND status='1'");
    }
    function get_cust_fin($region = '', $ppn = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $query = "SELECT 
					  order_header.*,
					  ms_site.nama,ms_site.email_billing,
					  ms_customers.`nama` AS cust, ms_customers.`idcust`,
					  order_service.id_serv
					FROM
					  order_header 
					  INNER JOIN ms_customers 
						ON ms_customers.`id` = order_header.`id_cust` 
					  INNER JOIN ms_site 
						ON ms_site.`id` = order_header.`id_site`
					  INNER JOIN order_service 
						ON order_service.`id_order` = order_header.`id` AND order_service.status='1'
					WHERE order_header.`status` = '3'";
        if (!empty($region)) {
            $query .= " AND ms_site.`id_region`='" . $region . "'";
        }
        if (!empty($ppn)) {
            $query .= " AND order_header.`ppn`='" . $ppn . "'";
        }
        $query .= ' ORDER BY ms_site.`nama`';
        // print_r($query);exit;
        return $db1->query($query);
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
        // if($flag==''){
        // $query = "select * from(SELECT 
        // arpost.* 
        // FROM
        // arpost 
        // INNER JOIN order_header 
        // ON order_header.`id` = arpost.`id_order` 
        // INNER JOIN ms_site 
        // ON ms_site.`id` = order_header.`id_site` 
        // WHERE ms_site.`id_region` = '".$region."' 
        // AND order_header.`ppn` = '".$ppn."' 
        // AND arpost.`status` != '9' 
        // AND arpost.`tanggal` = '".$date."'
        // union all
        // select arpost.*
        // from arpost
        // where arpost.id_region='".$region."' and arpost.ppn = '".$ppn."' AND arpost.`status` != '9' AND arpost.`tanggal` = '".$date."'
        // ) a
        // ORDER BY a.`nomor` DESC LIMIT 1";			
        // }else{
        // $query = "SELECT 
        // transaksi.* 
        // FROM
        // transaksi 
        // INNER JOIN order_header 
        // ON order_header.`id` = transaksi.`id_order` 
        // INNER JOIN ms_site 
        // ON ms_site.`id` = order_header.`id_site` 
        // WHERE ms_site.`id_region` = '".$region."' 
        // AND order_header.`ppn` = '".$ppn."' 
        // AND transaksi.`status` != '9' 
        // AND transaksi.`tanggal` = '".$date."'
        // ORDER BY transaksi.`nomor` DESC LIMIT 1";			
        // }

        // echo $query;exit;
        return $db1->query($query);
    }
    function get_bukti($id = '', $ids = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($ids)) {
            $db->where('ids', $ids);
        }
        $db->from('bukti_bayar');
        $db->order_by('id', 'desc');
        return $db->get();
    }

    function get_options_akunprompt($group = '', $flg = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        if (!empty($group)) {
            $db->where('group', $group);
            $db->or_where('group', 'KAS BANK');
        } else {
            $db->where('group', 'BANK');
            $db->or_where('group', 'KAS');
            $db->or_where('group', 'KAS BANK');
        }
        $db->order_by('kode');
        $hasil = $db->get('akun');
        // print_r($kode);exit;
        $result = array();
        if (!empty($flg)) {
            $result[0] = 'Semua Akun Kas/Bank';
        }
        foreach ($hasil->result() as $row) {
            if (empty($flg)) {
                $result[$row->kode] = $row->kode . ' - ' . $row->title;
            } else {
                $result[$row->id] = $row->kode . ' - ' . $row->title;
            }
        }
        return $result;
    }
    function get_options_akun($kode = '', $flg = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('group !=', '');
        $db->order_by('kode');
        $hasil = $db->get('akun');
        // print_r($kode);exit;
        $result = array();
        foreach ($hasil->result() as $row) {
            if (!empty($flg)) {
                $result[$row->id] = $row->kode . ' - ' . $row->title;
            } else {
                $result[$row->kode] = $row->kode . ' - ' . $row->title;
            }
        }
        return $result;
    }
    function get_options_akun_id($id = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('group !=', '');
        $db->order_by('kode');
        $hasil = $db->get('akun');
        // print_r($kode);exit;
        $result = array();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->kode . ' - ' . $row->title;
        }
        return $result;
    }
    function get_options_bank()
    {
        $db = $this->load->database('pengajuan', TRUE);
        $db->order_by('kode');
        $db->where('status', '1');
        $hasil = $db->get('ms_bank');
        // print_r($kode);exit;
        $result = array();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->kode . ' - ' . $row->cabang;
        }
        return $result;
    }
    function get_jurnal_view($date = '', $key = '', $date2 = '', $pc = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('jurnal a');
        $db->where('a.status !=', '9');
        $db->where('left(a.kode,3) !=', 'BKB');

        if (!empty($pc)) {
            $db->where('center', $pc);
        }
        if (!empty($date)) {
            $db->where('date >=', $date);
        }
        if (!empty($date2)) {
            $db->where('date <=', $date2);
        }
        if (!empty($key)) {
            $db->like('kode', $key, 'both');
        }
        $db->order_by('a.kode');
        return $db->get();
    }
    function get_jurnal_view2($group = '', $date = '', $key = '', $date2 = '', $pc = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('jurnal a');
        $db->where('a.status !=', '9');
        if ($group == 'kasmasuk') {
            $db->where('left(a.kode,3) =', 'BKM');
        } elseif ($group == 'kaskeluar') {
            $db->where('left(a.kode,3) =', 'BKK');
        } elseif ($group == 'bankmasuk') {
            $db->where('left(a.kode,3) =', 'BBM');
        } elseif ($group == 'bankkeluar') {
            $db->where('left(a.kode,3) =', 'BBK');
        } elseif ($group == 'bebas') {
            $db->where('left(a.kode,3) =', 'BUB');
        } else {
            $db->where('left(a.kode,3) =', 'BKB');
        }

        if (!empty($pc)) {
            $db->where('center', $pc);
        }
        if (!empty($date)) {
            $db->where('date >=', $date);
        }
        if (!empty($date2)) {
            $db->where('date <=', $date2);
        }
        // if(!empty($date2)){
        // $this->db->where('date <=', $date2);	
        // }
        if (!empty($key)) {
            $db->like('kode', $key, 'both');
        }
        $db->order_by('a.kode');
        return $db->get();
    }

    function get_jurnal_view3($group = '', $date = '', $key = '', $date2 = '', $pc = '', $ac = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->select('a.*, c.date as tglhead, c.kode, c.note, b.title');
        $db->from('jurnal_detail a');
        // $db->join('akun b', 'b.id=a.id_akun');
        $db->join('akun b', 'b.kode=a.akun');
        $db->join('jurnal c', 'c.id=a.idjurnal');
        $db->where('a.status !=', '9');
        // $db->where('b.group !=', 'KAS');
        // $db->where('b.group !=', 'BANK');
        if ($group == 'kasbank') {
            $where = " (LEFT(c.kode,3) = 'BKM' OR LEFT(c.kode,3) = 'BKK' OR LEFT(c.kode,3) = 'BBM' OR LEFT(c.kode,3) = 'BBK') ";
            $db->where($where);
            // $db->where('left(c.kode,3) =', 'BKM'); 
            // $db->or_where('left(c.kode,3) =', 'BKK'); 
            // $db->or_where('left(c.kode,3) =', 'BBM'); 
            // $db->or_where('left(c.kode,3) =', 'BBK'); 
            // if ($group=='kasmasuk'){
            // $db->where('left(c.kode,3) =', 'BKM');                    
            // }elseif($group=='kaskeluar') 
            // {
            // $db->where('left(c.kode,3) =', 'BKK');  
            // }elseif($group=='bankmasuk') 
            // {
            // $db->where('left(c.kode,3) =', 'BBM');  
            // }elseif($group=='bankkeluar') 
            // {
            // $db->where('left(c.kode,3) =', 'BBK');  
        } elseif ($group == 'bebas') {
            // $db->where('left(c.kode,3) =', 'BUB');
            $db->where('left(c.kode,3) !=', 'BKB');
            $db->where('left(c.kode,3) !=', 'BKM');
            $db->where('left(c.kode,3) !=', 'BKK');
            $db->where('left(c.kode,3) !=', 'BBM');
            $db->where('left(c.kode,3) !=', 'BBK');
        } else {
            $db->where('left(c.kode,3) =', 'BKB');
        }

        if (!empty($pc)) {
            $db->where('c.center', $pc);
        }
        if (!empty($date)) {
            $db->where('c.date >=', $date);
        }
        if (!empty($date2)) {
            $db->where('c.date <=', $date2);
        }
        if (!empty($ac)) {
            $db->where('c.id_akun', $ac);
        }
        // if(!empty($date2)){
        // $this->db->where('date <=', $date2);	
        // }
        if (!empty($key)) {
            $db->like('kode', $key, 'both');
        }
        // $db->group_by('c.kode');
        $db->order_by('c.date asc');
        $db->order_by('c.kode');
        // $db->order_by('a.kredit');
        return $db->get();
    }
    function get_opt_cabang2()
    {

        $result = array();
        $result[0] = 'Pilih';
        $result[3] = 'Semarang';
        $result[7] = 'Salatiga';

        return $result;
    }
    function createnotajurnal($nota = '', $update = '0', $date = '')
    {
        $thn = date('Y');
        $thn2 = date('y');
        $bln = date('m');
        if (!empty($date)) {
            $exp = explode('-', $date);
            $thn = $exp[0];
            $bln = $exp[1];
            $thn2 = substr($thn, -2);
        }
        $no_a = $this->get_counter('1', $thn);
        if ($no_a->num_rows() > 0) {
            $no_c   = $no_a->row();
            $urut = 0;
            if ($nota == "BKM") {
                $urut = $no_c->bkm;
            } elseif ($nota == "BKK") {
                $urut = $no_c->bkk;
            } elseif ($nota == "BBM") {
                $urut = $no_c->bbm;
            } elseif ($nota == "BBK") {
                $urut = $no_c->bbk;
            } elseif ($nota == "BUB") {
                $urut = $no_c->bub;
            } else {
                $urut = $no_c->count;
            }
            $sub    = strlen($urut + 1);
            $k      = ($urut + 1);
            $j      = '0';
            for ($i = $sub; 5 > $i; $i++) {
                $k = $j . $k;
            }
            $no   = $nota . '-' . $k . '/' . $bln . '/' . $thn2;
        } else {
            $no   = $nota . '-00001/' . $bln . $thn2;
        }

        if ($update == '1') {
            if ($nota == "BKM") {
                $nomor = array('bkm' => ($urut + 1));
            } elseif ($nota == "BKK") {
                $nomor = array('bkk' => ($urut + 1));
            } elseif ($nota == "BBM") {
                $nomor = array('bbm' => ($urut + 1));
            } elseif ($nota == "BBK") {
                $nomor = array('bbk' => ($urut + 1));
            } elseif ($nota == "BUB") {
                $nomor = array('bub' => ($urut + 1));
            } else {
                $nomor = array('count' => ($urut + 1));
            }

            $this->update_counter($nomor, '1');
        }
        return $no;
    }
    function get_counter($id = 1, $year = '', $month = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('counter');
        if ($year != '') {
            $db->where('year', $year);
        }
        if ($month != '') {
            $db->where('month', $month);
        }
        $db->where('id', $id);
        $db->limit('1');
        return $db->get();
    }
    function update_counter($data, $id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('id', $id);
        $db->update('counter', $data);
    }
    function add_jurnal($data)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->insert('jurnal', $data);
    }
    function update_jurnal($data, $id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('id', $id);
        $db->update('jurnal', $data);
    }
    function get_jurnal_kode($data)
    {
        $this->db->from('jurnal');
        $this->db->where('kode', $data);
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }
    function add_jurnal_detail($data)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->insert('jurnal_detail', $data);
    }
    function update_jurnal_detail_nota_id($id, $group = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $debit = 0;
        $kredit = 0;
        $idjur = $db->query("select * from jurnal_detail where id='$id'");
        foreach ($idjur->result() as $row1) {
            $idjurnal = $row1->idjurnal;
        }

        $hasil = $db->query("select ifnull(sum(debit),0) as deb,ifnull(sum(kredit),0) as kre from jurnal_detail where idjurnal='$idjurnal' and status<>'9' and flag!='1'");
        foreach ($hasil->result() as $row) {
            $debit = $row->deb;
            $kredit = $row->kre;
        }
        if ($kredit > $debit) {
            $val = $kredit - $debit;
        } else {
            $val = $debit - $kredit;
        }
        if ($group == 'kasmasuk') {
            $hasil = $db->query("update jurnal_detail set debit='$val' where idjurnal='$idjurnal' and flag='1'");
        } elseif ($group == 'kaskeluar') {
            $hasil = $db->query("update jurnal_detail set kredit='$val' where idjurnal='$idjurnal' and flag='1'");
        } elseif ($group == 'bankmasuk') {
            $hasil = $db->query("update jurnal_detail set debit='$val' where idjurnal='$idjurnal' and flag='1'");
        } elseif ($group == 'bankkeluar') {
            $hasil = $db->query("update jurnal_detail set kredit='$val' where idjurnal='$idjurnal' and flag='1'");
        }
    }
    function update_jurnal_detail_nota_id_jurnal($idjurnal, $group = '')
    {
        $debit = 0;
        $kredit = 0;

        $db = $this->load->database('erp_gmedia', TRUE);
        $hasil = $db->query("select ifnull(sum(debit),0) as deb,ifnull(sum(kredit),0) as kre from jurnal_detail where idjurnal='$idjurnal' and status<>'9' and flag!='1'");
        foreach ($hasil->result() as $row) {
            $debit = $row->deb;
            $kredit = $row->kre;
        }
        if ($kredit > $debit) {
            $val = $kredit - $debit;
        } else {
            $val = $debit - $kredit;
        }
        if ($group == 'kasmasuk') {
            $hasil = $db->query("update jurnal_detail set debit='$val' where idjurnal='$idjurnal' and flag='1' limit 1");
        } elseif ($group == 'kaskeluar') {
            $hasil = $db->query("update jurnal_detail set kredit='$val' where idjurnal='$idjurnal' and flag='1' limit 1");
        } elseif ($group == 'bankmasuk') {
            $hasil = $db->query("update jurnal_detail set debit='$val' where idjurnal='$idjurnal' and flag='1' limit 1");
        } elseif ($group == 'bankkeluar') {
            $hasil = $db->query("update jurnal_detail set kredit='$val' where idjurnal='$idjurnal' and flag='1' limit 1");
        }
    }
    function update_jurnal_detail_id($data, $id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('id', $id);
        $db->update('jurnal_detail', $data);
    }
    function get_jurnal_id($id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('jurnal');
        $db->where('id', $id);
        return $db->get();
    }
    function get_jurnal_detail_view($id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('jurnal_detail');
        $db->where('idjurnal', $id);
        $db->where('status !=', '9');
        return $db->get();
    }
    function get_akun_kode($kode = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('akun');
        if ($kode != '') {
            $db->where('kode', $kode);
        }
        $db->where('status !=', '9');
        return $db->get();
    }
    function get_jurnal_detail_id($id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('jurnal_detail');
        $db->where('id', $id);
        return $db->get();
    }

    function get_from_query($query = '', $dbase = '')
    {
        if (!empty($dbase)) {
            $db = $this->load->database($dbase, TRUE);
        } else {
            $db = $this->load->database('erp_gmedia', TRUE);
        }
        return $db->query($query);
    }
    function get_options_akunprompt_selain($kode)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        foreach ($kode as $a) {
            $db->where('kode !=', $a);
            $db->where('status !=', '9');
        }
        $db->order_by('kode');
        $hasil = $db->get('akun');

        foreach ($hasil->result() as $row) {
            $result[$row->kode] = $row->kode . ' - ' . $row->note;
        }
        return $result;
    }
    function get_options_kasbankdpaset()
    {
        $db = $this->load->database('erp_gmedia', TRUE);

        $db->where('group', 'BANK');
        $db->or_where('group', 'KAS');
        $db->or_where('group', 'KAS BANK');
        $db->or_where('group', 'UANG MUKA');
        $db->or_where('group', 'ASET');

        $db->order_by('kode');
        $hasil = $db->get('akun');
        $result = array();
        foreach ($hasil->result() as $row) {
            $result[$row->kode] = $row->kode . ' - ' . $row->title;
        }
        return $result;
    }

    function get_opt_cabang_kas()
    {

        $result = array();
        $result[0] = 'Pilih';
        $result[3] = 'Semarang | Rp 5.000.000';
        $result[7] = 'Salatiga | Rp 3.000.000';

        return $result;
    }

    function get_options_emp()
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('id_active', '1');
        $db->order_by('nama');
        $hasil = $db->get('ms_employee');
        $result = array();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->nama;
        }
        return $result;
    }

    function get_emp($id)
    {
        $db = $this->load->database('absen', TRUE);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        $db->from('ms_employee');
        return $db->get();
    }
    function get_kasbon($date = '', $date2 = '', $pc = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('kasbon');
        $db->where('status !=', '9');
        // $db->where('realisasi !=', '0');
        if (!empty($pc)) {
            $db->where('pc', $pc);
        }
        if (!empty($date)) {
            $db->where('date >=', $date);
        }
        if (!empty($date2)) {
            $db->where('date <=', $date2);
        }
        $db->order_by('id');
        $db->order_by('realisasi');
        return $db->get();
    }
    function get_options_region()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status', '1');
        $db->order_by('id');
        $hasil = $db->get('ms_region');
        $result = array();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->region;
        }
        return $result;
    }

    //inject web jogja

    function insertjogja($data)
    {
        $db = $this->load->database('erp_finance', TRUE);
        $db->insert('finance_invoice_customer', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    function insertjogja2($data)
    {
        $db = $this->load->database('erp_finance', TRUE);
        $db->insert('finance_invoice_customer_add', $data);
    }
    function getdataarpost($id)
    {
        $db = $this->load->database('erp_finance', TRUE);
        return $db->query("SELECT a.`id` , a.`id_order`, b.`id_cust`,b.`id_site`,a.`nomor`,a.`tanggal_invoice`,
		a.`periode_dari`,a.`periode_sampai`,a.`due_date`,a.`timestamp`,b.`id_serv`,a.`label_note`,b.`langganan`,c.`ppn`,
		c.`instalasi`,c.`lain2`,c.`potongan` FROM view_arpost_nonmerge a 
		JOIN erp_finance.`view_order_service` b ON (a.`id_order` = b.`id_order`
      	AND a.`nomor` = b.`nomor` AND a.`timestamp` = b.`TIMESTAMP`)
    	JOIN erp_finance.`view_transaksi` c ON (a.`id_order` = c.`id_order`
    	AND a.`nomor` = c.`nomor` AND a.`timestamp` = c.`TIMESTAMP`)")->result();
    }

    function checkmerge($id)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->select('id_arpost_merge');
        $db->where('id_arpost', $id);
        $db->from('arpost_merge');

        $query = $db->get();
        $ret = $query->row();
        if (!empty($ret)) {
            return $ret->id_arpost_merge;
        } else {
            return false;
        }
    }
    function get_transaksibymerge($no, $id)
    {
        $db = $this->load->database('erp_finance', TRUE);
        $db->select('*');
        $db->where('nomor', $no);
        $db->where('id_order', $id);
        $db->from('transaksi');

        return $db->get();
    }

    function getppn($no, $id, $waktu, $kode)
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->select('nominal');
        $db->where('nomor', $no);
        $db->where('id_order', $id);
        $db->where('timestamp', $waktu);
        $db->where('jenis_transaksi', $kode);
        $db->from('transaksi');

        $query = $db->get();
        $ret = $query->row();
        if (!empty($ret)) {
            return $ret->nominal;
        } else {
            return false;
        }
    }
}
