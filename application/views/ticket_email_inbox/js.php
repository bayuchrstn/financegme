<script type="text/javascript">

    function open_ticket(x)
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>ticket_email_inbox/open_ticket/'+x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                $('#modal_timbox_form').attr('action', response.form_action);
                $('#modal_timbox_div').html(response.form);
				show_modal('modal_timbox', 'modal-lg', 'Open Ticket', '<?php echo $this->theme->icon('ticket_inbox'); ?>');
            }
        });

    }

</script>
