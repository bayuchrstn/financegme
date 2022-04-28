<script type="text/javascript">

    function reload(x)
    {
        alert(x);
        // reload_task_item('<?php echo base_url(); ?>xhr/task_item/index/'+response.table+'/'+response.task_id+'/'+response.prefix+'/'+response.target_div+'/'+response.parent_modul, response.target_div);
    }

    function open_modal_task_item(insert_url, prefix, task_id)
    {
        // alert(insert_url);
        // alert('open_modal_task_item');
        console.log(insert_url);

        if( $('#add_task_item_locker').length && $('#add_task_item_locker').val() !=''  ) {
            var msg_lock = $('#add_task_item_locker').val();
            alert(msg_lock);
            return false;
        }

        $.ajax({
            type:'GET',
            url: insert_url,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

                //jika ingin mengubah modal title
                $('#modal_task_item_insert #modal_title_custom').html(response.modal_title);

                //jika ingin mengubah action form
                $('#modal_task_item_insert #modal_task_item_insert_form').attr('action', response.modal_form_action);

                $('#modal_task_item_insert_div').html(response.konten);
				$('#modal_task_item_insert').modal('show');
            }
        });
    }

    function task_item_update(x)
    {
        // alert(x);
        $.ajax({
            type:'GET',
            url: x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);

                //jika ingin mengubah modal title
                $('#modal_task_item_insert #modal_title_custom').html(response.modal_title);

                //jika ingin mengubah action form
                $('#modal_task_item_insert #modal_task_item_insert_form').attr('action', response.modal_form_action);

                $('#modal_task_item_insert_div').html(response.konten);
                $('#modal_task_item_insert').modal('show');
            }
        });
        return false;
    }

    function task_item_update_cart(x)
    {
        // alert(x);
        $.ajax({
            type:'GET',
            url: x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

                //jika ingin mengubah modal title
                $('#modal_task_item_insert #modal_title_custom').html(response.modal_title);

                //jika ingin mengubah action form
                $('#modal_task_item_insert #modal_task_item_insert_form').attr('action', response.modal_form_action);

                $('#modal_task_item_insert_div').html('').html(response.konten);
                $('#modal_task_item_insert').modal('show');
            }
        });
        return false;
    }

    function task_item_delete(x)
    {
        // alert(x);
        $.ajax({
            type:'GET',
            url: x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                reload_task_item('<?php echo base_url(); ?>xhr/task_item/index/'+response.table+'/'+response.task_id+'/'+response.prefix+'/'+response.target_div+'/'+response.parent_modul, response.target_div);
            }
        });
        return false;
    }

    function task_item_delete_cart(x)
    {
        // alert(x);
        $.ajax({
            type:'GET',
            url: x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                reload_task_item('<?php echo base_url(); ?>xhr/task_item/index/'+response.table+'/'+response.task_id+'/'+response.prefix+'/'+response.target_div+'/'+response.parent_modul, response.target_div);
            }
        });
        return false;
    }

    //global valid------------------------------------------------------------------
    $(document).ajaxComplete(function(){
        $("#modal_task_item_insert_form").validate({
            <?php echo $this->load->view('valid/default', '', TRUE); ?>
            submitHandler: function(form) {

                $.ajax({
                    type : 'POST',
                    url  : $('#modal_task_item_insert_form').attr('action'),
                    data  : $('#modal_task_item_insert_form').serialize(),
                    success : function(res){
                        var response = jQuery.parseJSON(res);
                        // console.log(response); // disable on production!
                        reload_task_item('<?php echo base_url(); ?>xhr/task_item/index/'+response.table+'/'+response.task_id+'/'+response.prefix+'/'+response.target_div+'/'+response.parent_modul, response.target_div);
                        create_alert('form_msg_div', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
                        if (response.status=='success') {
                            $('#modal_task_item_insert').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    });
    //global valid------------------------------------------------------------------

    function reload_task_item(url, div)
    {
        // console.log(url);
        // getajax('<?php echo base_url(); ?>xhr/task_item/index/task_pengadaan/0/insert', 'task_pengadaan_item_div_insert');
        getajax(url, div);
    }

</script>
