<?php
    if(!empty($tabs)):
        foreach($tabs as $tab):

			$data_url = base_url().'email/data/'.$tab['code'];

?>
<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';
		var oTable = $('#js_table_<?php echo $tab['code']; ?>').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 1, "asc" ]],
			"columns": [
				{"searchable": false, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": false, "orderable": false, "bVisible": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
			],
			"ajax": {
				url: '<?php echo $data_url; ?>',
				type: 'POST'
			},
		});

		//auto index
		oTable.on( 'order.dt search.dt page.dt', function () {
            oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

		//auto load
		// setInterval( function () {
        //     oTable.ajax.reload( null, false );
        // }, 3000 );

		//search form
		// $('#search_form').on('keyup change', function(){
        //   $('#js_table_user').dataTable().api().search($(this).val()).draw();
        // })

	});


</script>

<?php
        endforeach;
    endif;
?>
