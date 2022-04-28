<?php
defined('BASEPATH') or exit('No direct script access allowed');


// $route['default_controller'] = 'auth/index';
$route['default_controller'] = 'finance_dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']                              = "auth/index";
$route['register']                              = "auth/register";
$route['lost_password']                      = "auth/lost_password";
$route['reset_account/(:any)']                  = "auth/reset_account/$1";
$route['new_account_activation/(:any)']      = "auth/new_account_activation/$1";
$route['logout']                              = "auth/logout";


// ----------------------------------------------------------------------------------------------
// require_once( BASEPATH .'database/DB.php');
// $dbs =& DB();
//
// $dbs->where('note', 'req');
// $request = $dbs->get('modul')->result_array();
//
// if(!empty($request)):
// 	foreach($request as $req):
// 		$route[$req['url']] 			     			= "request/emulator/".$req['code'];
// 		$route[$req['url'].'/r'] 						= "request/r/".$req['code'];
// 		$route[$req['url'].'/(:any)'] 		 			= "request/emulator/".$req['code']."/$1";
// 		$route[$req['url'].'/update/(:any)'] 			= "request/update/$1/".$req['code'];
//
// 		$route[$req['url'].'/show/(:any)/(:any)'] 		= "request/show/$1/".$req['code']."/$2";
// 		$route[$req['url'].'/widget/(:any)'] 			= "request/widget/".$req['code']."/$1";
// 	endforeach;
// endif;

// echo '<pre>';
// print_r($route);
// echo '</pre>';
// ----------------------------------------------------------------------------------------------

$route['laporan_harian'] = "request/emulator/laporan_harian";
$route['laporan_harian/r'] = "request/r/laporan_harian";
$route['laporan_harian/(:any)'] = "request/emulator/laporan_harian/$1";
$route['laporan_harian/update/(:any)'] = "request/update/$1/laporan_harian";
$route['laporan_harian/show/(:any)/(:any)'] = "request/show/$1/laporan_harian/$2";
$route['laporan_harian/widget/(:any)'] = "request/widget/laporan_harian/$1";

$route['pekerjaan_teknis'] = "request/emulator/task_teknis";
$route['pekerjaan_teknis/r'] = "request/r/task_teknis";
$route['pekerjaan_teknis/(:any)'] = "request/emulator/task_teknis/$1";
$route['pekerjaan_teknis/update/(:any)'] = "request/update/$1/task_teknis";
$route['pekerjaan_teknis/show/(:any)/(:any)'] = "request/show/$1/task_teknis/$2";
$route['pekerjaan_teknis/widget/(:any)'] = "request/widget/task_teknis/$1";

$route['permintaan_barang_keluar'] = "request/emulator/request_out";
$route['permintaan_barang_keluar/r'] = "request/r/request_out";
$route['permintaan_barang_keluar/(:any)'] = "request/emulator/request_out/$1";
$route['permintaan_barang_keluar/update/(:any)'] = "request/update/$1/request_out";
$route['permintaan_barang_keluar/show/(:any)/(:any)'] = "request/show/$1/request_out/$2";
$route['permintaan_barang_keluar/widget/(:any)'] = "request/widget/request_out/$1";

$route['permintaan_barang_masuk'] = "request/emulator/request_in";
$route['permintaan_barang_masuk/r'] = "request/r/request_in";
$route['permintaan_barang_masuk/(:any)'] = "request/emulator/request_in/$1";
$route['permintaan_barang_masuk/update/(:any)'] = "request/update/$1/request_in";
$route['permintaan_barang_masuk/show/(:any)/(:any)'] = "request/show/$1/request_in/$2";
$route['permintaan_barang_masuk/widget/(:any)'] = "request/widget/request_in/$1";

$route['approval_barang_keluar'] = "request/emulator/barang_keluar";
$route['approval_barang_keluar/r'] = "request/r/barang_keluar";
$route['approval_barang_keluar/(:any)'] = "request/emulator/barang_keluar/$1";
$route['approval_barang_keluar/update/(:any)'] = "request/update/$1/barang_keluar";
$route['approval_barang_keluar/show/(:any)/(:any)'] = "request/show/$1/barang_keluar/$2";
$route['approval_barang_keluar/widget/(:any)'] = "request/widget/barang_keluar/$1";

$route['pengajuan_barang'] = "request/emulator/pengajuan_barang";
$route['pengajuan_barang/r'] = "request/r/pengajuan_barang";
$route['pengajuan_barang/(:any)'] = "request/emulator/pengajuan_barang/$1";
$route['pengajuan_barang/update/(:any)'] = "request/update/$1/pengajuan_barang";
$route['pengajuan_barang/show/(:any)/(:any)'] = "request/show/$1/pengajuan_barang/$2";
$route['pengajuan_barang/widget/(:any)'] = "request/widget/pengajuan_barang/$1";

$route['marketing_progress'] = "request/emulator/marketing_progress";
$route['marketing_progress/r'] = "request/r/marketing_progress";
$route['marketing_progress/(:any)'] = "request/emulator/marketing_progress/$1";
$route['marketing_progress/update/(:any)'] = "request/update/$1/marketing_progress";
$route['marketing_progress/show/(:any)/(:any)'] = "request/show/$1/marketing_progress/$2";
$route['marketing_progress/widget/(:any)'] = "request/widget/marketing_progress/$1";

$route['marketing_request'] = "request/emulator/marketing_request";
$route['marketing_request/r'] = "request/r/marketing_request";
$route['marketing_request/(:any)'] = "request/emulator/marketing_request/$1";
$route['marketing_request/update/(:any)'] = "request/update/$1/marketing_request";
$route['marketing_request/show/(:any)/(:any)'] = "request/show/$1/marketing_request/$2";
$route['marketing_request/widget/(:any)'] = "request/widget/marketing_request/$1";

$route['view_marketing_request'] = "request/emulator/view_marketing_request";
$route['view_marketing_request/r'] = "request/r/view_marketing_request";
$route['view_marketing_request/(:any)'] = "request/emulator/view_marketing_request/$1";
$route['view_marketing_request/update/(:any)'] = "request/update/$1/view_marketing_request";
$route['view_marketing_request/show/(:any)/(:any)'] = "request/show/$1/view_marketing_request/$2";
$route['view_marketing_request/widget/(:any)'] = "request/widget/view_marketing_request/$1";

$route['pre_customer_approval'] = "request/emulator/approval_pre_customer_install";
$route['pre_customer_approval/r'] = "request/r/approval_pre_customer_install";
$route['pre_customer_approval/(:any)'] = "request/emulator/approval_pre_customer_install/$1";
$route['pre_customer_approval/update/(:any)'] = "request/update/$1/approval_pre_customer_install";
$route['pre_customer_approval/show/(:any)/(:any)'] = "request/show/$1/approval_pre_customer_install/$2";
$route['pre_customer_approval/widget/(:any)'] = "request/widget/approval_pre_customer_install/$1";

$route['pekerjaan_saya'] = "request/emulator/my_task";
$route['pekerjaan_saya/r'] = "request/r/my_task";
$route['pekerjaan_saya/(:any)'] = "request/emulator/my_task/$1";
$route['pekerjaan_saya/update/(:any)'] = "request/update/$1/my_task";
$route['pekerjaan_saya/show/(:any)/(:any)'] = "request/show/$1/my_task/$2";
$route['pekerjaan_saya/widget/(:any)'] = "request/widget/my_task/$1";

$route['permintaan_barang_replace'] = "request/emulator/request_replace";
$route['permintaan_barang_replace/r'] = "request/r/request_replace";
$route['permintaan_barang_replace/(:any)'] = "request/emulator/request_replace/$1";
$route['permintaan_barang_replace/update/(:any)'] = "request/update/$1/request_replace";
$route['permintaan_barang_replace/show/(:any)/(:any)'] = "request/show/$1/request_replace/$2";
$route['permintaan_barang_replace/widget/(:any)'] = "request/widget/request_replace/$1";

$route['boq'] = "request/emulator/boq";
$route['boq/r'] = "request/r/boq";
$route['boq/(:any)'] = "request/emulator/boq/$1";
$route['boq/update/(:any)'] = "request/update/$1/boq";
$route['boq/show/(:any)/(:any)'] = "request/show/$1/boq/$2";
$route['boq/widget/(:any)'] = "request/widget/boq/$1";

$route['admin_sales'] = "request/emulator/admin_sales";
$route['admin_sales/r'] = "request/r/admin_sales";
$route['admin_sales/(:any)'] = "request/emulator/admin_sales/$1";
$route['admin_sales/update/(:any)'] = "request/update/$1/admin_sales";
$route['admin_sales/show/(:any)/(:any)'] = "request/show/$1/admin_sales/$2";
$route['admin_sales/widget/(:any)'] = "request/widget/admin_sales/$1";

$route['approval_barang_masuk'] = "request/emulator/barang_masuk";
$route['approval_barang_masuk/r'] = "request/r/barang_masuk";
$route['approval_barang_masuk/(:any)'] = "request/emulator/barang_masuk/$1";
$route['approval_barang_masuk/update/(:any)'] = "request/update/$1/barang_masuk";
$route['approval_barang_masuk/show/(:any)/(:any)'] = "request/show/$1/barang_masuk/$2";
$route['approval_barang_masuk/widget/(:any)'] = "request/widget/barang_masuk/$1";

$route['view_boq'] = "request/emulator/view_boq";
$route['view_boq/r'] = "request/r/view_boq";
$route['view_boq/(:any)'] = "request/emulator/view_boq/$1";
$route['view_boq/update/(:any)'] = "request/update/$1/view_boq";
$route['view_boq/show/(:any)/(:any)'] = "request/show/$1/view_boq/$2";
$route['view_boq/widget/(:any)'] = "request/widget/view_boq/$1";

$route['po_approval'] = "request/emulator/approval_po";
$route['po_approval/r'] = "request/r/approval_po";
$route['po_approval/(:any)'] = "request/emulator/approval_po/$1";
$route['po_approval/update/(:any)'] = "request/update/$1/approval_po";
$route['po_approval/show/(:any)/(:any)'] = "request/show/$1/approval_po/$2";
$route['po_approval/widget/(:any)'] = "request/widget/approval_po/$1";

$route['customer_call'] = "request/emulator/customer_call";
$route['customer_call/r'] = "request/r/customer_call";
$route['customer_call/(:any)'] = "request/emulator/customer_call/$1";
$route['customer_call/update/(:any)'] = "request/update/$1/customer_call";
$route['customer_call/show/(:any)/(:any)'] = "request/show/$1/customer_call/$2";
$route['customer_call/widget/(:any)'] = "request/widget/customer_call/$1";

$route['customer_visit'] = "request/emulator/customer_visit";
$route['customer_visit/r'] = "request/r/customer_visit";
$route['customer_visit/(:any)'] = "request/emulator/customer_visit/$1";
$route['customer_visit/update/(:any)'] = "request/update/$1/customer_visit";
$route['customer_visit/show/(:any)/(:any)'] = "request/show/$1/customer_visit/$2";
$route['customer_visit/widget/(:any)'] = "request/widget/customer_visit/$1";

$route['po_request'] = "request/emulator/po_request";
$route['po_request/r'] = "request/r/po_request";
$route['po_request/(:any)'] = "request/emulator/po_request/$1";
$route['po_request/update/(:any)'] = "request/update/$1/po_request";
$route['po_request/show/(:any)/(:any)'] = "request/show/$1/po_request/$2";
$route['po_request/widget/(:any)'] = "request/widget/po_request/$1";

$route['wh_boq_moderation'] = "request/emulator/wh_boq_moderation";
$route['wh_boq_moderation/r'] = "request/r/wh_boq_moderation";
$route['wh_boq_moderation/(:any)'] = "request/emulator/wh_boq_moderation/$1";
$route['wh_boq_moderation/update/(:any)'] = "request/update/$1/wh_boq_moderation";
$route['wh_boq_moderation/show/(:any)/(:any)'] = "request/show/$1/wh_boq_moderation/$2";
$route['wh_boq_moderation/widget/(:any)'] = "request/widget/wh_boq_moderation/$1";

$route['boq_approval'] = "request/emulator/approval_boq";
$route['boq_approval/r'] = "request/r/approval_boq";
$route['boq_approval/(:any)'] = "request/emulator/approval_boq/$1";
$route['boq_approval/update/(:any)'] = "request/update/$1/approval_boq";
$route['boq_approval/show/(:any)/(:any)'] = "request/show/$1/approval_boq/$2";
$route['boq_approval/widget/(:any)'] = "request/widget/approval_boq/$1";

$route['ticket'] = "request/emulator/ticket";
$route['ticket/r'] = "request/r/ticket";
$route['ticket/(:any)'] = "request/emulator/ticket/$1";
$route['ticket/update/(:any)'] = "request/update/$1/ticket";
$route['ticket/show/(:any)/(:any)'] = "request/show/$1/ticket/$2";
$route['ticket/widget/(:any)'] = "request/widget/ticket/$1";

$route['approval_barang_replace'] = "request/emulator/barang_replace";
$route['approval_barang_replace/r'] = "request/r/barang_replace";
$route['approval_barang_replace/(:any)'] = "request/emulator/barang_replace/$1";
$route['approval_barang_replace/update/(:any)'] = "request/update/$1/barang_replace";
$route['approval_barang_replace/show/(:any)/(:any)'] = "request/show/$1/barang_replace/$2";
$route['approval_barang_replace/widget/(:any)'] = "request/widget/barang_replace/$1";

$route['mutasi'] = "request/emulator/mutasi";
$route['mutasi/r'] = "request/r/mutasi";
$route['mutasi/(:any)'] = "request/emulator/mutasi/$1";
$route['mutasi/update/(:any)'] = "request/update/$1/mutasi";
$route['mutasi/show/(:any)/(:any)'] = "request/show/$1/mutasi/$2";
$route['mutasi/widget/(:any)'] = "request/widget/mutasi/$1";

$route['trial_report'] = "request/emulator/trial_report";
$route['trial_report/r'] = "request/r/trial_report";
$route['trial_report/(:any)'] = "request/emulator/trial_report/$1";
$route['trial_report/update/(:any)'] = "request/update/$1/trial_report";
$route['trial_report/show/(:any)/(:any)'] = "request/show/$1/trial_report/$2";
$route['trial_report/widget/(:any)'] = "request/widget/trial_report/$1";

$route['ticket_helpdesk'] = "request/emulator/ticket_helpdesk";
$route['ticket_helpdesk/r'] = "request/r/ticket_helpdesk";
$route['ticket_helpdesk/(:any)'] = "request/emulator/ticket_helpdesk/$1";
$route['ticket_helpdesk/update/(:any)'] = "request/update/$1/ticket_helpdesk";
$route['ticket_helpdesk/show/(:any)/(:any)'] = "request/show/$1/ticket_helpdesk/$2";
$route['ticket_helpdesk/widget/(:any)'] = "request/widget/ticket_helpdesk/$1";

$route['approval_survey'] = "request/emulator/approval_survey";
$route['approval_survey/r'] = "request/r/approval_survey";
$route['approval_survey/(:any)'] = "request/emulator/approval_survey/$1";
$route['approval_survey/update/(:any)'] = "request/update/$1/approval_survey";
$route['approval_survey/show/(:any)/(:any)'] = "request/show/$1/approval_survey/$2";
