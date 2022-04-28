<?php
    $arr_product_picker = $this->product->arr_product_picker();
?>

<h6 class="content-group text-semibold">Pilih Product</h6>
<div class="panel-group panel-group-control content-group-lg no-border-radius" id="accordion-control">
    <?php
    if(!empty($arr_product_picker)):
        foreach($arr_product_picker as $category):
            // pre($category);
    ?>
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-control" href="#<?php echo $category['category_code']; ?>"><?php echo $category['category_name']; ?></a>
            </h6>
        </div>
        <div id="<?php echo $category['category_code']; ?>" class="panel-collapse collapse">
            <!-- <div class="panel-body"> -->
                <?php
                    $products = $category['product_lists'];
                ?>
                <table id="table_product_picker" class="table">
                    <tbody>
                    <?php
                        if(!empty($products)):
                            foreach($products as $row):
                    ?>

					<?php
					if($row['flag_fixprice']=='N'):
					?>
                    <tr>
                        <td class="text-center" style="width:30px !important;">
                            <?php
                                if($category['multiple']=='multiple'):
                            ?>
                            <input class="all" type="checkbox" name="sid[]" value="<?php echo $row['id']; ?>">
                            <?php
                                else:
                            ?>
                            <input class="all" type="radio" name="sid[]" value="<?php echo $row['id']; ?>">
                            <?php
                                endif;
                            ?>
                        </td>
                        <td class="text-left">
                            <strong><?php echo $row['name']; ?></strong>  <span class="text-muted"><?php echo $row['note']; ?></span>
                        </td>
                        <td class="text-right" style="width:100px !important;">
                            <input placeholder="Value" onfocus="this.placeholder=''" onblur="this.placeholder='value'" style="width:100px !important;" type="text" name="product_value[<?php echo $row['id']; ?>]" value="" class="product-input-text">
                        </td>
                        <td class="text-right" style="width:60px !important;">
                            <?php
                                if($row['flag_internet_service']=='Y'):
                            ?>
                            <select style="width:60px !important; height:26px !important;" class="product-input-text" name="product_satuan[<?php echo $row['id']; ?>]">
                                <option value="Mbps">Mbps</option>
                                <option value="Kbps">Kbps</option>
                            </select>
                            <?php
                            endif;
                            ?>
                        </td>
                        <td class="text-right" style="width:100px !important;">
                            <input placeholder="harga" style="width:100px !important;" type="text" name="product_price[<?php echo $row['id']; ?>]" value="" class="product-input-tex duit">
                        </td>
                    </tr>
					<?php
						else:
					?>
					<tr>
						<td class="text-center" style="width:30px !important;">
							<?php
                                if($category['multiple']=='multiple'):
                            ?>
                            <input class="all" type="checkbox" name="sid[]" value="<?php echo $row['id']; ?>">
                            <?php
                                else:
                            ?>
                            <input class="all" type="radio" name="sid[]" value="<?php echo $row['id']; ?>">
                            <?php
                                endif;
                            ?>
						</td>
						<td>
							<strong><?php echo $row['name']; ?></strong>  <span class="text-muted"><?php echo $row['note']; ?></span>
						</td>
						<td>
							<strong><?php echo currency($row['price']); ?></strong>
						</td>
					</tr>
					<?php
						endif;
					?>

                    <?php
                            endforeach;
                        endif;
                    ?>
                    </tbody>
                </table>
            <!-- </div> -->
        </div>
    </div>
    <?php
        endforeach;
    endif;
    ?>

</div>
