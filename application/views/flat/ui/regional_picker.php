<?php
    $selected_regional = (isset($selected_regional)) ? $selected_regional : '';
    $ext_regional = (isset($ext_regional)) ? $ext_regional : '';
    $arr_regional =  $this->regional->arr_regional();
?>
<div class="form-group">
    <label for="regional"><?php echo $this->lang->line('regional_alltitle'); ?></label>
    <?php
        echo form_dropdown('regional', $arr_regional, $selected_regional, $ext_regional);
    ?>
</div>
