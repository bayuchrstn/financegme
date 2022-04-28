<script type="text/javascript">
    $('#category_insert').chosen();
    $('#category_update').chosen();

	// $('.collapse').collapse('hide');
	// $('#collapse_price_insert').collapse('hide');


	$(function(){
        $('.price').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', precision:0});
    });

    function update_product(id)
    {
        var action = '<?php echo base_url(); ?>product/update/'+id;
        block_this('panel_product');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                $("#form_product_update").attr('action', response.action);
                $("#form_product_update #name_update").val(response.name);
                $("#form_product_update #category_update").val(response.category);
                $("#form_product_update #price_update").val(response.price);
                $("#form_product_update #note_update").val(response.note);
                $("#form_product_update #invoice_label_update").val(response.invoice_label);
                $("#form_product_update #value_update").val(response.value);
                $("#form_product_update #satuan_bandwith_update").val(response.satuan_bandwidth);
                // $("#form_product_update #flag_fixprice_update").val(response.flag_fixprice);
                $("#form_product_update #id_update").val(response.id);

				if(response.flag_fixprice=='Y'){
					$("#flag_fixprice_update").prop('checked',true);
					$('#collapse_price_update').collapse('show');
				} else {
					$("#flag_fixprice_update").prop('checked', false);
					$('#collapse_price_update').collapse('hide');
				}

                $('#modal_product_update').modal('show');
                unblock_this('panel_product');
            }
        });
        return false;
    }

    function delete_product(id)
    {
        var action = '<?php echo base_url(); ?>product/delete/'+id;
        block_this('panel_product');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_product_delete").attr('action', response.action);
                $("#form_product_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_product_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('panel_product');
            }
        });
        return false;
    }

    function input_product()
    {
		$("#flag_fixprice_insert").prop('checked', false);
		$('#collapse_price_insert').collapse('hide');

        $('.cos').val('');
        $('#modal_product_insert').modal('show');
        return false;
    }

    $(document).ready(function() {

    });


</script>
