<?php
    $default_value = array();
    $forms_task_marketing_request = $this->ui->forms('task_marketing_request', $default_value, $prefix);
    echo $forms_task_marketing_request['date_request_start'];
?>

<div class="form-group">
	<label>BOQ</label>

	<table class="table" id="boq_marketing_progress_insert">
		<thead class="bg-slate-300">
			<tr>
				<th>Nama</th>
				<th style="width: 10%; text-align: center;">Jumlah</th>
				<th>Keterangan</th>
				<th style="width: 15%; text-align: center;">Approve</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4" align="center">Tidak ada</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="form-group">
	<label>Attachment</label>
    <input type="hidden" name="attachment" value="true" />

    <div class="attachment-control_input" style="margin-bottom: 5px;">
        <input class="attachment-index" type="hidden" name="attachment_index[]" value="1" />
        <label class="btn btn-primary btn-xs" style="cursor: pointer;">
            <div class="attachment-label">Pilih file</div>
            <input class="attachment-input" type="file" name="attachment_1" onchange="setAttachmentName(this)" style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;" />
        </label>
        <input type="hidden" name="attachment_fake" /> <!-- used for required client validation -->
    </div>

    <a class="btn btn-warning btn-xs" id="attachment-add_input" onclick="addAttachmentInput()" href="javascript:void(0);">Tambah</a>
</div>

<script type="text/javascript">
$(function() {
    if( $('.date_picker').length ) {

        $( ".date_picker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    }
});
</script>
