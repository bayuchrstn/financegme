<script type="text/javascript">
	// alert('<?php //echo $req_code; ?>');
	tinymce.init({
		selector: '.wysiwyg',
		statusbar:  false,
		menubar:    false,
		rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ],
		setup: function(editor) {
			editor.on('change', function(e) {
				var isi = this.getContent();
				$('.fake_tinymce').val(isi);
			});
		}
	});

	function show_this(id)
	{
		$("#modal_show_this_div").load("<?php echo base_url(); ?>pre_customer_approval/show/"+ id +"/echo");
		$('#modal_show_this').modal('show');

		getTaskDetail(id, (d) => {
			// Product
			var product = typeof(d.data_location.data_product)!='undefined' > 0 ? d.data_location.data_product : {};

			// Attachment
			var attachment = d.task_attachment.length > 0 && {
				file_name: d.task_attachment[0].file_name,
				link: `<?php echo base_url(); ?>uploads/${d.task_attachment[0].file_name}`,
			};

			var attachmentElement = attachment ? `<a href="javascript:void(0);" onclick="openLink('${attachment.link}')">${attachment.file_name}</a>` : '-';

			$(`#date_show`).append($.format.date(d.date_start, 'dd/MM/yyyy HH:mm'));
			$(`#customer_name_show`).append(d.data_location.customer_name);
			// if (typeof(product.value)!='undefined') {
				$(`#product_show`).append(product[0].name);
				$(`#bandwidth_show`).append((product[0].value ? (product[0].value + ' ' + product[0].satuan_bandwidth) : '-'));
			// }
			$(`#marketing_name_show`).append(d.data_location.data_marketing.name);
			$(`#content_show`).append(d.task_parent.body);
			$('#judul_show').append(d.task_parent.subject);
			$(`#attachment_show`).append(attachmentElement);
		});
	}

	function open_search_modal()
	{
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/pre_customer', 'location_id_search', '');
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_search/author', 'author_search', '');
		$('#modal_marketing_progress_search').modal('show');
	}

    function update(id)
    {
        var action = '<?php echo base_url(); ?><?php echo $modul['url']; ?>/update/'+id;
        block_this('js_table_marketing_progress');
        get_task_attachment(id, 'attachment_list_update');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
				// console.log(response);

				// form customize
                $("#form_<?php echo $modul['code']?>_update").attr('action', response.action);
				set_option('<?php echo base_url(); ?>select_option/request/approval_pre_customer_install/customer_approval_status', 'status_update', '');
                $("#form_<?php echo $modul['code']?>_update #subject_update").val(response.subject);
                $("#form_<?php echo $modul['code']?>_update #body_fake_update").val(response.body);
				// tinyMCE.get('body_update').setContent(response.body);
                $("#form_<?php echo $modul['code']?>_update #id_update").val(response.id);
				// form customize

                $('#modal_request_update').modal('show');

				getTaskDetail(id, (d) => {
					removeElement( // clear element
						$('.attachment-no_update'),
						$('.attachment_update'),
						$('.attachment-control_update'),
					() => {
						// Attachment
						var attachments = d.task_attachment;
						var addButton = $('.attachment-add_update');

						if (attachments.length > 0) {
							attachments.map((attachment) => {
								var link = `<?php echo base_url(); ?>uploads/${attachment.file_name}`;
								addButton.before(availableAttachment(link, attachment.file_name));
							});
						} else {
							addButton.before(noAttachment());
						}
					});
				});

                unblock_this('js_table_marketing_progress');
            }
        });
        return false;
    }

    function input()
    {
		$('.cos').val('');
		tinyMCE.get('body_insert').setContent('');
        set_option('<?php echo base_url(); ?>select_option/request/<?php echo $req_code; ?>/customer', 'location_id_insert', '');
		set_option('<?php echo base_url(); ?>select_option/kosong', 'category_id_insert', '');
		$('#modal_request_insert').modal('show');
        return false;
    }

	$('#location_id_insert').change(function(){
		var customer_id = $(this).val();
		// console.log(customer_id);
		set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+customer_id, 'category_id_insert', '');
	});

	$('#category_id_insert').change(function(){
		var mp_level = $(this).val();
		// console.log(mp_level);
		if(mp_level=='mp_survey' || mp_level=='mp_instalasi'){
			$('#tgl_request_date_insert').removeClass('hide');
		} else {
			$('#tgl_request_date_insert').addClass('hide');

		}

		// set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+customer_id, 'category_id_insert', '');
	});

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
