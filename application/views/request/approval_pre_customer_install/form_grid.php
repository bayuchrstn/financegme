<?php
// $data = array();
// $options = array();
// $options['component'] = 'component/tab/tab_default';
// $options['tab_id'] = 'tab1_'.$prefix;
// $options['tab_padding'] = 'no';
// $options['max'] = '8';
// $options['selected_tab'] = 'form_approval_'.$prefix;
// $options['tabs'] = array();
//
// $options['tabs'][] = array(
// 		'label'         => 'Form Approval',
// 		'id'            => 'form_approval_'.$prefix,
// 		'content'       => $this->load->view('request/approval_pre_customer_install/form_grid_approval', $data, TRUE),
// 	);
//
// $options['tabs'][] = array(
// 		'label'         => 'Marketing Progress Info',
// 		'id'            => 'marketing_progress_info_'.$prefix,
// 		'content'       => '<div id="info_request_'.$prefix.'"></div>',
// 	);
// $options['tabs'][] = array(
// 		'label'         => 'Detail Pre Customer',
// 		'id'            => 'detail_precustomer_'.$prefix,
// 		'content'       => '<div id="detail_precustomer_'.$prefix.'"></div>',
// 	);
//
//
// $content = $this->ui->load_component($options);
// echo $content;
?>

<?php
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$forms = $this->ui->forms('task_hidden', $default_value, $prefix);
	$form_task_marketing_approval = $this->ui->forms('task_marketing_approval', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));
	// pre($this->ui->forms_debug($form_task_marketing_approval));

	echo $forms['task_category'];

	echo $forms['subject'];
	echo $forms['body_fake'];
	echo $forms['id'];


	echo $form_task_marketing_approval['status'];
	echo $form_task_marketing_approval['note'];
?>

<div class="form-group">
	<label>Attachment</label>
    <input type="hidden" name="attachment" value="true" />
    <div id="attachment_list_<?=$prefix;?>"></div>
    <a class="btn btn-warning btn-xs attachment-add_update" onclick="addAttachmentInput()" href="javascript:void(0);">Tambah</a> <!-- attachment-add_update != id -->
</div>
