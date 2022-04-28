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
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="login-container">
	<div class="page-container pb-20">
		<div class="page-content">
			<div class="content-wrapper">
				<form id="request_password_form" method="post" action="<?php echo base_url(); ?>lost_password" class="form-validate">
					<div style="width:345px; " class="panel panel-body login-form">
						<div class="text-center">
                            <!-- <img src="<?php echo base_url(); ?>assets/images/gmedia_logo.png" alt="" /> -->
							<h5 class="content-group-lg">
                                <?php echo $this->lang->line('all_login_title'); ?>
                                <small class="display-block"><?php echo $this->lang->line('auth_request_title'); ?></small>
                            </h5>
						</div>

                        <div id="response_login">
                            <?php echo show_flash('msg'); ?>
                        </div>

						<div class="form-group">
							<input type="text" class="form-control" name="akn" placeholder="<?php echo $this->lang->line('auth_request_username'); ?>" onfocus="this.placeholder=''" onblur="this.placeholder='Username'">
						</div>


                        <div class="form-group">
							<button type="submit" class="btn bg-blue btn-block"><?php echo $this->lang->line('auth_request_button'); ?> <i class="icon-arrow-right14 position-right"></i></button>
						</div>


                        <div class="text-center">
                            <a href="<?php echo base_url(); ?>login"><?php echo $this->lang->line('auth_request_login_link'); ?></a>
                        </div>

					</div>
				</form>
			</div>
		</div>
	</div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#request_password_form").validate({
                ignore: [],
                rules: {
                    username: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "<?php echo $this->lang->line('auth_request_username_required'); ?>"
                    }
                }
            });
        });
    </script>

</body>
</html>
