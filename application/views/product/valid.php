<script type="text/javascript">

    $(document).ready(function() {


        $("#form_product_insert").validate({
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
                    required: "<?php echo $this->lang->line('product_name_required'); ?>",
                },
            },
            submitHandler: function(form) {
                block_this('form_product_insert');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_insert').attr('action'),
                    data  : $('#form_product_insert').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('alert_modal_insert', response.msg, 'bg-success');
                        } else {
                            create_alert('alert_modal_insert', response.msg, 'bg-danger');
                        }

                        <?php
                            $category = $this->product->arr_product_category();
                            if(!empty($category)):
                                foreach($category as $cat=>$val):
                        ?>
                        $('#js_table_<?php echo $cat; ?>').DataTable().ajax.reload( null, false );
                        <?php
                                endforeach;
                            endif;
                        ?>

						$('.cos').val('');

                        unblock_this('form_product_insert');
                    },
                    error: function (e, status) {
                        unblock_this('form_product_insert');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });


        $("#form_product_update").validate({
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
                    required: "<?php echo $this->lang->line('product_name_required'); ?>",
                },
            },
            submitHandler: function(form) {
                block_this('form_product_update');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_update').attr('action'),
                    data  : $('#form_product_update').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('alert_modal_update', response.msg, 'bg-success');
                        } else {
                            create_alert('alert_modal_update', response.msg, 'bg-danger');
                        }

                        <?php
                            $category = $this->product->arr_product_category();
                            if(!empty($category)):
                                foreach($category as $cat=>$val):
                        ?>
                        $('#js_table_<?php echo $cat; ?>').DataTable().ajax.reload( null, false );
                        <?php
                                endforeach;
                            endif;
                        ?>

                        unblock_this('form_product_update');
                    },
                    error: function (e, status) {
                        unblock_this('form_product_update');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });

        $("#form_product_delete").validate({
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
            rules: {id: {required: true}},

            submitHandler: function(form) {
                block_this('form_product_delete');

                $.ajax({
                    type : 'POST',
                    url  : $('#form_product_delete').attr('action'),
                    data  : $('#form_product_delete').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('msg_alert', response.msg, 'bg-success');
                        } else {
                            create_alert('msg_alert', response.msg, 'bg-danger');
                        }
                        <?php
                            $category = $this->product->arr_product_category();
                            if(!empty($category)):
                                foreach($category as $cat=>$val):
                        ?>
                        $('#js_table_<?php echo $cat; ?>').DataTable().ajax.reload( null, false );
                        <?php
                                endforeach;
                            endif;
                        ?>
                        unblock_this('form_product_delete');
                        $('.modal').modal('hide');
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

<?php
    //insert
    // $arr_insert = array();
    // $arr_insert['form_id'] = 'form_product_insert';
    // $arr_insert['div_loader'] = 'form_product_insert';
    // $arr_insert['console_log'] = 'no';
    // $arr_insert['alert'] = 'alert_modal_update';
    // $arr_insert['cos'] = 'no';
    // $arr_insert['datatables_reload'] = 'js_table_product';
    // $arr_insert['hide_modal'] = 'no';
    // $arr_insert['rules'] = array(
    //     'name'              => array('required' => 'true'),
    // );
    // $arr_insert['messages'] = array(
    //     'name'              => array('required' => $this->lang->line('master_name_required')),
    // );
    // echo $this->ui->load_template('validation',$arr_insert);

?>
