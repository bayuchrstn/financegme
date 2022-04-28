<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	// $default_value = array();
	// $default_value['task_category'] = $modul['categories'];
	// $default_value['status'] = 'request';
	// $default_value['req_code'] = $req_code;
	// // pre($default_value);
	// $forms = $this->ui->forms('task', $default_value, $prefix);
	// $forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	// $forms_task_approval = $this->ui->forms('task_approval', $default_value, $prefix);
	// // pre($this->ui->forms_debug($forms));

?>

<?php
$options = array();
$options['component'] = 'component/tab/tab_default';
$options['tab_id'] = 'tab1s'.$prefix;
$options['tab_padding'] = 'no';
$options['max'] = '8';
$options['selected_tab'] = 'detail_po_'.$prefix;
$options['tabs'] = array();

$options['tabs'][] = array(
		'label'         => 'Detail PO',
		'id'            => 'detail_po_'.$prefix,
		'content'       => '<div id="detail_po_div_'.$prefix.'">s</div>',
	);

$options['tabs'][] = array(
		'label'         => 'Approval',
		'id'            => 'approval_po_'.$prefix,
		'content'       => '<div id="approval_div_'.$prefix.'"></div>',
	);
$content = $this->ui->load_component($options);
echo $content;
?>
