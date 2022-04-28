<?php
    // pre($report_ext);
?>
<form id="form_general_report" action="<?php echo base_url(); ?>xhr/task_report/create/<?php echo $task_id; ?>" method="post">
<?php
    $data = array();
    $data['task_detail'] = $task_detail;
    $data['report_detail'] = $report_detail;
    // $data['report_ext'] = $report_ext;

    echo $this->load->view('request/my_task/report_form/status', $data, TRUE);
?>
<div class="text-right">
	<input type="hidden" name="sender" value="1">
	<button type="submit" class="btn btn-success" ><i class="position-left icon-checkmark"></i> <?php echo $this->lang->line('all_submit_button'); ?></button>
	<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="position-left icon-cancel-circle2"></i> <?php echo $this->lang->line('all_close_button'); ?></button>
</div>
</form>


<script type="text/javascript">
    $('#modal_laporan_pekerjaan #modal_title_custom').html('<?php echo $modal_report_ui['modal_title']; ?>');
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

</script>
