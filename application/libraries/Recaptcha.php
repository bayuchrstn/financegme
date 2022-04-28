<?php
class Recaptcha
{
    protected $ci;

    function __construct($options = null) {
        $this->ci =& get_instance();
        // $this->send_email($options);
    }

    function validation($response)
    {
        $this->ci->load->model('model_setting', 'setting');
        $all_setting = $this->ci->setting->all();

        $ip = $this->ci->input->ip_address();
        $secret_key = $all_setting['recaptcha_secret_key'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        // $full_url = $url.'?secret='.$secret_key.'&response='.$response.'&remoteip='.$ip;
        $full_url = $url.'?secret='.$secret_key.'&response='.$response;
        // pre($full_url);
        $data = json_decode(file_get_contents($full_url));
        // pre($ip);
        // pre($all_setting);
        // pre($data);
        // cekpost();
        if(isset($data->success) && $data->success == true):
            return True;
        else:
            $err_msg = $this->ci->lang->line('auth_val_msg_login_failed_robot');
            flash('message', $err_msg, 'alert-danger');
            redirect(base_url().'login');
            exit();
        endif;
    }

    function validation_capcay($value)
    {
        $n1 = $this->ci->session->userdata('c1');
        $n2 = $this->ci->session->userdata('c2');
        if ($value != ($n1+$n2) ) {
            $c = array(
                'c1' => mt_rand(1,50),
                'c2' => mt_rand(0,9),
            );
            $this->ci->session->set_userdata( $c );
            $err_msg = $this->ci->lang->line('auth_val_msg_login_failed_robot');
            flash('message', $err_msg, 'alert-danger');
            redirect(base_url().'login');
            exit();
        } else {
            return true;
        }
    }
}
