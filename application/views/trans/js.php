<script type="text/javascript">

    function input(url)
    {
        $.ajax({
            type:'GET',
            url: url,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                $('#modal_trans_insert_form').attr('action', response.action);
                $('#modal_trans_insert_div').html(response.html);
                $('#modal_trans_insert').modal('show');
            }
        });
        return false;
    }

</script>
