<!DOCTYPE html>
<html>

<head>
    <title><?php echo $this->lang->line('auth_browser_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/password_indicator.css" rel="stylesheet" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="login-container">
	<div class="page-container pb-20">
		<div class="page-content">
			<div class="content-wrapper">
				<form id="register_form" method="post" action="<?php echo base_url(); ?>register" class="form-validate">
					<div style="width:345px; " class="panel panel-body login-form">
						<div class="text-center">
                            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" width="80%"/>
							<h5 class="content-group-lg">
                                <?php //echo $this->lang->line('all_login_title'); ?>
                                <small class="display-block"><?php echo $this->lang->line('auth_register_title'); ?></small>
                            </h5>
						</div>

                        <div id="response_login">
                            <?php echo show_flash('msg'); ?>
                        </div>

						<div class="form-group">
							<input type="text" class="form-control" name="name" value="" placeholder="<?php echo $this->lang->line('auth_register_name'); ?>">
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="email" value="" placeholder="<?php echo $this->lang->line('auth_register_email'); ?>">
						</div>

                        <div class="form-group">
							<input type="text" class="form-control" name="username" value="" placeholder="<?php echo $this->lang->line('auth_register_username'); ?>">
						</div>

                        <div class="form-group">
							<input id="newpassword" data-indicator="pwindicator" type="password" placeholder="<?php echo $this->lang->line('auth_register_password'); ?>" class="form-control" name="password" value="" >
                            <div id="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>

                        <div class="form-group">
							<button type="submit" class="btn bg-blue btn-block"><?php echo $this->lang->line('auth_register_button'); ?> <i class="icon-arrow-right14 position-right"></i></button>
						</div>


                        <div class="text-center">
                            <a href="<?php echo base_url(); ?>login"><?php echo $this->lang->line('auth_register_login_link'); ?></a>
                        </div>

					</div>
				</form>
			</div>
		</div>
	</div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.pwstrength.js"></script>
    <script type="text/javascript">
        jQuery(function($) { $('#newpassword').pwstrength(); });
        $(document).ready(function() {
            $("#register_form").validate({
                ignore: [],
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "<?php echo base_url(); ?>auth/register_valid_email",
                            type: "post",
                        }
                    },
                    username: {
                        required: true,
                        remote: {
                            url: "<?php echo base_url(); ?>auth/register_valid_username",
                            type: "post",
                        }
                    },
                    password: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "<?php echo $this->lang->line('auth_register_name_required'); ?>"
                    },
                    email: {
                        required: "<?php echo $this->lang->line('auth_register_email_required'); ?>",
                        email: "<?php echo $this->lang->line('auth_register_email_email'); ?>",
                        remote: "{0} is already in use"
                    },
                    username: {
                        required: "<?php echo $this->lang->line('auth_register_username_required'); ?>",
                        remote: "{0} is already in use"
                    },
                    password: {
                        required: "<?php echo $this->lang->line('auth_register_password_required'); ?>"
                    },
                }
            });
        });
    </script>

</body>
</html>
