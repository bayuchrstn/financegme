<script type="text/javascript">
    $(function() {
        $('.multiselect').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            templates: {
                filter: '<li class="multiselect-item multiselect-filter"><input class="form-control" type="text"></li>'
            },
            onChange: function() {
                $.uniform.update();
            }
        });
        $(".styled, .multiselect-container input").uniform({ radioClass: 'choice'});
    });

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

    function insert_placeholder(cc)
    {
        tinymce.activeEditor.execCommand('mceInsertContent', false, cc);
    }

    function update_email_notification(id)
    {
        var action = '<?php echo base_url(); ?>email_notifications/update/'+id;
        block_this('js_table_email_notification');
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                var response = jQuery.parseJSON(res);
                console.log(response);
                var receiver = response.receiver.split(',');
                if(response.receiver_mode=='system'){
                    $('#receiver_div').addClass('hide_me');
                } else {
                    $('#receiver_div').removeClass('hide_me');
                }
                $('#form_email_notification_update #receiver_update').multiselect('select', receiver);
                $("#form_email_notification_update").attr('action', response.action);
                $("#form_email_notification_update #name_update").val(response.name);
                $("#form_email_notification_update #receiver_mode_update").val(response.receiver_mode);
                $("#form_email_notification_update #subject_update").val(response.subject);
                $("#form_email_notification_update #body_fake").val(response.body);
                $("#form_email_notification_update #id_update").val(response.id);
                $("#form_email_notification_update #status_update").val(response.status);
                tinyMCE.get('body_update').setContent(response.body);
                $('#modal_email_notification').modal('show');
                unblock_this('js_table_email_notification');
            }
        });
        return false;
    }
</script>
