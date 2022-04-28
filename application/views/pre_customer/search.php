<?php

$default_value = array();
// $default_value['gender'] = $this->master->arr('gender');
// $default_value['pekerjaan'] = $this->master->arr('pekerjaan');
$forms_left = $this->ui->load_form_element_by_section('customer_search', 'main', $default_value);

$grid = '<div class="row">';
$grid .= '<div class="col-lg-12">';
$grid .= $this->ui->var_this_array($forms_left);
$grid .= '</div>';
$grid .= '</div>';

$options['component'] = 'component/modal/modal_form';
$options['modal_id'] = 'modal_search';
$options['modal_size'] = 'modal-xs';
$options['modal_icon'] = 'icon-search4';
$options['modal_title'] = 'Advanced Search';
$options['form_id'] = 'form_customer_search';
$options['form_action'] = base_url().'poe';
$options['main_content'] = '<div id="focus_main_content_div">'.$grid.'</div>';
echo $this->ui->load_component($options);
?>
