<?php
	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $this->theme->icon('product_category');
	$options['panel_title'] = $this->lang->line('product_category_alltitle');
	$options['panel_action'] = array(
		'<a onclick="insert_product_category();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').'</a>',
		);
	$options['table_id'] = 'js_table_product_category';
	$data = array();
	$options['panel_heading_ext'] = '';
	$options['table_column'] = array(
	        array('label'   => '#', 'width'=>'5'),
            array('label'   => $this->lang->line('kits_name')),
            array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);
	echo $insert_view;
	echo $update_view;
	echo $delete_view;
?>
