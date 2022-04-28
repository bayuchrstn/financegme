<?php
	$cart = $this->cart->contents();
?>

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
