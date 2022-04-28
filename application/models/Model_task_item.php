<?php
class Model_task_item extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function is_lock($task_id='')
    {
        $lock = FALSE;
        $this->db->where('id', $task_id);
        $task = $this->db->get('task')->row_array();
        if($task['flock']=='y'):
            $lock = TRUE;
        endif;

        return $lock;
    }

    function hook()
    {
        $arr = array();
        $arr['post'] = $_POST;
        return $arr;
    }

    function get_data($table, $task_id, $parent_modul)
    {
        switch ($parent_modul) {

            case 'ts_laporan_barang_keluar':
                $this->load->model('Model_permintaan_barang', 'permintaan_barang');
                return $this->permintaan_barang->laporan_barang_dipasang($task_id);
            break;

            case 'ts_laporan_barang_keluar_replace':
                $this->load->model('Model_permintaan_barang', 'permintaan_barang');
                return $this->permintaan_barang->laporan_barang_dipasang_replace($task_id);
            break;

            case 'ts_laporan_barang_kembali':
                $this->load->model('Model_permintaan_barang', 'permintaan_barang');
                return $this->permintaan_barang->laporan_barang_dikembalikan($task_id);
            break;

            case 'ts_laporan_barang_kembali_replace':
                $this->load->model('Model_permintaan_barang', 'permintaan_barang');
                return $this->permintaan_barang->laporan_barang_dikembalikan_replace($task_id);
            break;

            case 'item_replace_out':
            case 'item_out':
                // $this->db->where('task_id', $task_id);
                $data = $this->db->query("SELECT *, count(id) as jumlah FROM {PRE}task_item_out WHERE task_id='".$task_id."' GROUP BY item_id")->result_array();
                return $data;
            break;

            case 'cp':
                $this->db->where('customer_id', $task_id);
                $data = $this->db->get($table)->result_array();
                return $data;
            break;

            // case 'ts_boq':
            //     $this->db->select($table.'.* ,
            //     item.item_name AS item_name,
            //     brand.item_categories AS brand_name,
            //     cat.item_categories AS category_name')
            //     ->join('item', 'item.id = '.$table.'.item_id', 'left')
            //     ->join('item_categories brand','brand.id=item.brand', 'left')
            //     ->join('item_categories cat','cat.id=item.category_id', 'left');
            //     $this->db->where('task_id', $task_id);
            //     $data = $this->db->get($table)->result_array();
            //     return $data;
            //     break;

            default:
                $this->db->where('task_id', $task_id);
                $data = $this->db->get($table)->result_array();
                // pre($this->db->last_query());
                return $data;
            break;
        }

    }

    function current_data_filter($row)
    {
        $supplier = $row['supplier'];
        $supplier = $this->supplier->detail($supplier);


        $item_id = $row['item_id'];
        if($row['mode']=='custom'):
            $iname = $item_id;
        else:
            $bcn = $this->bcn->item_info($item_id);
            $iname = $bcn;
        endif;

        $int_qty = (int) $row['qty'];
        $int_price = (int) $row['price'];
        $subtotal = $int_qty * $int_price;

        // action
        if($row['flock']=='0'):
            $action = '<ul class="icons-list">';
            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete(\''.base_url().'xhr/task_item/delete/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
            $action .= '</ul>';
        else:
            $action = '<ul class="icons-list">';
            $action .= '<li><a href="javascript:void(0);"  ><i class="icon-lock2 text-info"></i></a></li>';
            $action .= '</ul>';
        endif;
    }

    function get_current($table, $task_id, $prefix, $target_div, $parent_modul)
    {
        $arr = array();
        // pre($table);
        // pre($task_id);
        $data = $this->get_data($table, $task_id, $parent_modul);
        // pre($this->db->last_query());

        $task_detail = $this->request->detail($task_id);

        if(!empty($data)):
            switch ($parent_modul) {

                case 'cp':
                    $urut = 1;
                    foreach($data as $row):
                        // pre($row);

                        // action
                        $action = '<ul class="icons-list">';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-link"></i></a></li>';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete(\''.base_url().'xhr/task_item/delete/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                        $action .= '</ul>';


                        $arr[] = array(
                                'urut'                  => $urut,
                                'nama'                  => $row['name'],
                                'telephone_home'        => $row['telephone_home'],
                                'telephone_mobile'      => $row['telephone_mobile'],
                                'telephone_office'      => $row['telephone_office'],
                                'fax'                   => $row['fax'],
                                'email'                 => $row['email'],
                                'action'                => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                case 'ts_laporan_barang_keluar_replace':
                case 'ts_laporan_barang_keluar':
                    $urut = 1;
                    foreach($data as $row):
                        // pre($row);
                        $item_info = $this->bcn->item_info($row['item_id']);
                        $nomac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');

                        // action
                        $action = '<ul class="icons-list">';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                        $action .= '</ul>';


                        $arr[] = array(
                                'urut'              => $urut,
                                'nama_barang'       => $item_info,
                                'nomac'             => $nomac,
                                'action'            => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                case 'ts_laporan_barang_kembali_replace':
                case 'ts_laporan_barang_kembali':
                    $urut = 1;
                    foreach($data as $row):
                        // pre($row);
                        $nomor_mac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
                        $item_id = $this->bcn->item_detail_info($row['item_detail_id'], 'item_id');
                        $bcn = $this->bcn->item_info($item_id);
                        $kondisi = $this->master->master_name_by_code('kondisi_barang_kembali', $row['codition']);

                        // action
                        $action = '<ul class="icons-list">';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                        $action .= '</ul>';

                        $arr[] = array(
                                'urut'              => $urut,
                                'bcn'               => $bcn,
                                'nomor_mac'         => $nomor_mac,
                                'kondisi'           => $kondisi,
                                // 'action'            => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                case 'item_replace_out':
                case 'item_out':
                    $urut = 1;
                    foreach($data as $row):
                        // pre($row);
                        $item_info = $this->bcn->item_info($row['item_id']);
        				$status_kepemilikan = $row['owner_status'];

                        // action
                        if($task_detail['flock']=='y'):
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);"  ><i class="icon-lock2 text-info"></i></a></li>';
                            $action .= '</ul>';
                        else:

                            if($row['flock']=='n'):
                                $action = '<ul class="icons-list">';
                                $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['item_id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                                $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete(\''.base_url().'xhr/task_item/delete/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['item_id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                                $action .= '</ul>';
                            else:
                                $action = '<ul class="icons-list">';
                                $action .= '<li><a href="javascript:void(0);"  ><i class="icon-lock2 text-info"></i></a></li>';
                                $action .= '</ul>';
                            endif;
                        endif;


                        $arr[] = array(
                                'urut'              => $urut,
                                'nama_barang'       => $item_info,
                                'jumlah'            => $row['jumlah'],
                                'owner_status'      => $row['owner_status'],
                                'action'            => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                case 'item_replace_in':
                case 'item_in':
                    $urut = 1;
                    foreach($data as $row):
                        // pre($row);

                        $nomor_mac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');
                        $item_id = $this->bcn->item_detail_info($row['item_detail_id'], 'item_id');
                        $bcn = $this->bcn->item_info($item_id);
                        $kondisi = $this->master->master_name_by_code('kondisi_barang_kembali', $row['codition']);

                        // action
                        if($row['flock']=='n'):
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete(\''.base_url().'xhr/task_item/delete/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'/'.$row['transaction_id'].'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';
                        else:
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);"  ><i class="icon-lock2 text-info"></i></a></li>';
                            $action .= '</ul>';
                        endif;

                        $arr[] = array(
                                'urut'              => $urut,
                                'bcn'               => $bcn,
                                'nomor_mac'         => $nomor_mac,
                                'kondisi'           => $kondisi,
                                'action'            => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                case 'po_pembanding':
                case 'po':
                    $urut = 1;
                    foreach($data as $row):

                        $supplier = $row['supplier'];
                        $supplier = $this->supplier->detail($supplier);


                        $item_id = $row['item_id'];
                        if($row['mode']=='custom'):
                            $iname = $item_id;
                        else:
                            $bcn = $this->bcn->item_info($item_id);
                            $iname = $bcn;
                        endif;

                        $int_qty = (int) $row['qty'];
                        $int_price = (int) $row['price'];
                        $subtotal = $int_qty * $int_price;

                        // action
                        if($row['flock']=='n'):
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete(\''.base_url().'xhr/task_item/delete/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';
                        else:
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);"  ><i class="icon-lock2 text-info"></i></a></li>';
                            $action .= '</ul>';
                        endif;

                        $arr[] = array(
                                'urut'      => $urut,
                                'name'      => $iname,
                                'supplier'  => $supplier['supplier_name'],
                                'price'     => currency($int_price),
                                'qty'       => $row['qty'],
                                'action'    => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                // request po--------------------------------------------------------------------------
                default:
                    $urut = 1;
                    foreach($data as $row):

        				$supplier = $row['supplier'];
        				$supplier = $this->supplier->detail($supplier);


                        $item_id = $row['item_id'];
        				if($row['mode']=='custom'):
        					$iname = $item_id;
        				else:
        					$bcn = $this->bcn->item_info($item_id);
        					$iname = $bcn;
        				endif;

        				$int_qty = (int) $row['qty'];
        				$int_price = (int) $row['price'];
        				$subtotal = $int_qty * $int_price;

                        // action
                        if($row['flock']=='n'):
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update(\''.base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete(\''.base_url().'xhr/task_item/delete/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['id'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';
                        else:
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);"  ><i class="icon-lock2 text-info"></i></a></li>';
                            $action .= '</ul>';
                        endif;

                        $arr[] = array(
                                'urut'      => $urut,
                                'name'      => $iname,
                                'qty'       => $row['qty'],
                                'action'    => $action,
                            );
                        $urut++;
                    endforeach;
                break;
            }
        endif;

        return $arr;
    }

    function get_cart($table, $task_id, $prefix, $target_div, $parent_modul)
    {
        $data = $this->get_data($table, $task_id, $parent_modul);
        $arr = array();
        $cart = $this->cart->contents();
        if(!empty($cart)):
            switch ($parent_modul) {

                case 'item_replace_in':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):
                        if($row['options']['type']=='in'):
                            // pre($row);

                            $nomor_mac = $this->bcn->item_detail_info($row['id'], 'nomor_mac');
                            $item_id = $this->bcn->item_detail_info($row['id'], 'item_id');
                            $bcn = $this->bcn->item_info($item_id);

                            $kondisi = $this->master->master_name_by_code('kondisi_barang_kembali', $row['options']['condition']);

                            // action
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';


                            $arr[] = array(
                                    'urut'          => $urut,
                                    'name'          => $bcn,
                                    'nomor_mac'     => $nomor_mac,
                                    'kondisi'       => $kondisi,
                                    'action'        => $action,
                                );
                            $urut++;
                        endif;
                    endforeach;
                break;

                case 'item_in':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):
                            // pre($row);

                            $nomor_mac = $this->bcn->item_detail_info($row['id'], 'nomor_mac');
            				$item_id = $this->bcn->item_detail_info($row['id'], 'item_id');
            				$bcn = $this->bcn->item_info($item_id);

                            $kondisi = $this->master->master_name_by_code('kondisi_barang_kembali', $row['options']['condition']);

                            // action
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';


                            $arr[] = array(
                                    'urut'          => $urut,
                                    'name'          => $bcn,
                                    'nomor_mac'     => $nomor_mac,
                                    'kondisi'       => $kondisi,
                                    'action'        => $action,
                                );
                            $urut++;
                        // endif;
                    endforeach;
                break;

                case 'item_replace_out':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):
                        if($row['options']['type']=='out'):
                            // pre($row);
                            $item_info = $this->bcn->item_info($row['id']);
                            $status_kepemilikan = $this->status_kepemilikan($row['options']['status_kepemilikan']);

                            // action
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';


                            $arr[] = array(
                                    'urut'          => $urut,
                                    'name'          => $item_info,
                                    'qty'           => paranoid($row['qty']),
                                    'status'        => $status_kepemilikan,
                                    'action'        => $action,
                                );
                            $urut++;
                        endif;
                    endforeach;
                break;

                case 'item_out':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):
                            // pre($row);
                            $item_info = $this->bcn->item_info($row['id']);
            				$status_kepemilikan = $this->status_kepemilikan($row['options']['status_kepemilikan']);

                            // action
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';


                            $arr[] = array(
                                    'urut'          => $urut,
                                    'name'          => $item_info,
                                    'qty'           => paranoid($row['qty']),
                                    'status'        => $status_kepemilikan,
                                    'action'        => $action,
                                );
                            $urut++;
                        // endif;
                    endforeach;
                break;

                case 'po':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):
                        if($row['options']['type']=='recomended'):
                            $item_id = $row['name'];
                            if($row['options']['mode']=='custom'):
                                $iname = $item_id;
                            else:
                                $bcn = $this->bcn->item_info($item_id);
                                $iname = $bcn;
                            endif;

                            // action
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';

                            $supplier = $this->supplier->detail($row['options']['supplier']);

                            $arr[] = array(
                                    'urut'      => $urut,
                                    'name'      => $iname,
                                    'supplier'  => $supplier['supplier_name'],
                                    'price'     => currency($row['price']),
                                    'qty'       => $row['qty'],
                                    'action'    => $action,
                                );
                            $urut++;
                        endif;
                    endforeach;
                break;

                case 'po_pembanding':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):
                        if($row['options']['type']=='pembanding'):
                            $item_id = $row['name'];
                            if($row['options']['mode']=='custom'):
                                $iname = $item_id;
                            else:
                                $bcn = $this->bcn->item_info($item_id);
                                $iname = $bcn;
                            endif;

                            // action
                            $action = '<ul class="icons-list">';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                            $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                            $action .= '</ul>';

                            $supplier = $this->supplier->detail($row['options']['supplier']);

                            $arr[] = array(
                                    'urut'      => $urut,
                                    'name'      => $iname,
                                    'supplier'  => $supplier['supplier_name'],
                                    'price'     => currency($row['price']),
                                    'qty'       => $row['qty'],
                                    'action'    => $action,
                                );
                            $urut++;
                        endif;
                    endforeach;
                break;

                case 'cp':
                $jumlah_current = count($data);
                // pre($jumlah_current);
                $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                foreach($cart as $row):

                    // pre($row);


                    // action
                    $action = '<ul class="icons-list">';
                    $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                    $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                    $action .= '</ul>';


                    $arr[] = array(
                            'urut'                  => $urut,
                            'name'                  => $row['options']['name'],
                            'telephone_home'        => $row['options']['telephone_home'],
                            'handphone'             => $row['options']['telephone_mobile'],
                            'telephone_office'      => $row['options']['telephone_office'],
                            'fax'                   => $row['options']['fax'],
                            'email'                 => $row['options']['email'],
                            'action'                => $action,
                        );
                    $urut++;
                endforeach;
                break;

                //ts_boq
                case 'ts_boq':
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):

                        // pre($row);

                        $item_id = $row['name'];
                        if($row['options']['mode']=='custom'):
                            $iname = $item_id;
                        else:
                            $bcn = $this->bcn->item_info($item_id);
                            $iname = $bcn;
                        endif;

                        // action
                        $action = '<ul class="icons-list">';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                        $action .= '</ul>';


                        $arr[] = array(
                                'urut'      => $urut,
                                'name'      => $iname,
                                'qty'       => $row['qty'],
                                'note'      => $row['options']['note'],
                                'action'    => $action,
                            );
                        $urut++;
                    endforeach;
                break;

                // request po
                default:
                    $jumlah_current = count($data);
                    // pre($jumlah_current);
                    $urut = ($jumlah_current=='0') ? 1 : $jumlah_current+1;
                    foreach($cart as $row):

                        // pre($row);

                        $item_id = $row['name'];
        				if($row['options']['mode']=='custom'):
        					$iname = $item_id;
        				else:
        					$bcn = $this->bcn->item_info($item_id);
        					$iname = $bcn;
        				endif;

                        // action
                        $action = '<ul class="icons-list">';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_update_cart(\''.base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-pencil7 text-success"></i></a></li>';
                        $action .= '<li><a href="javascript:void(0);" onclick="task_item_delete_cart(\''.base_url().'xhr/task_item/delete_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$row['rowid'].'/'.$target_div.'/'.$parent_modul.'\');" ><i class="icon-trash text-danger"></i></a></li>';
                        $action .= '</ul>';


                        $arr[] = array(
                                'urut'      => $urut,
                                'name'      => $iname,
                                'qty'       => $row['qty'],
                                'action'    => $action,
                            );
                        $urut++;
                    endforeach;
                break;
            }
        endif;


        return $arr;
    }

    function properties($table='', $prefix='', $task_id='', $id='', $target_div='', $parent_modul='')
    {
        $arr = array();
        switch ($parent_modul) {
            case 'cp':
                $arr['modal_title'] = 'Input Kontak Person';
                $arr['modal_title_update'] = 'Update Kontak Person';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;

            case 'ts_laporan_barang_keluar':
                $arr['modal_title'] = 'Barang Batal Dipasang';
                $arr['modal_title_update'] = 'Barang Batal Dipasang';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;

            case 'item_replace_out':
            case 'item_out':
                $arr['modal_title'] = 'Input Barang Keluar';
                $arr['modal_title_update'] = 'Update Barang Keluar';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;

            case 'item_replace_in':
            case 'item_in':
                $arr['modal_title'] = 'Input Barang Kembali';
                $arr['modal_title_update'] = 'Update Barang Kembali';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;

            case 'po':
                $arr['modal_title'] = 'Input Item';
                $arr['modal_title_update'] = 'Update Item';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;

            case 'po_pembanding':
                $arr['modal_title'] = 'Input Pembanding';
                $arr['modal_title_update'] = 'Update Pembanding';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;

            // request po
            default:
                $arr['modal_title'] = 'Input Order PO';
                $arr['modal_title_update'] = 'Update Order PO';
                $arr['action_form'] = base_url().'xhr/task_item/insert/'.$table.'/'.$prefix.'/'.$task_id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update'] = base_url().'xhr/task_item/update/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
                $arr['action_form_update_cart'] = base_url().'xhr/task_item/update_cart/'.$table.'/'.$prefix.'/'.$task_id.'/'.$id.'/'.$target_div.'/'.$parent_modul;
            break;
        }
        return $arr;
    }

    function detail($table='', $prefix='', $task_id='', $id='', $parent_modul='')
    {
        switch ($parent_modul) {
            case 'item_replace_out':
            case 'item_out':
                $data = $this->db->query("SELECT *, COUNT(id) as jumlah FROM {PRE}task_item_out WHERE item_id='".$id."' AND task_id='".$task_id."' ")->row_array();
                $arr = array();
                $arr['qty'] = $data['jumlah'];
                $arr['owner_status'] = $data['owner_status'];
                $arr['note'] = $data['note'];
                $arr['item_id'] = $data['item_id'];
                return $arr;
            break;

            case 'ts_laporan_barang_keluar':
                $arr = array();
                $this->db->where('id', $id);
                $data = $this->db->get($table)->row_array();
                if(!empty($data)):
                    $nama_barang = $this->bcn->item_info($data['item_id'], 'default');
                    $nomor_barang = $this->bcn->item_detail_info($data['item_detail_id'], 'nomor_barang');
                    $mac_address = $this->bcn->item_detail_info($data['item_detail_id'], 'mac_address');
                    $arr['nama_barang'] = $nama_barang;
                    $arr['nomor_barang'] = $nomor_barang;
                    $arr['mac_address'] = $mac_address;

                    foreach($data as $row=>$val):
                        $arr[$row] = $val;

                    endforeach;
                endif;
                return $arr;
            break;

            default:
                $this->db->where('id', $id);
                $data = $this->db->get($table)->row_array();
                return $data;
            break;
        }

    }

    //header table
    function column_data($table, $parent_modul)
    {
        $arr = array();
        switch ($parent_modul) {

            case 'po':
            case 'po_pembanding':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Supplier',
                        'data' => 'supplier'
                    );
                $arr[] = array(
                        'label' => 'Harga',
                        'data' => 'harga',
                        'width' => '150',
                    );
                $arr[] = array(
                        'label' => 'Jumlah',
                        'data' => 'jumlah',
                        'width' => '100',
                    );
                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;

            case 'ts_laporan_barang_kembali':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama Barang',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Nomor Barang',
                        'data' => 'supplier'
                    );
                $arr[] = array(
                        'label' => 'Kondisi',
                        'data' => 'harga',
                        'width' => '150',
                    );
            break;

            case 'cp':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Telepon',
                        'data' => 'telepon'
                    );
                $arr[] = array(
                        'label' => 'Handphone',
                        'data' => 'handphone',
                    );
                $arr[] = array(
                        'label' => 'Telepon Kantor',
                        'data' => 'telepon_kantor',
                    );
                $arr[] = array(
                        'label' => 'Fax',
                        'data' => 'fax',
                    );
                $arr[] = array(
                        'label' => 'Email',
                        'data' => 'email',
                    );
                    $arr[] = array(
                            'label' => 'Action',
                            'data' => 'action',
                            'width' => '50'
                        );
            break;

            case 'item_replace_in':
            case 'item_in':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama Barang',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Nomor Barang',
                        'data' => 'supplier'
                    );
                $arr[] = array(
                        'label' => 'Kondisi',
                        'data' => 'harga',
                        'width' => '150',
                    );
                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;

            case 'ts_laporan_barang_keluar':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama Barang',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Nomor Barang / Mac Address',
                        'data' => 'item_id'
                    );

                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;

            case 'item_replace_out':
            case 'item_out':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama Barang',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Jumlah',
                        'data' => 'qty'
                    );
                $arr[] = array(
                        'label' => 'Status',
                        'data' => 'status',
                        'width' => '150',
                    );
                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;

            case 'item_out':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama Barang',
                        'data' => 'nama_barang'
                    );

                $arr[] = array(
                        'label' => 'Status',
                        'data' => 'status',
                        'width' => '150',
                    );
                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;

            case 'ts_boq':
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Jumlah',
                        'data' => 'supplier'
                    );
                $arr[] = array(
                        'label' => 'Keterangan',
                        'data' => 'note'
                    );
                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;

            // request po
            default:
                $arr[] = array(
                        'label' => '#',
                        'data' => 'urut',
                        'width' => '10'
                    );
                $arr[] = array(
                        'label' => 'Nama',
                        'data' => 'item_id'
                    );
                $arr[] = array(
                        'label' => 'Jumlah',
                        'data' => 'supplier'
                    );
                $arr[] = array(
                        'label' => 'Action',
                        'data' => 'action',
                        'width' => '50'
                    );
            break;
        }
        return $arr;
    }


    // data manipulation here------------------------------------------------------------------

    ////////////////////////////////////////////////////// cp //////////////////////////////////////////////
    function cp($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $data_cart = array(
                        'rowid'          => $this->input->post('id'),
                        'qty'     	     => '1',
                        'price'     	 => '1',
                    );
                $data_cart['options']['name'] = $this->input->post('name');
                $data_cart['options']['telephone_home'] = $this->input->post('telephone_home');
                $data_cart['options']['telephone_mobile'] = $this->input->post('telephone_mobile');
                $data_cart['options']['telephone_office'] = $this->input->post('telephone_office');
                $data_cart['options']['fax'] = $this->input->post('fax');
                $data_cart['options']['email'] = $this->input->post('email');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
                return $data_cart;
            break;

            //update
            case 'update':
                $data = array(
                        'name'                  => $this->input->post('name'),
                        'telephone_home'        => $this->input->post('telephone_home'),
                        'telephone_mobile'      => $this->input->post('telephone_mobile'),
                        'telephone_office'      => $this->input->post('telephone_office'),
                        'fax'                   => $this->input->post('fax'),
                        'email'                 => $this->input->post('email'),
                    );

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('contact_person', $data);
                return $this->db->last_query();
            break;

            // insert
            default:
                // $barang = $this->input->post('item_name');
                // $barang_custom = $this->input->post('item_id_custom');
                // $nama_cp = str_replace(' ', '_', $this->input->post('name'));
                $nama_cp = preg_replace('/[^\da-z]/i', '', $this->input->post('name'));
                $data_cart = array(
                		// 'id'      => $this->input->post('name'),
                    'id'      => $nama_cp,
                		'qty'     => '1',
                		'price'   => '1',
                		'name'    => $this->input->post('name'),
                	);
                $data_cart['options']['name'] = $this->input->post('name');
                $data_cart['options']['telephone_home'] = $this->input->post('telephone_home');
                $data_cart['options']['telephone_mobile'] = $this->input->post('telephone_mobile');
                $data_cart['options']['telephone_office'] = $this->input->post('telephone_office');
                $data_cart['options']['fax'] = $this->input->post('fax');
                $data_cart['options']['email'] = $this->input->post('email');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data_cart);
                $arr = $cart_result;
            break;
        }
        return $arr;
    }
    ////////////////////////////////////////////////////// end cp //////////////////////////////////////////////

    ////////////////////////////////////////////////////// po request//////////////////////////////////////////////
    function po_request($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $data_cart = array(
                        'rowid'      => $this->input->post('id'),
                        'qty'     	 => paranoid($this->input->post('qty')),
                    );
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $data = array(
                        'qty'	      => $this->input->post('qty')
                    );
                $this->db->where('id', $this->input->post('id'));
                $this->db->update($this->input->post('table'), $data);
            break;

            // insert
            default:
                $barang = $this->input->post('item_name');
                $barang_custom = $this->input->post('item_id_custom');
                $data_cart = array(
                		'id'      => ($this->input->post('item_selector')=='barang') ? $barang : strtolower(url_title($barang_custom)),
                		'qty'     => paranoid($this->input->post('qty')),
                		'price'   => '0',
                		'name'    => ($this->input->post('item_selector')=='barang') ? $barang : $barang_custom,
                	);
                if($this->input->post('options')):
                	foreach($this->input->post('options') as $key=>$val):
                		$data_cart['options'][$key] = $val;
                	endforeach;
                endif;

                $data_cart['options']['supplier'] = '';
                $data_cart['options']['mode'] = $this->input->post('item_selector');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data_cart);

            break;
        }
        return $arr;
    }
    ////////////////////////////////////////////////////// end po request//////////////////////////////////////////////


    ////////////////////////////////////////////////////// item_in//////////////////////////////////////////////
    function item_in($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $arr['dpos'] = $_POST;
                $data_cart = array(
                        'rowid'      => $this->input->post('rowid'),
                    );
                $data_cart['options']['condition'] = $this->input->post('condition');
    			$data_cart['options']['note'] = $this->input->post('note');
    			$data_cart['options']['task_parent'] = $this->input->post('task_parent');
    			$data_cart['options']['item'] = $this->input->post('item');
    			$data_cart['options']['transaction_id'] = $this->input->post('transaction_id');

                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $data = array(
                        'codition'	         => $this->input->post('condition'),
                        'note'	             => $this->input->post('note'),
                    );
                $this->db->where('id', $this->input->post('id_item'));
                $this->db->update($this->input->post('table'), $data);
                $arr['dpost'] = $_POST;
            break;

            // insert
            default:
                $pitem_detail = $this->input->post('item_detail');
                $split = explode('|', $pitem_detail);

                // ----------------------CART-------------------------------
                $data = array(
                    'id'      => $split[0],
                    'qty'     => '1',
                    'price'   => '0',
                    'name'    => $split[0],
                );

                if($this->input->post('options')):
                    foreach($this->input->post('options') as $key=>$val):
                        $data['options'][$key] = $val;
                    endforeach;
                    $data['options']['condition'] = $this->input->post('condition');
                    $data['options']['note'] = $this->input->post('note');
                    $data['options']['item'] = $this->input->post('item');
                    $data['options']['transaction_id'] =$split[1];
                endif;
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data);
                // $arr['dpos'] = $_POST;

            break;
        }
        return $arr;
    }
    ////////////////////////////////////////////////////// end item_in//////////////////////////////////////////////

    ////////////////////////////////////////////////////// item_in//////////////////////////////////////////////
    function ts_boq($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $data_cart = array(
                        'rowid'      => $this->input->post('id'),
                        'qty'     	 => paranoid($this->input->post('qty')),
                    );
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $data = array(
                        'qty'	      => $this->input->post('qty')
                    );
                $this->db->where('id', $this->input->post('id'));
                $this->db->update($this->input->post('table'), $data);
            break;

            // insert
            default:
                $barang = $this->input->post('item_name');
                $barang_custom = $this->input->post('item_id_custom');
                $data_cart = array(
                		'id'      => ($this->input->post('item_selector')=='barang') ? $barang : strtolower(url_title($barang_custom)),
                		'qty'     => paranoid($this->input->post('qty')),
                		'price'   => '0',
                		'name'    => ($this->input->post('item_selector')=='barang') ? $barang : $barang_custom,
                	);
                if($this->input->post('options')):
                	foreach($this->input->post('options') as $key=>$val):
                		$data_cart['options'][$key] = $val;
                	endforeach;
                endif;

                $data_cart['options']['mode'] = $this->input->post('item_selector');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data_cart);

            break;
        }
        return $arr;
    }
    ////////////////////////////////////////////////////// end item_in//////////////////////////////////////////////

    ////////////////////////////////////////////////////// item_replace_in//////////////////////////////////////////////
    function item_replace_in($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $arr['dpos'] = $_POST;
                $data_cart = array(
                        'rowid'      => $this->input->post('rowid'),
                    );
                $data_cart['options']['task_parent'] = $this->input->post('task_parent');
                $data_cart['options']['condition'] = $this->input->post('condition');
    			$data_cart['options']['note'] = $this->input->post('note');
    			$data_cart['options']['item'] = $this->input->post('item');
    			$data_cart['options']['transaction_id'] = $this->input->post('transaction_id');
    			$data_cart['options']['type'] = 'in';

                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $data = array(
                        'codition'	         => $this->input->post('condition'),
                        'note'	             => $this->input->post('note'),
                    );
                $this->db->where('id', $this->input->post('id_item'));
                $this->db->update($this->input->post('table'), $data);
                $arr['dpost'] = $_POST;
            break;

            // insert
            default:
                $pitem_detail = $this->input->post('item_detail');
                $split = explode('|', $pitem_detail);

                // ----------------------CART-------------------------------
                $data = array(
                    'id'      => $split[0],
                    'qty'     => '1',
                    'price'   => '0',
                    'name'    => $split[0],
                );

                if($this->input->post('options')):
                    foreach($this->input->post('options') as $key=>$val):
                        $data['options'][$key] = $val;
                    endforeach;
                    $data['options']['condition'] = $this->input->post('condition');
                    $data['options']['note'] = $this->input->post('note');
                    $data['options']['item'] = $this->input->post('item');
                    $data['options']['transaction_id'] = $split[1];
                    $data['options']['type'] = 'in';
                endif;
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data);
                // $arr['dpos'] = $_POST;

            break;
        }
        return $arr;
    }
    ////////////////////////////////////////////////////// end item_in//////////////////////////////////////////////

    ////////////////////////////////////////////////////// BARANG BATAL Dipasang//////////////////////////////////////////////
    function ts_laporan_barang_keluar($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':

            break;

            //update
            case 'update':

                $detail = $this->db->query("SELECT * FROM {PRE}task_item_out WHERE id='".$this->input->post('id')."'")->row_array();

                if($detail):
                    $this->db->query("UPDATE {PRE}task_item_out SET status='return' WHERE id='".$detail['id']."'");
                endif;

                $data = array(
                        'task_id'	         => $detail['task_id'],
                        'author'	         => my_id(),
                        'item_id'	         => $detail['item_id'],
                        'status'	         => 'return',
                        'date_post'	         => now(),
                        'approved_by'	     => '',
                        'approved_date'	     => '',
                        'item_detail_id'	 => $detail['item_detail_id'],
                        'note'	             => '',
                        'flock'	             => 'n',
                    );

                $cek = $this->db->query("SELECT * FROM {PRE}task_item_out_cancel WHERE task_id='".$detail['task_id']."' AND item_id='".$detail['item_id']."' AND item_detail_id='".$detail['item_detail_id']."' ")->row_array();
                if(empty($cek)):
                    $this->db->insert('task_item_out_cancel', $data);
                endif;


                $arr['ddetail'] = $detail;
            break;

            // insert
            default:

            break;
        }
        return $arr;
    }
    //////////////////////////////////////////////////////BARANG BATAL Dipasang//////////////////////////////////////////////


    function sample_action($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
            break;

            //update
            case 'update':
            break;

            // insert
            default:
            break;
        }
        return $arr;
    }

    /////////////////////////////////////////////////////// item out //////////////////////////////////////////////////////////////////
    function item_out($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $arr['dpos'] = $_POST;
                $data_cart = array(
                        'rowid'      => $this->input->post('rowid'),
                        'qty'      => $this->input->post('jumlah'),
                    );
                $data_cart['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
                $data_cart['options']['note'] = $this->input->post('note');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $arr['dpost'] = $_POST;

                $jumlah_perubahan = (int) $this->input->post('jumlah');
                $jumlah_awal = (int) $this->input->post('current_qty');
                $item_id = $this->input->post('id_item');

                $selisih = $jumlah_perubahan - $jumlah_awal;

                $arr['selisih'] = $selisih;
                $looping_selisih = abs($selisih);

                if($selisih < 0):
                    //dikurangi
                    // $arr['action_item'] = 'dikurangi '.$looping_selisih;
                    $sql = "DELETE FROM {PRE}task_item_out WHERE item_id = '".$item_id."' ORDER BY id DESC LIMIT ".$looping_selisih;
                    $arr['sql_kurang'] = $sql;
                    $this->db->query($sql);
                elseif($selisih > 0):
                    //ditambahi
                    $arr['action_item'] = 'ditambah '.$looping_selisih;
                    $arr_add = array();
                    for($i=1; $i<=$looping_selisih; $i++):
                        $sql = "INSERT INTO {PRE}task_item_out (task_id, author, item_id, owner_status, status, date_post, approved_by, approved_date, item_detail_id, note, flock) SELECT task_id, author, item_id, owner_status, status, date_post, approved_by, approved_date, item_detail_id, note, flock from {PRE}task_item_out WHERE item_id='".$item_id."' LIMIT 1";
                        $arr_add[] = $sql;
                        $this->db->query($sql);
                    endfor;
                    $arr['sql_tambah'] = $arr_add;
                endif;

                $mdata = array(
                        'owner_status'       => $this->input->post('status_kepemilikan'),
                        'note'               => $this->input->post('note'),
                    );
                $this->db->where('item_id', $item_id);
                $this->db->where('task_id', $this->input->post('task_id'));
                $this->db->update('task_item_out', $mdata);
            break;

            // insert
            default:
                $arr['dpost'] = $_POST;
                $data = array(
    				'id'      => $this->input->post('item_name'),
    				'qty'     => paranoid($this->input->post('jumlah')),
    				'price'   => '0',
    				'name'    => $this->input->post('item_name'),
    			);

                $data['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
                $data['options']['note'] = $this->input->post('note');

    			$this->cart->product_name_rules = '[:print:]';
    			$cart_result = $this->cart->insert($data);
            break;
        }
        $arr['status'] = 'success';
        $arr['msg'] = 'Data berhasil disimpan';
        return $arr;
    }
    /////////////////////////////////////////////////////// item out //////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////// item replace out //////////////////////////////////////////////////////////////////
    function item_replace_out($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $arr['dpos'] = $_POST;
                $data_cart = array(
                        'rowid'      => $this->input->post('rowid'),
                        'qty'      => $this->input->post('jumlah'),
                    );
                $data_cart['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
                $data_cart['options']['note'] = $this->input->post('note');
                $data_cart['options']['type'] = 'out';
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $arr['dpost'] = $_POST;

                $jumlah_perubahan = (int) $this->input->post('jumlah');
                $jumlah_awal = (int) $this->input->post('current_qty');
                $item_id = $this->input->post('id_item');

                $selisih = $jumlah_perubahan - $jumlah_awal;

                $arr['selisih'] = $selisih;
                $looping_selisih = abs($selisih);

                if($selisih < 0):
                    //dikurangi
                    // $arr['action_item'] = 'dikurangi '.$looping_selisih;
                    $sql = "DELETE FROM {PRE}task_item_out WHERE item_id = '".$item_id."' ORDER BY id DESC LIMIT ".$looping_selisih;
                    $arr['sql_kurang'] = $sql;
                    $this->db->query($sql);
                elseif($selisih > 0):
                    //ditambahi
                    $arr['action_item'] = 'ditambah '.$looping_selisih;
                    $arr_add = array();
                    for($i=1; $i<=$looping_selisih; $i++):
                        $sql = "INSERT INTO {PRE}task_item_out (task_id, author, item_id, owner_status, status, date_post, approved_by, approved_date, item_detail_id, note, flock) SELECT task_id, author, item_id, owner_status, status, date_post, approved_by, approved_date, item_detail_id, note, flock from {PRE}task_item_out WHERE item_id='".$item_id."' LIMIT 1";
                        $arr_add[] = $sql;
                        $this->db->query($sql);
                    endfor;
                    $arr['sql_tambah'] = $arr_add;
                endif;

                $mdata = array(
                        'owner_status'       => $this->input->post('status_kepemilikan'),
                        'note'               => $this->input->post('note'),
                    );
                $this->db->where('item_id', $item_id);
                $this->db->where('task_id', $this->input->post('task_id'));
                $this->db->update('task_item_out', $mdata);
            break;

            // insert
            default:
                $arr['dpost'] = $_POST;
                $data = array(
    				'id'      => $this->input->post('item_name'),
    				'qty'     => paranoid($this->input->post('jumlah')),
    				'price'   => '0',
    				'name'    => $this->input->post('item_name'),
    			);

                $data['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
                $data['options']['note'] = $this->input->post('note');
                $data['options']['type'] = 'out';

    			$this->cart->product_name_rules = '[:print:]';
    			$cart_result = $this->cart->insert($data);
            break;
        }
        $arr['status'] = 'success';
        $arr['msg'] = 'Data berhasil disimpan';
        return $arr;
    }
    /////////////////////////////////////////////////////// item out //////////////////////////////////////////////////////////////////


    function po($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $data_cart = array(
                        'rowid'      => $this->input->post('id'),
                        'qty'     	 => paranoid($this->input->post('qty')),
                    );
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $data = array(
                        'qty'	      => paranoid($this->input->post('qty')),
                        'supplier'	  => $this->input->post('supplier'),
                        'price'	      => paranoid($this->input->post('price'))
                    );
                $this->db->where('id', $this->input->post('id'));
                $this->db->update($this->input->post('table'), $data);
            break;

            // insert
            default:
                $barang = $this->input->post('item_name');
                $barang_custom = $this->input->post('item_id_custom');
                $data_cart = array(
                		'id'      => ($this->input->post('item_selector')=='barang') ? $barang : strtolower(url_title($barang_custom)),
                		'qty'     => paranoid($this->input->post('qty')),
                		'price'   => paranoid($this->input->post('price')),
                		'name'    => ($this->input->post('item_selector')=='barang') ? $barang : $barang_custom,
                	);
                if($this->input->post('options')):
                	foreach($this->input->post('options') as $key=>$val):
                		$data_cart['options'][$key] = $val;
                	endforeach;
                endif;

                $data_cart['options']['supplier'] = $this->input->post('supplier');
                $data_cart['options']['type'] = 'recomended';
                $data_cart['options']['mode'] = $this->input->post('item_selector');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data_cart);

            break;
        }
        return $arr;
    }

    function po_pembanding($mode)
    {
        $arr = array();
        switch ($mode) {
            //update cart
            case 'update_cart':
                $data_cart = array(
                        'rowid'      => $this->input->post('id'),
                        'qty'     	 => paranoid($this->input->post('qty')),
                    );
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->update($data_cart);
            break;

            //update
            case 'update':
                $data = array(
                        'qty'	      => $this->input->post('qty')
                    );
                $this->db->where('id', $this->input->post('id'));
                $this->db->update($this->input->post('table'), $data);
            break;
            //insert
            default:
                $barang = $this->input->post('item_name');
                $barang_custom = $this->input->post('item_id_custom');
                $data_cart = array(
                        'id'      => ($this->input->post('item_selector')=='barang') ? $barang : strtolower(url_title($barang_custom)),
                        'qty'     => paranoid($this->input->post('qty')),
                        'price'   => paranoid($this->input->post('price')),
                        'name'    => ($this->input->post('item_selector')=='barang') ? $barang : $barang_custom,
                    );
                if($this->input->post('options')):
                    foreach($this->input->post('options') as $key=>$val):
                        $data_cart['options'][$key] = $val;
                    endforeach;
                endif;

                $data_cart['options']['supplier'] = $this->input->post('supplier');
                $data_cart['options']['type'] = 'pembanding';
                $data_cart['options']['mode'] = $this->input->post('item_selector');
                $this->cart->product_name_rules = '[:print:]';
                $cart_result = $this->cart->insert($data_cart);
            break;
        }
        return $arr;
    }

    function status_kepemilikan($code)
    {
        $this->db->where('category', 'item_installed_owner_status')
            ->where('code', $code);
        $data = $this->db->get('master')->row_array();
        return $data['name'];
    }

}
