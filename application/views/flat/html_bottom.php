<?php
    $arr = array();
    $arr['modal_icon'] = 'icon-magazine';
    $arr['modal_id'] = 'modal_profile';
    $arr['form_id'] = 'form_profile';
    $arr['form_action'] = base_url().'my_profile/update';
    $arr['form_input_top'] = '<div id="alert_modal_myprofile"></div>';
    $arr['modal_title'] = $this->lang->line('profile_modal_title');
    $arr['form_input'] = array(
            $this->ui->load_template('form_group_text',
                array(
                    'label'         => $this->lang->line('my_name'),
                    'id'            => 'my_name',
                    'name'          => 'name',
                    'class'         => 'form-control cos',
                    'maxlength'     => '250',
                    // 'value'         => 'hasek',
                )
            ),
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('my_email'),
                    'id'            => 'my_email',
                    'name'          => 'email',
                    'class'         => 'form-control cos',
                    'maxlength'     => '250',
                    // 'value'         => 'hasek',
                )
            ),
            $this->ui->load_template('form_group_text_readonly',
                array(
                    'label'         => $this->lang->line('my_username'),
                    'id'            => 'my_username',
                    'name'          => 'username',
                    'class'         => 'form-control cos',
                    'readonly'      => 'readonly',
                    'maxlength'     => '250',
                    // 'value'         => 'hasek',
                )
            ),
            $this->ui->load_template('form_group_password',
                array(
                    'label'         => $this->lang->line('my_password'),
                    'id'            => 'my_password',
                    'name'          => 'password',
                    'class'         => 'form-control cos',
                    'maxlength'     => '250',
                    'pwindicator'   => 'pwindicator_my_password',
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'my_name_required',
                    'name'          => 'my_name_required',
                    'value'         => $this->lang->line('my_name_required'),
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'my_email_required',
                    'name'          => 'my_email_required',
                    'value'         => $this->lang->line('my_email_required'),
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'my_email_email',
                    'name'          => 'my_email_email',
                    'value'         => $this->lang->line('my_email_email'),
                )
            ),
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'profile_update_seccess',
                    'name'          => 'profile_update_seccess',
                    'value'         => $this->lang->line('profile_update_seccess'),
                )
            ),

        );
    // pre($arr);
    echo $this->ui->load_template('modal_default_form_one_column', $arr, TRUE);
    echo $this->load->view('focus/default', '', TRUE);
    echo $this->load->view('flat/bug_report', '', TRUE);
?>
<input type="hidden" name="base_url_js" id="base_url_js" value="<?php echo base_url(); ?>">
<div id="not_div"></div>
