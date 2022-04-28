<?php
	// pre($arr_filter);
	if(isset($arr_filter['my_data']) && $arr_filter['my_data']=='1'):
		$checked = 'checked="checked"';
	else:
		$checked = '';
	endif;
?>
<form id="form_owner_filter" class="heading-form" action="<?php echo base_url(); ?>poe" method="post">
	<div class="form-group">
		<div class="checkbox checkbox-switch">
			<label>
				<input name="my_data" value='1' type="checkbox" data-on-text="Data Saya" data-off-text="Semua Data" class="switch" <?php echo $checked; ?>>
			</label>
		</div>
		<input type="hidden" name="telo" value="kaspo">
		<input type="hidden" name="gembus" value="kasasfdsfpo">
		<input type="hidden" name="filtered_page" value="<?php echo base_url(); ?>marketing_progress/index/">
	</div>
	<!-- <input type="submit" name="submit" value="kirim"> -->
</form>
