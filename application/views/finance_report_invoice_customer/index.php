<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
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
                                    <!-- <div class="col-lg-6">
                                        <label>kategori customer</label>
                                        <select class="form-control" id="searchkategori" name="searchkategori">
                                            <option value="0">ALL</option>
                                            <?php
                                            $q = $this->finance_report_invoice_customer->kategori();
                                            if ($q->num_rows() > 0) {
                                                foreach ($q->result_array() as $r) {
                                                    echo '<option value="' . $r['id'] . '">' . $r['name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div> -->
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
                                        <label>status invoice</label>
                                        <select class="form-control" id="searchstt_inv" name="searchstt_inv">
                                            <option value="">ALL</option>
                                            <option value="0">BELUM LUNAS</option>
                                            <option value="1">SUDAH LUNAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>dari tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly value="<?php echo date('Y-m-01') ?>" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>sampai tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly value="<?php echo date('Y-m-t') ?>" /><br />
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

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs table-bordered table-xxs text-size-small">
        <thead>
            <tr class="text-black">
                <th rowspan="2">no</th>
                <th rowspan="2">tanggal<br />invoice</th>
                <th rowspan="2">no<br />invoice</th>
                <th rowspan="2">customer</th>
                <th rowspan="2">customer id</th>
                <th rowspan="2">site</th>
                <th colspan="5">pendapatan</th>
                <th colspan="3">pengurang</th>
                <th rowspan="2" style="text-align:center"> <b>total net</b></th>
                <th colspan="3">pembayaran</th>
            </tr>
            <tr>
                <th>bandwidth</th>
                <th>instalasi</th>
                <th>lain2</th>
                <th>PPN</th>
                <th>jumlah invoice</th>
                <th>PPN</th>
                <th>PPH 22/23</th>
                <th>Biaya Lain2</th>
                <th>invoice</th>
                <th>bayar</th>
                <th>piutang</th>
            </tr>
        </thead>

    </table>
</div>