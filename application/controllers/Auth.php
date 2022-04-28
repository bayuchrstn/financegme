<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_auth', 'auth');
    }

    public function index()
    {
        $this->lang->load('all', 'english');
        if ($this->form_validation->run('login') == false) {
            $dt = array();

            // if (!$this->session->userdata('c1')) {
            //     $c1 = array('c1' => mt_rand(1, 50));
            //     $this->session->set_userdata($c1);
            // }
            // if (!$this->session->userdata('c2')) {
            //     $c2 = array('c2' => mt_rand(0, 9));
            //     $this->session->set_userdata($c2);
            // }

            $this->load->view('flat/login', $dt);
        } else {
            // $this->recaptcha->validation($this->input->post('g-recaptcha-response'));
            // $this->recaptcha->validation_capcay($this->input->post('capcay'));

            $username = $this->input->post('username');
            $password  = do_hash($this->input->post('password'), 'md5');
            // $password = $this->input->post('password');
            // $salt = sha1(md5($password).SALT);
            // $password = md5($password.$salt);


            // $this->db->where('username', $username);
            // $this->db->where('password', $password);
            // $this->db->where('status', '1');
            // $query = $this->db->get('users');
            // $query = $this->db->get('ms_user');
            $data = $this->db->query("SELECT * FROM absensi.`ms_user` WHERE username='" . $username . "' AND password='" . $password . "' AND status='1'")->row_array();

            if (isset($data) && !empty($data)) {
                $dt = array(
                    'username'          => $data['username'],
                    'nama'              => $data['keterangan'],
                    'userid'            => $data['id'],
                    'level'             => 'su',
                    'divisi'            => '',
                    'department'        => 'manager_finance',
                    'sub_department'    => '',
                    'jabatan'           => '',
                    'nip'               => $data['id_employee'],
                    // 'jabatan'           => $data['jabatan'],
                    // 'divisi'            => $data['divisi'],
                    // 'sub_department'    => $data['sub_department'],
                    // 'level'             => $data['level'],
                    // 'department'        => $data['department'],
                    // 'view_scope'        => $data['view_scope'],
                    // 'area'              => $data['area'],
                    // 'scope_area'        => $data['area'],
                    // 'regional'          => $data['regional'],
                    // 'scope_regional'    => $data['regional'],
                    'view_scope'        => 'global',
                    'regional'          => '02',
                    'scope_regional'    => '02',
                    'area'              => 'semarang',
                    'scope_area'        => 'semarang',
                    'logged_in'         => "ok"
                );
                // pre($dt); exit;
                $this->session->set_userdata($dt);
                // pre($_SESSION);
                // exit;
                $this->session->unset_userdata('c1');
                $this->session->unset_userdata('c2');
                redirect(base_url() . 'init');
                exit();
            } else {
                $err_msg = 'salah';
                flash('message', $err_msg, 'alert-danger');
                redirect(base_url() . 'login');
                exit();
            }
        }
    }

    function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }

    // request new password
    public function lost_password()
    {
        if (!$this->form_validation->run('lost_password')) :
            $data = array();
            $this->load->view('flat/lost_password', $data);
        else :
            $akn = $this->input->post('akn');
            $wh = "({PRE}users.email='" . $akn . "' OR {PRE}users.username='" . $akn . "')";
            $this->db->where($wh);
            $this->db->where('active', '1');
            $user = $this->db->get('users')->row_array();
            // pre($this->db->last_query());
            // exit;

            if (!empty($user)) :
                $qry_cek = $this->db->query("SELECT * FROM {PRE}account_recovery WHERE email='" . $user['email'] . "' AND account_mode='users' AND account_id='" . $user['id'] . "' AND expired_date > NOW() AND status='active' ");
                $data_cek = $qry_cek->row_array();
                // pre($data_cek); exit;
                if (empty($data_cek)) :
                    $salt = sha1(md5(time()) . SALT);
                    $key = md5(time() . $salt);
                    $expired = date('Y-m-d H:i:s', mktime(date('H') + 1, date('i'), 0, date('m'), date('d'), date('Y')));
                    $data = array(
                        'email'         => $user['email'],
                        'key'           => $key,
                        'account_mode'  => 'users',
                        'account_id'    => $user['id'],
                        'expired_date'  => $expired,
                        'status'        => 'active',
                    );
                    // pre($data);
                    $this->db->insert('account_recovery', $data);
                endif;
                $msg = $this->lang->line('auth_request_msg_success');
                flash('msg', $msg, 'alert-success');
            else :
                $msg = $this->lang->line('auth_request_msg_failed');
                flash('msg', $msg, 'alert-danger');
            endif;

            redirect(base_url() . 'lost_password');
        endif;
    }

    //set new password
    public function reset_account($key = '')
    {
        if (!$this->form_validation->run('account_recovery')) :
            // pre($key);

            $this->db->where('key', $key);
            $reco = $this->db->get('account_recovery')->row_array();
            if (empty($reco)) :
                show_404();
                exit;
            endif;

            if ($reco['status'] == 'non_active') :
                flash('msg', $this->lang->line('auth_reset_link_non_active_msg'));
                redirect(base_url() . 'lost_password');
                exit;
            endif;

            $split = explode(' ', $reco['expired_date']);

            $split_date = explode('-', $split[0]);
            $split_time = explode(':', $split[1]);

            // pre($split_date);
            // pre($split_time);

            $unix_time_now = mktime(date('H'), date('i'), 0, date('m'), date('d'), date('Y'));
            $unix_time_expired_date = mktime($split_time[0], $split_time[1], 0, $split_date[1], $split_date[2], $split_date[0]);
            // pre($unix_time_now);
            // pre($unix_time_expired_date);

            if ($unix_time_now > $unix_time_expired_date) :
                flash('msg', $this->lang->line('auth_reset_link_expired_msg'));
                redirect(base_url() . 'lost_password');
                exit;
            endif;

            $this->db->where('id', $reco['account_id']);
            $user_info = $this->db->get('users')->row_array();

            $data['reco'] = $reco;
            $data['user_info'] = $user_info;
            $this->load->view('flat/reset_account', $data);
        else :
            // cekpost();
            $new_password = pass_generator($this->input->post('password'));
            // pre($new_password);
            $data = array(
                'password'  => $new_password
            );
            // pre($data);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('users', $data);

            $this->db->query("UPDATE {PRE}account_recovery SET status='non_active' WHERE `key`='" . $this->input->post('recovery_key') . "' ");

            flash('msg', $this->lang->line('auth_new_password_success'));
            redirect(base_url() . 'login');
        endif;
    }

    // registration
    public function register()
    {
        if (!$this->form_validation->run('register')) :
            $data = array();
            $this->load->view('flat/register', $data);
        else :
            // cekpost();

            $valid_username = $this->auth->valid_username($this->input->post('username'));
            if (!$valid_username) :
                $err_msg = $this->lang->line('auth_register_username_not_valid');
                flash('msg', $err_msg);
                redirect(base_url() . 'register');
                exit;
            endif;

            $valid_email = $this->auth->valid_email($this->input->post('email'));
            if (!$valid_email) :
                $err_msg = $this->lang->line('auth_register_email_not_valid');
                flash('msg', $err_msg);
                redirect(base_url() . 'register');
                exit;
            endif;

            $salt = sha1(md5(time()) . SALT);
            $key = md5(time() . $salt);
            $data = array(
                'email'                 => htmlspecialchars($this->input->post('email')),
                'username'              => htmlspecialchars($this->input->post('username')),
                'password'              => pass_generator($this->input->post('password')),
                'active'                => '3',
                'registration_date'     => now(),
                'registration_key'      => $key,
            );

            // pre($data);
            $this->db->insert('users', $data);

            $err_msg = $this->lang->line('auth_register_success');
            flash('msg', $err_msg);
            redirect(base_url() . 'register');
        endif;
    }

    //set new account activation
    public function new_account_activation($key = '')
    {
        if (!$this->form_validation->run('account_recovery')) :
            // pre($key);

            $this->db->where('registration_key', $key);
            $this->db->where('active', '3');
            $user = $this->db->get('users')->row_array();
            if (empty($user)) :
                show_404();
                exit;
            else :
                $sql = "UPDATE {PRE}users set active='1' WHERE id='" . $user['id'] . "'";
                $this->db->query($sql);
            // pre($sql);
            // pre($user);
            // exit;

            // flash('msg', $this->lang->line('auth_new_account_activation_success'));
            // redirect(base_url().'login');
            endif;
        endif;
    }

    function register_valid_email()
    {
        $this->db->where('email', $this->input->post('email'));
        $cek = $this->db->get('users')->result_array();
        if (empty($cek)) :
            echo 'true';
        else :
            echo 'false';
        endif;
    }

    function register_valid_username()
    {
        $this->db->where('username', $this->input->post('username'));
        $cek = $this->db->get('users')->result_array();
        if (empty($cek)) :
            echo 'true';
        else :
            echo 'false';
        endif;
    }

    function show_my_sess()
    {
        basic_auth_login();
        $data = array(
            'request'   => $_REQUEST,
            // 'server' => $_SERVER,
            // 'cookies'    => $_COOKIE,
            'session'   => $_SESSION,
        );
        echo json_encode($data);
    }

    function auth_login_app()
    {
        $hasil = array();
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            //$password = md5($_POST["password"]);
            //$salt = sha1($password.SALT);
            //$password = md5($password.$salt);
            $password = pass_generator($_POST["password"]);

            $this->db->select("a.*", false);
            $this->db->from('users AS a');
            $this->db->where('a.username', $username);
            $this->db->where('a.password', $password);
            //$this->db->join('product_category f', 'e.category = f.code', 'left');
            $this->db->limit(1);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $hasil["status"] = 1;
                foreach ($q->result_array() as $r) {
                    $entry  = array(
                        'id' => $r['id'],
                        'name' => $r['name'],
                        'position' => $r['position'],
                    );
                    $hasil['rows'] = $entry;
                }
            } else {
                $hasil["status"] = 0;
            }
        } else {
            $hasil["status"] = 2;
        }

        echo json_encode($hasil);
    }

    function auth_login_app_tes()
    {
        $hasil = array();
        $username = 'sales1';
        //$password = md5($_POST["password"]);
        //$salt = sha1($password.SALT);
        //$password = md5($password.$salt);
        $password = pass_generator('123');

        $this->db->select("a.*", false);
        $this->db->from('users AS a');
        $this->db->where('a.username', $username);
        $this->db->where('a.password', $password);
        //$this->db->join('product_category f', 'e.category = f.code', 'left');
        $this->db->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $hasil["status"] = 1;
            foreach ($q->result_array() as $r) {
                $entry  = array(
                    'name' => $r['name'],
                    'position' => $r['position'],
                );
                $hasil['rows'] = $entry;
            }
        } else {
            $hasil["status"] = 0;
        }

        echo json_encode($hasil);
    }

    function getSalt()
    {
        $password = $this->input->post('password');
        $salt = sha1(md5($password) . SALT);
        $password = md5($password . $salt);
        $arr = array(
            'salt' => $password,
        );
        echo json_encode($arr);
    }

    function login_app()
    {
        $arr = array();
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $salt = sha1(md5($password) . SALT);
        $password = md5($password . $salt);

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('status', 'active');
        $query = $this->db->get('users');
        $data = $query->row_array();

        if (isset($data) && !empty($data)) {
            $dt = array();
            $token = jwt_helper::create($data['id'], $dt);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => base_url() . "init/set_modul_access/json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer " . $token
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $modul_access = json_decode($response, true);
            $dt['modul_access'] = $modul_access['modul_access'];
            $token = jwt_helper::update($token, $dt);

            $arr = array(
                'status'    => 200,
                'message'   => 'login success',
                'token'     => $token
            );
        } else {
            $arr = array(
                'status'    => 401,
                'message'   => 'invalid login'
            );
        }
        echo json_encode($arr);
        exit();
    }

    function refresh_token()
    {
        $token = getBearerToken();
        $token = jwt_helper::refresh($token);
        echo json_encode(array('token' => $token));
    }

    function check_remove_session()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => base_url() . "ajax/check_session",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . getBearerToken()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            if (!empty($data['token'])) {
                // echo $data['token'];
                //new curl remove token
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => base_url() . "ajax/cron_remove_session",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer " . $data['token']
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                // echo $response;
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo 'Berhasil';
                }
            } else {
                //new curl remove token
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => base_url() . "ajax/cron_remove_session",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer " . getBearerToken()
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                // echo $response;
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
            }
        }
    }

    function minify()
    {
        $data = array();
        $html = minify_js($this->load->view('bts/js', $data, true));
        $html .= minify_js($this->load->view('bts/js_table', $data, true));
        $html .= minify_js($this->load->view('bts/valid', $data, true));
        echo $html;
    }
}
