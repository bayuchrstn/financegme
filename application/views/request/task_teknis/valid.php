<script type="text/javascript">
	$(document).ready(function(){

		$("#form_<?php echo $modul['code'] ?>_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                body_fake: {required: true},
                location_id: {required: true},
                date_start: {required: true},
                date_due: {required: true},
            },

            messages: {
                subject: {required: "Judul progress harus diisi"},
                body_fake: {required: "Isi laporan harus diisi"},
                location_id: {required: "Lokasi harus diisi"},
                date_start: {required: "Tanggal mulai harus diisi"},
                date_due: {required: "Tanggal Selesai harus diisi"},
            },

            submitHandler: function(form) {
                block_this('form_<?php echo $modul['code'] ?>_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_insert').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_insert').serialize(),
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
						$('.modal').modal('hide');

						if(response.status=='success'){
							create_alert('msg_alert', response.msg, 'bg-success');
						} else {
							create_alert('msg_alert', response.msg, 'bg-danger');
						}

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


        //delete task
        $("#form_product_delete").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                delete_id: {required: true}
            },

            messages: {
                delete_id: {required: "Id task harus diisi"}
            },

            submitHandler: function(form) {
                block_this('form_product_delete');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_delete').attr('action'),
                    data  : $('#form_product_delete').serialize(),
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
                        unblock_this('form_product_delete');
                        $('.modal').modal('hide');
                        if(response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
                    },
                    error: function (e, status) {
                        unblock_this('form_product_delete');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

	});
</script>
