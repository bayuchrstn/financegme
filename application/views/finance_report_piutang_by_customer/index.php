<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; width:400px; padding:10px;">
    <form id="pencarian" method="post" target="_blank" action="<?php echo base_url() . $this->uri->segment(1) . '/print_report'; ?>">
        <label>customer</label>
        <select class="form-control" id="search_cust" name="search_cust">
        </select>
        <label>tahun</label>
        <select class="form-control" id="searchkat_inv" name="searchkat_inv">
            <?php
            $j = date('Y');
            $x = 2018;
            $z = $j - 2018 + 1;
            for ($i = 0; $i <= $z; $i++) {
                $tahun = $x + $i;
                if ($tahun == $j) {
                    echo '<option value="' . $tahun . '" selected>' . $tahun . '</option>';
                } else {
                    echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                }
            }
            ?>
        </select>
        <br />
        <button type="submit"><i class="material-icons">&#xE8B6;</i>View Report</button>
    </form>
</div>