<?php
	$data = array();
	$data['prefix'] = 'insert';
	// $default_value = array();
	// $forms_main = $this->ui->load_form_element_by_section('product_category_insert', 'main', $default_value);
	// $form_main = '';
	// $form_main .= $this->ui->var_this_array($forms_main);
	// $options['component'] = 'component/grid/12';
	// $options['columns'] = array($form_main);
	// $grid = $this->ui->load_component($options);

	$options['component'] = 'component/modal/modal_form';
	$options['modal_id'] = 'modal_product_category_insert';
	$options['modal_size'] = 'modal-default';
	$options['modal_icon'] = $this->theme->icon('product_category');
	$options['modal_title'] = $this->lang->line('product_category_insert');
	$options['form_id'] = 'form_product_category_insert';
	$options['form_action'] = base_url().'product_category/insert';
	$options['main_content'] = $this->load->view('product_category/form_grid', $data, TRUE);
	echo $this->ui->load_component($options);
?>
