<script type="text/javascript">

    function update_task(id)
    {
        var action = '<?php echo base_url(); ?>task/update/'+id;
        block_this('js_table_task');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_task_update").attr('action', response.action);
                $("#form_task_update #name_update").val(response.name);
                $("#form_task_update #code_update").val(response.code);
                $("#form_task_update #timezone_update").val(response.timezone);
                $("#form_task_update #id_update").val(response.id);
                $('#modal_task_update').modal('show');
                unblock_this('js_table_task');
            }
        });
        return false;
    }

    function delete_task(id)
    {
        var action = '<?php echo base_url(); ?>task/delete/'+id;
        block_this('panel_task');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);


                $("#form_task_delete").attr('action', response.action);
                $("#form_task_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_task_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('panel_task');
            }
        });
        return false;
    }

    function insert_task()
    {
        $('.cos').val('');
        $('#modal_task_insert').modal('show');
        return false;
    }

    $(document).ready(function() {

    });


</script>
