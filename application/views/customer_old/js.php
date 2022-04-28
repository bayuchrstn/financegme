<script type="text/javascript">

    //product picker js
    $('.panel-heading a').on('click',function(e){
        if($(this).parents('.panel').children('.panel-collapse').hasClass('in')){
            e.stopPropagation();
        }
    });

    $('#accordion-control').on('show.bs.collapse', function (x) {
        // $(".all").attr("checked", false);
        $(".all").removeAttr('checked');
    });
    //product picker js

    $('.chosen').chosen();

    $(function(){
        product_picker('wh');
    });

    function product_picker(category)
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>product/show_product_by_category/'+category,
            success: function(res) {
                $('.product_lists_div').html(res);
            }
        });
        return false;
    }

    function new_customer_mode(mode)
    {
        $('#main_form_insert').addClass('hidden');
        var existing_customer = $('#existing_customer_picker').val();
        block_this('input_mode_table');
        $.ajax({
            type:'POST',
            data:{'mode':mode, 'existing_customer':existing_customer},
            url: '<?php echo base_url(); ?>customer/new_customer_mode',
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#main_form_insert #customer_id_insert").val(response.customer_id);
                $("#main_form_insert #customer_name_insert").val(response.customer_name);
                $("#main_form_insert #customer_address_insert").val(response.customer_address);
                $("#main_form_insert #customer_address_insert").val(response.customer_address);

                unblock_this('input_mode_table');
                $('#main_form_insert').removeClass('hidden');
            }
        });
        return false;
    }

    $('#modal_customer_insert').on('shown.bs.modal', function () {
        $('#existing_customer_picker', this).chosen();
    });


    jQuery(function($) { $('#password_insert').pwstrength(); });
    jQuery(function($) { $('#password_update').pwstrength(); });

    function set_product(id)
    {
        $('.product_checkbox').prop('checked', false);
        var action = '<?php echo base_url(); ?>customer/set_product/'+id;
        block_this('body_loader');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_customer_product").attr('action', response.action);
                $("#form_customer_product #name_info").val(response.name);
                $("#form_customer_product #id_customer_product").val(response.id);
                $('#modal_customer_product').modal('show');
                // alert(response.products);

                $('#customer_info_div').html('').append(response.data_info);

                // var arr = [];
                $.each(response.products, function( index, value ) {
                    //console.log(value);
                    // arr.push(value);
                    $('#'+value).prop('checked', true);
                });

                // $('#code_product').multiselect('select', arr);
                // $('#code_product').multiselect('select', ['cascascasc1479009493', 'WSFMQ1479640931']),

                unblock_this('body_loader');
            }
        });
        return false;
    }

    function update_customer(id)
    {
        var action = '<?php echo base_url(); ?>customer/update/'+id;
        block_this('js_table_customer');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                console.log(response);

                $("#form_customer_update").attr('action', response.action);
                $("#form_customer_update #customer_name_update").val(response.customer_name);
                $("#form_customer_update #customer_address_update").val(response.customer_address);
                // $("#form_customer_update #email_update").val(response.email);
                // $("#form_customer_update #username_update").val(response.username);
                // $("#form_customer_update #status_update").val(response.status);
                // $("#form_customer_update #customer_note_update").val(response.note);
                // $("#form_customer_update #password_update").val('');
                $("#form_customer_update #id_update").val(response.id);
                $('#modal_customer_update').modal('show');
                unblock_this('js_table_customer');
            }
        });
        return false;
    }

    function delete_customer(id)
    {
        var action = '<?php echo base_url(); ?>customer/delete/'+id;

        block_this('js_table_customer');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                console.log(response);
                $("#form_customer_delete").attr('action', response.action);
                $("#form_customer_delete #delete_id").val(response.id);

                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_customer_delete').modal('show');

                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }

                unblock_this('js_table_customer');
            }
        });
        return false;
    }


    function insert_customer()
    {
        $('#main_form_insert').addClass('hidden');
        $('.cos').val('');
        $('#modal_customer_insert').modal('show');
        return false;
    }

</script>
