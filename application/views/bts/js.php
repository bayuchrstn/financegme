<script type="text/javascript">

    function update_bts(id)
    {
        var action = '<?php echo base_url(); ?>bts/update/'+id;
        block_this('js_table_bts');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_bts_update").attr('action', response.action);
                $("#form_bts_update #bts_name_update").val(response.bts_name);
                $("#form_bts_update #bts_address_update").val(response.bts_address);
                $("#form_bts_update #bts_note_insert").val(response.bts_note);
                $("#form_bts_update #id_update").val(response.id);
                $('#modal_bts_update').modal('show');
                unblock_this('js_table_bts');
            }
        });
        return false;
    }


    function insert_bts()
    {
        $('#modal_bts_insert').modal('show');
        return false;
    }

</script>
