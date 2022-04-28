<script type="text/javascript">
    $(document).ready(function() {
        $("#<?php echo $form_id; ?>").validate({
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
            <?php
                if(isset($rules) && !empty($rules)):
            ?>
            rules: {
                <?php
                    foreach($rules as $rule=>$val):
                ?>
                <?php echo $rule; ?>: {
                    <?php
                        foreach($val as $rule_item=>$val_item):
                    ?>
                    <?php echo $rule_item; ?>: <?php echo $val_item; ?>,
                    <?php
                        endforeach;
                    ?>
                },
                <?php
                    endforeach;
                ?>
            },
            <?php
                endif;
            ?>

            <?php
                if(isset($messages) && !empty($messages)):
            ?>
            messages: {
                <?php
                    foreach($messages as $message=>$val_msg):
                ?>
                <?php echo $message; ?>: {
                    <?php
                        foreach($val_msg as $msg_item=>$msg_val_item):
                    ?>
                    <?php echo $msg_item; ?>: "<?php echo $msg_val_item; ?>",
                    <?php
                        endforeach;
                    ?>
                },
                <?php
                    endforeach;
                ?>
            },
            <?php
                endif;
            ?>
            submitHandler: function(form) {
                block_this('<?php echo $div_loader; ?>');

                $.ajax({
                    type : 'POST',
                    url  : $('#<?php echo $form_id; ?>').attr('action'),
                    data  : $('#<?php echo $form_id; ?>').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);

                        <?php
                            if(isset($alert) && $alert !='no'):
                                $div_alert = ($alert=='yes') ? 'msg_alert' : $alert;
                        ?>
                        if(response.status=='sukses' || response.status=='success'){
                            create_alert('<?php echo $div_alert; ?>', response.msg, 'bg-success');
                        } else {
                            create_alert('<?php echo $div_alert; ?>', response.msg, 'bg-danger');
                        }
                        <?php
                            endif;
                        ?>

                        <?php
                            if(isset($cos) && $cos =='yes'):
                        ?>
                        $('.cos').val('');
                        <?php
                            endif;
                        ?>

                        <?php
                            if(isset($datatables_reload) && $datatables_reload !='no' && !is_array($datatables_reload)):
                        ?>
                        $('#<?php echo $datatables_reload; ?>').DataTable().ajax.reload( null, false );
                        <?php
                            endif;
                        ?>
                        <?php 
                            if (!empty($datatables_reload) && is_array($datatables_reload)) :
                                foreach ($datatables_reload as $data_reload) :
                        ?>
                        $('#<?php echo $data_reload; ?>').DataTable().ajax.reload( null, false );
                        <?php 
                                endforeach;
                            endif;
                        ?>
                        unblock_this('<?php echo $div_loader; ?>');
                        <?php
                            if(isset($hide_modal) && $hide_modal =='yes'):
                        ?>
                        $('.modal').modal('hide');
                        <?php
                            endif;
                        ?>
                    },
                    error: function (e, status) {
                        <?php
                            if(isset($datatables_reload) && $datatables_reload =='yes' && !is_array($datatables_reload)):
                        ?>
                        $('#<?php echo $datatables_reload; ?>').DataTable().ajax.reload( null, false );
                        <?php
                            endif;
                        ?>

                        <?php 
                            if (!empty($datatables_reload) && is_array($datatables_reload)) :
                                foreach ($datatables_reload as $data_reload) :
                        ?>
                        $('#<?php echo $data_reload; ?>').DataTable().ajax.reload( null, false );
                        <?php 
                                endforeach;
                            endif;
                        ?>
                        unblock_this('<?php echo $div_loader; ?>');
                        $('.modal').modal('hide');
                    }
                });
                return false;
            }
        });
    });
</script>
