<?php
    // pre($status_invoice);
    $arr_status = array(
            'edit'      => 'Belum diedit',
            'ready'     => 'Sudah diedit',
            'approved'  => 'Sudah diapprove',
            'printed'   => 'Sudah dicetak',
        );
?>
<form id="form_owner_filter" class="heading-form" action="<?php echo base_url(); ?>poe" method="post">
	<div class="form-group" style="width:100%;">
        <?php
            echo form_dropdown('invoice_status_switcher', $arr_status, $status_invoice, 'class="form-control" id="invoice_status_switcher"');
        ?>
	</div>

</form>
