<?php
class Model_finance_tax_upload extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insertdata($data)
    {
        return $this->db->insert('finance_tax_upload', $data);
    }

    function updatedata($data, $id)
    {
        $this->db->where('id', $id);
        $a = $this->db->update('finance_tax_upload', $data);
        return $a;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('finance_tax_upload');
    }

    function showall()
    {
        $this->db->select('*');
        $this->db->from('finance_tax_upload');

        return $this->db->get();
    }


    function select_data()
    {
        $this->db->select('*');
        $this->db->where('id', $this->input->post('id'));
        $this->db->from('finance_tax_upload');

        $q = $this->db->get();
        return $q->result();
    }

    function checkid($id)
    {
        $this->db->select('*');
        $this->db->where('no_faktur', $id);
        $this->db->from('finance_tax_upload');

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
        $column_order = array(null, 'a.no_faktur', 'a.tanggal');
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.tanggal';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        $this->db->select("a.id as id,a.no_faktur as no_faktur,a.tanggal as tanggal", false);
        $this->db->from('finance_tax_upload a');
        $this->db->group_start();
        $this->db->like('a.no_faktur', $this->input->post('search_keyword'));
        $this->db->group_end();
        $this->db->where("(a.tanggal between '" . $this->input->post('searchDateFirst') . "' and '" . $this->input->post('searchDateFinish') . "')", NULL, FALSE);
        $this->db->where('a.status', 1);
        $this->db->group_by('a.id,a.no_faktur');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $link = '<a target="_blank" href="./assets/generate/report/faktur/' . $r['no_faktur'] . '.pdf" style="color:blue">' . $r['no_faktur'] . '</a>';
                $no++;
                $row  = array(
                    $no . '.',
                    $link,
                    $r['tanggal'],
                    null
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

    function get_tahun()
    {
        $this->db->select('LEFT(tanggal,4) as tanggal');
        $this->db->from('finance_tax_upload');

        $query = $this->db->get();
        return $query;
    }
}
