<?php

//Usage example
// $options = array();
// $options['component'] = 'component/panel/panel_table_tab';
// $options['max'] = '8';
// $options['panel_id'] = 'panel_product';
// $options['tab_id'] = 'tab1';
// $options['tab_padding'] = 'no';
// $options['panel_icon'] = $this->theme->icon('product');
// $options['panel_title'] = $this->lang->line('product_alltitle');
// $options['selected_tab'] = 'mendaftar';
// $options['panel_action'] = array(
// 		'<a onclick="input_product();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('product_insert').'</a>',
// 	);
// $options['tabs'] = array();
// $options['tabs'][] = array(
// 	'label'         => $tab['name'],
// 	'id'            => $tab['code'],
// 	'table_columns' => array(
// 		array('label'   => '#', 'width'=>'5'),
// 		array('label'   => $this->lang->line('layanan_date_start')),
// 		array('label'   => 'Action', 'width'=>'50'),
// 	)
// );


$total_tab = count($tabs);
$maksimal = ($total_tab >= $max) ? $max : $total_tab;

$panel_id = (isset($panel_id)) ? $panel_id : '';
$panel_icon = (isset($panel_icon)) ? $panel_icon : '';
$panel_title = (isset($panel_title)) ? $panel_title : '';
$panel_sub_title = (isset($panel_sub_title)) ? $panel_sub_title : '';
$panel_heading_ext = (isset($panel_heading_ext)) ? $panel_heading_ext : '';
$panel_action = (isset($panel_action)) ? $panel_action : array();
$msg_alert = (isset($msg_alert)) ? $msg_alert : 'msg_alert';
?>
<div id="<?php echo $msg_alert; ?>"></div>
<div id="<?php echo $panel_id; ?>" class="panel panel-default">
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
					<div class="input-group" style="width:390px !important;">
						<input type="text" class="form-control search_form" placeholder="Search">
                        <?php if (isset($button_search) && $button_search!='no'): ?>
                        <div class="input-group-btn">
                            <button id="btnSearch" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i></b></button>
                        </div>
                        <?php endif ?>
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
    <div class="tabbable">
        <ul id="<?php echo $tab_id; ?>" class="nav nav-tabs <?php //echo BG_THEME; ?>">
            <?php
            for($i=0; $i<$maksimal; $i++):
                $tab = $tabs[$i];
                // pre($selected_tab);
                $active = ($tab['id']==$selected_tab) ? 'active' : '';
                ?>
                <li class="<?php echo $active; ?>">
                    <a href="#<?php echo $tab['id']; ?>" data-toggle="tab" ><?php echo $tab['label']; ?></a>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <span class="caret"></span></a>
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
        <?php
        // pre($selected_tab);
        $padding = ($tab_padding=='yes') ? 'has-padding' : '';
        ?>
        <div class="tab-content">
            <?php
            for($i=0; $i<$total_tab; $i++):
                $tab = $tabs[$i];
                // pre($tab);
                $active = ($tab['id']==$selected_tab) ? 'active' : '';
            ?>
                <div class="tab-pane <?php echo $padding; ?> <?php echo $active; ?>" id="<?php echo $tab['id']; ?>">
                    <?php if(!empty($tab['table_columns'])): ?>
                    <table class="table" id="js_table_<?php echo $tab['id']; ?>" style="width:100%;">
                        <thead>
                            <tr>
                                <?php
                                    foreach($tab['table_columns'] as $th):
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
                    <?php endif; ?>
                </div>
            <?php
            endfor;
            ?>
        </div>
    </div>
</div>
