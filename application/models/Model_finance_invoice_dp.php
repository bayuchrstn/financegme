<?php
class Model_finance_invoice_dp extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insertdata($data)
    {
        return $this->db->insert('finance_invoice_dp', $data);
    }

    function updatedata($data, $id)
    {
        $this->db->where('id', $id);
        $a = $this->db->update('finance_invoice_dp', $data);
        return $a;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('finance_invoice_dp');
    }

    function showall()
    {
        $this->db->select('*');
        $this->db->from('finance_invoice_dp');

        return $this->db->get();
    }


    function select()
    {
        $id = $this->input->post("id");
        $table = null;
        $no = 0;
        $total = 0;
        $query = $this->db->query("SELECT
            `a`.`id`,
            `c`.`id` AS id_det,
            `b`.`nama_site`,
            `c`.`no_inv`,
            `c`.`nominal`,
            `c`.tanggal AS tanggal
        FROM
            `gmd_finance_downpayment` `a`
            JOIN `gmd_finance_customer_service2` `b`
            ON `a`.`id_cust` = `b`.`id`
            AND `a`.`id_site` = `b`.`service_id`
            JOIN `gmd_finance_downpayment_detail` c
            ON a.`id`=c.`id`
        WHERE `c`.`status` = '1' AND `a`.`id`=$id")->result();
        $table .= "<thead>
                    <tr>
                        <th style='text-align:center'>No</th>
                        <th style='text-align:center'>Nama</th>
                        <th style='text-align:center'>No Invoice</th>
                        <th style='text-align:center'>Tanggal</th>
                        <th style='text-align:center'>Jumlah</th>
                    </tr>
                </thead>";

        foreach ($query as $row) {
            ++$no;
            $table .= "<tbody>
            <tr>
                <td style='text-align:center'>$no</td>
                <td style='text-align:center'>$row->nama_site</td>
                <td style='text-align:center'>$row->no_inv</td>
                <td style='text-align:center'>$row->tanggal</td>
                <td style='text-align:center'>Rp " . number_format($row->nominal, 0) . "</td>
            </tr>
        </tbody>";
            $total = $total + $row->nominal;
        }
        $table .= "<tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style='text-align:center'><b>Total</b></td>
                <td style='text-align:center'><b>Rp " . number_format($total, 0) . "</b></td></tr>
                </tfoot>";
        $output = array('history' => $table);
        echo json_encode($output);
    }

    function checkid($id)
    {
        $this->db->select('*');
        $this->db->where('no_faktur', $id);
        $this->db->from('finance_invoice_dp');

        $query = $this->db->get();
        $ret = $query->row();
        if (!empty($ret)) {
            return $ret->id;
        } else {
            return false;
        }
    }

    function get_data_table()
    {
        $column_order = array(null, 'b.nama', 'b.nama_site', 'a.nominal', 'a.tanggal', 'a.status');
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'desc';

        $this->db->select("a.id,b.nama AS nama,b.nama_site,a.nominal,CASE WHEN a.status = 0 THEN 'Belum Terpakai' WHEN a.status = 1 THEN 'Terpakai' END AS status,DATE(a.tanggal) AS tanggal");
        $this->db->from('finance_downpayment a');
        $this->db->join('finance_customer_service2 b', 'a.id_cust=b.id AND a.id_site=b.service_id', 'left');
        $this->db->group_start();
        $this->db->like('b.nama', $this->input->post('search_keyword'));
        $this->db->like('b.nama_site', $this->input->post('search_keyword'));
        $this->db->group_end();
        $this->db->where("(a.tanggal between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $edit = '<a href="#" onclick="history(\'' . $r['id'] . '\')"><i class="icon-history position-left text-slate-800"></i></a>';
                $no++;
                $row  = array(
                    $no . '.',
                    $r['nama'],
                    $r['nama_site'],
                    number_format($r['nominal'], 0),
                    $r['tanggal'],
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
}
