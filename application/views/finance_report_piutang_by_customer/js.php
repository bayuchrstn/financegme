<script type="text/javascript">
    $(document).ready(function() {
        var pageUri = $('#pageUri').val();
        //alert($('#service_id_val').val());
        $("#search_cust").select2({
            placeholder: "Masukan Customer",
            width: "100%",
            ajax: {
                url: pageUri + 'select_customer',
                type: "post",
                dataType: 'json',
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response.hasil
                    };
                    $("#customer_inv").val(response.custid);
                    alert(response.custid);
                },
                cache: true
            }
        });
    });
</script>