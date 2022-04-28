<script type="text/javascript">
	$(document).ready(function(){
		$("#form_barang_replace_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				item_detail_picker: {required: true},
            },

            messages: {
				item_detail_picker: {required: "Item Barang belum dipilih"},
            },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#form_barang_replace_update').attr('action'),
                    data  : $('#form_barang_replace_update').serialize(),
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
                    error: function (e, status) {
                        // $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

        $("#form_item_detail_approval").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                item_detail_picker: {required: true},
            },

            messages: {
                item_detail_picker: {required: "Item Barang belum dipilih"},
            },

            submitHandler: function(form) {
                $.ajax({
                    type : 'POST',
                    url  : $('#form_item_detail_approval').attr('action'),
                    data  : $('#form_item_detail_approval').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        console.log(response);
                        $('#approval_form_update').load('<?php echo base_url(); ?>ajax/item_replace_approval/'+response.task_id);
                        $('#modal_item_detail_approval').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#modal_penerimaan_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
				item_detail_picker: {required: true},
            },

            messages: {
				item_detail_picker: {required: "Item Barang belum dipilih"},
            },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#modal_penerimaan_form').attr('action'),
                    data  : $('#modal_penerimaan_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						$('#approval_form_update').load('<?php echo base_url(); ?>ajax/item_replace_approval/'+response.task_id);
						$('#modal_penerimaan').modal('hide');
                    },
                    error: function (e, status) {
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_barang_masuk_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            // rules: {
			// 	item_detail_picker: {required: true},
            // },
			//
            // messages: {
			// 	item_detail_picker: {required: "Item Barang belum dipilih"},
            // },

            submitHandler: function(form) {
				$.ajax({
                    type : 'POST',
                    url  : $('#form_barang_masuk_update').attr('action'),
                    data  : $('#form_barang_masuk_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);

						if(response.status=='success'){
							create_alert('msg_alert', response.msg, 'bg-success');
						} else {
							create_alert('msg_alert', response.msg, 'bg-danger');
						}

						<?php
							foreach($tabs as $tab):
						?>
						$('#js_table_<?php echo $tab['code'] ?>').DataTable().ajax.reload( null, false );
						<?php
							endforeach;
						?>

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
