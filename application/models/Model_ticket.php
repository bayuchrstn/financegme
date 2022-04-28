<?php
class Model_ticket extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function count()
	{
        $this->db->group_by('tickets.id');


		// $this->db->where('ticket_departement.departement_code', 'marketing');
		// $this->db->where('master.category', 'priority');
		// $this->db->where("(status.category = 'ticket_status')" ) ;

		$this->db->select('tickets.*');
		// $this->db->select('master.name as mpriority');
		$this->db->select('customer.customer_name as service_id');
		$this->db->select('status.name as mstatus');
		$this->db->select('priority.name as mpriority');

        $this->db->join('master as priority', 'tickets.priority = priority.code', 'left');
        $this->db->join('master as status', 'tickets.status = status.code', 'left');
		$this->db->join('customer', 'tickets.clientid = customer.id', 'left');
		$this->db->join('ticket_departement', 'ticket_departement.ticket_id = tickets.id', 'left');

		$query = $this->db->get('tickets');
        return $query->num_rows();
	}

    function generate_due_date($from='')
    {
        if($this->input->post('custom_due_date') !=''):
            return $this->input->post('custom_due_date');
        else:
            $satuan = $this->input->post('satuan_due_date');
            $due_date = $this->input->post('due_date');
            if($from !=''):
                switch ($satuan) {
                    case 'menit':
                        $ret = date('Y-m-d H:i:s',strtotime('+'.$due_date.' minutes',strtotime($from)));
                    break;

                    case 'jam':
                        $ret = date('Y-m-d H:i:s',strtotime('+'.$due_date.' hour',strtotime($from)));
                    break;

                    case 'hari':
                        $ret = date('Y-m-d H:i:s',strtotime('+'.$due_date.' day',strtotime($from)));
                    break;

                    default:
                        $ret = now();
                    break;
                }
            else:
                switch ($satuan) {
                    case 'menit':
                        $ret = date('Y-m-d H:i:s', mktime(date("H"), date("i") + $due_date, date("s"), date("m"), date("d"), date("Y")));
                    break;

                    case 'jam':
                        $ret = date('Y-m-d H:i:s', mktime(date("H") + $due_date, date("i"), date("s"), date("m"), date("d"), date("Y")));
                    break;

                    case 'hari':
                        $ret = date('Y-m-d H:i:s', mktime(date("H"), date("i"), date("s"), date("m"), date("d") + $due_date, date("Y")));
                    break;

                    default:
                        $ret = now();
                    break;
                }
            endif;
            return $ret;
        endif;
    }

    function filter_info_reset($filter='')
    {
        // pre($filter);
        // get_all_setting();
        if($filter !=''):
            $split_filter = un_filter_serialthis($filter);
            // pre($split_filter);
            switch($split_filter['param']){
                case 'status':
                    $master = $this->arr_master('ticket_status', $split_filter['value']);
                    $fix = 'Status : '.$master;
                break;

                case 'priority':
                    $master = $this->arr_master('priority', $split_filter['value']);
                    $fix = 'Priority : '.$master;
                break;

                case 'departement':
                    $master = $this->arr_master('departement', $split_filter['value']);
                    $fix = 'Divisi : '.$master;
                break;

                default:
                    switch($split_filter['value']){
                        case 'today' : $info = 'Hari ini';  break;
                        case 'yesterday' : $info = 'Kemarin';  break;
                        case 'this_month' : $info = 'Bulan Ini';  break;
                        case 'this_year' : $info = 'Tahun Ini';  break;
                        default : $info = '';
                    }
                    $fix = $info;
            }

            $html = '<ul class="nav navbar-nav navbar-right">';
    			$html .= '<li><p class="navbar-text"><span class="label label-danger">'.$fix.'</span></p></li>';
    			$html .= '<li><a class="" href="'.base_url().'ticket">Reset Filter</a></li>';
    		$html .= '</ul>';

            $info_filter = $html;
        else:
            $info_filter = '';
        endif;
        return $info_filter;

    }

	function data($filter='')
	{
        $this->db->group_by('tickets.id');

        // $this->db->order_by('tickets.priority', 'desc');
		// $this->db->order_by('tickets.date', 'desc');

        if($filter !=''):
            $filter = un_filter_serialthis($filter);
        else:
            $filter = array();
        endif;
        // pre($this->all_session);

        switch($this->all_session['view_scope']):
            case 'restrict':
                $this->db->where('tickets.agent', my_id());
            break;

            case 'group':
                $group = "({PRE}tickets.departement='".$this->all_session['departement']."' OR {PRE}tickets.agent='".my_id()."' )";
                $this->db->where($group);
            break;

            default:

        endswitch;

        if(!empty($filter)):
            switch($filter['param']):

                case 'date' :
                    if($filter['value']=='today'):
                        $where_filter = "(DAY(gticket_tickets.date) = '".date('d')."' AND MONTH(gticket_tickets.date) = '".date('m')."' AND YEAR(gticket_tickets.date) = '".date('Y')."' )";
                    elseif($filter['value']=='yesterday'):
                        $kemarin = date("m-d-Y", mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));
                        $split_kemarin = explode('-', $kemarin);
                        // pre($split_kemarin);
                        $where_filter = "(DAY(gticket_tickets.date) = '".$split_kemarin[1]."' AND MONTH(gticket_tickets.date) = '".$split_kemarin[0]."' AND YEAR(gticket_tickets.date) = '".$split_kemarin[2]."' )";
                    elseif($filter['value']=='this_month'):
                        $where_filter = "(MONTH(gticket_tickets.date) = '".date('m')."' AND YEAR(gticket_tickets.date) = '".date('Y')."' )";
                    elseif($filter['value']=='this_year'):
                        $where_filter = "(YEAR(gticket_tickets.date) = '".date('Y')."' )";
                    endif;

                break;

                case 'status' :
                    $where_filter = "tickets.status = '".$filter['value']."' ";
                break;

                case 'priority' :
                    $where_filter = "tickets.priority = '".$filter['value']."' ";
                break;

                default:
                    $where_filter = '';
                break;
            endswitch;
        else:
            $where_filter = '';
        endif;

        if($where_filter !=''):
            $this->db->where($where_filter);
        endif;


		// $this->db->where('ticket_departement.departement_code', 'marketing');
		// $this->db->where('master.category', 'priority');
		// $this->db->where("(status.category = 'ticket_status')" ) ;

		$this->db->select('tickets.*');
		// $this->db->select('master.name as mpriority');
		$this->db->select('customer.name as customer_name');
		$this->db->select('status.name as mstatus');
		$this->db->select('priority.name as mpriority');
		$this->db->select('departement.name as mdepartement');
		$this->db->select('agent.name as agent_name');

        $this->db->join('master as priority', 'tickets.priority = priority.code', 'left');
        $this->db->join('master as status', 'tickets.status = status.code', 'left');
        $this->db->join('master as departement', 'tickets.departement = departement.code', 'left');
        $this->db->join('users as agent', 'tickets.agent = agent.id', 'left');
		$this->db->join('customer', 'tickets.customer_id = customer.id', 'left');
		// $this->db->join('ticket_departement', 'ticket_departement.ticket_id = tickets.id', 'left');

		$query = $this->db->get('tickets');

        // pre($this->db->last_query());
        return $query->result_array();
	}

	function detail_ticket($id)
	{
		$this->db->where('tickets.id', $id);
		$this->db->select('tickets.*');
		$this->db->select('master.name as priority_name');
		$this->db->select('customer.name as customer_name');
		$this->db->select('status.name as status_name');
		$this->db->select('user_handle.name as agent_name');
		$this->db->select('product.name as product_name');
		$this->db->select('departement.name as departement_name');

        $this->db->join('master', 'tickets.priority = master.code', 'left');
		$this->db->join('master as status', 'tickets.status = status.code', 'left');
		$this->db->join('master as departement', 'tickets.departement = departement.code and departement.category=\'departement\' ', 'left');
		$this->db->join('customer', 'tickets.customer_id = customer.id', 'left');
        $this->db->join('users as user_handle', 'tickets.agent = user_handle.id', 'left');
        $this->db->join('product', 'tickets.product_id = product.code', 'left');

        $query = $this->db->get('tickets');

        $res = $query->row_array();

        $author = $this->author_name($res['author_type'], $res['author']);

        $res['author_name'] = $author['name'];
        // pre($this->db->last_query());
        // pre($res);
        return $res;
	}

	function view_ticket($ticket_number)
	{
		$this->db->where('tickets.number', $ticket_number);
		$this->db->where('master.category', 'priority');
		$this->db->where("(departement.category = 'departement')");
		$this->db->where("(status.category = 'ticket_status')" ) ;
		$this->db->select('tickets.*');
		$this->db->select('master.name as mpriority');
		$this->db->select('departement.name as mdepartement');
		$this->db->select('customer.name as customer');
		$this->db->select('status.name as mstatus');
		$this->db->join('master', 'tickets.priority = master.code', 'left');
		$this->db->join('master as departement', 'tickets.departement = departement.code', 'left');
		$this->db->join('master as status', 'tickets.status = status.code', 'left');
		$this->db->join('customer', 'tickets.clientid = customer.id', 'left');
		$query = $this->db->get('tickets');
		return $query->row_array();
	}

    function response_lists($ticket_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('ticketid', $ticket_id);
        return $this->db->get('response')->result_array();
    }

    function response_by_id($response_id)
    {
        $this->db->where('id', $response_id);
        $dt =  $this->db->get('response')->row_array();
        $opt = array();
        if(!empty($dt)):
            foreach($dt as $row=>$val):
                $opt[$row] = $val;
            endforeach;
            $pembuat = $this->respon_name($dt['replier'], $dt['replierid']);
            $opt['author'] = $pembuat['name'];
            // pre($dt['replier']);
        endif;

        return $opt;

    }

    function respon_name($type, $id)
    {
        $table = ($type=='users') ? 'users' : 'customer';

        if($type=='users'):
            $this->db->where('id', $id);
            $this->db->select($table.'.name as name');
            return $this->db->get($table)->row_array();
        elseif($type=='email'):
            $this->db->where('uid', $id);
            $this->db->select('email_connector.from as name');
            return $this->db->get('email_connector')->row_array();
        else:
            $this->db->where('id', $id);
            $this->db->select($table.'.name as name');
            return $this->db->get($table)->row_array();
        endif;

    }

    function author_name($type, $id)
    {
        $table = ($type=='users') ? 'users' : 'customer';
        $this->db->where('id', $id);

        if($type=='users'):
            $this->db->select($table.'.name as name');
        else:
            $this->db->select($table.'.name as name');
        endif;

        return $this->db->get($table)->row_array();
    }

    function ticket_current_departement($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        return $this->db->get('ticket_departement')->result_array();
    }

    function create_number()
    {
        $nomor = $this->db->query("SELECT MAX(number) as terbesar FROM gticket_tickets")->row_array();
        $terbesar = ($nomor['terbesar'] !='') ? (int) $nomor['terbesar'] : '0';
        $next = $terbesar + 1;
        $next = subzero($next, 3);
        return $next;
    }

    function update_ct($what, $id)
    {
        $table = ($what=='t') ? 'tickets' : 'response';
        // pre($table);
        $this->db->where('id', $id);
        return $this->db->get($table)->row_array();
    }

    function my_ticket($type, $id)
    {
        // pre($type);
        // pre(my_id());

        $this->db->where('id', $id);
        $this->db->select('id, author, author_type');
        $current = $this->db->get('tickets')->row_array();

        if($current['author_type']==$type && $current['author']==my_id()):
            return TRUE;
        else:
            return FALSE;
        endif;

    }

    function my_response($type, $id)
    {
        // pre($type);
        // pre(my_id());

        $this->db->where('id', $id);
        $this->db->select('id, replierid, replier');
        $current = $this->db->get('response')->row_array();

        if($current['replier']==$type && $current['replierid']==my_id()):
            return TRUE;
        else:
            return FALSE;
        endif;

    }

    function filter_data_date()
    {
        $arr = array();
        $arr['today'] = 'Today';
        $arr['yesterday'] = 'Yesterday';
        $arr['this_month'] = 'This Month';
        $arr['this_year'] = 'This Year';
        return $arr;
    }

    function filter_data_ticket_meta($category)
    {
        $arr = array();
        $this->db->order_by('order', 'asc');
        $this->db->where('category', $category);
        $master = $this->db->get('master')->result_array();
        if(!empty($master)):
            foreach($master as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function set_ticket_timeline($id_ticket, $code_action, $user_type='users', $url='', $note='')
    {
        $data = array(
            'id_ticket'         => $id_ticket,
            'date'              => now(),
            'id_user'           => my_id(),
            'user_type'         => $user_type,
            'code_action'       => $code_action,
            'url'               => $url,
            'note'              => $note,
        );
        $this->db->insert('ticket_timeline', $data);
    }

    function ticket_timeline($ticket_id)
    {
        $this->db->order_by('id', 'asc');
        $this->db->where('ticket_timeline.id_ticket', $ticket_id);
        $this->db->select('ticket_timeline.*');
        $this->db->select('ticket_action.action_ui_label');
        $this->db->select('ticket_action.timeline_label');
        $this->db->select('ticket_action.icon');
        $this->db->select('ticket_action.flag_show_list');
        $this->db->join('ticket_action', 'ticket_action.code=ticket_timeline.code_action', 'left');
        $data = $this->db->get('ticket_timeline')->result_array();

        $arr = array();
        if(!empty($data)):
            foreach($data as $row=>$val):
                $subject = $this->timeline_subject_name($val['user_type'], $val['id_user']);
                $val['yang_membuat'] = $subject['name'];
                $arr[] = $val;
            endforeach;
        endif;
        return $arr;
    }

    function timeline_subject_name($table, $id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get($table)->row_array();
        return $data;
    }

    function overdue($status, $due_date, $closing_date)
    {
        $now = time();
        $due_date = strtotime($due_date);
        $closing_date = strtotime($closing_date);

        if($status=='closed'){
            if($closing_date > $due_date){
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if($now > $due_date){
                return TRUE;
            } else {
                return FALSE;
            }
        }


        // if( ($status !='closed' && ($now > $due)) || ($status=='closed' && ($closing_date > $due_date) ) ):
        //     return TRUE;
        // else:
        //     return FALSE;
        // endif;
    }

    function show_attachment($serialize_attachment)
    {
        $arr = unserialthis($serialize_attachment);
        return $arr;
    }

    function arr_master($category, $code)
    {
        $this->db->where('category', $category);
        $this->db->where('code', $code);
        $master = $this->db->get('master')->row_array();
        return $master['name'];
    }

    function assigned_to_me($ticket_id)
    {
        $current = $this->db->query("SELECT * FROM {PRE}tickets WHERE id='".$ticket_id."' ")->row_array();
        if($current['agent']==my_id()):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    function check_agent($ticket)
    {
        if($this->all_session['view_scope']=='restrict' && $ticket['agent'] != my_id()):
            redirect(base_url().'ticket'); exit;
		endif;

        if($this->all_session['view_scope']=='group'):
            if( ($ticket['departement'] != $this->all_session['departement']) && ($ticket['agent'] != my_id()) ):
                redirect(base_url().'ticket'); exit;
            endif;
        endif;
    }

    function sync($ticket)
    {
        $out = '1';
        if($this->all_session['view_scope']=='restrict' && $ticket['agent'] != my_id()):
            $out = '0';
        else:
            $out = '1';
		endif;

        if($this->all_session['view_scope']=='group'):
            if( ($ticket['departement'] != $this->all_session['departement']) && ($ticket['agent'] != my_id()) ):
                $out = '0';
            else:
                $out = '1';
            endif;
        endif;
        return $out;
    }

    
}
