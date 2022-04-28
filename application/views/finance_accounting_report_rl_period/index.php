<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; width:400px; padding:10px;">
    <form id="pencarian" method="post" target="_blank" action="<?php echo base_url().$this->uri->segment(1).'/print_report'; ?>">
    	<div class="row">
            <div class="col-lg-6">
            <select class="form-control" id="start_bulan_awal" name="start_bulan_awal">
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
            </div>
            <div class="col-lg-6">
            <select class="form-control" id="start_tahun_awal" name="start_tahun_awal">
                <?php
                    for($i = date('Y'); $i >= 2017; $i--){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>
            </div>
		</div>
    	<div class="row">
            <div class="col-lg-6">
            <label>s/d bulan</label>
            <select class="form-control" id="finish_bulan_awal" name="finish_bulan_awal">
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
            </div>
            <div class="col-lg-6">
            <label>&nbsp;</label>
            <select class="form-control" id="finish_tahun_awal" name="finish_tahun_awal">
                <?php
                    for($i = date('Y'); $i >= 2017; $i--){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>
            </div>
		</div>
    </br>
    <button type="submit"><i class="material-icons">&#xE8B6;</i>View Report</button>
    </form>
</div>
