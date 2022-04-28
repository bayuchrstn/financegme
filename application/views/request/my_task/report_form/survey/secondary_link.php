<?php
	// pre($task_detail);
	// pre($report_detail);
	// pre($survey_link_secondary);


	$prefix  = 'secondary_link';
	$default_value = array();
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);
	echo $forms_report['secondary_link_type'];
	$selected_jenis_secondary_link = ( isset($survey_link_secondary['jenis']) ) ? $survey_link_secondary['jenis'] : 'tidak_ada';
	$rid = (empty($report_detail)) ? '0' : $report_detail['id_report'];
?>


<div id="secondary_link_div">

</div>

<script type="text/javascript">
    $(document).ready(function(){
        set_option('<?php echo base_url(); ?>select_option/request/my_task/jenis_secondary_link_survey', 'secondary_link_type_secondary_link', '<?php echo $selected_jenis_secondary_link; ?>');

        $('#secondary_link_type_secondary_link').change(function(){
            var jenis_link = $(this).val();
            // alert(jenis_link);
            change_secondary_link_type(jenis_link);
        });

        change_secondary_link_type('<?php echo $selected_jenis_secondary_link; ?>');
    });

    function change_secondary_link_type(jenis_link)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>xhr/task_report/link_type_picker/survey/secondary/'+jenis_link+'/<?php echo $rid; ?>',
			success: function(res) {
				$('#secondary_link_div').html(res);
				// set_option('<?php //echo base_url(); ?>select_option/request/my_task/jenis_primary_link', 'wireless_bts_primary_link', '');

			}
		});
		return false;
	}
</script>
