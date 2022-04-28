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
				<th>description</th>
				<th width="80">beginning balance</th>
				<th width="80">receive</th>
				<th width="80">payment</th>
				<th width="60">ending balance</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$trx_kas = '';
			$trx_bank = '';

			$gt_kas_saldo_awal = 0;
			$gt_kas_debet = 0;
			$gt_kas_kredit = 0;
			$gt_kas_saldo_akhir = 0;

			$gt_bank_saldo_awal = 0;
			$gt_bank_debet = 0;
			$gt_bank_kredit = 0;
			$gt_bank_saldo_akhir = 0;

			$kat = $this->m_global->finance_bank();
			if ($kat->num_rows() > 0) {
				$no = 0;
				foreach ($kat->result_array() as $r) {
					$page_uri = base_url() . 'finance_transaksi_kasir_report/index/';
					$searchform = $this->input->post('searchTanggal') . '/' . $this->input->post('searchDateFirst') . '/' . $this->input->post('searchDateFinish') . '/' . $this->input->post('searchDateFinish2');
					if ($r['lock'] == '1') {
						$no++;
						//echo '<option value="'.$r['id'].'">'.$r['name'].' ('.$r['account_number'].' / '.$r['account_name'].')</option>';
						$saldo_awal = $this->finance_transaksi_kasir_saldo_report->saldo_awal($r['branch']);
						$debet = $this->finance_transaksi_kasir_saldo_report->debet($r['branch']);
						$kredit = $this->finance_transaksi_kasir_saldo_report->kredit($r['branch']);
						$saldo_akhir = $saldo_awal + $debet - $kredit;

						$gt_kas_saldo_awal += $saldo_awal;
						$gt_kas_debet += $debet;
						$gt_kas_kredit += $kredit;
						$gt_kas_saldo_akhir += $saldo_akhir;

						$trx_kas .= '<tr>
				<td><a class="text-success-800 text-bold" href="' . $page_uri . $r['id'] . '/' . $searchform . '" target="blank" style="text-decoration:none;">' . $r['name'] . ' (' . $r['account_number'] . ' / ' . $r['account_name'] . ')</a></td>
				<td align="right">' . number_format($saldo_awal, 2) . '</td>
				<td align="right">' . number_format($debet, 2) . '</td>
				<td align="right">' . number_format($kredit, 2) . '</td>
				<td align="right">' . number_format($saldo_akhir, 2) . '</td>
				</tr>';
					}
					if ($r['lock'] == '0') {
						$no++;
						//echo '<option value="'.$r['id'].'">'.$r['name'].' ('.$r['account_number'].' / '.$r['account_name'].')</option>';
						$saldo_awal = $this->finance_transaksi_kasir_saldo_report->saldo_awal($r['id']);
						$debet = $this->finance_transaksi_kasir_saldo_report->debet($r['id']);
						$kredit = $this->finance_transaksi_kasir_saldo_report->kredit($r['id']);
						$saldo_akhir = $saldo_awal + $debet - $kredit;

						$gt_bank_saldo_awal += $saldo_awal;
						$gt_bank_debet += $debet;
						$gt_bank_kredit += $kredit;
						$gt_bank_saldo_akhir += $saldo_akhir;

						$trx_bank .= '<tr>
				<td><a class="text-primary-800 text-bold" href="' . $page_uri . $r['id'] . '/' . $searchform . '" target="blank" style="text-decoration:none;">' . $r['name'] . ' (' . $r['account_number'] . ' / ' . $r['account_name'] . ')</a></td>
				<td align="right">' . number_format($saldo_awal, 2) . '</td>
				<td align="right">' . number_format($debet, 2) . '</td>
				<td align="right">' . number_format($kredit, 2) . '</td>
				<td align="right">' . number_format($saldo_akhir, 2) . '</td>
				</tr>';
					}
				}
			}
			$kat->free_result();
			echo $trx_kas;
			echo '<tr class="text-bold">
	<td>GRAND TOTAL KAS</td>
	<td align="right">' . number_format($gt_kas_saldo_awal, 2) . '</td>
	<td align="right">' . number_format($gt_kas_debet, 2) . '</td>
	<td align="right">' . number_format($gt_kas_kredit, 2) . '</td>
	<td align="right">' . number_format($gt_kas_saldo_akhir, 2) . '</td>
	</tr>';
			echo '<tr class="text-bold">
	<td colspan="5">&nbsp;</td>
	</tr>';
			echo $trx_bank;
			echo '<tr class="text-bold">
	<td>GRAND TOTAL BANK</td>
	<td align="right">' . number_format($gt_bank_saldo_awal, 2) . '</td>
	<td align="right">' . number_format($gt_bank_debet, 2) . '</td>
	<td align="right">' . number_format($gt_bank_kredit, 2) . '</td>
	<td align="right">' . number_format($gt_bank_saldo_akhir, 2) . '</td>
	</tr>';
			?>
		</tbody>
	</table>
</body>

</html>