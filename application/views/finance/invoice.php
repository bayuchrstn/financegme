	<section id="content">
		<div class="modal fade" id="modalinvoice" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Pengaturan Invoice</h4>
					</div>
					<form action="<?php echo base_url(); ?>Finance_invoice_customer/invoiceso_proses" method="POST">
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<p class="c-black f-500 m-b-5 m-t-20">Nama</p>
									<div class="input-group">
										<div class="col-sm-12">
											<div class="fg-line">
												<?php echo $radio_nama; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<p class="c-black f-500 m-b-5 m-t-20">Alamat</p>
									<div class="input-group">
										<div class="col-sm-12">
											<div class="fg-line">
												<?php echo $radio; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5">
									<p class="c-black f-500 m-b-5 m-t-20">Label Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="col-sm-12">
											<div class="fg-line">
												<input value="<?php echo $arpost->id; ?>" type="hidden" name="id_arpost">
												<input name="label_tgl" type="text" class="form-control date-picker" value="<?php echo $arpost->label_tgl; ?>"></input>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<p class="c-black f-500 m-b-5 m-t-20">Label Note</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-format-subject"></i></span>
										<div class="col-sm-12">
											<div class="fg-line">
												<input name="label_note" type="text" class="form-control" value="<?php echo $arpost->label_note; ?>"></input>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-link">Save changes</button>
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<style>
			address,
			table {
				font-size: 17px;
			}

			h5 {
				font-size: 17px;

			}

			table {
				border: 1px solid black;
			}

			.table>thead>tr>th,
			.table>tbody>tr>th,
			.table>tfoot>tr>th,
			.table>thead>tr>td,
			.table>tbody>tr>td,
			.table>tfoot>tr>td {
				border-top: 1px solid black;
			}

			.borderleft {
				border-left: 1px solid black;
			}
		</style>
		<div class="container invoice">

			<div class="block-header">
				<h2>Invoice <small>Please use Google Chrome or any other Webkit browsers for better printing.</small></h2>
			</div>

			<div class="card">

				<div class="card-body card-padding">
					<br><br><br><br>
					<div style="text-align:right;">
						<h1><b> </b></h1>
					</div>
					<hr style="border:1px solid black;">
					<div class="row">
						<div class="col-xs-9">
							<h2>
								<b>To :
									<?php
									if ($header->name_display == 1) {
										echo strtoupper($cust->nama);
									} else if ($header->name_display == 2) {
										echo strtoupper($site->nama);
									} else {
										echo strtoupper($cust->nama);
									}
									?></b>
							</h2>
						</div>
						<div class="col-xs-3">
							<div class="text-right">
								<h4><b>CUST. ID : <?php echo $cust->idcust; ?></b></h4>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<table style="border:0;">
								<tr>
									<td><?php echo $alamate . ' ' . $kotae; ?></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="clearfix"></div>
					<?php
					if ((!empty($arpost->label_tgl)) and ($arpost->label_tgl != '0000-00-00')) {
						// echo $this->Kamus_model->tanggal($arpost->label_tgl).'<br>';
						$ltgl = $arpost->label_tgl;
						$duedate = date("Y-m-d", strtotime($arpost->label_tgl . " + 9 days"));
						// echo $this->Kamus_model->tanggal($duedate).'<br>';
					} else {
						// echo $this->Kamus_model->tanggal($arpost->tanggal).'<br>';
						$ltgl = $arpost->tanggal_invoice;
						$duedate = $arpost->due_date;
						// echo $this->Kamus_model->tanggal($arpost->due_date).'<br>';
					}
					?><br>
					<table class="table i-table m-t-10 m-b-10">
						<tbody>
							<tr class="t-uppercase">
								<td colspan="2" class="c-black" style="border-right:1px black solid;">
									<center>Invoice Number<br><?php echo $arpost->nomor; ?></center>
								</td>
								<td colspan="3" class="c-black" style="border-right:1px black solid;">
									<center>Date<br><?php echo $this->Kamus_model->tanggal_indo($ltgl, 1); ?></center>
								</td>
								<td colspan="2" class="c-black">
									<center>Due Date<br><?php echo $this->Kamus_model->tanggal_indo($duedate, 1); ?></center>
								</td>
							</tr>
							<tr class="t-uppercase">
								<td style="border-left:1px white solid;" colspan="2"></td>
								<td colspan="3"></td>
								<td style="border-right:1px white solid;" colspan="2"></td>
							</tr>

							<tr class="t-uppercase">
								<td class="c-black" style="text-align:center;"><b>NO</b></td>
								<td class="borderleft c-black" style="text-align:center;width:400px;"><b>DESCRIPTION</b></td>
								<td class="borderleft c-black" style="text-align:center;"><b>SERVICE ID</b></td>
								<td class="borderleft c-black" style="text-align:center;"><b>QTY</b></td>
								<td class="borderleft c-black" style="text-align:center;"><b>CUR</b></td>
								<td class="borderleft c-black" style="text-align:center;"><b>UNIT PRICE</b></td>
								<td class="borderleft c-black" style="text-align:center;"><b>TOTAL PRICE</b></td>
							</tr>


							<?php
							$no = $biaya_langganan = 0;
							if ($arpost->flag_dp == 1) {
								if ($arpost->flag_installasi == 1) {
									$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LG', $arpost->nomor, 'D')->row();

									$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'PN', $arpost->nomor, 'D')->row();
									$sum_tax2 = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', '', 'D')->row();

									$serv = $this->Finance_model->get_from_arr('order_service', array('id_order' => $arpost->id_order, 'status' => 1))->row();
									// print_r($sum_transaksi->id_order_service);exit;
									$lbl_serv = '';
									if ($serv->id_serv) {
										$get_serv = $this->Finance_model->get_from_arr('ms_layanan', array('id' => $serv->id_serv))->row();
										if (!empty($arpost->label_note)) {
											$lbl_serv = $get_serv->label . ' ' . $arpost->label_note;
										} else {
											$lbl_serv = $get_serv->label;
										}
									}

									$lblperiode = '<br>Periode ' . $this->Kamus_model->tanggal_indo($arpost->periode_dari, 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai, 1);

									$no++;
									echo '<tr>
											<td style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">' . $no . '</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;">
												<h5 class="f-400">' . $lbl_serv . $lblperiode . '</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">' . strtoupper($serv->servid) . '</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">1</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">IDR</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-left">Rp</span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_transaksi->total) . '</span></td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_transaksi->total) . '</span></td>
									</tr>';

									$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LL', $arpost->nomor, 'D')->row();
									$get_lain = $this->Finance_model->get_from_arr('order_lain', array('id_order' => $arpost->id_order, 'status' => 1))->result();
									$sum_lain2 = $this->Finance_model->sum_lain($arpost->id_order)->row();
									if ($sum_lain->total != 0) {
										if ((!empty($get_lain)) and ($sum_lain2->jml == $sum_lain->total)) {
											foreach ($get_lain as $rowln) {
												$no++;
												echo '<tr>
														<td style="text-align:center;vertical-align:middle;">
															<h5 class="f-400">' . $no . '</h5>
														</td>
														<td class="borderleft" style="vertical-align:middle;">
															<h5 class="f-400">' . $rowln->layanan . '</h5>
														</td>
														<td class="borderleft"> </td>
														<td class="borderleft" style="text-align:center;vertical-align:middle;">
															<h5 class="f-400">1</h5>
														</td>
														<td class="borderleft" style="text-align:center;vertical-align:middle;">
															<h5 class="f-400">IDR</h5>
														</td>
														<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($rowln->biaya) . '</span></td>
														<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($rowln->biaya) . '</span></td>
												</tr>';
											}
										} else {
											$no++;
											echo '<tr>
													<td style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">' . $no . '</h5>
													</td>
													<td class="borderleft" style="vertical-align:middle;">
														<h5 class="f-400">Biaya Lain-lain</h5>
													</td>
													<td class="borderleft"> </td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">1</h5>
													</td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">IDR</h5>
													</td>
													<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_lain->total) . '</span></td>
													<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_lain->total) . '</span></td>
											</tr>';
										}
									}
								} else {
									$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BIPN', $arpost->nomor, 'D')->row();
								}

								$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BI', $arpost->nomor, 'D')->row();
								if ($sum_installasi->total != 0) {
									$no++;
									echo '<tr>
											<td style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">' . $no . '</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;">
												<h5 class="f-400">Biaya Installasi</h5>
											</td>
											<td class="borderleft"> </td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">1</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">IDR</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_installasi->total) . '</span></td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_installasi->total) . '</span></td>
									</tr>';
								}

								$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DI', $arpost->nomor, 'C')->row();
								if ($sum_dinstallasi->total != 0) {
									$no++;
									echo '<tr>
											<td style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">' . $no . '</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;">
												<h5 class="f-400">Diskon Installasi</h5>
											</td>
											<td class="borderleft"> </td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">1</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">IDR</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">(Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</span></td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">(Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</span></td>
									</tr>';
								}

								$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BRL', $arpost->nomor, 'D')->row();
								$br = 0;
								if ($sum_relokasi->total != 0) {
									$no++;
									echo '<tr>
											<td style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">' . $no . '</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;">
												<h5 class="f-400">Biaya Relokasi</h5>
											</td>
											<td class="borderleft"> </td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">1</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">IDR</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_relokasi->total) . '</span></td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_relokasi->total) . '</span></td>
									</tr>';
									$br = $sum_relokasi->total;
								}

								// $sum_dp_min = $this->Finance_model->get_sum_transaksi($arpost->id_order,$arpost->periode_dari,$arpost->periode_sampai,'DP',$arpost->nomor,'C')->row();
								// if($sum_dp_min->total!=0){
								// echo '<tr>
								// <td>
								// <h5 class="f-400">Down Payment (-)</h5>
								// </td>
								// <td> </td>
								// <td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_dp_min->total).'</div></td>
								// </tr>';									
								// }

								// $sub = $sum_transaksi->total + $sum_lain->total + $sum_installasi->total + $br - $sum_dp_min->total;
								$sub = $sum_transaksi->total + $sum_lain->total + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
								$taxe = $sum_tax->total - $sum_tax2->total;
							} else {
								// foreach($transaksi_dp as $row){
								$label = $note = '';
								$total += $transaksi_dp->nominal;
								$label = 'Down Payment';
								if (!empty($arpost->label_note)) {
									$note = $arpost->label_note;
								}
								$no++;
								echo '<tr>
											<td style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">' . $no . '</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;">
												<h5 class="f-400">' . $label . '</h5>
											</td>
											<td>' . $note . '</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">1</h5>
											</td>
											<td class="borderleft" style="text-align:center;vertical-align:middle;">
												<h5 class="f-400">IDR</h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</span></td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</span></td>
										</tr>';
								// }
								$sub = $transaksi_dp->nominal;
								$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', $arpost->nomor, 'D')->row();
								$taxe = $sum_tax->total;
							}

							$grand = $sub;
							$rowspan = 1;
							if ($arpost->flag_dp == 1) {
								$sum_dp_min = $this->Finance_model->get_sum_transaksi($arpost->id_order, $arpost->tanggal, $arpost->tanggal, 'DP', '', 'D')->row();
								if ($sum_dp_min->total != 0) {
									$grand -= $sum_dp_min->total;
									$rowspan++;
								}
							}
							if ($arpost->flag_dp == 1) {
								$rowspan++;
							}

							$grand += $taxe;
							$rowspan++;

							$materei = 3000;
							if ($grand >= 1000000) {
								$materei = 6000;
							}
							// $grand += $materei;

							$get_lg = $this->Finance_model->get_transaksi('', '', $arpost->nomor, '', '', '', '', $arpost->id_order, 'LG')->row();
							$get_materei = $this->Finance_model->get_transaksi('', '', $arpost->nomor, '', '', '', '', $arpost->id_order, 'MT')->row();
							if (empty($get_materei)) {
								$tr3 = array(
									'id_order' => $arpost->id_order,
									'id_cust' => $arpost->id_cust,
									'id_order_service' => $get_lg->id_order_service,
									'nomor' => $arpost->nomor,
									'tanggal' => $arpost->tanggal,
									'nominal' => $materei,
									'jenis_transaksi' => 'MT',
									'flag' => 'D',
									'id_user' => $this->session->userdata('id'),
									'timestamp' => date('Y-m-d H:i:s')
								);
								// $this->Marketing_model->insert('transaksi',$tr3);
							} else {
								// $this->Marketing_model->update('transaksi',array('nominal'=>$materei),$get_materei->id);
								$this->Marketing_model->update_arr('transaksi', array('nominal' => $materei), array('jenis_transaksi' => 'MT', 'nomor' => $arpost->nomor, 'id_order' => $arpost->id_order));
							}
							$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MT', $arpost->nomor, 'D')->row();
							if ($sum_materai->total) {
								$grand += $sum_materai->total;
								$rowspan++;
							}
							/////////////////////////////

							$get_materei_bi = $this->Finance_model->get_transaksi('', '', $arpost->nomor, '', '', '', '', $arpost->id_order, 'MTBI')->row();
							if (empty($get_materei_bi)) {
								$tr3 = array(
									'id_order' => $arpost->id_order,
									'id_cust' => $arpost->id_cust,
									'id_order_service' => $get_lg->id_order_service,
									'nomor' => $arpost->nomor,
									'tanggal' => $arpost->tanggal,
									'nominal' => $materei,
									'jenis_transaksi' => 'MT',
									'flag' => 'D',
									'id_user' => $this->session->userdata('id'),
									'timestamp' => date('Y-m-d H:i:s')
								);
								// $this->Marketing_model->insert('transaksi',$tr3);
							} else {
								// $this->Marketing_model->update('transaksi',array('nominal'=>$materei),$get_materei_bi->id);
								$this->Marketing_model->update_arr('transaksi', array('nominal' => $materei), array('jenis_transaksi' => 'MTBI', 'nomor' => $arpost->nomor, 'id_order' => $arpost->id_order));
							}
							$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTBI', $arpost->nomor, 'D')->row();
							if ($sum_materaibi->total) {
								$grand += $sum_materaibi->total;
								$rowspan++;
							}
							/////////////////////////

							$get_materei_dp = $this->Finance_model->get_transaksi('', '', $arpost->nomor, '', '', '', '', $arpost->id_order, 'MTDP')->row();
							if (empty($get_materei_dp)) {
								$tr3 = array(
									'id_order' => $arpost->id_order,
									'id_cust' => $arpost->id_cust,
									'id_order_service' => $get_lg->id_order_service,
									'nomor' => $arpost->nomor,
									'tanggal' => $arpost->tanggal,
									'nominal' => $materei,
									'jenis_transaksi' => 'MT',
									'flag' => 'D',
									'id_user' => $this->session->userdata('id'),
									'timestamp' => date('Y-m-d H:i:s')
								);
								// $this->Marketing_model->insert('transaksi',$tr3);
							} else {
								$this->Marketing_model->update_arr('transaksi', array('nominal' => $materei), array('jenis_transaksi' => 'MTDP', 'nomor' => $arpost->nomor, 'id_order' => $arpost->id_order));
								// $this->Marketing_model->update('transaksi',array('nominal'=>$materei),$get_materei_dp->id);
							}
							$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTDP', $arpost->nomor, 'D')->row();
							if ($sum_materai_dp->total) {
								$grand += $sum_materai_dp->total;
								$rowspan++;
							}
							?>
							<tr>
								<td colspan="5" style="vertical-align:bottom;" <?php echo 'rowspan="' . $rowspan . '"'; ?>>
									<b>Terbilang / In Words </b>: <b>
										<h4 class="t-uppercase f-500"><b># <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> RUPIAH #</b></h4>
									</b>
								</td>
								<td class="borderleft" style="text-align:center;">
									<h5 class="t-uppercase f-400"><b>Amount</b></h5>
								</td>
								<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;"><?php echo $this->Kamus_model->uang($sub); ?></b></span></td>
							</tr>
							<?php

							if ($arpost->flag_dp == 1) {
								if ($sum_dp_min->total != 0) {
									echo '<tr>
											<td style="text-align:center;">
												<h5 class="t-uppercase f-400"><b>DP (-)</b></h5>
											</td>
											<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_dp_min->total) . '</b></span></td>
										</tr>';
								}
							}

							if ($header->ppn == 1 or $header->ppn == 3) {
								echo '<tr>
										<td style="text-align:center;">
											<h5 class="t-uppercase f-400"><b>PPN </b></h5>
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($taxe) . '</b></span></td>
									</tr>';
							}

							if ($sum_materai->total) {
								echo '<tr>
										<td style="text-align:center;">
											<h5 class="t-uppercase f-400"><b>Stamp Duty Fee</b></div></h5>
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_materai->total) . '</b></span></td>
									</tr>';
							}

							if ($sum_materaibi->total) {
								echo '<tr>
										<td style="text-align:center;">
											<h5 class="t-uppercase f-400"><b>Stamp Duty Fee</b></h5>
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_materaibi->total) . '</b></span></td>
									</tr>';
							}

							if ($sum_materai_dp->total) {
								echo '<tr>
										<td style="text-align:center;">
											<h5 class="t-uppercase f-400"><b>Stamp Duty Fee</b></h5>
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_materai_dp->total) . '</b></span></td>
									</tr>';
							}

							if ($arpost->flag_dp == 1) {
								echo '<tr>
									<td style="text-align:center;">
										<h5 class="t-uppercase f-400"><b>Pay This Amount</b></h5>
									</td>
									<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($grand) . '</b></span></td>
								</tr>';
							}

							$grand2 = $grand;

							?>

						</tbody>
					</table>

					<br>
					<div class="clearfix"></div>

					<div class="row">
						<?php
						$bank = $this->Finance_model->get('ms_bank', 2)->row();
						?>
						<div class="col-xs-12">
							<h4>Please make payment to :</h4>
							<span class="text-muted">
								<center>
									<table style="border:0;">
										<tr>
											<td><b> Account Bank</b> </td>
											<td style="text-align:center;" width="250px"> : </td>
											<td> <b>Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?></b> </td>
										</tr>
										<tr>
											<td><b> Account Name</b> </td>
											<td style="text-align:center;"> : </td>
											<td><b> <?php echo $bank->an; ?></b> </td>
										</tr>
										<tr>
											<td><b> Account No</b> </td>
											<td style="text-align:center;"> : </td>
											<td><b> <?php echo $bank->rekening; ?></b> </td>
										</tr>
									</table>
								</center>
							</span>
						</div>
					</div>
					<br>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-xs-12">
							<center>
								<div class="i-to">
									<span class="text-muted">
										<address>
											Note : Please send your confirmation transfer payment to : <br><b>Fax : 024-8509696 or email : finance.smg@gmedia.co.id </b><br>Sebutkan nomor tagihan pada pembayaran/<i>please notify bill number on payment</i><br>Tagihan ini berlaku sebagai tanda terima yang sah stelah pembayaran diterima/<br><i>this invoice can be treated as official receipt upon acceptance of payment</i>
										</address>
									</span>
								</div>
							</center>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-xs-offset-6 col-xs-4">
							<h5>
								<center>Approved by :</center><br><br><br><br><br><br><br>
								<center><u><b>Priyo Suyono</b></u><br>( Operational Director )<br>www.Gmedia.co.id</center>
							</h5>
						</div>
					</div>
					<br><br><br>
				</div>
			</div>

			<button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
			<a data-target-color="blue" href="#modalinvoice" style="right:100px" data-toggle="modal" class="btn btn-float bgm-teal m-btn"><i class="zmdi zmdi-wrench"></i></a>

	</section>
	</section>