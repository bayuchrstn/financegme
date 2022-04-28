<?php
class Model_dashboard extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function widget_lists()
	{
		$this->db->order_by('widget_config.sort', 'asc');
		$this->db->group_by('modul.code');
		if(!is_admin() && !is_admin_regional()):
            $in = "user_group_id in ('".$this->all_session['sub_department']."', '".$this->all_session['department']."', '".$this->all_session['divisi']."', '".$this->all_session['jabatan']."')";
            $this->db->where($in);
			// $this->db->where('privileges.user_group_id', my_level());
		endif;

		$this->db->where('modul.up ', 'dashboard');
		$this->db->where('widget_config.content_url !=', '');
		$this->db->select('modul.*');
		$this->db->select('widget_config.*');
		$this->db->select('privileges.modul');
		// $this->db->select('widget_config.sort');
		// $this->db->select('widget_config.auto_refresh');
		// $this->db->select('widget_config.padding');
		$this->db->join('privileges', 'modul.code = privileges.modul', 'left');
		$this->db->join('widget_config', 'widget_config.widget_code = modul.code', 'left');
		$data =  $this->db->get('modul')->result_array();
		// pre($this->db->last_query());
		return $data;
	}

	function widget_detail($widget_code)
	{
		$this->db->where('widget_config.widget_code', $widget_code);
		$this->db->select('modul.*');
		$this->db->select('widget_config.*');
		// $this->db->select('widget_config.sort');
		$this->db->join('modul', 'modul.code = widget_config.widget_code', 'left');
		return $this->db->get('widget_config')->row_array();
	}

}
