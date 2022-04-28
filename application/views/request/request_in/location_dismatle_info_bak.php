<?php
	// pre($parent_detail);
	// pre($item_transaction);

	$cart = $this->cart->contents();

	$location_name = $this->location->show($parent_detail['location'], $parent_detail['location_id']);
?>
<input type="hidden" name="location" value="<?php echo $parent_detail['location']; ?>">
<input type="hidden" name="location_id" value="<?php echo $parent_detail['location_id']; ?>">

<div class="form-group">
	<label for="">Lokasi</label>
	<input type="text" class="form-control" name="fakename" value="<?php echo $location_name; ?>">
</div>

<div class="table-form-label">
	Daftar barang Terpasang
</div>
<table id="dismantle_barang_terpasang" class="table table-bordered table-form">
	<thead>
		<tr>
			<td>Brand / Category / Nama</td>
			<td>Nomor barang</td>
			<td>Mac Address</td>
			<td width="90" class="text-center">Action</td>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($item_transaction)):
				foreach($item_transaction as $row):
					$item_info = $this->bcn->item_info($row['id_item']);
					$item_detail = $this->item_detail->detail($row['id_item_detail']);
		?>
		<tr>
			<td width="30%"><?php echo $item_info; ?></td>
			<td width="30%"><?php echo $item_detail['nomor_barang']; ?></td>
			<td width="30%"><?php echo $item_detail['mac_address']; ?></td>
			<td class="text-center">
				<a onclick="create_cart_in('<?php echo $row['id_item_detail'] ?>', '<?php echo $item_info ?>', '<?php echo $item_detail['nomor_barang'] ?>', '<?php echo $item_detail['mac_address'] ?>')" class="btn btn-xs btn-danger" href="javascript:void(0)">Kembali</a>
			</td>
		</tr>
		<?php
				endforeach;
			endif;
		?>
	</tbody>
</table>

<?php if(!empty($cart)): ?>
<div class="table-form-label">
	Daftar barang Kembali
</div>
<table class="table table-bordered table-form">
	<thead>
		<tr>
			<td width="8">No</td>
			<td>Brand / Category / Nama</td>
			<td>Nomor barang</td>
			<td>Mac Address</td>
			<td width="90">Kondisi</td>
			<td width="90" class="text-center">Action</td>
		</tr>
	</thead>

	<tbody>
		<?php
			$urut = '1';
			foreach($cart as $row):
		?>
		<tr>
			<td class="text-center">1</td>
			<td><?php echo $row['name']; ?></td>
			<td>sdvsd sdvds</td>
			<td>sdvsd sdvds</td>
			<td>
				<?php
					$arr = array(
							'baik'	=> 'Baik',
							'rusak'	=> 'Rusak'
						);
					echo form_dropdown('sdcs', $arr, '', '');
				?>
			</td>
			<td class="text-center">
				<a onclick="rep()" class="btn btn-xs btn-danger" href="javascript:void(0)">Cancel</a>
			</td>
		</tr>
		<?php
				$urut++;
			endforeach;
		?>
	</tbody>
</table>
<?php endif; ?>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.sErrMode = 'throw';
		var oTable = $('#dismantle_barang_terpasang').DataTable({
			// dom: 't<"datatable-footer"fp>',
			dom: '<"datatable-header datatable-boder-trl"fp><"datatable-scroll"t>',
			// "iDisplayLength": 10,
			"order": [[ 1, "asc" ]],
			"columns": [
				{"searchable": true, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": true, "orderable": false},
				{"searchable": true, "orderable": false}
			],
			// "ajax": {
			// 	url: '<?php echo base_url(); ?>usergroup/data',
			// 	type: 'POST'
			// },
		});

		//auto index
		// oTable.on( 'order.dt search.dt page.dt', function () {
        //     oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //         cell.innerHTML = i+1;
        //     } );
        // } ).draw();

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
