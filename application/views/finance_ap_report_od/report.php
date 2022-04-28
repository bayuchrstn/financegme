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
				<th rowspan="2" width="10">no</th>
				<th rowspan="2" width="60">tanggal<br />invoice</th>
				<th rowspan="2">no penerimaan</th>
				<th rowspan="2">vendor / supplier</th>
				<th rowspan="2">no invoice</th>
				<th colspan="4">invoice</th>
				<th rowspan="2" width="60">jatuh<br />tempo</th>
				<th colspan="4">overdue</th>
			</tr>
			<tr class="text-uppercase text-center text-size-large">
				<th>total</th>
				<th>bayar</th>
				<th>hutang</th>
				<th>day</th>
				<th>0 - 30</th>
				<th>31 - 60</th>
				<th>61 - 90</th>
				<th>91 &raquo;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$n = 0;

			$gt_invoice = 0.00;
			$gt_bayar = 0.00;
			$gt_piutang = 0.00;
			$gt_aging_1 = 0.00;
			$gt_aging_2 = 0.00;
			$gt_aging_3 = 0.00;
			$gt_aging_4 = 0.00;

			$row_gt = '';
			$row_data = '';
			$q = $this->finance_ap_report_od->get_data_table();
			if ($q->num_rows() > 0) {
				foreach ($q->result_array() as $r) {
					$n++;
					$piutang = $r['jumlah'] - $r['bayar'];
					$aging_1 = 0.00;
					$aging_2 = 0.00;
					$aging_3 = 0.00;
					$aging_4 = 0.00;
					$badge = '<span class="badge badge-success" style="width:35px;">0</span>';
					if ($r['aging'] >= 0 && $r['aging'] <= 30) {
						$aging_1 = $piutang;
						$badge = '<span class="badge badge-success" style="width:35px;">' . $r['aging'] . '</span>';
					} elseif ($r['aging'] >= 31 && $r['aging'] <= 60) {
						$aging_2 = $piutang;
						$badge = '<span class="badge bg-orange" style="width:35px;">' . $r['aging'] . '</span>';
					} elseif ($r['aging'] >= 61 && $r['aging'] <= 90) {
						$aging_3 = $piutang;
						$badge = '<span class="badge badge-danger" style="width:35px;">' . $r['aging'] . '</span>';
					} elseif ($r['aging'] >= 91) {
						$aging_4 = $piutang;
						$badge = '<span class="badge badge-danger" style="width:35px;">' . $r['aging'] . '</span>';
					}
					$row_data .= '<tr>
		<td align="right">' . $n . '.</td>
		<td align="center">' . $r['date_invoicenya'] . '</td>
		<td>' . $r['nomor'] . '</td>
		<td>' . $r['nama_supplier'] . '</td>
		<td>' . $r['no_referensi'] . '</td>
		<td align="right">' . number_format($r['jumlah'], 2) . '</td>
		<td align="right">' . number_format($r['bayar'], 2) . '</td>
		<td align="right">' . number_format($piutang, 2) . '</td>
		<td align="right">' . $badge . '</td>
		<td align="center">' . $r['date_duenya'] . '</td>
		<td align="right">' . number_format($aging_1, 2) . '</td>
		<td align="right">' . number_format($aging_2, 2) . '</td>
		<td align="right">' . number_format($aging_3, 2) . '</td>
		<td align="right">' . number_format($aging_4, 2) . '</td>
		</tr>';

					$gt_invoice += $r['jumlah'];
					$gt_bayar += $r['bayar'];
					$gt_piutang += $piutang;
					$gt_aging_1 += $aging_1;
					$gt_aging_2 += $aging_2;
					$gt_aging_3 += $aging_3;
					$gt_aging_4 += $aging_4;
				}
			}
			$row_gt .= '<tr style="font-weight:bold;">
		<td align="right" colspan="5">GRAND TOTAL</td>
		<td align="right">' . number_format($gt_invoice, 2) . '</td>
		<td align="right">' . number_format($gt_bayar, 2) . '</td>
		<td align="right">' . number_format($gt_piutang, 2) . '</td>
		<td align="center">&nbsp;</td>
		<td align="right">' . number_format($gt_aging_1, 2) . '</td>
		<td align="right">' . number_format($gt_aging_2, 2) . '</td>
		<td align="right">' . number_format($gt_aging_3, 2) . '</td>
		<td align="right">' . number_format($gt_aging_4, 2) . '</td>
		</tr>';

			echo $row_gt;
			echo $row_data;
			echo $row_gt;
			?>
		</tbody>
	</table>
</body>

</html>