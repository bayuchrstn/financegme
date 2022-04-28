
var pageUri = $('#pageUri').val();

//SET DATATABLES
$.extend($.fn.dataTable.defaults, {
    //autoWidth: true,
    "sLength": "form-control",
});
//$.fn.dataTable.ext.classes.sPageButton = 'paginate_button current bg-indigo';
var height_windows = $(window).height();
var height_navbar = $('#navbar-main').height();
var height_page = $('#page-header').height();
var height_table = height_windows - height_navbar - height_page - 370;
var tabel_kolom = ($(".datatable-ajax").find('thead tr')[0].cells.length - 1);

table = $('#datamain_datatable').DataTable({
    dom: '<"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"pli>',
    "pageLength": 100,
    aaSorting: [[1, 'asc']],
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": pageUri + 'get_data_table',
        "type": "POST",
        "data": function (data) {
            data.search_keyword = $('#search_keyword').val();
            data.searchDateFirst = $('#searchDateFirst').val();
            data.searchDateFinish = $('#searchDateFinish').val();
        },
        beforeSend: function () {
            blockElement('datamain_datatable_wrapper');
        },
    }, "drawCallback": function (settings) {
        unBlockElement('datamain_datatable_wrapper');
    },

    columnDefs: [{
        orderable: false,
        width: '60px',
        className: "text-right",
        targets: [0, tabel_kolom]
    }
    ],
    language: {
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
    },
    scrollX: true,
    scrollY: height_table,
    scrollCollapse: false,
});

$('#buttonPencarian').click(function () {
    table.ajax.reload(null, false);
});
$('.dataTables_length select').select2({
    minimumResultsForSearch: Infinity,
    width: 'auto',
});
//END SET DATATABLES

$(document).ready(function () {
    $('#upload').click(function () {
        var formdata = new FormData();
        formdata.append('file', document.getElementById('file').files[0]);
        formdata.append('nama', document.getElementById('file').files[0].name);
        // AJAX request
        $.ajax({
            url: pageUri + 'upload_pdf',
            type: 'post',
            data: formdata,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                blockUI();
            },
            success: function (response) {
                if (response != 0) {
                    $('#file').val('');
                    $('#modal_finance_upload').modal('hide');
                    toastr.success(response.message);
                    table.ajax.reload(null, false);
                } else {
                    toastr.warning(response.message);
                }
                unBlockUI();
            }
        });
    });
});

function open_search() {
    $('#formSearch').dialog('open');
    return false;
}

function input_data() {
    $('#formSearch').dialog('close');
    $('#modal_finance_upload').modal('show');
    return false;
}

