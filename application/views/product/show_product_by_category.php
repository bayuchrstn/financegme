<?php
    // pre($products);
?>
<table id="table_product_picker" class="tables table-bordereds table-stripeds mt-10">
    <!-- <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">value</th>
            <th >Satuan</th>
            <th class="text-center">Price</th>
        </tr>
    </thead> -->
    <tbody>


    <?php
        if(!empty($products)):
        // if(FALSE):
            foreach($products as $row):
    ?>
    <tr>
        <td class="text-center">
            <input type="checkbox" name="product_id[]" value="<?php echo $row['id']; ?>">
        </td>
        <td class="text-left">
            <?php echo $row['name']; ?>
        </td>
        <td class="text-center">
            <input type="text" name="product_value[<?php echo $row['id']; ?>]" value="" class="product-input-text">
        </td>
        <td class="text-center">
            <select class="product-input-text" name="product_satuan[<?php echo $row['id']; ?>]">
                <option value="Mbps">Mbps</option>
                <option value="Kbps">Kbps</option>
            </select>
        </td>
        <td class="text-center">
            <input type="text" name="product_price[<?php echo $row['id']; ?>]" value="" class="product-input-tex">
        </td>
    </tr>
    <?php
            endforeach;
        endif;
    ?>
    </tbody>
</table>
