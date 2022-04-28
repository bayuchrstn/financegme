<?php
    // pre($detail_customer);
    $default_value = array();
    $forms_task_marketing_request = $this->ui->forms('customer_info', $default_value, $prefix);
?>
<div class="row">
    <div class="col-lg-4">
        <?php echo $forms_task_marketing_request['telephone_home']; ?>
    </div>
    <div class="col-lg-4">
        <?php echo $forms_task_marketing_request['telephone_mobile']; ?>
    </div>
    <div class="col-lg-4">
        <?php echo $forms_task_marketing_request['telephone_work']; ?>
    </div>
</div>

<?php
    echo $forms_task_marketing_request['contact_person'];
?>

<div class="row">
    <div class="col-lg-4">
        <?php echo $forms_task_marketing_request['fax']; ?>
    </div>
    <div class="col-lg-4">
        <?php echo $forms_task_marketing_request['email']; ?>
    </div>
    <div class="col-lg-4">
        <?php echo $forms_task_marketing_request['customer_type']; ?>
    </div>
</div>

<script type="text/javascript">
    var detail_customer = <?php echo json_encode($detail_customer); ?>;
    console.log(detail_customer);
    $('#customer_name_insert').val(detail_customer.customer_name);
    $('#customer_address_insert').val(detail_customer.customer_address);
    $('#telephone_home_insert').val(detail_customer.telephone_home);
    $('#telephone_mobile_insert').val(detail_customer.telephone_mobile);
    $('#telephone_work_insert').val(detail_customer.telephone_work);
    $('#contact_person_insert').val(detail_customer.contact_person);
    $('#fax_insert').val(detail_customer.fax);
    $('#email_insert').val(detail_customer.email);
    set_option('<?php echo base_url(); ?>select_option/customer/customer_type', 'customer_type_insert', detail_customer.customer_type);
</script>
