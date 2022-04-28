<script type="text/javascript">
	$(document).ready(function(){


		$("#form_pengajuan_barang_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                subject: {required: true},
                body_fake: {required: true},
				location_id: {required: true},
            },

            messages: {
                subject: {required: "Judul pengajuan barang harus diisi"},
                body_fake: {required: "Keterangan harus diisi"},
				location_id: {required: "Lokasi harus diisi"},
            },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#form_pengajuan_barang_insert').attr('action'),
                    data  : $('#form_pengajuan_barang_insert').serialize(),
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

		$("#form_pengajuan_barang_update").validate({
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
                    url  : $('#form_pengajuan_barang_update').attr('action'),
                    data  : $('#form_pengajuan_barang_update').serialize(),
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
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#modal_pengadaan_form").validate({
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
                    url  : $('#modal_pengadaan_form').attr('action'),
                    data  : $('#modal_pengadaan_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						create_alert('form_pengadaan_msg_div', response.msg, 'bg-success');
						$('.cos_pengadaan').val('');
						getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan/'+response.prefix, 'cartdiv_'+response.prefix);
						// console.log('cartdiv_'+response.prefix);
						$('#modal_pengadaan').animate({ scrollTop: 0 }, 'fast');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#modal_pembanding_form").validate({
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
                    url  : $('#modal_pembanding_form').attr('action'),
                    data  : $('#modal_pembanding_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						create_alert('form_pembanding_msg_div', response.msg, 'bg-success');
						$('.cos_pengadaan').val('');
						getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding/'+response.prefix, 'pembandingdiv_'+response.prefix);
						$('#modal_pembanding').animate({ scrollTop: 0 }, 'fast');
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
                    url  : $('#modal_cart_update_form').attr('action'),
                    data  : $('#modal_cart_update_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						getajax('<?php echo base_url(); ?>ajax_request/loadcart/pengadaan/'+response.prefix, 'cartdiv_'+response.prefix);
						getajax('<?php echo base_url(); ?>ajax_request/loadcart/pembanding/'+response.prefix, 'pembandingdiv_'+response.prefix);
						$('#modal_cart_update').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
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

							getajax('<?php echo base_url(); ?>ajax_request/show_pengadaan/recomended/'+response.task_id, 'current_recomended_div');
							getajax('<?php echo base_url(); ?>ajax_request/show_pengadaan/pembanding/'+response.task_id, 'current_pembanding_div');
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

	});
</script>
