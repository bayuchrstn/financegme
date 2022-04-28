<?php
	//Usage
	// $options['component'] = 'component/panel/panel_table';
	// $options['panel_icon'] = $this->theme->icon('patient');
	// $options['panel_title'] = $this->lang->line('patient_alltitle');
	// $options['panel_action'] = array(
    //        '<a onclick="insert_patient();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('patient_insert').'</a>',
    //        '<a onclick="reload_table(\'js_table_patient\');" href="javascript:void(0)"><i class="icon-reload-alt"></i> '.$this->lang->line('all_refresh').'</a>',
    //    );
	// $options['table_id'] = 'xxxx';
	// $options['table_column'] = array(
    //         array('label'   => '#', 'width'=>'5'),
    //         array('label'   => $this->lang->line('patient_mrid')),
    //         array('label'   => $this->lang->line('patient_name')),
    //         array('label'   => $this->lang->line('patient_address')),
    //         array('label'   => $this->lang->line('patient_telephone')),
    //         array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    //     );
	// echo $this->ui->load_component($options);

    $panel_icon = (isset($panel_icon)) ? $panel_icon : '';
    $panel_title = (isset($panel_title)) ? $panel_title : '';
    $panel_action = (isset($panel_action)) ? $panel_action : array();
    $table_id = (isset($table_id)) ? $table_id : '';
    $panel_heading_ext = (isset($panel_heading_ext)) ? $panel_heading_ext : '';
    $table_column = (isset($table_column)) ? $table_column : array();
    // pre($main_title);
	$msg_alert = (isset($msg_alert)) ? $msg_alert : 'msg_alert';
	$panel_sub_title = (isset($panel_sub_title)) ? $panel_sub_title : '';
?>
<div id="<?php echo $msg_alert; ?>"></div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title text-semiold">
			<i class="<?php echo $panel_icon; ?> position-left"></i> <?php echo $panel_title; ?>
			<?php echo $panel_sub_title; ?>
		</h5>
        <div class="heading-elements">

			<!-- ext  -->
			<?php
				if($panel_heading_ext !=''):
					echo $panel_heading_ext;
				endif;
			?>
			<!-- ext  -->



            <form class="heading-form" action="" method="post">
				<div class="form-group">
					<div class="input-group" >
						<input id="search_form" type="text" class="form-control " placeholder="Search">

						<?php
						if(!empty($panel_action)):
						?>
						<div class="input-group-btn">
							<button type="button" class="btn btn-info btn-icon legitRipple dropdown-toggle" title="Customer Menu" data-toggle="dropdown"><i class="icon-three-bars"></i> Menu</button>
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
            </form>

        </div>
    </div>
    <div class="table-responsives">
        <?php
        if(!empty($table_column)):
        ?>
        <table id="<?php echo $table_id; ?>" class="table table-hover table-striped datatable-js" style="width:100%">
            <thead>
                <tr>
                    <?php
                        foreach($table_column as $th):
                            // pre($th);
                            $width = (isset($th['width'])) ? 'width="'.$th['width'].'"' : '';
                    ?>
                    <th <?php echo $width; ?>><?php echo $th['label']; ?></th>
                    <?php
                        endforeach;
                    ?>
                </tr>
            </thead>
        </table>
		<?php
		endif;
		?>
    </div>
</div>
