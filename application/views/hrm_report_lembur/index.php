<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table ?></h6>
        <div class="heading-elements">
        <form id="formsearch" onSubmit="return false;">   
            <div class="input-group">
                    <div class="input-group-btn" style="text-align:right;">
                        <button id="button_dropdown_search" type="button" class="btn dropdown-toggle btn-icon btn-default btn-raised" data-toggle="dropdown">
                        <span class="caret"></span> <i class="icon-search4"></i>
                        </button>
            
                        <ul class="dropdown-menu dropdown-content dropdown-menu-right" style="width:400px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <label>dari tanggal</label>
                                    <input type="text" class="form-control date_picker" id="searchDateTransFirst" name="searchDateTransFirst" readonly="readonly" value="<?php echo date('Y-m-01') ?>"/> 
                                    </div>
                                    <div class="col-lg-6">
                                    <label>sampai tanggal</label>
                                    <input type="text" class="form-control date_picker" id="searchDateTransFinish" name="searchDateTransFinish" readonly="readonly" value="<?php echo date('Y-m-t') ?>"/><br />
                                    </div>
                                </div>
                                <br />
                                <div class="row" style="text-align:right;">
                                    <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i> Search</b></button>
                                </div>
                            </div>
                        </ul>
                    </div>
            </div>
        </form>
        </div>
    </div>

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>start</th>
                <th>finish</th>
                <th>karyawan</th>
                <th>diff</th>
            </tr>
        </thead>
    </table>
</div>	
