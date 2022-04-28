<?php
    // pre($modul);
	$default_value = array();
	$prefix = 'insert';
	$forms = $this->ui->forms('trans', $default_value, $prefix);
	echo $forms['transaction_date'];

    if($modul['flag_due_date']=='y'):
       echo $forms['transaction_due_date'];
    endif;

    echo $forms['number'];

    if($modul['flag_title']=='y'):
       echo $forms['title'];
    endif;
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

        if( $('.datetime_picker').length ) {

            $( ".datetime_picker" ).datetimepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });
        }

    });
</script>
