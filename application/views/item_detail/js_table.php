<?php
    $arr = array();
    $arr['table_id'] = 'js_table_item';
    $arr['data_url'] = base_url().'item_detail/data/'.$item;
    $arr['refresh'] = '30000';
    $arr['search_form_id'] = 'search_form';
    $arr['per_page']= '10';
    $column = array(
            array('bSortable' => false),
            array('bSortable' => true),
            array('bSortable' => true),
            array('bSortable' => true),
            array('bSortable' => true),
            array('bSortable' => true),
            array('bSortable' => false),
        );
    $arr['aocolumns']= json_encode($column);

    $arr['sorting'] = array(
        'column'        => '1',
        'sorting_mode'  => 'asc'
    );

    if ($item=='' || $item=='0') :
        // echo $this->ui->load_template('js_datatables',$arr);
?>
<script type="text/javascript">
    $(document).ready(function () {
        $.fn.dataTableExt.sErrMode = 'throw';

        var oTable = $('#js_table_item').DataTable({
            "dom": '<"datatable-scroll"t><"datatable-footer"ip>',
            "iDisplayLength": 10,
            "order": [[ 1, "asc" ]],
            "columns": [
                {"data": "id", "name": "id", "orderable": false, "searchable": false},
                {"data": "item_name", "name": "item.item_name", "searchable": true, "orderable": true},
                {"data": "category_name", "name": "brand.item_categories", "searchable": true, "orderable": true},
                {"data": "brand_name", "name": "cat.item_categories", "searchable": true, "orderable": true, "visible":true},
                {"data": "total_item_available", "name": "total_item_available", "searchable": false, "orderable": false, "visible":true},
                {"data": "total_item", "name": "total_item", "searchable": false, "orderable": false, "visible":true},
                {"data": "action", "action": "index", "searchable": false, "orderable": false , "visible":true}
            ],
            "processing": true,
            "serverSide": true,
            // "keys": true,
            "ajax": {
                url: '<?php echo $arr['data_url']; ?>',
                type: 'POST'
            },
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        });

        $('#search_form').on('keyup change', function(){
          $('#js_table_item').dataTable().api().search($(this).val()).draw();
        })
    });
</script>
<?php
    else :
        $item_status = $this->item_detail->status_item();
        $arrtab = array();
        $arrtab['datatables'] = array();
        
        if (!empty($item_status)) {
            foreach ($item_status as $tab) {
                $id_status = '_'.$tab['item_status'];

                $column_detail = array(
                    array('bSortable' => false),
                    array('bSortable' => true),
                    array('bSortable' => false),
                    array('bSortable' => false),
                    array('bSortable' => true),
                    array('bSortable' => true),
                    array('bSortable' => false),
                    array('bSortable' => false),
                    array('bSortable' => false),
                    array('bSortable' => false),
                );

                $arrtab['datatables'][] = array(
                    'table_id'      => 'js_table'.$id_status,
                    'data_url'      => $arr['data_url'].'/'.$tab['item_status'],
                    'refresh'       => $arr['refresh'],
                    'search_form_id'    => $arr['search_form_id'].$id_status,
                    'per_page'      => $arr['per_page'],
                    'aocolumns'     => json_encode($column_detail),
                    'sorting'       => $arr['sorting']
                    );
            }
        }

        echo $this->ui->load_template('js_multiple_datatables',$arrtab);

    endif;
    
?>
