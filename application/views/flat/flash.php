<?php  
	$color = $type;
?>

<div class="alert <?php echo $color; ?> fade in block-inner">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <?php echo $msg; ?>
</div>
