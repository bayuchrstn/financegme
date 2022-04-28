<?php
    // $arr = array();
    // $arr['form_action'] = '';
    // $arr['modal_title'] = $this->lang->line('product_delete');
    // echo $this->ui->load_template('modal_delete', $arr, TRUE);

	$options['modal_icon'] = $this->theme->icon('product_category');
	$options['modal_id'] = 'modal_product_delete';
	$options['form_id'] = 'form_product_category_delete';
	$options['modal_title'] = $this->lang->line('product_category_delete');
	$options['component'] = 'component/modal/modal_delete';
	echo $this->ui->load_component($options);
?>
