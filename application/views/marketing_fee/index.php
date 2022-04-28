<?php
	$options['component'] = 'component/panel/panel_default';
	$options['panel_icon'] = '';
	$options['panel_title'] = 'Marketing Fee';
    $options['panel_content'] = '<div id="content_marketing_fee"><p style="text-align: center;">Loading...</p></div>';
	$options['panel_action'] = array(
        '<a onclick="search_mf();" href="javascript:void(0)"><i class="icon-search4"></i> Detail MF</a>',
    );
	echo $this->ui->load_component($options);

    echo $search_view;
?>