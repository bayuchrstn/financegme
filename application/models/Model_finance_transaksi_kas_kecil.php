<?php
class Model_finance_transaksi_kas_kecil extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_table()
    {
        $limit = $order_name = $order_dir = $order = $q = null;
        $column_order = array(null, 'z.kode', 'z.urutan', 'z.tanggalnya', 'z.cabang', 'z.nama_divisi', 'z.nominal', 'z.deskripsi');
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'z.nomor';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
        // $this->db->order_by($order_name, $order_dir);
        if (!empty($order_name) && !empty($order_dir)) {
            $order = "ORDER BY $order_name $order_dir";
        } else {
            $order = "ORDER BY z.tanggalnya ASC,z.urutan ASC";
        }
        $q = $this->db->query("SELECT
        SQL_CALC_FOUND_ROWS *
      FROM
        (SELECT
          a.`id`,
          a.`nomor`,
          RIGHT(a.`nomor`, 10) AS urutan,
          a.`kode`,
          b.`memo` AS deskripsi,
          DATE_FORMAT(a.`tanggal`, '%d-%m-%Y') AS tanggalnya,
          c.`nama` AS nama_divisi,
          COALESCE(b.`nominal`, 0) AS nominal,
          COALESCE(a.`jumlah`, 0) AS total,
          d.`nama` AS nama_kode,
          CASE
            WHEN a.`branch` = 1
            THEN 'Semarang'
            WHEN a.`branch` = 2
            THEN 'Salatiga'
          END AS cabang
        FROM
          `gmd_finance_transaksi_kasir` `a`
          LEFT JOIN `gmd_finance_transaksi_kasir_detail` `b`
            ON `a`.`id` = `b`.`id_kasir`
          LEFT JOIN `gmd_finance_master_divisi` `c`
            ON `a`.`divisi` = `c`.`id`
          LEFT JOIN `gmd_finance_master_kat_gl` `d`
            ON `a`.`kode` = `d`.`id`
        WHERE (
            `b`.`memo` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `a`.`nomor` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
          )
          AND `a`.`status` = '1'
          AND `b`.`status` = '1'
          AND (
            a.`tanggal` BETWEEN '" . $this->input->post('searchDateFirst') . "'
            AND '" . $this->input->post('searchDateFinish') . "'
          )
        ) z $order $limit");
        // $this->db->select("SQL_CALC_FOUND_ROWS a.id,a.nomor,a.kode,b.memo as deskripsi, DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggalnya, c.nama as nama_divisi, COALESCE(b.nominal,0) AS nominal,COALESCE(a.jumlah,0) AS total,d.nama as nama_kode,
        // CASE WHEN a.`branch`=1 THEN 'Semarang' WHEN a.`branch`=2 THEN 'Salatiga' END AS cabang", false);
        // $this->db->from('finance_transaksi_kasir a');
        // $this->db->join('finance_transaksi_kasir_detail b', 'a.id = b.id_kasir', 'left');
        // $this->db->join('finance_master_divisi c', 'a.divisi = c.id', 'left');
        // $this->db->join('finance_master_kat_gl d', 'a.kode = d.id', 'left');
        // $this->db->group_start();
        // $this->db->like('b.memo', $this->input->post('search_keyword'));
        // $this->db->like('a.nomor', $this->input->post('search_keyword'));
        // $this->db->group_end();
        // $this->db->where('a.status', '1');
        // $this->db->where('b.status', '1');
        // $this->db->where("(a.tanggal between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
        // if ($this->input->post('searchkode') != 0) {
        //     $this->db->where('a.kode', $this->input->post('searchkode'));
        // }
        // $this->db->order_by($order_name, $order_dir);
        // if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        // $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $opsi = '<a href="#" onClick="update_data(\'' . $r['id'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
                $row  = array(
                    "no" => $no . '.',
                    "nomor" => $r['nomor'],
                    "kode_jurnal" => $r['nama_kode'],
                    "tanggal" => $r['tanggalnya'],
                    "cabang" => $r['cabang'],
                    "divisi" => $r['nama_divisi'],
                    "jumlah" => number_format($r['nominal'], 0),
                    "deskripsi" => $r['deskripsi'],
                    "opsi" => $opsi,
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

    function insert()
    {
        $date = date('Y-m-d H:i:s');
        $deb = 0;
        $tanggal = $this->input->post('tanggal');
        $guna = $this->input->post('guna');
        $card = $this->input->post('card');
        $debit = $this->input->post('debit');
        $nomor = $this->input->post('nomor');
        $kas_bank = $this->input->post('kas_bank');
        $note = $this->input->post('note');
        $divisi = $this->input->post('divisi_cat');
        $cabang = $this->input->post('cabang');
        $this->db->trans_start();
        if ($this->model_global->closing_date_kasir($tanggal)) {
            $jumlah = str_replace(",", "", $this->input->post('jumlah'));
            $data = array(
                'tanggal' => $tanggal,
                'nomor' => $nomor,
                'kode' => $kas_bank,
                'jumlah' => $jumlah,
                'divisi' => $divisi,
                'branch' => $cabang,
                'insert_by' => $this->session->userdata('userid'),
                'insert_at' => $date
            );
            $result = $this->db->insert('finance_transaksi_kasir', $data);
            $id = $this->db->insert_id();
            if ($result == true) {
                foreach ($guna as $k => $v) {
                    $deb = str_replace(",", "", $debit[$k]);
                    $data = array(
                        'id_kasir' => $id,
                        'id_coa' => $guna[$k],
                        'id_card' => $card[$k],
                        'memo' => $note[$k],
                        'nominal' => $deb,
                        'insert_at' => $date,
                        'insert_by' => $this->session->userdata('userid')
                    );
                    $this->db->insert('finance_transaksi_kasir_detail', $data);
                }
                $msg = 1;
                $msg = $this->insert_gl($tanggal, $guna, $card, $debit, $nomor, $kas_bank, $nomor, $note, $divisi, $cabang, null, null);
                if ($msg == 2) {
                    $this->db->where('id', $id);
                    $data = array('status' => 9, 'update_by' => $this->session->userdata('userid'), 'update_at' => $date);
                    $this->db->update('finance_transaksi_kasir', $data);
                    $this->db->where('id_kasir', $id);
                    $this->db->update('finance_transaksi_kasir_detail', $data);
                }
            } else {
                $msg = 0;
            }
        } else {
            $msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
        }
        $this->db->trans_complete();
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
        $kode_ju = $this->model_global->finance_master_kat_gl_name($id);
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

    function create_id()
    {
        $invoice_cek = 0;
        $query = $this->db->query("SELECT MAX(id) AS last_id FROM erp_financev2.`gmd_finance_coa_general_ledger`")->row();
        $invoice = $query->last_id;
        while ($invoice_cek < 1) {
            $this->db->where("id = '" . $invoice . "'", NULL, FALSE);
            $q = $this->db->get('finance_coa_general_ledger');
            if ($q->num_rows() == 0) {
                $invoice_cek = 1;
            } else {
                $invoice++;
            }
        }
        return $invoice;
    }

    function insert_gl($tanggal, $guna, $card, $debit, $no_ref, $kat_gl, $nomor, $note, $divisi, $cabang, $no_gl, $id_gl)
    {
        $msg = $ppn = $flag = $akun = $card_id = null;
        $deb = $kre = 0;
        $jkk = 0;
        if ($cabang == 2) {
            $card_id = '2';
            $jkk = 'JKK2';
        } else {
            $card_id = '1';
            $jkk = 'JKK-';
        }
        $this->db->trans_start();
        if ($this->model_global->closing_date_accounting($tanggal) == true) {
            $this->db->select('*');
            $this->db->from('finance_coa_general_ledger_detail a');
            $this->db->join('finance_coa_general_ledger b', 'a.no_trans = b.no_trans', 'left');
            $this->db->where('b.no_referensi', $no_ref);
            $this->db->where('LEFT(b.`jurnal_group`,4)', $jkk);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $msg = 2;
            } else {
                foreach ($guna as $k => $v) {
                    if (empty($no_gl)) {
                        $create_gl_id = $this->create_gl_id($kat_gl);
                        $create_queue_id = $this->create_queue_id();
                        $branch = $this->model_global->cek_id_regional($this->session->userdata('scope_area'));
                        $area = $this->model_global->cek_id_regional($this->session->userdata('scope_regional'));
                        $data = array(
                            'id' => $this->create_id(),
                            'no_trans' => $create_queue_id,
                            'kat_gl' => $kat_gl,
                            'jurnal_group' => $create_gl_id,
                            'deskripsi' => $nomor,
                            'tanggal' => $tanggal,
                            'no_referensi' => $no_ref,
                            'branch' => $branch,
                            'area' => $area,
                            'ppn' => 2
                        );
                        $this->db->insert('finance_coa_general_ledger', $data);
                    } else {
                        $create_gl_id = $no_gl;
                        $create_queue_id = $this->create_queue_id();
                        $branch = $this->model_global->cek_id_regional($this->session->userdata('scope_area'));
                        $area = $this->model_global->cek_id_regional($this->session->userdata('scope_regional'));
                        $data = array(
                            'id' => $id_gl,
                            'no_trans' => $create_queue_id,
                            'kat_gl' => $kat_gl,
                            'jurnal_group' => $create_gl_id,
                            'deskripsi' => $nomor,
                            'tanggal' => $tanggal,
                            'no_referensi' => $no_ref,
                            'branch' => $branch,
                            'area' => $area,
                            'ppn' => 2
                        );
                        $this->db->insert('finance_coa_general_ledger', $data);
                    }
                    //debit
                    $deb = str_replace(",", "", $debit[$k]);
                    $data = array(
                        'no_trans' => $create_queue_id,
                        'id_biaya' => $guna[$k],
                        'card_id' => $card[$k],
                        'tanggal' => $tanggal,
                        'divisi' => $divisi,
                        'debet' => $deb,
                        'kredit' => 0,
                        'ket' => $note[$k],
                        'branch' => $branch,
                        'area' => $area,
                    );
                    $this->db->insert('finance_coa_general_ledger_detail', $data);
                    $this->model_global->update_jurnal_bulanan($guna[$k], $card[$k], $tanggal, $branch, $area);
                    $this->model_global->update_jurnal_harian($guna[$k], $card[$k], $tanggal, $branch, $area);
                    //kredit
                    $akun = '111200';

                    $data = array(
                        'no_trans' => $create_queue_id,
                        'id_biaya' => $akun,
                        'card_id' => $card_id,
                        'tanggal' => $tanggal,
                        'divisi' => $divisi,
                        'debet' => 0,
                        'kredit' => $deb,
                        'ket' => $note[$k],
                        'branch' => $branch,
                        'area' => $area,
                    );
                    $this->db->insert('finance_coa_general_ledger_detail', $data);
                    $this->model_global->update_jurnal_bulanan($akun, $card_id, $tanggal, $branch, $area);
                    $this->model_global->update_jurnal_harian($akun, $card_id, $tanggal, $branch, $area);
                }
                $msg = 1;
            }
        }
        $this->db->trans_complete();
        return $msg;
    }

    function select()
    {
        $k = 0;
        $data = $data2 = $head = null;
        $q = $this->db->query("SELECT a.*, b.`id_coa`, b.`memo`, b.`nominal`,c.`nama` AS nama_divisi,
        d.`nama` AS kode_jurnal,e.`nama` AS nama_coa,b.`id_card`,f.`nama` AS nama_card
        FROM `gmd_finance_transaksi_kasir` a
        LEFT JOIN `gmd_finance_transaksi_kasir_detail` b 
        ON a.`id` = b.`id_kasir`
        LEFT JOIN `gmd_finance_master_divisi` c 
        ON a.`divisi`=c.`id` 
        LEFT JOIN `gmd_finance_master_kat_gl` d 
        ON a.`kode`=d.`id`
        LEFT JOIN `gmd_finance_coa` e
        ON b.`id_coa`=e.`id`
        LEFT JOIN `gmd_finance_coa_card_name` f
        ON b.`id_card`=f.`id` WHERE a.`status` = 1
        AND b.`status` = 1 AND a.`id` = '" . $this->input->post('id') . "'");
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k => $r) {
                $data .= '<div class="row adder">';
                $data .= '<div class="col-lg-3"><label>kode coa</label>
                <select class="form-control guna" id="guna_' . $k . '" name="guna[]"></select></div>';
                $data .= '<div class="col-lg-2"><label>card</label>
                <select class="form-control card" id="card' . $k . '" name="card[]"></select></div>';
                $data .= '<div class="col-lg-2"><label>debit</label>
				<input class="form-control currdebit" id="debit_' . $k . '" type="text" name="debit[]" value="0" style="text-align:right"/></div>';
                $data .= '<div class="col-lg-4"><label>note</label>
				<input class="form-control" type="text" id="note_' . $k . '" name="note[]"></div>';
                $data .= '<a href="#" class="delete" style="color:red">Delete</a></a><br></div>';
                $detail[$k] = array(
                    'id_coa' => $r['id_coa'],
                    'nama_coa' => $r['id_coa'] . ' - ' . $r['nama_coa'],
                    'id_card' => $r['id_card'],
                    'card_name' => $r['nama_card'],
                    'memo' => $r['memo'],
                    'nominal' => $r['nominal'],
                    'cabang' => $r['branch']
                );
            }
            $head = $q->row();
            $data2 = array('head' => $head, 'data' => $data, 'detail' => $detail);
        }
        return $data2;
    }

    function update()
    {
        $date = date('Y-m-d H:i:s');
        $deb = $msg = $no = $cab = 0;
        $row = $no_gl = $q = $id_gl = null;
        $tanggal = $this->input->post('tanggal');
        $guna = $this->input->post('guna');
        $card = $this->input->post('card');
        $debit = $this->input->post('debit');
        $nomor = $this->input->post('nomor');
        $kas_bank = $this->input->post('kas_bank');
        $note = $this->input->post('note');
        $divisi = $this->input->post('divisi_cat');
        $cabang = $this->input->post('cabang');
        if ($cabang == 2) {
            $cab = 'JKK2';
        } else {
            $cab = 'JKK-';
        }
        $branch = $this->model_global->cek_id_regional($this->session->userdata('scope_area'));
        $area = $this->model_global->cek_id_regional($this->session->userdata('scope_regional'));
        $this->db->trans_start();
        if ($this->model_global->closing_date_kasir($tanggal) == true && $this->model_global->closing_date_kasir($this->select_date($this->input->post('id'))) == true) {
            $jumlah = str_replace(",", "", $this->input->post('jumlah'));
            $data = array(
                'tanggal' => $tanggal,
                'nomor' => $nomor,
                'kode' => $kas_bank,
                'jumlah' => $jumlah,
                'divisi' => $divisi,
                'branch' => $cabang,
                'update_by' => $this->session->userdata('userid'),
                'update_at' => $date
            );
            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('finance_transaksi_kasir', $data);

            $data = array('status' => 9, 'update_by' => $this->session->userdata('userid'), 'update_at' => $date);
            $this->db->where('id_kasir', $this->input->post('id'));
            $this->db->update('finance_transaksi_kasir_detail', $data);
            foreach ($guna as $k => $v) {
                $deb = str_replace(",", "", $debit[$k]);
                $data = array(
                    'id_kasir' => $this->input->post('id'),
                    'id_coa' => $guna[$k],
                    'id_card' => $card[$k],
                    'memo' => $note[$k],
                    'nominal' => $deb,
                    'insert_at' => $date,
                    'insert_by' => $this->session->userdata('userid')
                );
                $this->db->insert('finance_transaksi_kasir_detail', $data);
            }
            $msg = 1;
            //delete gl
            $query = $this->db->query("SELECT nomor FROM erp_financev2.`gmd_finance_transaksi_kasir` WHERE id='" . $this->input->post('id') . "'")->row();

            $q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_general_ledger` a LEFT JOIN erp_financev2.`gmd_finance_coa_general_ledger_detail` b ON a.`no_trans`=b.`no_trans` WHERE a.`no_referensi` = '" . $query->nomor . "'")->row();
            if (!empty($q)) {
                $no_gl = $q->jurnal_group;
                $id_gl = $q->id;
            }
            //get jurnal kd

            $qr = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_coa_general_ledger` a LEFT JOIN erp_financev2.`gmd_finance_coa_general_ledger_detail` b ON a.`no_trans`=b.`no_trans` WHERE a.`no_referensi` = '" . $query->nomor . "'")->result();
            foreach ($qr as $row) {
                $no_trans = $row->no_trans;
                $id_biaya = $row->id_biaya;
                $card_id = $row->card_id;
                $tanggal1 = $row->tanggal;
                $this->db->where('no_trans', $no_trans);
                $this->db->where('id_biaya', $id_biaya);
                $this->db->where('card_id', $card_id);
                $this->db->delete('finance_coa_general_ledger_detail');
                $this->model_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal1, $branch, $area);
                $this->model_global->update_jurnal_harian($id_biaya, $card_id, $tanggal1, $branch, $area);
            }
            $this->db->where('no_referensi', $query->nomor);
            $this->db->where('LEFT(jurnal_group,4)', $cab);
            $this->db->delete('finance_coa_general_ledger');
            $msg = $this->insert_gl($tanggal, $guna, $card, $debit, $nomor, $kas_bank, $nomor, $note, $divisi, $cabang, $no_gl, $id_gl);
        } else {
            $msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
        }
        $this->db->trans_complete();
        return $msg;
    }

    function delete($id)
    {
        $date = date('Y-m-d H:i:s');
        $branch = $this->model_global->cek_id_regional($this->session->userdata('scope_area'));
        $area = $this->model_global->cek_id_regional($this->session->userdata('scope_regional'));
        $this->db->trans_start();
        if ($this->model_global->closing_date_kasir($this->select_date($id)) == true) {
            $this->db->where('id', $id);
            $data = array('status' => 9, 'update_by' => $this->session->userdata('userid'), 'update_at' => $date);
            $result = $this->db->update('finance_transaksi_kasir', $data);
            $this->db->where('id_kasir', $id);
            $result2 = $this->db->update('finance_transaksi_kasir_detail', $data);
            if ($result == true) {
                $query = $this->db->query("SELECT nomor FROM erp_financev2.`gmd_finance_transaksi_kasir` WHERE id=$id")->row();
                $this->db->select('*');
                $this->db->where('a.`no_referensi', $query->nomor);
                $this->db->from('finance_coa_general_ledger a');
                $this->db->join('finance_coa_general_ledger_detail b', 'a.no_trans=b.no_trans', 'left');
                $q = $this->db->get()->result();
                $this->db->where('no_referensi', $query->nomor);
                $this->db->delete('finance_coa_general_ledger');
                foreach ($q as $row) {
                    $no_trans = $row->no_trans;
                    $id_biaya = $row->id_biaya;
                    $card_id = $row->card_id;
                    $tanggal = $row->tanggal;
                    $this->db->where('no_trans', $no_trans);
                    $this->db->where('id_biaya', $id_biaya);
                    $this->db->where('card_id', $card_id);
                    $this->db->delete('finance_coa_general_ledger_detail');
                    $this->model_global->update_jurnal_bulanan($id_biaya, $card_id, $tanggal, $branch, $area);
                    $this->model_global->update_jurnal_harian($id_biaya, $card_id, $tanggal, $branch, $area);
                }
                $msg = 1;
            } else {
                $msg = 0;
            }
        } else {
            $msg = 'Proses Gagal, Tanggal transaksi telah ditutup';
        }
        $this->db->trans_complete();
        return $msg;
    }

    function finance_bank()
    {
        $this->db->select('*');
        $this->db->from('finance_master_kat_gl');
        $q = $this->db->get();
        return $q;
    }

    function departement()
    {
        $this->db->where('category', 'departement');
        $this->db->order_by('name', 'asc');
        $q = $this->db->get('master');
        return $q;
    }

    function cek_id_regional($id)
    {
        $data = 0;

        $q = $this->db->query("select id from gmd_regional where code = '" . $id . "'");
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $data = $r['id'];
            }
        }
        $q->free_result();

        return $data;
    }

    function cek_id_department($id)
    {
        $data = 0;

        $q = $this->db->query("select id from gmd_master where code = '" . $id . "'");
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $data = $r['id'];
            }
        }
        $q->free_result();

        return $data;
    }

    function get_karyawan($id)
    {
        $data = '<option value=""></option>';

        $q = $this->db->query("select id, name from gmd_people where departemen = '" . $id . "'");
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $data .= '<option value="' . $r['id'] . '">' . $r['name'] . '</option>';
            }
        }
        $q->free_result();

        return $data;
    }

    function select_date($id)
    {
        $this->db->select("a.tanggal", false);
        $this->db->from('finance_transaksi_kasir a');
        $this->db->where("a.id", $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                return $r['tanggal'];
            }
        }
        $q->free_result();
    }

    function get_detail()
    {
        $id = $this->input->post('id');
        $data = null;
        $no = 1;
        $q = $this->db->query("SELECT * FROM erp_financev2.`gmd_finance_transaksi_kasir_detail` a WHERE a.`id_kasir`=$id AND a.`status` != 9")->result();
        $data = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
        foreach ($q as $row) {
            $data .= "<tr><td style='padding-left:55px'>$no.</td><td style='padding:0px 20px'>$row->memo</td><td style='width:100px;text-align:right'>" . number_format($row->nominal, 2) . "</td>";
            $data .= '<td colspan="6"></td></tr>';
            $no++;
        }
        $data .= '</table>';
        $row = array("html" => $data);
        return json_encode($row);
    }

    function select_autocomplite_card_id($text, $id)
    {
        $this->db->select("id,nama");
        $this->db->from("finance_coa_card_name a");
        $this->db->where("a.coa", $id);
        $this->db->where("(nama like '%" . $text . "%')", NULL, FALSE);
        $this->db->order_by('id', 'asc');
        $q = $this->db->get();
        return $q->result();
    }

    function select_autocomplite_card_full($id)
    {
        $this->db->select("id,nama");
        $this->db->from("finance_coa_card_name");
        $this->db->where('coa', $id);
        $this->db->order_by('id', 'asc');
        $q = $this->db->get();
        return $q->result();
    }
}
