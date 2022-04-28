<script type="text/javascript">
    $(document).ready(function(){
        $('.modal').on('shown.bs.modal', function () {
            //pakai selector id atau class juga bisa
            $('.select-chosen').chosen('destroy').chosen();
        });
    });
    $(function(){
        // $('#category_insert').chosen({});
        $('.price').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', precision:0});
    });

    function update_item_detail(id)
    {
        var action = '<?php echo base_url(); ?>item_detail/update/'+id;

        block_this('js_table_item');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                /*
                $("#form_item_detail_update #item_category").empty();
                $.each(response.arr_category,function(i,category){
                  $("#form_item_detail_update #item_category").append(
                    $('<option>',{
                      value : category.id,
                      text : category.name
                    }));
                });
                $.each(response.arr_item,function(key,val){
                  $("#form_item_detail_update #item_item").append(
                    $('<option>',{
                      value : key,
                      text : val
                    }));
                });
                $("#form_item_detail_update #item_brand").val(response.brand_id);
                $("#form_item_detail_update #item_category").val(response.category_id);
                $("#form_item_detail_update #item_item").val(response.id_item);
                */
                $("#form_item_detail_update").attr('action', response.action);
                $("#form_item_detail_update #item_company_update").val(response.flag_company);
                $("#form_item_detail_update #item_klasifikasi_update").val(response.klasifikasi);
                $("#form_item_detail_update #item_code_update").val(response.code_name);
                $("#form_item_detail_update #item_no_item_update").val(response.nomor_barang);
                $("#form_item_detail_update #item_mac_update").val(response.mac_address);
                $("#form_item_detail_update #item_barcode_update").val(response.barcode);
                $("#form_item_detail_update #item_supplier_update").val(response.supplier_id);
                $("#form_item_detail_update #item_price_update").val(response.price);
                $("#form_item_detail_update #item_invoice_update").val(response.invoice_number);
                $("#form_item_detail_update #item_date_buy_update").val(response.buy_date);
                $("#form_item_detail_update #item_warranty_update").val(response.warranty);
				$("#form_item_detail_update #item_detail_status").val(response.item_status);
                $("#form_item_detail_update #item_note_update").val(response.note);

                $("#form_item_detail_update #id_update").val(response.id);
                $('#modal_item_detail_update').modal('show');
                unblock_this('js_table_item');
            }
        });

        return false;
    }

    function delete_item_detail(id)
    {
        var action = '<?php echo base_url(); ?>item_detail/delete/'+id;
        block_this('js_table_item');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_item_detail_delete").attr('action', response.action);
                $("#form_item_detail_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_item_detail_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('js_table_item');
            }
        });
        return false;
    }

    function changeStatusItem(id, from, to) {
        block_this('js_table_item'); // func.js asset

        function getItemDetail(id, cb) {
            var url = '<?php echo base_url(); ?>item_detail/update/' + id;

            $.ajax({ type: 'GET', url, success: function(res) {
                    cb(jQuery.parseJSON(res));
                }
            });
        }

        function putItemDetail(id, d, cb) {
            var url = '<?php echo base_url(); ?>item_detail/update/' + id;

            var data = {
                'item_company_update': d.flag_company,
                'item_no_item_update': d.nomor_barang,
                'item_mac_update': d.mac_address,
                'item_barcode_update': d.barcode,
                'item_price_update': d.price,
                'item_invoice_update': d.invoice_number,
                'item_supplier_update': d.supplier_id,
                'item_date_buy_update': d.buy_date,
                'item_warranty_update': d.warranty,
                'item_status_update': to,
                'item_note_update': d.note,
                'id': d.id
            };

            $.ajax({ type:'POST', url, data, success: function(res) {
                    cb(jQuery.parseJSON(res));
                }
            });
        }

        getItemDetail(id, function(data) {
            putItemDetail(id, data, function(res) {
                $(`#js_table_${from}`).DataTable().ajax.reload();
                $(`#js_table_${to}`).DataTable().ajax.reload();

                unblock_this('js_table_item'); // func.js asset
            });
        });

        return false;
    }

    function insert_item()
    {
        $('#modal_item_detail_insert').modal('show');
        $('#form_item_detail_insert #item_brand').change(function(){
            block_this('modal_item_detail_insert');
            var id_brand = $(this).val();
            var action = '<?php echo base_url(); ?>item_detail/get_category/'+id_brand;
            $.ajax({
                type:'GET',
                url: action,
                success: function(res) {
                    var response = jQuery.parseJSON(res);
                    $("#form_item_detail_insert").attr('action', response.action);

                    $("#form_item_detail_insert #item_category").chosen('destroy');
                    $("#form_item_detail_insert #item_category").empty();
                    $.each(response.category,function(i,category){
                      $("#form_item_detail_insert #item_category").append(
                        $('<option>',{
                          value : category.id,
                          text : category.name
                        }));
                    });
                    $("#form_item_detail_insert #item_category").chosen();

                    $("#form_item_detail_insert #item_item").empty();
                    $.each(response.item,function(key,val){
                      $("#form_item_detail_insert #item_item").append(
                        $('<option>',{
                          value : key,
                          text : val
                        }));
                    });

                    $("#form_item_detail_insert #item_no_item").val(response.code);
                    $('#modal_item_detail_insert').modal('show');
                    unblock_this('modal_item_detail_insert');
                }
            });
        });

        $('#form_item_detail_insert #item_category').change(function(){
            block_this('modal_item_detail_insert');
            var id_cat = $(this).val();
            var action = '<?php echo base_url(); ?>item_detail/get_item_category/'+id_cat;
            $.ajax({
                type:'GET',
                url: action,
                success: function(res) {
                    var response = jQuery.parseJSON(res);
                    $("#form_item_detail_insert").attr('action', response.action);
                    $("#form_item_detail_insert #item_item").empty();
                    $.each(response.item,function(key,val){
                      $("#form_item_detail_insert #item_item").append(
                        $('<option>',{
                          value : key,
                          text : val
                        }));
                    });
                    $("#form_item_detail_insert #item_no_item").val(response.code);
                    $('#modal_item_detail_insert').modal('show');
                    unblock_this('modal_item_detail_insert');
                }
            });
        });

        $('#form_item_detail_insert #item_item').change(function(){
            block_this('modal_item_detail_insert');
            var id_cat = $("#item_category").val();
            var action = '<?php echo base_url(); ?>item_detail/get_item_category/'+id_cat;
            $.ajax({
                type:'GET',
                url: action,
                success: function(res) {
                    var response = jQuery.parseJSON(res);
                    $("#form_item_detail_insert #item_no_item").val(response.code);
                }
            });
        });

        return false;
    };

    $('input.number').keyup(function(event) {
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;
      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        // .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        ;
      });
    });

    $('input#item_mac_update').on('change', function(){
        var n = $(this).val();
        var id_up = $('input#id_update').val();
        if (n!='') {
            $.ajax({
                type: 'POST',
                url : '<?=base_url()?>item_detail/mac_check_edit',
                data: {mac_address: n, id: id_up},
                success: function(res){
                    var response = $.parseJSON(res);
                    if (response.status!='success') {
                        alert(response.message);
                        return false;
                    } else {
                        return true;
                    }
                }
            });
        } else {
            return true;
        }
    });
    $('input#item_mac').on('change', function(){
        var n = $(this).val();
        if (n!='') {
            $.ajax({
                type: 'POST',
                url : '<?=base_url()?>item_detail/mac_check_edit',
                data: {mac_address: n, id: '0'},
                success: function(res){
                    var response = $.parseJSON(res);
                    if (response.status!='success') {
                        alert(response.message);
                        return false;
                    } else {
                        return true;
                    }
                }
            });
        } else {
            return true;
        }
    });


</script>
