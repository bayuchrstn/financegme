<script type="text/javascript">
    $(function() {

        // Override defaults
        // ------------------------------

        // Disable highlight
        $.fn.editable.defaults.highlight = false;

        // Output template
        $.fn.editableform.template = '<form class="editableform">' +
            '<div class="control-group">' +
            '<div class="editable-input"></div> <div class="editable-buttons"></div>' +
            '<div class="editable-error-block"></div>' +
            '</div> ' +
        '</form>'

        // Set popup mode as default
        $.fn.editable.defaults.mode = 'popup';

        // Buttons
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-primary btn-icon editable-submit"><i class="icon-check"></i></button>' +
            '<button type="button" class="btn btn-default btn-icon editable-cancel"><i class="icon-x"></i></button>';

        
    });
</script>
