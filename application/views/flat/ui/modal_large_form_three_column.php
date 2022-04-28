<?php
    $modal_icon = (isset($modal_icon)) ? '<i class="'.$modal_icon.' position-left"></i>' : '';
    $form_id = (isset($form_id)) ? $form_id : '';
    $form_action = (isset($form_action)) ? $form_action : '';
    $modal_title = (isset($modal_title)) ? $modal_title : '';
    $form_input_left = (isset($form_input_left)) ? $form_input_left : array();
    $form_input_right = (isset($form_input_right)) ? $form_input_right : array();

?>
<div id="<?php echo $modal_id; ?>" class="modal fade" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="valid" id="<?php echo $form_id; ?>" action="<?php echo $form_action; ?>" method="post">

                <div class="modal-header <?php //echo BG_THEME; ?>">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title modal-title-custom"><?php echo $modal_icon; ?> <?php echo $modal_title ?></h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                if(isset($form_input_top) && !empty($form_input_top)):
                                    echo $form_input_top;
                                endif;
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                            if(isset($form_input_left) && !empty($form_input_left)):
                                foreach($form_input_left as $input):
                                    echo $input;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            if(isset($form_input_center) && !empty($form_input_center)):
                                foreach($form_input_center as $input):
                                    echo $input;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            if(isset($form_input_right) && !empty($form_input_right)):
                                foreach($form_input_right as $input):
                                    echo $input;
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if(isset($form_input_bottom) && !empty($form_input_bottom)):
                                foreach($form_input_bottom as $input):
                                    echo $input;
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
