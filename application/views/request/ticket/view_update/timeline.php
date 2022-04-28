<?php
	// pre($ticket_timeline);
	function sub_child($arr, $name='child')
	{
		if (count($arr) > 0) :
			echo '<ul style="list-style: none;">';
			// $row = $arr;
			foreach ($arr as $row):

			$type = $row['task_code']=='reply_ticket' ? 'membalas tiket' : 'membuat tiket';

			echo '<li><div class="media-body">';
			echo $row['author_name'].' '.$type.' ';
			echo '<a onclick="balas('.$row['id'].');" class="btn btn-link btn-float" style="float: right;"><i class="icon-comments text-primary" title="Komentar"></i></a>';
			echo '<a class="btn btn-link btn-float" style="float: right;" data-toggle="collapse" href="#collapse'.$row['id'].'" aria-expanded="false" aria-controls="collapse'.$row['id'].'" title="Tampilkan detail"><i class="icon-eye text-primary"></i></a>';
			echo '<div class="media-annotation">';
			echo $row['date_created'];
			echo '</div>';
			echo '<div class="collapse" id="collapse'.$row['id'].'"><div class="well" style="padding: 5px;">'.$row['body'].'</div></div>';
			echo '</div>';
			$children = sub_child($row['child']);
			echo '</li>';
			endforeach;
			echo '</ul>';
		endif;
	}

	if(!empty($ticket_timeline)):
?>
<ul class="media-list">
	<?php
		foreach($ticket_timeline as $row):
			// pre($row);

			$kalimat = $row['author_name'].' '.$row['note'];
            // $kalimat = '';
	?>
	<li class="media">
		<!-- <div class="media-left"><a href="#" class="btn text-default btn-icon btn-flat btn-sm "><i class="<?php //echo $row['icon']; ?>"></i></a></div> -->
		<div class="media-body">
			<?php echo $kalimat; ?>
			<div class="media-annotation"><?php echo $row['date_post']; ?></div>
		</div>
		<?php sub_child($ticket_timeline_child); ?>
	</li>
	<?php
		endforeach;
	?>
</ul>
<?php
	endif;
?>
