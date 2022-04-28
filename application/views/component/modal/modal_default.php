<?php

	// usage example
	// $options['component'] = 'component/modal/modal_default';
	// $options['modal_id'] = 'modal_focus';
	// $options['modal_size'] = 'modal-full';
	// $options['modal_icon'] = 'icon-search4';
	// $options['modal_title'] = 'default title';
	// $options['main_content'] = '<div id="focus_main_content_div"></div>';
	// echo $this->ui->load_component($options);

    $modal_id = (isset($modal_id)) ? $modal_id : '';
    $modal_size = (isset($modal_size)) ? $modal_size : '';
    $modal_icon = (isset($modal_icon)) ? $modal_icon : '';
    $modal_header_color = (isset($modal_header_color)) ? $modal_header_color : '';
    $modal_title = (isset($modal_title)) ? $modal_title : '';
    $main_content = (isset($main_content)) ? $main_content : '';
    $modal_footer = (isset($modal_footer)) ? $modal_footer : 'yes';
?>
<div id="<?php echo $modal_id; ?>" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog <?php echo $modal_size; ?>" >
        <div class="modal-content">
            <div class="modal-header <?php echo $modal_header_color; ?>">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="modal_icon position-left <?php echo $modal_icon; ?>"></i> <span id="modal_title_custom"><?php echo $modal_title ?></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            if(!empty($main_content)):
                                echo $main_content;
                            endif;
                        ?>
                    </div>
                </div>
            </div>
			<?php
				if($modal_footer=='yes'):
			?>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
            </div>
			<?php
				endif;
			?>
        </div>
    </div>
</div>
