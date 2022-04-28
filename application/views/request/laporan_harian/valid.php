<script type="text/javascript">
	$(document).ready(function(){

		$("#form_<?php echo $modul['code'] ?>_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				subject: {required: true},
                body_fake: {required: true},
                location_id: {required: true},
                jenis_laporan: {required: true},
                date_start: {required: true},
                date_due: {required: true},
                solve: {required: true},
                sla: {required: true},
            },

            messages: {
				subject: {required: "Judul laporan harian harus diisi"},
                body_fake: {required: "Isi laporan harian harus diisi"},
                location_id: {required: "Lokasi harus diisi"},
                jenis_laporan: {required: "Jenis laporan harus diisi"},
                date_start: {required: "Waktu mulai harus diisi"},
                date_due: {required: "Waktu Selesai harus diisi"},
                solve: {required: "problem Solve atau tidak ?"},
                sla: {required: "Termasuk SLA atau tidak ?"},
            },

            submitHandler: function(form) {
                block_this('form_<?php echo $modul['code'] ?>_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_insert').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						$('#js_table_<?php echo $modul['code'] ?>').DataTable().ajax.reload( null, false );
						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
                        unblock_this('form_<?php echo $modul['code'] ?>_insert');
                    },
                    error: function (e, status) {
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
