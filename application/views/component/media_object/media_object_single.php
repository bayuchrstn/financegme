
<?php
	// usage
	// $options = array();
	// $options['component'] = 'component/media_object/media_object_single';
	// $options['title'] = $detail['subject'];
	// $options['title_link'] = '';
	// $options['media_meta'] = array(
	// 	$detail['author_name'],
	// 	format_date($detail['date_start'])
	// );
	// $options['content_footer'] = array(
	// 	'footer 1',
	// 	'footer 2'
	// );
	// $options['content'] = $detail['body'];
	// echo $this->ui->load_component($options);
?>
<div class="media-body">
	<?php if($title !=''): ?>
	<h6 class="media-heading">

		<?php if($title_link !=''): ?>
		<a href="<?php echo $title_link; ?>">
		<?php endif; ?>

		<?php echo $title; ?>

		<?php if($title_link !=''): ?>
		</a>
		<?php endif; ?>

		<?php
			if(!empty($media_meta)):
				foreach($media_meta as $meta):
		?>
		<span class="media-annotation dotted"><?php echo $meta; ?></span>
		<?php
				endforeach;
			endif;
		?>

	</h6>
	<?php endif; ?>



	<?php if($content !=''): ?>
	<?php echo $content; ?>

	<?php
		if(!empty($content_footer)):
			foreach($content_footer as $footer):
	?>
	<div class="media-annotation mt-5">
		<?php echo $footer ?>
	</div>
	<?php
			endforeach;
		endif;
	?>

	<?php
		if(!empty($attachments)):
	?>
	<h6><i class="icon-attachment position-left"></i> Attachment</h6>
	<?php
			foreach($attachments as $attachment):
				$attachment_url = '';
	?>
	<div class="media-annotation mt-5">
		<a href="<?php echo $attachment_url; ?>"><?php echo $attachment; ?></a>
	</div>
	<?php
			endforeach;
		endif;
	?>

	<?php endif; ?>
</div>
