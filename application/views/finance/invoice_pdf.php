<!-- CSS -->
<style>.invoice{
	font: 400 14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;
.table{width:100%;max-width:100%;margin-bottom:20px}.clearfix{content:"";display:table}.text-left{text-align:left}.text-right{text-align:right}.text-center{text-align:center}.text-justify{text-align:justify}.text-muted{color:#777}th{text-align:left}.bgm-blue{background-color:#2196f3!important}.p-0{padding:0!important}.p-5{padding:5px!important}.p-10{padding:10px!important}.p-15{padding:15px!important}.f-300{font-weight:300!important}.f-400{font-weight:400!important}.f-500{font-weight:500!important}.f-700{font-weight:700!important}address{margin-bottom:18px;font-style:normal;font-size:14px}.brd-2{border-radius:2px}.c-white{color:#fff!important}th,tr td{padding:5px}

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	border-top: 1px solid black;
}
.borderleft{
	border-left: 1px solid black;
}
.borderright{
	border-right: 1px solid black;
}
.borderbottom{
	border-bottom: 1px solid black;
}
</style>
<div class="invoice">

	<div>
		<div style="width:50%;display:inline-block;">
			<h1><img class="i-logo" style="height:50px;" src="<?php echo base_url(); ?>assets/img/msd.png" alt=""></h1>
		</div>
		<div style="width:49%;display:inline-block;text-align:right;">
			<h1><b>INVOICE</b></h1>
		</div>
		<hr style="margin-top:0px;border:1px solid black;"> <br>
		<div style="width:80%;display:inline-block;">
			<h3>
				<b>To : 
				<?php 
				if($header->name_display==1){
					echo strtoupper($cust->nama);
				}else if($header->name_display==2){
					echo strtoupper($site->nama);
				}else{
					echo strtoupper($cust->nama);
				}
				?></b>
				</h3>
				<?php echo $alamate.' '.$kotae; ?>
		</div>
		<div style="width:19%;display:inline-block;vertical-align:top;">
			<div class="text-right"><h4><b>CUST. ID : <?php echo $cust->idcust; ?></b></h4></div>
		</div>
	</div>
	
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
	?><br><small>
	<table width="100%" class="table i-table m-t-10 m-b-10">
		<tbody>
			<tr class="t-uppercase">
				<td colspan="2" class="c-black" style="border-right:1px black solid;border-left:1px black solid;"><center>Invoice Number<br><?php echo $arpost->nomor; ?></center></td>
				<td colspan="3" class="c-black" style="border-right:1px black solid;"><center>Date<br><?php echo $this->Kamus_model->tanggal_indo($ltgl,1); ?></center></td>
				<td colspan="2"  style="border-right:1px black solid;" class="c-black"><center>Due Date<br><?php echo $this->Kamus_model->tanggal_indo($duedate,1); ?></center></td>
			</tr>
			<tr class="t-uppercase">
				<td style="border-left:1px white solid;" colspan="2"></td>
				<td colspan="3"></td>
				<td style="border-right:1px white solid;" colspan="2"></td>
			</tr>
		
			<tr class="t-uppercase">
				<td class="c-black" style="text-align:center;border-left:1px black solid;width:20px;"><b>NO</b></td>
				<td class="borderleft c-black" style="text-align:center;width:250px;"><b>DESCRIPTION</b></td>
				<td class="borderleft c-black" style="text-align:center;width:50px;"><b>SERVICE ID</b></td>
				<td class="borderleft c-black" style="text-align:center;width:30px;"><b>QTY</b></td>
				<td class="borderleft c-black" style="text-align:center;width:30px;"><b>CUR</b></td>
				<td class="borderleft c-black" style="text-align:center;"><b>UNIT PRICE</b></td>
				<td class="borderleft c-black" style="text-align:center;border-right:1px black solid;"><b>TOTAL PRICE</b></td>
			</tr>
		
		
			<?php 
			$no=$biaya_langganan = 0;
			if($arpost->flag_dp==1){
				if($arpost->flag_installasi==1){
					$sum_transaksi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','LG',$arpost->nomor,'D')->row();
					
					$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','PN',$arpost->nomor,'D')->row();
					$sum_tax2 = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DPN','','D')->row();
					
					$serv = $this->Finance_model->get_from_arr('order_service',array('id_order'=>$arpost->id_order,'status'=>1))->row();
					// print_r($sum_transaksi->id_order_service);exit;
					$lbl_serv = '';
					if($serv->id_serv){
						// $get_serv = $this->Finance_model->get('ms_layanan',$serv->id_serv)->row();
						$get_serv = $this->Finance_model->get_from_arr('ms_layanan',array('id'=>$serv->id_serv))->row();
						if(!empty($arpost->label_note)){
							$lbl_serv = $get_serv->label.' '.$arpost->label_note;
						}else{
							$lbl_serv = $get_serv->label;
						}
					}
					
					$lblperiode = '<br>Periode '.$this->Kamus_model->tanggal_indo($arpost->periode_dari,1).' s.d. '.$this->Kamus_model->tanggal_indo($arpost->periode_sampai,1);
					
					$no++;
					echo '<tr>
							<td style="text-align:center;border-left:1px black solid;">
								'.$no.'
							</td>
							<td class="borderleft">
								'.$lbl_serv.$lblperiode.'
							</td>
							<td class="borderleft" style="text-align:center;">
								'.strtoupper($serv->servid).'
							</td>
							<td class="borderleft" style="text-align:center;">
								1
							</td>
							<td class="borderleft" style="text-align:center;">
								IDR
							</td>
							<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_transaksi->total).'</span></td>
							<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_transaksi->total).'</span></td>
					</tr>';	
				
					$sum_lain = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','LL',$arpost->nomor,'D')->row();
					$get_lain = $this->Finance_model->get_from_arr('order_lain', array('id_order'=>$arpost->id_order, 'status'=>1))->result();
					$sum_lain2 = $this->Finance_model->sum_lain($arpost->id_order)->row();
					if($sum_lain->total!=0){
						if((!empty($get_lain)) AND ($sum_lain2->jml==$sum_lain->total)){
							foreach($get_lain as $rowln){
								$no++;
								echo '<tr>
										<td style="text-align:center;border-left:1px black solid;">
											'.$no.'
										</td>
										<td class="borderleft">
											'.$rowln->layanan.'
										</td>
										<td class="borderleft"> </td>
										<td class="borderleft" style="text-align:center;">
											1
										</td>
										<td class="borderleft" style="text-align:center;">
											IDR
										</td>
										<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($rowln->biaya).'</span></td>
										<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($rowln->biaya).'</span></td>
								</tr>';
							}											
						}else{
							$no++;
							echo '<tr>
									<td style="text-align:center;border-left:1px black solid;">
										'.$no.'
									</td>
									<td class="borderleft">
										Biaya Lain-lain
									</td>
									<td class="borderleft"> </td>
									<td class="borderleft" style="text-align:center;">
										1
									</td>
									<td class="borderleft" style="text-align:center;">
										IDR
									</td>
									<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_lain->total).'</span></td>
									<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_lain->total).'</span></td>
							</tr>';											
						}
					}
				}else{
					$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BIPN',$arpost->nomor,'D')->row();
				}
				
				$sum_installasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BI',$arpost->nomor,'D')->row();
				if($sum_installasi->total!=0){
					$no++;
					echo '<tr>
							<td style="text-align:center;border-left:1px black solid;">
								'.$no.'
							</td>
							<td class="borderleft">
								Biaya Installasi
							</td>
							<td class="borderleft"> </td>
							<td class="borderleft" style="text-align:center;">
								1
							</td>
							<td class="borderleft" style="text-align:center;">
								IDR
							</td>
							<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_installasi->total).'</span></td>
							<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_installasi->total).'</span></td>
					</tr>';
				}
				
				$sum_dinstallasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DI',$arpost->nomor,'C')->row();
				if($sum_dinstallasi->total!=0){
					$no++;
					echo '<tr>
							<td style="text-align:center;border-left:1px black solid;">
								'.$no.'
							</td>
							<td class="borderleft">
								Diskon Installasi
							</td>
							<td class="borderleft"> </td>
							<td class="borderleft" style="text-align:center;">
								1
							</td>
							<td class="borderleft" style="text-align:center;">
								IDR
							</td>
							<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">(Rp '.$this->Kamus_model->uang($sum_dinstallasi->total).')</span></td>
							<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">(Rp '.$this->Kamus_model->uang($sum_dinstallasi->total).')</span></td>
					</tr>';
				}
				
				$sum_relokasi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','BRL',$arpost->nomor,'D')->row();
				$br=0;
				if($sum_relokasi->total!=0){
					$no++;
					echo '<tr>
							<td style="text-align:center;border-left:1px black solid;">
								'.$no.'
							</td>
							<td class="borderleft">
								Biaya Relokasi
							</td>
							<td class="borderleft"> </td>
							<td class="borderleft" style="text-align:center;">
								1
							</td>
							<td class="borderleft" style="text-align:center;">
								IDR
							</td>
							<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_relokasi->total).'</span></td>
							<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">Rp '.$this->Kamus_model->uang($sum_relokasi->total).'</span></td>
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
					$no++;
					echo '<tr>
							<td style="text-align:center;border-left:1px black solid;">
								'.$no.'
							</td>
							<td class="borderleft">
								'.$label.'
							</td>
							<td>'.$note.'</td>
							<td class="borderleft" style="text-align:center;">
								1
							</td>
							<td class="borderleft" style="text-align:center;">
								IDR
							</td>
							<td class="borderleft" style="vertical-align:middle;"><span class="text-right" style="float: right;">Rp  '.$this->Kamus_model->uang($transaksi_dp->nominal).'</span></td>
							<td class="borderleft" style="vertical-align:middle;border-right:1px black solid;"><span class="text-right" style="float: right;">Rp  '.$this->Kamus_model->uang($transaksi_dp->nominal).'</span></td>
						</tr>';
				// }
				$sub = $transaksi_dp->nominal;
				$sum_tax = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','DPN',$arpost->nomor,'D')->row();
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
			
			$grand += $taxe;
			$rowspan++;
			
			$materei = 3000;
			if($grand >= 1000000){
				$materei = 6000;
			}
			// $grand += $materei;
			
			$get_lg = $this->Finance_model->get_transaksi('','',$arpost->nomor,'','','','',$arpost->id_order,'LG')->row();
			$get_materei = $this->Finance_model->get_transaksi('','',$arpost->nomor,'','','','',$arpost->id_order,'MT')->row();
			if(empty($get_materei)){
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
			}else{	
				$this->Marketing_model->update('transaksi',array('nominal'=>$materei),$get_materei->id);
			}
			$sum_materai = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MT',$arpost->nomor,'D')->row();
			if($sum_materai->total){
				$grand += $sum_materai->total;
				$rowspan++;
			}
			/////////////////////////////

			$get_materei_bi = $this->Finance_model->get_transaksi('','',$arpost->nomor,'','','','',$arpost->id_order,'MTBI')->row();
			if(empty($get_materei_bi)){
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
			}else{	
				$this->Marketing_model->update('transaksi',array('nominal'=>$materei),$get_materei_bi->id);
			}
			$sum_materaibi = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MTBI',$arpost->nomor,'D')->row();
			if($sum_materaibi->total){
				$grand += $sum_materaibi->total;
				$rowspan++;
			}
			/////////////////////////
			
			$get_materei_dp = $this->Finance_model->get_transaksi('','',$arpost->nomor,'','','','',$arpost->id_order,'MTDP')->row();
			if(empty($get_materei_dp)){
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
			}else{	
				$this->Marketing_model->update('transaksi',array('nominal'=>$materei),$get_materei_dp->id);
			}
			$sum_materai_dp = $this->Finance_model->get_sum_transaksi($arpost->id_order,'','','MTDP',$arpost->nomor,'D')->row();
			if($sum_materai_dp->total){
				$grand += $sum_materai_dp->total;
				$rowspan++;
			}
			?>
			<tr>
				<td colspan="5" style="vertical-align:bottom;border-left:1px black solid;border-bottom:1px black solid;" <?php echo 'rowspan="'.$rowspan.'"'; ?>>
					<b>Terbilang / In Words </b>: <b><h4 class="t-uppercase f-500"><b># <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> RUPIAH #</b></h4></b>
				</td>
				<td class="borderleft" style="text-align:center;">
					<b>Amount</b>
				</td>
				<td class="borderleft borderright" style="vertical-align:middle;"><span class="text-right" style="float: right;"><b>Rp <?php echo $this->Kamus_model->uang($sub); ?></b></span></td>
			</tr>
			<?php
			
			if($arpost->flag_dp==1){
				if($sum_dp_min->total!=0){
					echo '<tr>
							<td class="borderleft" style="text-align:center;">
								<b>DP (-)</b>
							</td>
							<td class="borderleft borderright" style="vertical-align:middle;"><span class="text-right" style="float: right;"><b>Rp '.$this->Kamus_model->uang($sum_dp_min->total).'</b></span></td>
						</tr>';						
				}								
			}
			
			if($header->ppn==1 or $header->ppn==3){
				echo '<tr>
						<td class="borderleft" style="text-align:center;">
							<b>PPN </b>
						</td>
						<td class="borderleft borderright" style="vertical-align:middle;"><span class="text-right" style="float: right;"><b>Rp '.$this->Kamus_model->uang($taxe).'</b></span></td>
					</tr>';	
				
			}
			
			if($sum_materai->total){
				echo '<tr>
						<td class="borderleft" style="text-align:center;">
							<b>Stamp Duty Fee</b>
						</td>
						<td class="borderleft borderright" style="vertical-align:middle;"><span class="text-right" style="float: right;"><b>Rp '.$this->Kamus_model->uang($sum_materai->total).'</b></span></td>
					</tr>';						
			}
			
			if($sum_materaibi->total){
				echo '<tr>
						<td class="borderleft" style="text-align:center;">
							<b>Stamp Duty Fee</b>
						</td>
						<td class="borderleft borderright" style="vertical-align:middle;"><span class="text-right" style="float: right;"><b>Rp '.$this->Kamus_model->uang($sum_materaibi->total).'</b></span></td>
					</tr>';							
			}
			
			if($sum_materai_dp->total){
				echo '<tr>
						<td class="borderleft" style="text-align:center;">
							<b>Stamp Duty Fee</b>
						</td>
						<td class="borderleft borderright" style="vertical-align:middle;"><span class="text-right" style="float: right;"><b>Rp '.$this->Kamus_model->uang($sum_materai_dp->total).'</b></span></td>
					</tr>';							
			}
				
			if($arpost->flag_dp==1){
				echo '<tr>
					<td class="borderleft borderbottom" style="text-align:center;">
						<b>Pay This Amount</b>
					</td>
					<td class="borderleft borderright borderbottom" style="vertical-align:middle;"> <span class="text-right" style="float: right;"><b>Rp '.$this->Kamus_model->uang($grand).'</b></span></td>
				</tr>';
			}
			
			$grand2 = $grand;
			
			?>
			
		</tbody>
	</table></small>
	
	<div >
		<small>
		<?php 
		$bank = $this->Finance_model->get('ms_bank',2)->row();
		?>
		<div style="width:99%;display:inline-block;">
				<h4>Please make payment to : </h4>
				
					<b> Account Bank : Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?></b> <br>
					<b> Account Name : <?php echo $bank->an; ?></b> <br>
					<b> Account No : <?php echo $bank->rekening; ?></b> <br>
					<br>	
				<div class="i-to">
					<div class="text-justify">
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
		</div></small>
	</div>
	<div>
		<?php 
			echo '<table style="border: 0;width:100%;">
					<tr>
						<td style="width:100%;"><center>Approved by :</center></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td><center><h5>Priyo Suyono<br>( Operational Director )<br>www.Gmedia.co.id</h5></center></td>
					</tr>
				</table>';
		?>
	</div>
</div>
