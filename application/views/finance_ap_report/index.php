<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; width:400px; padding:10px;">
    <form id="pencarian" method="post" target="_blank" action="<?php echo base_url() . $this->uri->segment(1) . '/print_report'; ?>">
        <label>vendor/supplier</label>
        <select class="form-control" id="supplier" name="searchkategori">
        </select>
        <label>status invoice</label>
        <select class="form-control" id="searchstt_inv" name="searchstt_inv">
            <option value=""></option>
            <option value="0">BELUM LUNAS</option>
            <option value="1">SUDAH LUNAS</option>
        </select>
        <label>Invoice Date</label> <br />
        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly="readonly" style="width:100px; display:inline;" value="<?php echo date('Y-m-01') ?>" /> -
        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly="readonly" style="width:100px; display:inline;" value="<?php echo date('Y-m-t') ?>" /><br />
        <br />
        <button type="submit"><i class="material-icons">&#xE8B6;</i>View Report</button>
    </form>
</div>