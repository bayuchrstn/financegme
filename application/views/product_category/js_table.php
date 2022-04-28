<script type="text/javascript">
	$(document).ready(function() {
	   $.fn.dataTableExt.sErrMode = 'throw';

	   var oTable = $('#js_table_product_category').DataTable({
		   aoColumns:[
			   {"bSortable":false},
			   {"bSortable":false},
			   {"bSortable":false}
		   ],
		   "iDisplayLength": 10,
		   "order": [[ 1, "asc" ]],
		   dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
		   "ajax": '<?php echo base_url(); ?>product_category/data'
	   });


	   oTable.on( 'order.dt search.dt', function () {
		   oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			   cell.innerHTML = i+1;
		   } );
	   } ).draw();

			   setInterval( function () {
		   oTable.ajax.reload( null, false );
	   }, 30000 );

			   $('#search_form').on('keyup change', function(){
		 $('#js_table_kit').dataTable().api().search($(this).val()).draw();
	   })
	});
</script>
