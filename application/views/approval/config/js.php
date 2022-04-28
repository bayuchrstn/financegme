<script type="text/javascript">

    function update(x)
    {
        // alert(x);
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>approval/update/'+x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                $('#modal_appr_form').attr('action', response.form_action);
                $('#modal_appr_form').removeClass().addClass('form-update');
                $('#modal_appr_div').html(response.form);
				show_modal('modal_appr', 'modal-default', 'Update Approval', '<?php echo $this->theme->icon('ticket_inbox'); ?>');
            }
        });
    }

    function input()
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>approval/insert/',
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                $('#modal_appr_form').attr('action', response.form_action);
                $('#modal_appr_form').removeClass().addClass('form-input');
                $('#modal_appr_div').html(response.form);
                show_modal('modal_appr', 'modal-default', 'Input Approval', '<?php echo $this->theme->icon('ticket_inbox'); ?>');
            }
        });

    }
</script>
