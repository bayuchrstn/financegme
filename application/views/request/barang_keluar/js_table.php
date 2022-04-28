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
			"order": [[ 4, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "author","name": "author.name", "searchable": true, "orderable": true},
				{"data": "task_ref_title", "name": "task.subject", "searchable": true, "orderable": false},
				{"data": "location", "name": "customer.customer_name", "searchable": true, "orderable": false},
				{"data": "date", "name": "task.date_start", "searchable": false, "orderable": true},
				{"data": "detail", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo base_url(); ?>request/dt/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>',
				type: 'POST'
			}
		});

		setInterval( function () {
            $('#js_table_<?php echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
        }, 30000 );

		$('.search_form').on('keyup change', function(){
          $('#js_table_<?php echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        })
	});
</script>

<?php
        endforeach;
    endif;
?>
