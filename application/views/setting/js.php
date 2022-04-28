<script type="text/javascript">
    $(function(){
        $.ajax({
            type: "GET",
            url: '<?php echo base_url(); ?>setting/tabby/general',
        }).done(function( response ) {
            $('#tab_div').html(response);
        });

        $('#newcat').hide();
    });

    function select_this(tab)
    {
        // console.log(tab);
        $('#selected_setting').val(tab);
    }
    
</script>
