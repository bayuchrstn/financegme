<script type="text/javascript">
	$(document).ajaxComplete(function(){

		//input pre_customer
		$("#form_pre_customer_insert_new").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                customer_name: {required: true},
                customer_address: {required: true},
                customer_type: {required: true},
                telephone_home: {required: true},
            },

            messages: {
                customer_name: {required: "Nama pelanggan harus diisi"},
                customer_address: {required: "Alamat pelanggan harus diisi"},
                customer_type: {required: "jenis pelanggan harus diisi"},
                telephone_home: {required: "telepon pelanggan harus diisi"},
            },

            submitHandler: function(form) {
                block_this('form_pre_customer_insert_new');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_pre_customer_insert_new').attr('action'),
                    data  : $('#form_pre_customer_insert_new').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
						$('.modal').modal('hide');
						$('#js_table_pre_customer').DataTable().ajax.reload( null, false );
                        unblock_this('form_pre_customer_insert_new');
                    },
                    error: function (e, status) {
                        unblock_this('form_pre_customer_insert_new');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//input marketing progress dari daftar pre customer
		$("#form_marketing_progress_insert").validate({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            ignore: [],
            rules: {
                subject: {
                    required: true,
                },
            },

            messages: {
                subject: {
                    required: "<?php echo $this->lang->line('marketing_progress_subject_required'); ?>",
                },
            },
            submitHandler: function(form) {
                block_this('form_marketing_progress_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_marketing_progress_insert').attr('action'),
                    data  : $('#form_marketing_progress_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        // if(response.status=='sukses' || response.status=='success'){
                        //     create_alert('alert_modal_update', response.msg, 'bg-success');
                        // } else {
                        //     create_alert('alert_modal_update', response.msg, 'bg-danger');
                        // }
                        unblock_this('form_marketing_progress_insert');
                    },
                    error: function (e, status) {
                        unblock_this('form_marketing_progress_insert');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//update pre customer
		$("#form_customer_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                customer_name: {
                    required: true,
                },
            },

            messages: {
                customer_name: {
                    required: "<?php echo $this->lang->line('customer_name_required'); ?>",
                },
            },
            submitHandler: function(form) {
                block_this('form_customer_update');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_customer_update').attr('action'),
                    data  : $('#form_customer_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

						// console.log(response);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }

						$('#js_table_pre_customer').DataTable().ajax.reload( null, false );
						$('.modal').modal('hide');

                        unblock_this('form_customer_update');
                    },
                    error: function (e, status) {
                        unblock_this('form_customer_update');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//update global
		$("#form_customer_update_global").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                customer_name: {required: true},
                customer_address: {required: true},
                customer_type: {required: true},
                telephone_home: {required: true},
                telephone_work: {required: true},
            },

            messages: {
                customer_name: {
                    required: "<?php echo $this->lang->line('customer_name_required'); ?>",
                },
            },


            submitHandler: function(form) {
                // block_this('form_customer_update_global');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_customer_update_global').attr('action'),
                    data  : $('#form_customer_update_global').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

						console.log(response);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('form_customer_update_global_msg', response.msg, 'bg-success');
                        } else {
                            create_alert('form_customer_update_global_msg', response.msg, 'bg-danger');
                        }

						$('#modal_customer_update').animate({ scrollTop: 0 }, 'fast');

						// $('#js_table_pre_customer').DataTable().ajax.reload( null, false );
						// $('.modal').modal('hide');
						//
                        // unblock_this('form_customer_update_global');
                    },
                    error: function (e, status) {
                        // unblock_this('form_customer_update_global');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//update produk
		$("#form_customer_update_product").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                customer_name: {required: true},
                customer_address: {required: true},
                customer_type: {required: true},
                telephone_home: {required: true},
            },

            messages: {
                customer_name: {
                    required: "<?php echo $this->lang->line('customer_name_required'); ?>",
                },
            },
            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_customer_update_product').attr('action'),
                    data  : $('#form_customer_update_product').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

						console.log(response);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('form_customer_update_product_msg', response.msg, 'bg-success');
                        } else {
                            create_alert('form_customer_update_product_msg', response.msg, 'bg-danger');
                        }

						$('#modal_customer_update').animate({ scrollTop: 0 }, 'fast');

						// $('#js_table_pre_customer').DataTable().ajax.reload( null, false );
						// $('.modal').modal('hide');
						//
                        // unblock_this('form_customer_update_global');
                    },
                    error: function (e, status) {
                        // unblock_this('form_customer_update_global');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//update teknis
		$("#form_customer_update_teknis").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
			rules: {
                // mrtg: {required: true},
                // ip_address: {required: true},
                // customer_type: {required: true},
                // telephone_home: {required: true},
            },

            messages: {
                customer_name: {
                    required: "Harus diisi",
                },
            },
            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_customer_update_teknis').attr('action'),
                    data  : $('#form_customer_update_teknis').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

						console.log(response);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('form_customer_update_teknis_msg', response.msg, 'bg-success');
                        } else {
                            create_alert('form_customer_update_teknis_msg', response.msg, 'bg-danger');
                        }

						$('#modal_customer_update').animate({ scrollTop: 0 }, 'fast');

						// $('#js_table_pre_customer').DataTable().ajax.reload( null, false );
						// $('.modal').modal('hide');
						//
                        // unblock_this('form_customer_update_global');
                    },
                    error: function (e, status) {
                        // unblock_this('form_customer_update_global');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });



	});

</script>
