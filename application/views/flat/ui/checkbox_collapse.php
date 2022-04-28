
<?php
	$checked = (isset($checked) && $checked=='yes') ? 'checked="checked"' : '';
	$value = (isset($value)) ? $value : '';
	$name = (isset($name)) ? $name : '';
	$class = (isset($class)) ? $class : '';
    $id = (isset($id)) ? $id : '';
    $label = (isset($id)) ? $label : '';
    $collapse_target = (isset($collapse_target)) ? $collapse_target : '';
?>
<div class="checkbox">
	<label data-toggle="collapse" data-target="#<?php echo $collapse_target ?>">
		<input <?php echo $checked; ?> type="checkbox" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" id="<?php echo $id; ?>">
		<?php echo $label; ?>
	</label>
</div>
