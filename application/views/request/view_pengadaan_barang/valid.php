<script type="text/javascript">
	$(document).ready(function(){


		$("#form_view_pengadaan_barang_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                subject: {required: true},
                body_fake: {required: true},
            },

            messages: {
                subject: {required: "Judul pengajuan barang harus diisi"},
                body_fake: {required: "Keterangan harus diisi"},
            },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#form_view_pengadaan_barang_update').attr('action'),
                    data  : $('#form_view_pengadaan_barang_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						<?php
							if(!empty($tabs)):
						        foreach($tabs as $tab):
						?>
					    $('#js_table_<?php echo $tab['code'] ?>').DataTable().ajax.reload( null, false );
						<?php
						        endforeach;
						    endif;
						?>

						$('.modal').modal('hide');
						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
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
