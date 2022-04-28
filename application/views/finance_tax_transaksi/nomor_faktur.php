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
                                        <label>Tahun</label>
                                        <select class="form-control" id="searchtahun" name="searchtahun">
                                            <?php
                                            $q = $this->finance_tax_nomor->get_tahun();
                                            if ($q->num_rows() > 0) {
                                                foreach ($q->result_array() as $r) {
                                                    echo '<option value="' . $r['tanggal'] . '">' . $r['tanggal'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Status</label>
                                        <select class="form-control" id="searchstatus" name="searchstatus">
                                            <option value="">ALL</option>
                                            <option value="0">Available</option>
                                            <option value="1">Used</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <input type="text" class="form-control" style="width:250px;" placeholder="Pencarian" id="search_keyword" name="search_keyword">

                    <div class="input-group-btn">
                        <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i></b></button>
                        <button type="button" class="btn btn-default btn-raised" onClick="input_data()"><b><i class="icon-plus-circle2"></i></b> Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs text-size-small">
        <thead>
            <tr>
                <th>No</th>
                <th>No Faktur</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal Tambah Data -->
<div id="modal_finance_nomor" class="modal" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <form class="valid" id="formulir_modal" action="" method="post" enctype="multipart/form-data" novalidate="novalidate" transaksi="tambah">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">
                        <i class="modal_icon position-left "></i>
                        <span id="modal_title_custom"><span class=" icon-box"></span> Buat No Faktur</span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="modal_finance_coa_alert" class="col-lg-12 modal_alert"></div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>no faktur awal</label>
                                <input class="form-control" type="text" id="nofak" name="nofak">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>jumlah</label><br>
                                <input class="form-control" type="number" id="jumlah" name="jumlah" min="0" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="position-left icon-checkmark"></i> Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div id="modal_finance_nomor_edit" class="modal" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <form class="valid" id="formulir_edit" action="" method="post" enctype="multipart/form-data" novalidate="novalidate" transaksi="tambah">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">
                        <i class="modal_icon position-left "></i>
                        <span id="modal_title_custom"><span class=" icon-box"></span> Edit No Faktur</span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="modal_finance_coa_alert" class="col-lg-12 modal_alert"></div>

                        <div class="col-lg-12">
                            <input type="hidden" id="id" name="id" value="">
                            <div class="form-group">
                                <label>no faktur</label>
                                <input class="form-control" type="text" id="editnofak" name="nofak">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="position-left icon-checkmark"></i> Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>