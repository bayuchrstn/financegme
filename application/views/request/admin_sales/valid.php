<script type="text/javascript">
	$(document).ready(function(){


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

                $.ajax({
                    type : 'POST',
                    url  : $('#form_<?php echo $modul['code'] ?>_update').attr('action'),
                    data  : $('#form_<?php echo $modul['code'] ?>_update').serialize(),
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
						$('.modal').modal('hide');
						if(response.status=='success'){
							create_alert('msg_alert', response.msg, 'bg-success');
						} else {
							create_alert('msg_alert', response.msg, 'bg-danger');
						}
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
