<script type="text/javascript">

    function update_supplier(id)
    {
        var action = '<?php echo base_url(); ?>supplier/update/'+id;
        block_this('js_table_supplier');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_supplier_update").attr('action', response.action);
                $("#form_supplier_update #supplier_name_update").val(response.supplier_name);
                $("#form_supplier_update #supplier_address_update").val(response.supplier_address);
                $("#form_supplier_update #supplier_telephone_insert").val(response.supplier_telephone);
                $("#form_supplier_update #id_update").val(response.id);
                $('#modal_supplier_update').modal('show');
                unblock_this('js_table_supplier');
            }
        });
        return false;
    }

    function delete_supplier(id)
    {
        var action = '<?php echo base_url(); ?>supplier/delete/'+id;
        block_this('js_table_supplier');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_supplier_delete").attr('action', response.action);
                $("#form_supplier_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_supplier_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('js_table_supplier');
            }
        });
        return false;
    }

    function insert_supplier()
    {
        $('#modal_supplier_insert').modal('show');
        return false;
    }

</script>
