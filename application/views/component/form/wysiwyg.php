
<?php
	$name = (isset($name)) ? $name : '';
	$label = (isset($label)) ? $label : '';
	$class = (isset($class)) ? $class : '';
	$id = (isset($id)) ? $id : '';
	$rows = (isset($rows)) ? $rows : '2';
	$cols = (isset($cols)) ? $cols : '2';
    $value = (isset($value)) ? $value : '';
?>
<div class="form-group">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <textarea class="<?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" rows="<?php echo $rows; ?>" cols="<?php echo $cols; ?>"><?php echo $value; ?></textarea>
	<input type="hidden" class="fake_tinymce cos" name="<?php echo $name; ?>_fake" id="<?php echo $name; ?>_fake_<?php echo $prefix; ?>">
</div>
