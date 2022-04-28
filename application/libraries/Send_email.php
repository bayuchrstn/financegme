<?php
class Send_email
{
    protected $ci;

    function __construct($options = null) {
        $this->ci =& get_instance();
        // $this->send_email($options);
    }

    function compose($options)
    {
        $arr = array();
        if(isset($options['to']) && $options['to'] !=''):

            $this->ci->load->library('email');
            $setting = get_all_setting();
            // pre($options);
            // pre($setting);

            $config['smtp_crypto'] = ( isset($options['smtp_crypto']) && $options['smtp_crypto'] !='') ? $options['smtp_crypto'] : $setting['smtp_crypto'];
    		$config['protocol'] = ( isset($options['protocol']) && $options['protocol'] !='') ? $options['protocol'] : $setting['smtp_protocol'];
            $config['smtp_host'] = ( isset($options['smtp_host']) && $options['smtp_host'] !='') ? $options['smtp_host'] : $setting['smtp_host'];
            $config['smtp_port'] = ( isset($options['smtp_port']) && $options['smtp_port'] !='') ? $options['smtp_port'] : $setting['smtp_port'];
            $config['smtp_user'] = ( isset($options['smtp_user']) && $options['smtp_user'] !='') ? $options['smtp_user'] : $setting['smtp_user'];
            $config['smtp_pass'] = ( isset($options['smtp_pass']) && $options['smtp_pass'] !='') ? $options['smtp_pass'] : $setting['smtp_pass'];
            $config['mailpath'] = ( isset($options['mailpath']) && $options['mailpath'] !='') ? $options['mailpath'] : $setting['smtp_mailpath'];
            $config['charset'] = ( isset($options['charset']) && $options['charset'] !='') ? $options['charset'] : $setting['smtp_charset'];
            $config['useragent'] = ( isset($options['useragent']) && $options['useragent'] !='') ? $options['useragent'] : $setting['smtp_useragent'];
            $config['wordwrap'] = ( isset($options['wordwrap']) && $options['wordwrap'] !='') ? $options['wordwrap'] : $setting['smtp_wordwrap'];
            $config['mailtype'] = ( isset($options['mailtype']) && $options['mailtype'] !='') ? $options['mailtype'] : 'html';
            // pre($config);

            $from_mail = (isset($options['from_mail'])) ? $options['from_mail'] : $setting['smtp_from_email'];
            $from_name = (isset($options['from_name'])) ? $options['from_mail'] : $setting['smtp_from_name'];
            $reply_to = (isset($options['reply_to'])) ? $options['reply_to'] : $setting['smtp_reply_to'];
            $cc = isset($options['cc']) ? $options['cc'] : '';

            $this->ci->email->clear(TRUE);
            if (isset($options['attachment'])) {
                if (is_array($options['attachment'])) {
                    foreach ($options['attachment'] as $row) {
                         $this->ci->email->attach($row['path']);
                    }
                } else {
                    $this->ci->email->attach($options['attachment']);
                }
            }

    		$this->ci->email->initialize($config);
            $this->ci->email->set_newline("\r\n");
    		$this->ci->email->from($from_mail, $from_name);
            if ($cc!='') {$this->ci->email->cc($cc);}
            $this->ci->email->reply_to($reply_to);
    		$this->ci->email->to($options['to']);
    		$this->ci->email->subject($options['subject']);
    		$this->ci->email->message($options['body']);

            $send_ok = $this->ci->email->send();

            if($send_ok):
                $arr['status'] = 'success';
                $arr['msg'] = 'success';
                $arr['config'] = $config;
                $arr['options'] = $options;
            else:
                $arr['status'] = 'failed';
                $arr['msg'] = $this->ci->email->print_debugger();
            endif;
        else:
            $arr['status'] = 'failed';
            $arr['msg'] = 'Error, Email Reseiver empty';
        endif;
        return $arr;
    }


}
