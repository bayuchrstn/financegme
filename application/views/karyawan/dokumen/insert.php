<?php
	// pre($detail);
	// pre($detail);
	$prefix = 'insert';
	$forms = $this->ui->forms('people_ext', $detail, $prefix);
	// pre($this->ui->forms_debug($forms));

	echo $forms['dokumen_name'];
	echo $forms['file_name'];
	echo $forms['person_id'];
	echo $forms['type'];
?>

<input type="hidden" name="nama" value="xs">

<script type="text/javascript">

    $(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>uploader/people_doc';

        $('#file_name_insert').fileupload({
            url: url,
            dataType: 'json',
            start: function (e, data) {
                ispin('ibuttonuploader_insert');
            },
            done: function (e, data) {
				uspin('ibuttonuploader_insert');
				var i = 1;
				$.each(data.result.file_name, function (index, file) {
					i++;
					// console.log(file);
					// $('.patient_photo').val(file.name);
					$('#attachment_ul_insert').html('<li id="attachment_li_'+i+'" class="alert alert-primary no-border mb-5">'+file.name+' <a onclick="remove_this_attachment('+i+');" href="#" class="pull-right"><i class="icon-trash position-left"></i>Remove<input type="hidden" name="namafile" value="'+file.name+'"></a></li>');
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

</script>
