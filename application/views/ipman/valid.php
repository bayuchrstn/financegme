<script type="text/javascript">
	$(document).ready(function(){
		$("#form_ipman_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				ip: {required: true},
				netmask: {required: true},
			},
			messages: {
				ip: {required: "IP address harus diisi"},
				netmask: {required: "Netmask harus diisi"},
			},

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $(form).attr('action'),
                    data  : $(form).serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_ipman').DataTable().ajax.reload( null, false );
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_ipman_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				ip: {required: true},
				netmask: {required: true},
			},
			messages: {
				ip: {required: "Nama harus diisi"},
				netmask: {required: "Alamat harus diisi"},
			},

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $(form).attr('action'),
                    data  : $(form).serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_bts').DataTable().ajax.reload( null, false );
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
