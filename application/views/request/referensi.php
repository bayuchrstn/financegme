<?php
	// pre($prefix);
	// pre($refmode);
	// pre($what);
	// pre($arr_ref);

	if(isset($selected_task)):
		$task_title = $selected_task['subject'];
	else:
		$task_title = '';
	endif;

	switch ($what) {
		case 'boq':
			$label = 'Laporan Hasil Survey';
		break;

		case 'request_out':
			$label = 'Pekerjaan Installasi';
		break;

		//request barang masuk
		default:
			$label = 'Referensi Pekerjaan';
		break;
	}

?>

<div class="row">
	<div class="col-lg-10">
		<div class="form-group">
			<label for=""><?php echo $label; ?></label>
			<?php if($refmode=='insert'): ?>
				<?php echo form_dropdown('up_select', $arr_ref, '', 'class="form-control chosen" id="up_select_'.$prefix.'"'); ?>
			<?php else: ?>
				<input type="text" class="form-control" name="up_select_subject" id="up_select_subject" value="">
				<input type="hidden" name="up_select" id="up_select_<?php echo $prefix; ?>" value="">
			<?php endif; ?>
		</div>
	</div>

	<div class="col-lg-2">
		<div class="form-group">
			<label>&nbsp;</label>
			<a href="javascript:void(0);" onclick="view_ref('<?php echo $prefix; ?>')" class="btn btn-warning btn-block">View</a>
		</div>
	</div>
</div>
