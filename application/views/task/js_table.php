

<?php
    $status_task = $this->task_teknis->get_panel_tabs();
    if(!empty($status_task)):
        foreach($status_task as $cat):
?>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';
		var oTable_<?php echo $cat['code']; ?> = $('#js_table_<?php echo $cat['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 1, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "date", "searchable": false, "orderable": false},
				{"data": "author", "searchable": false, "orderable": false},
				{"data": "location", "searchable": false, "orderable": false},
				{"data": "subject", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo base_url(); ?>task/data/<?php echo $cat['code']; ?>/<?php echo $filter; ?>',
				type: 'POST'
			},
		});

		setInterval( function () {
            oTable_<?php echo $cat['code']; ?>.ajax.reload( null, false );
        }, 3000 );


	});
</script>


<?php
        endforeach;
    endif;

?>
