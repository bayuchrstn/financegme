	<section id="content">
		<div class="modal fade" id="modalinvoice" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Pengaturan Invoice</h4>
					</div>
					<form action="<?php echo base_url(); ?>Finance_invoice_customer/invoice_merge_proses" method="POST">
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-5">
									<p class="c-black f-500 m-b-5 m-t-20">Label Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="col-sm-12">
											<div class="fg-line">
												<input value="<?php echo $arpost1->id; ?>" type="hidden" name="id_arpost">
												<input name="label_tgl" type="text" class="form-control date-picker" value="<?php echo $arpost1->label_tgl; ?>"></input>
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
				font-size: 15px;
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
		<style>
			.navytd {
				background-color: #062C54 !important;
				color: white !important;
			}

			address,
			table {
				font-size: 16px;
			}

			h5,
			h4 {
				font-size: 16px;
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
				padding: 5px;
			}

			.borderleft {
				border-left: 1px solid black;
			}

			@media print {
				.mutih {
					color: white !important;
					font-weight: bold !important;
				}
			}
		</style>
		<div class="container invoice">

			<div class="block-header">
				<h2>Invoice <small>Please use Google Chrome or any other Webkit browsers for better printing.</small></h2>
			</div>
			<?php
			// echo $arpost->merge_type;exit;
			if ($arpost1->merge_type == '2') {
				foreach ($get as $row) {
					$arpost = $this->Finance_model->get('arpost', $row->id_arpost)->row();
					$header = $this->Finance_model->get('order_header', $arpost->id_order)->row();
					$cust = $this->Finance_model->get('ms_customers', $arpost->id_cust)->row();
					$site = $this->Finance_model->get('ms_site', $header->id_site)->row();
					$contact = $this->Finance_model->get_from_arr('ms_contact', array('id_site' => $header->id_site, 'flag' => 'f', 'status' => '1'))->row();

					$selected1 = $selected2 = $selected3 = '';
					if ($header->address_display == 1) {
						$alamate = $site->alamat;
						$kotae = $site->kota;
						$selected1 = 'checked';
					} else if ($header->address_display == 2) {
						$selected2 = 'checked';
						$alamate = $site->alamat2;
						$kotae = $site->kota2;
					} else if ($header->address_display == 3) {
						$selected3 = 'checked';
						$alamate = $site->alamat3;
						$kotae = $site->kota3;
					} else {
						$selected1 = 'checked';
						$alamate = $site->alamat;
						$kotae = $site->kota;
					}
					?>
					<div class="card">
						<br><br><br><br><br>
						<!--div class="card-header ch-alt text-center">
									<?php
									if ($header->ppn == 1 or $header->ppn == 3) {
										echo '<br><img class="i-logo" src="' . base_url() . 'assets/img/msd.png" alt="">';
									} else {
										echo '<br><img class="i-logo" src="' . base_url() . 'assets/img/boxes.png" alt="">';
									}
									?>
								</div-->

						<div class="card-body card-padding">
							<div class="row" style="padding-left:26px;">
								<div class="col-xs-6">
									<h4><b>CUSTOMER</b></h4>
								</div>
								<div class="col-xs-6">
									<div>
										<h4><b></b></h4>
									</div>
								</div>
							</div>
							<div class="row" style="padding: 13px 26px;">
								<div style="width:49%;margin-right:5px;border:1px solid black;border-radius:15px;padding-top:5px;padding-bottom:5px;min-height:140px;" class="col-xs-6">
									<table style="border:0;width:100%;">
										<tr>
											<td><b>NAME</b></td>
											<td style="width:20px;text-align:center;"> : </td>
											<td>
												<?php
												if ($header->name_display == 1) {
													echo strtoupper($cust->nama);
												} else if ($header->name_display == 2) {
													echo strtoupper($site->nama);
												} else {
													echo strtoupper($cust->nama);
												}
												?>
											</td>
										</tr>
										<tr>
											<td><b>ADDRESS</b></td>
											<td style="width:20px;text-align:center;"> : </td>
											<td><?php echo $alamate . ' ' . $kotae; ?></td>
										</tr>
										<?php
										$att = $site->wakil;
										$att_phone = $site->phonewakil;
										if (!empty($contact)) {
											$att = $contact->nama;
											$att_phone = $contact->phone;
										}
										?>
										<tr>
											<td><b>ATTENTION</b></td>
											<td style="width:30px;text-align:center;"> : </td>
											<td><?php echo $att; ?></td>
										</tr>
										<tr>
											<td><b>PHONE</b></td>
											<td style="width:30px;text-align:center;"> : </td>
											<td><?php echo $att_phone; ?></td>
										</tr>
									</table>
								</div>

								<div style="width:49%;margin-left:5px;border:1px solid black;border-radius:15px;padding-top:5px;padding-bottom:5px;min-height:140px;" class="col-xs-6">
									<table style="border:0;width:100%;">
										<tr>
											<td><b>NO</b></td>
											<td style="width:20px;text-align:center;"> : </td>
											<td><?php echo $arpost->nomor; ?></td>
										</tr>

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
										?>
										<tr>
											<td><b>CUST ID</b></td>
											<td style="width:20px;text-align:center;"> : </td>
											<td><?php echo $cust->idcust; ?></td>
										</tr>
										<tr>
											<td><b>DATE</b></td>
											<td style="width:20px;text-align:center;"> : </td>
											<td><?php echo $this->Kamus_model->tanggal_indo($ltgl, 1); ?></td>
										</tr>
										<tr>
											<td><b>DUE DATE</b> </td>
											<td style="width:30px;text-align:center;"> : </td>
											<td><?php echo $this->Kamus_model->tanggal_indo($duedate, 1); ?></td>
										</tr>
										<tr>
											<td><b>PERIODE</b> </td>
											<td style="width:30px;text-align:center;"> : </td>
											<td><?php echo $this->Kamus_model->tanggal_indo($arpost->periode_dari, 1) . ' - ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai, 1); ?></td>
										</tr>
									</table>
								</div>
							</div>

							<div class="clearfix"></div>
							<table class="table i-table m-t-10 m-b-10">
								<tbody><b>
										<tr class="t-uppercase">
											<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;border-right: 1px solid white;font-weight: bold;">
												NO
											</td>
											<td colspan="2" class="navytd" style="color:white;text-align:center;font-weight: bold;" width="500px">DESCRIPTION</td>
											<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">SERVICE ID</td>
											<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;text-align:right;border-left: 1px solid white;font-weight: bold;">TOTAL PRICE</td>
										</tr>
										<tr class="t-uppercase">
											<td colspan="2" class="navytd" style="color:white;text-align:center;border-top: 1px solid white;font-weight: bold;">BANDWIDTH</td>
											<!--td class="navytd" style="color:white;text-align:center;border-top: 1px solid white;border-left: 1px solid white;font-weight: bold;">DOWNTIME</td-->
										</tr>
									</b>

									<?php
									$biaya_langganan = 0;
									$cou = 0;
									if ($arpost->flag_dp == 1) {
										if ($arpost->flag_installasi == 1) {
											$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LG', trim($arpost->nomor), 'D')->row();

											$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'PN', $arpost->nomor, 'D')->row();
											$sum_tax2 = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', '', 'D')->row();

											$tr = $this->Finance_model->get_from_arr('transaksi', array('id_order' => $arpost->id_order, 'status' => 1, 'nomor' => trim($arpost->nomor)))->row();
											// print_r($tr);exit;
											$serv = $this->Finance_model->get('order_service', $tr->id_order_service)->row();
											// $serv = $this->Finance_model->get_from_arr('order_service',array('id_order'=>$arpost->id_order,'status'=>1))->row();
											// print_r($serv);exit;
											$lbl_serv = '';
											if ($serv->id_serv) {
												// $get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
												$get_serv = $this->Finance_model->get_from_arr('ms_layanan', array('id' => $serv->id_serv))->row();
												$lbl_serv = $get_serv->label;
											}
											$cou = $cou + 1;
											echo '<tr>
													<td>' . $cou . '</td>
													<td style="text-align:center;border-left: 1px solid black;" colspan="2">
														<h5 class="f-400">' . $lbl_serv . ' ' . $arpost->label_note . '</h5>
													</td>';
											echo '<td style="text-align:center;vertical-align:middle;border-left: 1px solid black;">' . $serv->servid . '</td>';
											echo '<td style="text-align:center;vertical-align:middle;border-left: 1px solid black;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_transaksi->total) . '</div></td>
											</tr>';

											echo '<tr>
													<td></td>';
											// if(!empty($arpost->label_note)){
											// echo '<td style="text-align:center;border-left: 1px solid black;" colspan="2">'.$arpost->label_note.'</td>';
											// }else{
											echo '<td style="text-align:center;border-left: 1px solid black;" colspan="2">' . $this->Kamus_model->tanggal_indo($arpost->periode_dari, 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai, 1) . '</td>';
											// }
											echo '<td style="border-left: 1px solid black;"></td>
												<td style="border-left: 1px solid black;"></td>
											</tr>';

											$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LL', trim($arpost->nomor), 'D')->row();
											$get_lain = $this->Finance_model->get_from_arr('order_lain', array('id_order' => $arpost->id_order, 'status' => 1))->result();
											$sum_lain2 = $this->Finance_model->sum_lain($arpost->id_order)->row();
											// print_r($arpost->nomor);exit;
											if ($sum_lain->total != 0) {
												if ((!empty($get_lain)) and ($sum_lain2->jml == $sum_lain->total)) {
													foreach ($get_lain as $rowln) {
														$cou = $cou + 1;
														echo '<tr>
																<td>' . $cou . '</td>
																<td style="text-align:center;border-left: 1px solid black;" colspan="2">
																	<h5 class="f-400">' . $rowln->layanan . '</h5>
																</td>
																<td style="border-left: 1px solid black;"> </td>
																<td style="border-left: 1px solid black;"><div class="text-right">Rp ' . $this->Kamus_model->uang($rowln->biaya) . '</div></td>
														</tr>';
													}
												} else {
													$cou = $cou + 1;
													echo '<tr>
															<td>' . $cou . '</td>
															<td style="text-align:center;border-left: 1px solid black;" colspan="2">
																<h5 class="f-400">Biaya Lain-lain</h5>
															</td>
															<td style="border-left: 1px solid black;"> </td>
															<td style="border-left: 1px solid black;vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_lain->total) . '</div></td>
													</tr>';
												}
											}
										} else {
											$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BIPN', trim($arpost->nomor), 'D')->row();
										}

										$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BI', trim($arpost->nomor), 'D')->row();
										if ($sum_installasi->total != 0) {
											$cou = $cou + 1;
											echo '<tr>
													<td>' . $cou . '</td>
													<td style="text-align:center;border-left: 1px solid black;" colspan="2">
														<h5 class="f-400">Biaya Installasi</h5>
													</td>
													<td style="border-left: 1px solid black;"> </td>
													<td style="border-left: 1px solid black;vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_installasi->total) . '</div></td>
											</tr>';
										}

										$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DI', trim($arpost->nomor), 'C')->row();
										if ($sum_dinstallasi->total != 0) {
											$cou = $cou + 1;
											echo '<tr>
													<td>' . $cou . '</td>
													<td style="text-align:center;border-left: 1px solid black;" colspan="2">
														<h5 class="f-400">Diskon Installasi</h5>
													</td>
													<td style="border-left: 1px solid black;"> </td>
													<td style="border-left: 1px solid black;vertical-align:middle;"><div class="text-right">(Rp ' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</div></td>
											</tr>';
										}

										$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BRL', trim($arpost->nomor), 'D')->row();
										$br = 0;
										if ($sum_relokasi->total != 0) {
											$cou = $cou + 1;
											echo '<tr>
													<td>' . $cou . '</td>
													<td style="border-left: 1px solid black;text-align;" colspan="2">
														<h5 class="f-400">Biaya Relokasi</h5>
													</td>
													<td style="border-left: 1px solid black;"> </td>
													<td style="border-left: 1px solid black;vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_relokasi->total) . '</div></td>
											</tr>';
											$br = $sum_relokasi->total;
										}


										$sub = (isset($sum_transaksi->total) ? $sum_transaksi->total : 0) + (isset($sum_lain->total) ? $sum_lain->total : 0) + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
										$taxe = $sum_tax->total - (isset($sum_tax2->total) ? $sum_tax2->total : 0);

										// $sub = $sum_transaksi->total + $sum_lain->total + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
										// $taxe = $sum_tax->total - $sum_tax2->total;
									} else {
										// foreach($transaksi_dp as $row){
										$label = $note = '';
										$total += $transaksi_dp->nominal;
										$label = 'Down Payment';
										if (!empty($arpost->label_note)) {
											$note = $arpost->label_note;
										}
										$cou = $cou + 1;
										echo '<tr>
													<td>' . $cou . '</td>
													<td style="border-left: 1px solid black;text-align:center;" colspan="2">
														<h5 class="f-400">' . $label . '</h5>
													</td>
													<td style="text-align:center;border-left: 1px solid black;">' . $note . '</td>
													<td style="border-left: 1px solid black;vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</div></td>
												</tr>';
										// }
										$sub = $transaksi_dp->nominal;
										$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', trim($arpost->nomor), 'D')->row();
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
									if ($header->ppn == 1 or $header->ppn == 3) {
										$grand += $taxe;
										$rowspan++;
									}
									$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MT', trim($arpost->nomor), 'D')->row();
									if ($sum_materai->total) {
										$grand += $sum_materai->total;
										$rowspan++;
									}
									$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTBI', trim($arpost->nomor), 'D')->row();
									if ($sum_materaibi->total) {
										$grand += $sum_materaibi->total;
										$rowspan++;
									}
									$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTDP', trim($arpost->nomor), 'D')->row();
									if ($sum_materai_dp->total) {
										$grand += $sum_materai_dp->total;
										$rowspan++;
									}
									?>
									<tr>
										<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
										<td style="text-align:center;" class="borderleft navytd">
											AMOUNT
										</td>
										<td class="navytd" style="text-align:right;border-left: 1px solid white;vertical-align:middle;">Rp <?php echo $this->Kamus_model->uang($sub); ?></td>
									</tr>
									<?php

									if ($arpost->flag_dp == 1) {
										if ($sum_dp_min->total != 0) {
											echo '<tr>
													<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
													<td class="navytd" style="border-top: 1px solid white;text-align:center;">
														DP (-)
													</td>
													<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_dp_min->total) . '</td>
												</tr>';
										}
									}

									if ($header->ppn == 1 or $header->ppn == 3) {
										echo '<tr>
												<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
												<td class="navytd" style="border-top: 1px solid white;text-align:center;">
													PPN (+)
												</td>
												<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($taxe) . '</td>
											</tr>';
									}


									if ($sum_materai->total) {
										echo '<tr>
												<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
												<td class="navytd" style="border-top: 1px solid white;text-align:center;">
													Materai (+)
												</td>
												<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_materai->total) . '</td>
											</tr>';
									}

									if ($sum_materaibi->total) {
										echo '<tr>
												<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
												<td class="navytd" style="border-top: 1px solid white;text-align:center;">
													MATERAI (+)
												</td>
												<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_materaibi->total) . '</td>
											</tr>';
									}

									if ($sum_materai_dp->total) {
										echo '<tr>
												<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
												<td class="navytd" style="border-top: 1px solid white;color:white;background-color:#062C54;text-align:center;">
													MATERAI (+)
												</td>
												<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_materai_dp->total) . '</td>
											</tr>';
									}

									$mt = 0;
									if ($site->mf == 2) {
										$mt = $sub * (2 / 100);
										$grand = $grand - $mt;
										echo '<tr>
											<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
											<td class="navytd" style="border-top: 1px solid white;text-align:center;border-left: 1px solid black;">
												MF
											</td>
											<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($mt) . '</td>
										</tr>';
									}
									if ($arpost->flag_dp == 1) {
										echo '<tr>
											<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
											<td class="navytd" style="border-top: 1px solid white;text-align:center;border-left: 1px solid black;">
												TOTAL AMOUNT
											</td>
											<td class="navytd" style="text-align:right;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($grand) . '</td>
										</tr>';
									}

									$grand2 = $grand;

									?>

								</tbody>
							</table>

							<div class="clearfix"></div>

							<div class="row m-t-10 p-0 m-b-25">
								<div class="col-xs-12">
									<div class="bgm-navy brd-2 p-15">
										<center>
											<div class="c-white m-b-5">TERBILANG / IN WORDS</div>
											<h3 class="m-0 c-white f-300">## <strong class="mutih"><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand2))); ?> RUPIAH</strong> ##</h3>
										</center>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<?php
							if ($header->nilai_voucher > 0) {
								?>
								<div class="row m-t-10 p-0 m-b-25">
									<div class="col-xs-12">
										<div class="bgm-navy brd-2 p-15">
											<center>
												<div class="c-white m-b-5">PAYMENT VIA VOUCHER</div>
											</center>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							<?php
						}
						?>
							<?php
							if ($site->voucher == 2) {
								?>
								<div class="row m-t-10 p-0 m-b-25">
									<div class="col-xs-12">
										<div class="bgm-navy brd-2 p-15">
											<center>
												<div class="c-white m-b-5">PAYMENT VIA VOUCHER</div>

											</center>
										</div>
									</div>
								</div>
								<br>
								<div class="clearfix"></div>
							<?php
						}
						?>

							<?php
							if ($site->voucher == 1) {
								?>
								<div class="row">
									<?php
									if ($header->ppn == 1 or $header->ppn == 3) {
										$bank = $this->Finance_model->get('ms_bank', 2)->row();
									} else {
										$bank = $this->Finance_model->get('ms_bank', 1)->row();
									}
									?>
									<div class="col-xs-12">
										<b>
											<h4>Please make payment to :</h4>
											<span class="text-muted">
												<table style="border:0;">
													<tr>
														<td style="text-align:left;"> Account Bank </td>
														<td style="text-align:center;" width="50px"> : </td>
														<td> Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?> </td>
													</tr>
													<tr>
														<td style="text-align:left;"> Account No </td>
														<td style="text-align:center;"> : </td>
														<td> <?php echo $bank->rekening; ?> </td>
													</tr>
													<tr>
														<td style="text-align:left;"> Account Name </td>
														<td style="text-align:center;"> : </td>
														<td> <?php echo $bank->an; ?> </td>
													</tr>
												</table>
											</span>
										</b>
									</div>
								</div>
								<div class="clearfix"></div>
								<br>
							<?php
						}
						?>
							<div class="row">

								<div class="col-xs-12">
									<div class="i-to">
										<b>
											<h4>Note :</h4>
											<span class="text-muted">
												<address>
													<?php
													if ($header->note) {
														//echo $header->note.'<br>';
													}
													?>
													Please send your confirmation transfer payment to : Fax : 024-8509696 or email : finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance of payment <br>(Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)
												</address>
											</span>
										</b>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<br><br><br>
						<?php
						if ($header->ppn == 1 or $header->ppn == 3) {
							echo '<div class="row">
										<div class="col-xs-offset-8 col-xs-4">
											<h5><center><b>Approved by :</b></center><br><br><br><br><br>
											<center><b>Priyo Suyono<br>( Operational Director )</b></center></h5>
										</div>
									</div>';
						} else {
							// if($arpost->periode_dari >= '2019-04-01'){
							$ff = 'Fernando Christian';
							// }else{
							// 	$ff = 'Andini Puti Maharani';
							// }
							if ($site->id_region == 1) {
								echo '<div class="row">
											<div class="col-xs-6">
												<h5><center><b>Prepared by :</b></center><br><br><br><br><br>
												<center><b>' . $ff . '<br>( Finance Administration )</b></center></h5>
											</div>
											<div class="col-xs-6">
												<h5><center><b>Approved by :</b></center><br><br><br><br><br>
												<center><b>Adhi Darminto<br>( General Manager )</b></center></h5>
											</div>
										</div>';
							} else {
								echo '<div class="row">
											<div class="col-xs-6">
												<h5><center><b>Prepared by :</b></center><br><br><br><br><br>
												<center><b>' . $ff . '<br>( Finance Administration )</b></center></h5>
											</div>
											<div class="col-xs-6">
												<h5><center><b>Approved by :</b></center><br><br><br><br><br>
												<center><b>Adhi Darminto<br>( General Manager )</b></center></h5>
											</div>
										</div>';
							}
						}
						?><br><br>
						<!--footer class="p-10">
									<ul class="list-inline text-center list-unstyled">
										<li class="m-l-5 m-r-5"><small><b>PT. Media Sarana Data</b> Jl. Jangli Dalam No. 29J Semarang, Phone : 024-8509595, Fax : 024-8509696, http://www.gmedia.net.id</small></li>
									</ul>
								</footer-->
					</div>
					<?php
					echo '<hr>';
				}
			} else {
				$site = $this->Finance_model->get('ms_site', $arpost1->to_site)->row();
				$cust = $this->Finance_model->get('ms_customers', $site->id_cust)->row();
				$contact = $this->Finance_model->get_from_arr('ms_contact', array('id_site' => $arpost1->to_site, 'flag' => 'f', 'status' => '1'))->row();
				$header = $this->Finance_model->get_from_arr('order_header', array('id_cust' => $site->id_cust, 'id_site' => $arpost1->to_site))->row();

				$selected1 = $selected2 = $selected3 = '';
				if ($header->address_display == 1) {
					$alamate = $site->alamat;
					$kotae = $site->kota;
					$selected1 = 'checked';
				} else if ($header->address_display == 2) {
					$selected2 = 'checked';
					$alamate = $site->alamat2;
					$kotae = $site->kota2;
				} else if ($header->address_display == 3) {
					$selected3 = 'checked';
					$alamate = $site->alamat3;
					$kotae = $site->kota3;
				} else {
					$selected1 = 'checked';
					$alamate = $site->alamat;
					$kotae = $site->kota;
				}

				echo '<div class="card">
						<br><br><br><br><br>
						<!--div class="card-header ch-alt text-center">';
				if ($header->ppn == 1 or $header->ppn == 3) {
					echo '<br><img class="i-logo" src="' . base_url() . 'assets/img/msd.png" alt="">';
				} else {
					echo '<br><img class="i-logo" src="' . base_url() . 'assets/img/boxes.png" alt="">';
				}
				echo '</div-->	
						<div class="card-body card-padding">';
				?>
				<div class="row" style="padding-left:26px;">
					<div class="col-xs-6">
						<h4><b>CUSTOMER</b></h4>
					</div>
					<div class="col-xs-6">
						<div>
							<h4><b></b></h4>
						</div>
					</div>
				</div>
				<div class="row" style="padding: 10px 20px;">
					<div style="width:49%;margin-right:5px;border:1px solid black;border-radius:15px;padding-top:5px;padding-bottom:5px;min-height:140px;" class="col-xs-6">
						<table style="border:0;width:100%;">
							<tr>
								<td><b>NAME</b></td>
								<td style="width:20px;text-align:center;"> : </td>
								<td>
									<?php
									if ($header->name_display == 1) {
										echo strtoupper($cust->nama);
									} else if ($header->name_display == 2) {
										echo strtoupper($site->nama);
									} else {
										echo strtoupper($cust->nama);
									}
									?>
								</td>
							</tr>
							<?php
							$la = $site->alamat . ' ' . $site->kota;
							if (empty($site->alamat)) {
								$la = $site->alamat2 . ' ' . $site->kota2;
								if (empty($site->alamat)) {
									$la = $site->alamat3 . ' ' . $site->kota3;
								}
							}
							$la = $alamate . ' ' . $kotae;
							?>
							<tr>
								<td><b>ADDRESS</b></td>
								<td style="width:20px;text-align:center;"> : </td>
								<td><?php echo $la; ?></td>
							</tr>
							<?php
							$att = $site->wakil;
							$att_phone = $site->phonewakil;
							if (!empty($contact)) {
								$att = $contact->nama;
								$att_phone = $contact->phone;
							}
							?>
							<tr>
								<td><b>ATTENTION</b></td>
								<td style="width:30px;text-align:center;"> : </td>
								<td><?php echo $att; ?></td>
							</tr>
							<tr>
								<td><b>PHONE</b></td>
								<td style="width:30px;text-align:center;"> : </td>
								<td><?php echo $att_phone; ?></td>
							</tr>
						</table>
					</div>

					<div style="width:49%;margin-left:5px;border:1px solid black;border-radius:15px;padding-top:5px;padding-bottom:5px;min-height:140px;" class="col-xs-6">
						<table style="border:0;width:100%;">
							<tr>
								<td><b>NO</b></td>
								<td style="width:20px;text-align:center;"> : </td>
								<td><?php echo $arpost1->nomor; ?></td>
							</tr>

							<?php
							if ((!empty($arpost1->label_tgl)) and ($arpost1->label_tgl != '0000-00-00')) {
								// echo $this->Kamus_model->tanggal($arpost1->label_tgl).'<br>';
								$ltgl = $arpost1->label_tgl;
								$duedate = date("Y-m-d", strtotime($arpost1->label_tgl . " + 9 days"));
								// echo $this->Kamus_model->tanggal($duedate).'<br>';
							} else {
								// echo $this->Kamus_model->tanggal($arpost1->tanggal).'<br>';
								$ltgl = $arpost1->tanggal;
								$duedate = $arpost1->due_date;
								// echo $this->Kamus_model->tanggal($arpost1->due_date).'<br>';
							}
							?>
							<tr>
								<td><b>CUST ID</b></td>
								<td style="width:20px;text-align:center;"> : </td>
								<td><?php echo $cust->idcust; ?></td>
							</tr>
							<tr>
								<td><b>DATE</b></td>
								<td style="width:20px;text-align:center;"> : </td>
								<td><?php echo $this->Kamus_model->tanggal_indo($ltgl, 1); ?></td>
							</tr>
							<tr>
								<td><b>DUE DATE</b> </td>
								<td style="width:30px;text-align:center;"> : </td>
								<td><?php echo $this->Kamus_model->tanggal_indo($duedate, 1); ?></td>
							</tr>
							<tr>
								<td><b>PERIODE</b> </td>
								<td style="width:30px;text-align:center;"> : </td>
								<td><?php echo $this->Kamus_model->tanggal_indo($arpost1->periode_dari, 1) . ' - ' . $this->Kamus_model->tanggal_indo($arpost1->periode_sampai, 1); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<?php

				echo '<div class="clearfix"></div>
							<br>
							<table class="table i-table m-t-10 m-b-10">
								<tbody><b>
									<tr class="t-uppercase">
										<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;border-right: 1px solid white;font-weight: bold;text-align:center;">
												NO
										</td>
										<td colspan="2" class="navytd" style="color:white;text-align:center;font-weight: bold;" width="500px">DESCRIPTION</td>
										<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">SERVICE ID</td>
										<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">TOTAL PRICE</td>
									</tr>
									<tr class="t-uppercase">
										<td colspan="2" class="navytd" style="color:white;text-align:center;border-top: 1px solid white;font-weight: bold;">BANDWIDTH</td>
									</tr>
								</b>';
				$sub = $sub2 = 0;
				$cou = 0;
				foreach ($get as $row) {
					$arpost = $this->Marketing_model->get('arpost', $row->id_arpost)->row();
					$biaya_langganan = 0;
					if ($arpost->flag_dp == 1) {
						if ($arpost->flag_installasi == 1) {
							$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LG', $arpost->nomor, 'D')->row();
							$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'PN', $arpost->nomor, 'D')->row();

							$serv = $this->Finance_model->get('order_service', $sum_transaksi->id_order_service)->row();
							$lbl_serv = '';
							if ($serv->id_serv) {
								// $get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
								$get_serv = $this->Finance_model->get_from_arr('ms_layanan', array('id' => $serv->id_serv))->row();
								$lbl_serv = $get_serv->label;
							}
							$cou = $cou + 1;
							echo '<tr>
													<td style="text-align:center;" class="td_small">' . $cou . '</td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">
													<h5 class="f-400">' . $lbl_serv . ' ' . $arpost->label_note . '</h5>
												</td>';
							echo '<td class="td_small" style="text-align:center;vertical-align:middle;border-left: 1px solid black;">' . $serv->servid . '</td>';
							echo '<td class="td_small" style="text-align:center;vertical-align:middle;border-left: 1px solid black;">Rp ' . $this->Kamus_model->uang($sum_transaksi->total) . '</td>
											</tr>';

							echo '<tr>
												<td class="td_small"></td>';
							// if(!empty($arpost->label_note)){
							// echo '<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">'.$arpost->label_note.'</td>';
							// }else{
							echo '<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">' . $this->Kamus_model->tanggal_indo($arpost->periode_dari, 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai, 1) . '</td>';
							// }
							echo '<td class="td_small" style="border-left: 1px solid black;"></td>
												<td class="td_small" style="border-left: 1px solid black;"></td>
											</tr>';

							$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LL', trim($arpost->nomor), 'D')->row();
							$get_lain = $this->Finance_model->get_from_arr('order_lain', array('id_order' => $arpost->id_order, 'status' => 1))->result();
							$sum_lain2 = $this->Finance_model->sum_lain($arpost->id_order)->row();
							// print_r($arpost->nomor);exit;
							if ($sum_lain->total != 0) {
								if ((!empty($get_lain)) and ($sum_lain2->jml == $sum_lain->total)) {
									foreach ($get_lain as $rowln) {
										$cou = $cou + 1;
										echo '<tr>
																<td style="text-align:center;" class="td_small">' . $cou . '</td>
																<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">
																	<h5 class="f-400">' . $rowln->layanan . '</h5>
																</td>
																<td class="td_small" style="border-left: 1px solid black;"> </td>
																<td class="td_small" style="text-align:center;border-left: 1px solid black;">Rp ' . $this->Kamus_model->uang($rowln->biaya) . '</td>
														</tr>';
									}
								} else {
									$cou = $cou + 1;
									echo '<tr>
															<td style="text-align:center;" class="td_small">' . $cou . '</td>
															<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">
																<h5 class="f-400">Biaya Lain-lain</h5>
															</td>
															<td class="td_small" style="border-left: 1px solid black;"> </td>
															<td class="td_small" style="text-align:center;border-left: 1px solid black;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_lain->total) . '</td>
													</tr>';
								}
							}
						} else {
							$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BIPN', trim($arpost->nomor), 'D')->row();
						}

						$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BI', trim($arpost->nomor), 'D')->row();
						if ($sum_installasi->total != 0) {
							$cou = $cou + 1;
							echo '<tr>
													<td style="text-align:center;" class="td_small">' . $cou . '</td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">
														<h5 class="f-400">Biaya Installasi</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;"> </td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_installasi->total) . '</td>
											</tr>';
						}

						$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DI', trim($arpost->nomor), 'C')->row();
						if ($sum_dinstallasi->total != 0) {
							$cou = $cou + 1;
							echo '<tr>
													<td style="text-align:center;" class="td_small">' . $cou . '</td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;" colspan="2">
														<h5 class="f-400">Diskon Installasi</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;"> </td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;vertical-align:middle;">(Rp ' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</td>
											</tr>';
						}

						$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BRL', trim($arpost->nomor), 'D')->row();
						$br = 0;
						if ($sum_relokasi->total != 0) {
							$cou = $cou + 1;
							echo '<tr>
													<td style="text-align:center;" class="td_small">' . $cou . '</td>
													<td class="td_small" style="border-left: 1px solid black;text-align;" colspan="2">
														<h5 class="f-400">Biaya Relokasi</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;"> </td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($sum_relokasi->total) . '</td>
											</tr>';
							$br = $sum_relokasi->total;
						}

						$sub += $sum_transaksi->total + $sum_lain->total + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
						$sub2 += $sum_tax->total;
					} else {
						// foreach($transaksi_dp as $row){
						$label = $note = '';
						$total += $transaksi_dp->nominal;
						$label = 'Down Payment';
						if (!empty($arpost->label_note)) {
							$note = $arpost->label_note;
						}
						$cou = $cou + 1;
						echo '<tr>
													<td style="text-align:center;" class="td_small">' . $cou . '</td>
													<td class="td_small" style="border-left: 1px solid black;text-align:center;" colspan="2">
														<h5 class="f-400">' . $label . '</h5>
													</td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;">' . $note . '</td>
													<td class="td_small" style="text-align:center;border-left: 1px solid black;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</td>
												</tr>';
						// }
						$sub += $transaksi_dp->nominal;
						$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', trim($arpost->nomor), 'D')->row();
						$taxe = $sum_tax->total;
					}
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
				if ($header->ppn == 1 or $header->ppn == 3) {
					$grand += $taxe;
					$rowspan++;
				}
				$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MT', trim($arpost->nomor), 'D')->row();
				if ($sum_materai->total) {
					$grand += $sum_materai->total;
					$rowspan++;
				}
				$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTBI', trim($arpost->nomor), 'D')->row();
				if ($sum_materaibi->total) {
					$grand += $sum_materaibi->total;
					$rowspan++;
				}
				$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTDP', trim($arpost->nomor), 'D')->row();
				if ($sum_materai_dp->total) {
					$grand += $sum_materai_dp->total;
					$rowspan++;
				}
				?>
				<tr>
					<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
					<td style="text-align:center;" class="borderleft navytd">
						AMOUNT
					</td>
					<td class="navytd" style="text-align:center;border-left: 1px solid white;vertical-align:middle;">Rp <?php echo $this->Kamus_model->uang($sub); ?></td>
				</tr>
				<?php

				$grand = $sub + $sub2;

				echo '<tr>
										<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
										<td class="navytd" style="border-top: 1px solid white;text-align:center;border-left: 1px solid black;">
											TOTAL AMOUNT
										</td>
										<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp ' . $this->Kamus_model->uang($grand) . '</td>
									</tr>
								</tbody>
							</table>';
				?>
				<div class="clearfix"></div>

				<div class="row m-t-10 p-0 m-b-25">
					<div class="col-xs-12">
						<div class="bgm-navy brd-2 p-15">
							<center>
								<div class="c-white m-b-5">TERBILANG / IN WORDS</div>
								<h3 class="m-0 c-white f-300">## <strong class="mutih"><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> RUPIAH</strong> ##</h3>
							</center>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<?php
				if ($header->nilai_voucher > 0) {
					?>
					<div class="row m-t-10 p-0 m-b-25">
						<div class="col-xs-12">
							<div class="bgm-navy brd-2 p-15">
								<center>
									<div class="c-white m-b-5">PAYMENT VIA VOUCHER</div>
								</center>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				<?php
			}
			?>
				<div class="row">
					<?php
					if ($header->ppn == 1 or $header->ppn == 3) {
						$bank = $this->Finance_model->get('ms_bank', 2)->row();
					} else {
						$bank = $this->Finance_model->get('ms_bank', 1)->row();
					}
					?>
					<div class="col-xs-12">
						<b>
							<h4>Please make payment to :</h4>
							<span class="text-muted">
								<table style="border:0;">
									<tr>
										<td style="text-align:left;"> Account Bank </td>
										<td style="text-align:center;" width="50px"> : </td>
										<td> Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?> </td>
									</tr>
									<tr>
										<td style="text-align:left;"> Account No </td>
										<td style="text-align:center;"> : </td>
										<td> <?php echo $bank->rekening; ?> </td>
									</tr>
									<tr>
										<td style="text-align:left;"> Account Name </td>
										<td style="text-align:center;"> : </td>
										<td> <?php echo $bank->an; ?> </td>
									</tr>
								</table>
							</span>
						</b>
					</div>
				</div>
				<div class="clearfix"></div>
				<br>
				<div class="row">

					<div class="col-xs-12">
						<div class="i-to">
							<b>
								<h4>Note :</h4>
								<span class="text-muted">
									<address>
										<?php
										if ($header->note) {
											//echo $header->note.'<br>';
										}
										?>
										Please send your confirmation transfer payment to : Fax : 024-8509696 or email : finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance of payment <br>(Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)
									</address>
								</span>
							</b>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div><br>
			<?php
			if ($header->ppn == 1 or $header->ppn == 3) {
				echo '<div class="row">
										<div class="col-xs-offset-8 col-xs-4">
											<h5><center><b>Approved by :</b></center><br><br><br><br>
											<center><b>Priyo Suyono<br>( Operational Director )</b></center></h5>
										</div>
									</div>';
			} else {
				// if($arpost->periode_dari >= '2019-04-01'){
				$ff = 'Fernando Christian';
				// }else{
				// $ff = 'Andini Puti Maharani';
				// }
				if ($site->id_region == 1) {
					echo '<div class="row">
											<div class="col-xs-6">
												<h5><center><b>Prepared by :</b></center><br><br><br><br><br>
												<center><b>' . $ff . '<br>( Finance Administration )</b></center></h5>
											</div>
											<div class="col-xs-6">
												<h5><center><b>Approved by :</b></center><br><br><br><br><br>
												<center><b>Adhi Darminto<br>( General Manager )</b></center></h5>
											</div>
										</div>';
				} else {
					echo '<div class="row">
											<div class="col-xs-6">
												<h5><center><b>Prepared by :</b></center><br><br><br><br><br>
												<center><b>' . $ff . '<br>( Finance Administration )</b></center></h5>
											</div>
											<div class="col-xs-6">
												<h5><center><b>Approved by :</b></center><br><br><br><br><br>
												<center><b>Adhi Darminto<br>( General Manager )</b></center></h5>
											</div>
										</div>';
				}
			}
			?><br><br>
			</div>
		<?php
	}
	?>
		</div>

		<button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
		<a data-target-color="blue" href="#modalinvoice" style="right:100px" data-toggle="modal" class="btn btn-float bgm-teal m-btn"><i class="zmdi zmdi-wrench"></i></a>

	</section>
	</section>