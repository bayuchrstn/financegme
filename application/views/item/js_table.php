<?php
    // $arr = array();
    // $arr['table_id'] = 'js_table_item';
    // $arr['data_url'] = base_url().'item/data/';
    // $arr['refresh'] = '30000';
    // $arr['search_form_id'] = 'search_form';
    // $arr['per_page']= '10';
    // $column = array(
    //         array('bSortable' => false),
    //         array('bSortable' => true),
    //         array('bSortable' => true),
    //         array('bSortable' => true),
    //         array('bSortable' => false),
    //     );
    // $arr['aocolumns']= json_encode($column);

    // $arr['sorting'] = array(
    //     'column'        => '1',
    //     'sorting_mode'  => 'asc'
    // );
    // echo $this->ui->load_template('js_datatables',$arr);
    $data_url = base_url().'item/data/';
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
                {"data": "category_name", "name": "brand.item_categories", "searchable": false, "orderable": true},
                {"data": "brand_name", "name": "cat.item_categories", "searchable": false, "orderable": true, "visible":true},
                {"data": "action", "action": "index", "searchable": false, "orderable": false , "visible":true}
            ],
            "processing": true,
            "serverSide": true,
            // "keys": true,
            "ajax": {
                url: '<?php echo $data_url; ?>',
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
