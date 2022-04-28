<?php
    if(!empty($tabs)):
        foreach($tabs as $tab):
?>
<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $tab['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 2, "asc" ]],
			"columns": [
				{"data": "urut", "name": "id", "searchable": false, "orderable": false},
				{"data": "customer_name", "name": "customer.customer_name", "searchable": true, "orderable": false},
				{"data": "date_start", "name": "trial.date_request_start", "searchable": false, "orderable": true},
				{"data": "date_end", "name": "trial.date_request_end", "searchable": false, "orderable": true},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo base_url(); ?>request/dt/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>',
				type: 'POST'
			}
		});

		// setInterval( function () {
        //     $('#js_table_<?php echo $tab['code']; ?>').DataTable().ajax.reload( null, false );
        // }, 3000 );

		$('.search_form').on('keyup change', function(){
          $('#js_table_<?php echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        })
	});
</script>

<?php
        endforeach;
    endif;
?>
