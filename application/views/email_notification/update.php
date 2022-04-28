<?php
    // pre($placeholders);
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('email_notifications');
    $arr['modal_id'] = 'modal_email_notification';
    $arr['form_id'] = 'form_email_notification_update';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_update"></div>';
    $arr['modal_title'] = $this->lang->line('email_notification_update');
    $arr['form_input_left'] = array(
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('email_notification_name'),
                    'id'            => 'name_update',
                    'name'          => 'name',
                    'class'         => 'form-control',
                    'maxlength'     => '200',
                )
            ),
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('email_notification_subject'),
                    'id'            => 'subject_update',
                    'name'          => 'subject',
                    'class'         => 'form-control',
                    'maxlength'     => '200',
                )
            ),

        );

    //custom Agents
    $custom_placeholder = '<div class="form-group">';
    $custom_placeholder .= '<label>Insert Placeholders</label>';
    $custom_placeholder .= '<div>';

    if(!empty($placeholders)):
        foreach($placeholders as $row=>$val):
            $custom_placeholder .= ' <a class="btn btn-default" onclick="insert_placeholder(\''.$row.'\')" href="javascript:void(0);">'.$val.'</a>';
        endforeach;
    endif;

    $custom_placeholder .= '</div>';
    $custom_placeholder .= '</div>';

    $arr['form_input_bottom'] = array(

            $this->ui->load_template('form_group_textarea_wysiwyg',
                array(
                    'label'         => $this->lang->line('email_notification_body'),
                    'id'            => 'body_update',
                    'name'          => 'body',
                    'class'         => 'form-control wysiwyg',
                )
            ),
            $custom_placeholder
        );

    //custom Agents
    $custom_receiver = '<div id="receiver_div" class="form-group">';
    $custom_receiver .= '<label>Receiver (Agents)</label>';
    $custom_receiver .= '<div class="multi-select-full">';
    $custom_receiver .= form_dropdown('receiver[]', $email_agent, '', 'class="multiselect" multiple="multiple" id="receiver_update"');
    $custom_receiver .= '</div>';
    $custom_receiver .= '</div>';


    $arr['form_input_right'] = array(

            $this->ui->load_template('form_group_dropdown',
                array(
                    'label'         => $this->lang->line('email_notification_status'),
                    'name'          => 'status',
                    'option'        => array(
                            'enable'    => 'Enable',
                            'disable'    => 'Disable'
                        ),
                    'ext'           => 'class="form-control" id="status_update"'
                )
            ),
            $custom_receiver,
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'id_update',
                    'name'          => 'id',
                    'value'         => '',
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'receiver_mode_update',
                    'name'          => 'receiver_mode',
                    'value'         => '',
                )
            ),

        );
    echo $this->ui->load_template('modal_large_form_two_column', $arr, TRUE);
?>
