<script type="text/javascript">

    function update(x)
    {
        // alert(x);
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>cancel_out/update/'+x,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				console.log(response);
                $('#modal_co_form').attr('action', response.form_action);
                $('#modal_co_form').removeClass().addClass('form-update');
                $('#modal_co_div').html(response.form);
				show_modal('modal_co', 'modal-default', 'Approval Barang Batal Dipasang', '<?php echo $this->theme->icon('ticket_inbox'); ?>');
            }
        });
    }
</script>
