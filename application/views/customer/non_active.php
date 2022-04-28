<?php
	// pre($modul);
	if($this->uri->segment(2)=='r'):
		$panel_action = array();
	else:
		$panel_action = array(
	            '<a onclick="insert_customer();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('customer_input').'</a>',
	            '<a onclick="search_customer();" href="javascript:void(0)"><i class="icon-search4"></i> '.$this->lang->line('all_asearch').'</a>',
	        );
	endif;

	$options['component'] = 'component/panel/panel_table';
	$options['panel_icon'] = $modul['icon'];
	$options['panel_title'] = $modul['name'];
	$options['panel_action'] = $panel_action;
	$options['table_id'] = 'js_table_pre_customer';
	$options['table_column'] = array(
		array('label'   => "#", 'width'=>'10'),
		array('label'   => 'Nama Pelanggan'),
		array('label'   => 'Customer ID'),
		array('label'   => 'Alamat'),
		array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        );
	echo $this->ui->load_component($options);

?>
