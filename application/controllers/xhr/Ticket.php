<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('request/Model_ticket', 'ticket');
        $this->load->model('Model_request', 'request');
        $this->load->model('Model_location', 'location');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function insert()
	{
		if($this->form_validation->run('sender')):

			$arr = array();
			$arr['status'] = 'success';
			$params = array();

			$ticket_question = array();
			if ( $this->input->post('ticket_question')=='on' ) :
				for ($i = 0; $i < count($this->input->post('id_question')) ; $i++) {
					$ticket_question[$i] = array(
						'q'	=> $this->input->post('id_question')[$i],
						'a'	=> $this->input->post('question')[$i]
					);
				}
				$params['note'] = serialize($ticket_question);
			endif;

			$params['task_category'] = 'ticket';
			$params['category'] = $this->input->post('ticket_type');
			$insert_result = $this->request->insert($params);

			//attachment (optional)
			if($this->input->post('attachment')):
				$this->attachment->insert('task', $insert_result['last_id'], $this->input->post('attachment'));
			endif;

			// task_ext
			$param_ext = array();
			$param_ext['priority'] = $this->input->post('ticket_priority');
			$param_ext['code'] = $this->generate_ticket_code();
			$this->request->task_ext_partial($insert_result['last_id'], 'task_ticket', $param_ext);

			//log
			$this->request->set_timeline($insert_result['last_id'], 'create_ticket');

			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function view_update($box='', $ticket_id, $type='html')
	{
		$data = array();
		$data['ticket_id'] = $ticket_id;
		$data['detail_ticket'] = $this->ticket->detail($ticket_id);
		// $data['response_lists'] = $this->ticket->response_lists($ticket_id);
		$data['ticket_timeline'] = $this->request->get_timeline($ticket_id);
		$data['ticket_timeline_child'] = $this->ticket->get_ticket_child($ticket_id);
		// pre($data);
		if ($type=='json'):
			echo encodeJson($data);
		else :
			switch($box){

				//comment
				case 'reply':
					$this->load->view('request/ticket/view_update/reply', $data);
				break;

				//Timer
				case 'timer':
					$this->load->view('request/ticket/view_update/timer', $data);
				break;

				//Detail
				case 'detail':
					$this->load->view('request/ticket/view_update/detail', $data);
				break;

				//Detail
				case 'overdue':
					$this->load->view('request/ticket/view_update/overdue', $data);
				break;

				//Timeline
				case 'timeline':
					$this->load->view('request/ticket/view_update/timeline', $data);
				break;

				//jenis
				case 'jenis':
					$this->load->view('request/ticket/view_update/jenis', $data);
				break;

				//box utama
				default:
					$this->load->view('request/ticket/view_update/main', $data);
			}
		endif;

	}

	function update_part($what='')
	{
		$arr = array();
		switch ($what) {
			case 'status':
				$arr['post'] = $_POST;

				$data['status'] = $this->input->post('status');
				$this->db->where('id', $this->input->post('id_ticket'));
				$this->db->update('task', $data);

				$arr['status'] = 'success';
				$arr['msg'] = 'Status ticket berhasil diubah';
			break;

			case 'category':
				$arr['post'] = $_POST;

				$data['category'] = $this->input->post('category');
				$this->db->where('id', $this->input->post('id_ticket'));
				$this->db->update('task', $data);

				$arr['status'] = 'success';
				$arr['msg'] = 'Jenis ticket berhasil diubah';
			break;

			case 'priority':
				$arr['post'] = $_POST;

				$data['priority'] = $this->input->post('priority');
				$this->db->where('task_id', $this->input->post('id_ticket'));
				$this->db->update('task_ticket', $data);

				$arr['last'] = $this->db->last_query();
				$arr['status'] = 'success';
				$arr['msg'] = 'prioritas ticket berhasil diubah';
			break;

			default:
				$arr['post'] = $_POST;
				$arr['status'] = 'success';
				$arr['msg'] = 'Data berhasil disimpan';
			break;
		}
		// pre($arr);
		echo json_encode($arr);
	}

	function reply()
	{
		$arr = array();
		$id = $this->input->post('id');
		$detail = $this->ticket->detail($id);

		// $arr['post'] = $_POST;
		foreach ($detail as $key => $value) {
			$params[$key] = $value;
		}

		$location_name = $params['location_name'];
		$author_name = $params['author_name'];
		unset($params['location_name']);
		unset($params['author_name']);

		$params['id'] = null;
		$params['up'] = $id;
		$params['body'] = $this->input->post('reply_ticket');
		$params['date_created'] = date("Y-m-d H:i:s");
		$params['author'] = $this->input->post('sender') ? $this->input->post('sender') : my_id();
		$arr['post'] = $params;

		//insert new reply
		$insert_result = $this->request->insert($params);
		//attachment (optional)
		if($this->input->post('attachment')):
			$this->attachment->insert('task', $insert_result['last_id'], $this->input->post('attachment'));
		endif;

		// task_ext
		$this->db->where('task_id', $id);
		$task_ext = $this->db->get('task_ticket')->row_array();

		$param_ext = array();
		$param_ext['priority'] = $task_ext['priority'];
		$param_ext['email'] = $task_ext['email'];
		$this->request->task_ext_partial($insert_result['last_id'], 'task_ticket', $param_ext);

		//log
		$this->request->set_timeline($insert_result['last_id'], 'reply_ticket');

		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	function generate_ticket_code()
	{
		$regional = session_scope_regional();
		$date = date('Y-m');
		$where = array(
			'task_category'	=> 'ticket',
			'up'	=> '',
			'regional'	=> $regional,
		);

		// echo $date;
		$this->db->where($where)
			->like('date_created', $date, 'after');
		$query = $this->db->get('task');
		$result = $query->num_rows();

		//generate ticket kode dari regional, tahun bulan, urutan tiket pada bulan ini

		$ticket_number = $regional.date('Ym').sprintf("%04d", ($result) ) ;
		return $ticket_number;
	}

	function get_ticket_child($id)
	{
		$detail_ticket = $this->ticket->detail($id);
		$data = $this->ticket->get_ticket_child($detail_ticket['id']);
		echo encodeJson($data);
	}

	function sample_quest(){
		$arr = array(
			array(
				'question'	=> 190,
				'answer'	=> 'blabla'
			),
			array(
				'question'	=> 191,
				'answer'	=> 'ghghgh'
			),
		);

		echo json_encode( array('serialize' => serialize($arr) ) );
	}

}
