<script type="text/javascript">
	$(document).ready(function(){

		//input pre_customer
		$("#mkt_ts_form_insert").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            rules: {
                subject: {required: true},
                body_fake: {required: true},
            //     location_id: {required: true},
            //     category: {required: true},
            },

            messages: {
                subject: {required: "Judul harus diisiddd"},
                body_fake: {required: "isi harus diisid"},
            //     location_id: {required: "Pelanggan harus dipilih"},
            //     category: {required: "Kategori harus dipilih"},
            },

            submitHandler: function(form) {
                block_this('mkt_ts_form_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#mkt_ts_form_insert').attr('action'),
                    data  : $('#mkt_ts_form_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
						console.log(response);
						// $('#js_table_marketing_progress').DataTable().ajax.reload( null, false );
						// $('.modal').modal('hide');
                        unblock_this('mkt_ts_form_insert');
                    },
                    error: function (e, status) {
                        unblock_this('mkt_ts_form_insert');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });



	});
</script>
