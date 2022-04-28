<?php
    // pre($arr_product);
    $arr = array();
    $arr['modal_icon'] = $this->theme->icon('customer');
    $arr['modal_id'] = 'modal_customer_product';
    $arr['form_id'] = 'form_customer_product';
    $arr['form_action'] = '';
    $arr['form_input_top'] = '<div id="alert_modal_product"></div>';
    $arr['modal_title'] = $this->lang->line('customer_product');
    $arr['modal_content_info'] = '<div id="customer_info_div"></div>';

    $checkboxs  = array();

    foreach($arr_product as $code=>$product):
        $checkboxs[]  = array(
            'name'  => 'code_product[]',
            'class'  => 'product_checkbox',
            'value'  => $code,
            'id'  => $code,
            'label'  => $product,
        );
    endforeach;

    $arr['modal_content'] = $this->ui->load_template('checkbox',
        array(
            'checkboxs'         => $checkboxs
        )
    );

    $arr['modal_content_ext'] = array(
            $this->ui->load_template('hidden',
                array(
                    'id'            => 'id_customer_product',
                    'name'          => 'id_customer',
                    'value'         => '',
                )
            ),
        );

    echo $this->ui->load_template('modal_default_scroller_info', $arr, TRUE);
?>
