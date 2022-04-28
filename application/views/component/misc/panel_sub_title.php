<small class="display-block">
	<?php
		if(!empty($sub_info)):
			foreach($sub_info as $row):
	?>
	<span class="label border-left-violet label-striped"><?php echo $row; ?></span>
	<?php
			endforeach;
		endif;
	?>

	<?php
		if(!empty($sub_info)):
	?>
	<a href="<?php echo $reset; ?>" class="text-info">Reset</a>
	<?php
		endif;
	?>
</small>
