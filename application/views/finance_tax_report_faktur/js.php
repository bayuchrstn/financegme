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
				data.search_keyword = $('#search_keyword').val();
				data.searchDateFirst = $('#searchDateFirst').val();
				data.searchDateFinish = $('#searchDateFinish').val();
				data.searchtipe = $('#searchtipe').val();
				data.searchtax_type = $('#searchtax_type').val();
				data.searchcabang = $('#searchcabang').val();
				data.searchmsa = $('#searchmsa').val();
			},
			beforeSend: function(){
				blockElement('datamain_datatable_wrapper');
			},
		},"drawCallback": function( settings ) {
			unBlockElement('datamain_datatable_wrapper');
		},
		"ordering": false,
		columnDefs: [{ 
				className: "text-right", 
				"targets": [3,8]
			},{ 
				className: "text-center", 
				"targets": [1]
			}
		],
		language: {
			lengthMenu: '<span>Show:</span> _MENU_',
			paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
		},
		//scrollX: true,
		//scrollY: height_windows - 200,
		scrollX: false,
		scrollY: false,
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

function select_date(){
	var id_val = $('#searchTanggal').val();
	
	if(id_val == '1'){
		$('#date_selected').css('display', '');
		$('#date_closed').css('display', 'none');
	}else if(id_val == '3'){
		$('#date_selected').css('display', 'none');
		$('#date_closed').css('display', '');
	}
}

</script>
