<?php if(isset($info)): ?>
<table class="table_data_info">
    <?php
        foreach($info as $label=>$value):
    ?>
    <tr>
        <td valign="top" width="<?php echo $label_width; ?>"><strong><?php echo $label; ?></strong></td>
        <td valign="top" width="<?php echo $sparator_width; ?>">:</td>
        <td valign="top"><?php echo $value; ?></td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php endif; ?>
