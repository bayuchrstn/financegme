<?php
    $default_value = array();
    $forms_task_marketing_request = $this->ui->forms('task_marketing_request', $default_value, $prefix);
    echo $forms_task_marketing_request['date_request_start'];
?>

<script type="text/javascript">
$(function() {
    if( $('.date_picker').length ) {

        $( ".date_picker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    }
});
</script>
