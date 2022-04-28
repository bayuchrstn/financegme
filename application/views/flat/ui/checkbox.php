<?php
    // pre($checkboxs);
    if(isset($checkboxs)):
?>
<ul style="list-style-type:none; margin:0; padding:0;">
    <?php
        foreach($checkboxs as $row):
    ?>
    <li>
        <div class="checkbox">
            <label>
                <input id="<?php echo $row['id']; ?>" class="<?php echo $row['class']; ?>" name="<?php echo $row['name']; ?>" value="<?php echo $row['value']; ?>" type="checkbox">
                <?php echo $row['label']; ?>
            </label>
        </div>
    </li>
    <?php
        endforeach;
    ?>
</ul>
<?php
    endif;
?>
