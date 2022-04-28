<?php
class insider
{
    function __construct($options = null) {
        $this->CI =& get_instance();
        // echo $options['mode'];

        $this->playmaker($options);
    }

    function playmaker($mode)
    {
        $this->CI =& get_instance();
        $tiket = $this->CI->db->get_where('users', array('id'=>$mode['ticket']))->row_array();
        if(isset($tiket) && !empty($tiket))
        {
            $dt = array(
                    'username'  	=> $tiket['username'],
                    'nama'  		=> $tiket['name'],
                    'userid'  		=> $tiket['id'],
                    'level'  		=> $tiket['level'],
                    'departement'  	=> $tiket['departement'],
                    'view_scope'    => $tiket['view_scope'],
                    'regional'  	=> $tiket['regional'],
                    'logged_in'  	=> "ok"
                );
            $this->CI->session->set_userdata($dt);
            // $this->inv->save_log('login');
            redirect(base_url().'init');
            exit();
        }
    }

    function show_user()
    {
        echo 'pentol';
    }

}
