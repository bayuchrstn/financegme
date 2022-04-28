<?php 
    if (!empty($tabs)) :
        foreach ($tabs as $tab) :
?>
<script type="text/javascript">
    $(document).ready(function () {
        $.fn.dataTableExt.sErrMode = 'throw';

        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var oTable = $('#js_table_<?php echo $tab['id'];?>').DataTable({
            "dom": '<"datatable-scroll"t><"datatable-footer"ip>',
            "iDisplayLength": 10,
            // "order": [[ 1, "asc" ]],
            "columns": [
                {"data": null, "orderable": false, "searchable": false},
                {
                    "data": null,
                    render: function ( data, type, row ) {
                        return data.brand_name + ' / '+data.category_name + ' / '+data.item_name;
                    },
                    "name": "item.item_name", 
                    "searchable": true, "orderable": false
                },
                {"data": "nomor_barang", "name": "item_detail.nomor_barang", "searchable": true, "orderable": false},
                {"data": "mac_address", "name": "item_detail.mac_address", "searchable": true, "orderable": false},
                <?php if ($tab['id'] != 'garansi' && $tab['id'] != 'available' && $tab['id'] != 'approved_out') : ?>
                {"data": "customer_name", "name": "customer_name", "searchable": true, "orderable": false},
                {
                    "data": null,
                    render: function ( data, type, row ) {
                        return '<a title="Detail" href="javascript:void(0)" onclick="detail_barang('+data.id_transaction+');"><i class="icon-search4"></i></a>';
                    },
                    "orderable": false
                }
                <?php else: ?>
                {
                    "data": null,
                    render: function ( data, type, row ) {
                        return '<a title="Detail" href="javascript:void(0)" onclick="detail_barang('+data.item_detail_id+',\'<?=$tab['id'];?>\');"><i class="icon-search4"></i></a>';
                    },
                    "orderable": false
                }
                <?php endif; ?>
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '<?php echo base_url()."item_trace/data/".$tab['id']; ?>',
                type: 'POST'
            },
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        $('#btnSearch').on('click', function(){
            var val_search = $('.search_form').val();
            $('#js_table_<?php echo $tab['id'];?>').dataTable().api().search(val_search).draw();
          return false;
        })
    });
</script>
<?php  
        endforeach;
    endif;
?>