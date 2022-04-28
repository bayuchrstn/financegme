//fixing datatable in bootstrap tab
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
});

$(document).ready(function () {
    Notification.requestPermission();
});

function push_alert(title = "Kosong", content = "Sample", icon = "", href = "") {
    Push.create(title, {
        body: content,
        icon: icon,
        // timeout: 400
        onClick: function () {
            location.href = href;
            this.close();
        }
    });
}


window.paceOptions = {
    ajax: {
        trackMethods: ['POST']
        //    trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
    },
    restartOnRequestAfter: true
};

function show_modal(modal_id, modal_size, modal_title, modal_icon) {
    $('#' + modal_id).modal('show');
    $('#' + modal_id + ' .modal-dialog').removeClass().addClass('modal-dialog ' + modal_size);
    $('#' + modal_id + ' .modal_icon').removeClass().addClass('modal_icon position-left ' + modal_icon);
    $('#' + modal_id + ' #modal_title_custom').html('').html(modal_title);
}

function cart_destroy() {
    var bu = $('#base_url_js').val();
    $.get(bu + "cart/destroy");
}

//event ketika semua modal diopen
$('.modal').on('show.bs.modal', function (e) {
    // console.log(e);

    //bug fix calendar month year picker pada jquery date picker
    $.fn.modal.Constructor.prototype.enforceFocus = function () { };

    // //jika ada input text dengan class "cos" valuenya dikosongkan
    // if($('.cos').length){
    // 	$('.cos').val('');
    // }

});

//event ketika semua modal diclose
$('.modal').on('hidden.bs.modal', function () {

    //jika ada div dengan class "modal_alert" valuenya dikosongkan
    if ($('.modal_alert').length) {
        $('.modal_alert').html('');
    }
});

function owner_filter(action) {
    $.ajax({
        type: 'GET',
        url: action,
        success: function (res) {
            var response = jQuery.parseJSON(res);
            console.log(action);

        }
    });
}

function set_owner_filter() {
    alert('set_owner_filter');
}

//untuk menutup modal jika tidak memiliki akses
function no_access(status) {
    if (status == 'failed') {
        return false;
    }
}

// untuk menampilan pesan error / sukse pada modal
// modal_msg(){
//
// }

function ispin(id) {
    $('#' + id).removeClass('icon-spinner4 spinner position-left').addClass('icon-spinner4 spinner position-left');
}

function uspin(id) {
    $('#' + id).removeClass('icon-spinner4 spinner position-left').addClass('');
}

jQuery(function ($) { $('#my_password').pwstrength(); });

var base_url = $('#base_url_js').val();

$(function () {
    if ($('.duit').length) {
        // $('.duit').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', precision:0});
        $('.duit').autoNumeric('init', {
            currencySymbol: 'Rp ',
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            decimalPlacesOverride: '0',
            minimumValue: '0',
            maximumValue: '999999999999',
        });
    }

    if ($('.angka').length) {
        $('.angka').autoNumeric('init', {
            currencySymbol: '',
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            decimalPlacesOverride: '0',
            minimumValue: '0',
            maximumValue: '999999999999',
        });
    }


    if ($('.chosen').length) {
        $('.chosen').chosen({ search_contains: true });
    }
    if ($('.numeric').length) {
        $('.numeric').numeric();
    }
});

$(function () {
    if ($('.date_picker').length) {

        $(".date_picker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    }

    if ($('.datetime_picker').length) {

        $(".datetime_picker").datetimepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss'
        });
    }

});

function open_bug_report() {
    $('#modal_bug').modal('show');
}

function update_area(selected_regional, selected_area, dropdown_id) {
    $.ajax({
        type: 'GET',
        url: base_url + 'regional/arr_area/' + selected_regional + '/' + selected_area,
        success: function (res) {
            $('#' + dropdown_id).html(res);
        }
    });
    return false;
}

function regional_picker(selected_regional, selected_area, regional_dropdown_id, area_dropdown_id) {
    $.ajax({
        type: 'GET',
        url: base_url + 'regional/regional_picker/' + selected_regional + '/' + selected_area,
        success: function (res) {
            var response = jQuery.parseJSON(res);
            // console.log(response);
            $('#' + regional_dropdown_id).html(response.regional_options);
            $('#' + area_dropdown_id).html(response.area_options);
        }
    });
    return false;
}

// setInterval(function(){update_now();},30000);
// function update_now()
// {
//     $.ajax({
//         type: "GET",
//         url: base_url+'now',
//     }).done(function( response ) {
//         $('#hari_tanggal_sekarang').html(response);
//     });
// }
// update_now();

// 60000 = 1 menit
// tiap satu menit  function ini diexe
// setInterval(function(){show_alert();},10000);
// setInterval(function(){show_alert();},60000);
// function show_alert()
// {
//     $.ajax({
//         type: "GET",
//         url: base_url+'xhr/alert',
//         // url: base_url+'xhr/alert/tes',
//     }).done(function( response ) {
//         // push_alert('Judulnya','Ini Isinya');
//         $('#not_div').html(response);
//     });
// }
// show_alert();

// function update_product_div(pd)
// {
//     show_product_by_category(pd);
// }

function show_product_by_category(product_category) {
    $.ajax({
        type: 'GET',
        url: base_url + 'product/show_product_by_category/' + product_category,
        success: function (res) {
            $('.product_lists_div').html(res);
        }
    });
    return false;
}


function focus_this(div_loader, focus_url) {
    block_this(div_loader);
    $.ajax({
        type: 'GET',
        url: focus_url,
        success: function (res) {
            var response = jQuery.parseJSON(res);
            console.log(response);
            unblock_this(div_loader);
            $('#modal_focus').find('.modal-dialog').removeClass().addClass('modal-dialog ' + response.modal_size);
            $('#modal_focus').find('.modal_icon').removeClass().addClass('modal_icon ' + response.modal_icon);
            $('#modal_focus #focus_main_content_div').html(response.modal_content);
            $('#modal_focus #modal_title_custom').html(response.modal_title);
            // $('#modal_focus #modal_title_custom').html(response.modal_title);
            $('#modal_focus').modal('show');
        }
    });
    return false;
}

function open_modal_profile(profile_update_url) {
    $.ajax({
        type: 'GET',
        url: profile_update_url,
        success: function (res) {
            var response = jQuery.parseJSON(res);
            unblock_this('body_loader');
            $("#form_profile #my_name").val(response.my_name);
            $("#form_profile #my_email").val(response.my_email);
            $("#form_profile #my_username").val(response.my_username);
            $('#modal_profile').modal('show');
        }
    });
    return false;
}

function show_modal_alert(where_id, response) {
    // console.log(response);
    if (response.modal_alert != null) {
        modal_alert(where_id, response.modal_alert.msg, response.modal_alert.status);
    }
}

function create_alert(where_id, konten, style) {

    var close_btn = "<button class='close' type='button' data-dismiss='alert' ><span>x</span><span class='sr-only'>Close</span></button>"
    var alert = "<div class='alert " + style + " alert-styled-left'>" + konten + close_btn + "</div>";
    $('#' + where_id).html('').append(alert);
    auto_hide(where_id);
}

function modal_alert(where_id, konten, style) {

    var close_btn = "<button class='close' type='button' data-dismiss='alert' ><span>x</span><span class='sr-only'>Close</span></button>"
    var alert = "<div class='alert " + style + " alert-styled-left'>" + konten + close_btn + "</div>";
    $('#' + where_id).html('').append(alert);
    // auto_hide(where_id);
}

function auto_hide(where_id) {
    window.setTimeout(function () {
        $('#' + where_id).html('');
    }, 5000);
}

function clear_alert(where_id) {
    $('#' + where_id).html('');
}

function reload_table(table) {
    $('#' + table).DataTable().ajax.reload(null, false);
}

function block_this(div) {
    return false;
    // var block = $('#'+div);
    // $(block).block({
    //     message: '<i class="icon-redo spinner"></i>',
    //     // timeout: 2000, //unblock after 2 seconds
    //     overlayCSS: {
    //         backgroundColor: '#fff',
    //         opacity: 0.8,
    //         // cursor: 'wait'
    //     },
    //     css: {
    //         border: 0,
    //         padding: 0,
    //         backgroundColor: 'transparent'
    //     }
    // });
}

function unblock_this(div) {
    return false;
    // $('#'+div).unblock();
}

function set_option(url, target, selected) {
    // console.log(selected);
    // alert(base_url+'select_option/index/'+url)
    $.ajax({
        type: 'GET',
        url: url,
        success: function (res) {
            // console.log(res);
            $("#" + target).html(res).val(selected).chosen({ search_contains: true }).trigger('chosen:updated');

            // -------------------------
            // -------------------------
        }
    });
}

function make_chosen_id(target) {
    $("#" + target).chosen();
}

function getajax(url, target_id) {
    // console.log(selected);
    // alert(base_url+'select_option/index/'+url)
    $.ajax({
        type: 'GET',
        url: url,
        success: function (res) {
            // console.log(res);
            $("#" + target_id).html(res);
        }
    });
}

function getajaxclass(url, target_class) {
    // console.log(selected);
    // alert(base_url+'select_option/index/'+url)
    $.ajax({
        type: 'GET',
        url: url,
        success: function (res) {
            // console.log(res);
            $("." + target_class).html(res);
        }
    });
}

$(document).ready(function () {
    $("#form_profile").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: $('#my_name_required').val()
            },
            email: {
                required: $('#my_email_required').val(),
                email: $('#my_email_email').val()
            },
        },

        submitHandler: function (form) {
            block_this('form_profile');

            $.ajax({
                type: 'POST',
                url: $('#form_profile').attr('action'),
                data: $('#form_profile').serialize(),
                success: function (res) {
                    var response = jQuery.parseJSON(res);
                    $('#my_account_name').html('').append(response.new_name);
                    unblock_this('form_profile');
                    // $('.modal').modal('hide');
                    create_alert('alert_modal_myprofile', $('#profile_update_seccess').val(), 'bg-success');
                }
            });
            return false;
        }
    });
});

// $(window).on('load', function(){
//
// 	$('#widget_container').masonry({
// 		itemSelector: '.widget_item',
// 	});
// })

$(document).ajaxComplete(function () {
    $('#widget_container').masonry({
        itemSelector: '.widget_item',
    });
});


function check_file(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var alert = '';

        var fileExtension = ['jpg', 'png', 'gif', 'jpeg', 'pdf'];
        var size = (input.files[0].size) / 1024;

        if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert += " Only formats are allowed : " + fileExtension.join(', ');
        } else if (size > 2048) {
            alert += ' Ukuran file maksimal 2048KB';
        }
        reader.readAsDataURL(input.files[0]);

        return alert;

        // reader.onload = function (e) {
        //         var width = input.naturalWidth;
        //         var height = input.naturalHeight;

        //          else {
        //             if ((size>1024 || width>1000 || height>1000) ) {
        //                 alert('Ukuran file maksimal 1024 KB dan/atau dimensi maksimal 1000 x 1000');
        //             }
        //         }
        // }
    }
}
