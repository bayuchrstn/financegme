<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
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
                                    <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly="readonly" value="<?php echo date('Y-m-01') ?>"/> 
                                    </div>
                                    <div class="col-lg-6">
                                    <label>sampai tanggal</label>
                                    <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly="readonly" value="<?php echo date('Y-m-t') ?>"/><br />
                                    </div>
                                </div>
                                <div class="row">
                                    <label>kas / bank</label>
                                    <select class="form-control" id="searchkas_bank" name="searchkas_bank">
                                        <option value="0">ALL</option>
                                        <?php
                                            $q = $this->finance_transaksi_kasir_out->finance_bank();
                                            if($q->num_rows() > 0){
                                                foreach($q->result_array() as $r){
                                                    echo '<option value="'.$r['id'].'">'.$r['name'].' ('.$r['account_number'].' / '.$r['account_name'].')</option>';
                                                }
                                            }
                                        ?>
                                    </select>
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
                <th>no</th>
                <th>tanggal</th>
                <th>divisi</th>
                <th>fixcost</th>
                <th>jumlah</th>
                <th>kas</th>
                <th>deskripsi</th>
                <th><i class="icon-menu7 position-left"></i></th>
            </tr>
        </thead>
    </table>
</div>	
<?php echo $insert_view; ?>
