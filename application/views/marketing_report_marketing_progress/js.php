<script type="text/javascript">
$(function() {
	var pageUri = $('#pageUri').val();

	//SET DATATABLES
	$.extend( $.fn.dataTable.defaults, {
		//autoWidth: true,
		"sLength": "form-control"
	});
	var height_windows = $(window).height();
	var height_navbar = $('#navbar-main').height();
	var height_page = $('#page-header').height();
	var height_table = height_windows - height_navbar - height_page - 370;
	var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);
	
	table = $('#datamain_datatable').DataTable({ 
		dom: '<"datatable-header"B><"datatable-scroll datatable-scroll-wrap"t>',
		buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy3 position-left"></i> Copy'
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> Excel',
                    fieldSeparator: '\t',
                }
            ]
        },
		aaSorting: [[1, 'desc']],
		"processing": true, 
		"serverSide": true, 
		"ajax": {
			"url": pageUri+'get_data_table',
			"type": "POST",
			"data": function (data) {
				data.searchDateTransFirst = $('#searchDateTransFirst').val();
				data.searchDateTransFinish = $('#searchDateTransFinish').val();
				data.search_marketing = $('#search_marketing').val();
				data.searchjenis = $('#searchjenis').val();
			},
			beforeSend: function(){
				blockElement('datamain_datatable_wrapper');
			},
		},"drawCallback": function( settings ) {
			unBlockElement('datamain_datatable_wrapper');
		},
		
		columnDefs: [{ 
				orderable: false,
				width: '60px',
				targets: [0 ]
			},{ 
				className: "text-right", 
				"targets": [0]
			},{ 
				className: "text-center", 
				"targets": [1]
			}
		],
		language: {
			lengthMenu: '<span>Show:</span> _MENU_',
			paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
		},
		scrollX: true,
		scrollY: height_windows - 200,
		scrollCollapse: false,
		fixedColumns: {
			leftColumns: 1,
			rightColumns: 0
		},
	});
	
	$('#buttonPencarian').click(function(){ 
		table.ajax.reload();
	});
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		width: 'auto',
	});
	//END SET DATATABLES
	
	$('#button_dropdown_search').on('click', function (e) {
		$(this).next().toggle();
	});
	$('#button_dropdown_search.keep-open').on('click', function (e) {
		e.stopPropagation();
	});
});
	
</script>
