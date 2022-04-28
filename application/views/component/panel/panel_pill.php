<?php
	//Usage
	// $options['component'] = 'component/panel/panel_pill';
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
	$total_tab = count($tabs);
	// pre($total_tab);
	$max = $max;
	$maksimal = ($total_tab >= $max) ? $max : $total_tab;
	// pre($maksimal);
	$selected_tab = $selected_tab;
?>
<div id="msg_alert"></div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title text-semiold"><i class="<?php echo $panel_icon; ?>"></i> <?php echo $panel_title; ?></h5>
        <div class="heading-elements">
			<ul class="nav nav-pills">
				<?php
		        	for($i=0; $i<$maksimal; $i++):
		            	$tab = $tabs[$i];
		            	// pre($tab);
		            	$active = ($tab['id']==$selected_tab) ? 'active' : '';
		        ?>
				<li class="<?php echo $active; ?>">
					<a href="#<?php echo $tab['id']; ?>" data-toggle="tab"><?php echo $tab['label']; ?></a>
				</li>
				<?php
		        	endfor;
		        ?>

				<?php
		            if($total_tab > $max):
		                $start_more = $max;
		                // pre($start_more);
		                // pre($total_tab);
		        ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						more
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
					<?php
		                for($m=$start_more; $m<$total_tab; $m++):
		                    // pre($m);
		                    $tab = $tabs[$m];
		                    // pre($tab);
	                ?>
						<li><a href="#<?php echo $tab['id']; ?>" data-toggle="tab"><?php echo $tab['label']; ?></a></li>
					<?php
	                	endfor;
	                ?>
					</ul>
				</li>
				<?php
		            endif;
		        ?>
			</ul>
        </div>
    </div>

	<div class="panel-tab-content tab-content">
		<?php
			for($i=0; $i<$total_tab; $i++):
				$tab = $tabs[$i];
				// pre($tab);
				$active = ($tab['id']==$selected_tab) ? 'active' : '';

				$padding = ($panel_padding=='yes') ? 'has-padding' : '';
		?>
		<div class="tab-pane <?php echo $active; ?> <?php echo $padding; ?>" id="<?php echo $tab['id']; ?>">
			<?php echo $tab['content']; ?>
		</div>
		<?php
			endfor;
		?>
	</div>

</div>
