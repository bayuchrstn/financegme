<?php
$time = strtotime(date("Y-m-01"));
$date_start = date("Y-m-01", strtotime("-0 month", $time));
//$date_start = date("Y-04-01");
$date_finish = date("Y-m-t", strtotime("+0 month", $time));

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
                                    <div class="col-lg-6">
                                        <label>kategori</label>
                                        <select class="form-control" id="searchkategori" name="searchkategori">
                                            <option value="0"></option>
                                            <?php
                                                $q = $this->finance_invoice_adj_ar->kategori();
                                                if($q->num_rows() > 0){
                                                    foreach($q->result_array() as $r){
                                                        echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>kategori invoice</label>
                                        <select class="form-control" id="searchkat_inv" name="searchkat_inv">
                                            <option value="0"></option>
                                            <option value="1">PPN</option>
                                            <option value="2">NON PPN</option>
                                            <option value="3">MAXI</option>
                                            <option value="4">CABANG</option>
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
                                        <input type="text" class="form-control date_picker" id="searchDateFirst" name="searchDateFirst" readonly value="<?php echo $date_start ?>"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>status lunas</label>
                                        <input type="text" class="form-control date_picker" id="searchDateFinish" name="searchDateFinish" readonly value="<?php echo $date_finish ?>"/><br />
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                <input type="text" class="form-control" style="width:250px;" placeholder="Pencarian" id="search_keyword" name="search_keyword">
                
                <div class="input-group-btn">
                    <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i></b></button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs text-size-small">
        <thead>
            <tr>
                <th>no</th>
                <th>inv date</th>
                <th>due date</th>
                <th>no invoice</th>
                <th>customer</th>
                <th>pph 23</th>
                <th>mf</th>
                <th>bupot PPN</th>
                <th><i class="icon-menu7 position-left"></i></th>
            </tr>
        </thead>
    </table>
</div>	

<?php echo $insert_view; ?>
