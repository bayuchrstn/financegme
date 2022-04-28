<?php
// usage Example
// $options = array();
// $options['component'] = 'component/accordion/accordion_default';
// $options['$accordion_id'] = 'accordion-control';
// $options['$accordion_items'] = array();
//
// $options['$accordion_items'][] = array(
// 		'label'         => 'Data Pasien',
// 		'id'            => 'focus_data_pasien',
// 		'content'       => 'focus_data_pasien',
// 	);
//
// $options['$accordion_items'][] = array(
// 		'label'         => 'Rekam Medis',
// 		'id'            => 'focus_rekam_medis',
// 		'content'       => 'focus_rekam_medis',
// 	);
// $content = $this->ui->load_component($options);
// usage Example

$accordion_id = (isset($accordion_id)) ? $accordion_id : 'accordion-control';
$accordion_items = (isset($accordion_items)) ? $accordion_items : array();
$accordion_content_padding_class = (isset($accordion_content_padding_class)) ? $accordion_content_padding_class : 'p-20';
?>

<div class="panel-group panel-default" id="<?php echo $accordion_id; ?>">
	<?php
    if(!empty($accordion_items)):
        foreach($accordion_items as $item):
            // pre($category);
    ?>
	<div class="panel panel-white">
		<div class="panel-heading">
            <h6 class="panel-title">
                <a data-toggle="collapse" data-parent="#<?php echo $accordion_id; ?>" href="#<?php echo $item['id']; ?>"><?php echo $item['label']; ?></a>
            </h6>
        </div>
		<div id="<?php echo $item['id']; ?>" class="panel-collapse collapse <?php echo $accordion_content_padding_class; ?>">
			<?php echo $item['content']; ?>
		</div>
	</div>
	<?php
		endforeach;
	endif;
	?>
</div>
