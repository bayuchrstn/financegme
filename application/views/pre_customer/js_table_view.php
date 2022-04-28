<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_pre_customer').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 1, "asc" ]],
			"columns": [
				{"data": "id", "name": "id", "orderable": false, "searchable": false},
				{"data": "customer_name", "name": "customer_name", "searchable": true},
				{"data": "customer_address", "name": "customer_address", "searchable": true, "orderable": false},
				{"data": "contact_person", "name": "contact_person", "searchable": true, "orderable": false},
				{"data": "telephone_work", "name": "telephone_work", "searchable": true, "orderable": false},
				{"data": "mp_bar", "name": "mp_bar", "searchable": false, "orderable": false},
				{"data": "action", "action": "index", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			// "keys": true,
			"ajax": {
				url: '<?php echo base_url(); ?>pre_customer/data_view',
				type: 'POST'
			},
			render: function (data, type, row, meta) {
		        return meta.row + meta.settings._iDisplayStart + 1;
		    }
		});

		// oTable.on( 'order.dt search.dt page.dt', function () {
        //     oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //         cell.innerHTML = i+1;
        //     } );
        // } ).draw();

		// setInterval( function () {
        //     oTable.ajax.reload( null, false );
        // }, 3000 );

		$('#search_form').on('keyup change', function(){
          $('#js_table_pre_customer').dataTable().api().search($(this).val()).draw();
        })
	});
</script>
