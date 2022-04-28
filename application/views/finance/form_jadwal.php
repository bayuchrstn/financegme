		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> FORM PENJADWALAN INVOICE</h2>
					</div>
					<?php 
					echo form_open_multipart(base_url().'finance/jadwal_proses');
					?>
					<!--form method="POST" action="<?php //echo base_url(); ?>marketing/order_proses"  enctype="multipart/form-data"-->
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<input type="hidden" name="id" class="form-control" value="<?php echo isset($jadwal->id)?$jadwal->id:'';?>">
							<input type="hidden" name="id_order" class="form-control" value="<?php echo isset($get->id)?$get->id:'';?>">
							<div class="row">
								<div class="col-sm-1" style="text-align:right;">
									Client 
								</div>
								<div class="col-sm-11">
									<b><?php 
									echo $client->nama;
									?>	</b>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-1" style="text-align:right;">
									Site 
								</div>
								<div class="col-sm-11">
									<b><?php 
									echo $site->nama.' '.$site->kota;
									?>	</b>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-1" style="text-align:right;">
									Nominal 
								</div>
								<div class="col-sm-11">
									<b>Rp <?php 
									echo $this->Kamus_model->uang($get->biaya_langganan);
									?>	</b>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-1" style="text-align:right;">
									Kontrak 
								</div>
								<div class="col-sm-11">
									<b><?php 
									echo $this->Kamus_model->tanggal_indo($get->start_kontrak).' - '.$this->Kamus_model->tanggal_indo($get->end_kontrak);
									?>	</b>
								</div>
							</div><hr>
							<div class="row">
								<div class="col-sm-2">
									<p class="c-black f-500 m-b-5 m-t-5">Jumlah Pembayaran</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
										<div class="fg-line">
											<input type="number" min="1" name="jml_pembayaran" class="form-control" id="jp" value="<?php echo isset($jadwal->jml_pembayaran)?$jadwal->jml_pembayaran:'1';?>">
											<span class="help-block"><font color="red"><?php echo form_error('jml_pembayaran'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-5 m-t-5">Satuan Input</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<?php
												echo form_dropdown('satuan', array('1'=>'rupiah','2'=>'persen'), isset($jadwal->satuan)?$jadwal->satuan:set_value('satuan'), 'id="satuan" class="tag-select"');
											?>
										</div>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="col-sm-12">
								<?php 
								if($table){
									echo $table;
								}else{
									echo '<div class="row hitung" id="row_1">
											<div class="col-sm-2">
												<p class="c-black f-500">Termin</p>
												<div class="input-group">
													<div class="fg-line">
														<input type="text" name="termin[]" value="1" class="form-control">
													</div>
												</div>
											</div>
											<div style="display:none;" class="col-sm-2 persene">
												<p class="c-black f-500">Persentase</p>
												<div class="input-group">
													<div class="fg-line">
														<input type="text" name="persen[]" class="form-control persene2">
													</div>
												</div>
											</div>
											<div class="col-sm-3 nominale">
												<p class="c-black f-500">Nominal</p>
												<div class="input-group">
													<div class="fg-line">
														<input type="text" class="rupiah nominale2 form-control" value="'.$get->biaya_langganan.'" name="nominal[]" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<p class="c-black f-500">Periode</p>
												<div class="input-group">
													<div class="fg-line">
														<input type="text" value="'.$get->start_kontrak.'" name="periode[]" class="form-control date-picker">
													</div>
												</div>
											</div>
										</div>';
									echo '<div id="nest"></div>';
								}
								?>
								</div>
							</div>
						</div>
						<button type="submit" style="z-index: 99;" id="ms-compose" class="btn bgm-cyan btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-check"></i></button>
						<a href="javascript:history.back()" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	<footer id="footer" style="color:black;">
		
		<ul class="f-menu">
			<li><a style="color:black;" href="<?php echo base_url(); ?>marketing/home">Marketing</a></li>
			<li><a style="color:black;" href="<?php echo base_url(); ?>finance/home">Finance</a></li>
		</ul>
		Copyright &copy; 2016 GMedia
	</footer>
        
        <!-- Javascript Libraries -->
        <script src="<?php echo base_url();?>assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="<?php echo base_url();?>assets/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/sparklines/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        
        <script src="<?php echo base_url();?>assets/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendors/chosen_v1.4.2/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendors/bootgrid/jquery.bootgrid.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		<!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url();?>assets/js/jquery.inputmask.bundle.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/fileinput/fileinput.min.js"></script>
        <!--script src="<?php //echo base_url();?>assets/js/charts.js"></script-->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tooltipster.min.js"></script>
		
        <script src="<?php echo base_url();?>assets/js/functions.js"></script>
        <!--script src="<?php //echo base_url();?>assets/js/demo.js"></script-->
		<script type="text/javascript">
		$(document).ready(function(){
			$("#jp").change(function(){
				var isi = $(this).val();
				var numOri = $('.hitung').length;
				var satuan = $('#satuan').val();
				var loop = '';
				if(isi>numOri){
					loop = isi - numOri;
					var p=1;
					for(i=0; i<loop; i++) {
						p=numOri+(i+1);
						if(satuan==1){
							$("#nest").append('<div style="display:none;" class="row hitung animate_serv" id="row_'+p+'"><div class="col-sm-2"><div class="input-group"><div class="fg-line"><input placeholder="Termin" value="'+p+'" type="text" name="termin[]" class="form-control"></div></div></div><div style="display:none;" class="col-sm-2 persene"><div class="input-group"><div class="fg-line"><input placeholder="Persen" type="text" name="persen[]" class="form-control persene2"></div></div></div><div class="col-sm-3 nominale"><div class="input-group"><div class="fg-line"><input placeholder="Nominal" class="rupiah nominale2 form-control" type="text" name="nominal[]" class="form-control"></div></div></div><div class="col-sm-3"><div class="input-group"><div class="fg-line"><input placeholder="Periode" type="text" name="periode[]" class="form-control date-picker"></div></div></div></div>');
						}else{
							$("#nest").append('<div style="display:none;" class="row hitung animate_serv" id="row_'+p+'"><div class="col-sm-2"><div class="input-group"><div class="fg-line"><input placeholder="Termin" value="'+p+'" type="text" name="termin[]" class="form-control"></div></div></div><div class="col-sm-2 persene"><div class="input-group"><div class="fg-line"><input placeholder="Persen" type="text" name="persen[]" class="form-control persene2"></div></div></div><div style="display:none;" class="col-sm-3 nominale"><div class="input-group"><div class="fg-line"><input placeholder="Nominal" class="rupiah nominale2 form-control" type="text" name="nominal[]" class="form-control"></div></div></div><div class="col-sm-3"><div class="input-group"><div class="fg-line"><input placeholder="Periode" type="text" name="periode[]" class="form-control date-picker"></div></div></div></div>');
						}
						$(".animate_serv").show('normal');
						$(".rupiah").inputmask("currency");
						 if ($('.date-picker')[0]) {
							$('.date-picker').datetimepicker({
								format: 'YYYY-MM-DD'
							});
						}
					}
				}else if(isi<numOri){
					loop = numOri - isi;
					var p=1;
					for(i=numOri; i>isi; i--) {
						// p=i+1;
						$('#row_'+i).remove();
					}
				}
			});
			$("#satuan").change(function(){
				if($("#satuan").val()==2){
					$('.persene').show("normal");
					$('.nominale').hide("normal");
					$('.nominale2').val("");
				}else{
					$('.persene').hide("normal");
					$('.nominale').show("normal");
					$('.persene2').val("");
				}
			});		
			
			$(".rupiah").inputmask("currency");
		});
		</script>
        
    </body>
</html>