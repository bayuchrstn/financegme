<script type="text/javascript">
	$(document).ajaxComplete(function(){

		// Pre survey
		$("#form_pre_survey_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // koordinat: {required: true},
                body_fake: {required: true},
                // jenis_tower: {required: true},
            },

            messages: {
                body_fake: {
                    koordinat: "koordinat harus diisi",
                    required: "Isi laporan diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					console.log(validator.errorList[0].element);
					// alert('#tab1 li a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]');
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_pre_survey_report').attr('action'),
                    data  : $('#form_pre_survey_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');
                    },

                });
                return false;
            }
        });

		// installasi
		$("#form_installasi_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // telephone_work: {required: true},
                body_fake: {required: true},
            },

            messages: {
                body_fake: {
                    required: "Laporan harus diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					// alert('#tab1 li a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]');
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_installasi_report').attr('action'),
                    data  : $('#form_installasi_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');

                    },

                });
                return false;
            }
        });

		// Dismantle
		$("#form_dismantle_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // telephone_work: {required: true},
                body_fake: {required: true},
            },

            messages: {
                body_fake: {
                    required: "Laporan harus diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_dismantle_report').attr('action'),
                    data  : $('#form_dismantle_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');
                    },

                });
                return false;
            }
        });

		// Replace
		$("#form_replace_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // telephone_work: {required: true},
                body_fake: {required: true},
            },

            messages: {
                body_fake: {
                    required: "Laporan harus diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_replace_report').attr('action'),
                    data  : $('#form_replace_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');
                    },

                });
                return false;
            }
        });

		// General
		$("#form_general_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // telephone_work: {required: true},
                body_fake: {required: true},
            },

            messages: {
                body_fake: {
                    required: "Laporan harus diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_general_report').attr('action'),
                    data  : $('#form_general_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');
                    },

                });
                return false;
            }
        });

		// Survey
		$("#form_survey_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // telephone_work: {required: true},
                body_fake: {required: true},
            },

            messages: {
                body_fake: {
                    required: "Laporan harus diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_survey_report').attr('action'),
                    data  : $('#form_survey_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');
                    },

                });
                return false;
            }
        });

		// Installasi New
		$("#form_installasi_new_report").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // telephone_work: {required: true},
                body_fake: {required: true},
            },

            messages: {
                body_fake: {
                    required: "Laporan harus diisi",
                },
            },

			invalidHandler: function(e, validator){
	            if(validator.errorList.length){
					$('#tab1 a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
				}
	        },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_installasi_new_report').attr('action'),
                    data  : $('#form_installasi_new_report').serialize(),
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
						$('html, body').animate({ scrollTop: 0 }, 'fast');

                    },

                });
                return false;
            }
        });

	});

	//action form kebutuhan pelanggan
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

</script>
