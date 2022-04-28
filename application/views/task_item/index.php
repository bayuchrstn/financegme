<?php
    // pre($table);
    // pre($task_id);
    // pre($prefix);
    // pre($current);
    // pre($column_data);

    $table_id = 'table_'.$table.'_'.$prefix;
    $jumlah_kolom = count($column_data);
    $warna_table = 'bg-info';

    switch ($parent_modul) {
        case 'cp':
            $main_title = 'Kontak Person ';
            $add_button = 'Tambah Kontak Person';
        break;

        case 'ts_boq':
            $main_title = 'Daftar Barang ';
            $add_button = 'Tambah Barang';
        break;

        case 'ts_laporan_barang_keluar':
            $main_title = 'Daftar Barang Keluar';
            $add_button = 'Tambah Barang Keluar';
        break;

        case 'ts_laporan_barang_kembali':
            $main_title = 'Daftar Barang Kembali';
            $add_button = 'Tambah Barang Kembali';
        break;

        case 'po':
            $main_title = 'Daftar item';
            $add_button = 'Tambah item';
        break;

        case 'item_replace_in':
        case 'item_in':
            $main_title = 'Daftar Barang Kembali';
            $add_button = 'Tambah Barang Kembali';
        break;



        case 'item_replace_out':
        case 'item_out':
            $main_title = 'Daftar Barang Keluar';
            $add_button = 'Tambah Barang Keluar';
        break;

        case 'po_pembanding':
            $main_title = 'Pembanding';
            $add_button = 'Tambah Pembanding';
        break;

        default:
            $main_title = 'Daftar item';
            $add_button = 'Tambah item';
        break;
    }
?>
<h5><?php echo $main_title; ?></h5>
<div class="table-responsive">
<table id="<?php echo $table_id; ?>" class="table table-form table-bordered">
    <thead>
        <tr class="<?php echo $warna_table; ?>">
            <?php
                foreach($column_data as $kolom):
                    $width = (isset($kolom['width'])) ? 'width="'.$kolom['width'].'"' : '';
            ?>
            <th <?php echo $width; ?>><?php echo $kolom['label'] ?></th>
            <?php
                endforeach;
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($current)):
    			foreach($current as $row):

		?>

        <tr>
            <?php
                foreach($row as $td):
            ?>
            <td >
                <?php echo $td; ?>
            </td>
            <?php
                endforeach;
            ?>
        </tr>

        <?php
                endforeach;
            endif;
        ?>

        <?php
            if(!empty($cart)):
                foreach($cart as $row):
        ?>
        <tr>
            <?php
                foreach($row as $td):
            ?>
            <td >
                <?php echo $td; ?>
            </td>
            <?php
                endforeach;
            ?>
        </tr>
        <?php
                endforeach;
            endif;
        ?>
    </tbody>
</table>
</div>

<?php if($add_button !=''): ?>
<a onclick="open_modal_task_item('<?php echo base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul; ?>', '<?php echo $prefix; ?>', '<?php echo $task_id; ?>');" href="javascript:void(0);" class="btn btn-default btn-block mb-10"><i class="icon-plus3 position-left"></i> <?php echo $add_button; ?></a>
<?php endif; ?>

<a onclick="reload_task_item('<?php echo base_url(); ?>xhr/task_item/index/<?php echo $table; ?>/<?php echo $task_id; ?>/<?php echo $prefix; ?>/<?php echo $target_div; ?>/<?php echo $parent_modul; ?>/', '<?php echo $target_div; ?>');" href="javascript:void(0);" class="btn btn-default btn-block mb-10">reload</a>
