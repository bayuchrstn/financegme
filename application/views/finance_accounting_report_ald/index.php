<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />

<form id="pencarian" method="post" target="_blank" action="<?php echo base_url().$this->uri->segment(1).'/print_report'; ?>">
<div class="row">
	<div class="col-md-3">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-notebook position-left text-default"></i> <?php echo $title_page_table ?></h6>
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <label>periode</label>
                    <select class="form-control" id="searchTanggal" name="searchTanggal" onchange="select_date()">
                        <option value="3" selected>DATE CLOSE</option>
                        <option value="1">DATE RANGE</option>
                    </select>
                </div>
            </div>
            <div id="date_selected" style="display:none;">
                <div class="row">
                    <div class="col-lg-6">
                        <label>start Date</label>
                        <input type="text" class="form-control date_picker" id="searchDateFirst1" name="searchDateFirst1" readonly value="<?php echo date('Y-m-01') ?>"/>
                    </div>
                    <div class="col-lg-6">
                        <label>end Date</label>
                        <input type="text" class="form-control date_picker" id="searchDateFinish1" name="searchDateFinish1" readonly  value="<?php echo date('Y-m-t') ?>"/>
                    </div>
                </div>
            </div>
        	<div id="date_closed" class="row">
            	<div class="col-md-6">
                <label>Date</label>
                <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" value="<?php echo date('Y-m-d') ?>"/>
                </div>
            </div>
            <div class="row"><div class="col-md-12 text-right" style="margin-top:20px;">
            <button type="submit" class="btn btn-info btn-labeled btn-xs"><b><i class="icon-search4"></i></b> View Report</button>
            </div></div>
        </div>
    </div>
    </div>
</div>
</form>
