<script type="text/javascript">

    function update_item(id)
    {
        var action = '<?php echo base_url(); ?>item/update/'+id;

        block_this('js_table_item');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_item_update #item_category").empty();
                $.each(response.arr_category,function(key,val){
                  $("#form_item_update #item_category").append(
                    $('<option>',{
                      value : key,
                      text : val
                    }));
                });
                $("#form_item_update").attr('action', response.action);
                $("#form_item_update #item_brand").val(response.brand);
                $("#form_item_update #item_category").val(response.category_id);
                $("#form_item_update #item_name").val(response.item_name);
                $("#form_item_update #item_code").val(response.code_name);
                $("#form_item_update #item_jumlah").val(response.jumlah);
                $("#form_item_update #id_update").val(response.id);
                $('#modal_item_update').modal('show');
                unblock_this('js_table_item');
            }
        });
        $('#form_item_update #item_brand').change(function(){
            block_this('modal_item_update');
            var id_brand = $(this).val();
            var action = '<?php echo base_url(); ?>item/get_category/'+id_brand;
            $.ajax({
                type:'GET',
                url: action,
                success: function(res) {
                  var response = jQuery.parseJSON(res);
                  $("#form_item_update").attr('action', response.action);
                  $("#form_item_update #item_category").empty();
                  $.each(response,function(key,val){
                    $("#form_item_update #item_category").append(
                      $('<option>',{
                        value : key,
                        text : val
                      }));
                  });
                  $('#modal_item_update').modal('show');
                  unblock_this('modal_item_update');
                }
            });
        });
        return false;
    }

    function delete_item(id)
    {
        var action = '<?php echo base_url(); ?>item/delete/'+id;
        block_this('js_table_item');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_item_delete").attr('action', response.action);
                $("#form_item_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_item_delete').modal('show');
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

    function insert_item()
    {
        $('#modal_item_insert').modal('show');
        $('#form_item_insert #item_brand').change(function(){
            block_this('modal_item_insert');
            var id_brand = $(this).val();
            var action = '<?php echo base_url(); ?>item/get_category/'+id_brand;
            $.ajax({
                type:'GET',
                url: action,
                success: function(res) {
                    var response = jQuery.parseJSON(res);
                    $("#form_item_insert").attr('action', response.action);
                    $("#form_item_insert #item_category").empty();
                    $.each(response,function(key,val){
                      $("#form_item_insert #item_category").append(
                        $('<option>',{
                          value : key,
                          text : val
                        }));
                    });
                    $('#modal_item_insert').modal('show');
                    unblock_this('modal_item_insert');
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
</script>
