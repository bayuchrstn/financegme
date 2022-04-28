<script type="text/javascript">
	$(document).ready(function(){

		$("#form_<?php echo $modul['code'] ?>_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				subject: {required: true},
                body_fake: {required: true},
                up_select: {required: true},
            },

            messages: {
				subject: {required: "Judul laporan harian harus diisi"},
                body_fake: {required: "Keterangan harus diisi"},
                up_select: {required: "Referensi Pekerjaan harus diisi"},
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
                body_fake: {required: "Keterangan harus diisi"},
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

		$("#form_item_out_editor").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                status_kepemilikan: {required: true},
            },

            messages: {
                status_kepemilikan: {required: "Status Kepemilikan harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#form_item_out_editor').attr('action'),
                    data  : $('#form_item_out_editor').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						// $('.modal').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//new
		$("#modal_rpc_out_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                item_brand: {required: true},
                item_category: {required: true},
                condition: {item_name: true},
            },

            messages: {
                item_brand: {required: "Brand  belum dipilih"},
                item_category: {required: "Kategori Barang belum dipilih"},
                condition: {required: "Nama Barang belum dipilih"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_rpc_out_form').attr('action'),
                    data  : $('#modal_rpc_out_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						create_alert('form_out_msg_div', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
						$('#cart_div_'+response.prefix_mode).load('<?php echo base_url(); ?>xhr/request_out/cart/'+response.prefix_mode);
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#modal_cart_update_out_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            // rules: {
            //     item_brand: {required: true},
            //     item_category: {required: true},
            //     condition: {item_name: true},
            // },
			//
            // messages: {
            //     item_brand: {required: "Brand  belum dipilih"},
            //     item_category: {required: "Kategori Barang belum dipilih"},
            //     condition: {required: "Nama Barang belum dipilih"},
            // },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_cart_update_out_form').attr('action'),
                    data  : $('#modal_cart_update_out_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);
						$('#cart_div_'+response.prefix).load('<?php echo base_url(); ?>ajax_request/replace_cart/'+response.prefix);
						$('#modal_cart_update_out').modal('hide');
					},
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#modal_current_update_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            // rules: {
            //     item_brand: {required: true},
            //     item_category: {required: true},
            //     condition: {item_name: true},
            // },
			//
            // messages: {
            //     item_brand: {required: "Brand  belum dipilih"},
            //     item_category: {required: "Kategori Barang belum dipilih"},
            //     condition: {required: "Nama Barang belum dipilih"},
            // },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_current_update_form').attr('action'),
                    data  : $('#modal_current_update_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);
						$('#current_div').load('<?php echo base_url(); ?>xhr/request_replace/current/'+response.detail.task_id);
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
