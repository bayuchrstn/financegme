<?php
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon($category);
    $arr['modal_id'] = 'modal_master_update';
    $arr['form_id'] = 'form_master_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('all_update').' '.$master_name;

	$default_value['category'] = $category;
	$default_value['master_name'] = $master_name;
	$arr['form_input'] = $this->form_element->get_by_modul('master_update', $default_value, 'update');

    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
