	<section id="content">
		<div class="modal fade" id="modalinvoice" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Pengaturan Invoice</h4>
					</div>
					<form action="<?php echo base_url(); ?>finance/invoiceso_proses" method="POST">
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-5">
									<p class="c-black f-500 m-b-5 m-t-20">Label Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="col-sm-12">
											<div class="fg-line">    
												<input value="<?php echo $arpost->id; ?>" type="hidden" name="id_arpost">
												<input name="label_tgl" type="text" class="form-control date-picker" value="<?php echo $arpost->label_tgl;?>"></input>
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
												<input name="label_note" type="text" class="form-control" value="<?php echo $arpost->label_note;?>"></input>
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
		<div class="container invoice">

			<div class="block-header">
				<h2>Invoice <small>Please use Google Chrome or any other Webkit browsers for better printing.</small></h2>
			</div>
			
			<div class="card">
				<br><br><br><br><br><br>
				<!--div class="card-header ch-alt text-center">
					<?php 
					if($header->ppn==1 or $header->ppn==3){
						echo '<br><img class="i-logo" src="'.base_url().'assets/img/msd.png" alt="">';
					}else{
						echo '<br><img class="i-logo" src="'.base_url().'assets/img/boxes.png" alt="">';
					}
					?>
				</div-->
				
				<div class="card-body card-padding">
					<div class="row">
						<div class="col-xs-6">
							<center><h4>DATA CUSTOMER</h4></center>
						</div>
						<div class="col-xs-6">
							<center><h4>DATA INVOICE</h4></center>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3">
							<div class="text-right">	
								<span class="text-muted">
									<address>
										CUST ID : <br>
										NAMA : <br>
										ADDRESS : <br><br>
										ATTENTION : <br>
									</address>
		
								</span>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="i-to">
								<span class="text-muted">
									<address>
										<?php echo $cust->idcust; ?><br>
										<?php echo strtoupper($site->nama); ?><br>
										<?php echo $site->alamat; ?><br>
										<?php echo $site->kota; ?><br>
										<?php echo $site->wakil; ?><br>
									</address>
		
								</span>
							</div>
						</div>
						<div class="col-xs-3">
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
								<span class="text-muted">
									<address>
										<?php 
										echo $arpost->nomor.'<br>'; 
										echo $header->baa.'<br>'; 
										if(!empty($arpost->label_tgl)){
											echo $this->Kamus_model->tanggal($arpost->label_tgl).'<br>';
											$duedate = date("Y-m-d", strtotime($arpost->label_tgl." + 9 days"));
											echo $this->Kamus_model->tanggal($duedate).'<br>';
										}else{
											echo $this->Kamus_model->tanggal($arpost->tanggal).'<br>';
											echo $this->Kamus_model->tanggal($arpost->due_date).'<br>';
										}
										echo $this->Kamus_model->tanggal_indo($arpost->periode_dari).' - '.$this->Kamus_model->tanggal_indo($arpost->periode_sampai); ?>
									</address>
								</span>
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<table class="table i-table m-t-10 m-b-10">
						<thead class="t-uppercase">
							<th class="c-gray">DESCRIPTION</th>
							<th class="c-gray">NOTE</th>
							<th class="c-gray" style="text-align:right;">TOTAL PRICE</th>
						</thead>
						
						<tbody>
							<?php 
							$biaya_langganan = 0;
							if($arpost->flag_dp==1){
								if($arpost->flag_installasi==1){
									$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','LG',$arpost->nomor,'D')->row();
									
									$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','PN',$arpost->nomor,'D')->row();
									$sum_tax2 = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DPN','','D')->row();
									
									$serv = $this->Finance_model->get('order_service',$sum_transaksi->id_order_service)->row();
									// print_r($serv);exit;
									$lbl_serv = '';
									if($serv->id_serv){
										$get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
										$lbl_serv = $get_serv->label;
									}
									echo '<tr>
											<td>
												<h5 class="f-400">'.$lbl_serv.'</h5>
											</td>';
									if(!empty($arpost->label_note)){
										echo '<td>'.$arpost->label_note.'</td>';
									}else{
										echo '<td>'.$this->Kamus_model->tanggal_indo($arpost->periode_dari).' - '.$this->Kamus_model->tanggal_indo($arpost->periode_sampai).'</td>';
									}
									echo '<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_transaksi->total).'</div></td>
									</tr>';	
								
									$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','LL',$arpost->nomor,'D')->row();
								
									if($sum_lain->total!=0){
										echo '<tr>
												<td>
													<h5 class="f-400">Biaya Lain-lain</h5>
												</td>
												<td> </td>
												<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_lain->total).'</div></td>
										</tr>';
									}
								}else{
									$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BIPN',$arpost->nomor,'D')->row();
								}
								
								$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BI',$arpost->nomor,'D')->row();
								if($sum_installasi->total!=0){
									echo '<tr>
											<td>
												<h5 class="f-400">Biaya Installasi</h5>
											</td>
											<td> </td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_installasi->total).'</div></td>
									</tr>';
								}
								
								$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DI',$arpost->nomor,'C')->row();
								if($sum_dinstallasi->total!=0){
									echo '<tr>
											<td>
												<h5 class="f-400">Diskon Installasi</h5>
											</td>
											<td> </td>
											<td style="vertical-align:middle;"><div class="text-right">Rp ('.$this->Kamus_model->uang($sum_dinstallasi->total).')</div></td>
									</tr>';
								}
								
								$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BRL',$arpost->nomor,'D')->row();
								$br=0;
								if($sum_relokasi->total!=0){
									echo '<tr>
											<td>
												<h5 class="f-400">Biaya Relokasi</h5>
											</td>
											<td> </td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_relokasi->total).'</div></td>
									</tr>';
									$br=$sum_relokasi->total;
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
							}else{
								// foreach($transaksi_dp as $row){
									$label = $note = '';								
									$total += $transaksi_dp->nominal;
									$label = 'Down Payment';
									if(!empty($arpost->label_note)){
										$note = $arpost->label_note;
									}
									echo '<tr>
											<td>
												<h5 class="f-400">'.$label.'</h5>
											</td>
											<td>'.$note.'</td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($transaksi_dp->nominal).'</div></td>
										</tr>';
								// }
								$sub = $transaksi_dp->nominal;
								$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DPN',$arpost->nomor,'D')->row();
								$taxe = $sum_tax->total;
							}
							
							?>
							<tr>
								<td colspan="2">
									<h5 class="t-uppercase f-400"><div class="text-right">Amount</div></h5>
								</td>
								<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($sub); ?></div></td>
							</tr>
							<?php
							$grand = $sub;
							if($arpost->flag_dp==1){
								$sum_dp_min = $this->Finance_model->get_sum_transaksi($arpost->id_order,$arpost->tanggal,$arpost->tanggal,'DP','','D')->row();
								if($sum_dp_min->total!=0){
									echo '<tr>
											<td colspan="2">
												<h5 class="f-400"><div class="text-right">DP (-)</h5>
											</td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_dp_min->total).'</div></td>
										</tr>';									
									$grand -= $sum_dp_min->total;
								}								
							}
							if($arpost->flag_dp==1){
								echo '<tr>
									<td colspan="2">
										<h5 class="t-uppercase f-400"><div class="text-right">Total Amount</div></h5>
									</td>
									<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($grand).'</div></td>
								</tr>';
							}
							if($header->ppn==1 or $header->ppn==3){
								echo '<tr>
										<td colspan="2">
											<h5 class="f-400"><div class="text-right">PPN (+)</div></h5>
										</td>
										<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($taxe).'</div></td>
									</tr>';	
								
							}
							
							$grand += $taxe;
							// echo $grand.'=====';exit;
							
							$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MT',$arpost->nomor,'D')->row();
							if($sum_materai->total){
								echo '<tr>
										<td colspan="2">
											<h5 class="f-400"><div class="text-right">Materai (+)</div></h5>
										</td>
										<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_materai->total).'</div></td>
									</tr>';								
								$grand += $sum_materai->total;
							}
							
							$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MTBI',$arpost->nomor,'D')->row();
							if($sum_materaibi->total){
								echo '<tr>
										<td colspan="2">
											<h5 class="f-400"><div class="text-right">Materai (+)</div></h5>
										</td>
										<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_materaibi->total).'</div></td>
									</tr>';								
								$grand += $sum_materaibi->total;
							}
							$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MTDP',$arpost->nomor,'D')->row();
							if($sum_materai_dp->total){
								echo '<tr>
										<td colspan="2">
											<h5 class="f-400"><div class="text-right">Materai (+)</div></h5>
										</td>
										<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_materai_dp->total).'</div></td>
									</tr>';								
								$grand += $sum_materai_dp->total;
							}
								
							
							
							$grand2 = $grand;
							// if($arpost->flag_dp==1){
								// $sum_dp_min = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DP',$arpost->nomor,'C')->row();
								// if($sum_dp_min->total!=0){
									// echo '<tr>
											// <td colspan="2">
												// <h5 class="f-400"><div class="text-right">DP (-)</h5>
											// </td>
											// <td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($sum_dp_min->total).'</div></td>
										// </tr>';									
									// $grand2 = $grand - $sum_dp_min->total;
								// }								
							// }
							?>
							<tr>
								<td colspan="2">
									<h5 class="t-uppercase f-400"><div class="text-right">Total Tagihan</div></h5>
								</td>
								<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($grand2); ?></div></td>
							</tr>
						</tbody>
					</table>
					
					<div class="clearfix"></div>
					
					<div class="row m-t-10 p-0 m-b-25">
						<div class="col-xs-12">
							<div class="bgm-blue brd-2 p-15">
								<center>
									<div class="c-white m-b-5">TERBILANG / IN WORDS</div>
									<h2 class="m-0 c-white f-300">## <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand2))); ?> RUPIAH ##</h2>
								</center>
							</div>
						</div>	
					</div>
					
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
						</div>
						<?php 
						if($header->ppn==1 or $header->ppn==3){
							$bank = $this->Finance_model->get('ms_bank',2)->row();
						}else{
							$bank = $this->Finance_model->get('ms_bank',1)->row();
						}
						?>
						<div class="col-xs-3">
							<div class="i-to">
							<h4>&nbsp;</h4>
								<span class="text-muted">
									<address>
										Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?><br>
										<?php echo $bank->rekening; ?><br>
										<?php echo $bank->an; ?><br>
									</address>
		
								</span>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="i-to">
							<h4>Note :</h4>
								<span class="text-muted">
									<address>
										<?php 
										if($header->note){
											echo $header->note.'<br>';
										}
										?>
										Please send your confirmation transfer payment to : <br>Fax : 024-8509696 or email : finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance of payment <br>(Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)
									</address>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<?php 
					if($header->ppn==1 or $header->ppn==3){
						echo '<div class="row">
								<div class="col-xs-12">
									<center>Approved by :</center><br><br><br><br><br><br><br>
									<center><h5>Priyo Suyono<br>( Operational Director )</h5></center>
								</div>
							</div>';
					}else{
						if($site->id_region==1){
							echo '<div class="row">
									<div class="col-xs-6">
										<center>Prepared by :</center><br><br><br><br><br><br><br>
										<center><h5>Andini Puti Maharani<br>( Finance Administration )</h5></center>
									</div>
									<div class="col-xs-6">
										<center>Approved by :</center><br><br><br><br><br><br><br>
										<center><h5>Franky Yustanto<br>( Ops Manager )</h5></center>
									</div>
								</div>';							
						}else{
							echo '<div class="row">
									<div class="col-xs-6">
										<center>Prepared by :</center><br><br><br><br><br><br><br>
										<center><h5>Desy Yanuari Simarmata<br>( Finance Administration )</h5></center>
									</div>
									<div class="col-xs-6">
										<center>Approved by :</center><br><br><br><br><br><br><br>
										<center><h5>Sabrina Herbiansy<br>( Coord. Finance & Accounting )</h5></center>
									</div>
								</div>';
						}
					}
				?>
				<hr>
				<footer class="p-10">
					<ul class="list-inline text-center list-unstyled">
						<li class="m-l-5 m-r-5"><small><b>PT. Media Sarana Data</b> Jl. Jangli Dalam No. 29J Semarang, Phone : 024-8509595, Fax : 024-8509696, http://www.gmedia.net.id</small></li>
					</ul>
				</footer>
			</div>
			
		</div>
		
		<button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
		<a data-target-color="blue" href="#modalinvoice" style="right:100px" data-toggle="modal" class="btn btn-float bgm-teal m-btn" ><i class="zmdi zmdi-wrench"></i></a>
		<a href="javascript:history.back()" style="right:160px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>

	</section>
</section>