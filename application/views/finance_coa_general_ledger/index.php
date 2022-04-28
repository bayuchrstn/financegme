<?php
$time = strtotime(date("Y-m-01"));
$date_start = date("Y-m-01", strtotime("-1 month", $time));
$date_finish = date("Y-m-t", strtotime("+1 month", $time));
?>
<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<input type="hidden" id="index3" value="<?php echo $this->uri->segment(3); ?>" />
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table ?></h6>
        <div class="heading-elements">
            <form id="formsearch" onSubmit="return false;">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button id="button_dropdown_search" type="button" class="btn dropdown-toggle btn-icon btn-default btn-raised" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu dropdown-content" style="width:395px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>kategori Jurnal</label>
                                        <select class="form-control" id="searchkat_gl" name="searchkat_gl" onchange="search();">
                                            <option value="0">SEMUA</option>
                                            <?php
                                            $q = $this->m_global->finance_master_kat_gl();
                                            if ($q->num_rows() > 0) {
                                                foreach ($q->result_array() as $r) {
                                                    echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Account</label>
                                        <select class="form-control" id="id_biaya" name="id_biaya" onchange="get_coa();search();">
                                            <option value="">ALL</option>
                                            <?php
                                            $q = $this->m_global->gmd_finance_coa();
                                            if ($q->num_rows() > 0) {
                                                foreach ($q->result_array() as $r) {
                                                    echo '<option value="' . $r['id'] . '">' . $r['id'] . ' - ' . $r['nama'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Card</label>
                                        <select class="form-control" id="id_card" name="id_card" onchange="search();">

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

    <table id="datamain_datatable" class="table datatable-ajax table-bordered table-xxs text-size-small" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>no</th>
                <th>no trx</th>
                <th>tanggal</th>
                <th>kode jurnal</th>
                <th>deskripsi</th>
                <th>no akun</th>
                <th>nama akun</th>
                <th>card name</th>
                <th>memo</th>
                <th>debet</th>
                <th>kredit</th>
                <th><i class="icon-menu7 position-left"></i></th>
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
                <th style="text-align:center"></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
<?php echo $insert_view; ?>