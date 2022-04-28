<div id="msg_update_item">

</div>

<?php
    // pre($item);
    // pre($invoice_id);
    // pre($item_id);
    $prefix = 'update_item';
    $default_value = array();
    $forms = $this->ui->forms('invoice_item', $default_value, $prefix);

    $option_sort = '';
    $jumlah_item = count($items);
    if($jumlah_item > 0):
        for($i=1; $i<=$jumlah_item; $i++):
            $option_sort .= '<option>'.$i.'</option>';
        endfor;
    endif;

    // pre($option_sort);


    echo $forms['item_name'];
    echo $forms['qty'];
    echo $forms['unit_price'];
    echo $forms['note'];
    echo $forms['sort'];
    echo $forms['invoice_id'];
    echo $forms['item_id'];
?>

<script type="text/javascript">
    var item = <?php echo json_encode($item); ?>;
    $('#item_name_<?php echo $prefix; ?>').val(item.product_description);
    $('#qty_<?php echo $prefix; ?>').val(item.product_qty);
    $('#unit_price_<?php echo $prefix; ?>').val(item.product_price);
    $('#note_<?php echo $prefix; ?>').val(item.product_note);
    $('#sort_<?php echo $prefix; ?>').html('<?php echo $option_sort; ?>');
    $('#invoice_id_<?php echo $prefix; ?>').val(<?php echo $invoice_id; ?>);
    $('#item_id_<?php echo $prefix; ?>').val(<?php echo $item_id; ?>);

    <?php echo $this->load->view('misc/duit_numeric', '', TRUE); ?>
</script>
