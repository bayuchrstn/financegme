<script type="text/javascript">
	$(document).ready(function(){

		$("#trial_report_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
            },

            messages: {
            },

            submitHandler: function(form) {
                block_this('trial_report_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#trial_report_insert').attr('action'),
                    data  : $('#trial_report_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						$('#js_table_request').DataTable().ajax.reload( null, false );
                        $('#js_table_done').DataTable().ajax.reload( null, false );
						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
                        unblock_this('trial_report_insert');
                    },
                    error: function (e, status) {
                        unblock_this('trial_report_insert');
                        // $('.modal').modal('hide');
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
                block_this('form_<?php echo $modul['code'] ?>_update');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_update').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						$('#js_table_<?php echo $modul['code'] ?>').DataTable().ajax.reload( null, false );
						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
                        unblock_this('form_<?php echo $modul['code'] ?>_update');
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
