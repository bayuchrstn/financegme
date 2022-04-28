<?php
	function parse_child($arr=array())
	{
		if (!empty($arr)) {
			$html = '';
			$html .= '<ul style="list-style: none;">';
			foreach ($arr as $row) {
				$html .= '<li><div class="media-body">';
				$html .= $row['master_name'].'#'.$row['subject'];
				$html .= '<a href="javascript:void(0);" onclick="detail_task('.$row['id'].');" style="float: right;"><i class="icon-eye"></i></a>';
				$html .= '<div class="media-annotation">'.$row['author_name'].' pada '.$row['date_created'].'</div>';
				$html .= '</div>';
				if (!empty($row['child']))
					$html .= parse_child($row['child']);
				$html .= '</li>';
			}
			$html .= '</ul>';
			return $html;
		}
	}
?>

<?php 
if (!empty($timeline)):
	foreach ($timeline as $row) :
?>
<ul class="media-list">
    <li class="media">
    	<div class="media-body">
    		<?php echo $row['master_name'].'#'.$row['subject']; ?>
    		<a href="javascript:void(0);" onclick="detail_task(<?php echo $row['id'] ?>);" style="float: right;"><i class="icon-eye"></i></a>
    		<div class="media-annotation">
    			<?php echo $row['author_name'].' pada '.$row['date_created']; ?>
    		</div>
    	</div>
    	<?php 
    	if (!empty($row['child'])) echo parse_child($row['child']);
    	?>
    </li>
</ul>
<?php 
	endforeach;
else:
	echo "Timeline Kosong";
endif;
?>