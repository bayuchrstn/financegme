<script type="text/javascript">
// $(document).ready(function(){
// 	$('#country').change(function(){
// 		var c = $(this).val();
// 		alert(c);
// 	});
// });
</script>

<script type="text/javascript">
	<?php
		if(!empty($widget_lists)):
			foreach($widget_lists as $widget):
				$widget_code = $widget['code'];
				$widget_detail = $this->dashboard->widget_detail($widget_code);

				if($widget['component']=='panel_pill'):
					$tabs = unserialthis($widget_detail['tabs']);

	?>

	//============== Widget <?php echo $widget['name']; ?> ==================

	<?php
		foreach($tabs as $tab):
	?>

	//------------------------------------ <?php echo $tab['label']; ?> --------------------------------
	// url : <?php echo base_url().$widget['content_url'].$tab['id']; ?>

	function set_update_<?php echo $widget['code']; ?>_<?php echo $tab['id']; ?>()
	{
		$.ajax({
			type: "GET",
			url: '<?php echo base_url().$widget['content_url'].$tab['id']; ?>',
		}).done(function( response ) {
			$('#<?php echo $tab['id']; ?>').html(response);
		});
	}
	set_update_<?php echo $widget['code']; ?>_<?php echo $tab['id']; ?>();

	<?php
		endforeach;

	?>

	//============== Widget <?php echo $widget['name']; ?> ==================



	<?php
				else:
	?>

	<?php if($widget['auto_refresh'] !='0'): ?>
	// setInterval(function(){set_update_<?php echo $widget['code']; ?>();}, <?php echo $widget['auto_refresh']; ?>);
	<?php endif; ?>

	//============== Widget <?php echo $widget['name']; ?> ==================

	// url : <?php echo base_url().$widget['content_url']; ?>


	function set_update_<?php echo $widget['code']; ?>()
	{
		$.ajax({
			type: "GET",
			url: '<?php echo $widget['content_url']; ?>',
		}).done(function( response ) {
			$('#<?php echo $widget['code']; ?>').html(response);
		});
	}
	set_update_<?php echo $widget['code']; ?>();

	//============== Widget <?php echo $widget['name']; ?> ==================



	<?php
				endif;
			endforeach;
		endif;
	?>



	// $(window).on('load', function(){
	//
	// 	$('#widget_container').masonry({
	// 		itemSelector: '.widget_item',
	// 	});
	// })

	// $(document).ready(function(){
	// 	$('#widget_container').masonry({
	// 		itemSelector: '.widget_item',
	// 	});
	// });

</script>
