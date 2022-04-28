<?php

// Usage
// $options = array();
// $options['component'] = 'component/table/table_data_info';
// $options['label_width'] = '150';
// $options['sparator_width'] = '10';
// $options['data_row'] = array();
// $options['data_row'][$this->lang->line('patient_mrid')]					= $patient_data['mrid'];
// $options['data_row'][$this->lang->line('patient_name')]					= $patient_data['name'];
// echo $this->ui->load_component($options);
?>

<?php if(isset($data_row)): ?>
<table class="table_data_info">
    <?php
        foreach($data_row as $label=>$value):
    ?>
    <tr>
        <td valign="top" width="<?php echo $label_width; ?>"><?php echo $label; ?></td>
        <td valign="top" width="<?php echo $sparator_width; ?>">:</td>
        <td valign="top"><?php echo $value; ?></td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php endif; ?>
