<?php
    if(!empty($tabs)):
        foreach($tabs as $tab):
            $data_url = base_url().'request/dt/'.$req_code.'/'.$tab['code'].'/'.$filter;
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
				{"data": "date", "searchable": false, "orderable": false},
				{"data": "author", "searchable": false, "orderable": false},
				{"data": "location", "searchable": false, "orderable": true},
				{"data": "detail", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				// url: '<?php echo base_url(); ?>request/dt/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>',
                url: '<?php echo $data_url; ?>',
                type: 'POST'
			}
		});

		setInterval( function () {
            $('#js_table_<?php echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
        }, 30000 );

		$('#search_form').on('keyup change', function(){
          $('#js_table_<?php echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        })
	});
</script>

<?php
        endforeach;
    endif;
?>
