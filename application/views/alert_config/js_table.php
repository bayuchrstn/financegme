<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';
		var oTable = $('#js_table_alert_config').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 1, "asc" ]],
			"columns": [
				// {"searchable": false, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
			],
			"ajax": {
				url: '<?php echo base_url(); ?>alert_config/data/',
				type: 'POST'
			},
		});

		//auto index
		oTable.on( 'order.dt search.dt page.dt', function () {
            oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

		//auto load
		// setInterval( function () {
        //     oTable.ajax.reload( null, false );
        // }, 3000 );

		//search form
		$('#search_form').on('keyup change', function(){
          $('#js_table_alert_config').dataTable().api().search($(this).val()).draw();
        })

	});


</script>
