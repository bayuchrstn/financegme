<?php
class Model_init extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function arr_privileges()
    {
        $arr = array();
        $this->db->group_by('modul');
        $in = "user_group_id in ('" . $this->all_session['sub_department'] . "', '" . $this->all_session['department'] . "', '" . $this->all_session['divisi'] . "', '" . $this->all_session['jabatan'] . "')";
        // $this->db->where('user_group_id', $this->all_session['level']);
        $this->db->where($in);
        $privileges = $this->db->get('privileges')->result_array();
        // pre($this->db->last_query()); exit;
        if (!empty($privileges)) :
            foreach ($privileges as $row) :
                $arr[] = $row['modul'];
            endforeach;
        endif;
        // pre($arr); exit;
        // $this->session->set_userdata('arr_privileges', $arr);
        return $arr;
    }

    function buildTree($elements, $parentId = '0')
    {
        $branch = array();
        foreach ($elements as $element) {
            // pre($parentId);
            if ($element['up'] == $parentId) {
                $url = ($element['url'] != '' && $element['url'] != '#') ? base_url() . $element['url'] : '#';
                $icon = ($element['icon'] != '') ? $element['icon'] : 'fa fa-smile-o';

                $children = $this->buildTree($elements, $element['code']);
                if ($children) {
                    $element['child'] = $children;
                } else {
                    $element['child'] = array();
                }
                $branch[] = array(
                    'id'    => $element['id'],
                    'label'    => $element['name'],
                    'code'    => $element['code'],
                    'url'    => $url,
                    'icon'    => $icon,
                    'child'    => $element['child']
                );
            }
        }

        return $branch;
    }
}
