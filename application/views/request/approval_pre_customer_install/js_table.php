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
			<?php if($tab['code']=='approved'): ?>
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "date_start", "name": "date_start", "searchable": false, "orderable": true},
				{"data": "precustomer_name", "searchable": false, "orderable": false},
				{"data": "marketing_name", "name": "author.name", "searchable": true, "orderable": true},
				{"data": "date_response", "searchable": false, "orderable": false},
				{"data": "author_response", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			<?php elseif($tab['code']=='reject'): ?>
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "date_start", "name":"date_start", "searchable": false, "orderable": true},
				{"data": "precustomer_name", "searchable": false, "orderable": false},
				{"data": "marketing_name", "name": "author.name", "searchable": true, "orderable": true},
				{"data": "date_response", "searchable": false, "orderable": false},
				{"data": "author_response", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			<?php else: ?>
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "date_start", "name": "date_start", "searchable": false, "orderable": true},
				{"data": "precustomer_name", "searchable": false, "orderable": false},
				{"data": "marketing_name", "name": "author.name", "searchable": true, "orderable": true},
				{"data": "action", "searchable": false, "orderable": false}
			],
			<?php endif; ?>
			"processing": true,
			"serverSide": true,
			"ajax": {
				// url: '<?php echo base_url(); ?>request/data/<?php echo $req_code; ?>/<?php echo $filter; ?>',
				url: '<?php echo base_url(); ?>request/dt/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>',
				type: 'POST'
			}
		});

		setInterval( function () {
            $('#js_table_<?php echo $tab['code']; ?>').DataTable().ajax.reload( null, false );
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
