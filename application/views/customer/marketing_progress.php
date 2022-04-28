<?php
	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_marketing_progress_insert';
	$options['modal_size'] = 'modal-standasrt';
	$options['modal_icon'] = $this->theme->icon('pre_customer');
	$options['modal_title'] = $this->lang->line('marketing_progress_insert_title');
	$options['form_id'] = 'form_marketing_progress_insert';
	$options['form_action'] = base_url().'marketing_progress/insert';
	$options['main_content'] = '';
	echo $this->ui->load_component($options);
?>
