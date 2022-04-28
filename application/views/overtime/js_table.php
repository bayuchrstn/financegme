<?php
    // $arr = array();
    // $arr['table_id'] = 'js_table_request';
    // $arr['data_url'] = base_url().'overtime/data/';
    // $arr['refresh'] = '30000';
    // $arr['search_form_id'] = 'search_form';
    // $arr['per_page']= '10';
    // $column = array(
    //         array('bSortable' => false),
    //         array('bSortable' => true),
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
?>
<?php
    if(!empty($tabs)):
        foreach($tabs as $tab):
?>
<script type="text/javascript">
    $(document).ready(function () {
        $.fn.dataTableExt.sErrMode = 'throw';

        var oTable = $('#js_table_<?php echo $tab['code']; ?>').DataTable({
            "dom": '<"datatable-scroll"t><"datatable-footer"ip>',
            "iDisplayLength": 10,
            "order": [[ 2, "asc" ]],
            "columns": [
                {"data": "urut", "searchable": false, "orderable": false},
                {"data": "name", "name": "user.name", "searchable": true, "orderable": true},
                {"data": "date_start", "name": "start", "searchable": false, "orderable": true},
                {"data": "date_end", "name": "finish", "searchable": false, "orderable": false, "bVisible": true},
                {"data": "libur", "name": "red", "searchable": false, "orderable": true},
                {"data": "action", "searchable": false, "orderable": false}
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '<?php echo base_url(); ?>overtime/data/<?php echo $tab['code']; ?>',
                type: 'POST'
            }
        });

        // setInterval( function () {
        //     $('#js_table_<?php echo $tab['code']; ?>').DataTable().ajax.reload( null, false );
        // }, 3000 );

        $('.search_form').on('keyup change', function(){
          $('#js_table_<?php echo $tab['code']; ?>').dataTable().api().search($(this).val()).draw();
        })
    });
</script>

<?php
        endforeach;
    endif;
?>