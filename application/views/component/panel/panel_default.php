<?php
	//Usage
	// $options['component'] = 'component/panel/panel_default';
	// $options['panel_icon'] = $this->theme->icon('patient');
	// $options['panel_title'] = $this->lang->line('patient_alltitle');
	// $options['panel_action'] = array(
    //        '<a onclick="insert_patient();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('patient_insert').'</a>',
    //        '<a onclick="reload_table(\'js_table_patient\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
    //    );
	// echo $this->ui->load_component($options);

    $panel_icon = (isset($panel_icon)) ? $panel_icon : '';
    $panel_title = (isset($panel_title)) ? $panel_title : '';
    $panel_action = (isset($panel_action)) ? $panel_action : array();
    $panel_content = (isset($panel_content)) ? $panel_content : '';
    $panel_padding = (isset($panel_padding)) ? $panel_padding : 'yes';
    // pre($main_title);
?>
<div id="msg_alert"></div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title text-semiold"><i class="<?php echo $panel_icon; ?>"></i> <?php echo $panel_title; ?></h5>
        <div class="heading-elements">
			<?php
			if(!empty($panel_action)):
			?>
            <div class="btn-group heading-btn">
                <!-- <button class="btn btn-info btn-icon"><i class="icon-three-bars"></i> Menu</button>
                <button class="btn btn-info btn-icon"><i class="icon-three-bars"></i> Menu</button> -->
                <button class="btn btn-info btn-icon dropdown-toggle " data-toggle="dropdown" aria-expanded="false"><i class="icon-three-bars"></i> Menu</button>
				<ul class="dropdown-menu dropdown-menu-right">
					<?php foreach($panel_action as $action): ?>
					<li><?php echo $action; ?></li>
					<?php endforeach; ?>
				</ul>
            </div>
			<?php
			endif;
			?>
        </div>
    </div>
	<?php if($panel_padding=='yes'): ?>
    <div class="panel-body">
	<?php endif; ?>
		<?php
			echo $panel_content;
		?>
	<?php if($panel_padding=='yes'): ?>
    </div>
	<?php endif; ?>

</div>
