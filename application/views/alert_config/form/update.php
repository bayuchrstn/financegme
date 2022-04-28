<div id="info_msg" class="alert alert-styled-left bg-info">

</div>

<?php
$options = array();
$data = array();
$options['component'] = 'component/tab/tab_default';
$options['tab_id'] = 'tab1';
$options['tab_padding'] = 'no';
$options['max'] = '8';
$options['selected_tab'] = 'konfigurasi';
$options['tabs'] = array();

$options['tabs'][] = array(
		'label'         => 'Konfigurasi',
		'id'            => 'konfigurasi',
		'content'       => $this->load->view('alert_config/form/konfigurasi', $data, TRUE)
	);
$options['tabs'][] = array(
		'label'         => 'Divisi',
		'id'            => 'divisi',
		'content'       => $this->load->view('alert_config/form/divisi', $data, TRUE)
	);
$options['tabs'][] = array(
		'label'         => 'Department',
		'id'            => 'department',
		'content'       => $this->load->view('alert_config/form/department', $data, TRUE)
	);
$options['tabs'][] = array(
		'label'         => 'Sub Department',
		'id'            => 'sub_department',
		'content'       => $this->load->view('alert_config/form/sub_department', $data, TRUE)
	);
$options['tabs'][] = array(
		'label'         => 'Jabatan',
		'id'            => 'jabatan',
		'content'       => $this->load->view('alert_config/form/jabatan', $data, TRUE)
	);
$options['tabs'][] = array(
		'label'         => 'User ID',
		'id'            => 'user_id',
		'content'       => $this->load->view('alert_config/form/user_id', $data, TRUE)
	);


$content = $this->ui->load_component($options);
echo $content;
?>

<script type="text/javascript">
	var detail = <?php echo json_encode($detail); ?>;
	console.log(detail);

	$('#modal_alert_config h4 span').html(detail.name);
	$('#info_msg').html(detail.note);

	var arr_divisi = [];
	$.each(detail.arr_divisi, function( index, value ) {
		arr_divisi.push(value);
	});

	var arr_department = [];
	$.each(detail.arr_department, function( index, value ) {
		arr_department.push(value);
	});

	var arr_sub_department = [];
	$.each(detail.arr_sub_department, function( index, value ) {
		arr_sub_department.push(value);
	});

	var arr_jabatan = [];
	$.each(detail.arr_jabatan, function( index, value ) {
		arr_jabatan.push(value);
	});

	var arr_user_id = [];
	$.each(detail.arr_user_id, function( index, value ) {
		arr_user_id.push(value);
	});

	$('#id_update').val(detail.id);
	$('#title_update').val(detail.title);
	$('#content_update').val(detail.content);
	// $('#content_update').val(detail.content);

	set_option('<?php echo base_url(); ?>select_option/dds/divisi', 'divisi_update', arr_divisi);
	set_option('<?php echo base_url(); ?>select_option/dds/department', 'department_update', arr_department);
	set_option('<?php echo base_url(); ?>select_option/dds/sub_department', 'sub_department_update', arr_sub_department);
	set_option('<?php echo base_url(); ?>select_option/dds/jabatan', 'jabatan_update', arr_jabatan);
	set_option('<?php echo base_url(); ?>select_option/user/alert_config', 'user_id_update', arr_user_id);
	set_option('<?php echo base_url(); ?>select_option/alert_interval', 'time_interval_update', detail.time_interval);
	set_option('<?php echo base_url(); ?>select_option/alert_max_show', 'max_show_update', detail.max_show);

</script>
