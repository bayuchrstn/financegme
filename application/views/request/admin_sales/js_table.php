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
			"order": [[ 1, "desc" ]],
			"columns": [
				{"data": "id", "searchable": false, "orderable": false, "name":"id"},
				{"data": "date", "searchable": false, "orderable": true, "name":"tanggal_request"},
				{"data": "marketing_name", "searchable": true, "orderable": false, "name":"marketing.name"},
				{
					"data": null, 
					"searchable": true, 
					"orderable": true, 
					"name":"customer_name",
					"render": function(data, type, row, meta){
						return '<a onclick="show_customer('+data.customer_id+')" href="javascript:void(0);">'+data.customer_name+"</a>";
					}
				},
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
