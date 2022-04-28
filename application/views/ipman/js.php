<script type="text/javascript">

    function update_ipman(id)
    {
        var action = '<?php echo base_url(); ?>ipman/update/'+id;
        block_this('js_table_ipman');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_ipman_update").attr('action', response.action);
                $("#form_ipman_update #ipman_name_update").val(response.ipman_name);
                $("#form_ipman_update #ipman_address_update").val(response.ipman_address);
                $("#form_ipman_update #ipman_note_insert").val(response.ipman_note);
                $("#form_ipman_update #id_update").val(response.id);
                $('#modal_ipman_update').modal('show');
                unblock_this('js_table_ipman');
            }
        });
        return false;
    }


    function insert_ipman()
    {
        $('#modal_ipman_insert').modal('show');
        return false;
    }

    function detail_ipman(ip,netmask=32) {
        var action = '<?=base_url();?>ipman/detail/'+ip+'/'+netmask
        $.ajax({
            type: 'GET',
            url : action,
            success: function(res){
                var response = $.parseJSON(res);
                append = '<div class="row">';
                append += '<div class="col-md-12">';

                /*
                append += '<div class="form_group">';
                append += '<label class="display-block text-semibold">'+response.ip_head+'</label>';
                append += '<label class="checkbox-inline" style="display:none;"></label>';
                $.each(response.ip_tail, function(i, data){
                    append += '<label class="checkbox-inline" title="'+response.ip_head+data+'">';
                    append += '<input type="checkbox" name="select_ip[]" value="'+response.ip_head+data+'">'+data+'';
                    append += '</label>';
                });
                append += '</div></div></div>';
                */

                append += '<p><b>'+response.ip_head+'</b></p>';
                append += '<div class="table-responsive">';
                append += '<table class="table table-xxs">';
                // append += '<thead><tr><td colspan="16">List IP: '++'</td></tr></thead>';
                append += '<tbody>';
                $.each(response.ip_tail, function(i, data){
                    disable = i==0 || i==response.ip_tail.length-1 ? 'checked disabled' : 'name="select_ip[]"';
                    if ((i+1)%16 == 1) append += '<tr>';
                    append += '<td><label class="checkbox-inline" title="'+response.ip_head+data+'"><input type="checkbox" value="'+response.ip_head+data+'" '+disable+'>'+data+'</label></td>';
                    if ((i+1)%16 == 0) append += '</tr>';
                });
                append += '</tbody>';
                append += '</table>';
                append += '</div></div></div>';
                $('#modal_ipman_detail_body').html('');
                $('#modal_ipman_detail_body').append(append);
                $('#modal_ipman_detail').modal('show');
            }
        });
    }

</script>