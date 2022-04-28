<script type="text/javascript">
    function update_tab(sel)
    {
        $.ajax({
            type: "GET",
            url: '<?php echo base_url(); ?>setting/tabby/'+sel,
        }).done(function( response ) {
            $('#tab_div').html(response);
        });
    }

    $(document).ready(function(){
        $('#form_update').submit(function(){
            $.ajax({
                type: "POST",
                url: $('#form_update').attr('action'),
                data: $('#form_update').serialize(),
            }).done(function( res ) {
                var response = jQuery.parseJSON(res);

                if(response.status=='sukses'){
                    create_alert('msg_alert', response.msg, 'bg-success');
                } else {
                    create_alert('msg_alert', response.msg, 'bg-danger');
                }
                $("html, body").animate({ scrollTop: 0 }, "slow");
            });
            return false;
        });
    });
</script>
