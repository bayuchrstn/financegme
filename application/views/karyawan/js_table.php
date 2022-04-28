<script type="text/javascript">
    $(document).ready(function(){
		$.fn.dataTableExt.sErrMode = 'throw';
        var oTable = $('#js_table_karyawan').DataTable({
			// dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
            aoColumns:[
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false, "visible": false},
				{"searchable": true, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
				{"searchable": false, "orderable": false},
			],
            "iDisplayLength": 10,
            "order": [[ 1, "asc" ]],
			"ajax": {
				url: '<?php echo base_url(); ?>karyawan/data',
				type: 'POST'
			},
        });

		//auto index
		oTable.on( 'order.dt search.dt page.dt', function () {
            oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

		$('#search_form').on('keyup change', function(){
          $('#js_table_karyawan').dataTable().api().search($(this).val()).draw();
        })
    });
</script>
