<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Marketing Fee</title>
    </head>
    <body style="font-family: sans-serif;">
		<b>Nama : <?php echo $nama; ?></b>
		<table style="border-collapse: collapse; width: 100%;" border="1">
			<thead>
				<tr>
					<th style="text-align: center;">No</th>
					<th style="text-align: center;">Nama</th>
					<?php 
						for ($i = 0; $i < 3; $i++) :
							$nama_bulan = number_to_month( (($triwulan-1)*3)+($i+1) );
					?>
					<th style="text-align: center;">Tagihan <?php echo $nama_bulan; ?></th>
					<?php endfor; ?>
				</tr>
				<tr>
					<th style="text-align: center;" colspan="5"><?php echo intval(date('Y'))-1; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( count($pelanggan_tahun_lalu['detail'])>0 ): ?>
					<?php 
						$no = 0;
						foreach ($pelanggan_tahun_lalu['detail'] as $row): 
							$no++;
					?>
						<tr>
							<td style="vertical-align: middle;text-align: right;"><?php echo $no; ?></td>
							<td>
								<?php echo $row['nama']; ?>
								<br>
								<small><i><?php echo 'billing '.$row['billing']; ?></i></small>
							</td>
							<?php for ($j = 0; $j < 3; $j++) : ?>
								<?php if (isset($row['extra_triwulan'][$j]['bulan'])): ?>
									<td style="text-align: right;"><?php echo currency($row['extra_triwulan'][$j]['bayar']); ?></td>
								<?php else: ?>
									<td style="text-align: right;">-</td>
								<?php endif ?>
							<?php endfor; ?>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="5">Data Tidak Ada</td>
					</tr>
				<?php endif; ?>
			</tbody>
			<thead>
				<tr>
					<th style="text-align: center;" colspan="5"><?php echo date('Y'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( count($pelanggan_berjalan['detail'])>0 ) : ?>
					<?php 
						$no = 0;
						foreach ($pelanggan_berjalan['detail'] as $row): 
							$no++;
					?>
						<tr>
							<td style="vertical-align: middle;text-align: right;"><?php echo $no; ?></td>
							<td>
								<?php echo $row['nama']; ?>
								<br>
								<small><i><?php echo 'billing '.$row['billing']; ?></i></small>
							</td>
							<?php 
								if ( count($row['list_triwulan']) > 0 ) :
									$k = 0;
									for ($j = 0; $j < 3; $j++) :
										if ( isset($row['list_triwulan'][$k]['bulan']) && $row['list_triwulan'][$k]['bulan']==(($triwulan-1)*3)+($j+1) ) :
							?>
										<td style="text-align: right;"><?php echo currency($row['list_triwulan'][$k]['bayar']); ?></td>
										<?php $k++; ?>
									<?php else: ?>
										<td style="text-align: right;">-</td>
									<?php endif; ?>
								<?php endfor; ?>
							<?php else: ?>
								<td style="text-align: right;">-</td>
								<td style="text-align: right;">-</td>
								<td style="text-align: right;">-</td>
							<?php endif; ?>
						</tr>
					<?php endforeach ?>
				<?php else: ?>
				<tr>
					<td colspan="5">Data Tidak Ada</td>
				</tr>
				<?php endif; ?>
				<tr>
					<td colspan="2" style="text-align: right;">Tagihan Perbulan :&nbsp;</td>
					<?php foreach ($pendapatan_triwulan['subtotal'] as $row): ?>
					<td style="text-align: right;"><?php echo currency($row); ?></td>
					<?php endforeach ?>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;">Total Tagihan :&nbsp;</td>
					<td colspan="3" style="text-align: right;"><?php echo currency($pendapatan_triwulan['total']); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;"><?php echo 'Target Pencapaian Triwulan ke-'.$triwulan.' tahun '.date('Y').' :'; ?>&nbsp;</td>
					<td colspan="3" style="text-align: right;"><?php echo currency($target_triwulan); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;"><?php echo 'Total Pencapaian Triwulan ke-'.$triwulan.' tahun '.date('Y').' :'; ?>&nbsp;</td>
					<td colspan="3" style="text-align: right;"><?php echo currency($pencapaian_total); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;">MF :&nbsp;</td>
					<td colspan="2" style="text-align: right;"><?php echo $mf['persen'].'% x (2% x '.currency($pendapatan_triwulan['total']).') ='; ?>&nbsp;</td>
					<td style="text-align: right;"><?php echo currency($mf['mf_diterima']); ?></td>
				</tr>
			</tbody>
		</table>        
    </body>
</html>