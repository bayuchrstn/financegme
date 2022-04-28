
<?php
    $label = (isset($label)) ? $label : '';
    $name = (isset($name)) ? $name : '';
    $id = (isset($id)) ? $id : '';
    $form_ext = (isset($form_ext)) ? $form_ext : '';
    $maxlength = (isset($maxlength)) ? 'maxlength="'.$maxlength.'"' : '';
    $readonly = (isset($readonly) && $readonly !='') ? 'readonly="readonly"' : '';
    $value = (isset($value)) ? $value : '';
    $class = (isset($class)) ? $class : '';
?>
<div class="form-group">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <input <?php echo $form_ext; ?> <?php echo $maxlength; ?> <?php echo $readonly; ?> class="<?php echo $class; ?>" type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
</div>
