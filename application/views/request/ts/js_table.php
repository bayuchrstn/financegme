<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_marketing_progress').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 2, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "marketing_name", "searchable": false, "orderable": false},
				{"data": "subject", "searchable": true, "orderable": false},
				{"data": "customer_name", "searchable": false, "orderable": true},
				{"data": "date", "searchable": false, "orderable": false},
				{"data": "marketing_progress_category", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo base_url(); ?>request/data/<?php echo $req_code; ?>/<?php echo $filter; ?>',
				type: 'POST'
			}
		});

		// setInterval( function () {
        //     $('#js_table_marketing_progress').DataTable().ajax.reload( null, false );
        // }, 3000 );

		$('#search_form').on('keyup change', function(){
          $('#js_table_marketing_progress').dataTable().api().search($(this).val()).draw();
        })
	});
</script>
