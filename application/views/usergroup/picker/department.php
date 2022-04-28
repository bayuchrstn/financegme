<?php
    // pre($category_id);
    $divisi = $this->usergroup->gbc('divisi');
    if(!empty($divisi)):
?>
<form class="heading-form" action="#">
    <div class="form-group">
        <select class="form-control" id="divisi" onchange="change_divisi(this.value);">
            <?php
                $selected_all = ($category_id=='all') ? 'selected' : '';
            ?>
            <option <?php echo $selected_all; ?> value="all">Semua Divisi</option>
            <?php
                foreach($divisi as $row):
                    $selected = ($category_id==$row['code']) ? 'selected' : '';
            ?>
            <option <?php echo $selected; ?> value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
</form>
<?php
    endif;
?>
