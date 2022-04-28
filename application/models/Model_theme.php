<?php
class Model_theme extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function get_root_menu($root='root')
    {
        $menu = array();

        $query_root = $this->db->query("SELECT * FROM {PRE}modul WHERE up='".$root."' AND flag_menu='yes' ORDER BY menu_order asc");
        $data_root = $query_root->result_array();
        // pre($data_root);
        foreach($data_root as $root):
            $root_url = ($root['url'] !='' && $root['url'] !='#') ? base_url().$root['url'] : '#';
            $root_icon = ($root['icon'] !='') ? $root['icon'] : 'fa fa-smile-o';

            $query_child = $this->db->query("SELECT * FROM {PRE}modul WHERE up='".$root['code']."' AND flag_menu='yes' ORDER BY menu_order asc ");
            $data_child = $query_child->result_array();
            // pre($this->db->last_query());
            // pre($data_child);

            if(allow_modul($root['code'])):
                // pre("SELECT * FROM {PRE}modul WHERE up='".$root['code']."' AND flag_menu='yes' ORDER BY menu_order asc ");
                if(empty($data_child)):
                    $menu[] =  array(
                        'label' =>  $root['name'],
                        'code'  =>  $root['code'],
                        'url'   =>  $root_url,
                        'child' =>  '',
                        'icon'  =>  $root_icon
                    );
                else:
                    $menu[] =  array(
                            'label' =>  $root['name'],
                            'code' =>  $root['code'],
                            'url'   =>  $root_url,
                            'child' =>  $this->get_root_menu($root['code']),
                            'icon'  =>  $root_icon
                        );
                endif;
            endif;

        endforeach;

        // pre($menu);
        return $menu;
    }

    function get_submenu($parent='')
    {
    	// $this->db->order_by('menu_order', 'ASC');
    	// $this->db->where('up', $parent);
    	// $this->db->where('menu', '1');
	    // $query = $this->db->get('modul');
	    // $modul =  $query->result_array();
	    return array();
    }

    function get_menu_struktur()
    {
        $this->db->where('code', my_level());
        $query = $this->db->get('usergroup');
        $modul =  $query->row_array();
        //pre($this->db->last_query());
        return $modul['menu'];
    }

    function icon($modul_code)
    {
        $this->db->where('code', $modul_code);
        $modul = $this->db->get('modul')->row_array();
        // pre($this->db->last_query());
        return $modul['icon'];
    }

}
