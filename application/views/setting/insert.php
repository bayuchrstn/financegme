<!-- ! -->
<div id="modal_insert" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- ! -->
            <form class="valid" id="form_insert" action="<?php echo base_url(); ?>setting/insert" method="post">

                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <!-- ! -->
                    <h4 class="modal-title modal-title-custom">New Setting</h4>
                </div>
                <div class="modal-body">
                    <?php //info_gak_boleh('create', 'Anda tidak memiliki hak akses membuat ticket'); ?>
                    <?php
                    $sql = "SELECT
                                label_category as label_category,
                                category as category
                            FROM {PRE}setting
                            GROUP by category";
                    $categorys = $this->db->query($sql)->result_array();
                    // pre($categorys);

                    $arr_select = array();
                    if(!empty($categorys)):
                        foreach($categorys as $cat):
                            // pre($cat);
                            $arr_select[$cat['category']] = $cat['label_category'];
                        endforeach;
                    endif;

                    ?>
                    <div class="form-group">
                        <label>Kategori</label>
                        <?php echo form_dropdown('category', $arr_select, '', 'class="form-control"'); ?>
                    </div>

                    <div class="form-group newcat" id="newcat">
                        <label>New Category</label>
                        <input type="text" class="form-control" name="new_category" id="new_category">
                    </div>

                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" name="label" id="label">
                    </div>

                    <input type="hidden" class="form-control slug" name="code" id="code">

                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" class="form-control" name="value" id="value">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
