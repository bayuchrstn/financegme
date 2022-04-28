<script type="text/javascript">
	$(document).ajaxComplete(function(){


		$("#modal_co_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                final_option: {required: true},
                note: {required: true},
            },

            messages: {
                final_option: {required: "final option harus diisi"},

            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_co_form').attr('action'),
                    data  : $('#modal_co_form').serialize(),
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

                });
                return false;
            }
        });

		$(".form-input").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                user_id: {required: true},
                options: {required: true},
                final_option: {required: true},
                sort: {required: true},

            },

            messages: {
                user_id: {required: "user ID harus diisi"},
                options: {required: "Optiona harus diisi"},
                final_option: {required: "final option harus diisi"},
                sort: {required: "urutan harus diisi"},

            },

            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('.form-input').attr('action'),
                    data  : $('.form-input').serialize(),
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

                });
                return false;
            }
        });



	});
</script>
