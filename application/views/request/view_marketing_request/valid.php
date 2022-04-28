<script type="text/javascript">
	$(document).ready(function(){



		$("#form_<?php echo $modul['code'] ?>_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                'subject': {required: true},
                'body_fake': {required: true},
                'category': {required: true},
                'user_assigned[]': {required: true},
                'date_start': {required: true},
                'date_due': {required: true},
            },

            messages: {
                'subject': {required: "Judul progress harus diisi"},
                'body_fake': {required: "isi Laporan harus diisi"},
                'category': {required: "Jenis pekerjaan harus diisi"},
                'user_assigned[]': {required: "Pelaksana harus diisi"},
                'date_start': {required: "Tanggal mulai harus diisi"},
                'date_due': {required: "tanggal selesai harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_update').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						<?php
							foreach($tabs as $tab):
						?>
						$('#js_table_<?php echo $tab['code'] ?>').DataTable().ajax.reload( null, false );
						<?php
							endforeach;
						?>
						$('.modal').modal('hide');
						if(response.status=='success'){
							create_alert('msg_alert', response.msg, 'bg-success');
						} else {
							create_alert('msg_alert', response.msg, 'bg-danger');
						}
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
