<?php
    $data = array();
    $data['prefix'] = 'update';

    $options = array();
    $options['component'] = 'component/tab/tab_default';
    $options['tab_id'] = 'tab1';
    $options['tab_padding'] = 'no';
    $options['max'] = '8';
    $options['selected_tab'] = 'data_pelanggan';
    $options['tabs'] = array();

    $options['tabs'][] = array(
            'label'         => 'Data Pelanggan',
            'id'            => 'data_pelanggan',
            'content'       => '<div id="div_edit_global"></div>',
        );

    if(have_access('update_cs_product')):
        $options['tabs'][] = array(
                'label'         => 'Product',
                'id'            => 'edit_product',
                'content'       => '<div id="div_edit_product"></div>',
            );
    endif;

    if(have_access('update_cs_invoice_marketing')):
        $options['tabs'][] = array(
                'label'         => 'Marketing &amp; Invoice',
                'id'            => 'edit_invoice',
                'content'       => '<div id="div_edit_invoice_marketing"></div>',
            );
    endif;

    // if(have_access('update_cs_dokumen')):
    // 	$options['tabs'][] = array(
    // 			'label'         => 'Dokumen',
    // 			'id'            => 'edit_dokumen',
    // 			'content'       => '<div id="div_edit_dokumen"></div>',
    // 		);
    // endif;
    $tabs = $this->ui->load_component($options);
    echo $tabs;
?>
