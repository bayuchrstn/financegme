<!DOCTYPE html>
<html>

<head>
    <title><?php echo $this->lang->line('auth_browser_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js?hl=id'></script>
    <script type="text/javascript">
        function login(token) {
            document.getElementById("login-form").submit();
        }
    </script>
</head>

<body class="login-container">
    <div class="page-container pb-20">
        <div class="page-content">
            <div class="content-wrapper">
                <form id="login-form" method="post" action="<?php echo base_url(); ?>login" class="form-validate">
                    <div style="width:345px; " class="panel panel-body login-form">
                        <div class="text-center">
                            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" width="80%" />
                            <h5 class="content-group-lg">
                                <?php //echo $this->lang->line('all_login_title'); 
                                ?>
                                <!-- <small class="display-block"><?php echo $this->lang->line('auth_login_title'); ?> <a href="<?php echo base_url(); ?>register"><?php echo $this->lang->line('auth_login_title_register_link'); ?></a></small> -->
                            </h5>
                        </div>

                        <div id="response_login">
                            <?php echo show_flash(); ?>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="<?php echo $this->lang->line('auth_login_username'); ?>" onfocus="this.placeholder=''" onblur="this.placeholder='Username'">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control cos" name="password" placeholder="<?php echo $this->lang->line('auth_login_password'); ?>" onfocus="this.placeholder=''" onblur="this.placeholder='Password'">
                        </div>

                        <?php
                        require_once(BASEPATH . 'database/DB.php');
                        $dbs = &DB();

                        $dbs->where('setting', 'recaptcha_site_key');
                        // $dbs->where('up', '1001');
                        $request = $dbs->get('setting')->row_array();
                        // print_r($request['value']);
                        ?>

                        <!-- <div style="text-align:center; margin-bottom:10px;">
                            <div class="g-recaptcha" data-sitekey="<?php echo $request['value']; ?>"></div>
						</div> -->

                        <!-- hidden capcha -->
                        <!-- <div class="form-group">
							<button type="submit" class="btn bg-blue btn-block g-recaptcha" data-sitekey="<?php echo $request['value']; ?>" data-callback="login"><?php echo $this->lang->line('auth_login_button'); ?> <i class="icon-arrow-right14 position-right"></i></button>
						</div> -->
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-4" style="margin-top: 8px;"><?php echo $this->session->userdata('c1'); ?> + <?php echo $this->session->userdata('c2'); ?> = </label>
                            <div class="col-sm-8 input-group">
                                <input type="text" name="capcay" class="form-control">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn bg-blue btn-block"><?php echo $this->lang->line('auth_login_button'); ?> <i class="icon-arrow-right14 position-right"></i></button>
                        </div>


                        <!-- <div class="text-center">
                            <a href="<?php echo base_url(); ?>lost_password"><?php echo $this->lang->line('auth_login_lost_password_link'); ?></a>
                        </div> -->


                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#login-form").validate({
                ignore: [],
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "<?php echo $this->lang->line('auth_login_username_required'); ?>"
                    },
                    password: {
                        required: "<?php echo $this->lang->line('auth_login_password_required'); ?>"
                    }
                }
            });
        });
    </script>

</body>

</html>