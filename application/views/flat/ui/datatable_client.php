<?php
    $main_icon = (isset($main_icon)) ? '<i class="'.$main_icon.' position-left"></i>' : '';
    // pre($main_title);
?>
<div id="msg_alert"></div>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title text-semiold"><?php echo $main_icon; ?> <?php echo $main_title; ?></h6>
        <div class="heading-elements">
            <form class="heading-form" action="" method="post">
				<div class="form-group">
					<div class="input-group" style="width:390px !important;">
						<input id="search_form" type="text" class="form-control" placeholder="Search">
						<div class="input-group-btn">
							<button type="button" class="btn btn-info btn-icon legitRipple dropdown-toggle" title="Customer Menu" data-toggle="dropdown"><i class="icon-three-bars"></i> Menu</button>
							<ul class="dropdown-menu dropdown-menu-right">
								<?php foreach($table_action as $action): ?>
									<li><?php echo $action; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <?php
            // pre($table_th);
        ?>
        <table id="<?php echo $table_id; ?>" class="table table-hover table-striped datatable-js" style="width:100%">
            <thead>
                <tr class="<?php //echo BG_THEME; ?>">
                    <?php
                        foreach($table_th as $th):
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

    </div>
</div>
