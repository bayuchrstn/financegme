<?php
$id_kas = ($this->uri->segment(3) != '')?$this->uri->segment(3):'';
$id_search = ($this->uri->segment(4) != '')?$this->uri->segment(4):'';
$id_tgl_awal = ($this->uri->segment(5) != '')?$this->uri->segment(5):'';
$id_tgl_akhir = ($this->uri->segment(6) != '')?$this->uri->segment(6):'';
$id_tgl_akhir2 = ($this->uri->segment(7) != '')?$this->uri->segment(7):'';

?>
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
                                        <label>jenis</label>
                                        <select class="form-control" id="searchtipe" name="searchtipe">
                                            <option value="">ALL</option>
                                            <option value="1">Masukan / Bukti Potong</option>
                                            <option value="0">Keluaran / Terbit</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>kategori</label>
                                        <select class="form-control" id="searchtax_type" name="searchtax_type">
                                            <option value="">ALL</option>
                                            <?php
                                                $q = $this->model_global->gmd_finance_master_cat_tax_type();
                                                if($q->num_rows() > 0){
                                                    foreach($q->result_array() as $r){
                                                        echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-lg-6">
                                        <label>cabang</label>
                                        <select class="form-control" id="searchcabang" name="searchcabang">
                                            <option value="">ALL</option>
                                            <?php
                                                $q = $this->model_global->gmd_regional();
                                                if($q->num_rows() > 0){
                                                    foreach($q->result_array() as $r){
                                                        echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>faktur</label>
                                        <select class="form-control" id="searchmsa" name="searchmsa">
                                            <option value="">ALL</option>
                                            <option value="0">MSD</option>
                                            <option value="1">MSA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-lg-6">
                                        <label>dari tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly value="<?php echo ($id_tgl_awal != '')?$id_tgl_awal:date('Y-m-01'); ?>"/> 
                                    </div>
                                    <div class="col-lg-6">
                                        <label>sampai tanggal</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly value="<?php echo ($id_tgl_akhir != '')?$id_tgl_akhir:date('Y-m-t'); ?>"/><br />
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-lg-12">
                                        <label>search</label>
                                        <input class="form-control" type="text" id="search_keyword" name="search_keyword" />
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
                <th>tanggal</th>
                <th>jenis</th>
                <th>kategori</th>
                <th>cabang</th>
                <th>faktur</th>
                <th>no seri faktur</th>
                <th>nama PKP</th>
                <th>jumlah</th>
            </tr>
        </thead>
    </table>
</div>	
