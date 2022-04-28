<?php
	// pre($current);
	if(!empty($current)):
?>

<ul class="media-list content-group">
	<?php
		foreach($current as $row):
			// pre($row);
	?>
	<li class="media stack-media-on-mobile">
		<div class="media-body">
			<b><?php echo $row['author_name']; ?></b> - <?php echo $row['comment']; ?>
    		<ul class="list-inline list-inline-separate text-muted mb-5">
    			<!-- <li><i class="icon-user position-left"></i> <?php echo $row['author_name']; ?></li> -->
    			<li><?php echo ago($row['date_post']); ?></li>
    		</ul>
		</div>
	</li>
	<?php
		endforeach;
	?>
</ul>

<?php
	endif;
?>
