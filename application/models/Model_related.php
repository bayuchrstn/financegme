<?php

//semua function disini resultnya boolean TRUE dan FALSE
//jika FALSE berarti data boleh dihapus
//jika TRUE berarti data tidak boleh dihapus karena berelasi dengan table lainya

class Model_related extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function master($code, $category)
	{
        switch($category):
            case 'priority':
                $check = $this->db->get_where('tickets', array('priority'=>$code))->result_array();
            break;

			case 'link_type':
                $check = $this->db->get_where('customer', array('link_type'=>$code))->result_array();
            break;

            //departement
            default:
                $check = array('ada');
        endswitch;

        if( !empty($check) ):
            return TRUE;
        else:
		    return FALSE;
        endif;
	}

    function user($user_id)
	{
        $this->db->where('author', $user_id);
		$check = $this->db->get('tickets')->result_array();
        if( !empty($check) ):
            return TRUE;
        else:
		    return FALSE;
        endif;
	}

    function usergroup($group_code)
    {
        $rs = FALSE;
        $users_groups = $this->db->query("SELECT * FROM {PRE}users WHERE level = '".$group_code."' ")->result_array();
        if(!empty($users_groups)):
            $rs = TRUE;
        endif;
        return $rs;
    }

    function brand($id)
    {
        $bool = FALSE;
        $this->db->where('up',$id);
        $query = $this->db->get('item_categories');
        $result = $query->num_rows();
        if ($result>0) {
            $bool = TRUE;
        }
        return $bool;
    }

    function bts($id)
    {
        return FALSE;
    }

    function customer($id)
    {
        return FALSE;
    }

    function category($id)
    {
        $bool = FALSE;
        $this->db->where('category_id',$id);
        $query = $this->db->get('item');
        $result = $query->num_rows();
        if ($result>0) {
            $bool = TRUE;
        }
        return $bool;
    }

    function item($id)
    {
        $bool = FALSE;
        $this->db->where('item_id',$id);
        $query = $this->db->get('item_detail');
        $result = $query->num_rows();
        if ($result>0) {
            $bool = TRUE;
        }
        return $bool;
    }
    function item_detail($id)
    {
        return FALSE;
    }

    function supplier($id)
    {
        return FALSE;
    }

    function product($code)
    {
        // $this->db->where('product_code', $code);
		// $check = $this->db->get('customer_product')->result_array();
        // if(!empty($check)):
        //     return TRUE;
        // else:
		//     return FALSE;
        // endif;
        return FALSE;
    }
}
