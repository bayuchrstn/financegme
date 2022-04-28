<script type="text/javascript">

    function delete_notification(id)
    {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>alert/delete',
            data: {'alert_id':id},
            success: function(res) {
                var response = jQuery.parseJSON(res);
                create_alert('msg_alert', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
            }
        });
        return false;
    }


</script>
