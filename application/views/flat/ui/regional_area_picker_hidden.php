
<?php
    $regional_id = (isset($regional_id)) ? $regional_id : '';
    $area_id = (isset($area_id)) ? $area_id : '';

    $regional_value = (isset($regional_value)) ? $regional_value : '';
    $area_value = (isset($area_value)) ? $area_value : '';
?>
<input type="hidden" id="<?php echo $regional_id; ?>" name="regional" value="<?php echo $regional_value; ?>">
<input type="hidden" id="<?php echo $area_id;  ?>" name="area" value="<?php echo $area_value; ?>">
