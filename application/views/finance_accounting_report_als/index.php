<?php
$id_kas = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : '';
$id_tgl_awal = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : '';
$id_tgl_akhir = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : '';

?>
<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<input type="hidden" id="domainUri" value="<?php echo base_url(); ?>" />
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table ?> <em id="info_coa" style="font-weight:normal;"></em></h6>
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
                                    <div class="col-lg-12">
                                        <label>Account</label>
                                        <select class="form-control" id="id_biaya" name="id_biaya" onchange="get_coa();search();">
                                            <?php
                                            $q = $this->m_global->gmd_finance_coa();
                                            if ($q->num_rows() > 0) {
                                                foreach ($q->result_array() as $r) {
                                                    $slc = ($id_kas != '' && $id_kas == $r['id']) ? 'selected="selected"' : '';
                                                    echo '<option value="' . $r['id'] . '" ' . $slc . '>' . $r['id'] . ' - ' . $r['nama'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Card</label>
                                        <select class="form-control" id="id_card" name="id_card" onchange="search();">

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Search Memo</label>
                                        <input type="text" class="form-control" id="search_keyword" name="search_keyword" onkeyup="search();" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>dari tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly value="<?php echo ($id_tgl_awal != '') ? $id_tgl_awal : date('Y-m-d'); ?>" onchange="search();" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>sampai tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly value="<?php echo ($id_tgl_akhir != '') ? $id_tgl_akhir : date('Y-m-d'); ?>" onchange="search();" />
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

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs table-bordered text-size-small">
        <thead>
            <tr>
                <th>no</th>
                <th>tanggal</th>
                <th>no voucher</th>
                <th>jurnal</th>
                <th>no nota</th>
                <th>keterangan</th>
                <th>debet</th>
                <th>kredit</th>
                <th>saldo</th>
            </tr>
        </thead>
    </table>
</div>