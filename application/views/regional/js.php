<script type="text/javascript">

    function update_regional(id)
    {
        var action = '<?php echo base_url(); ?>regional/update/'+id;
        block_this('js_table_regional');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_regional_update").attr('action', response.action);
                $("#form_regional_update #name_update").val(response.name);
                $("#form_regional_update #code_update").val(response.code);
                $("#form_regional_update #timezone_update").val(response.timezone);
                $("#form_regional_update #id_update").val(response.id);
                $('#modal_regional_update').modal('show');
                unblock_this('js_table_regional');
            }
        });
        return false;
    }

    function delete_regional(id)
    {
        var action = '<?php echo base_url(); ?>regional/delete/'+id;
        block_this('panel_regional');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_regional_delete").attr('action', response.action);
                $("#form_regional_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_regional_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('panel_regional');
            }
        });
        return false;
    }

    function insert_regional()
    {
        $('.cos').val('');
        $('#modal_regional_insert').modal('show');
        return false;
    }

    $(document).ready(function() {

    });


</script>
