<?php
	// pre($modul);
	// pre($prefix);
	// pre($req_code);
	$default_value = array();
	$default_value['task_category'] = $modul['categories'];
	$default_value['status'] = 'request';
	$default_value['req_code'] = $req_code;
	// pre($default_value);
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_task_approval = $this->ui->forms('task_approval', $default_value, $prefix);
	// pre($this->ui->forms_debug($forms));

?>

<!-- <div id="info_approved_<?php echo $prefix; ?>"></div> -->
<!-- <div id="approved_by_<?php echo $prefix; ?>">approved_by_<?php echo $prefix; ?></div> -->

<?php
	// echo $forms_task_approval['approval_status'];
	// echo $forms_task_approval['approval_note'];
	// echo ($prefix == 'update') ? $forms['id'] : '';
?>

<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#detail" data-toggle="tab">Detail BOQ</a></li>
 		<li><a href="#approval" data-toggle="tab">Approval</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="detail">
			dfsgdfgdf
		</div>
		<div class="tab-pane " id="approval">
			dfsgdfgdf
		</div>
	</div>
</div>
