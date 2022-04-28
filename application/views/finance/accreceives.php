
	<section id="content">
		<div class="container">
            
			<div class="card">
				
				<div class="card-header bgm-bluegray ch-alt m-b-25">
					<center><h2> <?php echo isset($icon)?'<i class="'.$icon.'"></i>':''; ?> <?php echo strtoupper($title); ?> <small> <?php //echo $titlenote; ?></small></h2></center>
					<div id="btn-color-targets">
						<?php echo isset($button)?$button:'';?>
					</div>
				</div>
				
				<div class="card-body card-padding">
					
					<input id="dari" type="hidden" value="<?php echo isset($dari)?$dari:''; ?>">
					<input id="sampai" type="hidden" value="<?php echo isset($sampai)?$sampai:''; ?>">
					
					<div style="margin-top:-25px;" class="alert alert-warning alert-dismissible" role="alert">
					   <b><center><i class="zmdi zmdi-filter-list"></i> <?php echo isset($titlenote)?strtoupper($titlenote):''; ?></center></b>
					</div>
					<?php 
						$flashmessage   = $this->session->flashdata('message');
						$notifikasi     = $this->session->flashdata('notifikasi');
						echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
					?>
					<?php if(!empty($grand)){echo $grand;} ?>
					
					<div class="table-responsive">
						<?php echo $table; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
<div class="modal fade" id="modalkartupiutang" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">FILTER DATA</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<?php 
						echo form_dropdown('id_client', $option_client, (isset($id_client)?$id_client:''), 'class="tag-select" id="id_client_kp"');
						?>
					</div>
					<div class="col-sm-4">
						<?php 
						echo form_dropdown('ppn', array('0'=>'Pilih PPn', '1'=>'PPn','3'=>'Non-PPn'), isset($ppn)?$ppn:'', 'class="tag-select" id="ppnflag4"');
						?>
					</div>
					<div class="col-sm-6" id="invoice_nest">
						<?php echo (isset($opt_invoice)?$opt_invoice:''); ?>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tdari_kp" value="<?php echo isset($dari)?$dari:''; ?>" class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tsampai_kp" value="<?php echo isset($sampai)?$sampai:''; ?>" class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="<?php echo (isset($filter_ok)?$filter_ok:'filter_ar'); ?>">Save changes</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Email Billing dan Biaya Materai</h4>
			</div>
			<form action="<?php echo base_url(); ?>finance/edit_materai_proses" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4">
							<p class="c-black f-500 m-b-5 m-t-20">NPWP</p>
							<div class="input-group">
								<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="col-sm-12">
									<div class="fg-line">    
										<input name="npwp" id="npwpe" type="text" class="form-control"></input>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<p class="c-black f-500 m-b-5 m-t-20">Email Billing</p>
							<div class="input-group">
								<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="col-sm-12">
									<div class="fg-line">    
										<input value="" type="hidden" name="id_order" id="id_order_materai">
										<input value="" type="hidden" name="id_site" id="id_site_materai">
										<input name="email_billing" id="email_billing" type="text" class="form-control" value=""></input>
									</div>
								</div>
							</div>
						</div>
					</div><hr>
					<div class="row">
						<div class="col-sm-4">
							<p class="c-black f-500 m-b-5 m-t-20">Materai</p>
							<div class="input-group">
								<span class="input-group-addon"><i class="zmdi zmdi-format-subject"></i></span>
								<div class="col-sm-12">
									<div class="fg-line">    
										<?php 
										echo form_dropdown('materai', array('1'=>'Tanpa Materai','2'=>'Pakai Materai'), '', 'class="tag-select" id="materai"');
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<p class="c-black f-500 m-b-5 m-t-20">Terapkan Mulai</p>
							<div class="input-group">
								<span class="input-group-addon"><i class="zmdi zmdi-format-subject"></i></span>
								<div class="col-sm-12">
									<div class="fg-line">    
										
										<input type="text" name="start" value="<?php echo date('Y-m-d'); ?>" class="form-control date-picker">
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<p class="c-black f-500 m-b-5 m-t-20">Invoice Installasi</p>
							<div class="input-group">
								<span class="input-group-addon"><i class="zmdi zmdi-format-subject"></i></span>
								<div class="col-sm-12">
									<div class="fg-line">    
										<?php 
										echo form_dropdown('installasi', array('1'=>'Gabung Invoice','2'=>'Pisah invoice'), '', 'class="tag-select" id="installasi"');
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-link">Save changes</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade"  id="modalFilter" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter Data</h4><small>Tentukan parameter</small>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">                       
						<div class="input-group">
							<span class="input-group-addon">Pilih Client : </span>
							<div class="fg-line">
								<?php
									echo form_dropdown('id_site', $option_company, $id_site, 'id="id_site" class="tag-select"');
								?>
								<span class="help-block"><font color="red"><?php echo form_error('nama'); ?></font></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tdari" value="<?php echo $dari; ?>" class="form-control date-picker" placeholder="Periode Awal">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tsampai" value="<?php echo $sampai; ?>" class="form-control date-picker" placeholder="Periode Akhir">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('id_region', $opt_region, isset($region)?$region:'', 'class="tag-select" id="id_region"');
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('ppn', array('0'=>'Pilih PPn', '1'=>'PPn','3'=>'Non-PPn'), isset($ppnflag)?$ppnflag:'', 'class="tag-select" id="ppnflag"');
								?>
							</div>
						</div>
					</div>
					<?php 
					if($title=='LIST PIUTANG SALES ORDER'){
						?>
					<div class="col-sm-4">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('pph', array('0'=>'Pilih PPh', '1'=>'Belum Bayar','3'=>'Sudah Bayar'), isset($pphflag)?$pphflag:'', 'class="tag-select" id="pphflag"');
								?>
							</div>
						</div>
					</div>
					<?php 
					}
					?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="<?php echo (isset($filter_ok)?$filter_ok:'filter_ar'); ?>">Save changes</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalFilter2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter Data</h4><small>Tentukan parameter</small>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('id_region', $opt_region, isset($region)?$region:'', 'class="tag-select" id="id_region3"');
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('ppn', array('0'=>'Pilih PPn', '1'=>'PPn','3'=>'Non-PPn'), isset($ppnflag)?$ppnflag:'', 'class="tag-select" id="ppnflag3"');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="<?php echo (isset($filter_ok)?$filter_ok:'filter_ar'); ?>">Save changes</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalFilterAkun" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter Data</h4><small>Tentukan parameter</small>
			</div>
			<form action="<?php echo isset($action)?$action:'';?>" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">                       
							<div class="input-group">
								<span class="input-group-addon">Start : </span>
								<div class="fg-line">
									<input type="text" name="start" value="<?php echo isset($start)?$start:''; ?>" class="form-control date-picker" placeholder="Click here...">
									<?php 
									//echo form_dropdown('bulan', $opt_bulan, isset($bulan)?$bulan:'', 'class="tag-select" id="bulan"');
									?>
									<span class="help-block"><font color="red"><?php echo form_error('nama'); ?></font></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="input-group form-group">
								<span class="input-group-addon">End : </span>
									<div class="dtp-container fg-line">
									<input type="text" name="end" value="<?php echo isset($end)?$end:''; ?>" class="form-control date-picker" placeholder="Click here...">
									<!--input name="tahun" required type="number" id="tahun" value="<?php //echo isset($tahun)?$tahun:date('Y'); ?>" class="form-control"-->
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="input-group form-group">
								<span class="input-group-addon">Akun : </span>
									<div class="dtp-container fg-line">
									<?php 
									echo form_dropdown('akun', $opt_bank, isset($akun)?$akun:'', 'class="tag-select" id="akun"');
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-link">Submit</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalFilterDate" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter Data</h4><small>Tentukan parameter</small>
			</div>
			<form action="<?php echo isset($action)?$action:'';?>" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">                       
							<div class="input-group">
								<span class="input-group-addon">Bulan : </span>
								<div class="fg-line">
									<?php 
									echo form_dropdown('bulan', $opt_bulan, isset($bulan)?$bulan:'', 'class="tag-select" id="bulan"');
									?>
									<span class="help-block"><font color="red"><?php echo form_error('nama'); ?></font></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10">
							<div class="input-group form-group">
								<span class="input-group-addon">Tahun : </span>
									<div class="dtp-container fg-line">
									<input name="tahun" required type="number" id="tahun" value="<?php echo isset($tahun)?$tahun:date('Y'); ?>" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-link">Submit</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modalFilterDate2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tentukan Periode Data</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="hidden" id="menu" value="<?php echo isset($notef)?$notef:''; ?>">
								<input type="text" id="seko" value="<?php echo isset($date)?$date:''; ?>" class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="nganti" value="<?php echo isset($date2)?$date2:''; ?>"  class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group form-group">
							<span class="input-group-addon">Profit Center : </span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('pcenter', array('0'=>'Pilih','3'=>'Semarang', '5'=>'Salatiga'), isset($pcent)?$pcent:'0', 'class="tag-select" id="pcent"');
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group form-group">
							<span class="input-group-addon">Akun : </span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('akun', $opt_bank, isset($akun)?$akun:'', 'class="tag-select" id="akun2"');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="filter_<?php echo $flag; ?>">Save changes</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalFilterDate3" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tentukan Periode Data</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="seko2" value="<?php echo isset($date)?$date:''; ?>" class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="nganti2" value="<?php echo isset($date2)?$date2:''; ?>"  class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group form-group">
							<span class="input-group-addon">Profit Center : </span>
								<div class="dtp-container fg-line">
								<?php 
								$opt_cabang = $this->Finance_model->get_options_region();
								echo form_dropdown('pcenter', $opt_cabang, isset($pcent)?$pcent:'0', 'class="tag-select" id="pcent2"');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="filter_<?php echo $flag; ?>">Save changes</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalColor" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter Data</h4><small>Tentukan parameter</small>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">                       
						<div class="input-group">
							<span class="input-group-addon">Pilih Client : </span>
							<div class="fg-line">
								<?php
									echo form_dropdown('id_site', $option_company, isset($id_site)?$id_site:'', 'id="id_site2" class="tag-select"');
								?>
								<span class="help-block"><font color="red"><?php echo form_error('nama'); ?></font></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tdari2" class="form-control date-picker" placeholder="Periode Awal">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tsampai2"  class="form-control date-picker" placeholder="Periode Akhir">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
								<div class="dtp-container fg-line">
								<?php 
								echo form_dropdown('id_region', $opt_region, isset($region)?$region:'', 'class="tag-select" id="id_region2"');
								?>
							</div>
						</div>
					</div>
					
						<div class="col-sm-6">
							<div class="input-group form-group">
								<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
									<div class="dtp-container fg-line">
									<?php 
									echo form_dropdown('ppn', array('0'=>'Pilih PPn', '1'=>'PPn','3'=>'Non-PPn'), isset($ppnflag)?$ppnflag:'', 'class="tag-select" id="ppnflag2"');
									?>
								</div>
							</div>
						</div>
						
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="<?php echo (isset($filter_ok)?$filter_ok:'filter_ar'); ?>">Save changes</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalCari" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cari Bukti Pembayaran</h4>
			</div>
			<form action="<?php echo base_url(); ?>Finance/view_tandaterima" method="POST">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">                       
						<div class="input-group">
							<span class="input-group-addon">Pilih Nomor : </span>
							<div class="fg-line">
								<?php
									echo form_dropdown('id_bukti', $option_bukti, '', 'class="tag-select"');
								?>
								<span class="help-block"><font color="red"><?php echo form_error('id_bukti'); ?></font></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" target="_blank" class="btn btn-link">Open</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalCariAP" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cari Nomor Bukti</h4>
			</div>
			<form action="<?php echo base_url(); ?>Akuntansi/jurnal/<?php echo isset($menu)?$menu:''; ?>" method="POST">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">                       
						<div class="input-group">
							<span class="input-group-addon">Masukkan Nomor : </span>
							<div class="fg-line">
								<input name="key" type="text" class="form-control" value="<?php echo isset($key)?$key:''; ?>" type="text">
								<span class="help-block"><font color="red"><?php echo form_error('id_bukti'); ?></font></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" target="_blank" class="btn btn-link">Search</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>
 <!-- Modal Small -->	
<div class="modal fade" id="modalNarrower" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="zmdi zmdi-calendar"></i> Generate Invoice</h4><small>Tentukan Periode</small>
			</div>
			<form action="<?php echo base_url();?>finance/generate_invoice" method="POST">
				<div class="modal-body">
					<?php
						echo form_dropdown('bulan', array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'), date('m'), 'class="selectpicker"');
					?>
					<br><br>
					<div class="form-group">
						<div class="fg-line">
							<input name="tahun" type="number" min="2015" class="form-control" value="<?php echo date('Y'); ?>" type="text">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn bgm-blue"><i class="zmdi zmdi-refresh-sync"></i> GENERATE</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade"  id="modalMerge" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Gabung Invoice</h4><small>Tentukan alamat pengiriman dan tipe penggabungannya</small>
			</div>
			<form action="<?php echo base_url();?>finance/merge_invoice" method="POST">
				<div class="modal-body">
					<input id="input_val" name="input_val" type="hidden">
					<p class="c-black f-500 m-b-20 m-t-20">Pilih alamat pengiriman invoice</p>
					<div id="list_site"></div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							<div class="input-group form-group">
								<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
									<div class="dtp-container fg-line">
									<?php
										echo form_dropdown('tipe', array("1"=>"Gabung dan jadikan satu lembar","2"=>"Gabung dan pecah menjadi beberapa invoice"), '', 'id="tipe" class="tag-select"');
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="date_merge">
						<div class="col-sm-6">
							<p class="c-black f-500 m-b-20">Periode dari</p>
							<div class="input-group form-group">
								<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
									<div class="dtp-container fg-line">
									<input type="text" required id="dari_merge" name="dari" class="form-control date-picker" placeholder="Periode Awal">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<p class="c-black f-500 m-b-20">Periode sampai</p>
							<div class="input-group form-group">
								<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
									<div class="dtp-container fg-line">
									<input type="text" required id="sampai_merge"  name="sampai"  class="form-control date-picker" placeholder="Periode Akhir">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-link">Submit</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Large -->	
<div style="display:none;"><a id="fire_modal" data-toggle="modal" href="arsenal.html#modalWider" ></a></div>
<div class="modal fade" id="modalWider" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="zmdi zmdi-shopping-basket"></i> VIEW DATA</h4>
			</div>
			<div class="modal-body">
				<div id="modal_content"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div style="display:none;"><a id="kasbon_modal" data-toggle="modal" href="arsenal.html#modalKasbon" ></a></div>
<div class="modal fade" id="modalKasbon" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="zmdi zmdi-shopping-basket"></i> REALISASI</h4>
			</div>
			<form method="POST" action="<?php echo base_url(); ?>akuntansi/proses_realisasi">
				<input type="hidden" name="id" id="id_kasbon">
				<div class="modal-body">
					<div id="modal_content_kasbon">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group form-group">
									<span class="input-group-addon">Sumber Kas : </span>
										<div class="dtp-container fg-line">
										<?php 
										echo form_dropdown('akun', $opt_bank, '', 'class="tag-select"');
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group form-group">
									<span class="input-group-addon">Akun : </span>
										<div class="dtp-container fg-line">
										<?php 
										echo form_dropdown('akun_d', $opt_akun, '', 'class="tag-select"');
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="dtp-container fg-line">
										<input type="text" name="date" required id="date_realisasi" class="form-control date-picker" placeholder="Tanggal Realisasi" value="<?php echo date('Y-m-d'); ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="dtp-container fg-line">
										<input type="text" required name="nominal" id="nominal_realisasi" class="form-control" placeholder="Realisasi">
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
		<footer id="footer">
            
            <ul class="f-menu">
                <li><a href="<?php echo base_url(); ?>marketing/home">Marketing</a></li>
				<li><a href="<?php echo base_url(); ?>finance/home">Finance</a></li>
            </ul>
            Copyright &copy; 2016 GMedia
        </footer>
        
        <!-- Javascript Libraries -->
        <script src="<?php echo base_url();?>assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="<?php echo base_url();?>assets/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendors/bower_components/summernote/dist/summernote.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/chosen_v1.4.2/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tooltipster.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/functions.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.uikit.min.js"></script>
		<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
		
        <!--script src="<?php //echo base_url();?>assets/js/demo.js"></script-->
		<script type="text/javascript">
		$(document).ready(function(){
			// var table = $('#example').DataTable();
			var table = $('#example').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5'
				]
			} );
			var table2 = $('#example_select').DataTable( {
				"iDisplayLength": 10,
				"aLengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
				dom: 'lBfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5'
				]
			} );
			var table3 = $('#example_select2').DataTable();
			var tablefixed = $('#fixedHeader').DataTable( {
				fixedHeader: {
					header: true,
					footer: true
				},
				"bSort": false,
				"paging": false
			} );
			$('#example_select tbody').on( 'click', 'tr', function () {
				$(this).toggleClass('uk-active');
				var qty = table2.rows('.uk-active').data().length;
				if(qty<2){
					$('#button').hide("normal");
					$('#tandaterima').hide("normal");
				}else{
					$('#button').show("normal");
					$('#tandaterima').show("normal");
				}
			});
			
			$('#example_select2 tbody').on( 'click', 'tr', function () {
				$(this).toggleClass('uk-active');
				var qty = table3.rows('.uk-active').data().length;
				if(qty<1){
					$('#button').hide("normal");
					$('#tandaterima').hide("normal");
				}else{
					$('#button').show("normal");
					$('#tandaterima').show("normal");
				}
			});
			
			$('#button').click( function () {
				var qty = table2.rows('.uk-active').data().length;
				var a = [];
				for ( var i = 0; i < qty; i++ ) {
					a.push( table2.rows('.uk-active').data()[i][1]);
				}
				$('#input_val').val(a);
				var dat={'id':a};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/ajax_get_kontak",
					type:'POST',
					data:dat,
					success:function(res){
						$('#list_site').html(res);
					}
				});
			});
			
			$('#tandaterima').click( function () {
				var qty = table3.rows('.uk-active').data().length;
				var a = '';
				for ( var i = 0; i < qty; i++ ) {
					if(i==0){
						a = table3.rows('.uk-active').data()[i][1];
					}else{
						a = a + '+' + table3.rows('.uk-active').data()[i][1];
					}
					// a.push( table2.rows('.uk-active').data()[i][1]);
				}
				// $('#input_val').val(a);
				window.location.href = "<?php echo base_url(); ?>finance/view_tandaterima/" + a;
			});
			
			$('.trig_materai').click( function () {
				var id = this.id;
				var arr = id.split('_');
				var dat={'id':arr[1],'id_order':arr[2]};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/ajax_get_materai",
					type:'POST',
					data:dat,
					success:function(res){
						var arr2 = res.split('__');
						$('#email_billing').val(arr2[0]);
						$('#npwpe').val(arr2[4]);
						$('#id_order_materai').val(arr[2]);
						$('#materai').val(arr2[1]);
						$('#materai').trigger("chosen:updated");
						$('#installasi').val(arr2[3]);
						$('#installasi').trigger("chosen:updated");
						$('#id_site_materai').val(arr2[2]);
					}
				});
			});
			
			$('#tipe').change( function () {
				var isi = $(this).val();
				if(isi==1){
					$('#date_merge').show("normal");
				}else{
					$('#date_merge').hide("normal");	
					$('#dari_merge').val("");	
					$('#sampai_merge').val("");	
				}
			});
			
			$('.tooltipss').tooltipster();
			
			var next_serv = '<?php echo isset($next_serv)?$next_serv:''; ?>';
			////////////////////////////////////////////////////////////////////////////
			
			$('body').on('click', '#btn-color-targets > .btn', function(){
				var color = $(this).data('target-color');
				$('#modalColor').attr('data-modal-color', color);
				$('#modalColor2').attr('data-modal-color', color);
			});
			
			$('.filter_daterange').click(function(){	
				var id_filter = this.id;
				// alert(id_filter);
				var id_region = $('#id_region').val();
				var id_region2 = $('#id_region2').val();
				var id_region3 = $('#id_region3').val();
				var ppnflag = $('#ppnflag').val();
				var pphflag = $('#pphflag').val();
				var ppnflag2 = $('#ppnflag2').val();
				var ppnflag3 = $('#ppnflag3').val();
				var site = $('#id_site').val();
				var site2 = $('#id_site2').val();
				var dari = $('#tdari').val();
				var menu = $('#menu').val();
				if(dari==''){dari=0;}
				var sampai = $('#tsampai').val();
				if(sampai==''){sampai=0;}
				
				var dari2 = $('#tdari2').val();
				if(dari2==''){dari2=0;}
				var sampai2 = $('#tsampai2').val();
				if(sampai2==''){sampai2=0;}
				
				if(id_filter=='filter_ar'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_arlunas'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_lunas/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_terima'){
					window.location.href = "<?php echo base_url(); ?>finance/tandaterima/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_arpiutang'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_piutang/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site + "/" + pphflag;
				}else if(id_filter=='filter_cust'){
					window.location.href = "<?php echo base_url(); ?>marketing/customers/" + dari + "/" + sampai;
				}else if(id_filter=='filter_proj'){
					window.location.href = "<?php echo base_url(); ?>marketing/project_order/" + dari + "/" + sampai;
				}else if(id_filter=='filter_so'){
					window.location.href = "<?php echo base_url(); ?>marketing/sales_order/" + dari + "/" + sampai;
				}else if(id_filter=='filter_inv_so'){
					window.location.href = "<?php echo base_url(); ?>finance/invoice_so/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_piutang_so'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_so/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_lunas_so'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_so_lunas/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_ar_dp'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_dp/" + dari2 + "/" + sampai2 + "/" + id_region2 + "/" + ppnflag2 + "/" + site2;
				}else if(id_filter=='filter_ar_piutangdp'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_piutang_dp/" + dari2 + "/" + sampai2 + "/" + id_region2 + "/" + ppnflag2 + "/" + site2;
				}else if(id_filter=='filter_ar_lunasdp'){
					window.location.href = "<?php echo base_url(); ?>finance/dataardp_lunas/" + dari2 + "/" + sampai2 + "/" + id_region2 + "/" + ppnflag2 + "/" + site2;
				}else if(id_filter=='filter_muka'){
					window.location.href = "<?php echo base_url(); ?>finance/muka/" + dari + "/" + sampai;
				}else if(id_filter=='kartu_piutang'){
					var id_client = $('#id_client_kp').val();
					var id_order = $('#id_order_kp').val();
					var dari = $('#tdari_kp').val();
					var ppnflag = $('#ppnflag4').val();
					if(dari==''){dari=0;}
					var sampai = $('#tsampai_kp').val();
					if(sampai==''){sampai=0;}
					window.location.href = "<?php echo base_url(); ?>finance/kartu_piutang/" + dari + "/" + sampai + "/" + id_client + "/" + id_order + "/" + ppnflag;
				}else if(id_filter=='cust_aktif'){
					window.location.href = "<?php echo base_url(); ?>finance/customers/" + id_region3 + "/" + ppnflag3;
				}else if(id_filter=='filter_jurnalin'){
					var dari = $('#seko').val();
					var nganti = $('#nganti').val();
					var pcent = $('#pcent').val();
					var ac = $('#akun2').val();
					// alert("<?php echo base_url(); ?>akuntansi/jurnal/" + menu + "/" + dari + "/" + sampai);
					window.location.href = "<?php echo base_url(); ?>akuntansi/jurnalin/" + dari + "/" + nganti + "/" + pcent + "/" + ac;
				}else if(id_filter=='filter_jurnal'){
					var dari = $('#seko').val();
					var nganti = $('#nganti').val();
					var pcent = $('#pcent').val();
					var ac = $('#akun2').val();
					// alert("<?php echo base_url(); ?>akuntansi/jurnal/" + menu + "/" + dari + "/" + sampai);
					window.location.href = "<?php echo base_url(); ?>akuntansi/jurnal/" + menu + "/" + dari + "/" + nganti + "/" + pcent + "/" + ac;
				}else if(id_filter=='filter_kasbon'){
					var dari = $('#seko2').val();
					var nganti = $('#nganti2').val();
					var pcent = $('#pcent2').val();
					window.location.href = "<?php echo base_url(); ?>akuntansi/kasbon/" + dari + "/" + nganti + "/" + pcent;
				}
			});			
		
			
			$('#f_ar_btcek1').click(function(){
					var color = $(this).data('target-color');
					 
                    $('#modalColor').attr('data-modal-color', color);
			});
				 
			$('.sa-email_dp').click(function(){
				var id = this.id;
				var arr = id.split('_');
                swal({   
                    title: "Are you sure?",   
                    text: "Anda akan mengirim email invoice pada client ini.",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false 
                }, function(){   
                    window.location.href = "<?php echo base_url(); ?>finance/email_invoice_dp/" + arr[1];
                });
            });
			$('.sa-kasbon').click(function(){
                var id = this.id;
				swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function(){   
                    window.location.href = "<?php echo base_url(); ?>" + id; 
                });
            });
			$('.sa-warning').click(function(){
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function(){   
                    swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
                });
            });
			$('.sa-email').click(function(){
				var id = this.id;
				var arr = id.split('_');
                swal({   
                    title: "Anda Yakin?",   
                    text: "Anda akan mengirim email invoice pada client ini.",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false 
                }, function(){   
					window.location.href = "<?php echo base_url(); ?>finance/email_invoice/" + arr[1];
                });
            });
			$('.sa-email-merge').click(function(){
				var id = this.id;
				var arr = id.split('_');
                swal({   
                    title: "Anda Yakin?",   
                    text: "Anda akan mengirim email invoice pada client ini.",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false 
                }, function(){   
					window.location.href = "<?php echo base_url(); ?>finance/email_invoice_merge/" + arr[1];
                });
            });
			
			table.on('draw', function() {
				$('.sa-kasbon').click(function(){
					var id = this.id;
					swal({   
						title: "Are you sure?",   
						text: "You will not be able to recover this imaginary file!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes, delete it!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>" + id; 
					});
				});
			   $('.sa-email').click(function(){
					var id = this.id;
					var arr = id.split('_');
					swal({   
						title: "Anda Yakin?",   
						text: "Anda akan mengirim email invoice pada client ini.",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice/" + arr[1];
					});
				});
				$('.sa-email2').click(function(){
					var id = this.id;
					var arr = id.split('_');
					swal({   
						title: "Anda Yakin?",   
						text: "Anda akan mengirim email invoice pada client ini.",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice_so/" + arr[1];
					});
				});
				$('.sa-email_dp').click(function(){
					var id = this.id;
					var arr = id.split('_');
					swal({   
						title: "Are you sure?",   
						text: "Anda akan mengirim email invoice pada client ini.",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice_dp/" + arr[1];
					});
				});
				$('.trig_materai').click( function () {
					var id = this.id;
					var arr = id.split('_');
					var dat={'id':arr[1],'id_order':arr[2]};
					$.ajax({
						url:"<?php echo base_url(); ?>finance/ajax_get_materai",
						type:'POST',
						data:dat,
						success:function(res){
							var arr2 = res.split('__');
							$('#npwpe').val(arr2[4]);
							$('#email_billing').val(arr2[0]);
							$('#id_order_materai').val(arr[2]);
							$('#materai').val(arr2[1]);
							$('#materai').trigger("chosen:updated");
							$('#id_site_materai').val(arr2[2]);
						}
					});
				});
				// $('.trig_modal').click(function(){
					// var id = this.id;
					// var splt = id.split('_');
					// if (typeof splt[3] === 'undefined'){
						// if(splt[2]=='skip'){
							// var dat={'id_order':splt[0],'id_site':splt[1],'flag':'','skip':'skip'};
						// }else{
							// var dat={'id_order':splt[0],'id_site':splt[1],'flag':'','skip':''};
						// }
					// }else{
						// var dat={'id_order':splt[0],'id_site':splt[1],'flag':splt[3],'skip':''};
					// }
					// $.ajax({
						// url:"<?php echo base_url(); ?>marketing/ajax_get_order",
						// type:'POST',
						// data:dat,
						// success:function(res){
							// $('#modal_content').html(res);
							// $('#fire_modal').click();
							// if ($('.html-editor')[0]) {
							   // $('.html-editor').summernote({
									// height: 150
								// });
							// }
						// }
					// });
				// });
				
				$('.tooltipss').tooltipster();
			});
			table2.on('draw', function() {
			   $('.sa-email').click(function(){
					var id = this.id;
					var arr = id.split('_');
					swal({   
						title: "Anda Yakin?",   
						text: "Anda akan mengirim email invoice pada client ini.",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice/" + arr[1];
					});
				});
				$('.sa-split').click(function(){
					var id = this.id;
					var arr = id.split('_');
					swal({   
						title: "Anda Yakin?",   
						text: "Anda akan memisahkan invoice ini.",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>finance/split_invoice/" + arr[1];
					});
				});
				$('.sa-email-merge').click(function(){
					var id = this.id;
					var arr = id.split('_');
					swal({   
						title: "Anda Yakin?",   
						text: "Anda akan mengirim email invoice pada client ini.",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes!",   
						closeOnConfirm: false 
					}, function(){   
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice_merge/" + arr[1];
					});
				});
				$('.tooltipss').tooltipster();
			});
			$('.sa-email2').click(function(){
				var id = this.id;
				var arr = id.split('_');
                swal({   
                    title: "Anda Yakin?",   
                    text: "Anda akan mengirim email invoice pada client ini.",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false 
                }, function(){   
					window.location.href = "<?php echo base_url(); ?>finance/email_invoice_so/" + arr[1];
                });
            });
			$('.sa-split').click(function(){
				var id = this.id;
				var arr = id.split('_');
                swal({   
                    title: "Anda Yakin?",   
                    text: "Anda akan memisahkan invoice ini.",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false 
                }, function(){   
					window.location.href = "<?php echo base_url(); ?>finance/split_invoice/" + arr[1];
                });
            });
			
			$('#example').on('click','.trig_modal',function(){
			// $('.trig_modal').click(function(){
				var id = this.id;
				var splt = id.split('_');
				if (typeof splt[3] === 'undefined'){
					if(splt[2]=='skip'){
						var dat={'id_order':splt[0],'id_site':splt[1],'flag':'','skip':'skip'};
					}else{
						var dat={'id_order':splt[0],'id_site':splt[1],'flag':'','skip':''};
					}
				}else{
					var dat={'id_order':splt[0],'id_site':splt[1],'flag':splt[3],'skip':''};
				}
				$.ajax({
					url:"<?php echo base_url(); ?>marketing/ajax_get_order",
					type:'POST',
					data:dat,
					success:function(res){
						$('#modal_content').html(res);
						$('#fire_modal').click();
						if ($('.html-editor')[0]) {
						   $('.html-editor').summernote({
								height: 150
							});
						}
					}
				});
			});
			$('.trig_realisasi').click(function(){
				var id = this.id;
				var spl = id.split('__');
				$('#id_kasbon').val(spl[0]);
				$('#nominal_realisasi').val(spl[1]);
				$('#kasbon_modal').click();
		
			});
			
		});
		</script>
        
    </body>
</html>