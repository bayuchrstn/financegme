<?php
	$data_url = base_url().'report/data/'.$req_code.'/'.$filter;
	$columns = $this->roadrunner->js_table($what);
?>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $modul['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 2, "desc" ]],
			"columns": <?php echo $columns; ?>,
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo $data_url; ?>',
				type: 'POST'
			}
		});

		setInterval( function () {
            $('#js_table_<?php echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
        }, 30000 );

		$('#search_form').on('keyup change', function(){
          $('#js_table_<?php echo $modul['code']; ?>').dataTable().api().search($(this).val()).draw();
        })
	});
</script>
