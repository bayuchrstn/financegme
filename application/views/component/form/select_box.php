
<?php
	$name = (isset($name)) ? $name : '';
    $label = (isset($label)) ? $label : '';
    $ext = (isset($ext)) ? $ext : '';
    $selected = (isset($selected)) ? $selected : '';
    $option = (isset($option)) ? $option : array();
?>
<div class="form-group">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <?php
        echo form_dropdown($name, $option, $selected, $ext);
    ?>
</div>
