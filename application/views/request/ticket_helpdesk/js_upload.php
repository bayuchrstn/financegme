<script type="text/javascript">

    $(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>uploader/request/<?php echo $req_code; ?>';

        $('#attachment_create').fileupload({
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
					$('#attachment_ul_create').append('<li id="attachment_li_'+i+'" class="alert alert-primary no-border mb-5">'+file.name+' <a onclick="remove_this_attachment('+i+');" href="#" class="pull-right"><i class="icon-trash position-left"></i>Remove<input type="hidden" name="attachment[]" value="'+file.name+'"></a></li>');
					// $('.photo_profile_patient').attr('src', '<?php echo base_url(); ?>patient_photo/medium/'+file.name);
				});
            }
        });
    });

	$(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>uploader/request/<?php echo $req_code; ?>';

        $('#attachment_update').fileupload({
            url: url,
            dataType: 'json',
            start: function (e, data) {
                ispin('ibuttonuploader_update');
            },
            done: function (e, data) {
				uspin('ibuttonuploader_update');
				var i = 1;
				$.each(data.result.attachment, function (index, file) {
					i++;
					// console.log(file);
					// $('.patient_photo').val(file.name);
					$('#attachment_ul_update').append('<li id="attachment_li_'+i+'" class="alert alert-primary no-border mb-5">'+file.name+' <a onclick="remove_this_attachment('+i+');" href="#" class="pull-right"><i class="icon-trash position-left"></i>Remove<input type="hidden" name="attachment[]" value="'+file.name+'"></a></li>');
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
