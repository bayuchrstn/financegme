<script type="text/javascript">
	$(document).ready(function(){

		$("#form_<?php echo $modul['code'] ?>_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                location_id: {required: true},
                subject: {required: true},
                category: {required: true},
                body_fake: {required: true},
                date_request_start: {required: true},
                attachment_fake: { required: true },
            },

            messages: {
                location_id: {required: "Pre Customer harus diisi"},
                subject: {required: "Judul progress harus diisi"},
                category: {required: "Jenis progress harus diisi"},
                body_fake: {required: "isi Laporan harus diisi"},
                date_request_start: {required: "Tanggal request harus diisi"},
                attachment_fake: { required: "File belum dilampirkan" },
            },

            submitHandler: function(form) {
                block_this('form_<?php echo $modul['code'] ?>_insert');

                $(form).ajaxSubmit({
					success: function(res) {
						var response = jQuery.parseJSON(res);
						$('#js_table_<?php echo $modul['code'] ?>').DataTable().ajax.reload(null, false);
						$('.modal').modal('hide');
						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						unblock_this('form_<?php echo $modul['code'] ?>_insert');
					},
					error: function() {
						unblock_this('form_<?php echo $modul['code'] ?>_insert');
						$('.modal').modal('hide');
		            }
                });
                return false;
            }
        });

		$("#form_<?php echo $modul['code'] ?>_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                body_fake: {required: true},
            },

            messages: {
                subject: {required: "Judul progress harus diisi"},
                body_fake: {required: "isi Laporan harus diisi"},
            },

            submitHandler: function(form) {
                // block_this('form_<?php echo $modul['code'] ?>_update');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_update').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						if(response.status=='success'){
							create_alert('msg_alert', response.msg, 'bg-success');
						} else {
							create_alert('msg_alert', response.msg, 'bg-danger');
						}
						$('#js_table_<?php echo $modul['code'] ?>').DataTable().ajax.reload( null, false );
						$('.modal').modal('hide');
                        // unblock_this('form_<?php echo $modul['code'] ?>_update');
                    },
                    error: function (e, status) {
                        unblock_this('form_<?php echo $modul['code'] ?>_update');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });



	});
</script>
