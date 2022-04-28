<?php
class Model_finance_customer_isolir extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_table()
    {
        $status=$type=null;
        $column_order = array(null, 'd.nama', 'c.nama', 'a.nomor_order_so','a.tgl_terminate','a.tgl_dismantle','a.jenis_terminate',null, 'a.status');
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'd.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';
        $kondisi = $order = $limit = null;
        if (!empty($this->input->post('searchkategori1'))) {
            if ($this->input->post('searchkategori1') == 1) {
                $kondisi .= " AND a.`jenis_terminate`='1'";
            } else {
                $kondisi .= " AND a.`jenis_terminate`='2'";
            }
        }
        if (!empty($this->input->post('searchdatefirst')) || !empty($this->input->post('searchdatefinish'))) {
            $kondisi .= " AND (a.`tgl_terminate` BETWEEN '" . $this->input->post('searchdatefirst') . "' AND '" . $this->input->post('searchdatefinish') . "')";
        }
        if (!empty($this->input->post('searchkategori'))) {
            $kondisi .= " AND a.`status`='" . $this->input->post('searchkategori') . "'";
        }
        if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
        // $this->db->order_by($order_name, $order_dir);
        if (!empty($order_name) && !empty($order_dir)) {
            $order = " ORDER BY $order_name $order_dir";
        } else {
            $order = " ORDER BY z.urutan ASC";
        }
        $q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,  
          d.`idcust`,
          d.`nama` as nama_cust,
          a.`nomor_order_so` AS nomor_so,
          a.`jenis_terminate`,
          a.`alasan_terminate`,
          a.`tgl_terminate`,
          a.`tgl_dismantle`,
          c.`nama` as nama_site,
          a.`status`
        FROM
          gmedia_erp_project.`task_terminate` a
          JOIN gmedia_erp_project.`so_order_header` e
            ON a.`nomor_order_so` = e.`nomor_order`
            JOIN gmedia_erp_project.`order_header` b
            ON e.`nomor_order_header`=b.`nomor_order`
          JOIN erp_gmedia.`ms_site` c
            ON b.`id_site` = c.`id`
          JOIN erp_gmedia.`ms_customers` d
            ON c.`id_cust` = d.`id`
        WHERE
        (
            `c`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `d`.`idcust` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `d`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `a`.`alasan_terminate` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
          ) $kondisi GROUP BY a.`id` $order $limit");
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                // $edit = '<a href="#" onclick="update_data(\'' . $r['id'] . '\')" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7 position-left text-slate-800"></i></a>';
                $type = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-danger waves-effect" >Permanent</button></div>';
                if ($r['jenis_terminate'] == 1) {
                    $type = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-warning waves-effect" >Sementara</button></div>';
                }

                if($r['status'] == 1){
                    $status = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-primary waves-effect" >On Progress</button></div>';
                }else if($r['status'] == 2){
                    $status = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-success waves-effect" >Approve</button></div>';
                }else{
                    $status = '<div class="btn-group btn-group-xs" role="group"><button type="button" class="btn btn-danger waves-effect" >Cancel</button></div>';
                }

                $row  = array(
                    $no . '.',
                    $r['idcust'] . ' - ' . $r['nama_cust'],
                    $r['nama_site'],
                    $r['nomor_so'],
                    $this->Kamus_model->tanggal_indo($r['tgl_terminate']),
                    $this->Kamus_model->tanggal_indo($r['tgl_dismantle']),
                    $type,
                    $r['alasan_terminate'],
                    $status
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

    function get_cust_site()
	{
		$data=null;
		$q=$this->db->query("SELECT b.`id`,c.`nama` AS nama_cust,b.`nama` AS nama_site FROM erp_gmedia.`order_header` a 
			LEFT JOIN erp_gmedia.`ms_site` b ON a.`id_site`= b.`id` 
			LEFT JOIN erp_gmedia.`ms_customers` c ON a.`id_cust`=c.`id` WHERE a.`status`=3 AND a.`periode_tagih`!='0' AND c.`status`!=9 AND (
						c.`nama` LIKE '%".$this->input->post('searchTerm')."%' ESCAPE '!' OR b.`nama` LIKE '%".$this->input->post('searchTerm')."%' ESCAPE '!' )
						ORDER BY c.`nama` ASC LIMIT 25");
		$data2 = $q->result();
		$data = array();
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->id, "text" => $row->nama_cust.' => '.$row->nama_site);
		}
		return json_encode($data);
    }
    function get_so($id)
	{
		$data=null;
		$q=$this->db->query("SELECT a.`nomor_order` FROM gmedia_erp_project.`so_order_header` a LEFT JOIN gmedia_erp_project.`order_header` b ON a.`nomor_order_header`=b.`nomor_order` WHERE b.`id_site` =$id AND (
						a.`nomor_order` LIKE '%".$this->input->post('searchTerm')."%' ESCAPE '!')
						ORDER BY a.`nomor_order` ASC LIMIT 25");
		$data2 = $q->result();
		$data = array();
		foreach ($data2 as $row) {
			$data[] = array("id" => $row->nomor_order, "text" => $row->nomor_order);
		}
		return json_encode($data);
	}
}
