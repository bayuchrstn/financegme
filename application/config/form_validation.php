<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
    // auth
    'login' => array(
            array('field' => 'username', 'label' => 'username', 'rules' => 'required'),
            array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
        ),
    'lost_password' => array(
            array('field' => 'akn', 'label' => 'akn', 'rules' => 'required'),
        ),
    'account_recovery' => array(
            array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
        ),
    'register' => array(
            array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            array('field' => 'username', 'label' => 'username', 'rules' => 'required'),
            array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
        ),

    //other
    'insert_setting' => array(
            array('field' => 'label', 'label' => 'label', 'rules' => 'required'),
            array('field' => 'setting', 'label' => 'setting', 'rules' => 'required'),
            array('field' => 'value', 'label' => 'value', 'rules' => 'required'),
            array('field' => 'category', 'value' => 'category', 'rules' => 'required'),
        ),

    //usergroup
    'usergroup_insert' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'usergroup_update' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'usergroup_privileges' => array(
            array('field' => 'fake_privileges', 'label' => 'fake_privileges', 'rules' => 'required'),
        ),
    'usergroup_modul_access' => array(
            array('field' => 'sender', 'label' => 'sender', 'rules' => 'required'),
        ),
    'usergroup_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //user
    'user_update' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'user_insert' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'user_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //customer
    'customer_insert' => array(
            array('field' => 'customer_name', 'label' => 'customer_name', 'rules' => 'required'),
            // array('field' => 'telephone', 'label' => 'telephone', 'rules' => 'required'),
            // array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            // array('field' => 'username', 'label' => 'username', 'rules' => 'required'),
            // array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
        ),
    'customer_update' => array(
            array('field' => 'customer_name', 'label' => 'customer_name', 'rules' => 'required'),
            // array('field' => 'telephone', 'label' => 'telephone', 'rules' => 'required'),
            // array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            // array('field' => 'username', 'label' => 'username', 'rules' => 'required'),
        ),
    'customer_marketing_progress' => array(
            array('field' => 'customer_name', 'label' => 'customer_name', 'rules' => 'required'),
            // array('field' => 'telephone', 'label' => 'telephone', 'rules' => 'required'),
            // array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            // array('field' => 'username', 'label' => 'username', 'rules' => 'required'),
        ),
    'customer_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),
    'customer_set_product' => array(
            array('field' => 'id_customer', 'label' => 'id_customer', 'rules' => 'required'),
        ),

    //product
    'product_insert' => array(
            array('field' => 'name', 'label' => 'product_name', 'rules' => 'required'),
        ),
    'product_update' => array(
            array('field' => 'name', 'label' => 'product_name', 'rules' => 'required'),
        ),
    'product_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

	//product category
    'product_category_insert' => array(
            array('field' => 'name', 'label' => 'product_name', 'rules' => 'required'),
        ),
    'product_category_update' => array(
            array('field' => 'name', 'label' => 'product_name', 'rules' => 'required'),
        ),
    'product_category_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //master
    'master_insert' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'master_update' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'master_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //my_profile
    'update_profile' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),

    //email Notifications update
    'email_notification_update' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
            array('field' => 'body_fake', 'label' => 'body_fake', 'rules' => 'required'),
        ),

	//form editor
    'form_editor_clone' => array(
            array('field' => 'form_name', 'label' => 'form_name', 'rules' => 'required'),
        ),

    //supplier
    'supplier_insert' => array(
            array('field' => 'supplier_name', 'label' => 'supplier_name', 'rules' => 'required'),
        ),
    'supplier_update' => array(
            array('field' => 'supplier_name', 'label' => 'supplier_name', 'rules' => 'required'),
        ),
    'supplier_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

	//request
    'request_insert' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
            array('field' => 'body_fake', 'label' => 'body_fake', 'rules' => 'required'),
        ),
    'request_update' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
            array('field' => 'body_fake', 'label' => 'body_fake', 'rules' => 'required'),
        ),



    //regional
    'regional_insert' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'regional_update' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),
    'regional_delete' => array(
        array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
    ),

    //bts
    'bts_insert' => array(
            array('field' => 'bts_name', 'label' => 'bts_name', 'rules' => 'required'),
        ),
    'bts_update' => array(
            array('field' => 'bts_name', 'label' => 'bts_name', 'rules' => 'required'),
        ),
    'bts_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //brand
    'brand_insert' => array(
            array('field' => 'brand_name', 'label' => 'brand_name', 'rules' => 'required'),
            array('field' => 'brand_code', 'label' => 'brand_code', 'rules' => 'required'),
        ),
    'brand_update' => array(
            array('field' => 'brand_name', 'label' => 'brand_name', 'rules' => 'required'),
        ),
    'brand_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //category
    'category_insert' => array(
            array('field' => 'category_name', 'label' => 'category_name', 'rules' => 'required'),
            array('field' => 'category_code', 'label' => 'category_code', 'rules' => 'required'),
        ),
    'category_update' => array(
            array('field' => 'category_name', 'label' => 'category_name', 'rules' => 'required'),
        ),
    'category_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //item
    'item_insert' => array(
            array('field' => 'item_name', 'label' => 'item_name', 'rules' => 'required'),
            array('field' => 'item_code', 'label' => 'item_code', 'rules' => 'required'),
            array('field' => 'item_category', 'label' => 'item_category', 'rules' => 'required'),
        ),
    'item_update' => array(
            array('field' => 'item_name', 'label' => 'item_name', 'rules' => 'required'),
            array('field' => 'item_code', 'label' => 'item_code', 'rules' => 'required'),
            array('field' => 'item_category', 'label' => 'item_category', 'rules' => 'required'),
        ),
    'item_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //item_detail
    'item_detail_insert' => array(
            array('field' => 'item_no_item', 'label' => 'item_no_item', 'rules' => 'required'),
            array('field' => 'item_date_buy', 'label' => 'item_date_buy', 'rules' => 'required'),
        ),
    'item_detail_update' => array(
            array('field' => 'item_no_item_update', 'label' => 'item_no_item', 'rules' => 'required'),
            array('field' => 'item_date_buy_update', 'label' => 'item_date_buy', 'rules' => 'required'),
            // array('field' => 'item_mac_update', 'label' => 'Mac address', 'rules' => 'callback_mac_check_edit'),
        ),
    'item_detail_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

	//marketing_progress
    'marketing_progress_insert' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
            array('field' => 'category', 'label' => 'category', 'rules' => 'required'),
        ),
    'marketing_progress_update' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
        ),

	//Laporan Harian
    'laporan_harian_insert' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
        ),
    'Laporan_harian_update' => array(
            array('field' => 'subject', 'label' => 'subject', 'rules' => 'required'),
        ),



    'update_detail_karyawan' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),
    'item_detail_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),
    'update_karyawan_ext' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),
    'input_karyawan_ext' => array(
            array('field' => 'nama', 'label' => 'nama', 'rules' => 'required'),
        ),
    'input_karyawan' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
            array('field' => 'pendidikan', 'label' => 'pendidikan', 'rules' => 'required'),
            array('field' => 'agama', 'label' => 'agama', 'rules' => 'required'),
            array('field' => 'jenis_kelamin', 'label' => 'jenis_kelamin', 'rules' => 'required'),
            array('field' => 'tempat_lahir', 'label' => 'tempat_lahir', 'rules' => 'required'),
            array('field' => 'tanggal_lahir', 'label' => 'tanggal_lahir', 'rules' => 'required'),
            array('field' => 'alamat_asli', 'label' => 'alamat_asli', 'rules' => 'required'),
            array('field' => 'alamat_tinggal', 'label' => 'alamat_tinggal', 'rules' => 'required'),
            array('field' => 'status_pernikahan', 'label' => 'status_pernikahan', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
            array('field' => 'departemen', 'label' => 'departemen', 'rules' => 'required'),
            array('field' => 'jabatan', 'label' => 'jabatan', 'rules' => 'required'),
        ),

	'customer_update_global' => array(
            array('field' => 'sender', 'label' => 'sender', 'rules' => 'required'),
        ),
	'customer_update_product' => array(
            array('field' => 'sender', 'label' => 'sender', 'rules' => 'required'),
        ),
	'customer_update_teknis' => array(
            array('field' => 'sender', 'label' => 'sender', 'rules' => 'required'),
        ),

	'sender' => array(
            array('field' => 'sender', 'label' => 'sender', 'rules' => 'required'),
        ),
	'global_export' => array(
            array('field' => 'global_export', 'label' => 'global_export', 'rules' => 'required'),
        ),
	'setting_update' => array(
            array('field' => 'fake_setting', 'label' => 'fake_setting', 'rules' => 'required'),
        ),
	'email_update' => array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'required'),
        ),

    'insert_cuti' => array(
         array('field' => 'cuti_date_start', 'label' => 'cuti_date_start', 'rules' => 'required'),
    ),
    'cuti_update' => array(
         array('field' => 'cuti_date_start', 'label' => 'cuti_date_start', 'rules' => 'required'),
         array('field' => 'cuti_date_end', 'label' => 'cuti_date_end', 'rules' => 'required'),
    ),
    'cuti_update_status' => array(
         array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
         array('field' => 'status', 'label' => 'status', 'rules' => 'required'),
    ),

    'maps_insert' => array(
         array('field' => 'maps_lat', 'label' => 'maps_lat', 'rules' => 'required'),
         array('field' => 'maps_lng', 'label' => 'maps_lng', 'rules' => 'required'),
    ),
    'maps_update' => array(
         array('field' => 'maps_lat', 'label' => 'maps_lat', 'rules' => 'required'),
         array('field' => 'maps_lng', 'label' => 'maps_lng', 'rules' => 'required'),
    ),
    'maps_delete' => array(
         array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
    ),

    //overtime
    'overtime_insert' => array(
            array('field' => 'overtime_red', 'label' => 'overtime_red', 'rules' => 'required'),
        ),
    'overtime_update' => array(
            array('field' => 'overtime_red', 'label' => 'overtime_red', 'rules' => 'required'),
        ),
    'overtime_delete' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),
    'overtime_approve' => array(
            array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        ),

    //ipman
    'ipman_insert'  => array(
        array('field' => 'ip', 'label' => 'ip', 'rules' => 'required'),
        array('field' => 'netmask', 'label' => 'netmask', 'rules' => 'required'),
    ),

    //invoice items
    'invoice_item'  => array(
        array('field' => 'item_name', 'label' => 'item_name', 'rules' => 'required'),
        array('field' => 'qty', 'label' => 'qty', 'rules' => 'required'),
        array('field' => 'unit_price', 'label' => 'unit_price', 'rules' => 'required'),
    ),

    'generate_invoice'  => array(
        array('field' => 'bulan_generate', 'label' => 'bulan', 'rules' => 'required'),
        array('field' => 'tahun_generate', 'label' => 'tahun', 'rules' => 'required'),
    ),

    'comment'  => array(
        array('field' => 'comment', 'label' => 'comment', 'rules' => 'required'),
    ),

);
