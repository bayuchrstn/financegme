<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; padding:10px;">
    <form id="formulir" method="post" action="#">
    <div class="row"> 
            <div class="col-lg-3">
                <label>kategori</label>
                <select class="form-control" id="tax_type" name="tax_type">
                    <option value=""></option>
                    <?php
                        $q = $this->m_global->gmd_finance_master_cat_tax_type();
                        if($q->num_rows() > 0){
                            foreach($q->result_array() as $r){
                                echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-3">
                <label>faktur</label>
                <select class="form-control" id="msa" name="msa">
                    <option value="0">MEDIA SARANA DATA</option>
                    <option value="1">MEDIA SARANA AKSES</option>
                </select>
            </div>
    </div>
    <div class="row" style="text-align:center; margin:10px 0;">
        <button type="button" class="btn btn-primary" onclick="save_data_import()">Save</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo base_url().$this->uri->segment(1); ?>';">Back</button>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <label>file excel</label>
            <input class="form-control" type="file" id="excel_file" name="excel_file" onChange="upload_file('formulir','excel_file');" />
        </div>
    </div>

    <div id="data_faktur_pajak" style="clear:both; background:#; padding:10px;"></div>
    </form>
</div>