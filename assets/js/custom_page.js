$(function() {
	$('.price').maskMoney({prefix:'', thousands:',', decimal:'.', precision:0});
	$('.price_decimal').maskMoney({prefix:'', thousands:',', decimal:'.', precision:2});
	
	$('.modal').on('shown.bs.modal', function () {
		$('.select-chosen').chosen('destroy').chosen({placeholder_text_single:'Pilih salah satu'});
	});
	
    $.fn.clearForm = function() {
      return this.each(function() {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
          return $(':input',this).clearForm();
        if (type == 'hidden' || type == 'text' || type == 'password' || tag == 'textarea')
          this.value = '';
        else if (type == 'checkbox' || type == 'radio')
          this.checked = false;
        else if (tag == 'select')
          this.selectedIndex = 0;
      });
    };
	
	$("#formSearch:ui-dialog").dialog("destroy");
	$("#formSearch").dialog({
		title: "Form Pencarian",
		autoOpen: false,
		resizable: false,
		closeOnEscape: false,
		width: 400,
		modal: false,
		position: "top",
		draggable: false,
		closeText : '',
		position: { my: "right top", at: "right top", of: '#tombol_open_search_form' }
	});
	//$(".ui-dialog-titlebar").hide();
	
	$('#button_form_dropdown_search').on('click', function (e) {
		$(this).next().toggle();
	});
	$('#button_form_dropdown_search.keep-open').on('click', function (e) {
		e.stopPropagation();
	});
});

function confirmProses(msg)
{
	var answer = confirm(msg);
	if (answer)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function open_post_new_window(reqUrl, reqName, reqValue){
	var mapForm = document.createElement("form");
	mapForm.id = "openPostNewWindow";
	mapForm.target = "openPost";
	mapForm.method = "POST";
	mapForm.action = reqUrl;
							
	var mapInput = document.createElement("input");
	mapInput.type = "hidden";
	mapInput.name = reqName;
	mapInput.value = reqValue;
	mapForm.appendChild(mapInput);
							
	document.body.appendChild(mapForm);
	map = window.open("","openPost");
	if(map){
		mapForm.submit();
	}else{
		alert('You must allow popups for this prosess to work.');
	}
	$("#openPostNewWindow").remove();
	return false;	
}

function popup(url,vwidth,vheight,scrollbar) 
{
	//var width  = vwidth;
	//var height = vheight;
	var width  = screen.width;
	var height = screen.height;
	var left   = (screen.width  - width)/2;
	var top    = (screen.height - height)/2;
	//var params = 'width='+width+', height='+height;
	//params += ', top='+top+', left='+left;
	var params = 'directories=no';
	params += ', location=no';
	params += ', menubar=no';
	params += ', resizable=no';
	params += ', scrollbars='+scrollbar;
	params += ', status=no';
	params += ', fullscreen=yes';
	params += ', toolbar=no';
	newwin=window.open(url,'windowname5', params);
	if (window.focus) {newwin.focus()}
	return false;
}

function filter_currency(kata){
	var str = kata;
	str = str.replace(/,/g, '');
	str = parseFloat(str);
	return str;
}

function blockUI()
{
	$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <span class="text-semibold display-block">Loading</span>',
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            }
        });
}

function unBlockUI()
{
	$.unblockUI();
}

function blockElement(elm)
{
	
        //$(elm).block({ 
		$('#'+elm).block({ 
            message: '<i class="icon-spinner4 spinner"></i>',
            showOverlay: false,
            css: {
            	width: 16,
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
}

function unBlockElement(elm)
{
	$('#'+elm).unblock();
}

