<script type="text/javascript">

    function update_product_category(id)
    {
        var action = '<?php echo base_url(); ?>product_category/update/'+id;
        block_this('panel_product');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);
                $("#form_product_category_update").attr('action', response.action);
                $("#form_product_category_update #name_update").val(response.name);
				set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_packet_update', response.flag_packet);
				set_option('<?php echo base_url(); ?>select_option/regional', 'regional_update', response.regional);
                $("#form_product_category_update #id_update").val(response.id);

                $('#modal_product_category_update').modal('show');
                unblock_this('panel_product');
            }
        });
        return false;
    }

    function delete_product_category(id)
    {
        var action = '<?php echo base_url(); ?>product_category/delete/'+id;
        block_this('panel_product');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_product_category_delete").attr('action', response.action);
                $("#form_product_category_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#modal_product_delete').modal('show');
                unblock_this('panel_product');
            }
        });
        return false;
    }

    function insert_product_category()
    {
		set_option('<?php echo base_url(); ?>select_option/yesno', 'flag_packet_insert', 'N');
		set_option('<?php echo base_url(); ?>select_option/regional', 'regional_insert', '');
        $('#modal_product_category_insert').modal('show');
        return false;
    }

    $(document).ready(function() {

    });


</script>
