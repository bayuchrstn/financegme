
<?php
    $label = (isset($label)) ? $label : '';
    $name = (isset($name)) ? $name : '';
    $id = (isset($id)) ? $id : '';
    $maxlength = (isset($maxlength)) ? 'maxlength="'.$maxlength.'"' : '';
    $readonly = (isset($readonly)) ? 'readonly="readonly"' : '';
    $value = (isset($value)) ? $value : '';
    $class = (isset($class)) ? $class : '';
    $pwindicator = (isset($pwindicator)) ? $pwindicator : 'pwindicator';
?>
<div class="form-group">
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <div class="label-indicator-absolute">

        <input data-indicator="<?php echo $pwindicator; ?>" <?php echo $maxlength; ?> class="<?php echo $class; ?>" type="password" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
        <div id="<?php echo $pwindicator; ?>">
            <div class="bar"></div>
            <span class="label password-indicator-label-absolute"></span>
        </div>
    </div>
</div>
