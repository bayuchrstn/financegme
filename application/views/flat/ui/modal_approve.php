<?php
    $modal_icon = (isset($modal_icon)) ? '<i class="'.$modal_icon.' position-left"></i>' : '';
?>
<div id="<?php echo $modal_id; ?>" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="valid" id="<?php echo $form_id; ?>" action="" method="post">

                <div class="modal-header <?php //echo BG_THEME; ?>">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title modal-title-custom"><?php echo $modal_icon; ?> <?php echo $modal_title ?></h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="approve_id" name="id" value="">
                    <div id="data_info_approve">
                    </div>
                    <div id="remove_confirm">
                    </div>

                </div>
                <div id="modal_approve_footer" class="modal-footer">
                    <button type="submit" class="btn btn-success" ><i class="icon-check position-left"></i> <?php echo $this->lang->line('all_yes'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-cancel-circle2 position-left"></i> <?php echo $this->lang->line('all_no'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
