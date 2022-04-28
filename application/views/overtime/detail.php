<?php 
	$arr = array();
	$arr['modal_icon'] = $this->theme->icon('overtime');
    $arr['modal_id'] = 'modal_overtime_detail';
    $arr['modal_title'] = $this->lang->line('overtime_detail');
    $arr['main_content'] = '<div class="table-responsive" id="overtime_data_detail"></div>';
    echo $this->ui->load_template('modal_default', $arr, TRUE);
 ?>

 <!-- <div class="row">
 	<div class="col-xs-12">
 		<div class="col-xs-4">
 			
 		</div>
 		<div class="col-xs-8">
 			
 		</div>
 	</div>
 </div> -->