<?php

// usage Example
// $options = array();
// $options['component'] = 'component/tab/tab_default';
// $options['tab_id'] = 'tab1';
// $options['tab_padding'] = 'no';
// $options['max'] = '8';
// $options['selected_tab'] = 'focus_data_pasien';
// $options['tabs'] = array();
//
// $options['tabs'][] = array(
// 		'label'         => 'Data Pasien',
// 		'id'            => 'focus_data_pasien',
// 		'content'       => 'focus_data_pasien',
// 	);
//
// $options['tabs'][] = array(
// 		'label'         => 'Rekam Medis',
// 		'id'            => 'focus_rekam_medis',
// 		'content'       => 'focus_rekam_medis',
// 	);
// $content = $this->ui->load_component($options);
// usage Example

// pre($tabs);
// pre($max);
$total_tab = count($tabs);
$maksimal = ($total_tab >= $max) ? $max : $total_tab;
// pre($total_tab);
// pre($maksimal);

?>
<div class="tabbable">
    <ul id="<?php echo $tab_id; ?>" class="nav nav-tabs">
        <?php
        for($i=0; $i<$maksimal; $i++):
            $tab = $tabs[$i];
            // pre($tab);
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
            $active = ($tab['id']==$selected_tab) ? 'active' : '';
        ?>
        <div class="tab-pane <?php echo $padding; ?> <?php echo $active; ?>" id="<?php echo $tab['id']; ?>">
            <?php echo $tab['content']; ?>
        </div>
        <?php
        endfor;
        ?>
    </div>
</div>
