<?php
class Model_email extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
        $this->load->model('model_request', 'request');
    }

    function sendto($code='', $regional='', $area='')
    {
        // pre($code);
        // pre($regional);

        $regional = ($regional=='') ? session_scope_regional() : $regional;
        $area = $area=='' ? session_scope_area() : $area;
        $this->db->where('code', $code);
        $this->db->where('area', $area);
        $this->db->where('regional', $regional);
        $data = $this->db->get('email')->row_array();
        // pre($this->db->last_query());
        return (empty($data)) ? '' : $data['receiver'];
    }

    function request_model_loader($req_code)
	{
		// pre($req_code);
		$this->load->model('request/model_'.$req_code, $req_code);
	}

    //rec_code =  nama model
    // $ext opsional jika ada perlu parameter tambahan
    function task_content($task_id, $req_code='', $ext=array())
    {
        // pre($task_id);
        // pre($req_code);
        $arr = array();
        $data = array();
		$this->request_model_loader($req_code);
		$detail = $this->$req_code->detail($task_id);
        // pre($detail);

        switch ($req_code) {

            case 'marketing_request':
                //jika ada tambahan "detail"
                $detail['info_precustomer'] = 'hasekkk';

                //subject
                $arr['subject'] = 'Request pre survey';

                //nama file view
                $view = $req_code;
            break;

            //laporan teknis Pelanggan
            case 'task_report':
                switch($ext['task_category']){
                    case 'pre_survey':
                        $arr['subject'] = 'laporan pre survey';
                    break;

                    case 'survey':
                        $arr['subject'] = 'laporan survey';
                    break;

                    case 'installasi_new':
                        $arr['subject'] = 'laporan installasi baru';
                    break;

                    case 'installasi':
                        $arr['subject'] = 'laporan Installasi';
                    break;

                    case 'dismantle':
                        $arr['subject'] = 'laporan dismantle';
                    break;

                    case 'replace':
                        $arr['subject'] = 'laporan replace';
                    break;

                    default:
                        $arr['subject'] = 'laporan pekerjaan teknis';
                    break;
                }
                $view = $req_code;
            break;

            default:
                $arr['subject'] = 'Default Subject';
                $view = $req_code;
            break;
        }

        $data['detail'] = $detail;
        $arr['body'] = $this->load->view('task_email/'.$view, $data, TRUE);
        return $arr;
    }


}
