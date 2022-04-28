<script type="text/javascript">
	$(document).ready(function(){
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
						// console.log(response);
						$('#picker_div_'+response.row).html(response.barang_dikeluarkan);
                    },
                    error: function (e, status) {
                        // $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		$("#form_barang_keluar_update").validate({
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
                    url  : $('#form_barang_keluar_update').attr('action'),
                    data  : $('#form_barang_keluar_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);
						<?php
							foreach($tabs as $tab):
						?>
						$('#js_table_<?php echo $tab['code'] ?>').DataTable().ajax.reload( null, false );
						<?php
							endforeach;
						?>
						if(response.status=='success'){
							create_alert('msg_alert', response.msg, 'bg-success');
						} else {
							create_alert('msg_alert', response.msg, 'bg-danger');
						}
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
