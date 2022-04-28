<?php
    // pre(code_generator());
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon($category);
    $arr['modal_id'] = 'modal_master_insert';
    $arr['form_id'] = 'form_master_insert';
    $arr['form_action'] = base_url().'master/insert';
    $arr['modal_title'] = $this->lang->line('all_input').' '.$master_name;
    $arr['form_input_top'] = '<div id="alert_modal_insert"></div>';

    $default_value['category'] = $category;
	$default_value['master_name'] = $master_name;
	$arr['form_input'] = $this->form_element->get_by_modul('master_insert', $default_value, 'insert');
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
?>
