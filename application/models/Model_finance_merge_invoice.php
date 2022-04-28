<?php
class Model_finance_merge_invoice extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_table()
    {
        $column_order = array(null, 'b.nama', null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'b.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';
        $order = $limit = null;

        if ($_POST['length'] != -1) $limit = ' LIMIT ' . $_POST['start'] . ',' . $_POST['length'];
        // $this->db->order_by($order_name, $order_dir);
        if (!empty($order_name) && !empty($order_dir)) {
            $order = " ORDER BY $order_name $order_dir";
        } else {
            $order = " ORDER BY b.nama ASC";
        }
        $q = $this->db->query("SELECT SQL_CALC_FOUND_ROWS 
        a.`id`,a.`id_cust` AS id_cust, b.`nama` AS nama_cust, c.`nama` AS nama_site, c.`id` AS id_site,a.`group_cust`
		FROM erp_gmedia.`setting_merge` a 
        JOIN erp_gmedia.`ms_customers` b ON a.`id_cust` = b.`id`
		JOIN erp_gmedia.`ms_site` c ON a.`id_site` = c.`id` 
        WHERE (`b`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
            OR `c`.`nama` LIKE '%" . $this->input->post('search_keyword') . "%' ESCAPE '!'
          ) GROUP BY nama_cust,a.`group_cust` $order $limit");

        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $x = null;
                $site = null;
                $no++;
                $edit = '<a href="#" onClick="edit_data(\'' . $r['id'] . '\')"><i class="icon-pencil position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\'' . $r['id'] . '\')"><i class="icon-bin position-left text-grey"></i></a>';
                $sitesite = $this->get_namasite($r['id_cust'], $r['group_cust']);
                foreach ($sitesite as $set) {
                    $site .= $x . $set->nama_site . ' - ' . $set->alamat3;
                    $x = "</br>";
                }
                $row  = array(
                    $no . '.',
                    $r['nama_cust'],
                    $site,
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

    function delete_setmerge($id, $group)
    {
        $db1 = $this->load->database('erp_gmedia', TRUE);
        $db1->where('group_cust', $group);
        $db1->where('id_cust', $id);
        $db1->delete('setting_merge');
        $afftectedRows = $db1->affected_rows();
        return $afftectedRows;
    }

    function get_id_group($id)
    {
        $a = $this->db->query("SELECT * FROM erp_gmedia.setting_merge WHERE id=$id")->result();
        foreach ($a as $row) {
            $group = $row->group_cust;
            $cust = $row->id_cust;
        }
        return $this->db->query("SELECT * FROM erp_gmedia.setting_merge WHERE id_cust=$cust AND group_cust=$group")->result();
    }

    function get_namasite($id, $group)
    {
        return $this->db->query("SELECT c.`nama` AS nama_site, c.`id` AS id_site, c.`alamat3`
		FROM erp_gmedia.`setting_merge` a
		JOIN erp_gmedia.`ms_site` c ON a.`id_site` = c.`id` WHERE a.`id_cust` = $id AND a.`group_cust` = $group")->result();
    }

    function get_namacust($id, $group)
    {
        return $this->db->query("SELECT b.`nama` AS nama_cust, b.`id` AS id_cust,a.`group_cust`
		FROM erp_gmedia.`setting_merge` a LEFT JOIN erp_gmedia.`ms_customers` b ON a.`id_cust` = b.`id`
		LEFT JOIN erp_gmedia.`ms_site` c ON a.`id_site` = c.`id` WHERE a.`id_cust` = $id AND a.`group_cust` = $group GROUP BY a.`group_cust`")->result();
    }

    function check_idcust($id, $group)
    {
        return $this->db->query("SELECT id_cust,group_cust FROM erp_gmedia.`setting_merge` WHERE id_cust = $id AND group_cust = $group")->result();
    }

    function check_idcust2($id)
    {
        return $this->db->query("SELECT id_cust,group_cust FROM erp_gmedia.`setting_merge` WHERE id_cust = $id")->result();
    }

    function insert($table, $data, $lastid = '')
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

    function check_site($id)
    {
        $q = $this->db->query("SELECT id_site FROM erp_gmedia.setting_merge WHERE id_site = $id");
        return $q;
    }

    function get_namasetmerge($id)
    {
        $query = $this->db->query("SELECT insert_by FROM erp_gmedia.setting_merge WHERE id_cust=$id");
        $ret = $query->row();
        if (!empty($ret)) {
            return $ret->insert_by;
        } else {
            return false;
        }
    }

    function get_tglsetmerge($id)
    {
        $query = $this->db->query("SELECT insert_at FROM erp_gmedia.setting_merge WHERE id_cust = $id");
        $ret = $query->row();
        if (!empty($ret)) {
            return $ret->insert_at;
        } else {
            return false;
        }
    }

    function get_ms_site($id)
    {
        return $this->db->query("SELECT a.`id`,a.`nama`,a.`alamat3` FROM erp_gmedia.ms_site a WHERE a.`id` NOT IN(	
SELECT a.`id` FROM erp_gmedia.ms_site a JOIN erp_gmedia.setting_merge b ON a.`id`=b.`id_site`  )AND a.`status` !=9 AND a.`id_cust`=$id")->result();
    }

    function get_ms_site2($id)
    {
        $query = $this->db->query("SELECT id,nama,alamat3 FROM erp_gmedia.ms_site WHERE id_cust = $id AND status !=9");

        return $query;
    }

    function get_cust()
    {
        return $this->db->query("SELECT
		a.`id`,
		a.`nama`,
		COUNT(b.`id`) AS jumlah
	  FROM
		erp_gmedia.`ms_customers` a
		JOIN erp_gmedia.`ms_site` b
		  ON a.`id` = b.`id_cust` AND b.`status` != 9
		  GROUP BY a.`id` HAVING COUNT(b.`id`) >= 2")->result();
    }
    function get_cust1($id)
    {
        return $this->db->query("SELECT
		a.`id`,
		a.`nama`,
		COUNT(b.`id`) AS jumlah
	  FROM
		erp_gmedia.`ms_customers` a
		JOIN erp_gmedia.`ms_site` b
		  ON a.`id` = b.`id_cust` AND b.`status` != 9
		  WHERE a.`nama` LIKE '%" . $id . "%' GROUP BY a.`id`  HAVING COUNT(a.`id`) >= 2 LIMIT 5 ")->result();
    }
}
