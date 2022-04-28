<div id="msg_add_item">

</div>
<?php
    // pre($items);
    $prefix = 'add_item';
    $default_value = array();
    $forms = $this->ui->forms('invoice_item', $default_value, $prefix);

    $option_sort = '';
    $jumlah_item = count($items);
    if($jumlah_item > 0):
        for($i=1; $i<=$jumlah_item+1; $i++):
            $option_sort .= '<option>'.$i.'</option>';
        endfor;
    endif;

    echo $forms['item_name'];
    echo $forms['qty'];
    echo $forms['unit_price'];
    echo $forms['note'];
    echo $forms['sort'];
    echo $forms['invoice_id'];
?>

<script type="text/javascript">
    <?php echo $this->load->view('misc/duit_numeric', '', TRUE); ?>
    $('#sort_<?php echo $prefix; ?>').html('<?php echo $option_sort; ?>');
    $('#invoice_id_<?php echo $prefix; ?>').val(<?php echo $invoice_id; ?>);
</script>
