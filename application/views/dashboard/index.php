<div class="row" id="widget_container">
	<?php
	// pre($widget_lists);
	if(!empty($widget_lists)):
		foreach($widget_lists as $widget):
			// pre($widget);
			$widget_code = $widget['code'];
			$widget_detail = $this->dashboard->widget_detail($widget_code);

			switch ($widget['component']) {
				case 'panel_pill':
					$options['component'] = 'component/panel/panel_pill';
					$options['panel_icon'] = $widget_detail['icon'];
					$options['panel_title'] = $widget_detail['name'];
					$options['panel_action'] = array();
					$options['panel_padding'] = $widget_detail['padding'];
					$options['max'] = $widget_detail['max_tab'];
					$options['selected_tab'] = $widget_detail['selected_tab'];
					$options['tabs'] = unserialthis($widget_detail['tabs']);
					$options['panel_content'] = '<div id=""></div>';
				break;

				case 'panel_custom_action':
					$options['component'] = 'component/panel/panel_custom_action';
					$options['panel_icon'] = $widget_detail['icon'];
					$options['panel_title'] = $widget_detail['name'];
					$options['panel_action'] = $this->load->view('dashboard/panel_custom_action/statistik_pekerjaan', '', TRUE);
					$options['panel_padding'] = $widget_detail['padding'];
					$options['panel_content'] = '<div id="'.$widget['code'].'"></div>';
				break;

				default:
					$options['component'] = 'component/panel/panel_default';
					$options['panel_icon'] = $widget_detail['icon'];
					$options['panel_title'] = $widget_detail['name'];
					$options['panel_action'] = array();
					$options['panel_padding'] = $widget_detail['padding'];
					$options['panel_content'] = '<div id="'.$widget['code'].'"></div>';
				break;
			}

	?>
			<div class="widget_item <?php echo $widget['column_width']; ?>" >
				<?php echo $this->ui->load_component($options); ?>
			</div>
	<?php

		if (is_file(APPPATH.'views/dashboard/ext/'.$widget_code.'.php')):
			// $this->load->view($my_view);
			echo $this->load->view('dashboard/ext/'.$widget_code, '', TRUE);
		endif;

		endforeach;
	endif;
	?>
</div>
