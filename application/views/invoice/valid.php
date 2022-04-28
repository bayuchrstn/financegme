<script type="text/javascript">
	$(document).ready(function(){

		$("#modal_generate_invoice_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            // rules: {
            //     subject: {required: true},
            //     body_fake: {required: true},
            //     location_id: {required: true},
            //     up_select: {required: true},
            // },
            //
            // messages: {
            //     subject: {required: "Judul progress harus diisi"},
            //     body_fake: {required: "Isi laporan harus diisi"},
            //     location_id: {required: "Lokasi harus diisi"},
            //     up_select: {required: "Referensi pekerjaan harus diisi"},
            // },

            submitHandler: function(form) {
				// block_this('modal_generate_invoice_form');
                $.ajax({
                    type : 'POST',
                    url  : $('#modal_generate_invoice_form').attr('action'),
                    data  : $('#modal_generate_invoice_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						// unblock_this('modal_generate_invoice_form');
						create_alert('msg_alert_generate', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
                    },
                    error: function (e, status) {
                        // $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });



	});

</script>
