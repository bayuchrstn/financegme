<script type="text/javascript">

    function update(user_id)
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>email/update/'+user_id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                console.log(response);
                $("#modal_email_form").attr('action', response.action);
                $("#modal_email_form #name_update").val(response.name);
                $("#modal_email_form #receiver_update").val(response.receiver);
                $("#modal_email_form #id_update").val(response.id);

                $('#modal_email').modal('show');
            }
        });
        return false;
    }

</script>
