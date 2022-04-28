<?php
    $selected_regional = (isset($selected_regional)) ? $selected_regional : '';
    $selected_area = (isset($selected_area)) ? $selected_area : '';
    $ext_regional = (isset($ext_regional)) ? $ext_regional : '';
    $ext_area = (isset($ext_area)) ? $ext_area : '';
    $arr_regional =  array();
    $arr_area = array();
?>
<div class="form-group">
    <label for="regional"><?php echo $this->lang->line('regional_alltitle'); ?></label>
    <?php
        echo form_dropdown('regional', $arr_regional, $selected_regional, $ext_regional);
    ?>
</div>
<div class="form-group">
    <label for="area"><?php echo $this->lang->line('sub_regional_alltitle'); ?></label>
    <?php
        echo form_dropdown('area', $arr_area, $selected_area, $ext_area);
    ?>
</div>
