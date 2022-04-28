<?php
    $options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('user');
	$options['panel_title'] = $this->lang->line('user_alltitle');
	$options['panel_action'] = array(
            '<a onclick="input_user();" href="javascript:void(0)"><i class="icon-plus3"></i> Input User</a>',
        );
	$options['table_id'] = 'js_table_user';
	$options['table_column'] = array(
            array('label'   => '#', 'width'=>'5'),
            array('label'   => 'Nama'),
            array('label'   => 'Divisi'),
            array('label'   => 'Departemen'),
            array('label'   => 'Sub Departemen'),
            array('label'   => 'Jabatan'),
            array('label'   => $this->lang->line('user_active')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
?>

<?php echo $insert_view; ?>
<?php echo $update_view; ?>
<?php echo $delete_view; ?>
<?php echo $usergroup_view; ?>
