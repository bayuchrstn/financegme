<?php
$id_kas = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : '';
$id_search = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : '';
$id_tgl_awal = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : '';
$id_tgl_akhir = ($this->uri->segment(6) != '') ? $this->uri->segment(6) : '';
$id_tgl_akhir2 = ($this->uri->segment(7) != '') ? $this->uri->segment(7) : '';

?>
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
                                <!-- <div class="row">
                                    <div class="col-lg-12">
                                        <label>kas</label>
                                        <select class="form-control" id="searchKasBank" name="searchKasBank">
                                            <?php
                                            $kat = $this->m_global->finance_bank();
                                            if ($kat->num_rows() > 0) {
                                                foreach ($kat->result_array() as $r) {
                                                    $slc = ($id_kas != '' && $id_kas == $r['id']) ? 'selected="selected"' : '';
                                                    echo '<option value="' . $r['id'] . '" ' . $slc . '>' . $r['name'] . ' (' . $r['account_number'] . ' / ' . $r['account_name'] . ')</option>';
                                                }
                                            }
                                            $kat->free_result();
                                            ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Cabang</label>
                                        <select class="form-control" id="searchKasBank" name="searchKasBank" onchange="search();">
                                            <option value="1">Semarang</option>
                                            <option value="2">Salatiga</option>
                                            <!-- <?php
                                                    $kat = $this->m_global->finance_bank();
                                                    if ($kat->num_rows() > 0) {
                                                        foreach ($kat->result_array() as $r) {
                                                            $slc = ($id_kas != '' && $id_kas == $r['id']) ? 'selected="selected"' : '';
                                                            echo '<option value="' . $r['id'] . '" ' . $slc . '>' . $r['name'] . ' (' . $r['account_number'] . ' / ' . $r['account_name'] . ')</option>';
                                                        }
                                                    }
                                                    $kat->free_result();
                                                    ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>periode</label>
                                        <select class="form-control" id="searchTanggal" name="searchTanggal" onchange="select_date();search();">
                                            <option value="1" <?php echo ($id_search != '' && $id_search == '1') ? 'selected="selected"' : ''; ?>>DATE RANGE</option>
                                            <option value="3" <?php echo ($id_search != '' && $id_search == '3') ? 'selected="selected"' : ''; ?>>DATE</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="date_selected" class="row">
                                    <div class="col-lg-6">
                                        <label>dari tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly="readonly" value="<?php echo ($id_tgl_awal != '') ? $id_tgl_awal : date('Y-m-01'); ?>" onchange="search();" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>sampai tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly="readonly" value="<?php echo ($id_tgl_akhir != '') ? $id_tgl_akhir : date('Y-m-t'); ?>" onchange="search();" /><br />
                                    </div>
                                </div>
                                <div id="date_closed" style="display:none;;" class="row">
                                    <div class="col-lg-6">
                                        <label>tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish2" name="searchDateFinish2" readonly="readonly" value="<?php echo ($id_tgl_akhir2 != '') ? $id_tgl_akhir2 : date('Y-m-t'); ?>" onchange="search();" />
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

    <table id="datamain_datatable" style="width:100%" class="table datatable-ajax table-striped table-xxs table-bordered text-size-small">
        <thead>
            <tr>
                <th>no</th>
                <th>tanggal</th>
                <th>kode</th>
                <th>coa</th>
                <th>card id</th>
                <th>card name</th>
                <th>keterangan</th>
                <th>debet</th>
                <th>kredit</th>
                <th>saldo</th>
            </tr>
        </thead>
    </table>
</div>