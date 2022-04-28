<?php
$time = strtotime(date("Y-m-01"));
$date_start = date("Y-m-01", strtotime("-1 month", $time));
$date_finish = date("Y-m-t", strtotime("+1 month", $time));
?>
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
                                    <div class="form-group">
                                        <label>status customer</label>
                                        <select class="form-control" id="searchstatus" name="searchstatus">
                                            <option value="">SEMUA</option>
                                            <option value="0" selected="selected">AKTIF</option>
                                            <option value="1">NON AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>billing cycle</label>
                                        <select class="form-control" id="searchbilling_cycle" name="searchbilling_cycle">
                                            <option value="" selected="selected">SEMUA</option>
                                            <option value="0">TIDAK</option>
                                            <option value="1">YA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>kategori invoice</label>
                                        <select class="form-control" id="searchkat_inv" name="searchkat_inv">
                                            <option value="0">SEMUA</option>
                                            <option value="1">PPN</option>
                                            <option value="2">NON PPN</option>
                                            <option value="3">MAXI</option>
                                            <option value="4">CABANG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>kategori customer</label>
                                        <select class="form-control" id="searchkategori" name="searchkategori">
                                            <option value="0">SEMUA</option>
                                            <?php
                                                $q = $this->m_global->kategori();
                                                if($q->num_rows() > 0){
                                                    foreach($q->result_array() as $r){
                                                        echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                                                    }
                                                }
                                            ?>
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
                <th>no</th>
                <th>service id</th>
                <th>customer id</th>
                <th>nama</th>
                <th>alamat</th>
                <th>telp</th>
                <th>status</th>
                <th>billing cycle</th>
                <th>ppn</th>
                <th>maxi</th>
                <th>cabang</th>
                <th>pelanggan</th>
                <th><i class="icon-menu7 position-left"></i></th>
            </tr>
        </thead>
    </table>
</div>	




<?php echo $insert_view; ?>
