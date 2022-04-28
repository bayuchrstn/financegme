<?php
    $modal_icon = (isset($modal_icon)) ? '<i class="'.$modal_icon.' position-left"></i>' : '';
?>
<div id="<?php echo $modal_id; ?>" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="valid" id="<?php echo $form_id; ?>" action="<?php echo $form_action; ?>" method="post">
                <div class="modal-header<?php //echo BG_THEME; ?>">
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
                        <div class="col-lg-12">
                            <?php
                                if(!empty($form_input)):
                                    foreach($form_input as $input):
                                        echo $input;
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="sender" value="1">
                    <button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
