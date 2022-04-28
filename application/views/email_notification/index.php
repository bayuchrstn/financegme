<?php
    $arr = array();
    $arr['main_icon'] = $this->theme->icon('email_notifications');
    $arr['main_title'] = $this->lang->line('email_notification_alltitle');
    $arr['table_id'] = 'js_table_email_notification';
    $arr['table_action'] = array(
            '<a onclick="reload_table(\'js_table_product\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
        );
    $arr['table_th'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => $this->lang->line('email_notification_code'), 'width'=>'5'),
            array('label'   => $this->lang->line('email_notification_name')),
            array('label'   => $this->lang->line('email_notification_status')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
    echo $this->ui->load_template('datatable',$arr);
?>

<?php
    echo $update_view;
?>
