<script type="text/javascript">
    $(document).ready(function(){
        // alert('profile');
    });

    $(function () {
        'use strict';
        var url = '<?php echo base_url(); ?>my_profile/upload_photo';

        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            start: function (e, data) {
                block_this('photodiv');
            },
            done: function (e, data) {

                $.each(data.result.files, function (index, file) {
                    $.ajax({
                        type : 'post',
                        url  : '<?php echo base_url(); ?>my_profile/update_photo',
                        data : {'photo' : file.name},
                        success : function(res){
                            // console.log(res);
                            $('#photo').attr('src', file.url);
                            unblock_this('photodiv');

                        }
                    });
                });
            }
        });
    });
</script>
