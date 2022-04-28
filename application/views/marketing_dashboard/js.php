<script type="text/javascript">
//google.load("visualization", "1", {packages:["corechart"]});
//google.setOnLoadCallback(load_chart);

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(load_chart);

$(function() {
	load_data_chart();
});

function load_chart(){
	table_summary_problem();
	load_data_line_sales_of_the_year();
	load_data_bar_sales_this_month();
	load_data_bar_chart_sales_by_month();
	load_data_bar_chart_sales_by_mtk();
}

function load_data_chart(){
	table_summary_problem();
	load_data_line_sales_of_the_year();
	load_data_bar_sales_this_month();
	load_data_bar_chart_sales_by_month();
	load_data_bar_chart_sales_by_mtk();
	
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();
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

function drawDonut(id_chart_donut, datajson) {
    // Data
    var data = google.visualization.arrayToDataTable([
        ['Label', 'Nominal'],
        [''+datajson[0].nama+'', Number(datajson[0].nilai)],
        [''+datajson[1].nama+'', Number(datajson[1].nilai)],
    ]);
	$('#note_'+id_chart_donut).html(''+datajson[2].nama+''+datajson[2].nilai);
    // Options
    var options_donut = {
        fontName: 'Tahoma',
        pieHole: 0.55,
        height: 250,
        width: 250,
        chartArea: {
            left: 40,
            width: '90%',
            height: '90%'
        }
    };
    
    // Instantiate and draw our chart, passing in some options.
    var donut = new google.visualization.PieChart($('#'+id_chart_donut)[0]);
    donut.draw(data, options_donut);
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
			drawLineChartDouble('chart_sales_of_the_year', datajson, 'Aktif', 'Non Aktif', '#4CAF50', '#EF5350');
		},
	});
}

function load_data_bar_chart_sales_by_month(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_sales_by_month/'+monthly_year,
		dataType: "json",
		beforeSend: function(){
			$('#chart_sales_by_month').html('Loading...');
		},
		success: function(datajson){
			drawLineColumnChartSingle('chart_sales_by_month', datajson, 'Sales', '#4CAF50');
		},
	});
}

function load_data_bar_chart_sales_by_mtk(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_sales_by_mkt/'+monthly_year,
		dataType: "json",
		beforeSend: function(){
			$('#chart_sales_by_mkt').html('Loading...');
		},
		success: function(datajson){
			drawLineColumnChartSingleAuto('chart_sales_by_mkt', datajson, 'Sales', '#4CAF50');
		},
	});
}

function load_data_bar_sales_this_month(){
	var pageUri = $('#pageUri').val();
	var monthly_year = $('#monthly_year').val();
	var monthly_month = $('#monthly_month').val();

	$.ajax({
		type:'GET', 
		url: pageUri+'select_data_sales_this_month/'+monthly_year+'/'+monthly_month,
		dataType: "json",
		beforeSend: function(){
			$('#chart_sales_this_month').html('Loading...');
		},
		success: function(datajson){
			drawLineBarChartDouble('chart_sales_this_month', datajson, 'Sales', 'Aktif', 'Non Aktif', '#4CAF50', '#EF5350');
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
        ['Bulan', 'Income', 'Expenses', 'Tax', 'Net Profit'],
        [''+datajson['01'].nama+'', Number(datajson['01'].income), Number(datajson['01'].expenses), Number(datajson['01'].tax), Number(datajson['01'].net)],
        [''+datajson['02'].nama+'', Number(datajson['02'].income), Number(datajson['02'].expenses), Number(datajson['02'].tax), Number(datajson['02'].net)],
        [''+datajson['03'].nama+'', Number(datajson['03'].income), Number(datajson['03'].expenses), Number(datajson['03'].tax), Number(datajson['03'].net)],
        [''+datajson['04'].nama+'', Number(datajson['04'].income), Number(datajson['04'].expenses), Number(datajson['04'].tax), Number(datajson['04'].net)],
        [''+datajson['05'].nama+'', Number(datajson['05'].income), Number(datajson['05'].expenses), Number(datajson['05'].tax), Number(datajson['05'].net)],
        [''+datajson['06'].nama+'', Number(datajson['06'].income), Number(datajson['06'].expenses), Number(datajson['06'].tax), Number(datajson['06'].net)],
        [''+datajson['07'].nama+'', Number(datajson['07'].income), Number(datajson['07'].expenses), Number(datajson['07'].tax), Number(datajson['07'].net)],
        [''+datajson['08'].nama+'', Number(datajson['08'].income), Number(datajson['08'].expenses), Number(datajson['08'].tax), Number(datajson['08'].net)],
        [''+datajson['09'].nama+'', Number(datajson['09'].income), Number(datajson['09'].expenses), Number(datajson['09'].tax), Number(datajson['09'].net)],
        [''+datajson['10'].nama+'', Number(datajson['10'].income), Number(datajson['10'].expenses), Number(datajson['10'].tax), Number(datajson['10'].net)],
        [''+datajson['11'].nama+'', Number(datajson['11'].income), Number(datajson['11'].expenses), Number(datajson['11'].tax), Number(datajson['11'].net)],
        [''+datajson['12'].nama+'', Number(datajson['12'].income), Number(datajson['12'].expenses), Number(datajson['12'].tax), Number(datajson['12'].net)],
    ]);


    // Options
    var options_column = {
        fontName: 'Tahoma',
        height: 250,
        fontSize: 12,
        chartArea: {
            left: '15%',
            width: '90%',
            height: 200
        },
        seriesType: "bars",
        series: {
            3: {
                type: "line",
                pointSize: 2
            }
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
        colors: ['#03A9F4', '#EF5350', '#000000', '#FF9B12']
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
			data.addRow([''+datajson[i].nama+'', Number(datajson[i].rupiah)]);
			//[''+datajson[i].nama+'', Number(datajson[i].rupiah)],
		});
    // Options
    var options_column = {
        fontName: 'Tahoma',
        height: 250,
        fontSize: 12,
        chartArea: {
            left: '35%',
            width: '90%',
            height: 200
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

function drawLineBarChartDouble(id_chart, datajson, judul1, judul2, judul3, warna, warna2) {
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
			data.addRow([''+datajson[i].nama+'', Number(datajson[i].nominal1), Number(datajson[i].nominal2)]);
			//[''+datajson[i].nama+'', Number(datajson[i].rupiah)],
		});
    // Options
    var options_column = {
        fontName: 'Tahoma',
        height: 250,
        fontSize: 12,
        chartArea: {
            left: '35%',
            width: '90%',
            height: 200
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
        colors: [warna, warna2]
    };

    // Draw chart
    var column = new google.visualization.BarChart($('#'+id_chart)[0]);
    column.draw(data, options_column);
}

function drawLineChartDouble(id_chart, datajson, title, title2, warna, warna2) {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Bulan', title, title2],
        [''+datajson['01'].nama+'', Number(datajson['01'].nilai), Number(datajson['01'].nilai2)],
        [''+datajson['02'].nama+'', Number(datajson['02'].nilai), Number(datajson['02'].nilai2)],
        [''+datajson['03'].nama+'', Number(datajson['03'].nilai), Number(datajson['03'].nilai2)],
        [''+datajson['04'].nama+'', Number(datajson['04'].nilai), Number(datajson['04'].nilai2)],
        [''+datajson['05'].nama+'', Number(datajson['05'].nilai), Number(datajson['05'].nilai2)],
        [''+datajson['06'].nama+'', Number(datajson['06'].nilai), Number(datajson['06'].nilai2)],
        [''+datajson['07'].nama+'', Number(datajson['07'].nilai), Number(datajson['07'].nilai2)],
        [''+datajson['08'].nama+'', Number(datajson['08'].nilai), Number(datajson['08'].nilai2)],
        [''+datajson['09'].nama+'', Number(datajson['09'].nilai), Number(datajson['09'].nilai2)],
        [''+datajson['10'].nama+'', Number(datajson['10'].nilai), Number(datajson['10'].nilai2)],
        [''+datajson['11'].nama+'', Number(datajson['11'].nilai), Number(datajson['11'].nilai2)],
        [''+datajson['12'].nama+'', Number(datajson['12'].nilai), Number(datajson['12'].nilai2)],
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
               colors: [warna, warna2]
    };

    // Draw chart
    var line_chart = new google.visualization.LineChart($('#'+id_chart)[0]);
    line_chart.draw(data, options);
}

function drawLineColumnChartDouble(id_chart, datajson, title, title2, warna, warna2) {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Bulan', title, title2],
        [''+datajson['01'].nama+'', Number(datajson['01'].nilai), Number(datajson['01'].nilai2)],
        [''+datajson['02'].nama+'', Number(datajson['02'].nilai), Number(datajson['02'].nilai2)],
        [''+datajson['03'].nama+'', Number(datajson['03'].nilai), Number(datajson['03'].nilai2)],
        [''+datajson['04'].nama+'', Number(datajson['04'].nilai), Number(datajson['04'].nilai2)],
        [''+datajson['05'].nama+'', Number(datajson['05'].nilai), Number(datajson['05'].nilai2)],
        [''+datajson['06'].nama+'', Number(datajson['06'].nilai), Number(datajson['06'].nilai2)],
        [''+datajson['07'].nama+'', Number(datajson['07'].nilai), Number(datajson['07'].nilai2)],
        [''+datajson['08'].nama+'', Number(datajson['08'].nilai), Number(datajson['08'].nilai2)],
        [''+datajson['09'].nama+'', Number(datajson['09'].nilai), Number(datajson['09'].nilai2)],
        [''+datajson['10'].nama+'', Number(datajson['10'].nilai), Number(datajson['10'].nilai2)],
        [''+datajson['11'].nama+'', Number(datajson['11'].nilai), Number(datajson['11'].nilai2)],
        [''+datajson['12'].nama+'', Number(datajson['12'].nilai), Number(datajson['12'].nilai2)],
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
               colors: [warna, warna2]
    };

    // Draw chart
    var line_chart = new google.visualization.ColumnChart($('#'+id_chart)[0]);
    line_chart.draw(data, options);
}

function drawLineColumnChartSingle(id_chart, datajson, title, warna) {

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
    var line_chart = new google.visualization.ColumnChart($('#'+id_chart)[0]);
    line_chart.draw(data, options);
}

function drawLineColumnChartSingleAuto(id_chart, datajson, title, warna) {

    var data = google.visualization.arrayToDataTable([
        ['Nama', title],
		['', 0]
    ]);
	$.each(datajson, function(i,n){
		data.addRow([''+datajson[i].nama+'', Number(datajson[i].nominal1)]);
	});

    // Options
    var options = {
        fontName: 'Tahoma',
        height: 250,
        curveType: 'none',
        fontSize: 12,
        chartArea: {
            left: '15%',
            width: '90%',
            height: 150
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
    var line_chart = new google.visualization.ColumnChart($('#'+id_chart)[0]);
    line_chart.draw(data, options);
}

</script>
