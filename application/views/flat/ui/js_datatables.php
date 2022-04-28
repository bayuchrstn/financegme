<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.sErrMode = 'throw';

        var oTable = $('#<?php echo $table_id; ?>').DataTable({
            aoColumns:<?php echo $aocolumns; ?>,
            "iDisplayLength": <?php echo $per_page; ?>,
            "order": [[ <?php echo $sorting['column']; ?>, "<?php echo $sorting['sorting_mode']; ?>" ]],
            dom: '<"datatable-scroll"t><"datatable-footer"ip>',
            "ajax": '<?php echo $data_url; ?>',
			keys: true
        });


        oTable.on( 'order.dt search.dt', function () {
            oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        <?php
            if($refresh !='0'):
        ?>
        setInterval( function () {
            oTable.ajax.reload( null, false );
        }, <?php echo $refresh; ?> );
        <?php
            endif;
        ?>

        <?php
            if($search_form_id !=''):
        ?>
        $('#<?php echo $search_form_id; ?>').on('keyup change', function(){
          $('#<?php echo $table_id; ?>').dataTable().api().search($(this).val()).draw();
        })
        <?php
            endif;
        ?>
    });
</script>
