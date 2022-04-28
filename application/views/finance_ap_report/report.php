<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title_page_table ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

</head>

<body>
	<table class="table datatable-ajax table-striped table-xxs text-size-small text-nowrap table-bordered">
		<thead>
			<tr class="text-uppercase text-center text-size-large">
				<th width="10">no</th>
				<th width="60">tanggal<br />invoice</th>
				<th>nomor</th>
				<th>no<br />referensi</th>
				<th>supplier</th>
				<th>status</th>
				<th>jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$n = 0;

			$gt_jumlah = 0;

			$row_gt = '';
			$row_data = '';
			$q = $this->finance_ap_report->get_data_table();
			if ($q->num_rows() > 0) {
				foreach ($q->result_array() as $r) {
					$n++;
					$row_data .= '<tr>
		<td align="right">' . $n . '.</td>
		<td align="center">' . $r['date_invoicenya'] . '</td>
		<td>' . $r['nomor'] . '</td>
		<td>' . $r['no_referensi'] . '</td>
		<td>' . $r['nama_supplier'] . '</td>
		<td>' . $r['status_inv'] . '</td>
		<td align="right">' . number_format($r['jumlah'], 0) . '</td>
		</tr>';

					$gt_jumlah += $r['jumlah'];
				}
			}
			$row_gt .= '<tr style="font-weight:bold;">
		<td align="right" colspan="6">GRAND TOTAL</td>
		<td align="right">' . number_format($gt_jumlah, 0) . '</td>
		</tr>';

			echo $row_gt;
			echo $row_data;
			echo $row_gt;
			?>
		</tbody>
	</table>
</body>

</html>