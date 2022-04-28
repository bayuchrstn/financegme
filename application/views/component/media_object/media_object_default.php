
<?php
	// usage
	// $options = array();
	// $options['component'] = 'component/media_object/media_object_default';
	// $options['class'] = 'aha';
	// $options['id'] = 'ehe';
	// $options['media'] = array();
	// $options['media'][] = array(
	// 	'title'	=> 'col 1',
	// 	'title_link'	=> '',
	// 	'content'	=> 'auto',
	// );
	// $options['media'][] = array(
	// 	'title'	=> 'col 2',
	// 	'title_link'	=> '',
	// 	'content'	=> 'auto',
	// );
	// echo $this->ui->load_component($options);

	$media = (isset($media)) ? $media : array();

	if(!empty($media)):
?>
<ul class="media-list">
	<?php
		foreach($media as $item):
	?>
	<li class="media">
		<div class="media-body">
			<?php if($item['title'] !=''): ?>
			<h6 class="media-heading">
				<?php if($item['title_link'] !=''): ?>
				<a href="<?php echo $item['title_link']; ?>">
				<?php endif; ?>
				<?php echo $item['title']; ?>
				<?php if($item['title_link'] !=''): ?>
				</a>
				<?php endif; ?>

				<?php if($item['media_meta'] !=''): ?>
				<span class="media-annotation dotted"><?php echo $item['media_meta']; ?></span>
				<?php endif; ?>

			</h6>
			<?php endif; ?>
			<?php if($item['content'] !=''): ?>
			<?php echo $item['content']; ?>
			<div class="media-annotation mt-5"><i class="icon-pin-alt"></i> &nbsp;<a href="">4 hours ago from Thailand</a></div>
			<div class="media-annotation mt-5"><i class="icon-pin-alt"></i> &nbsp;4 hours ago from Thailand</div>
			<?php endif; ?>
		</div>
	</li>
	<?php
		endforeach;
	?>
</ul>
<?php
	endif;
?>
