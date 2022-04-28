<script type="text/javascript">
	$(document).ready(function(){


		$("#modal_email_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                name: {required: true},
                receiver: {required: true},
            },

            messages: {
                name: {required: "Nama harus diisi"},
                receiver: {required: "Penerima harus diisi"},
            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_email_form').attr('action'),
                    data  : $('#modal_email_form').serialize(),
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
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });



	});
</script>
