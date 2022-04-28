<script type="text/javascript">

    $(document).ajaxComplete(function() {

		$("#modal_usergroup_insert_form").validate({
			<?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				sender: {required: true},
				name: {required: true},
			},
			messages: {
				name: {required: "Nama harus diisi"},
			},
			submitHandler: function(form) {

				$.ajax({
					type : 'POST',
					url  : $('#modal_usergroup_insert_form').attr('action'),
					data  : $('#modal_usergroup_insert_form').serialize(),
					success : function(res){
						var response = jQuery.parseJSON(res);
						// console.log(response);
                        $('#js_table_usergroup').DataTable().ajax.reload( null, false );
                        create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
					},
					error: function (e, status) {
						$('.modal').modal('hide');
					}
				});
				return false;
			}
		});

        $("#modal_usergroup_update_form").validate({
			<?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				sender: {required: true},
				name: {required: true},
			},
			messages: {
				name: {required: "Nama harus diisi"},
			},
			submitHandler: function(form) {

				$.ajax({
					type : 'POST',
					url  : $('#modal_usergroup_update_form').attr('action'),
					data  : $('#modal_usergroup_update_form').serialize(),
					success : function(res){
						var response = jQuery.parseJSON(res);
						$('#js_table_usergroup').DataTable().ajax.reload( null, false );
                        create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
					},
					error: function (e, status) {
						$('.modal').modal('hide');
					}
				});
				return false;
			}
		});

        $("#modal_jabatan_form").validate({
			<?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				sender: {required: true},
				name: {required: true},
			},
			messages: {
				name: {required: "Nama harus diisi"},
			},
			submitHandler: function(form) {

				$.ajax({
					type : 'POST',
					url  : $('#modal_jabatan_form').attr('action'),
					data  : $('#modal_jabatan_form').serialize(),
					success : function(res){
						var response = jQuery.parseJSON(res);
						$('#js_table_usergroup').DataTable().ajax.reload( null, false );
                        create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
					},
					error: function (e, status) {
						$('.modal').modal('hide');
					}
				});
				return false;
			}
		});

        $("#modal_input_jabatan_form").validate({
			<?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				sender: {required: true},
				name: {required: true},
			},
			messages: {
				name: {required: "Nama harus diisi"},
			},
			submitHandler: function(form) {

				$.ajax({
					type : 'POST',
					url  : $('#modal_input_jabatan_form').attr('action'),
					data  : $('#modal_input_jabatan_form').serialize(),
					success : function(res){
						var response = jQuery.parseJSON(res);
						$('#js_table_usergroup').DataTable().ajax.reload( null, false );
                        create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						// $('.modal').modal('hide');
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


    //privileges
    $arr_update = array();
    $arr_update['form_id'] = 'form_usergroup_privileges';
    $arr_update['div_loader'] = 'form_usergroup_privileges';
    $arr_update['console_log'] = 'no';
    $arr_update['alert'] = 'alert_modal_privileges';
    $arr_update['hide_modal'] = 'no';
    $arr_update['rules'] = array(
        'fake_privileges'          => array('required' => 'true')
    );
    echo $this->ui->load_template('validation_no_datatables_no_cos',$arr_update);


?>
