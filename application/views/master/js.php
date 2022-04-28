<script type="text/javascript">

    function input_master()
    {
        $('.cos').val('');
        $('#modal_master_insert').modal('show');
    }

    function update_master(id)
    {
        var action = '<?php echo base_url(); ?>master/update/'+id;

        block_this('js_table_master');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                
                $("#form_master_update").attr('action', response.action);
                $("#form_master_update #input_name_update").val(response.name);
                $("#form_master_update #input_note_update_update").val(response.note);
                $("#form_master_update #id_update").val(response.id);
                $('#modal_master_update').modal('show');
                unblock_this('js_table_master');
            }
        });
        return false;
    }

    function delete_master(id)
    {
        var action = '<?php echo base_url(); ?>master/delete/'+id;

        block_this('js_table_master');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                

                $("#form_master_delete").attr('action', response.action);
                $("#form_master_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_master_delete').modal('show');
                unblock_this('js_table_master');
            }
        });
        return false;
    }

</script>
