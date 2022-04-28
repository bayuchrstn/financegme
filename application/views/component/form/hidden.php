
<?php
    $id = (isset($id)) ? 'id="'.$id.'"' : '';
    $value = (isset($value)) ? $value : '';
    $name = (isset($name)) ? $name : '';
?>
<input type="hidden" <?php echo $id; ?> name="<?php echo $name; ?>" value="<?php echo $value; ?>">
