<script type="text/javascript">
	var recordsFiltered = 0, recordsTotal = 0, callback_data;
	var data_url = '<?php echo base_url(); ?>request/data/<?php echo $req_code; ?>/<?php echo $filter; ?>';
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';

		var oTable = $('#js_table_<?php echo $modul['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 2, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false},
				{"data": "marketing_name", "searchable": false, "orderable": false},
				{"data": "date", "searchable": false, "orderable": false},
				{"data": "location", "searchable": false, "orderable": true},
				{"data": "subject", "searchable": true, "orderable": false},
				{"data": "action", "searchable": false, "orderable": false}
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				url: data_url,
				type: 'POST'
			}
		});

		setInterval( function () {
            // $('#js_table_<?php echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
            var rtot = checkDatatables(data_url);
            if (callback_data.recordsTotal > recordsTotal) {
            	recordsTotal = callback_data.recordsTotal;
            	$('#js_table_<?php echo $modul['code']; ?>').DataTable().ajax.reload( null, false );
            }
        }, 3000 );

		$('#search_form').on('keyup change', function(){
          $('#js_table_<?php echo $modul['code']; ?>').dataTable().api().search($(this).val()).draw();
        })
	});

	function checkDatatables(dt_url) {
		// var out = 0;
		$.ajax({
			type: 'GET',
			url : dt_url,
			success: function(res){
				var response = $.parseJSON(res);
				myCallback(response);
			}
		});
		// return out;
	}

	function myCallback(data){
		callback_data = data;
	}
</script>
