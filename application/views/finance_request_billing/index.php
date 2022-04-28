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
                <th>tanggal request</th>
                <th>marketing</th>
                <th>customer ID</th>
                <th>service ID</th>
                <th>customer</th>
                <th><i class="icon-menu7 position-left"></i></th>
            </tr>
        </thead>
    </table>
</div>	




<?php echo $insert_view; ?>
