<script type="text/javascript">
	$(document).ready(function(){


		$("#modal_timbox_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                location_id: {required: true},
                email: {required: true},
                subject: {required: true},
                body_fake: {required: true},
            },

            messages: {
                location_id: {required: "Lokasi harus diisi"},
                email: {required: "Alamat email pelanggan harus diisi"},
                subject: {required: "Judul ticket harus diisi"},
                body_fake: {required: "isi ticket harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_timbox_form').attr('action'),
                    data  : $('#modal_timbox_form').serialize(),
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
						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
                    },

                });
                return false;
            }
        });



	});
</script>
