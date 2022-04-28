<script type="text/javascript">
    $(document).ready(function(){
        // alert('js uploader');
    });

    $(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>uploader/task_attachment';

        $('#attachment_insert').fileupload({
            url: url,
            dataType: 'json',
            start: function (e, data) {
                ispin('ibuttonuploader');
            },
            done: function (e, data) {
                // var attachment_input = '';
                var attachment_info = '';
                $.each(data.result.attachment, function (index, file) {
                    console.log(file);
                    // attachment_input += '<input type="hidden" name="attachment[]" value="'+file.name+'">';
                    attachment_info += '<li><input readonly class="input_form_attachment" type="text" name="attachment[]" value="'+file.name+'"></li>';
                });
                // alert(attachment_input);

                // $('#attachment-input').append(attachment_input);
                $('#info-attachment').append(attachment_info);
                uspin('ibuttonuploader');
            }
        });
    });
</script>
