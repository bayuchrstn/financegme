<?php
$time = strtotime(date("Y-m-01"));
$date_start = date("Y-m-01", strtotime("-1 month", $time));
$date_finish = date("Y-m-t", strtotime("+1 month", $time));
?>
<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />

<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table ?></h6>
        <div class="heading-elements">
            <form id="formsearch" onSubmit="return false;">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button id="button_form_dropdown_search" type="button" class="btn dropdown-toggle btn-icon btn-default btn-raised" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu dropdown-content" style="width:395px;">
                            <div class="panel-body">
                            <div class="row">
                                    <div class="col-lg-6">
                                        <label>dari tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly="readonly" value="" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>sampai tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly="readonly" value="<?php echo date('Y-m-t') ?>" /><br />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>region</label>
                                            <select class="form-control" id="searchkategori1" name="searchkategori">
                                                <option value="">SEMUA</option>
                                                <option value="3">Semarang</option>
                                                <option value="7">Salatiga</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" id="searchkategori2" name="searchkategori">
                                                <option value="">SEMUA</option>
                                                <option value="1">Temporary</option>
                                                <option value="2">Permanent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <input type="text" class="form-control" style="width:250px;" placeholder="Pencarian" id="search_keyword" name="search_keyword" onkeyup="search_data();">

                    <div class="input-group-btn">
                        <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i></b></button>
                        <!-- <button type="button" class="btn btn-default btn-raised" onClick="input_data()"><b><i class="icon-plus-circle2"></i></b> Add</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="datamain_datatable" width="100%" class="table datatable-ajax table-striped table-xxs text-size-small">
        <thead>
            <tr>
                <th>no</th>
                <th>Customers</th>
                <th>Site</th>
                <th>Dismantle</th>
                <th>Alasan</th>
                <th>Berhenti Tgl</th>
                <th>Input</th>
                <th>action</i></th>
            </tr>
        </thead>
    </table>
</div>




<?php echo $insert_view; ?>