<?php
	// pre($task_detail);
	// pre($report_detail);
	// pre($survey_link_primary);

	$prefix  = 'primary_link';
	$default_value = array();
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	echo $forms_report['primary_link_type'];
	$selected_jenis_primary_link = ( isset($survey_link_primary['jenis']) ) ? $survey_link_primary['jenis'] : 'wr';

	$rid = (empty($report_detail)) ? '0' : $report_detail['id_report'];
?>


<div id="primary_link_div">

</div>

<script type="text/javascript">
	$(document).ready(function(){
		set_option('<?php echo base_url(); ?>select_option/request/my_task/jenis_primary_link_survey', 'primary_link_type_primary_link', '<?php echo $selected_jenis_primary_link; ?>');

		$('#primary_link_type_primary_link').change(function(){
			var jenis_link = $(this).val();
			change_link_type(jenis_link);
		});

		change_link_type('<?php echo $selected_jenis_primary_link; ?>');
	});

	function change_link_type(jenis_link)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>xhr/task_report/link_type_picker/survey/primary/'+jenis_link+'/<?php echo $rid; ?>',
			success: function(res) {
				$('#primary_link_div').html(res);
				set_option('<?php echo base_url(); ?>select_option/request/my_task/jenis_primary_link', 'wireless_bts_primary_link', '');

			}
		});
		return false;
	}

</script>
