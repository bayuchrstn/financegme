<script type="text/javascript">
//google.load("visualization", "1", {packages:["corechart"]});
//google.setOnLoadCallback(load_chart);

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(load_data);

$(function() {
	//load_data_chart();
	load_data();
});

function load_data(){
	table_summary_problem();
	table_top_teen();
	donut_persentase_problem();
	donut_persentase_source_problem();
	bar_total_problem();
	bar_problem_by_category_customer();
	bar_problem_by_external_internal();
}

function table_summary_problem(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'table_summary_problem/'+monthly_year+'/'+monthly_month,
		beforeSend: function(){
			$('#table_summary_problem').html('Loading...');
		},
		success: function(data){
			$('#table_summary_problem').html(data);
		},
	});
}

function table_top_teen(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'table_top_teen/'+monthly_year+'/'+monthly_month,
		beforeSend: function(){
			$('#table_top_teen').html('Loading...');
		},
		success: function(data){
			$('#table_top_teen').html(data);
		},
	});
}

function donut_persentase_problem(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'donut_persentase_problem/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#donut_persentase_problem').html('Loading...');
		},
		success: function(datajson){
			drawDonut('donut_persentase_problem', datajson);
		},
	});
}

function donut_persentase_source_problem(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'donut_persentase_source_problem/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#donut_persentase_source_problem').html('Loading...');
		},
		success: function(datajson){
			drawDonut('donut_persentase_source_problem', datajson);
		},
	});
}

function bar_total_problem(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'bar_total_problem/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#bar_total_problem').html('Loading...');
		},
		success: function(datajson){
			drawLineBarChart('bar_total_problem', datajson, 'Problem', 'Problem', '#4CAF50');
		},
	});
}

function bar_problem_by_category_customer(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'bar_problem_by_category_customer/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#bar_problem_by_category_customer').html('Loading...');
		},
		success: function(datajson){
			drawLineBarChartDouble('bar_problem_by_category_customer', datajson, 'Nama', 'Internal', 'External');
		},
	});
}

function bar_problem_by_external_internal(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'bar_problem_by_external_internal/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#bar_problem_by_external_internal').html('Loading...');
		},
		success: function(datajson){
			drawLineBarChartDouble('bar_problem_by_external_internal', datajson, 'Nama', 'Internal', 'External');
		},
	});
}

function load_chart(){
	load_data_line_cash();
	load_data_line_sales_of_the_year();
	load_data_bar_income_expenses();
	load_data_bar_sales_this_month();
	load_data_bar_expenses_divisi_this_month();
	load_data_bar_expenses_vendor_this_month();
}

function load_data_chart(){
	load_data_line_cash();
	load_data_line_sales_of_the_year();
	load_data_bar_income_expenses();
	load_data_bar_sales_this_month();
	load_data_bar_expenses_divisi_this_month();
	load_data_bar_expenses_vendor_this_month();
	
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_monthly/'+monthly_year+'/'+monthly_month,
		beforeSend: function(){
			$('#total_income, #accounts_receivable, #total_expenses, #accounts_payable, #cash_at_end_of_month, #tax, #net_profit, #sales_this_month, #expenses_divisi_this_month, #expenses_vendor_this_month').html('Loading...');
		},
		success: function(datajson){
			var obj = JSON.parse(datajson);
			$('#total_income').html(obj.total_income);
			$('#accounts_receivable').html(obj.accounts_receivable);
			$('#total_expenses').html(obj.total_expenses);
			$('#accounts_payable').html(obj.accounts_payable);
			$('#cash_at_end_of_month').html(obj.cash_at_end_of_month);
			$('#tax').html(obj.tax);
			$('#net_profit').html(obj.net_profit);
			$('#sales_this_month').html(obj.sales_this_month);
			$('#expenses_divisi_this_month').html(obj.expenses_divisi);
			$('#expenses_vendor_this_month').html(obj.expenses_vendor);
		},
	});
}

function load_data_gp_chart(){
	var pageUri = $('#pageUri').val();
	var gp_monthly_year = $('#gp_monthly_year').val();
	var gp_monthly_month = $('#gp_monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_gp_month/'+gp_monthly_year+'/'+gp_monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#google_donut_gp_month').html('Loading...');
		},
		success: function(datajson){
			drawDonut('google_donut_gp_month', datajson);
		},
	});
}

function drawDonut(id_chart_donut, datajson) {
    var data = google.visualization.arrayToDataTable([
        ['Label', 'Nominal'],
		['', 0]
    ]);
	$.each(datajson, function(i,n){
		data.addRow([''+datajson[i].nama+'', Number(datajson[i].nilai)]);
	});
	
	
	//$('#note_'+id_chart_donut).html(''+datajson[2].nama+''+datajson[2].nilai);
    // Options
    var options_donut = {
        
        // "colors": ["#ff3d00", "#00bcd4", "#9c27b0", "#607d8b", "#ccc"],
         "width": "100%",
         "height": "100%",
         "chartArea": {
             "width": "100%",
             "height": "60%"
         },
		 //is3D: true,
         "pieSliceText": "none",
         "legend": {
             "position": "labeled"
         },
         "pieStartAngle": -165,
         "pieHole": 0
    };
    
    // Instantiate and draw our chart, passing in some options.
    var donut = new google.visualization.PieChart($('#'+id_chart_donut)[0]);
    donut.draw(data, options_donut);
}

function load_data_line_cash(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_cash_month/'+monthly_year,
		dataType: "json",
		beforeSend: function(){
			$('#chart_cash_at_end_of_month').html('Loading...');
		},
		success: function(datajson){
			drawLineChart('chart_cash_at_end_of_month', datajson, 'Cash of the year', '#FF9B12');
		},
	});
}

function load_data_line_sales_of_the_year(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_sales_of_the_year/'+monthly_year,
		dataType: "json",
		beforeSend: function(){
			$('#chart_sales_of_the_year').html('Loading...');
		},
		success: function(datajson){
			drawLineChart('chart_sales_of_the_year', datajson, 'Sales', '#4CAF50');
		},
	});
}

function load_data_bar_expenses_divisi_this_month(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_expenses_divisi_this_month/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#chart_expenses_divisi_this_month').html('Loading...');
		},
		success: function(datajson){
			drawLineBarChart('chart_expenses_divisi_this_month', datajson, 'Divisi', 'Expenses', '#EF5350');
		},
	});
}

function load_data_bar_expenses_vendor_this_month(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_expenses_vendor_this_month/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#chart_expenses_vendor_this_month').html('Loading...');
		},
		success: function(datajson){
			drawLineBarChart('chart_expenses_vendor_this_month', datajson, 'Vendor', 'Expenses', '#EF5350');
		},
	});
}

function drawLineChart(id_chart, datajson, title, warna) {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Bulan', title],
        [''+datajson['01'].nama+'', Number(datajson['01'].nilai)],
        [''+datajson['02'].nama+'', Number(datajson['02'].nilai)],
        [''+datajson['03'].nama+'', Number(datajson['03'].nilai)],
        [''+datajson['04'].nama+'', Number(datajson['04'].nilai)],
        [''+datajson['05'].nama+'', Number(datajson['05'].nilai)],
        [''+datajson['06'].nama+'', Number(datajson['06'].nilai)],
        [''+datajson['07'].nama+'', Number(datajson['07'].nilai)],
        [''+datajson['08'].nama+'', Number(datajson['08'].nilai)],
        [''+datajson['09'].nama+'', Number(datajson['09'].nilai)],
        [''+datajson['10'].nama+'', Number(datajson['10'].nilai)],
        [''+datajson['11'].nama+'', Number(datajson['11'].nilai)],
        [''+datajson['12'].nama+'', Number(datajson['12'].nilai)],
    ]);

    // Options
    var options = {
        fontName: 'Tahoma',
        height: 250,
        curveType: 'none',
        fontSize: 12,
        chartArea: {
            left: '15%',
            width: '90%',
            height: 200
        },
        pointSize: 4,
        tooltip: {
            textStyle: {
                fontName: 'Tahoma',
                fontSize: 13
            }
        },
        vAxis: {
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        },
               colors: [warna]
    };

    // Draw chart
    var line_chart = new google.visualization.LineChart($('#'+id_chart)[0]);
    line_chart.draw(data, options);
}

function drawLineIncomeExpenses(id_chart, datajson) {

// Data
    var data = google.visualization.arrayToDataTable([
        ['Problem', 'Internal', 'External'],
		['', 0, 0]
    ]);
	$.each(datajson, function(i,n){
		data.addRow([''+datajson[i].nama+'', Number(datajson[i].internal), Number(datajson[i].external)]);
	});
    // Options
    var options_column = {
        fontName: 'Tahoma',
        height: 500,
        fontSize: 12,
        chartArea: {
            left: '15%',
            width: '90%',
            height: 200
        },
        seriesType: "bars",
        tooltip: {
            textStyle: {
                fontName: 'Tahoma',
                fontSize: 13
            }
        },
        vAxis: {
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        },
        colors: ['#03A9F4', '#EF5350']
    };

    // Draw chart
    var column = new google.visualization.ComboChart($('#'+id_chart)[0]);
    column.draw(data, options_column);
}

function drawLineBarChart(id_chart, datajson, judul1, judul2, warna) {
//var data = google.visualization.DataTable();
// Data

    var data = google.visualization.arrayToDataTable([
        [judul1, judul2],
		['', 0]
        //[''+datajson['Hamidin'].nama+'', Number(datajson['Hamidin'].rupiah)],
    ]);
	
		//data.addRow([''+datajson[1].nama+'', Number(datajson[1].rupiah)]);
			/*
			data.addRows([
			  [''+datajson[0].nama+'', Number(datajson[0].rupiah)]
			]);
*/
		//data.addColumn('string', 'Sales');
		//data.addColumn('string', 'Revenue');
		$.each(datajson, function(i,n){
			data.addRow([''+datajson[i].nama+'', Number(datajson[i].nilai)]);
			//[''+datajson[i].nama+'', Number(datajson[i].rupiah)],
		});
    // Options
    var options_column = {
        fontName: 'Tahoma',
        height: 500,
        fontSize: 12,
        chartArea: {
            left: '35%',
            width: '90%',
            height: 450
        },
        tooltip: {
            textStyle: {
                fontName: 'Tahoma',
                fontSize: 13
            }
        },
        vAxis: {
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        },
        colors: [warna]
    };

    // Draw chart
    var column = new google.visualization.BarChart($('#'+id_chart)[0]);
    column.draw(data, options_column);
}

function drawLineBarChartDouble(id_chart, datajson, judul1, judul2, judul3) {
//var data = google.visualization.DataTable();
// Data

    var data = google.visualization.arrayToDataTable([
        [judul1, judul2, judul3],
		['', 0, 0]
        //[''+datajson['Hamidin'].nama+'', Number(datajson['Hamidin'].rupiah)],
    ]);
	
		//data.addRow([''+datajson[1].nama+'', Number(datajson[1].rupiah)]);
			/*
			data.addRows([
			  [''+datajson[0].nama+'', Number(datajson[0].rupiah)]
			]);
*/
		//data.addColumn('string', 'Sales');
		//data.addColumn('string', 'Revenue');
		$.each(datajson, function(i,n){
			data.addRow([''+datajson[i].nama+'', Number(datajson[i].internal), Number(datajson[i].external)]);
			//[''+datajson[i].nama+'', Number(datajson[i].rupiah)],
		});
    // Options
    var options_column = {
        fontName: 'Tahoma',
        height: 500,
        fontSize: 12,
        chartArea: {
            left: '35%',
            width: '90%',
            height: 450
        },
        tooltip: {
            textStyle: {
                fontName: 'Tahoma',
                fontSize: 13
            }
        },
        vAxis: {
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    // Draw chart
    var column = new google.visualization.BarChart($('#'+id_chart)[0]);
    column.draw(data, options_column);
}

</script>
