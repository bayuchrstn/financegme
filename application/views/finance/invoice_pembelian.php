	<section id="content">
		<div class="modal fade" id="modalinvoice" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Pengaturan Invoice</h4>
					</div>
					<form action="<?php echo base_url(); ?>finance/invoice_proses" method="POST">
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<label>
										<input value="<?php echo $arpost->id; ?>" type="hidden" name="id_arpost">
										<input value="1" type="radio" <?php echo $check1; ?> name="flag">
										<i class="input-helper"></i>
										Hanya menampilkan label
									</label>
								</div>
								<div class="col-sm-12">
									<label>
										<input value="2" type="radio" <?php echo $check2; ?> name="flag">
										<i class="input-helper"></i>
										Hanya menampilkan daftar barang
									</label>
								</div>
								<div class="col-sm-12">
									<label>
										<input value="3" type="radio" <?php echo $check3; ?> name="flag">
										<i class="input-helper"></i>
										Menampilkan label dan daftar barang
									</label>
								</div>
								<div class="col-sm-12">
									<input class="form-control" value="<?php echo isset($arpost->label)?$arpost->label:'Pembelian Barang'; ?>" name="label" placeholder="Label" type="text">
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
			<style>
				address,table{
					font-size:15px;
				}
				table{
					border: 1px solid black;
				}
				.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
					border-top: 1px solid black;
				}
				.borderleft{
					border-left: 1px solid black;
				}
			</style>
			<div class="block-header">
				<h2>Invoice <small>Please use Google Chrome or any other Webkit browsers for better printing.</small></h2>
			</div>
			
			<div class="card">
				<br><br><br><br><br>
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
					<?php //echo isset($header->title)?'<center><h3>'.strtoupper($header->title).'</h3></center>':''; ?>
					<div class="row">
						<div class="col-xs-6">
							<h4>DATA CUSTOMER</h4>
						</div>
						<div class="col-xs-6">
							<div class="text-right"><h4>DATA INVOICE</h4></div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<table style="border:0;">
								<tr>
									<td style="text-align:right;">CUST ID </td>
									<td style="width:20px;text-align:center;"> : </td>
									<td><?php echo $cust->idcust; ?></td>
								</tr>
								<?php
								if(!empty($serv->servid)){
									?>
									<tr>
										<td style="text-align:right;">SERV ID </td>
										<td style="width:20px;text-align:center;"> : </td>
										<td><?php echo strtoupper($serv->servid); ?></td>
									</tr>
									<?php
								}
								?>
								<tr>
									<td style="text-align:right;">NAME </td>
									<td style="width:20px;text-align:center;"> : </td>
									<td><?php echo strtoupper($cust->nama); ?></td>
								</tr>
								<tr>
									<td style="text-align:right;">ADDRESS</td>
									<td style="width:20px;text-align:center;"> : </td>
									<td><?php echo $alamate.' '.$kotae; ?></td>
								</tr>
								<tr>
									<td style="text-align:right;">ATTENTION </td>
									<td style="width:30px;text-align:center;"> : </td>
									<td><?php echo $site->wakil; ?></td>
								</tr>
								<tr>
									<td style="text-align:right;">PHONE </td>
									<td style="width:30px;text-align:center;"> : </td>
									<td><?php echo $site->phone; ?></td>
								</tr>
							</table>
						</div>
						<div class="col-xs-6">
							<table style="border:0;width:100%;">
								<tr>
									<td style="text-align:right;">NO </td>
									<td style="width:20px;text-align:center;"> : </td>
									<td style="text-align:right;"><?php echo $arpost->nomor; ?></td>
								</tr>
								<tr>
									<td style="text-align:right;">NO BAA </td>
									<td style="width:20px;text-align:center;"> : </td>
									<td style="text-align:right;"><?php echo $header->baa; ?></td>
								</tr>
								<?php 
								if((!empty($arpost->label_tgl))AND($arpost->label_tgl!='0000-00-00')){
									// echo $this->Kamus_model->tanggal($arpost->label_tgl).'<br>';
									$ltgl = $arpost->label_tgl;
									$duedate = date("Y-m-d", strtotime($arpost->label_tgl." + 9 days"));
									// echo $this->Kamus_model->tanggal($duedate).'<br>';
								}else{
									// echo $this->Kamus_model->tanggal($arpost->tanggal).'<br>';
									$ltgl = $arpost->tanggal;
									$duedate = $arpost->due_date;
									// echo $this->Kamus_model->tanggal($arpost->due_date).'<br>';
								}
								?>
								<tr>
									<td style="text-align:right;">DATE</td>
									<td style="width:20px;text-align:center;"> : </td>
									<td style="text-align:right;"><?php echo $this->Kamus_model->tanggal_indo($ltgl,1); ?></td>
								</tr>
								<tr>
									<td style="text-align:right;">DUE DATE </td>
									<td style="width:30px;text-align:center;"> : </td>
									<td style="text-align:right;"><?php echo $this->Kamus_model->tanggal_indo($duedate,1); ?></td>
								</tr>
								<tr>
									<td style="text-align:right;">PERIODE </td>
									<td style="width:30px;text-align:center;"> : </td>
									<td style="text-align:right;"><?php echo $this->Kamus_model->tanggal_indo($arpost->periode_dari,1).' - '.$this->Kamus_model->tanggal_indo($arpost->periode_sampai,1); ?></td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<table class="table i-table m-t-10 m-b-10">
						<tbody>
							<tr class="t-uppercase">
								<td class="c-black">DESCRIPTION</td>
								<td class="c-black">NOTE</td>
								<td class="c-black" style="text-align:right;">TOTAL PRICE</td>
							</tr>
							<?php 
							$materai = $ppn = $total = 0;
							foreach($transaksi as $row){
								$label = $note = '';
								if($row->jenis_transaksi=='BR'){
									$total += $row->nominal;
									$label = 'Pembelian Barang';
								}else if($row->jenis_transaksi=='BJ'){
									$total += $row->nominal;
									$label = 'Pembelian Jasa';
								}else if($row->jenis_transaksi=='BX'){
									$total += $row->nominal;
									$label = 'Biaya Tambahan';
								}else if($row->jenis_transaksi=='DP' && $row->flag=='D'){
									$total += $row->nominal;
									$label = 'Down Payment';
								}else if($row->jenis_transaksi=='DP' && $row->flag=='C'){
									$total -= $row->nominal;
									$label = 'Down Payment';
								}else if($row->jenis_transaksi=='PDI'){
									$total -= $row->nominal;
									$label = 'Biaya Diskon Installasi';
								}else if($row->jenis_transaksi=='MB'){
									$materai = $row->nominal;
									$label = 'Biaya Materai';
									continue;
								}else if($row->jenis_transaksi=='MTDP'){
									$materai = $row->nominal;
									$label = 'Biaya Materai';
									continue;
								}else if($row->jenis_transaksi=='PN'){
									$ppn += $row->nominal;continue;
								}else if($row->jenis_transaksi=='DPN'){
									$ppn += $row->nominal;continue;
								}								
								if($row->nominal==0){continue;}
								if($arpost->label_barang=='1' and $row->jenis_transaksi=='BR'){
									echo '<tr>
											<td>
												<h5 class="f-400">'.(isset($arpost->label)?$arpost->label:"Pembelian Barang").'</h5>
											</td>
											<td>'.$note.'</td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row->nominal).',-</div></td>
										</tr>';
								}else if($arpost->label_barang=='2' and $row->jenis_transaksi=='BR'){
									foreach($brg as $row2){
										$getbrg = $this->Marketing_model->get_jenis_barang_id($row2->id_barang);
										echo '<tr>
												<td>
													<h5 class="f-400">'.$getbrg->nama_barang.'</h5>
												</td>
												<td>'.$row2->qty.' pc(s)</td>
												<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row2->harga*$row2->qty).',-</div></td>
											</tr>';
									}
								}else if($arpost->label_barang=='3' and $row->jenis_transaksi=='BR'){
									echo '<tr>
											<td>
												<h5 class="f-400">'.$arpost->label.'</h5>
											</td>
											<td>'.$note.'</td>
											<td style="vertical-align:middle;"></td>
										</tr>';
									foreach($brg as $row2){
										$getbrg = $this->Marketing_model->get_jenis_barang_id($row2->id_barang);
										echo '<tr>
												<td>
													<h5 class="f-400">- '.$getbrg->nama_barang.'</h5>
												</td>
												<td>'.$row2->qty.' pc(s)</td>
												<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row2->harga*$row2->qty).',-</div></td>
											</tr>';
									}
								// }else if($arpost->label_barang=='2' and $row->jenis_transaksi=='BJ'){
								}else if($row->jenis_transaksi=='BJ'){
									foreach($jasa as $row2){
										echo '<tr>
												<td>
													<h5 class="f-400">'.$row2->service.'</h5>
												</td>
												<td>'.$row2->qty.' pc(s)</td>
												<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row2->harga*$row2->qty).',-</div></td>
											</tr>';
									}
								}else if($row->jenis_transaksi=='DP' && $row->flag=='C'){
									echo '<tr>
											<td>
												<h5 class="f-400">Down Payment</h5>
											</td>
											<td> </td>
											<td style="vertical-align:middle;"><div class="text-right">(Rp '.$this->Kamus_model->uang($row->nominal).',-)</div></td>
										</tr>';
								}else if($row->jenis_transaksi=='DP' && $row->flag=='D'){
									echo '<tr>
											<td>
												<h5 class="f-400">Down Payment</h5>
											</td>
											<td> </td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row->nominal).',-</div></td>
										</tr>';
								}else if($row->jenis_transaksi=='PDI'){									
									echo '<tr>
											<td>
												<h5 class="f-400">Diskon Installasi</h5>
											</td>
											<td> </td>
											<td style="vertical-align:middle;"><div class="text-right">(Rp '.$this->Kamus_model->uang($row->nominal).',-)</div></td>
										</tr>';
								}else{
									echo '<tr>
											<td>
												<h5 class="f-400">'.$label.'</h5>
											</td>
											<td>'.$note.'</td>
											<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row->nominal).',-</div></td>
										</tr>';
								}
							}
							if($header->ppn==1){
								$ppn = $total * 0.1;
							}
							$grand = $total + $ppn + $materai;
							
							$rowspan = 2;
							if($ppn){
								$rowspan = 4;
							}
							?>
							<tr>
								<td style="vertical-align:bottom;" <?php echo 'rowspan="'.$rowspan.'"'; ?>>
									Terbilang : <b><h4 class="t-uppercase f-500"><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> RUPIAH</h4></b>
								</td>
								<td class="borderleft">
									<h5 class="t-uppercase f-400"><div class="text-right">AMOUNT</div></h5>
								</td>
								<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($total); ?>,-</div></td>
							</tr>
							<?php 
							if($ppn){
								?>
								<tr>
									<td>
										<h5 class="t-uppercase f-400"><div class="text-right">PPN</div></h5>
									</td>
									<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($ppn); ?>,-</div></td>
								</tr>
								<tr>
									<td>
										<h5 class="t-uppercase f-400"><div class="text-right">Materai</div></h5>
									</td>
									<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($materai); ?>,-</div></td>
								</tr>
								<?php
							}
							?>
							<tr>
								<td>
									<h5 class="t-uppercase f-400"><div class="text-right">TOTAL AMOUNT</div></h5>
								</td>
								<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($grand); ?>,-</div></td>
							</tr>
						</tbody>
					</table>
					
					<!--div class="clearfix"></div>
					
					<div class="row m-t-10 p-0 m-b-25">
						<div class="col-xs-12">
							<div class="bgm-blue brd-2 p-15">
								<center>
									<div class="c-white m-b-5">TERBILANG / IN WORDS</div>
									<h2 class="m-0 c-white f-300">## <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> ##</h2>
								</center>
							</div>
						</div>	
					</div-->
					<br>
					<div class="clearfix"></div>
					
					<div class="row">
						<?php 
						if($header->ppn==1 or $header->ppn==3){
							$bank = $this->Finance_model->get('ms_bank',2)->row();
						}else{
							$bank = $this->Finance_model->get('ms_bank',1)->row();
						}
						?>
						<div class="col-xs-6">
							<h4>Please make payment to :</h4>
							<div class="text-right">	
								<span class="text-muted">
									<center>
									<table style="border:0;">
										<tr>
											<td> Account Bank </td>
											<td style="text-align:center;" width="50px"> : </td>
											<td> Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?> </td>
										</tr>
										<tr>
											<td> Account No </td>
											<td style="text-align:center;"> : </td>
											<td> <?php echo $bank->rekening; ?> </td>
										</tr>
										<tr>
											<td> Account Name </td>
											<td style="text-align:center;"> : </td>
											<td> <?php echo $bank->an; ?> </td>
										</tr>
									</table>
									</center>
								</span>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="i-to">
							<h4>Note :</h4>
								<span class="text-muted">
									<address>
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
										<center><h5>Adhi Darminto<br>( General Manager )</h5></center>
									</div>
								</div>';							
						}else{
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
						}
					}
				?><hr>
				<!--footer class="p-20">
					<ul class="list-inline text-center list-unstyled">
						<li class="m-l-5 m-r-5"><small>www.gmedia.co.id</small></li>
					</ul>
				</footer-->
			</div>
			
		</div>
		
		<button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
		<a data-target-color="blue" href="#modalinvoice" style="right:100px" data-toggle="modal" class="btn btn-float bgm-teal m-btn" ><i class="zmdi zmdi-wrench"></i></a>
		<a href="javascript:history.back()" style="right:160px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>

	</section>
</section>