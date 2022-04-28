<?php
class Model_task_teknis extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function task_category_info($code)
	{
		return $this->master->master_by_code('jenis_pekerjaan_teknis', $code);
	}

	function get_panel_tabs()
	{
		$arr = array();
		$arr[] = array(
			'name'=>'Request',
			'code'=>'request',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => $this->lang->line('task_request_datepost')),
				array('label'   => $this->lang->line('task_request_from')),
		        array('label'   => $this->lang->line('task_request_subject')),
		        array('label'   => $this->lang->line('task_request_date_request')),
		        array('label'   => $this->lang->line('task_request_location')),
		        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Dijadwalkan',
			'code'=>'dijadwalkan',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => $this->lang->line('task_dijadwalkan_creator')),
				array('label'   => $this->lang->line('task_dijadwalkan_subject')),
		        array('label'   => $this->lang->line('task_dijadwalkan_date')),
		        array('label'   => $this->lang->line('task_dijadwalkan_location')),
		        array('label'   => $this->lang->line('task_dijadwalkan_executor')),
		        array('label'   => $this->lang->line('task_dijadwalkan_type')),
		        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Selesai',
			'code'=>'selesai',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => $this->lang->line('task_selesai_subject')),
				array('label'   => $this->lang->line('task_selesai_location')),
		        array('label'   => $this->lang->line('task_selesai_type')),
		        array('label'   => $this->lang->line('task_selesai_date')),
		        array('label'   => $this->lang->line('task_selesai_date_report')),
		        array('label'   => $this->lang->line('task_selesai_reporter')),
		        array('label'   => $this->lang->line('task_selesai_status')),
		        array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		return $arr;
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
