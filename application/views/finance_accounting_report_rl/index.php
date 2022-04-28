<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; width:400px; padding:10px;">
    <form id="pencarian" method="post" target="_blank" action="<?php echo base_url().$this->uri->segment(1).'/print_report'; ?>">
            <label>bulan</label>
            <select class="form-control" id="bulan_awal" name="bulan_awal">
                    <option value="01" <?php if(date('m') == '01'){ echo 'selected="selected"'; } ?> >Januari</option>
                    <option value="02" <?php if(date('m') == '02'){ echo 'selected="selected"'; } ?> >februari</option>
                    <option value="03" <?php if(date('m') == '03'){ echo 'selected="selected"'; } ?> >maret</option>
                    <option value="04" <?php if(date('m') == '04'){ echo 'selected="selected"'; } ?> >april</option>
                    <option value="05" <?php if(date('m') == '05'){ echo 'selected="selected"'; } ?> >mei</option>
                    <option value="06" <?php if(date('m') == '06'){ echo 'selected="selected"'; } ?> >juni</option>
                    <option value="07" <?php if(date('m') == '07'){ echo 'selected="selected"'; } ?> >juli</option>
                    <option value="08" <?php if(date('m') == '08'){ echo 'selected="selected"'; } ?> >agustus</option>
                    <option value="09" <?php if(date('m') == '09'){ echo 'selected="selected"'; } ?> >september</option>
                    <option value="10" <?php if(date('m') == '10'){ echo 'selected="selected"'; } ?> >oktober</option>
                    <option value="11" <?php if(date('m') == '11'){ echo 'selected="selected"'; } ?> >november</option>
                    <option value="12" <?php if(date('m') == '12'){ echo 'selected="selected"'; } ?> >desember</option>
            </select>
            <label>tahun</label>
            <select class="form-control" id="tahun_awal" name="tahun_awal">
                <?php
                    for($i = date('Y'); $i >= 2012; $i--){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>
    <br />
    <button type="submit"><i class="material-icons">&#xE8B6;</i>View Report</button>
    </form>
</div>
