<?php
// pre($tabs);
// pre($max);
$total_tab = count($tabs);
$maksimal = ($total_tab >= $max) ? $max : $total_tab;
// pre($total_tab);
// pre($maksimal);
$main_icon = (isset($main_icon)) ? '<i class="'.$main_icon.' position-left"></i>' : '';
$panel_id = (isset($panel_id)) ? $panel_id : '';

?>
<div id="msg_alert"></div>
<div id="<?php echo $panel_id; ?>" class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title text-semiold"><?php echo $main_icon; ?> <?php echo $main_title; ?></h6>
        <div class="heading-elements">
            <form class="heading-form" action="" method="post">
                <div class="input-group" style="width:390px !important;">
                    <input type="text" class="form-control search_form " placeholder="Search">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-info btn-icon legitRipple dropdown-toggle legitRipple" data-toggle="dropdown"><i class="icon-three-bars"></i> Menu</button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php foreach($table_action as $action): ?>
                            <li><?php echo $action; ?></li>
                            <?php endforeach; ?>
                        </ul>
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
