<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $trans_code; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			// "order": [[ 0, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
                {"data": "number", "searchable": false, "orderable": false},
                {"data": "transaction_date", "searchable": false, "orderable": false},
                <?php if($modul['flag_due_date']=='y'): ?>
                {"data": "transaction_due_date", "searchable": false, "orderable": false},
                <?php endif; ?>
                <?php if($modul['flag_title']=='y'): ?>
                {"data": "title", "searchable": false, "orderable": false},
                <?php endif; ?>
                {"data": "amount", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo base_url('trans/data/'.$trans_code.'/'.$filter); ?>',
				type: 'POST'
			}
		});

		// setInterval( function () {
        //     $('#js_table_<?php //echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
        // }, 30000 );
        //
		// $('#search_form').on('keyup change', function(){
        //   $('#js_table_<?php //echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        // })
	});
</script>
