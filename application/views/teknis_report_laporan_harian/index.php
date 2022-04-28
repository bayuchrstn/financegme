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
                                    <label>tanggal</label>
                                    <input type="text" class="form-control date_picker" id="searchDateTransFirst" name="searchDateTransFirst" readonly="readonly" value="<?php echo date('Y-m-d') ?>"/> 
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
                <th>lokasi</th>
                <th>judul</th>
                <th>laporan</th>
                <th>analisa</th>
                <th>tindakan</th>
                <th>author</th>
                <th>status</th>
                <th>mulai</th>
                <th>selesai</th>
                <th>waktu</th>
            </tr>
        </thead>
    </table>
</div>	
