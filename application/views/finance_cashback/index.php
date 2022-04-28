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
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly="readonly" value="<?php echo date('Y-m-01') ?>" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>sampai tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly="readonly" value="<?php echo date('Y-m-t') ?>" /><br />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>status</label>
                                        <select class="form-control" id="search_status" name="search_status">
                                            <option value=""></option>
                                            <option value="1" selected="selected">BELUM</option>
                                            <option value="2">LUNAS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <input type="text" class="form-control" style="width:250px;" placeholder="Pencarian" id="search_keyword" name="search_keyword">

                    <div class="input-group-btn">
                        <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i></b></button>
                        <!-- <button type="button" class="btn btn-default btn-raised" onClick="input_data()"><b><i class="icon-plus-circle2"></i></b> Add</button> -->
                        <!-- <button type="button" class="btn btn-default btn-raised" onClick="window.location.href = '<?php echo base_url() . $this->uri->segment(1) . '/import'; ?>';"><b><i class="icon-plus-circle2"></i></b> Import</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs text-size-small">
        <thead>
            <tr>
                <th style="text-align:center">No</th>
                <th style="text-align:center">Nama</th>
                <th style="text-align:center">PIC</th>
                <th style="text-align:center">Rekening</th>
                <th style="text-align:center">Bank</th>
                <th style="text-align:center">Jumlah</th>
                <th style="text-align:center">Tanggal</th>
                <th>Status</th>
                <th style="text-align:center">Action</th>
            </tr>
        </thead>
    </table>
</div>

<?php echo $insert_view; ?>