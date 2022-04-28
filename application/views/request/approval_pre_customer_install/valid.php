<script type="text/javascript">
	$(document).ready(function(){



		$("#form_<?php echo $modul['code'] ?>_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                status: {required: true},
                // note: {required: true},
            },

            messages: {
                status: {required: "Status approval belum dipilih"},
                // body_fake: {required: "isi Laporan harus diisi"},
            },

            submitHandler: function(form) {
                // block_this('form_<?php // echo $modul['code'] ?>_update');

                $(form).ajaxSubmit({
                    success: function(res) {
                        var response = jQuery.parseJSON(res);

                        <?php foreach($tabs as $tab): ?>
                            $('#js_table_<?php echo $tab['code'] ?>').DataTable().ajax.reload(null, false);
                        <?php endforeach; ?>

                        $('.modal').modal('hide');

                        if(response.status === 'success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }

                        // unblock_this('form_<?php // echo $modul['code'] ?>_update');
                    },
                    error: function() {
                        // unblock_this('form_<?php // echo $modul['code'] ?>_update');
                        $('.modal').modal('hide');
                    },
                });

                return false;
            }
        });



	});
</script>
