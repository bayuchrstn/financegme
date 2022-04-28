
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
			"order": [[ 2, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "subject", "name": "subject", "searchable": true, "orderable": false},
				{"data": "date_start", "name": "date_start", "searchable": false, "orderable": false},
				{"data": "date_due", "searchable": false, "orderable": false},
				{"data": "lokasi", "searchable": false, "orderable": true},
				{"data": "task_category_name", "searchable": false, "orderable": true},
				{"data": "pelaksana", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo base_url(); ?>request/data_task_ts/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>',
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

<script type="text/javascript">
	function select_task_category() {
		var task_category = $('#select_task_category').val();
		task_category = task_category=='all' ? '' : task_category;
		// if (task_category!='all') {
			<?php 
			if(!empty($tabs)):
				foreach($tabs as $tab):
			?>
			$('#js_table_<?php echo $tab['code']; ?>').DataTable({
				retrieve: true
			}).ajax.url('<?php echo base_url(); ?>request/data_task_ts/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>'+task_category).load();
			<?php 
				endforeach; 
			endif; 
			?>
		// }
	}
</script>
