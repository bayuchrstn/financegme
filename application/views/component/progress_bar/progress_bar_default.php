<?php
    $pb_class = (isset($pb_class)) ? $pb_class : 'progress';
    $pb_color = (isset($pb_color)) ? $pb_color : 'progress-bar-success';
    $prosentase = (isset($prosentase)) ? intval($prosentase) : '23%';
?>

<div class="<?php echo $pb_class; ?>">
	<div class="progress-bar <?php echo $pb_color; ?>" style="width: <?php echo $prosentase; ?>%;"></div>
	<span style="position: absolute; top: 1px; left: 5px; font-size: 11px;"><?php echo $prosentase; ?>%</span>
</div>
