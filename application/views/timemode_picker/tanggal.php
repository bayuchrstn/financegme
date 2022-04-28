<?php
    if(isset($selected_data)):
        $value = $selected_data;
    else:
        $value = date('Y-m-d');
    endif;
?>

<div class="form-group">
    <input type="text" class="form-control date_picker" name="tmp_tanggal" value="<?php echo $value; ?>">
</div>

<script type="text/javascript">
$(document).ready(function(){
    $(function() {
        if( $('.date_picker').length ) {

            $( ".date_picker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
        }

    });
});
</script>
