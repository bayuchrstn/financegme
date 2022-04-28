<?php
    // pre($detail);
    // pre($detail['category']);

    // diambil semua datanya dan di unserilize
    $item = ($detail['items'] !='') ? $this->invoice->get_items($detail['items']) : array();
    $diskon = ($detail['diskon'] !='') ? unserialize($detail['diskon']) : array();
    $prorate = ($detail['prorate'] !='') ? unserialize($detail['prorate']) : array();

    // pre($item);

    //jika ada prorate maka yang di tampilkan adalah proratenya
    if(!empty($prorate)):
		$daftar_lists = $prorate;
	else:
		$daftar_lists = $item;
	endif;
    // pre($daftar_lists);

    //total barisnya
	$jumlah_list = count($daftar_lists);
    // pre($jumlah_list);

?>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="text-center th_main">No</th>
			<th class="text-center th_main">Description</th>
			<th class="text-center th_main">Note</th>
			<th class="text-center th_main">Qty</th>
			<th class="text-center th_main">Unit Price</th>
			<th class="text-center th_main">Total Price</th>
			<th class="text-center th_main">Action</th>
		</tr>
	</thead>
	<tbody>
        <?php
            $urut = 0;
            $total_amount = 0;
            $total_sub = 0;

            $key_arr = 0;
            foreach($item as $row):
                $urut++;


                // pre($key_arr);
                //harga satuan
                // if($ppn_mode=='1'):
                //     $unit_price = (int) $row['product_price_ppn'];
                // else:
                //     $unit_price = (int) $row['product_price'];
                // endif;

                $unit_price = (int) $row['product_price'];

                $qty = (isset($row['product_qty']) && $row['product_qty'] !='') ? $row['product_qty'] : '1';
                $cur = (isset($row['product_currency']) && $row['product_currency'] !='') ? $row['product_currency'] : 'IDR';

                //harga satuan x jumlah
                $total_price = $qty * $unit_price;

                // harga penjumlahan tanpa ppm sebelum di kurangi diskon
                $total_amount += $qty * $row['product_price'];

                // harga penjumlahan pakai / tak pakai ppn
                $total_sub += $total_price;
                // $zebra = ($urut%2=='0') ? 'gelap' : 'terang';
                //
          //  		$border_bawah_no_ppn = ($table_mode =='print_no_ppn' && $jumlah_list==$urut && $jumlah_list !='1') ? 'border_bawah' : '';

          //  		$des_persen = ($table_mode == 'print_no_ppn') ? '60%' : '31%';
          //  		$not_persen = ($table_mode == 'print_no_ppn') ? '22%' : '31%';

                $source = $row['product_description'];
				$diganti = array('Enterprice', 'Gamene', 'Abonemen koneksi internet Dedicated MAXi');
				$pengganti   = array('Enterprise', 'Gamenet', 'Abonemen koneksi internet');
				$edited = str_replace($diganti, $pengganti, $source);
        ?>
        <tr>
            <td width="3%" class=" ">
            	<div class="text-center"><?php //echo $table_mode; ?> <?php //echo $jumlah_list; ?> <?php echo $urut; ?></div>
            </td>
            <td class="" width="">
            	<div class="text-left"><?php echo $edited; ?></div>
            </td>
            <td class="" width="">
            	<div class="text-left"><?php echo $row['product_note']; ?></div>
            </td>


            <td class="" width="5%">
            	<div class="text-center"><?php echo $qty; ?></div>
            </td>
            <td class="" width="15%">
            	<div class="text-right"><?php echo currency($unit_price); ?></div>
            </td>

            <td class="" width="15%">
            	<div class="text-right"><?php echo currency($total_price); ?></div>
            </td>

            <td class="" width="15%">
            	<div class="text-right">
                    <ul class="icons-list">
                    	<li class="dropdown">
                    		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon-menu7"></i></a>
                    		<ul class="dropdown-menu dropdown-menu-right">
                    			<li><a onclick="update_item('<?php echo $detail['id']; ?>', '<?php echo $key_arr; ?>')" href="javascript:void(0);"><i class="icon-pencil position-left"></i> Update</a></li>
                    			<li><a onclick="delete_item()"  href="javascript:void(0);"><i class="icon-remove position-left"></i> Delete</a></li>
                    		</ul>
                    	</li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php
                $key_arr++;
            endforeach;
        ?>
	</tbody>
</table>
<a href="#" onclick="add_item('<?php echo $detail['id']; ?>');">add item</a>

<script type="text/javascript">

    function add_item(invoice_id)
    {
        var action = '<?php echo base_url(); ?>invoice/add_item/'+invoice_id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                $('#modal_add_item_div').html(res);
                $('#modal_add_item_form').attr('action', action);
                $('#modal_add_item').modal('show');
            }
        });
        return false;


    }

    function update_item(invoice_id, item_id)
    {
        var action = '<?php echo base_url(); ?>invoice/update_item/'+invoice_id+'/'+item_id;
        $.ajax({
            type:'GET',
            url: action,
            success: function(res) {
                $('#modal_update_item_div').html(res);
                $('#modal_update_item_form').attr('action', action);
                $('#modal_update_item').modal('show');
            }
        });
        return false;
    }

    function delete_item()
    {
        $('#modal_add_item').modal('show');
    }


</script>
