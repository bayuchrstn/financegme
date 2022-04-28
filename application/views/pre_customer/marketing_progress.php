<p>Nama : <b><?php echo $detail['customer_name']; ?></b></p>
<?php
	// pre($progress_options);
	// pre($detail);
	// pre($prefix);
	$prefix = 'mp';
	$default_value = array();
	$default_value['task_category'] = 'marketing_progress';
	$default_value['req_code'] = 'marketing_progress';
	$default_value['flock'] = 'n';

	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_marketing_request = $this->ui->forms('task_marketing_request', $default_value, $prefix);

	echo $forms['task_category'];
	echo $forms['req_code'];
	// echo $forms['location_id'];

	//jenis marketing progress
	//misalnya prospek, pre survey survey dst
	echo $forms['category'];
?>

<!-- <div id="tgl_request_date_<?php echo $prefix; ?>" class="hide">
	<?php //echo $forms_task_marketing_request['date_request_start']; ?>
</div> -->

<?php
	echo $forms['subject'];
	echo $forms['body'];
?>
<div id="form_ext_<?php echo $prefix; ?>">

</div>

<?php
	echo $forms['flock'];
?>
<!-- untuk marketing progress udah pasti pre customer -->
<input type="hidden" name="location" value="pre_customer">
<input type="hidden" name="location_id" value="<?php echo $detail['id'];?>">

<input type="hidden" id="flock_insert" name="flock" value="n">

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	var selected = '';
	// tinymce handle
	tinymce.remove();
	$(document).ajaxComplete(function(){
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
	});
	$.ajax({
		url : '<?php echo base_url(); ?>select_option/marketing_progress_category/'+detail.id+'/json',
		type: 'GET',
		success: function(res){
			var response = $.parseJSON(res);
			var resLen = response.length;
			selected = response[resLen-1].code;
			set_option('<?php echo base_url(); ?>select_option/marketing_progress_category/'+detail.id, 'category_id_mp', selected);
			$('#form_ext_<?php echo $prefix; ?>').load('<?=base_url();?>/xhr/marketing_progress/form_ext/'+selected+'/<?=$detail['id'];?>/insert');
		}
	});

	$('#category_id_mp').on('change', function(){
		var mp_level = $(this).val();
		$('#form_ext_<?php echo $prefix; ?>').load('<?=base_url();?>/xhr/marketing_progress/form_ext/'+mp_level+'/<?=$detail['id'];?>/insert');
		if (mp_level === 'mp_instalasi') {
			getTaskBy({
				category: 'survey',
				locationId: '<?=$detail['id'];?>',
				taskCategory: 'task_report',
			}, (tasks) => {
				getTaskDetail(tasks[0].id, (d) => {
					if (d.task_boq.length !== 0) {
						var tableElement = $('#boq_marketing_progress_insert');
						var tableBodyElement = tableElement.children('tbody');

						tableElement.before(`<input type="hidden" name="boq_mode" value="update" />`);
						tableBodyElement.empty();

						d.task_boq.map((boq) => {
							var namaBarang = boq.mode === 'barang' ? `${boq.brand_name} / ${boq.category_name} / ${boq.item_name}` : boq.item_name_custom;

							tableBodyElement.append(`
								<tr>
									<td>${namaBarang}</td>
									<td align="center">${boq.qty}</td>
									<td>${boq.note}</td>
									<td align="center"><input type="checkbox" name="boq[${boq.id}][approve_mrk]" value="1" /></td>
								</tr>
								`);
							});
					}
				});
			});
		}
	});


	// upload

	function getTaskBy(data, cb) {
		var url = '<?php echo base_url(); ?>task/get'; // json

		$.ajax({ type: 'POST', url, data, success: function(res) {
			cb(res);
		}});
	}

	function getTaskDetail(id, cb) {
		var url = '<?php echo base_url(); ?>xhr/task_report/get_task_detail/' + id; // json

		$.ajax({ type: 'GET', url, success: function(res) {
			cb(res);
		}});
	}

	function addAttachmentInput() {
		var index = Number($('.attachment-control_input').last().children('.attachment-index').val()) + 1;

		$('#attachment-add_input').before(`
			<div class="attachment-control_input" style="margin-bottom: 5px;">
				<input class="attachment-index" type="hidden" name="attachment_index[]" value="${index}" />
				<label class="btn btn-primary btn-xs" style="cursor: pointer;">
					<div class="attachment-label">Pilih file</div>
					<input class="attachment-input" type="file" name="attachment_${index}" onchange="setAttachmentName(this)" style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;" />
				</label>
			</div>
		`);
	}

	function setAttachmentName(e) {
		var fileName = e.files[0].name;
		var check = check_file(e);
		
		if(check==''){
			$(e).parent().children('.attachment-label').text(fileName);
			$('input[name=attachment_fake]').val(fileName);
		} else {
			alert(check);
		}
	}

</script>