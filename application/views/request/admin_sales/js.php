<script type="text/javascript">

    function show_this(x)
    {
        console.log(x);
        $("#modal_as_mrk_div").load("<?php echo base_url().$modul['url']; ?>/show/"+x+"/echo");
        $('#modal_as_mrk').modal('show');
    }

    function show_customer(x)
    {
        console.log(x);
        $("#div_detail_customer").load("<?php echo base_url(); ?>customer/show/"+x+"/detail/echo");
        $('#modal_detail_customer').modal('show');
    }


    function update(id)
    {
        // alert('ok');
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);
				// tinyMCE.get('note_update').remove();

				// form customize
				$("#form_<?php echo $modul['code']?>_update").attr('action', '<?php echo base_url(); ?>ajax_request/admin_sales_form');
				// form customize

                $("#form_div").load("<?php echo base_url(); ?>xhr/admin_sales/build_form/"+response.category+'/'+response.id);
                get_task_attachment(id, 'attachment_timeline');
                $('#modal_request_update').modal('show');

				// getTaskDetail(id, (d) => {
				// 	// Price
				// 	$('#price_update').append(toCurrency(d.data_location.data_product[0].price));

				// 	// Attachment
				// 	var attachments = d.task_attachment;
				// 	var attcElement = $('#attachment_update');

				// 	attcElement.empty();

				// 	if (attachments.length > 0) {
				// 		// for one attachment
				// 		var link = `<?php echo base_url(); ?>uploads/${attachments[0].file_name}`;
				// 		var child = `<a href="javascript:void(0);" onclick="openLink('${link}')">${attachments[0].file_name}</a><br/>`;

				// 		attcElement.append(child);
				// 	} else {
				// 		attcElement.append('Tidak ada');
				// 	}
				// });
            }
        });
        return false;
    }

	function getTaskDetail(id, cb) {
		var url = '<?php echo base_url(); ?>xhr/task_report/get_task_detail/' + id; // json

		$.ajax({ type: 'GET', url, success: function(res) {
			cb(res);
		}});
	}

	function openLink(link) {
		var win = window.open(link, '_blank');
		win.focus();
	}

	function toNumberOnly(str) {
		return str.toString().replace(/[^0-9]+/g, ''); // remove all character other than number
	}

	function toCurrency(str) {
		return ('Rp' + Number(toNumberOnly(str)).toLocaleString('id-ID')); // change to currency format
	}


	function location_picker(location, location_id, flocation, flocation_id)
	{
		$.ajax({
			type:'GET',
			url: '<?php echo base_url(); ?>location_picker/all/'+location+'/'+location_id+'/marketing_request',
			success: function(res) {
				var response = jQuery.parseJSON(res);
				// console.log(response);
				$('#'+flocation).html(response.location).val(location).chosen().trigger('chosen:updated');
				$('#'+flocation_id).html(response.location_id).val(location_id).chosen().trigger('chosen:updated');
			}
		});
	}

	if( $('#location_insert').length ){
		$('#location_insert').change(function(){
			var location = $(this).val();
			location_picker(location, 'x', 'location_insert', 'location_id_insert');
		});
	}

	function hapus(id) {
    	var modul = 'delete_admin_sales';
    	var post_url = '<?php echo base_url();?>ajax_request/lock_task/'+modul;
		$("#data_info_delete").load("<?php echo base_url().$modul['url']; ?>/show/"+id+"/echo");

		$.ajax({
			type : 'GET',
			url  : '<?php echo base_url();?>admin_sales/update/'+id, 
			success: function(res){
				var response = $.parseJSON(res);
				$('#delete_id').val(response.id);
				$('#form_product_delete').attr('action',post_url);
				$('#modal_product_delete').modal('show');
			}
		});
	}

	function getTaskDetail(id, cb) {
		var url = '<?php echo base_url(); ?>xhr/task_report/get_task_detail/' + id; // json

		$.ajax({ type: 'GET', url, success: function(res) {
			cb(res);
		}});
	}

	function openLink(link) {
		var win = window.open(link, '_blank');
		win.focus();
	}

	function removeElement(...args) {
		args.forEach(function(val, idx, arr) {
			if (idx === arr.length - 1) {
				val();
			} else {
				val.remove();
			}
		});
	}

	function addAttachmentInput() {
		var addButton = $('.attachment-add_update');
		var noAttachment = $('.attachment-no_update');
		let index = 1;

		if (!(noAttachment.length === 0)) noAttachment.remove();

		if (!($('.attachment-control_update').length === 0)) {
			index = Number($('.attachment-control_update').last().children('.attachment-index').val()) + 1;
		}

		addButton.before(attachmentInput(index));
	}

	function setAttachmentName(e) {
		var fileName = e.files[0].name;
		$(e).parent().children('.attachment-label').text(fileName);
	}

	function availableAttachment(link, fileName) {
		return `
			<div class="attachment_update" style="margin-bottom: 5px;"> <!-- attachment_update != id -->
				<a herf="javascript:void(0);" onclick="openLink('${link}')" class="btn btn-info btn-xs">${fileName}</a>
			</div>
		`;
	}

	function noAttachment() {
		return `
			<div class="form-control attachment-no_update" style="margin-bottom: 5px;"> <!-- attachment-no_update != id -->
				Tidak ada
			</div>
		`;
	}

	function attachmentInput(index) {
		return `
			<div class="attachment-control_update" style="margin-bottom: 5px;">
				<input class="attachment-index" type="hidden" name="attachment_index[]" value="${index}" />
				<label class="btn btn-primary btn-xs" style="cursor: pointer;">
					<div class="attachment-label">Pilih file</div>
					<input class="attachment-input" type="file" name="attachment_${index}" onchange="setAttachmentName(this)" style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;" />
				</label>
			</div>
		`;
	}

	function get_task_attachment(id, div_id) {
		$.ajax({
			type: 'GET',
			url : '<?php echo base_url().'xhr/task_report/teknis_mrk_req_attachment/'; ?>'+id,
			success: function(res){
				var response = $.parseJSON(res);
				// console.log(response);
				var attachment = parseLinkAttachment(response);
				var html = '';
				html += attachment.html=='' ? 'Tidak ditemukan' : attachment.html;
				$('#'+div_id).empty().append(html);
				// console.log(html);
			}
		});
	}

	function parseLinkAttachment(response) {
		var html = '';
		if (response.attachment.length > 0) {
			for (var i = 0; i < response.attachment.length; i++) {
				html += '<a href="<?php echo base_url().'uploads/'?>'+response.attachment[i].file_name+'" class="btn btn-primary" target="_blank">'+response.attachment[i].file_name+'</a>&nbsp;';
			}
		}
		if (typeof(response.parent)!=='undefined') {
			html += parseLinkAttachment(response.parent).html;
		}
		response.html = html;
		return response;
	}

</script>
