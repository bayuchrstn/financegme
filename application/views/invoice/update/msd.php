<?php
    // pre($detail);
    $prefix = 'editor';
    $default_value = array();
    $forms = $this->ui->forms('invoice', $default_value, $prefix);
    // pre($this->ui->forms_debug($forms));
?>

<div class="row">

    <div class="col-lg-6">
        <table>
            <tr>
                <td width="70">Name</td>
                <td width="5">:</td>
                <td><a href="#" class="editable_text" id="invoice_name" data-inputclass="form-control" data-title="Update Invoice Name" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/customer'); ?>"><?php echo $detail['invoice_name']; ?></a></td>
            </tr>
            <tr>
                <td width="50">Address</td>
                <td>:</td>
                <td><a href="#" class="editable_text" id="invoice_address" data-inputclass="form-control" data-title="Update Invoice Address" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/customer'); ?>" ><?php echo $detail['invoice_address']; ?></a></td>
            </tr>
            <tr>
                <td>Attention</td>
                <td width="5">:</td>
                <td><a href="#" class="editable_text" id="invoice_attention" data-inputclass="form-control" data-title="Update Invoice Attention" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/customer'); ?>" ><?php echo $detail['invoice_attention']; ?></a></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><a href="#" class="editable_text" id="invoice_phone" data-inputclass="form-control" data-title="Update Invoice Phone" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/customer'); ?>" ><?php echo $detail['invoice_phone']; ?></a></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-6">
        <table>
            <tr>
                <td width="90">No</td>
                <td width="5">:</td>
                <td><a href="#" class="editable_text" id="number" data-inputclass="form-control" data-title="Update Invoice Number" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/invoice'); ?>" ><?php echo $detail['number']; ?></a></td>
            </tr>
            <tr>
                <td width="50">Customer ID</td>
                <td>:</td>
                <td><a href="#" class="editable_text" id="customer_id" data-inputclass="form-control" data-title="Update Customer ID" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/customer'); ?>" ><?php echo $detail['customer_id']; ?></a></td>
            </tr>
            <tr>
                <td>Date</td>
                <td width="5">:</td>
                <td><a href="#" class="editable_text" id="info_date" data-inputclass="form-control" data-title="Update Info Date" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/invoice'); ?>" ><?php echo $detail['info_date']; ?></a></td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td>:</td>
                <td><a href="#" class="editable_text" id="info_due_date" data-inputclass="form-control" data-title="Update Info Due Date" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/invoice'); ?>" ><?php echo $detail['info_due_date']; ?></a></td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td><a href="#" class="editable_text" id="info_periode" data-inputclass="form-control" data-title="Update Info Periode" data-pk="<?php echo $detail['id']; ?>" data-url="<?php echo base_url('invoice/editable/invoice'); ?>" ><?php echo $detail['info_periode']; ?></a></td>
            </tr>
        </table>
    </div>


</div>

<div class="row">
    <div class="col-lg-12" id="table_div">

    </div>
</div>

<!-- bank -->
<?php
    $this->db->group_by('tag');
    $bank_tag = $this->db->get('bank')->result_array();
    $data = array();
    foreach($bank_tag as $bank):

        $this->db->where('tag', $bank['tag']);
        $bank_lists = $this->db->get('bank')->result_array();
        $bank_arr = array();
        foreach($bank_lists as $bk):
            $bank_arr[$bk['id']] = $bk['name'].' '.$bk['account_name'].' '.$bk['account_number'];
        endforeach;

        $data[$bank['tag']]= $bank_arr;
    endforeach;

?>
<div class="row">
    <div class="col-lg-6">
        <?php echo form_dropdown('bank1', $data, $detail['bank_first'], 'onchange="edit_bank(\'bank1\', this.value, \''.$detail['id'].'\')" id="bank1_editor" class="bank_editor"'); ?>
    </div>
    <div class="col-lg-6">
        <?php echo form_dropdown('bank2', $data, $detail['bank_second'], 'onchange="edit_bank(\'bank2\', this.value, \''.$detail['id'].'\')" id="bank2_editor" class="bank_editor"'); ?>
    </div>
</div>
<!-- bank -->


<script type="text/javascript">
    var detail = <?php echo json_encode($detail); ?>;
    // console.log(detail);
    $('#modal_editor_invoice h4.modal-title span').html(detail.invoice_name);

    $(function() {

        // invoice name
        $('.editable_text').editable({
            // url: '<?php echo base_url(); ?>invoice/editable',
            // title: 'Enter username',
            type: 'text'
        });

        //main invoice table div
        show_table();

    });

    function show_table()
    {
        getajax('<?php echo base_url(); ?>invoice/table_editor/<?php echo $detail['id']; ?>', 'table_div');
    }

    function edit_bank(bank, val, invoice_id){
        // alert(bank+' '+val+' '+invoice_id);
        $.ajax({
            type:'POST',
            url: '<?php echo base_url() ?>',
            success: function(res) {
                // var response = jQuery.parseJSON(res);
				// console.log(response);
                $('#update_div').html(res);
                $('#modal_editor_invoice').modal('show');
            }
        });
    }

    $(document).ready(function(){
        $("#modal_update_item_form").validate({
	        <?php echo $this->load->view('valid/default', '', TRUE); ?>
	        rules: {
	            item_name: {required: true},
	            qty: {required: true},
	            unit_price: {required: true},
	        },

	        messages: {
	            item_name: {required: "Nama Item harus diisi"},
	            qty: {required: "Jumlah item harus diisi"},
	            unit_price: {required: "Harga satuan harus diisi"},
	        },

	        submitHandler: function(form) {
	            block_this('modal_generate_invoice_form');
	            $.ajax({
	                type : 'POST',
	                url  : $('#modal_update_item_form').attr('action'),
	                data  : $('#modal_update_item_form').serialize(),
	                success : function(res){
	                    var response = jQuery.parseJSON(res);
	                    // console.log(response);
	                    show_table();
	                    create_alert('msg_update_item', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
	                },
	            });
	            return false;
	        }
	    });

        $("#modal_add_item_form").validate({
	        <?php echo $this->load->view('valid/default', '', TRUE); ?>
	        rules: {
	            item_name: {required: true},
	            qty: {required: true},
	            unit_price: {required: true},
	        },

	        messages: {
	            item_name: {required: "Nama Item harus diisi"},
	            qty: {required: "Jumlah item harus diisi"},
	            unit_price: {required: "Harga satuan harus diisi"},
	        },

	        submitHandler: function(form) {
	            block_this('modal_generate_invoice_form');
	            $.ajax({
	                type : 'POST',
	                url  : $('#modal_add_item_form').attr('action'),
	                data  : $('#modal_add_item_form').serialize(),
	                success : function(res){
	                    var response = jQuery.parseJSON(res);
	                    // console.log(response);
	                    show_table();
	                    create_alert('msg_add_item', response.msg, (response.status=='success') ? 'bg-success' : 'bg-danger');
	                },
	            });
	            return false;
	        }
	    });
    });

</script>
