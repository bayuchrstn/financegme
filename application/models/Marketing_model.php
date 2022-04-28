<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Marketing_model extends CI_Model
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
        $db->where('session_id_erp', $this->session->userdata('session_id_erp'));
        $db->where('username', $this->session->userdata('username'));
        // echo $this->session->userdata('session_id_erp').'<br>';
        // echo $this->session->userdata('username');exit;
        $data = $db->get('ms_user')->row();
        if (empty($data->username)) {
            redirect('marketing/logout');
        }
        return $data;
    }
    function get_customers($id = 0, $custid = '', $start = '', $end = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        if (!empty($custid)) {
            $db->where('id_cust', $custid);
        }
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($start)) {
            $db->where('timestamp >=', $start);
        }
        if (!empty($end)) {
            $db->where('timestamp <=', $end);
        }
        // $db->order_by('nama', 'asc');
        $db->order_by('idcust', 'asc');
        $db->where('status !=', 9);
        return $db->get('ms_customers');
    }
    function get_orderhead($id = 0, $custid = '', $start = '', $end = '', $flag = '', $status = '', $crm = '', $badgeno = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        if (!empty($custid)) {
            $db->where('id_cust', $custid);
        }
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($start)) {
            $db->where('timestamp >=', $start);
        }
        if (!empty($end)) {
            $db->where('timestamp <=', $end);
        }
        if (!empty($status)) {
            $db->where('status', $status);
        }
        if (!empty($crm)) {
            $db->where('flag_crm', $crm);
        }
        if (!empty($badgeno)) {
            $db->where('id_sales', $badgeno);
        }
        if (!empty($flag)) {
            if ($flag == 'project') {
                $db->where('biaya_barang IS NULL', null, false);
            } else if ($flag == 'sales') {
                $db->where('biaya_installasi IS NULL', null, false);
            }
        }
        $db->where('status !=', 9);
        $db->order_by('id', 'desc');
        return $db->get('order_header');
    }
    function get_relokasi($id = 0, $start = '', $end = '', $status = '', $flag = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        if (!empty($id)) {
            $db->where('id_order', $id);
        }
        if (!empty($start)) {
            $db->where('timestamp >=', $start);
        }
        if (!empty($end)) {
            $db->where('timestamp <=', $end);
        }
        if (!empty($status)) {
            $db->where('status', $status);
        }
        if ($flag == 'upgrade') {
            $db->where('id_site2', 0);
        } else {
            $db->where('id_site2 !=', 0);
        }
        $db->where('status !=', 9);
        $db->order_by('id', 'desc');
        return $db->get('relokasi');
    }
    function get_dismantle($id = 0, $start = '', $end = '', $status = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        if (!empty($id)) {
            $db->where('id_order', $id);
        }
        if (!empty($start)) {
            $db->where('timestamp >=', $start);
        }
        if (!empty($end)) {
            $db->where('timestamp <=', $end);
        }
        if (!empty($status)) {
            $db->where('status', $status);
        }
        $db->where('status !=', 9);
        $db->order_by('id', 'desc');
        return $db->get('dismantle');
    }
    function get_username2()
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('session_id_erp', $this->session->userdata('session_id_erp'));
        $db->where('username', $this->session->userdata('username'));
        $data = $db->get('ms_user');
        return $data->row();
    }
    function get_ms_employee($id)
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('id', $id);
        $data = $db->get('ms_employee');
        return $data->row();
    }
    function get_login()
    {
        if (
            $this->session->userdata('login') != TRUE
            || $this->session->userdata('session_id_erp') == ''
            || $this->session->userdata('email') == ''
        ) {
            $this->session->set_flashdata('message', 'Anda harus login dulu');
            $this->session->set_flashdata('notifikasi', 'error');
            redirect('marketing/process_logout');
        } else {
            $this->get_username();
        }
    }

    function get_ms_user($id = '', $email = '', $id2 = '')
    {
        $db = $this->load->database('absen', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($id2)) {
            $db->where('id_employee', $id2);
        }
        if (!empty($email)) {
            $db->where('username', $email);
        }
        $db->from('ms_user');
        // $db->order_by('nama', 'asc');
        return $db->get();
    }
    function get_opt_company($flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('ms_customers');
        $db1->where('status', 1);
        $db1->order_by('nama', 'asc');
        if (!empty($flag)) {
            if ($flag == 1) {
                $result[0] = 'Semua Client';
            } else {
                $result[0] = 'Pilih Client..';
            }
        } else {
            $result[''] = '';
            $result['add'] = 'Tambah Baru..';
        }
        $hasil = $db1->get();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->idcust . ' - ' . $row->nama . ' ' . $row->kota;
        }
        return $result;
    }
    function get_opt_company_had_site($flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $hasil = $db1->query("SELECT `ms_customers`.* FROM `ms_customers` inner join ms_site on ms_site.id_cust=ms_customers.id 
		WHERE ms_customers.status='1' ORDER BY ms_customers.nama ASC");
        if (!empty($flag)) {
            if ($flag == 1) {
                $result[0] = 'Semua Client';
            } else {
                $result[0] = 'Pilih Client..';
            }
        } else {
            $result[''] = '';
            $result['add'] = 'Tambah Baru..';
        }
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->idcust . ' - ' . $row->nama . ' ' . $row->kota;
        }
        return $result;
    }
    function get_opt_site($id_cust = '', $flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('ms_site');
        $db1->where('status', 1);
        if ($id_cust) {
            $db1->where('id_cust', $id_cust);
        }
        $db1->order_by('nama', 'asc');
        $hasil = $db1->get();
        if ($flag) {
            $result[0] = ' Semua Client ';
        }
        foreach ($hasil->result() as $row) {
            $com = $this->get('ms_customers', $row->id_cust)->row();
            if ($id_cust) {
                $result[$row->id] = $row->nama . ' - ' . $row->alamat . ' ' . $row->kota;
            } else {
                if (!empty($com)) {
                    $result[$row->id] = $com->idcust . ' - ' . $com->nama . ' , Site : ' . $row->nama . ' - ' . $row->alamat . ' ' . $row->kota;
                } else {
                    $result[$row->id] = 'Site : ' . $row->nama . ' - ' . $row->alamat . ' ' . $row->kota;
                }
            }
        }
        return $result;
    }
    function get_opt_site2()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $hasil = $db1->query("SELECT ms_site.id as id_site, ms_site.nama as nama_site, ms_site.alamat as alamat_site, ms_site.kota as kota_site, `ms_customers`.* FROM `ms_customers` 
		inner join ms_site on ms_site.id_cust=ms_customers.id 
		WHERE ms_customers.status='1' ORDER BY ms_customers.nama ASC");
        foreach ($hasil->result() as $row) {
            // $com = $this->get('ms_customers',$row->id_cust)->row();			

            $result[$row->id_site] = $row->idcust . ' - ' . $row->nama . ' ' . $row->kota . ' , Site : ' . $row->nama_site . ' - ' . $row->alamat_site . ' ' . $row->kota_site;
        }
        return $result;
    }

    function get_opt_buktibayar()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('bukti_bayar');
        $db1->where('status', 1);
        $db1->order_by('nomor', 'asc');
        $hasil = $db1->get();

        $result[0] = ' Pilih Nomor ';

        foreach ($hasil->result() as $row) {
            $result[$row->ids] = $row->nomor;
        }
        return $result;
    }

    function get_opt_order($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('order_header');
        $db1->where('status', 1);
        if (!empty($id)) {
            $db1->where('id_cust', $id);
        }
        $db1->order_by('nomor', 'asc');
        $hasil = $db1->get();
        $result[0] = 'Pilih Order';
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->nomor;
        }
        return $result;
    }

    function get_opt_cpe($flag = '')
    {
        $db1 = $this->load->database('erp', TRUE);
        $db1->from('cpe');
        $db1->where('status !=', 9);
        $db1->where('id_barang !=', 99999);
        if (!empty($flag)) {
            // $result[0]= 'Semua Company';
        } else {
            $result['0'] = 'Pilih Barang';
        }
        $hasil = $db1->get();
        foreach ($hasil->result() as $row) {
            $a = $this->get_jenis_barang_id($row->id_barang);
            $result[$row->id_barang] = $a->nama_barang;
        }
        return $result;
    }
    function get_opt_region($flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('ms_region');
        $db1->where('status !=', 9);
        if (!empty($flag)) {
            $result[0] = 'Semua Region';
        } else {
            $result['0'] = 'Pilih Region';
        }
        $hasil = $db1->get();
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->region;
        }
        return $result;
    }
    function get_opt_marketing()
    {
        $db1 = $this->load->database('hrd', TRUE);
        $db1->from('ms_employee');
        // $db1->where('id_active', 1);
        // $db1->where('posisi', 'Sales & Marketing');
        $db1->where('id_departemen', '4');
        $db1->where('cabang', 'Semarang & Salatiga');
        // $db1->where('id_section', 46);
        $result['0'] = 'Pilih Sales';
        $hasil = $db1->get();
        foreach ($hasil->result() as $row) {
            $result[$row->pin] = $row->nama;
        }
        return $result;
    }
    function get_opt_layanan($edit = '', $flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('ms_layanan');
        $db1->where('flag', 2);
        // $db1->order_by('label',$order);
        $result['0'] = 'Pilih Layanan';
        if (empty($flag)) {
            $result['add'] = 'Tambah baru..';
        }
        $hasil = $db1->get();
        if ($edit) {
            $db1->from('ms_layanan');
            $db1->where('id', $edit);
            $hasil2 = $db1->get()->row();
            $result[$hasil2->id] = $hasil2->label;
        }
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->label;
        }
        return $result;
    }
    function get_opt_layanan2($edit = '', $flag = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->from('ms_layanan');
        $db1->where('flag', 2);
        // $db1->order_by('label',$order);
        $result[''] = 'Pilih Layanan';
        if (empty($flag)) {
            $result['add'] = 'Tambah baru..';
        }
        $hasil = $db1->get();
        if ($edit) {
            $db1->from('ms_layanan');
            $db1->where('id', $edit);
            $hasil2 = $db1->get()->row();
            $result[$hasil2->id] = $hasil2->label;
        }
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->label;
        }
        return $result;
    }
    function get_cpe()
    {
        $db1 = $this->load->database('erp', TRUE);
        $db1->from('cpe');
        $db1->where('status !=', 9);
        $db1->where('id_barang !=', 99999);
        return $db1->get();
    }
    function get_jenis_barang_id($id_header)
    {
        $db3 = $this->load->database('inventory', TRUE);
        return $db3->get_where('ms_header_barang', array('id_header' => $id_header), 1)->row();
    }
    // function get_outstanding_payment(){
    // return $this->db->query("SELECT invoice.* FROM invoice WHERE invoice.flag='2' AND NOT EXISTS (SELECT payment.id_invoice FROM payment WHERE invoice.`id`=payment.`id_invoice` AND payment.`flag`='2')");
    // }
    function get_next_pay()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT count from nomor_payment");
    }
    function get_client_service($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT order_service.* FROM order_service
		INNER JOIN order_header ON order_header.`id`=order_service.`id_order`
		WHERE order_header.id_cust='" . $id . "' AND order_service.`status`='1'");
    }
    function get_post($id = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        $db->from('order');
        return $db->get();
    }
    function get_order_serv_log($id = '')
    {
        // $db = $this->load->database('erp_gmedia', TRUE);
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('status !=', 9);
        if (!empty($id)) {
            $db1->where('id_cust', $id);
        }
        $db1->from('order_service_log');
        return $db1->get();
    }
    function get_item($id = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id_order', $id);
        }
        $db->from('order_barang');
        return $db->get();
    }
    function get_service($id = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id_order', $id);
        }
        $db->from('order_jasa');
        return $db->get();
    }
    function get_cp($id = '', $id2 = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id_cust', $id);
        }
        if (!empty($id2)) {
            $db->where('id_site', $id2);
        }
        $db->from('ms_contact');
        return $db->get();
    }
    function get_site($id = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        $db->where('valid', 2);
        if (!empty($id)) {
            $db->where('id_cust', $id);
        }
        $db->from('ms_site');
        return $db->get();
    }

    function get_erp_cpe($id = '', $id_brg = '')
    {
        $db = $this->load->database('erp', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($id_brg)) {
            $db->where('id_barang', $id_brg);
        }
        $db->from('cpe');
        return $db->get();
    }

    function delete_all($table, $idorder, $tanggal = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        if ($tanggal) {
            $db1->where('tanggal', $tanggal);
        }
        $db1->where('id_order', $idorder);
        $db1->update($table, array('status' => 9));
    }
    function delete_cp($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id_cust', $id);
        $db1->update('ms_contact', array('status' => 9));
    }
    function delete_brg($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id_order', $id);
        $db1->update('order_barang', array('status' => 9));
    }

    function get($table = '', $id = '', $order = '', $label = '')
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->where('status !=', 9);
        if (!empty($id)) {
            $db->where('id', $id);
        }
        if (!empty($order)) {
            $db->order_by('id', $order);
        }
        if (!empty($label)) {
            $db->where('label', $label);
        }
        $db->from($table);
        return $db->get();
    }
    function insert($table, $data, $id = '')
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $insert = $db1->insert($table, $data);
        if (!empty($id)) {
            $insert_id = $db1->insert_id();
            return  $insert_id;
        }
    }
    function delete($table, $id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id', $id);
        $db1->delete($table);
    }
    function update_order($table, $data, $id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id_order', $id);
        $db1->update($table, $data);
    }
    function update_transaksi($data, $id, $type)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id_order', $id);
        $db1->where('jenis_transaksi', $type);
        $db1->update('transaksi', $data);
    }
    function update_arpost($data, $id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id_order', $id);
        $db1->where('flag_dp', '1');
        $db1->update('arpost', $data);
    }
    function update_arpost_dp($data, $id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('id_order', $id);
        $db1->where('flag_dp', '2');
        $db1->update('arpost', $data);
    }
    function update($table, $data, $id, $db = '')
    {
        if (!empty($db)) {
            $db1 = $this->load->database($db, TRUE);
        } else {
            $db1 = $this->load->database('erp_gmedia', TRUE);
        }
        $db1->where('id', $id);
        $db1->update($table, $data);
    }
    function update_arr($table, $data, $where, $db = '')
    {
        if (!empty($db)) {
            $db1 = $this->load->database($db, TRUE);
        } else {
            $db1 = $this->load->database('erp_gmedia', TRUE);
        }
        $db1->where($where);
        $db1->update($table, $data);
    }
    function get_from_arr($table, $data, $db = '')
    {
        if (!empty($db)) {
            $db1 = $this->load->database($db, TRUE);
        } else {
            $db1 = $this->load->database('erp_gmedia', TRUE);
            $db1->order_by('id', 'desc');
        }
        $db1->from($table);
        $db1->where($data);
        return $db1->get();
    }
    //urut tanggal dari periode paling awal
    function get_merge_bydate($id)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT * FROM arpost_merge a JOIN arpost b ON a.`id_arpost` = b.`id` WHERE id_arpost_merge=$id ORDER BY periode_dari ASC")->result();
    }
    //INVENTORY/////////////////////////////////////////////////////////////////
    function get_administrator($kode)
    {
        $db1 = $this->load->database('erp', TRUE);
        $db1->from('administrator');
        $db1->where('kode', $kode);
        return $db1->get();
    }
    function get_nomor_permintaan2()
    {
        $db3 = $this->load->database('inventory', TRUE);
        return $db3->query('select * from tr_h_kebutuhan order by id_header DESC');
    }
    function add_header_permintaan($header)
    {
        $db3 = $this->load->database('inventory', TRUE);
        $db3->insert('tr_h_kebutuhan', $header);
    }
    function get_header_permintaan($nomor = '', $id = '')
    {
        $db3 = $this->load->database('inventory', TRUE);
        $db3->from('tr_h_kebutuhan');
        if ($nomor) {
            $db3->where('nomor', $nomor);
        }
        if ($id) {
            $db3->where('id_header', $id);
        }
        return $db3->get();
    }
    function edit_header_permintaan($id, $header)
    {
        $db3 = $this->load->database('inventory', TRUE);
        $db3->where('id_header', $id);
        $db3->update('tr_h_kebutuhan', $header);
    }
    function delete_pembelian_detail($id)
    {
        $db3 = $this->load->database('inventory', TRUE);
        $db3->where('id_header', $id);
        $db3->delete('tr_d_kebutuhan');
    }
    function get_ukuran_id($id)
    {
        $db3 = $this->load->database('inventory', TRUE);
        return $db3->get_where('ms_ukuran', array('id_ukuran' => $id), 1)->row();
    }
    function add_detail_permintaan($detail)
    {
        $db3 = $this->load->database('inventory', TRUE);
        $db3->insert('tr_d_kebutuhan', $detail);
    }
    function get_employee($id_employee)
    {
        $db = $this->load->database('absen', TRUE);
        $db->from('ms_employee');
        $db->where('id', $id_employee);
        return $db->get();
    }
    function get_detail_permintaan($id_header)
    {
        $db3 = $this->load->database('inventory', TRUE);
        $db3->select('a1.id_header, a2.nama_barang, a1.qty, a1.id_ukuran, a3.nama_ukuran, a1.keperluan, a1.keterangan, a4.nama_rb, a1.id_barang, a1.rb as id_rb, a1.id as id_detail, a1.nominal');
        $db3->from('tr_d_kebutuhan a1');
        $db3->join('ms_header_barang a2', 'a1.id_barang = a2.id_header');
        $db3->join('ms_ukuran a3', 'a1.id_ukuran = a3.id_ukuran');
        $db3->join('ms_rb a4', 'a1.rb = a4.id_rb');
        $db3->where('a1.id_header', $id_header);
        return $db3->get();
    }
    function get_last_order()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT `order_header`.nomor FROM `order_header` 
		ORDER BY nomor DESC");
    }
    function get_last_dismantle()
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        return $db1->query("SELECT * FROM `dismantle` 
		ORDER BY id DESC");
    }
    function get_data_bos()
    {
        $db2 = $this->load->database('absen', TRUE);
        return $db2->query('select * from ms_employee where id_grade = "5" AND id_department="4" order by id ASC')->row();
    }
    function get_from_query($query, $flag_insert = '')
    {
        $db2 = $this->load->database('erp_gmedia', TRUE);
        if (!empty($flag_insert)) {
            $insert_id = $db2->insert_id();
            return  $insert_id;
        } else {
            return $db2->query($query);
        }
    }

    function get_opt_cpe_inventory()
    {
        $db1 = $this->load->database('inventory', TRUE);
        $db1->from('ms_header_barang');
        $db1->order_by('nama_barang', 'desc');
        $result['0'] = 'Pilih Barang';
        $hasil = $db1->get();
        foreach ($hasil->result() as $row) {
            $db2 = $this->load->database('inventory', TRUE);
            $db2->from('ms_detail_barang');
            $db2->where('id_header', $row->id_header);
            $db2->order_by('id_detail', 'desc');
            $get = $db2->get()->row();
            if (!empty($get)) {
                // $result[$row->id_header] = $row->nama_barang.' | Rp '.$this->Kamus_model->uang($get->harga_beli);				
                $result[$row->id_header] = $row->nama_barang;
            } else {
                // $result[$row->id_header] = $row->nama_barang.' | Rp 0';
                $result[$row->id_header] = $row->nama_barang;
            }
        }
        return $result;
    }
    function get_inventory_price($id_brg = '')
    {
        $db = $this->load->database('inventory', TRUE);
        $db->where('status !=', 9);
        if (!empty($id_brg)) {
            $db->where('id_header', $id_brg);
        }
        $db->from('ms_detail_barang');
        $db->order_by('id_detail', 'desc');
        return $db->get();
    }
    function get_cpe_inventory()
    {
        $db1 = $this->load->database('inventory', TRUE);
        $db1->from('ms_header_barang');
        $db1->order_by('nama_barang', 'desc');
        return $db1->get();
    }
    //////////////////////////////////////////////////////////////////////
    function get_erp_query($q)
    {
        $db1 = $this->load->database('erp', TRUE);
        return $db1->query($q);
    }
    function get_options_segmentpromo()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->from('segment_promo_h');
        $db->where('status', 1);
        $hasil = $db->get();

        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->keterangan;
        }
        return $result;
    }

    function get_opt_pengajuan()
    {
        $db1 = $this->load->database('pengajuan', TRUE);
        $db1->from('header');
        $db1->where('status', 1);
        $db1->where('status_lunas', 1);
        $db1->order_by('timestamp', 'desc');
        $hasil = $db1->get();
        // print_r($hasil->result());exit;
        $result['0'] = 'Pilih';
        foreach ($hasil->result() as $row) {
            $result[$row->id] = $row->nomor;
        }
        return $result;
    }

    function update_cust_order_project($id, $data)
    {
        $db3 = $this->load->database('project', TRUE);
        $db3->where('id', $id);
        $db3->update('cust_order', $data);
    }
    function update_table_project($table, $param, $data)
    {
        $db3 = $this->load->database('project', TRUE);
        $db3->where($param);
        $db3->update($table, $data);
    }
    function get_from_arr_project($table, $data)
    {
        $db1 = $this->load->database('project', TRUE);
        $db1->from($table);
        $db1->where($data);
        $db1->order_by('id', 'desc');
        return $db1->get();
    }
    function get_from_query_project($query)
    {
        $db2 = $this->load->database('project', TRUE);
        return $db2->query($query);
    }
}
