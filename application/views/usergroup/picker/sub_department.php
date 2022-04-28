<?php
    // pre($category_id);
    $divisi = $this->usergroup->gbc('divisi');


    if(!empty($divisi)):
?>
<form class="heading-form" action="#">
    <div class="form-group">
        <select class="form-control" id="divisi" onchange="change_department(this.value);">
            <?php
                $selected_all = ($category_id=='all') ? 'selected' : '';
            ?>
            <option value="all">Semua Departemen</option>
            <?php
                foreach($divisi as $row):
                    $department = $this->usergroup->get_dept_by_divisi($row['code']);
            ?>
            <optgroup label="<?php echo $row['name']; ?>">
                <?php
                    if(!empty($department)):
                        foreach($department as $dept):
                            $selected = ($category_id==$dept['code']) ? 'selected' : '';
                ?>
                <option <?php echo $selected; ?> value="<?php echo $dept['code']; ?>"><?php echo $dept['name']; ?></option>
                <?php
                        endforeach;
                    endif;
                ?>
            </optgroup>
            <?php
                endforeach;
            ?>
        </select>
    </div>
</form>
<?php
    endif;
?>
