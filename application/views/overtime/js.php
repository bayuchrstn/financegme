<script type="text/javascript">

    function update_overtime(id)
    {
        var action = '<?php echo base_url(); ?>overtime/update/'+id;
        block_this('js_table_overtime');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                var red = ((response.red!=null) ? response.red : '0');
                var task_id = ((response.task_id!=null) ? response.task_id : '');
                var start = ((response.start!=null) ? response.start : '');
                var finish = ((response.finish!=null) ? response.finish : '');
                var note = ((response.note!=null) ? response.note : '');
                var red_date = ((response.red_date!=null) ? response.red_date : '');
                var shift = ((response.shift!=null) ? response.shift : '');
                var oncall = ((response.oncall!=null) ? response.oncall : '');

                cek_red_update(red);

                set_option('<?=base_url();?>overtime/get_my_task', 'overtime_task_update',response.task_id);

                $("#form_overtime_update").attr('action', response.action);
                $("#form_overtime_update #overtime_red_update").val(red);
                $("#form_overtime_update #overtime_red_date_update").val(red_date);
                $("#form_overtime_update #overtime_shift_update").val(shift);
                $("#form_overtime_update #overtime_task_update").val(task_id);
                $("#form_overtime_update #overtime_oncall_update").val(oncall);
                $("#form_overtime_update #overtime_start_update").val(start);
                $("#form_overtime_update #overtime_finish_update").val(finish);
                $("#form_overtime_update #overtime_note_update").val(note);
                $("#form_overtime_update #id_update").val(response.id);
                $('#modal_overtime_update').modal('show');
                unblock_this('js_table_overtime');
            }
        });

        $('#overtime_red_update').change(function(){
            var red = $(this).val();
            cek_red_update(red);
        });

        return false;
    }

    function delete_overtime(id)
    {
        var action = '<?php echo base_url(); ?>overtime/delete/'+id;
        block_this('js_table_overtime');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_overtime_delete").attr('action', response.action);
                $("#form_overtime_delete #delete_id").val(response.id);
                $('#data_info_delete').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_overtime_delete').modal('show');
                if(response.removable=='no'){
                    $('#modal_delete_footer').addClass('hide_me');
                } else {
                    $('#modal_delete_footer').removeClass('hide_me');
                }
                unblock_this('js_table_overtime');
            }
        });
        return false;
    }

    function approve_overtime(id)
    {
        var action = '<?php echo base_url(); ?>overtime/approve/'+id;
        block_this('js_table_overtime');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $("#form_overtime_approve").attr('action', response.action);
                $("#form_overtime_approve #approve_id").val(response.id);
                $('#data_info_approve').html('').append(response.data_info);
                $('#remove_confirm').html('').append(response.remove_confirm);
                $('#modal_overtime_approve').modal('show');
                if(response.removable=='no'){
                    $('#modal_approve_footer').addClass('hide_me');
                } else {
                    $('#modal_approve_footer').removeClass('hide_me');
                }
                unblock_this('js_table_overtime');
            }
        });
        return false;
    }
    function detail_overtime(id)
    {
        var action = '<?php echo base_url(); ?>overtime/data_detail/'+id;
        block_this('js_table_overtime');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);

                $('#overtime_data_detail').html('').append(response.data_info);
                $('#modal_overtime_detail').modal('show');
                unblock_this('js_table_overtime');
            }
        });
        return false;
    }

    function insert_overtime()
    {
        set_option('<?=base_url();?>overtime/get_my_task', 'overtime_task_insert','');
        $('#modal_overtime_insert').modal('show');
        cek_red_insert(0);
        $('#overtime_red_insert').change(function(){
            var red = $(this).val();
            cek_red_insert(red);
        });
        return false;
    }

    function cek_red_insert(red) {
        if (red=='0') {
            $('#overtime_red_date_insert').parent().hide();
            $('#overtime_shift_insert').parent().hide();
            $('#overtime_task_insert').parent().show();
            $('#overtime_oncall_insert').parent().show();
            $('#overtime_start_insert').parent().show();
            $('#overtime_finish_insert').parent().show();
        } else {
            $('#overtime_red_date_insert').parent().show();
            $('#overtime_shift_insert').parent().show();
            $('#overtime_task_insert').parent().hide();
            $('#overtime_oncall_insert').parent().hide();
            $('#overtime_start_insert').parent().hide();
            $('#overtime_finish_insert').parent().hide();
        }
    }
    function cek_red_update(red) {
        if (red=='0') {
            $('#overtime_red_date_update').parent().hide();
            $('#overtime_shift_update').parent().hide();
            $('#overtime_task_update').parent().show();
            $('#overtime_oncall_update').parent().show();
            $('#overtime_start_update').parent().show();
            $('#overtime_finish_update').parent().show();
        } else {
            $('#overtime_red_date_update').parent().show();
            $('#overtime_shift_update').parent().show();
            $('#overtime_task_update').parent().hide();
            $('#overtime_oncall_update').parent().hide();
            $('#overtime_start_update').parent().hide();
            $('#overtime_finish_update').parent().hide();
        }
    }

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
