<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<div class="panel">
    <div class="panel-heading">
        <h6 class="panel-title"><span class="text-black"><i class="icon-stats-bars position-left text-teal"></i> <?php //echo $title_page_table ?>Marketing</span></h6>
        <div class="heading-elements">
            <div class="col-lg-7">
                <select class="form-control" id="monthly_month" onchange="load_data_chart();">
                        <option value="01" <?php echo ((date('m') == '01')?'selected="selected"':'')?> >Januari</option>
                        <option value="02" <?php echo ((date('m') == '02')?'selected="selected"':'')?> >Februari</option>
                        <option value="03" <?php echo ((date('m') == '03')?'selected="selected"':'')?> >Maret</option>
                        <option value="04" <?php echo ((date('m') == '04')?'selected="selected"':'')?> >April</option>
                        <option value="05" <?php echo ((date('m') == '05')?'selected="selected"':'')?> >Mei</option>
                        <option value="06" <?php echo ((date('m') == '06')?'selected="selected"':'')?> >Juni</option>
                        <option value="07" <?php echo ((date('m') == '07')?'selected="selected"':'')?> >Juli</option>
                        <option value="08" <?php echo ((date('m') == '08')?'selected="selected"':'')?> >Agustus</option>
                        <option value="09" <?php echo ((date('m') == '09')?'selected="selected"':'')?> >September</option>
                        <option value="10" <?php echo ((date('m') == '10')?'selected="selected"':'')?> >Oktober</option>
                        <option value="11" <?php echo ((date('m') == '11')?'selected="selected"':'')?> >November</option>
                        <option value="12" <?php echo ((date('m') == '12')?'selected="selected"':'')?> >Desember</option>
                </select> 
            </div>
            <div class="col-lg-5">
                <select class="form-control" id="monthly_year" onchange="load_data_chart();">
                    <?php
                    $j = 2018;
                    for($i = date('Y'); $i >= $j; $i--){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>    

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-success"></i> <span class="text-semibold">Sales of this month</span></center>
            </div>
            <div class="panel-body"><h2 id="chart_sales_this_month" style="text-align:center;"></h2></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-dots position-left text-success"></i> <span class="text-semibold">Sales of the year</span></center>
            </div>
            <div class="panel-body"><h2 id="chart_sales_of_the_year" style="text-align:center;"></h2></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-dots position-left text-success"></i> <span class="text-semibold">Sales by month</span></center>
            </div>
            <div class="panel-body"><h2 id="chart_sales_by_month" style="text-align:center;"></h2></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-dots position-left text-success"></i> <span class="text-semibold">Sales by marketing</span></center>
            </div>
            <div class="panel-body"><h2 id="chart_sales_by_mkt" style="text-align:center;"></h2></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars position-left text-success-800"></i> <span class="text-semibold">Detail Summary</span></center>
            </div>
            <div class="panel-body table-responsive" id="table_summary_problem"></div>
        </div>
    </div>
</div>
