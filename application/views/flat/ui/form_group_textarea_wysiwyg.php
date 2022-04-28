
<?php
    $readonly = (isset($readonly)) ? 'readonly="readonly"' : '';
    $value = (isset($value)) ? $value : '';
    $class = (isset($class)) ? $class : '';
    $rows = (isset($rows)) ? $rows : '2';
    $cols = (isset($cols)) ? $cols : '2';
?>
<div class="form-group">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <textarea class="<?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" rows="<?php echo $rows; ?>" cols="<?php echo $cols; ?>"><?php echo $value; ?></textarea>
    <input type="hidden" class="fake_tinymce" name="<?php echo $name; ?>_fake" id="<?php echo $name; ?>_fake">
</div>
