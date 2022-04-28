<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<div class="panel">
    <div class="panel-heading">
        <h6 class="panel-title"><span class="text-black"><i class="icon-stats-growth position-left text-teal"></i> <?php
                                                                                                                    ?>Finance & Tax</span></h6>
        <div class="heading-elements">
            <div class="col-lg-7">
                <select class="form-control" id="monthly_month" onchange="load_data_chart();">
                    <option value="01" <?php echo ((date('m') == '01') ? 'selected="selected"' : '') ?>>Januari</option>
                    <option value="02" <?php echo ((date('m') == '02') ? 'selected="selected"' : '') ?>>Februari</option>
                    <option value="03" <?php echo ((date('m') == '03') ? 'selected="selected"' : '') ?>>Maret</option>
                    <option value="04" <?php echo ((date('m') == '04') ? 'selected="selected"' : '') ?>>April</option>
                    <option value="05" <?php echo ((date('m') == '05') ? 'selected="selected"' : '') ?>>Mei</option>
                    <option value="06" <?php echo ((date('m') == '06') ? 'selected="selected"' : '') ?>>Juni</option>
                    <option value="07" <?php echo ((date('m') == '07') ? 'selected="selected"' : '') ?>>Juli</option>
                    <option value="08" <?php echo ((date('m') == '08') ? 'selected="selected"' : '') ?>>Agustus</option>
                    <option value="09" <?php echo ((date('m') == '09') ? 'selected="selected"' : '') ?>>September</option>
                    <option value="10" <?php echo ((date('m') == '10') ? 'selected="selected"' : '') ?>>Oktober</option>
                    <option value="11" <?php echo ((date('m') == '11') ? 'selected="selected"' : '') ?>>November</option>
                    <option value="12" <?php echo ((date('m') == '12') ? 'selected="selected"' : '') ?>>Desember</option>
                </select>
            </div>
            <div class="col-lg-5" style="padding-right:0px">
                <select class="form-control" id="monthly_year" onchange="load_data_chart();">
                    <?php
                    $j = 2018;
                    for ($i = date('Y'); $i >= $j; $i--) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-3">
        <div class="panel panel-white">
            <div class="panel-body text-center">
                <h6 class="text-semibold no-margin"><i class="icon-cash position-left text-slate"></i> <span class="text-black" id="total_income"></span></h6>
                <span class="text-size-small">Income</span>
            </div>
        </div>
    </div>
    <!-- <div class="col-xs-2">
        <div class="panel panel-white">
            <div class="panel-body text-center">
                <h6 class="text-semibold no-margin"><i class="icon-cash position-left text-slate"></i> <span class="text-black" id="total_expenses"></span></h6>
                <span class="text-size-small ">Expenses</span>
            </div>
        </div>
    </div> -->
    <div class="col-xs-3">
        <div class="panel panel-white">
            <div class="panel-body text-center">
                <h6 class="text-semibold no-margin"><i class="icon-cash position-left text-slate"></i> <span class="text-black" id="tax"></span></h6>
                <span class="text-size-small">Tax</span>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="panel panel-white">
            <div class="panel-body text-center">
                <h6 class="text-semibold no-margin"><i class="icon-cash position-left text-slate"></i> <span class="text-black text-success-800" id="net_profit"></span></h6>
                <span class="text-size-small">Net Profit</span>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="panel panel-white">
            <div class="panel-body text-center">
                <h6 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> <span class="text-black text-primary-800" id="accounts_receivable"></span></h6>
                <span class="text-size-small">AR
                    <span class="text-size-small badge badge-success" style="width:35px;" id="accounts_receivable_1">0</span>
                    <span class="text-size-small badge bg-orange" style="width:35px;" id="accounts_receivable_2">0</span>
                    <span class="text-size-small badge badge-danger" style="width:35px;" id="accounts_receivable_3">0</span></span>
            </div>
        </div>
    </div>
    <!-- <div class="col-xs-2">
        <div class="panel panel-white">
            <div class="panel-body text-center">
                <h6 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> <span class="text-black text-danger-800" id="accounts_payable"></span></h6>
                <span class="text-size-small">Accounts Payable</span>
            </div>
        </div>
    </div> -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-chart position-left text-orange"></i> <span class="text-semibold">Net Profit of the year</span></center>
            </div>
            <div class="panel-body">
                <h2 id="chart_income_expenses" style="text-align:center;"></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-dots position-left text-orange"></i> <span class="text-semibold">Cash of this month : </span><span class="text-black" id="cash_at_end_of_month"></span></center>
            </div>
            <div class="panel-body">
                <h2 id="chart_cash_at_end_of_month" style="text-align:center;"></h2>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-danger"></i> <span class="text-semibold">Expense by divisi of this month : </span><span class="text-black" id="expenses_divisi_this_month"></span></center>
            </div>
            <div class="panel-body"><h2 id="chart_expenses_divisi_this_month" style="text-align:center;"></h2></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-danger"></i> <span class="text-semibold">Expense by vendor of this month : </span><span class="text-black" id="expenses_vendor_this_month"></span></center>
            </div>
            <div class="panel-body"><h2 id="chart_expenses_vendor_this_month" style="text-align:center;"></h2></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-success"></i> <span class="text-semibold">Forecast Income of this month : </span><span class="text-black" id="forecast_income_this_month"></span></center>
            </div>
            <div class="panel-body"><h2 id="chart_forecast_income_this_month" style="text-align:center;"></h2></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <center><i class="icon-stats-bars2 position-left text-danger"></i> <span class="text-semibold">Forecast Expenses of this month : </span><span class="text-black" id="forecast_expenses_this_month"></span></center>
            </div>
            <div class="panel-body"><h2 id="chart_forecast_expenses_this_month" style="text-align:center;"></h2></div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-stats-bars position-left text-teal"></i> <span class="text-black">Marketing</span></h6>
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
</div> -->