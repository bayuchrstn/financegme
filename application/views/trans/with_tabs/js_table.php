<?php
    if(!empty($tabs)):
        foreach($tabs as $tab):

			if($this->uri->segment(2)=='r'):
				$data_url = base_url().'request/data_report/'.$req_code.'/'.$filter;
			else:
				$data_url = base_url().'request/dt/'.$req_code.'/'.$tab['code'].'/'.$filter;
			endif;
?>
<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $tab['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 0, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "date", "searchable": false, "orderable": false},
				{"data": "author_name", "name": "author_name", "searchable": true, "orderable": false},
				{"data": "lokasi", "searchable": false, "orderable": true},
				{"data": "subject", "name": "subject", "searchable": true, "orderable": false},
			// 	{"data": "marketing_progress_category", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: '<?php echo $data_url; ?>',
				type: 'POST'
			}
		});

		// setInterval( function () {
        //     $('#js_table_<?php echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
        // }, 30000 );
        //
		// $('#search_form').on('keyup change', function(){
        //   $('#js_table_<?php echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        // })
	});
</script>

<?php
        endforeach;
    endif;
?>
