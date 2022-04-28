<script type="text/javascript">
	//reset tinyMCE by id
	tinyMCE.get('body_update').setContent(response.body);

	//ajax post
	$.ajax({
		type:'POST',
		data: {
			id: sku,
			qty: '1',
			price: '1',
			name: name,
		},
		url: '<?php echo base_url(); ?>cart/insert',
		success: function(res) {
			var response = jQuery.parseJSON(res);
			console.log(response);
		}
	});

	//ajax get
	$.ajax({
		type:'GET',
		url: '<?php echo base_url(); ?>cart',
		success: function(res) {
			var response = jQuery.parseJSON(res);
			console.log(response);
		}
	});

	// jquery validaton
	$(document).ready(function() {
        $("#form_procedure_insert").validate({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            ignore: [],
            rules: {
                    procedure_name: {required: true},
                    procedure_address: {required: true},
                    procedure_telephone: {required: true},
                },

            messages: {
                    procedure_name: {required: ""},
                    procedure_address: {required: ""},
                    procedure_telephone: {required: ""},
                },
            submitHandler: function(form) {
                block_this('form_procedure_insert');
                $.ajax({
                    type : 'POST',
                    url  : $('#form_procedure_insert').attr('action'),
                    data  : $('#form_procedure_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

						if(response.status=='sukses' || response.status=='success'){
                            create_alert('alert_modal_insert', response.msg, 'bg-success');
                        } else {
                            create_alert('alert_modal_insert', response.msg, 'bg-danger');
                        }

						$('.cos').val('');
                        $('#js_table_procedure').DataTable().ajax.reload( null, false );
                        unblock_this('form_procedure_insert');
                    },
                    error: function (e, status) {
                        unblock_this('form_procedure_insert');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });
    });



</script>
