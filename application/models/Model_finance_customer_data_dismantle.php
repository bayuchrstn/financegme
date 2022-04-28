<?php
class Model_finance_customer_data_dismantle extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_table()
    {
        $column_order = array(null, 'd.nama', 'c.nama', null, 'a.reason', 'a.tanggal', 'a.timestamp', null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'd.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';
        $kondisi = $order = $limit = null;
        if (!empty($this->input->post('searchkategori2'))) {
            if ($this->input->post('searchkategori2') == 1) {
                $kondisi .= " AND a.`sementara`='2'";
            } else {
                $kondisi .= " AND a.`sementara`!='2'";
            }
        }
        if (!empty($this->input->post('searchdatefirst')) || !empty($this->input->post('searchdatefinish'))) {
            $kondisi .= " AND (a.`tanggal` BETWEEN '" . $this->input->post('searchdatefirst') . "' AND '" . $this->input->post('searchdatefinish') . "')";
        }
        if (!empty($this->input->post('searchkategori1'))) {
            $kondisi .= " AND c.`id_region`='" . $this->input->post('searchkategori1') . "'";
        }
        if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
        // $this->db->order_by($order_name, $order_dir);
        if (!empty($order_name) && !empty($order_dir)) {
            $order = " ORDER BY $order_name $order_dir";
        } else {
            $order = " ORDER BY z.urutan ASC";
        }
        $q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS 
        b.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`sementara`,
          a.`reason`,
          a.`tanggal`,
          a.`timestamp`,
          c.`nama` as nama_site
        FROM
          erp_gmedia.`dismantle` a
          JOIN erp_gmedia.`order_header` b
            ON a.`id_order` = b.`id`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE a.`status` = 2 AND
        (
            `c`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `d`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `a`.`reason` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
          ) $kondisi GROUP BY a.`id` $order $limit");
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a>';
                $type = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-danger waves-effect" >Permanent</button></div>';
                if ($r['sementara'] == 2) {
                    $type = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-warning waves-effect" >Temporary</button></div>';
                }

                $row  = array(
                    $no . '.',
                    $r['idcust'] . ' - ' . $r['nama_cust'],
                    $r['nama_site'],
                    $type,
                    $r['reason'],
                    $this->Kamus_model->tanggal_indo($r['tanggal']),
                    $this->Kamus_model->tanggal_indo($r['timestamp']),
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

    function select()
    {
        $table = $data = null;
        $no = 0;
        $id = $this->input->post('id');
        $q = $this->db->query("SELECT * FROM erp_gmedia.`arpost` a WHERE a.`status`!=9 AND a.`nomor` IS NOT NULL AND a.`id_order` = $id ORDER BY a.`tanggal` ASC")->result();
        $table .= '<thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Periode</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($q as $row) {
            $no++;
            $table .= '<tr>
			<td>' . $no . '</td>
			<td><a id="' . $row->id . '" style="color:blue" onclick="cetak(this);" >' . $row->nomor . '</a></td>
			<td>' . $row->periode_dari . '</td>
		    </tr>';
        }
        $table .= '</tbody>';
        $data = array('isi' => $table);
        return json_encode($data);
    }
}
