<script type="text/javascript">

    function update_category(id)
    {
        var action = '<?php echo base_url(); ?>category/update/'+id;
        block_this('js_table_category');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_category_update").attr('action', response.action);
                $("#form_category_update #category_name_update").val(response.item_categories);
                $("#form_category_update #category_code_update").val(response.code_name);
                $("#form_category_update #id_update").val(response.id);
                $("#form_category_update #category_brand").val(response.up);
                $('#modal_category_update').modal('show');
                unblock_this('js_table_category');
            }
        });
        return false;
    }

    function delete_category(id)
    {
        var action = '<?php echo base_url(); ?>category/delete/'+id;
        block_this('js_table_category');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_category_delete").attr('action', response.action);
                $("#form_category_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_category_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('js_table_category');
            }
        });
        return false;
    }

    function insert_category()
    {
        $('#modal_category_insert').modal('show');
        return false;
    }

</script>
