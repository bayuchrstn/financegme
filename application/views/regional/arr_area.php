
<?php
if(!empty($arr_area)):
    foreach($arr_area as $row=>$val):
        // pre($row);
        $selected = ($row==$selected_area) ? 'selected' : '';
?>
<option <?php echo $selected; ?> value="<?php echo $row; ?>"><?php echo $val; ?></option>
<?php
    endforeach;
else:
?>
<option value="">Area Tidak Ada</option>
<?php
endif;
?>
