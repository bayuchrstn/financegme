<?php
class Model_report_item extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function marketing_progresss()
    {
        $arr = array();

        //tabs
        $arr['tabs'] = array();
        $arr['tabs']['selected'] = array(
    			'name'=>'Belum dikirim',
    			'code'=>'belum_dikirim',
    			'table_columns' => array(
    				array('label'   => '#', 'width'=>'5'),
            		array('label'   => 'Tanggal Request'),
    				array('label'   => 'Dari'),
    				array('label'   => 'Lokasi'),
            		array('label'   => 'Judul'),
    				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    			)
    		);
        $arr['tabs'][] = array(
    			'name'=>'Sudah dikirim',
    			'code'=>'sudah_dikirim',
    			'table_columns' => array(
    				array('label'   => '#', 'width'=>'5'),
            		array('label'   => 'Tanggal Request'),
    				array('label'   => 'Dari'),
    				array('label'   => 'Lokasi'),
            		array('label'   => 'Judul'),
    				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    			)
    		);
        //set_ui
        $arr['set_ui'] = array();
        $arr['set_ui']['main_action'] = array();
        $arr['set_ui']['table_column'] = array();
        return $arr;
    }

    function marketing_progress($mode='', $params = array())
    {

        $arr = array();
        //tabs

        switch ($mode) {
            case 'tabs':
                $arr = array();
            break;

            case 'set_ui':

                $arr['main_action'] = array(
                        '<a onclick="export_data(\''.base_url().'export/task/marketing_progress\');" href="javascript:void(0)"><i class="icon-plus3"></i> Export Data</a>',
                    );
                $arr['table_column'] = array(
        				array('label'   => '#', 'width'=>'5'),
        				array('label'   => 'Tanggal'),
        				array('label'   => 'Marketing'),
        				array('label'   => 'Customer'),
        				array('label'   => 'Judul'),
        				// array('label'   => 'Status'),
        				// array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        			);
            break;

            case 'datatable':
                // pre($params['data']);
                $data = $params['data'];
                $arr = array();

                if(!empty($data)):
        			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
        			foreach($data as $row):
        				$urut++;
                        // pre($row);
        				$subject = '<a onclick="show_this(\''.base_url().'marketing_progress/show/'.$row['id'].'/echo\');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';
        				$lokasi = $this->location->show($row['location'], $row['location_id']);

                    	// $dt_action['action_button'] = array();
        				// $dt_action['action_button'][] = '<a onclick="update_marketing_progress(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
        				// $action = $this->load->view('component/action_button/default', $dt_action, TRUE);

                        $arr[] = array(
                                'id'            => $urut,
                                'tanggal'		=> $row['date_start'],
                                'marketing'		=> $row['author_name'],
                                'customer'		=> $lokasi,
                                'judul'			=> $subject,
                                // 'status'		=> 'fvdfbdfbdfbdfbdf',
                            );
        			endforeach;
        		endif;
                // pre($formated_data);



            break;

            case 'js_table':
                $jstable  = array();
                $jstable[] = array(
                        'data'							         => 'id',
                        'searchable'						     => false,
                        'orderable'								 => false,
                    );
                $jstable[] = array(
                        'data'							       => 'tanggal',
                        'searchable'						     => false,
                        'orderable'								 => false,
                    );
                $jstable[] = array(
                        'data'							     => 'marketing',
                        'searchable'						     => false,
                        'orderable'								 => false,
                    );
                $jstable[] = array(
                        'data'							     => 'customer',
                        'searchable'						     => false,
                        'orderable'								 => false,
                    );
                $jstable[] = array(
                        'data'							     => 'judul',
                        'searchable'						     => false,
                        'orderable'								 => false,
                    );
                // $jstable[] = array(
                //         'data'							     => 'status',
                //         'searchable'						     => false,
                //         'orderable'								 => false,
                //     );
                $arr = json_encode($jstable);
            break;

            default:
                # code...
                break;
        }


        return $arr;
    }

}
