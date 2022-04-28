<?php
class Model_user_assign extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function save($task_id, $assigned_id=array())
	{
		$arr_key = array();
		foreach($assigned_id as $form=>$value):
			$arr_key[] = $value;
		endforeach;
		$key_comma = arr_to_comma($arr_key);
		// pre($key_comma);
        return $key_comma;


		// if(empty($assigned_user)):
		// 	$sql_delete = "DELETE FROM {PRE}task_user_assigned WHERE task_id='".$task_id."' ";
        //     $this->db->query($sql_delete);
		// else:
        //
		// endif;
	}

    function save_pld($task_id, $assigned_user=array())
	{
		$arr_key = array();
		foreach($assigned_user as $form=>$value):
			$arr_key[] = $value;
		endforeach;
		$key_comma = arr_to_comma($arr_key);
		// pre($key_comma);


		if(empty($assigned_user)):
			$sql_delete = "DELETE FROM {PRE}task_user_assigned WHERE task_id='".$task_id."' ";
            $this->db->query($sql_delete);
		else:
			$sql_delete = "DELETE FROM {PRE}task_user_assigned WHERE task_id='".$task_id."' AND id NOT IN (".$key_comma.")";
			// pre($sql_delete);
			$this->db->query($sql_delete);


			foreach($assigned_user as $key=>$val):
                // pre($val);

                //cek di target ada apa tidak?
                $sql_cek = "SELECT * FROM {PRE}task_user_assigned WHERE task_id='".$task_id."' AND user_id='".$val."' ";
                $cek = $this->db->query($sql_cek)->result_array();
                // pre($this->db->last_query());

                //jika tidak ada maka di insert
                if(empty($cek)):
					$data = array(
						'task_id'		=> $task_id,
						'user_id'		=> $val,
					);
					// pre($data);
              		$this->db->insert('task_user_assigned', $data);


                endif;

            endforeach;

		endif;
	}

	function get($task_id)
	{
		$arr = array();
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_user_assigned')->result_array();
		if(!empty($data)):
			foreach($data as $row):
				$arr[] = $row['user_id'];
			endforeach;
		endif;
		return $arr;
	}

    function get_assigned($selected_structure='')
    {
        $arr = array();
        switch ($selected_structure) {
            case 'divisi':
            case 'department':
            case 'sub_department':
            case 'jabatan':
                $this->db->where('category', $selected_structure);
                $data = $this->db->get('usergroup')->result_array();
                if(!empty($data)):
                    foreach($data as $row):
                        $arr[$row['id']] = $row['name'];
                    endforeach;
                endif;
            break;

            //custom
            default:
                $data = $this->db->get('users')->result_array();
                if(!empty($data)):
                    foreach($data as $row):
                        $arr[$row['id']] = $row['name'];
                    endforeach;
                endif;
            break;
        }
        return $arr;
    }

}
