<script type="text/javascript">
	$(document).ready(function(){

		$("#form_<?php echo $modul['code'] ?>_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                body_fake: {required: true},
                location_id: {required: true},
                up_select: {required: true},
            },

            messages: {
                subject: {required: "Judul progress harus diisi"},
                body_fake: {required: "Isi laporan harus diisi"},
                location_id: {required: "Lokasi harus diisi"},
                up_select: {required: "Referensi pekerjaan harus diisi"},
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

		$("#modal_boq_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                supplier: {required: true},
                qty		: {required: true},
                price	: {required: true},
            },

            messages: {
                supplier: {required: "Supplier harus diisi"},
                qty		: {required: "Jumlah harus diisi"},
                price	: {required: "Harga satuan harus diisi"},
            },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#modal_boq_form').attr('action'),
                    data  : $('#modal_boq_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						create_alert('form_boq_msg_div', response.msg, 'bg-success');
						$('.cos_boq').val('');
						getajax('<?php echo base_url(); ?>ajax_request/loadcart/boq/'+response.prefix, 'cartdiv_'+response.prefix);
						$('#modal_boq').animate({ scrollTop: 0 }, 'fast');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#modal_cart_update_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // supplier: {required: true},
                qty		: {required: true},
                // price	: {required: true},
            },

            messages: {
                // supplier: {required: "Supplier harus diisi"},
                qty		: {required: "Jumlah harus diisi"},
                // price	: {required: "Harga satuan harus diisi"},
            },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#modal_cart_update_form').attr('action'),
                    data  : $('#modal_cart_update_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						getajax('<?php echo base_url(); ?>ajax_request/loadcart/boq/'+response.prefix, 'cartdiv_'+response.prefix);
						$('#modal_cart_update').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

	});

	$(document).ajaxComplete(function(){

		$("#modal_current_update_form").validate({
			<?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
				// supplier: {required: true},
				qty		: {required: true},
				price	: {required: true},
			},

			messages: {
				// supplier: {required: "Supplier harus diisi"},
				qty		: {required: "Jumlah harus diisi"},
				price	: {required: "Harga satuan harus diisi"},
			},

			submitHandler: function(form) {
				$.ajax({
					type : 'POST',
					url  : $('#modal_current_update_form').attr('action'),
					data  : $('#modal_current_update_form').serialize(),
					success : function(res){
						var response = jQuery.parseJSON(res);
						console.log(response);

						getajax('<?php echo base_url(); ?>ajax_request/show_boq/'+response.task_id, 'current_div');
						$('#modal_current_update').modal('hide');
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
