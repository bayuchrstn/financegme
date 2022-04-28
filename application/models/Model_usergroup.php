<?php
class Model_usergroup extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function jabatan_name($jabatan_code)
    {
        $jabatan_data = $this->get_one_by_code($jabatan_code);
        $parent = $this->get_one_by_code($jabatan_data['up']);
        switch ($jabatan_data['jabatan_struktur']) {
            case 'divisi':
                $parent_name = 'divisi';
            break;

            case 'department':
                $parent_name = 'department';
            break;

            case 'sub_department':
                $parent_name = 'sub department';
            break;

            default:
                $parent_name = ' ';
                break;
        }
        return $jabatan_data['name'].' '.$parent_name.' '.$parent['name'];
    }


    function all_usergroup($category='', $category_id='')
    {
        switch ($category) {
            case 'divisi':
                $this->db->where('category', 'divisi');
            break;

            case 'department':
                $this->db->where('category', 'department');
            break;

            case 'sub_department':
                $this->db->where('category', 'sub_department');
            break;

            case 'jabatan':
                $this->db->where('category', 'jabatan');
            break;

            default:
                $this->db->where('category', 'sub_department');
            break;
        }

        if($category_id !='' && $category_id !='all'):
            $this->db->where('up', $category_id);
        endif;

        $this->scope->where('usergroup');
        return $this->db->get('usergroup')->result_array();
    }

    function gbc($category='')
    {
        switch ($category) {
            case 'divisi':
                $this->db->where('category', 'divisi');
            break;

            case 'department':
                $this->db->where('category', 'department');
            break;

            case 'sub_department':
                $this->db->where('category', 'sub_department');
            break;

            default:
                $this->db->where('category', 'sub_department');
            break;
        }

        $this->scope->where('usergroup');
        return $this->db->get('usergroup')->result_array();
    }

    function get_dept_by_divisi($divisi='')
    {
        $this->db->where('up', $divisi);
        $this->db->where('category', 'department');
        $this->scope->where('usergroup');
        return $this->db->get('usergroup')->result_array();
    }

    function ui($category)
    {
        $arr = array();
        switch ($category) {
            case 'divisi':
                $arr['main_title'] = 'Divisi';
                $arr['button_input'] = 'Input Divisi';
                $arr['button_update'] = 'Update Divisi';
                $arr['th_group_name'] = 'Nama Divisi';
            break;

            case 'department':
                $arr['main_title'] = 'Departemen';
                $arr['button_input'] = 'Input Departemen';
                $arr['button_update'] = 'Update Departemen';
                $arr['th_group_name'] = 'Nama Departemen';
            break;

            case 'sub_department':
                $arr['main_title'] = 'Sub Departemen';
                $arr['button_input'] = 'Input Sub Departemen';
                $arr['button_update'] = 'Update Sub Departemen';
                $arr['th_group_name'] = 'Nama Sub Departemen';

            break;

            case 'jabatan':
                $arr['main_title'] = 'Jabatan';
                $arr['button_input'] = 'Input Jabatan';
                $arr['button_update'] = 'Update jabatan';
                $arr['th_group_name'] = 'Nama Jabatan';

            break;

            default:
                $arr['main_title'] = 'Sub Departemen';
                $arr['button_input'] = 'Input Sub Departemen';
                $arr['button_update'] = 'Update Sub Departemen';
                $arr['th_group_name'] = 'Nama Sub Departemen';
            break;
        }
        return $arr;
    }

    function detail($id)
    {
        $arr = array();
        $this->db->where('id', $id);
        $data = $this->db->get('usergroup')->row_array();
        if(!empty($data)):
            foreach($data as $row=>$val):
                $arr[$row] = $val;
            endforeach;
        endif;

        switch ($data['category']) {
            case 'department':
                $divisi_data = $this->get_one_by_code($data['up']);
                $arr['divisi_data'] = $divisi_data;
            break;

            case 'sub_department':
                $department_data = $this->get_one_by_code($data['up']);
                $divisi_data = $this->get_one_by_code($department_data['up']);
                $arr['department_data'] = $department_data;
                $arr['divisi_data'] = $divisi_data;
            break;

            case 'jabatan':
                switch ($data['jabatan_struktur']) {
                    case 'department':
                        $department_data = $this->get_one_by_code($data['up']);
                        $divisi_data = $this->get_one_by_code($department_data['up']);
                        $arr['department_data'] = $department_data;
                        $arr['divisi_data'] = $divisi_data;
                    break;

                    case 'sub_department':
                        $sub_department_data = $this->get_one_by_code($data['up']);
                        $department_data = $this->get_one_by_code($sub_department_data['up']);
                        $divisi_data = $this->get_one_by_code($department_data['up']);

                        $arr['sub_department_data'] = $sub_department_data;
                        $arr['department_data'] = $department_data;
                        $arr['divisi_data'] = $divisi_data;
                    break;

                    default:
                        # code...
                        break;
                }
            break;

            default:
                # code...
                break;
        }

        return $arr;
    }

    function arr_usergroup()
    {
        $dt = $this->all_usergroup();
        $arr = array();
        if(!empty($dt)):
            foreach($dt as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

	function arr_usergroup_reg()
    {
		$this->scope->where_regional('usergroup');
        $dt = $this->db->get('usergroup')->result_array();
        $arr = array();
        if(!empty($dt)):
            foreach($dt as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function arr_usergroup_by_scope()
    {
        $this->scope->filter('usergroup');
        $dt = $this->db->get('usergroup')->result_array();
        $arr = array();
        if(!empty($dt)):
            foreach($dt as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function current_privileges($usergroup)
    {
        $this->db->where('user_group_id', $usergroup);
        return $this->db->get('privileges')->result_array();
    }

    function privileges_comma($usergroup)
    {
        $arr = array();
        $current = $this->current_privileges($usergroup);
        if($current):
            foreach($current as $row):
                $arr[] = $row['modul'];
            endforeach;
        endif;
        return $arr;
    }

    function privileges_is_selected($ug, $modul)
	{
		$this->db->where('user_group_id', $ug);
		$this->db->where('modul', $modul);

		$query = $this->db->get('privileges');
		$ada = $query->num_rows();

		//pre($this->db->last_query());

		if($ada != '0'){
			return TRUE;
		} else {
			return FALSE;
		}
	}

    function get_modul($up='0')
    {
        $this->db->order_by('menu_order', 'asc');
        $this->db->where('up', $up);
        return $this->db->get('modul')->result_array();
    }

    function privileges_tree()
    {
        $arr = array();
        $root = $this->get_modul('0');
        if(!empty($root)):
            foreach($root as $root_modul):

                $arr_child = array();
                $child = $this->get_modul($root_modul['code']);
                if(!empty($child)):
                    foreach($child as $child_modul):
                        $arr_child[] = array(
                            'code'          => $child_modul['code'],
                            'label'         => $child_modul['name'],
                            'note'          => $child_modul['note']
                        );
                    endforeach;
                endif;

                // if( $root_modul['code'] != 'customer' ):
                    $arr[] = array(
                        'code'          => $root_modul['code'],
                        'label'         => $root_modul['name'],
                        'child'         => $arr_child
                    );
                // endif;
            endforeach;
        endif;
        return $arr;
    }

    function privileges_checkbox($up='0')
    {
        $query_modul = $this->db->query("SELECT * FROM {PRE}modul WHERE su_only !='1' ORDER BY menu_order asc ");
        $data_modul = $query_modul->result_array();
        $modul_checkbox = $this->buildTree($data_modul, '0');
        return $modul_checkbox;
        // return $menu;
    }

    function buildTree($elements, $parentId = '0') {
        // if (empty($elements)) return '';
        $output = '<ul id="ul_priv">';
        foreach ($elements as $element) {
            if ($element['up'] == $parentId) {
                $children = $this->buildTree($elements, $element['code']);

				if($children !='<ul id="ul_priv"></ul>' && $children !='<ul id="ul_priv" class="ui-widget ui-widget-content daredevel-tree"></ul>'):
                    $sub = $children;
					$class = 'collapsed';
                else:
                    $sub = '';
					$class = 'jstree-leaf';
                endif;

				$output .= '<li class="'.$class.'">';
                $output .= '<input id="chk_'.$element['code'].'" type="checkbox" name="privileges[]" value="'.$element['code'].'">';
                $output .= $element['name'];
                $output .= $sub;
                // $output .= '</label>';
                // $output .= '</div>';
                $output .= '</li>';
            }
        }
        $output .= '</ul>';
        return $output;
        // echo $output;
    }

    function insert($param=array())
    {
        if($this->input->post('up')):
            $data['up'] = $this->input->post('up');
        elseif(isset($param['up'])):
            $data['up'] = $param['up'];
        else:
            $data['up'] = '0';
        endif;

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        else:
            $data['name'] = '';
        endif;

        if($this->input->post('code')):
            $data['code'] = $this->input->post('code');
        elseif(isset($param['code'])):
            $data['code'] = $param['code'];
        else:
            $data['code'] = '';
        endif;

        if($this->input->post('regional')):
            $data['regional'] = $this->input->post('regional');
        elseif(isset($param['regional'])):
            $data['regional'] = $param['regional'];
        else:
            $data['regional'] = '';
        endif;

        if($this->input->post('area')):
            $data['area'] = $this->input->post('area');
        elseif(isset($param['area'])):
            $data['area'] = $param['area'];
        else:
            $data['area'] = '';
        endif;

        $insert = $this->db->insert('usergroup', $data);
        $arr['status'] = $insert;
        $arr['last_id'] = $this->db->insert_id();
        return $arr;
    }

    function update($param=array())
    {

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        endif;

        if($this->input->post('code')):
            $data['code'] = $this->input->post('code');
        elseif(isset($param['code'])):
            $data['code'] = $param['code'];
        endif;

        if($this->input->post('regional')):
            $data['regional'] = $this->input->post('regional');
        elseif(isset($param['regional'])):
            $data['regional'] = $param['regional'];
        endif;

        if($this->input->post('area')):
            $data['area'] = $this->input->post('area');
        elseif(isset($param['regional'])):
            $data['area'] = $param['area'];
        endif;

        if(!empty($data)):
            if($this->input->post('id')):
                $this->db->where('id', $this->input->post('id'));
            elseif(isset($param['id'])):
                $this->db->where('id', $param['id']);
            endif;
            $update = $this->db->update('usergroup', $data);
        endif;
    }

	function get_modul_view()
	{
		$this->db->where('modul_view', '1');
		$data = $this->db->get('modul')->result_array();
		return $data;
	}

	function get_modul_access($usergroup)
	{
		$arr = array();
		$this->db->where('user_group_id', $usergroup);
		$data = $this->db->get('modul_access')->result_array();
		if(!empty($data)):
			foreach($data as $row):
				$arr[$row['modul']] = $row['view'];
			endforeach;
		endif;
		return $arr;
	}

	function save_modul_access($modul_access, $usergroup)
	{
		// pre($modul_access);
		// pre($usergroup);

		$string_key = "";
        if(!empty($modul_access)):
			$urut = 0;
            foreach($modul_access as $key=>$val):
				$string_key .= "'".$key."', ";
                // $data[$product_id] = array(
	            //     	'product_value'   => $product_value[$product_id],
	            //       	'product_satuan'  => (isset($product_satuan[$product_id])) ? $product_satuan[$product_id] : '',
	            //       	'product_price'  => $product_price[$product_id],
	            //     );
				$urut++;
            endforeach;
        endif;
		$string_key = substr($string_key, 0, strlen($string_key)-2);
		// pre($string_key);

		if(empty($modul_access)):
			$sql_delete = "DELETE FROM {PRE}modul_access WHERE user_group_id='".$usergroup."' ";
			$this->db->query($sql_delete);
		else:
			$sql_delete = "DELETE FROM {PRE}modul_access WHERE user_group_id='".$usergroup."' AND modul NOT IN (".$string_key.")";
			// pre($sql_delete);
			$this->db->query($sql_delete);
			foreach($modul_access as $key=>$val):
				// pre($row);
				$sql_cek = "SELECT * FROM {PRE}modul_access WHERE user_group_id='".$usergroup."' and modul='".$key."'";
				// pre($sql_cek);
				$cek = $this->db->query($sql_cek)->result_array();
				if(empty($cek)):
					$sql_insert = "INSERT INTO {PRE}modul_access (user_group_id, modul, view) VALUES ('".$usergroup."', '".$key."', '".$val."') ";
					$this->db->query($sql_insert);
				else:
					$sql_update = "UPDATE {PRE}modul_access SET view='".$val."' WHERE user_group_id='".$usergroup."' and modul='".$key."' ";
					$this->db->query($sql_update);
				endif;
			endforeach;
		endif;
	}

    function get_one_by_code($code)
    {
        $this->db->where('code', $code);
        return $this->db->get('usergroup')->row_array();
    }

}
