<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; width:400px; padding:10px;">
    <form id="pencarian" method="post" target="_blank" action="<?php echo base_url().$this->uri->segment(1).'/print_report'; ?>">
    <div class="row">
    	<div class="col-lg-6">
            <label>kategori customer</label>
            <select class="form-control" id="searchkategori" name="searchkategori">
                <option value="">ALL</option>
                <option value="0">Non Kategori</option>
                <?php
                    $q = $this->finance_invoice_report_piutang_lain->kategori();
                    if($q->num_rows() > 0){
                        foreach($q->result_array() as $r){
                            echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                        }
                    }
                ?>
            </select>
    	</div>
    	<div class="col-lg-6">
            <label>jenis customer</label>
            <select class="form-control" id="searchmsa" name="searchmsa">
                <option value="">ALL</option>
                <option value="1">MEDIA SARANA AKSES</option>
                <option value="0">MEDIA SARANA DATA</option>
            </select>
    	</div>
	</div>
    <div class="row">
    	<div class="col-lg-6">
            <label>PPN</label>
            <select class="form-control" id="searchppn" name="searchppn">
                <option value="">ALL</option>
                <option value="1">YA</option>
                <option value="0">TIDAK</option>
            </select>
    	</div>
    	<div class="col-lg-6">
            <label>MAXI</label>
            <select class="form-control" id="searchmaxi" name="searchmaxi">
                <option value="">ALL</option>
                <option value="1">YA</option>
                <option value="0">TIDAK</option>
            </select>
    	</div>
	</div>
    <div class="row">
    	<div class="col-lg-6">
            <label>CABANG</label>
            <select class="form-control" id="searchcabang" name="searchcabang">
                <option value="">ALL</option>
                <option value="1">YA</option>
                <option value="0">TIDAK</option>
            </select>
    	</div>
    	<div class="col-lg-6">
            <label>periode</label>
            <select class="form-control" id="searchTanggal" name="searchTanggal" onchange="select_date()">
                <option value="2">ALL TIME</option>
                <option value="1">DATE RANGE</option>
                <option value="3">DATE CLOSE</option>
            </select>
    	</div>
	</div>
    <div id="date_selected" style="display:none;">
        <div class="row">
            <div class="col-lg-6">
                <label>start Date</label>
                <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly value="<?php echo date('Y-m-01') ?>"/>
            </div>
            <div class="col-lg-6">
                <label>end Date</label>
                <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly  value="<?php echo date('Y-m-t') ?>"/>
            </div>
        </div>
    </div>
    <div id="date_closed" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <label>CLose Invoice Date</label>
                <input type="text" class="form-control date_picker" id="searchDateFinish2" name="searchDateFinish2" readonly  value="<?php echo date('Y-m-t') ?>"/>
            </div>
        </div>
    </div>
    <br />
    <button type="submit"><i class="material-icons">&#xE8B6;</i>View Report</button>
    </form>
</div>
