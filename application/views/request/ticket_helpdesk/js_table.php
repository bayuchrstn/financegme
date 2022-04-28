
<?php
    if(!empty($tabs)):
        foreach($tabs as $tab):

			if($this->uri->segment(2)=='r'):
				$data_url = base_url().'request/dt/'.$req_code.'/'.$filter;
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
			"order": [[ 2, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
                {"data": "date_start", "name": "date_start", "searchable": false, "orderable": false},
				{"data": "subject", "name": "subject", "searchable": true, "orderable": false},
				{"data": "pembuat", "searchable": false, "orderable": true},
				{"data": "lokasi", "searchable": false, "orderable": true},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				// url: '<?php echo base_url(); ?>request/data_task_ts/<?php echo $req_code; ?>/<?php echo $tab['code']; ?>/<?php echo $filter; ?>',
				url: '<?php echo $data_url; ?>',
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
