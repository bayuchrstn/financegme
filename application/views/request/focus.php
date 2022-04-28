<?php
// pre($detail['attachments']);
$options = array();
$options['component'] = 'component/media_object/media_object_single';
$options['title'] = $detail['subject'];
$options['title_link'] = '';
$options['media_meta'] = array(
	$detail['customer_name'],
	$detail['mp_category'],
	$detail['author_name'],
	format_date($detail['date_start']),
);
$options['attachments'] = array();
if(!empty($detail['attachments'])):
	foreach($detail['attachments'] as $attachment):
		$options['attachments'][] = $attachment['file_name'];
	endforeach;
endif;
$options['content'] = $detail['body'];
echo $this->ui->load_component($options);
?>
