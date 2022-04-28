<?php
	if($this->uri->segment(2)=='r'):
		$data_url = base_url().'request/data_report/'.$req_code.'/'.$filter;
	else:
		$data_url = base_url().'request/data/'.$req_code.'/'.$filter;
	endif;
?>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $modul['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 1, "desc" ]],
			"columns": [
				{"data": "urut", "searchable": false, "orderable": false},
				{"data": "date", "name" : "date_start", "searchable": false, "orderable": true},
				{"data": "marketing_name", "name": "marketing.name", "searchable": true, "orderable": true},
				{"data": "customer_name", "name": "pre_customer.customer_name", "searchable": true, "orderable": true},
				{"data": "subject", "name": "subject", "searchable": true, "orderable": false},
				{"data": "marketing_progress_category", "searchable": false, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				// url: '<?php echo base_url(); ?>request/data/<?php echo $req_code; ?>/<?php echo $filter; ?>',
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
