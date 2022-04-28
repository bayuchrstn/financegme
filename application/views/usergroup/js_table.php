<?php
    // $arr = array();
    // $arr['table_id'] = 'js_table_usergroup';
    // $arr['data_url'] = base_url().'usergroup/data/';
    // $arr['refresh'] = '30000';
    // $arr['search_form_id'] = 'search_form';
    // $arr['per_page'] = '10';
    // $column = array(
    //         array('bSortable' => false),
    //         array('bSortable' => false),
    //         array('bSortable' => false),
    //     );
    // $arr['aocolumns']= json_encode($column);
    //
    // $arr['sorting'] = array(
    //     'column'        => '1',
    //     'sorting_mode'  => 'asc'
    // );
    // echo $this->ui->load_template('js_datatables',$arr);
?>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';
		var oTable = $('#js_table_usergroup').DataTable({
			"dom": '<"datatable-scroll"t><"datatable-footer"ip>',
			"iDisplayLength": 10,
			"order": [[ 1, "asc" ]],
			"columns": [
				{"searchable": false, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": false, "orderable": false}
			],
			"ajax": {
				url: '<?php echo base_url(); ?>usergroup/data/<?php echo $category; ?>/<?php echo $category_id; ?>',
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
		$('#search_form').on('keyup change', function(){
          $('#js_table_usergroup').dataTable().api().search($(this).val()).draw();
        })

	});


</script>
