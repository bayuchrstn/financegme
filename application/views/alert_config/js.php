<script type="text/javascript">

    function update(id)
    {
        $.ajax({
            type:'GET',
            url: '<?php echo base_url(); ?>alert_config/update/'+id,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                // console.log(response);
                
                $('#modal_alert_config_form').attr('action', '<?php echo base_url('alert_config/update/'); ?>'+id);
                $('#modal_alert_config_div').html(response.html);
                $('#modal_alert_config').modal('show');
            }
        });
        return false;
    }


</script>
