<?php
	$id = (isset($id)) ? $id : '';
	$class = (isset($class)) ? $class : '';
	$name = (isset($name)) ? $name : '';
	$value = (isset($value)) ? $value : '';
	$label = (isset($label)) ? $label : '';
?>

<div class="checkbox">
	<label>
		<input id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" type="checkbox">
		<?php echo $label; ?>
	</label>
</div>
