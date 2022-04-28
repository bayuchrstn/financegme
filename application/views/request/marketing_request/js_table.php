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
				{"data": "id",	"searchable": false, "orderable": false, "name":"id"},
				{"data": "date", "searchable": false, "orderable": true, "name":"task_marketing_request.date_request_start"},
				{"data": "marketing_name", "searchable": true, "orderable": true, "name":"marketing.name"},
				{"data": "customer_name", "searchable": false, "orderable": false, "name":"customer_name"},
				{"data": "subject", "searchable": true, "orderable": false, "name":"subject"},
				{"data": "action", "searchable": false, "orderable": false, "name":"action"}
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
