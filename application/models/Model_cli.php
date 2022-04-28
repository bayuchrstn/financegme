<?php
class Model_cli extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function otb()
    {
        cekpost();
    }

    function otm($table, $param, $data)
    {
        //pertama data post dibikin arraynya dulu by key

        //jika data post kosong target dihapus semua
        if(empty($data)):
            $sql_delete = "DELETE FROM {PRE}privileges WHERE user_group_id='".$usergroup."' ";
            $this->db->query($sql_delete);
        else:
            //hapus data yang ada di target tapi nggak ada di datapost
            $sql_delete = "DELETE FROM {PRE}privileges WHERE user_group_id='".$usergroup."' AND modul NOT IN ('".join("','", $modul)."')";
            $this->db->query($sql_delete);

            //looping data post
            foreach($data as $key=>$val):

                //cek di target ada apa tidak?
                $sql_cek = "SELECT * FROM {PRE}privileges WHERE user_group_id='".$usergroup."' AND modul='".$pcode."' ";
                $cek = $this->db->query($sql_cek)->result_array();

                //jika tidak ada maka di insert
                if(empty($cek)):
                    $sql_insert = "INSERT INTO {PRE}privileges (user_group_id, modul) VALUES ('".$usergroup."', '".$pcode."') ";
                    $this->db->query($sql_insert);

                //jika ada maka diupdate
                else:
                    $sql_insert = "INSERT INTO {PRE}privileges (user_group_id, modul) VALUES ('".$usergroup."', '".$pcode."') ";
                    $this->db->query($sql_insert);
                endif;

            endforeach;
        endif;
        $key_post = join(',', $arr_post);

    }
}
