<?php
    // pre($approval_cfg);
?>
<table class="table table-form table-bordered">
    <thead class="bg-info">
        <tr>
            <th width="5">#</th>
            <th>Nama</th>
            <!-- <th>Tanggal</th> -->
            <th>Status</th>
            <th width="200">Catatan</th>
        </tr>
    </thead>

    <?php if(!empty($approval_cfg)): ?>
        <tbody>
            <?php
                $urut = 1;
                foreach($approval_cfg as $row):
                    $arr_options = $row['options'];
                    // pre($arr_options);

                    $approval_data = $this->approval->get_data($row['modul'], $row['user_id'], $task_id);
                    // pre($approval_data);
            ?>
            <tr>
                <td><?php echo $urut; ?></td>
                <td><?php echo $row['name']; ?></td>
                <!-- <td>sdfsdf</td> -->
                <td><a href="#" class="editable_select" data-value="revisi" data-source="<?php echo $arr_options; ?>" id="invoice_name" data-inputclass="form-control" data-pk="1" ></a></td>
                <td><a href="#" class="editable_textarea" data-value="" data-inputclass="form-control" data-pk="1" ></a></td>
            </tr>
            <?php
                    $urut++;
                endforeach;
            ?>
        </tbody>

    <?php endif; ?>
</table>
<?php
    $this->load->view('approval/js', '');
?>
