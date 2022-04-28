<script type="text/javascript">
    $.fn.dataTableExt.sErrMode = 'throw';
    <?php
        // pre($datatables);
    ?>
    $(document).ready(function() {

        <?php
            if(!empty($datatables)):
                foreach($datatables as $table):
                    // pre($table);
        ?>
        var oTable_<?php echo $table['table_id']; ?> = $('#<?php echo $table['table_id']; ?>').DataTable({
            aoColumns:<?php echo $table['aocolumns']; ?>,
            "iDisplayLength": <?php echo $table['per_page']; ?>,
			"rowReorder": true,
            "order": [[ <?php echo $table['sorting']['column']; ?>, "<?php echo $table['sorting']['sorting_mode']; ?>" ]],
            dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
            "ajax": '<?php echo $table['data_url']; ?>',
            "autoWidth": false,
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				// console.log(aData[1]);
				$(nRow).attr("id", 'alarmNum' + aData[1]);
        		return nRow;
		    }

        });

        oTable_<?php echo $table['table_id']; ?>.on( 'order.dt search.dt', function () {
            oTable_<?php echo $table['table_id']; ?>.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();





        <?php
            if($table['refresh'] !='0'):
        ?>
        setInterval( function () {
            oTable_<?php echo $table['table_id']; ?>.ajax.reload( null, false );
        }, <?php echo $table['refresh']; ?> );
        <?php
            endif;
        ?>

        $('.search_form').on('keyup change', function(){
          $('#<?php echo $table['table_id']; ?>').dataTable().api().search($(this).val()).draw();
        })

        <?php
                endforeach;
            endif;
        ?>
    });
</script>
