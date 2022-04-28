<script type="text/javascript">
    $(document).ready(function(){
        var oTable_js_table_1 = $('#js_table_1').DataTable({
            aoColumns:[{"bSortable":false},{"bSortable":true},{"bSortable":false}],
            "iDisplayLength": 10,
            "order": [[ 1, "asc" ]],
            dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
            "ajax": 'http://localhost/appx/cli/data',
            "autoWidth": false,
        });

        var oTable_js_table_2 = $('#js_table_2').DataTable({
            aoColumns:[{"bSortable":false},{"bSortable":true},{"bSortable":false}],
            "iDisplayLength": 10,
            "order": [[ 1, "asc" ]],
            dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
            "ajax": 'http://localhost/appx/cli/data',
            "autoWidth": false,
        });
    });
</script>
