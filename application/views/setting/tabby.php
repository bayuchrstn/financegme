<?php
$sql = "SELECT
            name as label_category,
            code as category
        FROM {PRE}setting_category
        ORDER BY sort ASC";
$categorys = $this->db->query($sql)->result_array();
$input_selector_val = ($selected !='') ? $selected : $categorys[0]['category'];
?>


<?php
    $arr = array();
    $arr['tab_id'] = 'tab1';
    $arr['tab_padding'] = 'no';
    $arr['max'] = '8';
    $arr['selected_tab'] = ($selected=='') ? 'general' : $selected;
    $arr['tabs'] = array();

    foreach($categorys as $tab):
        $forms = $this->setting->by_category($tab['category']);
        $content = '';
        foreach($forms as $form):
            $content .= '
            <div class="form-group">
                <label>'.$form['label'].'</label>
                <input type="text" name="'.$form['setting'].'" value="'.$form['value'].'" class="cos form-control">
                <span class="help-block">'.$form['setting'].'</span>
            </div>';
        endforeach;

        $arr['tabs'][] = array(
                'label'         => $tab['label_category'],
                'id'            => $tab['category'],
                'content'       => $content
            );
    endforeach;
    echo $this->ui->load_template('tab_default', $arr, TRUE);
?>
