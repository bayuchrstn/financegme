<script type="text/javascript">
	$(document).ready(function(){
		$("#form_cuti_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				cuti_name: {required: true},
				cuti_address: {required: true},
			},
			messages: {
				cuti_name: {required: "Nama harus diisi"},
				cuti_address: {required: "Alamat harus diisi"},
			},

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_cuti_insert').attr('action'),
                    data  : $('#form_cuti_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_cuti').DataTable().ajax.reload( null, false );
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_cuti_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				cuti_name: {required: true},
				cuti_address: {required: true},
			},
			messages: {
				cuti_name: {required: "Nama harus diisi"},
				cuti_address: {required: "Alamat harus diisi"},
			},

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_cuti_update').attr('action'),
                    data  : $('#form_cuti_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_cuti').DataTable().ajax.reload( null, false );
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
