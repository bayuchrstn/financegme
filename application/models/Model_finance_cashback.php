<?php
class Model_finance_cashback extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function select()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->select("d.nama AS site, b.id_cust, CAST(format(e.nominal,0) AS CHAR CHARACTER SET utf8) AS cashback,e.id AS id_trx, a.*,e.nominal AS jumlah,
        e.tanggal AS tanggal,f.nomor AS no_invoice,
        CONCAT('(PIC)             :  ',a.pic,'
(BANK)         :  ',UPPER(a.bank),'
(REKENING) :  ',a.rek,' a.n ',a.an,'
(TAGIHAN)   :  ',CAST(FORMAT(e.nominal,0) AS CHAR CHARACTER SET utf8),'
(SISA)           :  ',CAST(FORMAT(e.nominal - e.bayar,0) AS CHAR CHARACTER SET utf8)) AS konten");
        $db->from('cashback_usage a');
        $db->join('cashback b', 'a.id_cashback=b.id', 'inner');
        $db->join('order_header c', 'c.id=a.id_order', 'inner');
        $db->join('ms_site d', 'd.id=c.id_site', 'inner');
        $db->join('cashback_transaksi e', 'e.id_cashback_usage=a.id', 'inner');
        $db->join('arpost f', 'e.id_arpost=f.id', 'inner');
        $db->where('a.status != "9" AND b.status = "2"');
        $db->where("e.id", $this->input->post('id'));
        $q = $db->get();
        return $q->result();
    }


    function get_data_table()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $column_order = array(null, 'd.nama', 'a.pic', 'a.rek', 'a.bank', 'b.cashback', 'e.tanggal');
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'd.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'desc';

        $db->select("d.nama AS site, b.id_cust, b.cashback,e.id AS id_trx, a.*,CASE WHEN e.status=1 THEN 'Belum' WHEN e.status=2 THEN 'Lunas' END AS status_bayar,e.tanggal AS tanggal");
        $db->from('cashback_usage a');
        $db->join('cashback b', 'a.id_cashback=b.id', 'inner');
        $db->join('order_header c', 'c.id=a.id_order', 'inner');
        $db->join('ms_site d', 'd.id=c.id_site', 'inner');
        $db->join('cashback_transaksi e', 'e.id_cashback_usage=a.id', 'inner');
        $db->join('arpost` f', 'f.id=e.id_arpost', 'inner');
        $db->group_start();
        $db->like('d.nama', $this->input->post('search_keyword'));
        $db->like('a.pic', $this->input->post('search_keyword'));
        $db->group_end();
        $db->where('a.status != "9" AND b.status = "2" AND f.lunas = "1"');
        if ($this->input->post('search_status') != '') {
            $db->where('e.status', $this->input->post('search_status'));
        }
        $db->where("(e.tanggal between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
        $db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $db->limit($_POST['length'], $_POST['start']);
        $q = $db->get();
        $qn = $db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                if ($r['status_bayar'] == 'Belum') {
                    $edit = '<a href="#" onclick="update_data(\'' . $r['id_trx'] . '\')"><i class="icon-cash position-center text-slate-900"></i></a>';
                } else {
                    $edit = '';;
                }
                $no++;
                $row  = array(
                    $no . '.',
                    $r['site'],
                    $r['pic'],
                    $r['rek'] . ' a.n ' . $r['an'],
                    $r['bank'],
                    number_format($r['cashback'], 0),
                    $r['tanggal'],
                    $r['status_bayar'],
                    $edit
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

    function select_autocomplite_coa_id($id)
    {
        $cond = null;
        if (!empty($id)) {
            $cond = "AND (id like '%" . $id . "%'
            or nama like '%" . $id . "%')";
        }
        $this->db->select("id,nama");
        $this->db->from("finance_coa a");
        $this->db->where("(id='102001' OR id='102002' OR id='102005') $cond");
        $this->db->order_by('id', 'asc');
        $q = $this->db->get();
        return $q->result();
    }

    //ini dikasih jurnal
    function insert()
    {
        $db = $this->load->database('erp_gmedia', TRUE);
        $db->trans_start();
        $jumlah = str_replace(",", "", $this->input->post('jumlah'));
        $total = $this->input->post('cashback');
        if ($jumlah >= $total) {
            $status = 2;
        } else {
            $status = 1;
        }
        $data = array(
            'status' => $status,
            'bayar' => $jumlah
        );
        $tanggal = date("Y-m-d");
        $db->where('id', $this->input->post('id'));
        $result = $db->update('cashback_transaksi', $data);
        if ($result == true) {
            if ($status = 2) {
                $this->insert_gl($tanggal, $this->input->post('no_invoice'), 19, $jumlah, $this->input->post('guna'));
            }
            $msg = 1;
        } else {
            $msg = 0;
        }
        $db->trans_complete();
        return $msg;
    }

    function create_queue_id()
    {
        $invoice_cek = 0;
        $userid = str_pad($this->session->userdata('userid'), 6, '0', STR_PAD_LEFT);
        $code_queue = 1;
        $code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
        $invoice = date('ymdhis') . $userid . $code_queue_zero;
        while ($invoice_cek < 1) {
            $this->db->where("no_trans = '" . $invoice . "'", NULL, FALSE);
            $q = $this->db->get('finance_coa_general_ledger');
            if ($q->num_rows() == 0) {
                $invoice_cek = 1;
            } else {
                $code_queue++;
                $code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
                $invoice = date('ymdHis') . $userid . $code_queue_zero;
            }
            $q->free_result();
        }
        return $invoice;
    }

    function create_gl_id($id)
    {
        $kode_ju = $this->m_global->finance_master_kat_gl_name($id);
        $invoice_cek = 0;
        $code_queue = 1;
        $code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
        $invoice = $kode_ju . '-' . date('ymd') . $code_queue_zero;
        while ($invoice_cek < 1) {
            $this->db->where("jurnal_group = '" . $invoice . "'", NULL, FALSE);
            $q = $this->db->get('finance_coa_general_ledger');
            if ($q->num_rows() == 0) {
                $invoice_cek = 1;
            } else {
                $code_queue++;
                $code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
                $invoice = $kode_ju . '-' . date('ymd') . $code_queue_zero;
            }
            $q->free_result();
        }
        return $invoice;
    }
    //ini sedang dikerjakan
    function insert_gl($tanggal, $no_ref, $kat_gl, $jumlah, $kode_jurnal)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $msg = null;
        $this->db->trans_start();
        if ($this->m_global->closing_date_accounting($tanggal) == true) {
            $this->db->from('finance_coa_general_ledger_detail a');
            $this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
            $this->db->where('b.no_referensi', 'cb-' . $no_ref);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $msg = 'No referensi sudah pernah di input';
            } else {
                $data['list'] = $db1->query("SELECT b.`nama` FROM arpost a JOIN ms_site b ON a.`id_site` = b.`id` WHERE a.`nomor`='" . $no_ref . "'")->result();
                foreach ($data['list'] as $sow) {
                    $deskripsi = "Pembayaran cashback no invoice " . $no_ref . " - " . $sow->nama;
                }
                $create_queue_id = $this->create_queue_id();
                $create_gl_id = $this->create_gl_id($kat_gl);
                $branch = $this->m_global->cek_id_regional($this->session->userdata('scope_area'));
                $area = $this->m_global->cek_id_regional($this->session->userdata('scope_regional'));
                $data = array(
                    'no_trans' => $create_queue_id,
                    'kat_gl' => $kat_gl,
                    'jurnal_group' => $create_gl_id,
                    'deskripsi' => $deskripsi,
                    'tanggal' => $tanggal,
                    'no_referensi' => $no_ref,
                    'ppn' => 0,
                    'project' => 0,
                    'branch' => $branch,
                    'area' => $area,
                );
                $result = $this->db->insert('finance_coa_general_ledger', $data);
                if ($result == true) {
                    //hutang
                    $akun = 600505;
                    $data = array(
                        'no_trans' => $create_queue_id,
                        'id_biaya' => $akun,
                        'tanggal' => $tanggal,
                        'divisi' => 0,
                        'debet' => $jumlah,
                        'kredit' => 0,
                        'branch' => $branch,
                        'area' => $area,
                    );
                    $this->db->insert('finance_coa_general_ledger_detail', $data);
                    $this->m_global->update_jurnal_bulanan($akun, $tanggal, $branch, $area);
                    $this->m_global->update_jurnal_harian($akun, $tanggal, $branch, $area);

                    $data = array(
                        'no_trans' => $create_queue_id,
                        'id_biaya' => $kode_jurnal,
                        'tanggal' => $tanggal,
                        'divisi' => 0,
                        'debet' => 0,
                        'kredit' => $jumlah,
                        'branch' => $branch,
                        'area' => $area,
                    );
                    $this->db->insert('finance_coa_general_ledger_detail', $data);
                    $this->m_global->update_jurnal_bulanan($kode_jurnal, $tanggal, $branch, $area);
                    $this->m_global->update_jurnal_harian($kode_jurnal, $tanggal, $branch, $area);
                }
            }
        }
        $this->db->trans_complete();
        return $msg;
    }
}
