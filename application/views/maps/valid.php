<script type="text/javascript">
	$(document).ready(function(){
		$("#form_maps_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				maps_lat: {required: true},
				maps_lng: {required: true},
			},
			messages: {
				maps_lat: {required: "Latitude harus diisi"},
				maps_lng: {required: "Longtitude harus diisi"},
			},

            submitHandler: function(form) {

                var maps_type = $('#maps_type').val();

                $.ajax({
                    type : 'POST',
                    url  : $('#form_maps_insert').attr('action'),
                    data  : $('#form_maps_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_'+maps_type).DataTable().ajax.reload( null, false );
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_maps_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				// maps_name: {required: true},
				maps_lat: {required: true},
                maps_lng: {required: true},
			},
			messages: {
				// maps_name: {required: "Nama harus diisi"},
				maps_lat: {required: "Latitude harus diisi"},
                maps_lng: {required: "Longtitude harus diisi"},
			},

            submitHandler: function(form) {

                var maps_type = $('#maps_type_update').val();

                $.ajax({
                    type : 'POST',
                    url  : $('#form_maps_update').attr('action'),
                    data  : $('#form_maps_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_'+maps_type).DataTable().ajax.reload( null, false );
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

        $("#form_maps_delete").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                // maps_lat: {required: true},
                // maps_lng: {required: true},
            },
            messages: {
                // maps_lat: {required: "Latitude harus diisi"},
                // maps_lng: {required: "Longtitude harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_maps_delete').attr('action'),
                    data  : $('#form_maps_delete').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        console.log(response);

                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
                        $('.modal').modal('hide');
                        $('#js_table_'+response.maps_type).DataTable().ajax.reload( null, false );
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
