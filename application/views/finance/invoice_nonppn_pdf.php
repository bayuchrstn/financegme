<!-- CSS -->
<style>

.invoice{
	font: 400 14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;
}.table{width:100%;max-width:100%;margin-bottom:20px}.clearfix{content:"";display:table}.text-left{text-align:left}.text-right{text-align:right}.text-center{text-align:center}.text-justify{text-align:justify}.text-muted{color:#777}th{text-align:left}.bgm-blue{background-color:#2196f3!important}.p-0{padding:0!important}.p-5{padding:5px!important}.p-10{padding:10px!important}.p-15{padding:15px!important}.f-300{font-weight:300!important}.f-400{font-weight:400!important}.f-500{font-weight:500!important}.f-700{font-weight:700!important}address{margin-bottom:18px;font-style:normal;font-size:11px}.brd-2{border-radius:2px}.c-white{color:#fff!important}th,tr td{padding:5px}
.bgm-navy {
    background-color: #062C54 !important;
}

.navytd{
	background-color: #062C54 !important;	
	color				: white !important;
}
address,table{
	font-size:13px;
}
h5,h4{
	font-size:14px;
}
table{
	border-collapse: collapse;
    border-spacing: 0;
	border: 1px solid black;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	border-top: 1px solid black;padding : 5px;
}
.borderleft{
	border-left: 1px solid black;
}

@media print {
	.mutih{
		color				: white !important;
		font-weight: bold !important;
	}
}
</style>
<div class="invoice">
	<br>
	<?php 
	echo '<img class="i-logo" style="height:30px;" src="'.base_url().'assets/img/boxes.png" alt="">';
	?>
	<br><br><br>
	<div>
		<div style="width:50%;display:inline-block;">
			<b>CUSTOMER</b>
		</div>
		<div style="width:47%;display:inline-block;">
			<b>INVOICE</b>
		</div>
	</div><br>
	<div>
		<div style="width:47%;display:inline-block;margin-right:5px;border:1px solid black;border-radius:15px;padding-left:5px;padding-top:5px;padding-bottom:5px;min-height:140px;vertical-align: top;">
			<table style="border:0;width:100%;">
				<tr>
					<td width="25px"><b>NAME</b></td>
					<td width="5px" style="text-align:center;"> : </td>
					<td>
						<?php 
						if($header->name_display==1){
							echo strtoupper($cust->nama);
						}else if($header->name_display==2){
							echo strtoupper($site->nama);
						}else{
							echo strtoupper($cust->nama);
						}
						?>
					</td>
				</tr>
				<tr>
					<td><b>ADDRESS</b></td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $alamate.' '.$kotae; ?></td>
				</tr>
				<?php
				$att = $site->wakil;
				$att_phone = $site->phonewakil;
				if(!empty($contact)){
					$att = $contact->nama;
					$att_phone = $contact->phone;
				}
				?>
				<tr>
					<td><b>ATTENTION</b></td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $att; ?></td>
				</tr>
				<tr>
					<td><b>PHONE</b></td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $att_phone; ?></td>
				</tr>
			</table>
		</div>
		<div style="width:47%;margin-left:5px;border:1px solid black;border-radius:15px;padding-left:5px;padding-top:5px;padding-bottom:5px;min-height:140px;display:inline-block;vertical-align: top;">
			<table style="border:0;width:100%;">
				<tr>
					<td width="75px"><b>NO</b></td>
					<td width="5px" style="text-align:center;"> : </td>
					<td><?php echo $arpost->nomor; ?></td>
				</tr>
				
				<?php 
				if((!empty($arpost->label_tgl))AND($arpost->label_tgl!='0000-00-00')){
					// echo $this->Kamus_model->tanggal($arpost->label_tgl).'<br>';
					$ltgl = $arpost->label_tgl;
					$duedate = date("Y-m-d", strtotime($arpost->label_tgl." + 9 days"));
					// echo $this->Kamus_model->tanggal($duedate).'<br>';
				}else{
					// echo $this->Kamus_model->tanggal($arpost->tanggal).'<br>';
					$ltgl = $arpost->tanggal_invoice;
					$duedate = $arpost->due_date;
					// echo $this->Kamus_model->tanggal($arpost->due_date).'<br>';
				}
				?>
				<tr>
					<td><b>CUST ID</b></td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $cust->idcust; ?></td>
				</tr>
				<tr>
					<td><b>DATE</b></td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $this->Kamus_model->tanggal_indo($ltgl,1); ?></td>
				</tr>
				<tr>
					<td><b>DUE DATE</b> </td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $this->Kamus_model->tanggal_indo($duedate,1); ?></td>
				</tr>
				<tr>
					<td><b>PERIODE</b> </td>
					<td style="text-align:center;"> : </td>
					<td><?php echo $this->Kamus_model->tanggal_indo($arpost->periode_dari,1).' - '.$this->Kamus_model->tanggal_indo($arpost->periode_sampai,1); ?></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<table class="table i-table m-t-10 m-b-10">
		<tbody>
			<tr class="t-uppercase">
				<td rowspan="2" width="30px" class="navytd" style="vertical-align:middle;color:white;border-right: 1px solid white;font-weight: bold;text-align:center;">
						NO
				</td>
				<td colspan="2" width="300px" class="navytd" style="color:white;text-align:center;font-weight: bold;">DESCRIPTION</td>
				<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">SERVICE ID</td>
				<td rowspan="2" class="navytd" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">TOTAL PRICE</td>
			</tr>
			<tr class="t-uppercase">
				<td colspan="2" width="300px" class="navytd" style="color:white;text-align:center;border-top: 1px solid white;font-weight: bold;">BANDWIDTH</td>
				<!--td class="navytd" style="color:white;text-align:center;border-top: 1px solid white;border-left: 1px solid white;font-weight: bold;">DOWNTIME</td-->
			</tr>
		
		
			<?php 
			$biaya_langganan = 0;$cou=0;
			if($arpost->flag_dp==1){
				if($arpost->flag_installasi==1){
					$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','LG',trim($arpost->nomor),'D')->row();
					
					$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','PN',$arpost->nomor,'D')->row();
					$sum_tax2 = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DPN','','D')->row();
					
					$tr = $this->Finance_model->get_from_arr('transaksi',array('id_order'=>$arpost->id_order,'status'=>1,'nomor'=>trim($arpost->nomor)))->row();
					// print_r($tr);exit;
					$serv = $this->Finance_model->get('order_service',$tr->id_order_service)->row();
					// $serv = $this->Finance_model->get_from_arr('order_service',array('id_order'=>$arpost->id_order,'status'=>1))->row();
					// print_r($serv);exit;
					$lbl_serv = '';
					if($serv->id_serv){
						// $get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
						$get_serv = $this->Finance_model->get_from_arr('ms_layanan',array('id'=>$serv->id_serv))->row();
						$lbl_serv = $get_serv->label;
					}
					$cou = $cou + 1;
					echo '<tr>
							<td style="text-align:center;">'.$cou.'</td>
							<td style="text-align:center;border-left: 1px solid black;" colspan="2">
								<span class="f-400">'.$lbl_serv.' '.$arpost->label_note.'</span>
							</td>';
					echo '<td style="text-align:center;vertical-align:middle;border-left: 1px solid black;">'.$serv->servid.'</td>';
					echo '<td style="text-align:center;vertical-align:middle;border-left: 1px solid black;">Rp '.$this->Kamus_model->uang($sum_transaksi->total).'</td>
					</tr>';	
					
					echo '<tr>
							<td></td>';
					// if(!empty($arpost->label_note)){
						// echo '<td style="text-align:center;border-left: 1px solid black;" colspan="2">'.$arpost->label_note.'</td>';
					// }else{
						echo '<td style="text-align:center;border-left: 1px solid black;" colspan="2">'.$this->Kamus_model->tanggal_indo($arpost->periode_dari,1).' s.d. '.$this->Kamus_model->tanggal_indo($arpost->periode_sampai,1).'</td>';
					// }
					echo '<td style="border-left: 1px solid black;"></td>
						<td style="border-left: 1px solid black;"></td>
					</tr>';
					
					$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','LL',trim($arpost->nomor),'D')->row();
					$get_lain = $this->Finance_model->get_from_arr('order_lain', array('id_order'=>$arpost->id_order, 'status'=>1))->result();
					$sum_lain2 = $this->Finance_model->sum_lain($arpost->id_order)->row();
					// print_r($arpost->nomor);exit;
					if($sum_lain->total!=0){
						if((!empty($get_lain)) AND ($sum_lain2->jml==$sum_lain->total)){
							foreach($get_lain as $rowln){
								$cou = $cou + 1;
								echo '<tr>
										<td style="text-align:center;">'.$cou.'</td>
										<td style="text-align:center;border-left: 1px solid black;" colspan="2">
											<h5 class="f-400">'.$rowln->layanan.'</h5>
										</td>
										<td style="border-left: 1px solid black;"> </td>
										<td style="border-left: 1px solid black;text-align:center;">Rp '.$this->Kamus_model->uang($rowln->biaya).'</td>
								</tr>';
							}											
						}else{
							$cou = $cou + 1;
							echo '<tr>
									<td style="text-align:center;">'.$cou.'</td>
									<td style="text-align:center;border-left: 1px solid black;" colspan="2">
										<h5 class="f-400">Biaya Lain-lain</h5>
									</td>
									<td style="border-left: 1px solid black;"> </td>
									<td style="border-left: 1px solid black;vertical-align:middle;text-align:center;">Rp '.$this->Kamus_model->uang($sum_lain->total).'</td>
							</tr>';											
						}
					}
				}else{
					$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BIPN',trim($arpost->nomor),'D')->row();
				}
				
				$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BI',trim($arpost->nomor),'D')->row();
				if($sum_installasi->total!=0){
					$cou = $cou + 1;
					echo '<tr>
							<td style="text-align:center;">'.$cou.'</td>
							<td style="text-align:center;border-left: 1px solid black;" colspan="2">
								<h5 class="f-400">Biaya Installasi</h5>
							</td>
							<td style="border-left: 1px solid black;"> </td>
							<td style="border-left: 1px solid black;vertical-align:middle;text-align:center;">Rp '.$this->Kamus_model->uang($sum_installasi->total).'</td>
					</tr>';
				}
				
				$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DI',trim($arpost->nomor),'C')->row();
				if($sum_dinstallasi->total!=0){
					$cou = $cou + 1;
					echo '<tr>
							<td style="text-align:center;">'.$cou.'</td>
							<td style="text-align:center;border-left: 1px solid black;" colspan="2">
								<h5 class="f-400">Diskon Installasi</h5>
							</td>
							<td style="border-left: 1px solid black;"> </td>
							<td style="border-left: 1px solid black;vertical-align:middle;text-align:center;">(Rp '.$this->Kamus_model->uang($sum_dinstallasi->total).')</td>
					</tr>';
				}
				
				$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BRL',trim($arpost->nomor),'D')->row();
				$br=0;
				if($sum_relokasi->total!=0){
					$cou = $cou + 1;
					echo '<tr>
							<td style="text-align:center;">'.$cou.'</td>
							<td style="border-left: 1px solid black;text-align;" colspan="2">
								<h5 class="f-400">Biaya Relokasi</h5>
							</td>
							<td style="border-left: 1px solid black;"> </td>
							<td style="border-left: 1px solid black;vertical-align:middle;text-align:center;">Rp '.$this->Kamus_model->uang($sum_relokasi->total).'</td>
					</tr>';
					$br=$sum_relokasi->total;
				}
				
				$sub = (isset($sum_transaksi->total)?$sum_transaksi->total:0) + (isset($sum_lain->total)?$sum_lain->total:0) + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
				$taxe = $sum_tax->total - (isset($sum_tax2->total)?$sum_tax2->total:0);
								
				// $sub = $sum_transaksi->total + $sum_lain->total + ($sum_installasi->total - $sum_dinstallasi->total) + $br;
				// $taxe = $sum_tax->total - $sum_tax2->total;
			}else{
				// foreach($transaksi_dp as $row){
					$label = $note = '';								
					$total += $transaksi_dp->nominal;
					$label = 'Down Payment';
					if(!empty($arpost->label_note)){
						$note = $arpost->label_note;
					}
					$cou = $cou + 1;
					echo '<tr>
							<td style="text-align:center;">'.$cou.'</td>
							<td style="border-left: 1px solid black;text-align:center;" colspan="2">
								<h5 class="f-400">'.$label.'</h5>
							</td>
							<td style="text-align:center;border-left: 1px solid black;">'.$note.'</td>
							<td style="border-left: 1px solid black;vertical-align:middle;text-align:center;">Rp '.$this->Kamus_model->uang($transaksi_dp->nominal).'</td>
						</tr>';
				// }
				$sub = $transaksi_dp->nominal;
				$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DPN',trim($arpost->nomor),'D')->row();
				$taxe = $sum_tax->total;
			}
			
			$grand = $sub;
			$rowspan = 1;
			if($arpost->flag_dp==1){
				$sum_dp_min = $this->Finance_model->get_sum_transaksi($arpost->id_order,$arpost->tanggal,$arpost->tanggal,'DP','','D')->row();
				if($sum_dp_min->total!=0){
					$grand -= $sum_dp_min->total;
					$rowspan++;
				}
			}
			if($arpost->flag_dp==1){
				$rowspan++;
			}
			if($header->ppn==1 or $header->ppn==3){
				$grand += $taxe;
				$rowspan++;
			}
			$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MT',trim($arpost->nomor),'D')->row();
			if($sum_materai->total){
				$grand += $sum_materai->total;
				$rowspan++;
			}
			$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MTBI',trim($arpost->nomor),'D')->row();
			if($sum_materaibi->total){
				$grand += $sum_materaibi->total;
				$rowspan++;
			}
			$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MTDP',trim($arpost->nomor),'D')->row();
			if($sum_materai_dp->total){
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
			
			if($arpost->flag_dp==1){
				if($sum_dp_min->total!=0){
					echo '<tr>
							<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
							<td class="navytd" style="border-top: 1px solid white;text-align:center;">
								DP (-)
							</td>
							<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($sum_dp_min->total).'</td>
						</tr>';
				}								
			}
			
			if($header->ppn==1 or $header->ppn==3){
				echo '<tr>
						<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
						<td class="navytd" style="border-top: 1px solid white;text-align:center;">
							PPN (+)
						</td>
						<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($taxe).'</td>
					</tr>';	
				
			}
			
		
			if($sum_materai->total){
				echo '<tr>
						<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
						<td class="navytd" style="border-top: 1px solid white;text-align:center;">
							Materai (+)
						</td>
						<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($sum_materai->total).'</td>
					</tr>';								
			
			}
			
			if($sum_materaibi->total){
				echo '<tr>
						<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
						<td class="navytd" style="border-top: 1px solid white;text-align:center;">
							MATERAI (+)
						</td>
						<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($sum_materaibi->total).'</td>
					</tr>';								
			}
			
			if($sum_materai_dp->total){
				echo '<tr>
						<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
						<td class="navytd" style="border-top: 1px solid white;color:white;background-color:#062C54;text-align:center;">
							MATERAI (+)
						</td>
						<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($sum_materai_dp->total).'</td>
					</tr>';		
			}
				
			$mt = 0;
			if($site->mf==2){
				$mt = $sub * (2/100);
				$grand = $grand - $mt;
				echo '<tr>
					<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
					<td class="navytd" style="border-top: 1px solid white;text-align:center;border-left: 1px solid black;">
						MF
					</td>
					<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($mt).'</td>
				</tr>';
			}
			if($arpost->flag_dp==1){
				echo '<tr>
					<td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
					<td class="navytd" style="border-top: 1px solid white;text-align:center;border-left: 1px solid black;">
						TOTAL AMOUNT
					</td>
					<td class="navytd" style="text-align:center;border-top: 1px solid white;border-left: 1px solid white;vertical-align:middle;">Rp '.$this->Kamus_model->uang($grand).'</td>
				</tr>';
			}
			
			$grand2 = $grand;
			
			?>
			
		</tbody>
	</table>
	<div class="row m-t-10 p-0 m-b-25">
		<div class="col-xs-12">
			<div class="bgm-navy brd-2 p-15">
				<center>
					<div class="c-white m-b-5">TERBILANG / IN WORDS</div>
					<b class="m-0 c-white f-300">## <strong class="mutih"><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand2))); ?> RUPIAH</strong> ##</b>
				</center>
			</div>
		</div>	
	</div>
	<?php 
	if($header->nilai_voucher > 0){
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
		<?php
	}
	?>
	<div >
		<?php 
		if($header->ppn==1 or $header->ppn==3){
			$bank = $this->Finance_model->get('ms_bank',2)->row();
		}else{
			$bank = $this->Finance_model->get('ms_bank',1)->row();
		}
		?>
		<div style="width:90%;display:inline-block;">
				<h4>Please make payment to :</h4>
				<span class="text-muted">
					<small>
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
					</small>
				</span>	
				<h4>Note :</h4>
				<div class="text-justify">
					<span class="text-muted">
						<small>
							Please send your confirmation transfer payment to : Fax : 024-8509696 or email : finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance of payment <br>(Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)
						</small>
					</span>
				</div>
		</div>
	</div>
	<br>
	<div>
		<?php 
			if($arpost->periode_dari >= '2019-04-01'){
				$ff = 'Fernando Christian';
			}else{
				$ff = 'Andini Puti Maharani';
			}
			if($site->id_region==1){
				echo '<table style="border: 0;width:100%;">
						<tr>
							<td style="width:50%;"><center><b>Prepared by :</b></center></td>
							<td style="width:50%;"><center><b>Approved by :</b></center></td>
						</tr>
						<tr>
							<td><br><br></td>
							<td><br><br></td>
						</tr>
						<tr>
							<td><center><h5>'.$ff.'<br>( Finance Administration )</h5></center></td>
							<td><center><h5>Adhi Darminto<br>( General Manager )</h5></center></td>
						</tr>
					</table>';				
			}else{
				echo '<table style="border: 0;width:100%;">
						<tr>
							<td style="width:50%;"><center><b>Prepared by :</b></center></td>
							<td style="width:50%;"><center><b>Approved by :</b></center></td>
						</tr>
						<tr>
							<td><br><br></td>
							<td><br><br></td>
						</tr>
						<tr>
							<td><center><h5>'.$ff.'<br>( Finance Administration )</h5></center></td>
							<td><center><h5>Adhi Darminto<br>( General Manager )</h5></center></td>
						</tr>
					</table>';
			}
		?>
	</div>
	<!--hr>
	<footer class="p-10">
			<center><small><b>PT. Media Sarana Data</b> Jl. Jangli Dalam No. 29J Semarang, Phone : 024-8509595, Fax : 024-8509696, http://www.gmedia.net.id</small></center>
	</footer-->
</div>
