
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
            data.searchtahun = $('#searchtahun').val();
            data.searchstatus = $('#searchstatus').val();
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
        targets: [0, tabel_kolom]
    }, {
        className: "text-right",
        "targets": [0]
    }, {
        className: "text-center",
        "targets": [tabel_kolom, 1, 2]
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

$("#formulir_modal").validate({
    rules: {
        nofak: { required: true },
        jumlah: { required: true },
    },
    submitHandler: function (form) {
        var cekTransaksi = $("#formulir_modal").attr('transaksi');
        if (cekTransaksi == 'tambah') {
            $.ajax({
                type: 'POST',
                url: pageUri + 'insert_data',
                data: $('#formulir_modal').serialize(),
                beforeSend: function () {
                    blockUI();
                },
                success: function (response) {
                    if (response.status == '1') {
                        $('#formulir_modal').clearForm();
                        toastr.success(response.message);
                        table.ajax.reload(null, false);
                    } else if (response.status == '0') {
                        toastr.warning(response.message);
                    } else {
                        toastr.error('Terjadi kesalahan saat menambah data');
                    }
                    unBlockUI();
                }
            });
        }
        return false;
    }
});

$("#formulir_edit").validate({
    rules: {
        editnofak: { required: true },
    },
    submitHandler: function (form) {
        var cekTransaksi = $("#formulir_edit").attr('transaksi');
        if (cekTransaksi == 'edit') {
            $.ajax({
                type: 'POST',
                url: pageUri + 'edit_data',
                data: $('#formulir_edit').serialize(),
                beforeSend: function () {
                    blockUI();
                },
                success: function (response) {
                    if (response.status == '1') {
                        toastr.success(response.message);
                        table.ajax.reload(null, false);
                    } else if (response.status == '0') {
                        toastr.warning(response.message);
                    } else {
                        toastr.error('Terjadi kesalahan saat mengupdate data');
                    }
                    unBlockUI();
                }
            });
        }
        return false;
    }
});

function open_search() {
    $('#formSearch').dialog('open');
    return false;
}

function input_data() {
    $('#formulir_modal').clearForm();
    $("#formulir_modal").attr('transaksi', 'tambah');
    $('#formSearch').dialog('close');
    $('#modal_finance_nomor').modal('show');
    return false;
}

function update_data(id) {
    var pageUri = $('#pageUri').val();
    $("#formulir_edit").attr('transaksi', 'edit');
    $('#id').val(id);

    $.ajax({
        type: 'POST',
        data: $('#formulir_edit').serialize(),
        url: pageUri + 'select_data',
        dataType: "json",
        beforeSend: function () {
            blockUI();
        },
        success: function (html) {
            if (html != '') {
                $.each(html, function (i, n) {
                    $('#id').val(id);
                    $('#editnofak').val(n["no_faktur"]);
                    $('#modal_finance_nomor_edit').modal('show');
                    unBlockUI();
                });
            } else {
                alert('Data tidak ditemukan');
                unBlockUI();
            }
        }
    });
}

function delete_data(id) {
    var pageUri = $('#pageUri').val();

    if (confirmProses('Yakin ingin menghapus data?') == true) {
        $.ajax({
            type: 'GET',
            url: pageUri + 'delete_data/' + id,
            beforeSend: function () {
                blockUI();
            },
            success: function (response) {
                if (response.status == '1') {
                    table.ajax.reload(null, false);
                    toastr.success(response.message);
                } else if (response.status == '0') {
                    toastr.warning(response.message);
                } else {
                    toastr.error('Terjadi kesalahan saat menghapus data');
                }
                unBlockUI();
            }
        });
    }
}

