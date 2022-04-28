<script type="text/javascript">

    function update_cuti(id)
    {
        var action = '<?php echo base_url(); ?>cuti/update/'+id;
        block_this('js_table_cuti');
        // set_option('<?=base_url();?>cuti/get_people', 'cuti_people_update','')
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $("#form_cuti_update").attr('action', response.action);
                $("#cuti_people_update").val(response.people_name);
                $("#cuti_date_start_update").val(response.cuti_date_start);
                 $("#cuti_date_end_update").val(response.cuti_date_end);
                $("#form_cuti_update #cuti_note_insert").val(response.cuti_note);
                $("#form_cuti_update #id_update").val(response.id);
                $('#modal_cuti_update').modal('show');
                unblock_this('js_table_cuti');
            }
        });
        return false;
    }

    function update_cuti_status(id,status_id)
    {
        var action = '<?php echo base_url(); ?>cuti/update_status/'+id+'/'+status_id;
        block_this('js_table_cuti');
        // set_option('<?=base_url();?>cuti/get_people', 'cuti_people_update','')
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $('#modal_cuti_status #body_cuti_update_status').empty().append(response.data_info);
                $('#form_cuti_update_status').attr('action',response.action);
                $('#modal_cuti_status').modal('show');
                unblock_this('js_table_cuti');
            }
        });
        return false;
    }

    $('form#form_cuti_update_status').on("submit", function(e){
        e.preventDefault();
        var action = $(this).attr('action');
        var form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            data: form_data,
            url : action,
            success: function(result) {
                var response = $.parseJSON(result);
                // alert(response.msg);
                $('#js_table_cuti').DataTable().ajax.reload( null, false );
                $('#modal_cuti_status').modal('hide');
                create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
    });



    function insert_cuti()
    {
        var category = <?php echo json_encode($cuti_category); ?>;
        $('#modal_cuti_insert').modal('show');
        $('#cuti_category_insert').empty();
        $.each(category, function(i, cat) {
            $('#cuti_category_insert').append(
                $('<option>', {
                    value: cat.cuti_category_id,
                    text: cat.cuti_category_name
                })
            );
        });
        set_option('<?=base_url();?>cuti/get_people', 'karyawan','')
        return false;
    }

    $('form#form_cuti_insert').on("submit", function(e){
        e.preventDefault();
        var action = $(this).attr('action');
        var form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            data: form_data,
            url : action,
            success: function(result) {
                var response = $.parseJSON(result);
                // alert(response.msg);
                $('#js_table_karyawan').DataTable().ajax.reload( null, false );
                create_alert('detail_karyawan_msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
    });
</script>
