<form id="form_replace_report" action="<?php echo base_url(); ?>xhr/task_report/create/<?php echo $task_id; ?>" method="post">

<?php
	$data = array();
	$data['task_detail'] = $task_detail;
	$data['report_detail'] = $report_detail;

	$is_progress = $task_detail['status']=='progress' ? '' : 'ts_laporan_barang_keluar_replace';
	$is_progress_in = $task_detail['status']=='progress' ? '' : 'ts_laporan_barang_kembali_replace';

	$options = array();
	$options['component'] = 'component/tab/tab_default';
	$options['tab_id'] = 'tab1';
	$options['tab_padding'] = 'no';
	$options['max'] = '8';
	$options['selected_tab'] = 'data_umum';
	$options['tabs'] = array();
	$options['tabs'][] = array(
			'label'         => 'Data Umum',
			'id'            => 'data_umum',
			'content'       =>  $this->load->view('request/my_task/report_form/data_umum', '', TRUE)
		);

	$options['tabs'][] = array(
			'label'         => 'Data Barang Dipasang',
			'id'            => 'data_barang_dipasang',
			'content'       => '<div id="daftar_barang_siap_dipasang"></div>'
		);
	$options['tabs'][] = array(
			'label'         => 'Data Barang Kembali',
			'id'            => 'data_barang_kembali',
			'content'       => '<div id="daftar_barang_kembali"></div>'
		);
	$options['tabs'][] = array(
			'label'         => 'Status Pekerjaan',
			'id'            => 'status_pekerjaan',
			'content'       => $this->load->view('request/my_task/report_form/status', $data, TRUE)
		);

	$content = $this->ui->load_component($options);
	echo $content;
?>

	<div class="text-right">
		<input type="hidden" name="sender" value="1">
		<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
		<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
	</div>

</form>


<script type="text/javascript">

	$('#modal_laporan_pekerjaan #modal_title_custom').html('<?php echo $modal_report_ui['modal_title']; ?>');

	//+++++++++++++++++++ php json+++++++++++++++++++++++++++++
	var task_detail = <?php echo json_encode($task_detail); ?>;
	var report_detail = <?php echo json_encode($report_detail); ?>;
	//+++++++++++++++++++ php json+++++++++++++++++++++++++++++

	console.log(task_detail);

	getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_out/'+task_detail.id+'/laporan_teknis/barang_keluar_list/ts_laporan_barang_keluar_replace', 'daftar_barang_siap_dipasang');
	getajax('<?php echo base_url(); ?>xhr/task_item/index/task_item_in/'+task_detail.id+'/laporan_teknis/barang_kembali_list/ts_laporan_barang_kembali_replace', 'daftar_barang_kembali');



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

		tinymce.get('body_report_form').setContent(report_detail.body);
	});

	//chosen status pekerjaan
	set_option('<?php echo base_url(); ?>select_option/request/my_task/status_pekerjaan', 'status_pekerjaan_report_form', task_detail.status);


	//+++++++++++++++++++++++UPLOAD+++++++++++++++++++++++++++++++++++
	$(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>uploader/request/task_teknis_report';

        $('#attachment_report_form').fileupload({
            url: url,
            dataType: 'json',
            start: function (e, data) {
                ispin('ibuttonuploader_insert');
            },
            done: function (e, data) {
				uspin('ibuttonuploader_insert');
				var i = 1;
				$.each(data.result.attachment, function (index, file) {
					i++;
					// console.log(file);
					// $('.patient_photo').val(file.name);
					$('#attachment_ul_report_form').append('<li id="attachment_li_'+i+'" class="alert alert-primary no-border mb-5">'+file.name+' <a onclick="remove_this_attachment('+i+');" href="#" class="pull-right"><i class="icon-trash position-left"></i>Remove<input type="hidden" name="attachment[]" value="'+file.name+'"></a></li>');
					// $('.photo_profile_patient').attr('src', '<?php echo base_url(); ?>patient_photo/medium/'+file.name);
				});
            }
        });
    });

	function remove_this_attachment(par)
	{
		$('#attachment_li_'+par).remove();
		console.log(par);
	}
	//+++++++++++++++++++++++UPLOAD+++++++++++++++++++++++++++++++++++

</script>
