<script type="text/javascript">
	$(document).ready(function(){
		$("#form_user_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				username: {
                        required: true,
                        remote: {url : "<?php echo base_url(); ?>user/register_valid_username", type: "post"},
                    },
                password: {
                        required: true,
                    },
                name: {
                        required: true,
                    },
                level: {
                        required: true,
                    },
                email: {
                        required: true,
                        email: true,
                        remote: {url : "<?php echo base_url(); ?>user/register_valid_email", type: "post"},
                    },
            },

            messages: {
				username: {
                        required: "Username is required",
                        remote: "{0} is already in use",
                    },
                password: {
                        required: "Password is required",
                    },
                name: {
                        required: "Name is required",
                    },
                level: {
                        required: "Usergroup harus diisi",
                    },
                email: {
                        required: "Email is required",
                        email: "Email format invalid",
                        remote: "{0} is already in use",
                    },
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_user_insert').attr('action'),
                    data  : $('#form_user_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_user').DataTable().ajax.reload( null, false );
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_user_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {


                name: {
                        required: true,
                    },

                email: {
                        required: true,
                        email: true,
                    },
            },

            messages: {

                name: {
                        required: "Name is required",
                    },

                email: {
                        required: "Email is required",
                        email: "Email format invalid",
                    },
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_user_update').attr('action'),
                    data  : $('#form_user_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_user').DataTable().ajax.reload( null, false );
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });
	});
</script>

<?php




    //delete
    $arr_delete = array();
    $arr_delete['form_id'] = 'form_user_delete';
    $arr_delete['div_loader'] = 'form_user_delete';
    $arr_delete['console_log'] = 'yes';
    $arr_delete['alert'] = 'yes';
    $arr_delete['cos'] = 'yes';
    $arr_delete['datatables_reload'] = 'js_table_user';
    $arr_delete['hide_modal'] = 'yes';
    $arr_delete['rules'] = array(
        'id'          => array('required' => 'true'),
    );
    echo $this->ui->load_template('validation',$arr_delete);

    //privileges
    $arr_update = array();
    $arr_update['form_id'] = 'form_usergroup_privileges';
    $arr_update['div_loader'] = 'form_usergroup_privileges';
    $arr_update['console_log'] = 'yes';
    $arr_update['alert'] = 'alert_modal_privileges';
    $arr_update['hide_modal'] = 'no';
    $arr_update['rules'] = array(
        'fake_privileges'          => array('required' => 'true')
    );
    echo $this->ui->load_template('validation_no_datatables_no_cos',$arr_update);
?>
