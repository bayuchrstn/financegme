<script type="text/javascript">

    function update_brand(id)
    {
        var action = '<?php echo base_url(); ?>brand/update/'+id;
        block_this('js_table_brand');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_brand_update").attr('action', response.action);
                $("#form_brand_update #brand_name_update").val(response.item_categories);
                $("#form_brand_update #brand_code_update").val(response.code_name);
                $("#form_brand_update #id_update").val(response.id);
                $('#modal_brand_update').modal('show');
                unblock_this('js_table_brand');
            }
        });
        return false;
    }

    function delete_brand(id)
    {
        var action = '<?php echo base_url(); ?>brand/delete/'+id;
        block_this('js_table_brand');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_brand_delete").attr('action', response.action);
                $("#form_brand_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_brand_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('js_table_brand');
            }
        });
        return false;
    }

    function insert_brand()
    {
        $('#modal_brand_insert').modal('show');
        return false;
    }

</script>
