<?php
    $data = array();
    $data['prefix'] = 'update';

    $options = array();
    $options['component'] = 'component/tab/tab_default';
    $options['tab_id'] = 'tab_show';
    $options['tab_padding'] = 'no';
    $options['max'] = '8';
    $options['selected_tab'] = 'data_pelanggan';
    $options['tabs'] = array();

    $options['tabs'][] = array(
            'label'         => 'Data Pelanggan',
            'id'            => 'data_pelanggan',
            'content'       => '<div id="data_pelanggan_content"></div>',
        );

    // $options['tabs'][] = array(
    //         'label'         => 'Product',
    //         'id'            => 'edit_product',
    //         'content'       => '<div id="div_edit_product"></div>',
    //     );

    $tabs = $this->ui->load_component($options);
    echo $tabs;
?>
