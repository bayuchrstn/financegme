<?php
	// pre($task_detail);
	$prefix  = 'report_form';
	$arr_location_info = $this->location->show($task_detail['location'], $task_detail['location_id'], 'data');
	// pre($arr_location_info);
	$default_value = array();
	$forms = $this->ui->forms('task', $default_value, $prefix);
	$forms_task_hidden = $this->ui->forms('task_hidden', $default_value, $prefix);
	$forms_report = $this->ui->forms('task_report', $default_value, $prefix);

	switch ($task_detail['location']) {

		// BTS
		case 'bts':
			// pre($arr_location_info);
			$data_umum_report = $this->ui->forms_by_section('fdu', 'bts', $default_value, $prefix);
			echo $data_umum_report['name'];
			echo $data_umum_report['address'];
			?>
			<script type="text/javascript">
				var detail_bts = <?php echo json_encode($arr_location_info); ?>;
				$('#name_report_form').val(detail_bts.bts_name);
				$('#address_report_form').val(detail_bts.bts_address);
			</script>
			<?php
		break;

		//NAP, gmedia, and noc_jakarta, noc_jogja
		case 'nap': case 'gmedia': case 'noc_jogja': case 'noc_jakarta':
			?>
			<script type="text/javascript">
				$('#data_umum').empty().load('<?php echo base_url().'pekerjaan_saya/show/'.$task_detail['id'].'/echo'?>');
			</script>
			<?php 
			break;

		// customer
		default:
			// pre($arr_location_info);
			// $detail_customer = $this->customer->detail_customer($task_detail['location_id']);
			$data_umum_report = $this->ui->forms_by_section('fdu', 'customer', $default_value, $prefix);

			echo $data_umum_report['name'];
			echo $data_umum_report['address'];
			echo $data_umum_report['contact_person'];
			echo $data_umum_report['telephone_home'];
			echo $data_umum_report['telephone_work'];
			echo $data_umum_report['telephone_mobile'];
			?>
			<script type="text/javascript">
				var detail_customer = <?php echo json_encode($arr_location_info); ?>;
				$('#name_report_form').val(detail_customer.customer_name);
				$('#address_report_form').val(detail_customer.customer_address);
				$('#contact_person_report_form').val(detail_customer.contact_person);
				$('#telephone_home_report_form').val(detail_customer.telephone_home);
				$('#telephone_work_report_form').val(detail_customer.telephone_work);
				$('#telephone_mobile_report_form').val(detail_customer.telephone_mobile);
			</script>
			<?php
		break;
	}
?>
