<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<div class="panel">
    <div class="panel-heading">
        <h6 class="panel-title"><span class="text-black"><i class="icon-stats-growth position-left text-teal"></i> <?php //echo $title_page_table ?>NOC</span></h6>
        <div class="heading-elements">
            <div class="col-lg-7">
                <select class="form-control" id="monthly_month" onchange="load_data();">
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
                <select class="form-control" id="monthly_year" onchange="load_data();">
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
                <center><i class="icon-podium position-left text-info-800"></i> <span class="text-semibold">Top 10 Problem</span></center>
            </div>
            <div class="panel-body table-responsive" id="table_top_teen"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-pie-chart5 position-left text-success-800"></i> <span class="text-semibold">Persentase Problem</span></center>
            </div>
            <div class="panel-body table-responsive" id="donut_persentase_problem" style="height:500px;"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-success-800"></i> <span class="text-semibold">Total Problem</span></center>
            </div>
            <div class="panel-body table-responsive" id="bar_total_problem"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-danger-800"></i> <span class="text-semibold">Persentase Source Problem</span></center>
            </div>
            <div class="panel-body table-responsive" id="donut_persentase_source_problem" style="height:540px;"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars4 position-left text-info-800"></i> <span class="text-semibold">Problem by Category Customer</span></center>
            </div>
            <div class="panel-body table-responsive" id="bar_problem_by_category_customer"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars4 position-left text-info-800"></i> <span class="text-semibold">External vs Internal</span></center>
            </div>
            <div class="panel-body table-responsive" id="bar_problem_by_external_internal"></div>
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
