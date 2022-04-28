<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />

<form id="formulir_modal" method="post">
<div class="row">
	<div class="col-md-6">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-notebook position-left text-default"></i> <?php echo $title_page_table ?></h6>
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <label>COA From</label>
                    <select class="form-control" id="coa_from" name="coa_from" onchange="select_card_from()">
                        <option value="">=== Pilih COA ===</option>
                        <?php echo $this->finance_coa_mutasi->coa_detail(); ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>Card From</label>
                    <select class="form-control" id="card_from" name="card_from">
                        <option value="">=== Pilih Card ===</option>
                        <option value="0">No Card</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>COA To</label>
                    <select class="form-control" id="coa_to" name="coa_to" onchange="select_card_to()">
                        <option value="">=== Pilih COA ===</option>
                        <?php echo $this->finance_coa_mutasi->coa_detail(); ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>Card To</label>
                    <select class="form-control" id="card_to" name="card_to">
                        <option value="">=== Pilih Card ===</option>
                        <option value="0">No Card</option>
                    </select>
                </div>
            </div>
            <div class="row"><div class="col-md-12 text-right" style="margin-top:20px;">
            <button type="submit" class="btn btn-info btn-xs">Change Journal</button>
            </div></div>
        </div>
    </div>
    </div>
</div>
</form>
