<?php
$time = strtotime(date("Y-m-01"));
$date_start = date("Y-m-01", strtotime("-0 month", $time));
//$date_start = date("Y-04-01");
$date_finish = date("Y-m-t", strtotime("+1 month", $time));

?>
<?php
$flashmessage   = $this->session->flashdata('message');
$notifikasi     = $this->session->flashdata('notifikasi');
echo !empty($flashmessage) ? '<div class="alert alert-' . $notifikasi . '"><button type="button" class="close" data-dismiss="alert"><span>x</span></button>' . $flashmessage . '</div>' : '';
?>
<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table . ' ' ?>
            <!-- <span id="info_invoice" style="font-size:11px;"></span> -->
            <a title="print" id="printinv" hidden><i class="material-icons" style="font-size:30px; color:#455a64; margin-left: 20px;">&#xE8AD;</i></a>
            <a title="kirim email" id="emailinv" hidden><i class="material-icons" style="font-size:30px; color:#455a64; margin-left:30px">email</i></a>
            <a title="generate faktur" id="fakturinv" hidden><i class="material-icons" style="font-size:30px; color:#455a64; margin-left:30px">description</i></a>
            <a title="merge" id="mergeinv" onClick="open_modal_merge()" style="display:none"><i class="material-icons" style="font-size:30px; color:#455a64; margin-left:30px">bookmarks</i></a>
        </h6>
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
                                        <label>kategori</label>
                                        <select class="form-control" id="searchkategori" name="searchkategori">
                                            <option value="0"></option>
                                            <?php
                                            $q = $this->finance_invoice_customer->kategori();
                                            if ($q->num_rows() > 0) {
                                                foreach ($q->result_array() as $r) {
                                                    echo '<option value="' . $r['id'] . '">' . $r['name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>kategori invoice</label>
                                        <select class="form-control" id="searchkat_inv" name="searchkat_inv">
                                            <option value=""></option>
                                            <option value="1">Semarang PPN</option>
                                            <option value="2">Semarang Non PPN</option>
                                            <option value="3">Salatiga PPN</option>
                                            <option value="4">Salatiga Non PPN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>status invoice</label>
                                        <select class="form-control" id="searchstatus_inv" name="searchstatus_inv">
                                            <option value=""></option>
                                            <option value="0">BELUM EDIT</option>
                                            <option value="1">SUDAH EDIT</option>
                                            <option value="2">SUDAH APPROVE</option>
                                            <option value="3">SUDAH CETAK</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>status lunas</label>
                                        <select class="form-control" id="searchlunas" name="searchlunas">
                                            <option value=""></option>
                                            <option value="0" selected="selected">BELUM</option>
                                            <option value="1">SUDAH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Invoice Date</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly value="<?php echo $date_start ?>" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Invoice End Date</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly value="<?php echo $date_finish ?>" /><br />
                                    </div>
                                </div>
                                <div class="row" style="display: none">
                                    <div class="col-lg-12">
                                        <label>Sort By </label>
                                        <select class="form-control" id="sortbyid" name="sortbyid">
                                            <option value="" selected="selected"></option>
                                            <option value="1">Customer ID Ascending</option>
                                            <option value="2">Customer ID Descending</option>
                                            <option value="3">Service ID Ascending</option>
                                            <option value="4">Service ID Ascending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <input type="text" class="form-control" style="width:200px;" placeholder="Pencarian" id="search_keyword" name="search_keyword">

                    <div class="input-group-btn">
                        <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i></b></button>
                        <button type="button" class="btn btn-default btn-raised" onClick="input_data()" id="tombol_open_search_form"><b><i class="icon-plus-circle2"></i></b> Invoice</button>
                        <button type="button" class="btn btn-default btn-raised" onClick="open_modal_generate_invoice()" id="tombol_open_generate_invoice"><b><i class="icon-plus-circle2"></i></b> Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table id="datamain_datatable" class="table table-bordered datatable-ajax table-xxs text-size-small" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><input type="checkbox" onClick="toggle(this)"></th>
                <th>no</th>
                <th>inv date</th>
                <th>due date</th>
                <th>no invoice</th>
                <th>id cust</th>
                <th>serviceID</th>
                <th>nama cust</th>
                <th>nama site</th>
                <th>faktur</th>
                <th>jenis</th>
                <th>bandwidth</th>
                <th>instalasi</th>
                <th>lain2</th>
                <th>ppn</th>
                <th>jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <?php foreach ($total as $row) { ?>
                    <th style="text-align:center">( Rp <?= number_format($row, 0, '.', ',') ?> total)</th>
                <?php } ?>
            </tr>
        </tfoot>
    </table>
</div>






<div id="modalGenerateInvoice" style="display:none;">
    <form id="form_generate_invoice" action="<?php echo base_url(); ?>finance_invoice_customer/generate_invoice" method="post">
        <label>Site</label>
        <select class="form-control" id="id_client" name="id_client">
        </select>
        <label>Bulan</label>
        <select class="form-control" id="searchBulan" name="bulan">
            <option value="01" <?php echo (date('m') == '01') ? 'selected="selected"' : ''; ?>>Januari</option>
            <option value="02" <?php echo (date('m') == '02') ? 'selected="selected"' : ''; ?>>Februari</option>
            <option value="03" <?php echo (date('m') == '03') ? 'selected="selected"' : ''; ?>>Maret</option>
            <option value="04" <?php echo (date('m') == '04') ? 'selected="selected"' : ''; ?>>April</option>
            <option value="05" <?php echo (date('m') == '05') ? 'selected="selected"' : ''; ?>>Mei</option>
            <option value="06" <?php echo (date('m') == '06') ? 'selected="selected"' : ''; ?>>Juni</option>
            <option value="07" <?php echo (date('m') == '07') ? 'selected="selected"' : ''; ?>>Juli</option>
            <option value="08" <?php echo (date('m') == '08') ? 'selected="selected"' : ''; ?>>Agustus</option>
            <option value="09" <?php echo (date('m') == '09') ? 'selected="selected"' : ''; ?>>September</option>
            <option value="10" <?php echo (date('m') == '10') ? 'selected="selected"' : ''; ?>>Oktober</option>
            <option value="11" <?php echo (date('m') == '11') ? 'selected="selected"' : ''; ?>>November</option>
            <option value="12" <?php echo (date('m') == '12') ? 'selected="selected"' : ''; ?>>Desember</option>
        </select><br />
        <select class="form-control" id="searchTahun" name="tahun">
            <?php
            for ($i = (date('Y') + 1); $i >= (date('Y') - 1); $i--) {
                $slc = (date('Y') == $i) ? 'selected="selected"' : '';
                echo '<option value="' . $i . '" ' . $slc . '>' . $i . '</option>';
            }
            ?>
        </select>
        <br style="clear:both;" />
        <button type="submit"><i class="material-icons">&#xE614;</i>GENERATE</button>
    </form>
</div>
<?php echo $insert_view; ?>
<?php echo $manual_view; ?>

<div class="modal fade" id="modalMerge" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gabung Invoice</h4><small>Tentukan alamat pengiriman dan tipe penggabungannya</small>
            </div>
            <form action="<?php echo base_url(); ?>finance_invoice_customer/merge_invoice" method="POST">
                <div class="modal-body">
                    <input id="input_val" name="input_val" type="hidden">
                    <p class="c-black f-500 m-b-20 m-t-20">Pilih alamat pengiriman invoice</p>
                    <div id="list_site"></div>
                    <br>
                    <div class="row" id="date_merge">
                        <div class="col-sm-6">
                            <p class="c-black f-500 m-b-20">Periode dari</p>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                    <input type="text" required id="dari_merge" name="dari" class="form-control date_picker" placeholder="Periode Awal">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p class="c-black f-500 m-b-20">Periode sampai</p>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                    <input type="text" required id="sampai_merge" name="sampai" class="form-control date_picker" placeholder="Periode Akhir">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link">Submit</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHeader" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Header Cetak Invoice</h4>
            </div>
            <form id="formheader">
                <div class="modal-body">
                    <input id="no_invoice" name="no_invoice" type="hidden">
                    <p class="c-black f-500 m-b-20 m-t-20">Pilih header invoice</p>
                    <div class="row" id="pilihhead" style="margin:10px">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="set_head();">Cetak</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>