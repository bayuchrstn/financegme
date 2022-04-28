<script type="text/javascript">
    function delete_notification(id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>alert/delete',
            data: {
                'alert_id': id
            },
            success: function(res) {
                var response = jQuery.parseJSON(res);
                create_alert('msg_alert', response.msg, (response.status == 'success') ? 'bg-success' : 'bg-danger');
            }
        });
        return false;
    }

    function update_notif(id, status) {
        var action = '<?= base_url(); ?>alert_notif/update/json';
        $.ajax({
            url: action,
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(res) {
                var response = $.parseJSON(res);
                if (status == 'read') {
                    window.location = '<?= base_url() ?>' + response.url_link;
                }

                <?php foreach ($tabs as $tab) :
                    $data_url = base_url() . 'alert_notif/data/' . $tab['code'];
                    ?>
                    $('#js_table_<?= $tab['code']; ?>').DataTable().ajax.reload(null, false);
                <?php endforeach; ?>
                // 
            }
        });
    }
</script>