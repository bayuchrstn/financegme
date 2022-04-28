<div class="form-group">
    <label for="date_start">Tanggal Mulai</label>
    <input  maxlength="500"  class="form-control date_picker" type="text" id="date_request_start_insert" name="date_start" value="" />
</div>
<div class="form-group">
    <label for="date_start">Tanggal Selesai</label>
    <input  maxlength="500"  class="form-control date_picker" type="text" id="date_request_end_insert" name="date_end" value="" />
</div>
<div class="form-group">
    <label for="date_billing">Tanggal Billing</label>
    <input type="text" name="date_billing" id="date_billing_insert" class="form-control date_picker">
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