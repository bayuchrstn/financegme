
//generate from valid.php
<script type="text/javascript">

    $(document).ready(function() {
		//insert product category
        $("#form_product_category_insert").validate({
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
                name: {
                    required: true,
                },
            },

            messages: {
                name: {
                    required: "<?php echo $this->lang->line('product_category_name_required'); ?>",
                },
            },
            submitHandler: function(form) {
                block_this('form_product_category_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_category_insert').attr('action'),
                    data  : $('#form_product_category_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        if(response.status=='success'){
                            create_alert('modal_product_category_insert_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('modal_product_category_insert_alert', response.msg, 'bg-danger');
                        }

                        $('#js_table_product_category').DataTable().ajax.reload( null, false );
						$('.cos').val('');
                        unblock_this('form_product_category_insert');
                    },
                    error: function (e, status) {
                        unblock_this('form_product_category_insert');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//update product category
        $("#form_product_category_update").validate({
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
                name: {
                    required: true,
                },
            },

            messages: {
                name: {
                    required: "<?php echo $this->lang->line('product_category_name_required'); ?>",
                },
            },
            submitHandler: function(form) {
                block_this('form_product_category_update');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_category_update').attr('action'),
                    data  : $('#form_product_category_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        if(response.status=='success'){
                            create_alert('modal_product_category_update_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('modal_product_category_update_alert', response.msg, 'bg-danger');
                        }

                        $('#js_table_product_category').DataTable().ajax.reload( null, false );
                        unblock_this('form_product_category_update');
                    },
                    error: function (e, status) {
                        unblock_this('form_product_category_update');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

		//delete
		$("#form_product_category_delete").validate({
            ignore: [],
			rules: {id: {required: true}},
			submitHandler: function(form) {
                block_this('form_product_category_delete');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_category_delete').attr('action'),
                    data  : $('#form_product_category_delete').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }


                        $('#js_table_product_category').DataTable().ajax.reload( null, false );
                        unblock_this('form_product_category_delete');
                        $('.modal').modal('hide');
                    },
                    error: function (e, status) {
                        unblock_this('form_product_category_delete');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

	});


</script>
