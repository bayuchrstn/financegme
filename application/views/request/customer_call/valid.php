<script type="text/javascript">
	$(document).ready(function(){

		$("#form_<?php echo $modul['code'] ?>_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                customer_id: {required: true},
                cis_sid: {required: true},
                respon_fake: {required: true},
                category: {required: true},
            },

            messages: {
                customer_id: {required: "Pelanggan harus diisi"},
                cis_sid: {required: "Customer ID / Service ID harus diisi"},
                respon_fake: {required: "Respon harus diisi"},
                category: {required: "Kategori harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_insert').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_insert').serialize(),
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

						create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('.modal').modal('hide');
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
                customer_id: {required: true},
                cis_sid: {required: true},
                respon_fake: {required: true},
                category: {required: true},
            },

            messages: {
                customer_id: {required: "Pelanggan harus diisi"},
                cis_sid: {required: "Customer ID / Service ID harus diisi"},
                respon_fake: {required: "Respon harus diisi"},
                category: {required: "Kategori harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_update').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);

						<?php
							if(!empty($tabs)):
						        foreach($tabs as $tab):
						?>
					    $('#js_table_<?php echo $tab['code'] ?>').DataTable().ajax.reload( null, false );
						<?php
						        endforeach;
						    endif;
						?>

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



	});


</script>
