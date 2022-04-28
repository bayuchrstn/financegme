<?php
    // pre($table);
    // pre($task_id);
    // pre($prefix);
    // pre($current);
    // pre($column_data);

    $table_id = 'table_'.$table.'_'.$prefix;
    $jumlah_kolom = count($column_data);

    switch ($parent_modul) {
        case 'po':
            $main_title = 'Daftar item';
            $add_button = 'Tambah item';
        break;

        case 'item_in':
            $main_title = 'Daftar Barang Kembali';
            $add_button = 'Tambah Barang Kembali';
        break;

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
<table id="<?php echo $table_id; ?>" class="table table-form table-bordered">
    <thead>
        <tr class="bg-success">
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
