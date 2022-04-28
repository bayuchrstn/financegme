<!-- CSS -->
<style>.invoice,.table{width:100%;max-width:100%;margin-bottom:20px}.clearfix{content:"";display:table}.text-left{text-align:left}.text-right{text-align:right}.text-center{text-align:center}.text-justify{text-align:justify}.text-muted{color:#777}th{text-align:left}.bgm-blue{background-color:#2196f3!important}.p-0{padding:0!important}.p-5{padding:5px!important}.p-10{padding:10px!important}.p-15{padding:15px!important}.f-300{font-weight:300!important}.f-400{font-weight:400!important}.f-500{font-weight:500!important}.f-700{font-weight:700!important}address{margin-bottom:18px;font-style:normal;font-size:14px}.brd-2{border-radius:2px}.c-white{color:#fff!important}th,tr td{padding:5px}
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
<div class="invoice">
	<?php 
	if($header->ppn==1 or $header->ppn==3){
		echo '<center><img class="i-logo" style="height:50px;" src="'.base_url().'assets/img/msd.png" alt=""></center>';
	}else{
		echo '<center><img class="i-logo" style="height:50px;" src="'.base_url().'assets/img/boxes.png" alt=""></center>';
	}
	?><br>
	<div>
		<div style="width:49%;display:inline-block;">
			<h4>DATA CUSTOMER</h4>
		</div>
		<div style="width:50%;display:inline-block;text-align:right;">
			<h4>DATA INVOICE</h4>
		</div>
	</div>
	<div>
		<div style="width:48%;display:inline-block;">
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
		<div style="width:50%;display:inline-block;">
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
	<br>
	<table class="table">
		<thead class="t-uppercase">
			<tr>
				<th class="c-gray">DESCRIPTION</th>
				<th class="c-gray">NOTE</th>
				<th class="c-gray">TOTAL PRICE</th>
			</tr>
		</thead>
		
		<tbody>
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
								<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row2->harga).',-</div></td>
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
								<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row2->harga).',-</div></td>
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
								<td style="vertical-align:middle;"><div class="text-right">Rp '.$this->Kamus_model->uang($row2->harga).',-</div></td>
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
					Terbilang : <h4 class="t-uppercase f-500"><b><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> RUPIAH</b></h4>
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
					<td class="borderleft">
						<h5 class="t-uppercase f-400"><div class="text-right">PPN</div></h5>
					</td>
					<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($ppn); ?>,-</div></td>
				</tr>
				<tr>
					<td class="borderleft">
						<h5 class="t-uppercase f-400"><div class="text-right">Materai</div></h5>
					</td>
					<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($materai); ?>,-</div></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td class="borderleft">
					<h5 class="t-uppercase f-400"><div class="text-right">TOTAL AMOUNT</div></h5>
				</td>
				<td style="vertical-align:middle;"><div class="text-right">Rp <?php echo $this->Kamus_model->uang($grand); ?>,-</div></td>
			</tr>
		</tbody>
	</table>
	
	<!--div class="row m-t-10 p-0 m-b-5">
		<div style="width:100%;" class="col-xs-12">
			<div class="bgm-blue brd-2 p-15">
				<center>
					<div class="c-white">TERBILANG / IN WORDS</div>
					<b class="c-white">## <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?> ##</b>
				</center>
			</div>
		</div>	
	</div-->
	
	<div>
		<?php 
		if($header->ppn==1 or $header->ppn==3){
			$bank = $this->Finance_model->get('ms_bank',2)->row();
		}else{
			$bank = $this->Finance_model->get('ms_bank',1)->row();
		}
		?>
		<div style="width:45%;display:inline-block;">
			<h4>Please make payment to :</h4>
			<span class="text-muted">
				<small>
					Account Bank : Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?><br>
					Account No : <?php echo $bank->rekening; ?><br>
					Account Name : <?php echo $bank->an; ?><br>
				</small>
			</span>			
		</div>
		<div style="width:50%;display:inline-block;">
			<div class="i-to">
				<h4>Note :</h4>
				<div class="text-justify">
					<span class="text-muted">
							<small>
							<?php 
							if($header->note){
								echo $header->note.'<br><br>';
							}
							?>
							Please send your confirmation transfer payment to : <br>Fax : 024-8509696 or email : finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance of payment (Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)</small>
					</span>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div>
		<?php 
		if($header->ppn==1 or $header->ppn==3){
			echo '<table style="border: 0;width:100%;">
					<tr>
						<td style="width:100%;"><center>Approved by :</center></td>
					</tr>
					<tr>
						<td><br><br><br></td>
					</tr>
					<tr>
						<td><center><h5>Priyo Suyono<br>( Operational Director )</h5></center></td>
					</tr>
				</table>';
		}else{
			$fin = '';
			if($cust->id_region==1){$fin = 'Andini Puti Maharani';}else if($cust->id_region==2){$fin = 'Andini Puti Maharani';}
			echo '<table style="border: 0;width:100%;">
					<tr>
						<td style="width:50%;"><center>Prepared by :</center></td>
						<td style="width:50%;"><center>Approved by :</center></td>
					</tr>
					<tr>
						<td><br><br><br></td>
						<td><br><br><br></td>
					</tr>
					<tr>
						<td><center><h5>'.$fin.'<br>( Finance Administration )</h5></center></td>
						<td><center><h5>Adhi Darminto<br>( General Manager )</h5></center></td>
					</tr>
				</table>';
		}
		?>
	</div>
	<hr>
	<footer class="p-10">
		<center><small>SEMARANG OFFICE<br>Jl. Jangli Dalam No. 29 J Semarang - Jawa Tengah 50254<br>Telp. 024 - 850 9595, Fax. 024 - 850 9696<br>Email info.smg@gmedia.co.id</small></center>
	</footer>
</div>