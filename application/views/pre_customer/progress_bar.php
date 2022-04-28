<!-- <a onclick="input_marketing_progress('<?php echo $pre_customer_id; ?>');" href="javascript:void(0);"> -->

	<?php
		$options['component'] = 'component/progress_bar/progress_bar_default';
		$options['prosentase'] = $prosentase;
		echo $this->ui->load_component($options);
	?>
<!-- </a> -->
