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
			<?php if (sizeof($get) > 5) {

				echo '
.table>thead>tr>th,
				.table>tbody>tr>th,
				.table>tfoot>tr>th,
				.table>thead>tr>td,
				.table>tbody>tr>td,
				.table>tfoot>tr>td {
					padding: 5px 10px;
				}

				';
			} else {
				echo 'address,table{
font-size: 17px;
			}

			h5 {
				font-size: 17px;

			}

			';
			}

			?>table {
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
			<?php
			// echo $arpost->merge_type;exit;
			if ($arpost1->merge_type == '2') {
				foreach ($get as $row) {
					$arpost = $this->Finance_model->get('arpost', $row->id_arpost)->row();
					$header = $this->Finance_model->get('order_header', $arpost->id_order)->row();
					$cust = $this->Finance_model->get('ms_customers', $arpost->id_cust)->row();
					$site = $this->Finance_model->get('ms_site', $header->id_site)->row();
					echo '<div class="card">
							<br><br><br><br><br><br><br><br><br><br><br>
							<!--div class="card-header ch-alt text-center">';
					if ($header->ppn == 1 or $header->ppn == 3) {
						echo '<br><img class="i-logo" src="' . base_url() . 'assets/img/msd.png" alt="">';
					} else {
						echo '<br><img class="i-logo" src="' . base_url() . 'assets/img/boxes.png" alt="">';
					}
					echo '</div-->	
							<div class="card-body card-padding">
								<div class="row">
									<div class="col-xs-6">
										<h4>DATA CUSTOMER</h4>
									</div>
									<div class="col-xs-6">
										<div class="text-right"><h4>DATA INVOICE</h4></div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-2">
										<div class="text-left">	
											<span class="text-muted">
												<address>
													CUST ID : <br>
													NAMA : <br>
													ADDRESS : <br><br>
													ATTENTION : <br>
													PHONE : <br>
												</address>
					
											</span>
										</div>
									</div>
									<div class="col-xs-4">
										<div class="i-to">
											<span class="text-muted">
												<address>';
					echo $cust->idcust . '<br>';
					echo strtoupper($cust->nama) . '<br>';
					echo $site->alamat . '<br>';
					echo $site->kota . '<br>';
					echo $site->wakil . '<br>';
					echo $site->phonewakil . '<br>';
					echo '</address>
											</span>
										</div>
									</div>
									<div class="col-xs-offset-1 col-xs-2">
										<div class="text-right">	
											<span class="text-muted">
												<address>
													NO : <br>
													NO BAA : <br>
													DATE : <br>
													DUE DATE : <br>
													PERIODE : 
												</address>
					
											</span>
										</div>
									</div>
									<div class="col-xs-3">
										<div class="i-to">
											<div class="text-right">
											<span class="text-muted">
												<address>';
					echo $arpost->nomor . '<br>';
					echo $header->baa . '<br>';
					if (!empty($arpost->label_tgl)) {
						echo $this->Kamus_model->tanggal($arpost->label_tgl) . '<br>';
						$duedate = date("Y-m-d", strtotime($arpost->label_tgl . " + 9 days"));
						echo $this->Kamus_model->tanggal($duedate) . '<br>';
					} else {
						echo $this->Kamus_model->tanggal($arpost->tanggal_invoice) . '<br>';
						echo $this->Kamus_model->tanggal($arpost->due_date) . '<br>';
					}
					echo $this->Kamus_model->tanggal_indo($arpost->periode_dari) . ' - ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai);
					echo '</address>
											</span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="clearfix"></div>
								<br>
								<table class="table i-table m-t-10 m-b-10">
									<tbody>
										<tr class="t-uppercase">
											<td class="c-black">DESCRIPTION</td>
											<td class="c-black">NOTE</td>
											<td class="c-black" style="text-align:right;">TOTAL PRICE</td>
										</tr>';
					$biaya_langganan = 0;
					if ($arpost->flag_dp == 1) {
						if ($arpost->flag_installasi == 1) {
							$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LG', $arpost->nomor, 'D')->row();
							$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'PN', $arpost->nomor, 'D')->row();

							$serv = $this->Finance_model->get('order_service', $sum_transaksi->id_order_service)->row();
							// print_r($serv);exit;
							$lbl_serv = '';
							if ($serv->id_serv) {
								$get_serv = $this->Finance_model->get_from_arr('ms_layanan', array('id' => $serv->id_serv))->row();
								// $get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
								$lbl_serv = $get_serv->label;
							}
							echo '<tr>
														<td>
															<h5 class="f-400">' . $lbl_serv . '</h5>
														</td>';
							if (!empty($arpost->label_note)) {
								echo '<td>' . $arpost->label_note . '</td>';
							} else {
								echo '<td>' . $this->Kamus_model->tanggal_indo($arpost->periode_dari) . ' - ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai) . '</td>';
							}
							echo '<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_transaksi->total) . '</div></td>
												</tr>';

							$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LL', $arpost->nomor, 'D')->row();

							if ($sum_lain->total != 0) {
								echo '<tr>
															<td>
																<h5 class="f-400">Biaya Lain-lain</h5>
															</td>
															<td> </td>
															<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_lain->total) . '</div></td>
													</tr>';
							}
						} else {
							$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BIPN', $arpost->nomor, 'D')->row();
						}

						$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BI', $arpost->nomor, 'D')->row();
						if ($sum_installasi->total != 0) {
							echo '<tr>
														<td>
															<h5 class="f-400">Biaya Installasi</h5>
														</td>
														<td> </td>
														<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_installasi->total) . '</div></td>
												</tr>';
						}

						$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DI', $arpost->nomor, 'C')->row();
						if ($sum_dinstallasi->total != 0) {
							echo '<tr>
														<td>
															<h5 class="f-400">Diskon Installasi</h5>
														</td>
														<td> </td>
														<td style="vertical-align:middle;"><div class="text-right">Rp (' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</div></td>
												</tr>';
						}

						$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BRL', $arpost->nomor, 'D')->row();
						$br = 0;
						if ($sum_relokasi->total != 0) {
							echo '<tr>
														<td>
															<h5 class="f-400">Biaya Relokasi</h5>
														</td>
														<td> </td>
														<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_relokasi->total) . '</div></td>
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
					} else {
						// foreach($transaksi_dp as $row){
						$label = $note = '';
						$total += $transaksi_dp->nominal;
						$label = 'Down Payment';
						if (!empty($arpost->label_note)) {
							$note = $arpost->label_note;
						}
						echo '<tr>
														<td>
															<h5 class="f-400">' . $label . '</h5>
														</td>
														<td>' . $note . '</td>
														<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</div></td>
													</tr>';
						// }
						$sub = $transaksi_dp->nominal;
						$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', $arpost->nomor, 'D')->row();
					}

					echo '<tr>
												<td colspan="2">
													<h5 class="t-uppercase f-400"><div class="text-right">Amount</div></h5>
												</td>
												<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sub) . '</div></td>
											</tr>';

					$grand = $sub;
					if ($arpost->flag_dp == 1) {
						$sum_dp_min = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DP', $arpost->nomor, 'C')->row();
						if ($sum_dp_min->total != 0) {
							echo '<tr>
														<td colspan="2">
															<h5 class="f-400"><div class="text-right">DP (-)</h5>
														</td>
														<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_dp_min->total) . '</div></td>
													</tr>';
							$grand -= $sum_dp_min->total;
						}
					}
					if ($arpost->flag_dp == 1) {
						echo '<tr>
												<td colspan="2">
													<h5 class="t-uppercase f-400"><div class="text-right">Pay This Amount</div></h5>
												</td>
												<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($grand) . '</div></td>
											</tr>';
					}
					if ($header->ppn == 1 or $header->ppn == 3) {

						echo '<tr>
													<td colspan="2">
														<h5 class="f-400"><div class="text-right">PPN </div></h5>
													</td>
													<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_tax->total) . '</div></td>
												</tr>';
					}

					$grand += $sum_tax->total;
					// echo $grand.'=====';exit;

					$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MT', $arpost->nomor, 'D')->row();
					if ($sum_materai->total) {
						echo '<tr>
													<td colspan="2">
														<h5 class="f-400"><div class="text-right">Stamp Duty Fee</div></h5>
													</td>
													<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_materai->total) . '</div></td>
												</tr>';
						$grand += $sum_materai->total;
					}

					$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTBI', $arpost->nomor, 'D')->row();
					if ($sum_materaibi->total) {
						echo '<tr>
													<td colspan="2">
														<h5 class="f-400"><div class="text-right">Stamp Duty Fee</div></h5>
													</td>
													<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_materaibi->total) . '</div></td>
												</tr>';
						$grand += $sum_materaibi->total;
					}
					$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTDP', $arpost->nomor, 'D')->row();
					if ($sum_materai_dp->total) {
						echo '<tr>
													<td colspan="2">
														<h5 class="f-400"><div class="text-right">Stamp Duty Fee</div></h5>
													</td>
													<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($sum_materai_dp->total) . '</div></td>
												</tr>';
						$grand += $sum_materai_dp->total;
					}



					$grand2 = $grand;

					echo '<tr>
											<td>
												Terbilang : <b><h4 class="t-uppercase f-500">' . strtoupper($this->Kamus_model->baca_angka(round($grand))) . ' RUPIAH</h4></b>
											</td>
											<td>
												<h5 class="t-uppercase f-400"><div class="text-right">Total Tagihan</div></h5>
											</td>
											<td style="vertical-align:middle;"><div class="text-right">Rp ' . $this->Kamus_model->uang($grand2) . '</div></td>
										</tr>
									</tbody>
								</table>
								<br>
								<div class="clearfix"></div>
								
								<!--div class="row m-t-10 p-0 m-b-25">
									<div class="col-xs-12">
										<div class="bgm-blue brd-2 p-15">
											<center>
												<div class="c-white m-b-5">TERBILANG / IN WORDS</div>
												<h2 class="m-0 c-white f-300">## ' . strtoupper($this->Kamus_model->baca_angka(round($grand2))) . ' ##</h2>
											</center>
										</div>
									</div>	
								</div-->
								
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="col-xs-3">
										<div class="text-right">	
											<h4>Please make payment to :</h4>
											<span class="text-muted">
												<address>
													Account Bank : <br>
													Account No : <br>
													Account Name : <br>
												</address>
					
											</span>
										</div>
									</div>';
					if ($header->ppn == 1 or $header->ppn == 3) {
						$bank = $this->Finance_model->get('ms_bank', 2)->row();
					} else {
						$bank = $this->Finance_model->get('ms_bank', 1)->row();
					}
					echo '<div class="col-xs-3">
										<div class="i-to">
										<h4>&nbsp;</h4>
											<span class="text-muted">
												<address>
													Bank ' . $bank->bank . ' ' . $bank->cabang . '<br>'
						. $bank->rekening . '<br>'
						. $bank->an . '<br>
												</address>
					
											</span>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="i-to">
										<h4>Note :</h4>
											<span class="text-muted">
												<address>';
					// if($header->note){
					// echo $header->note.'<br>';
					// }
					echo 'Please send your confirmation transfer payment to : <br>Fax : 024-8509696 or email : finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance of payment <br>(Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)
												</address>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>';
					if ($header->ppn == 1 or $header->ppn == 3) {
						echo '<div class="row">
											<div class="col-xs-12">
												<center>Approved by :</center><br><br><br>
												<center><h5>Priyo Suyono<br>( Operational Director )</h5></center>
											</div>
										</div>';
					} else {
						if ($site->id_region == 1) {
							echo '<div class="row">
												<div class="col-xs-6">
													<center>Prepared by :</center><br><br><br><br><br><br><br>
													<center><h5>Andini Puti Maharani<br>( Finance Administration )</h5></center>
												</div>
												<div class="col-xs-6">
													<center>Approved by :</center><br><br><br><br><br><br><br>
													<center><h5>Adhi Darminto<br>( General Manager )</h5></center>
												</div>
											</div>';
						} else {
							echo '<div class="row">
												<div class="col-xs-6">
													<center>Prepared by :</center><br><br><br><br><br><br><br>
													<center><h5>Desy Yanuari Simarmata<br>( Finance Administration )</h5></center>
												</div>
												<div class="col-xs-6">
													<center>Approved by :</center><br><br><br><br><br><br><br>
													<center><h5>Adhi Darminto<br>( General Manager )</h5></center>
												</div>
											</div>';
						}
					}
					echo '<hr>
							<!--footer class="p-10">
								<ul class="list-inline text-center list-unstyled">
									<li class="m-l-5 m-r-5"><small><b>PT. Media Sarana Data</b> Jl. Jangli Dalam No. 29J Semarang, Phone : 024-8509595, Fax : 024-8509696, http://www.gmedia.net.id</small></li>
								</ul>
							</footer-->
						</div>';
				}
			} else {

				$site = $this->Finance_model->get('ms_site', $arpost1->to_site)->row();
				$cust = $this->Finance_model->get('ms_customers', $site->id_cust)->row();
				$contact = $this->Finance_model->get_from_arr('ms_contact', array('id_site' => $arpost1->to_site, 'flag' => 'f', 'status' => '1'))->row();
				$header = $this->Finance_model->get_from_arr('order_header', array('id_cust' => $site->id_cust, 'id_site' => $arpost1->to_site))->row();
				echo '<div class="card">
						<div class="card-body card-padding">
							<br><br><br><br>
							<div  style="text-align:right;"><h1><b></b></h1></div>
							<hr style="border:1px solid black;">';
				?>
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
				<?php
				if ($header->address_display == 1) {
					$alamate = $site->alamat;
					$kotae = $site->kota;
				} else if ($header->address_display == 2) {
					$alamate = $site->alamat2;
					$kotae = $site->kota2;
				} else if ($header->address_display == 3) {
					$alamate = $site->alamat3;
					$kotae = $site->kota3;
				} else {
					$alamate = $site->alamat;
					$kotae = $site->kota;
				}
				?>
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
				if ((!empty($arpost1->label_tgl)) and ($arpost1->label_tgl != '0000-00-00')) {
					$ltgl = $arpost1->label_tgl;
					$duedate = date("Y-m-d", strtotime($arpost1->label_tgl . " + 9 days"));
				} else {
					$ltgl = $arpost1->tanggal;
					$duedate = $arpost1->due_date;
				}
				?>
				<br>
				<table class="table i-table m-t-10 m-b-10">
					<tbody>
						<tr class="t-uppercase">
							<td colspan="2" class="c-black" style="border-right:1px black solid;">
								<center>Invoice Number<br><?php echo $arpost1->nomor; ?></center>
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
							<td class="borderleft c-black" style="width: 120px;text-align:center;"><b>SERVICE ID</b></td>
							<td class="borderleft c-black" style="width: 50px;text-align:center;"><b>QTY</b></td>
							<td class="borderleft c-black" style="text-align:center;width: 70px;"><b>CUR</b></td>
							<td class="borderleft c-black" style="text-align:center;"><b>UNIT PRICE</b></td>
							<td class="borderleft c-black" style="text-align:center;"><b>TOTAL PRICE</b></td>
						</tr>

						<?php
						$grand_tax = $sub = $sub2 = 0;
						$cou = 0;
						foreach ($get as $row) {
							$arpost = $this->Marketing_model->get('arpost', $row->id_arpost)->row();
							$biaya_langganan = 0;
							if ($arpost->flag_dp == 1) {
								if ($arpost->flag_installasi == 1) {
									$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'LG', $arpost->nomor, 'D')->row();

									$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'PN', $arpost->nomor, 'D')->row();
									$sum_tax2 = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', '', 'D')->row();

									$serv = $this->Finance_model->get('order_service', $sum_transaksi->id_order_service)->row();
									$lbl_serv = '';
									if ($serv->id_serv) {
										// $get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
										$get_serv = $this->Finance_model->get_from_arr('ms_layanan', array('id' => $serv->id_serv))->row();
										if (!empty($arpost->label_note)) {
											$lbl_serv = $get_serv->label . ' ' . $arpost->label_note;
										} else {
											$lbl_serv = $get_serv->label;
										}
									}

									$lblperiode = '<br>Periode ' . $this->Kamus_model->tanggal_indo($arpost->periode_dari, 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($arpost->periode_sampai, 1);

									$cou = $cou + 1;
									echo '<tr>
													<td style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">' . $cou . '</h5>
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
													<td class="td_small" style="vertical-align:middle;border-left: 1px solid black;"><span class="text-right">Rp </span><span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_transaksi->total) . '</span></td>
													<td class="td_small" style="vertical-align:middle;border-left: 1px solid black;"><span class="text-right">Rp </span><span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_transaksi->total) . '</span></td>
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
																<td style="text-align:center;vertical-align:middle;">
																	<h5 class="f-400">' . $cou . '</h5>
																</td>
																<td class="borderleft" style="vertical-align:middle;">
																	<h5 class="f-400">' . $rowln->layanan . '</h5>
																</td>
																<td class="borderleft">
																</td>
																<td class="borderleft" style="text-align:center;vertical-align:middle;">
																	<h5 class="f-400">1</h5>
																</td>
																<td class="borderleft" style="text-align:center;vertical-align:middle;">
																	<h5 class="f-400">IDR</h5>
																</td>
																<td class="td_small" style="border-left: 1px solid black;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($rowln->biaya) . '</span></td>
																<td class="td_small" style="border-left: 1px solid black;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($rowln->biaya) . '</span></td>
														</tr>';
											}
										} else {
											$cou = $cou + 1;
											echo '<tr>
															<td style="text-align:center;vertical-align:middle;">
																<h5 class="f-400">' . $cou . '</h5>
															</td>
															<td class="borderleft" style="vertical-align:middle;">
																<h5 class="f-400">Biaya Lain-lain</h5>
															</td>
															<td class="borderleft">
															</td>
															<td class="borderleft" style="text-align:center;vertical-align:middle;">
																<h5 class="f-400">1</h5>
															</td>
															<td class="borderleft" style="text-align:center;vertical-align:middle;">
																<h5 class="f-400">IDR</h5>
															</td>
															<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_lain->total) . '</span></td>
															<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_lain->total) . '</span></td>
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
													<td style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">' . $cou . '</h5>
													</td>
													<td class="borderleft" style="vertical-align:middle;">
														<h5 class="f-400">Biaya Installasi</h5>
													</td>
													<td class="borderleft"></td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">1</h5>
													</td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">IDR</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_installasi->total) . '</span></td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_installasi->total) . '</span></td>
											</tr>';
								}

								$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DI', trim($arpost->nomor), 'C')->row();
								if ($sum_dinstallasi->total != 0) {
									$cou = $cou + 1;
									echo '<tr>
													<td style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">' . $cou . '</h5>
													</td>
													<td class="borderleft" style="vertical-align:middle;">
														<h5 class="f-400">Diskon Installasi</h5>
													</td>
													<td class="borderleft"></td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">1</h5>
													</td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">IDR</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">(Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</span></td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">(Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_dinstallasi->total) . ')</span></td>
											</tr>';
								}

								$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'BRL', trim($arpost->nomor), 'D')->row();
								$br = 0;
								if ($sum_relokasi->total != 0) {
									$cou = $cou + 1;
									echo '<tr>
													<td style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">' . $cou . '</h5>
													</td>
													<td class="borderleft" style="vertical-align:middle;">
														<h5 class="f-400">Biaya Relokasi</h5>
													</td>
													<td class="borderleft"></td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">1</h5>
													</td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">IDR</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_relokasi->total) . '</span></td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_relokasi->total) . '</span></td>
											</tr>';
									$br = $sum_relokasi->total;
								}

								$sub += $sum_transaksi->total + $sum_lain->total + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
								$taxe = $sum_tax->total - $sum_tax2->total;
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
													<td style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">' . $cou . '</h5>
													</td>
													<td class="borderleft" style="vertical-align:middle;">
														<h5 class="f-400">' . $label . '</h5>
													</td>
													<td class="borderleft"></td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">1</h5>
													</td>
													<td class="borderleft" style="text-align:center;vertical-align:middle;">
														<h5 class="f-400">IDR</h5>
													</td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</span></td>
													<td class="td_small" style="border-left: 1px solid black;vertical-align:middle;"><span class="text-right">Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($transaksi_dp->nominal) . '</span></td>
												</tr>';
								// }
								$sub += $transaksi_dp->nominal;
								$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'DPN', trim($arpost->nomor), 'D')->row();
								$taxe = $sum_tax->total;
							}
							$grand_tax += $taxe;
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

						$grand += $grand_tax;
						$rowspan++;

						$materei = 3000;
						if ($grand >= 1000000) {
							$materei = 6000;
						}

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
							$this->Marketing_model->update('transaksi', array('nominal' => $materei), $get_materei->id);
						}
						$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MT', trim($arpost->nomor), 'D')->row();
						if ($sum_materai->total) {
							$grand += $sum_materai->total;
							$rowspan++;
						}

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
							$this->Marketing_model->update('transaksi', array('nominal' => $materei), $get_materei_bi->id);
						}
						$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTBI', trim($arpost->nomor), 'D')->row();
						if ($sum_materaibi->total) {
							$grand += $sum_materaibi->total;
							$rowspan++;
						}

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
							$this->Marketing_model->update('transaksi', array('nominal' => $materei), $get_materei_dp->id);
						}
						$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order, '', '', 'MTDP', trim($arpost->nomor), 'D')->row();
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
						if ($arpost1->flag_dp == 1) {
							if ($sum_dp_min->total != 0) {
								echo '<tr>
												<td style="text-align:center;">
													<h5 class="t-uppercase f-400"><b>DP (-)</b></h5>
												</td>
												<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($sum_dp_min->total) . '</b></span></td>
											</tr>';
							}
						}

						echo '<tr>
										<td style="text-align:center;">
											<h5 class="t-uppercase f-400"><b>PPN</b></h5>
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($grand_tax) . '</b></span></td>
									</tr>';


						if ($sum_materai->total) {
							echo '<tr>
											<td style="text-align:center;">
												<h5 class="t-uppercase f-400"><b>Stamp Duty Fee</b></h5>
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

						if ($arpost1->flag_dp == 1) {
							echo '<tr>
										<td style="text-align:center;">
											<h5 class="t-uppercase f-400"><b>Pay This Amount</b></h5>
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right"><b>Rp </span> <span class="text-right" style="float: right;">' . $this->Kamus_model->uang($grand) . '</b></span></td>
									</tr>';
						}
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
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-xs-offset-6 col-xs-4">
					<h5>
						<center>Approved by :</center><br><br><br><br><br><br><br>
						<center><u><b>Priyo Suyono</b></u><br>( Operational Director )<br>www.Gmedia.co.id</center>
					</h5>
				</div>
			</div><br><br>
			</div>
		<?php
	}
	?>
		</div>

		<button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
		<a data-target-color="blue" href="#modalinvoice" style="right:100px" data-toggle="modal" class="btn btn-float bgm-teal m-btn"><i class="zmdi zmdi-wrench"></i></a>

	</section>
	</section>