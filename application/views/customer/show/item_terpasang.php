<?php
	// pre($item_terpasang);
?>
<table class="table table-bordered table-striped" id="customer_item_show">
	<thead class="border-top border-top-grey-300">
		<tr>
			<th class="text-center" width="8">#</th>
			<th>BRAND / KATEGORI / NAMA</th>
			<th>Nomor Barang / Mac Address</th>
		</tr>
	</thead>
	<?php
		if(!empty($item_terpasang)):
	?>
	<tbody>
		<?php
			foreach($item_terpasang as $row):
				// pre($row);
				$item_info = $this->bcn->item_info($row['id_item']);
				$nomor_barang = $this->bcn->item_detail_info($row['id_item_detail']);
		?>
		<tr>
			<td class="text-center">#</td>
			<td><?php echo $item_info; ?></td>
			<td><?php echo $nomor_barang; ?></td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
	<?php
		endif;
	?>
</table>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';
		var oTable = $('#customer_item_show').DataTable({
			dom: 't<"datatable-footer"fp>',
			// "iDisplayLength": 10,
			"order": [[ 1, "asc" ]],
			"columns": [
				{"searchable": false, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": true, "orderable": false}
			],
			// "ajax": {
			// 	url: '<?php echo base_url(); ?>usergroup/data',
			// 	type: 'POST'
			// },
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
        //   $('#js_table_usergroup').dataTable().api().search($(this).val()).draw();
        // })

	});


</script>
