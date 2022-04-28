<script type="text/javascript">
	$(document).ready(function(){

		$("#modal_ticket_insert_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                // body_fake: {required: true},
                // location_id: {required: true},
                // up_select: {required: true},
            },

            messages: {
                subject: {required: "Subject / Judul Ticket"},
                // body_fake: {required: "Isi laporan harus diisi"},
                // location_id: {required: "Lokasi harus diisi"},
                // up_select: {required: "Referensi pekerjaan harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_ticket_insert_form').attr('action'),
                    data  : $('#modal_ticket_insert_form').serialize(),
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

		$("#forms_ticket_main_update").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                body_ticket_fake: {required: true},
                subject_ticket: {required: true},
            },

            messages: {
                body_ticket_fake: {required: "Body ticket belum disi"},
                subject_ticket: {required: "Subject ticket belum disi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#forms_ticket_main_update').attr('action'),
                    data  : $('#forms_ticket_main_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);
						create_alert('ticket_view_msg', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
                    }
                });
                return false;
            }
        });

    });

	$(document).ajaxComplete(function(){

		$("#forms_ticket_reply").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                reply_ticket: {required: true},
            },

            messages: {
                reply_ticket: {required: "Balasan belum disi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#forms_ticket_reply').attr('action'),
                    data  : $('#forms_ticket_reply').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						// console.log(response);
						create_alert('ticket_view_msg', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
                    }
                });
                return false;
            }
        });




	});
</script>
