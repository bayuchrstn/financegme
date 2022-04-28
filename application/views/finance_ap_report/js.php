<script type="text/javascript">
    $(function() {
        function get_supplier() {
            var pageUri = $('#pageUri').val();
            $("#supplier").select2({
                placeholder: "Masukan Nama Supplier",
                width: "100%",
                ajax: {
                    url: pageUri + 'get_supplier',
                    type: "post",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response

                        };
                    },
                    cache: false
                }
            });
        };
        get_supplier();
    });
</script>