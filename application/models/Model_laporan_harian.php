<?php
class Model_laporan_harian extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	//membuat json untuk jquery datatables
	function build_json($task)
	{
		// pre($task);
		$formated_data = array();
		if(!empty($task['data'])):
			foreach($task['data'] as $row):
				// pre($row);

				//location_id
				$location = $this->task->location($row['location'], $row['location_id']);
				// pre($location);

				//focus marketing progress
				$subject = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				//action form
				$button['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_laporan_harian(\''.$row['id'].'\');" class="edit_button" ');
				$button['detail'] = array('label'=>$this->lang->line('all_detail'), 'url'=>'javascript:void(0);', 'icon'=>'icon-enter', 'more'=>'onclick="detail_laporan_harian(\''.$row['id'].'\');" class="edit_button" ');
				$action = $this->actionform->dropdown($button);

				$formated_data[] = array(
					'id'									=> '1',
					'date'									=> format_date($row['date_created']),
					'date_start'							=> format_date($row['date_start']),
					'date_due'								=> format_date($row['date_due']),
					'subject'								=> $subject,
					'author'								=> clean_string($row['author_name'], 40),
					'location'								=> clean_string($location, 40),
					'action'								=> $action,
				);
			endforeach;
		endif;
		// pre($formated_data); exit;

		$response = array(
			"draw" 				=> $task['draw'],
			"recordsTotal" 		=> $task['recordsTotal'],
			"recordsFiltered" 	=> $task['recordsFiltered'],
			"data" 				=> $formated_data
		);
		// pre($response);
		echo json_encode($response);
	}

}
