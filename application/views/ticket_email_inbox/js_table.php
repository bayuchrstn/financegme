<?php
if(!empty($tabs)):
	foreach($tabs as $tab):

	$data_url = base_url().'ticket_email_inbox/data/'.$tab['code'];
	$columns = $this->ticket_email->js_table();
?>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $tab['code']; ?>').DataTable({
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
			$('#js_table_<?php echo $tab['code']; ?>').DataTable().ajax.reload( null, false );
		}, 30000 );

		$('#search_form').on('keyup change', function(){
        	('#js_table_<?php echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        });

	});
</script>

<?php
        endforeach;
    endif;
?>
