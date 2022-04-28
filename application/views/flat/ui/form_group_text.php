
<?php
    $label = (isset($label)) ? $label : '';
    $name = (isset($name)) ? $name : '';
    $id = (isset($id)) ? $id : '';
    $maxlength = (isset($maxlength)) ? 'maxlength="'.$maxlength.'"' : '';
    $readonly = (isset($readonly)) ? 'readonly="readonly"' : '';
    $value = (isset($value)) ? $value : '';
    $class = (isset($class)) ? $class : '';
?>
<div class="form-group">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <input <?php //echo $readonly; ?> <?php echo $maxlength; ?> class="<?php echo $class; ?>" type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
</div>
