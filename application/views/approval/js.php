<script type="text/javascript">
    $(function() {

        // input text
        $('.editable_text').editable({
            url: '<?php echo base_url(); ?>xhr/approval/update',
            title: 'Enter username',
            type: 'text'
        });

        // select
        $('.editable_select').editable({
            url: '<?php echo base_url(); ?>xhr/approval/update',
            title: 'Approval Status',
            type: 'select'
        });

        // textarea
        $('.editable_textarea').editable({
            url: '<?php echo base_url(); ?>xhr/approval/update',
            title: 'Approval Status',
            type: 'textarea',
            rows: 2,
        showbuttons: 'bottom'
        });

    });
</script>
