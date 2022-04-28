<?php
    $default_value = array();
    $prefix = 'update';
    $forms = $this->ui->forms('email', $default_value, $prefix);
    echo $forms['name'];
    echo $forms['receiver'];
    echo $forms['id'];
?>
