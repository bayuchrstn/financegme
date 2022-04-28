<?php
// $checkbox = $this->usergroup->privileges_checkbox();
// echo $checkbox;
    $arr = array();
    $arr['modal_icon'] = 'icon-users4';
    $arr['modal_id'] = 'modal_usergroup_privileges';
    $arr['form_id'] = 'form_usergroup_privileges';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_privileges"></div>';
    $arr['modal_title'] = $this->lang->line('usergroup_privileges');
    $arr['modal_content_info'] = '<div id="usergroup_info_div"></div>';
    $checkbox = $this->usergroup->privileges_checkbox();
    // $checkbox = '';
    $checkbox .= '<input type="hidden" name="fake_privileges" value="1">';
    $checkbox .= '<input type="hidden" id="id_privileges" name="id" value="">    ';
    $checkbox .= '<input type="hidden" id="usergroup_code" name="usergroup_code" value="">    ';

    $arr['modal_content'] = $checkbox;
    echo $this->ui->load_template('modal_default_scroller_info', $arr, TRUE);
?>

<script type="text/javascript">

</script>
