<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table ?></h6>
    </div>

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs text-size-small">
        <thead>
            <tr>
                <th>no</th>
                <th>tanggal close Accounting</th>
                <th><i class="icon-menu7 position-left"></i></th>
            </tr>
        </thead>
    </table>
</div>	





<?php echo $insert_view; ?>
