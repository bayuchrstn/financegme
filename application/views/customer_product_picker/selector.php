<tr>
	<td width="30" class="text-center">
		<?php if($flag_packet=='Y'): ?>
		<input type="checkbox" <?php echo $checked; ?> name="product_code[]" value="<?php echo $code; ?>">
		<?php else: ?>
		<input type="radio" <?php echo $checked; ?> name="product_code[]" value="<?php echo $code; ?>">
		<?php endif; ?>
	</td>
	<td>
		<div class="pname">
			<?php echo $name; ?>
			<?php //echo $codeeee; ?>
		</div>
	</td>

	<?php
	 	//jika bukan fix price
		if($flag_fixprice=='N'):
	?>

	<td width="100">
		<input type="text" name="product_value[<?php echo $code; ?>]" value="<?php echo $current_val; ?>" class="form-control" placeholder="Value">
	</td>
	<td width="80">
		<!-- <select class="form-control" name="satuan_bandwith[<?php echo $code; ?>]">
			<option value="Mbps">Mbps</option>
			<option value="Kbps">Kbps</option>
		</select> -->
		<?php
			$arr_sat = array(
				'Mbps'	=> 'Mbps',
				'Kbps'	=> 'Kbps',
			);
			echo form_dropdown('satuan_bandwith['.$code.']', $arr_sat, $current_satuan);
		?>
	</td>
	<td width="100">
		<input type="text" name="product_price[<?php echo $code; ?>]" value="<?php echo $current_price; ?>" class="form-control duit" placeholder="Harga">
	</td>
	<?php
		else:
	?>
	<td colspan="3">
		<div class="fixprice_info_div">
			<input type="hidden" name="product_value[<?php echo $code; ?>]" value="<?php echo $value; ?>">
			<input type="hidden" name="satuan_bandwith[<?php echo $code; ?>]" value="<?php echo $satuan_bandwidth; ?>">
			<input type="hidden" name="product_price[<?php echo $code; ?>]" value="<?php echo $price; ?>">
			<?php echo $note; ?>
		</div>
	</td>
	<?php
		endif;
	?>

</tr>