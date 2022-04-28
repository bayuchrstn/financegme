		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> AP Payment <?php echo $title; ?><small>Account Payable Payment</small></h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>finance/appayment_proses">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
								<div class="col-sm-12">                       
									<div class="input-group">
										<span class="input-group-addon">Pilih No Pengajuan : </span>
										<div class="fg-line">
											<input type="hidden" name="id" class="form-control" value="<?php echo isset($edit->id)?$edit->id:'';?>">
											<?php
												echo form_dropdown('no', $option_pengajuan, isset($id)?$id:'', 'class="tag-select nopeng" id="nopeng"');
											?>
											<span class="help-block"><font color="red"></font></span>
										</div>
									</div>
								</div>
							</div>
							<div id="det_nest"></div>
						</div>
						<a href="javascript:history.back()" style="z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	
	<div style="display:none;"><a id="fire_modal" data-toggle="modal" href="arsenal.html#modalWider" ></a></div>
	<div class="modal fade" id="modalWider" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="zmdi zmdi-shopping-basket"></i> HISTORY PEMBAYARAN</h4>
				</div>
				<div class="modal-body">
					<div id="history_nest"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div style="display:none;"><a id="fire_modal2" data-toggle="modal" href="arsenal.html#modalWider2" ></a></div>
	<div class="modal fade" id="modalWider2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="zmdi zmdi-shopping-basket"></i> FORM PEMBAYARAN</h4>
				</div>
				<form action="<?php echo base_url(); ?>finance/simpan_ap_payment" method="POST">
					<div class="modal-body">
						<div class="row" id="date_merge">
							<div class="col-sm-6">
								<p class="c-black f-500 m-b-20">Rekening Sumber</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-link"></i></span>
										<div class="dtp-container fg-line">
										<input name="id_detail" type="hidden" id="id_detail">
										<input name="id_header" type="hidden" id="id_header">
										<?php 
											echo form_dropdown('akun', $akunbank, '', 'id="kode_sumber" class="tag-select"');
										?>
										<!--<input name="akun" type="hidden" id="kode_sumber">
										<span id="rek_sumber"></span> -->
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<p class="c-black f-500 m-b-20">Profit Center</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
										<div class="dtp-container fg-line">
										<select class="form-control" name="pcenter">
											<option value="0">Pilih</option>
											<option selected value="3">Semarang</option>
											<option value="7">Salatiga</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<p class="c-black f-500 m-b-20">Akun</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="dtp-container fg-line">
										<?php 
											echo form_dropdown('akun_d', $akunall, '', 'class="tag-select"');
										?>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<p class="c-black f-500 m-b-20">Nominal Pembayaran</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="dtp-container fg-line">
										<input name="nominal" required type="number" id="kekurangan" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<p class="c-black f-500 m-b-20">Note</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-align"></i></span>
										<div class="dtp-container fg-line">
										<input id="note_head" name="note" type="text" class="form-control">
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
	<footer id="footer">
		<ul class="f-menu">
			<li><a href="<?php echo base_url(); ?>marketing/home">Marketing</a></li>
			<li><a href="<?php echo base_url(); ?>finance/home">Finance</a></li>
		</ul>
		Copyright &copy; 2018 GMedia
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
			$('.tooltipss').tooltipster();
			
			var suming = 0;
			////////////////////////////////////////////////////////////////////////////
			$(".rupiah").inputmask("currency");
			
			$('body').on('click', '#btn-color-targets > .btn', function(){
				var color = $(this).data('target-color');
				$('#modalColor').attr('data-modal-color', color);
				$('#modalColor2').attr('data-modal-color', color);
			});
			
			var total_cpe = 0;
			
			$("#nopeng").change(function(){
				var opt_data = {
					id : $("#nopeng").val()
				};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/ajax_get_nopeng",
					type:'POST',
					data: opt_data,
					success:function(result){
						$("#det_nest").html(result);
						event();
					}
				});
			});
			
			var id = '<?php echo isset($id)?$id:0; ?>';
			if(id !== 0){
				var opt_data = {
					id : $("#nopeng").val()
				};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/ajax_get_nopeng",
					type:'POST',
					data: opt_data,
					success:function(result){
						$("#det_nest").html(result);
						event();
					}
				});
			}
			
			
				
			function event(){
				$(".history").click(function(){
					var opt_data = {
						id : this.id
					};
					$.ajax({
						url:"<?php echo base_url(); ?>finance/ajax_get_historipembayaran",
						type:'POST',
						data: opt_data,
						success:function(result){
							$("#history_nest").html(result);
							$("#fire_modal").click();
						}
					});
				});
				
				$(".form").click(function(){
					var idne = this.id;
					var opt_data = {
						id : idne
					};
					$.ajax({
						url:"<?php echo base_url(); ?>finance/ajax_cek_payment",
						type:'POST',
						data: opt_data,
						success:function(result){
							var dpl = result.split('__');
							var spl = idne.split('_');
							$("#kekurangan").val(dpl[1]);
							$("#kode_sumber").val(dpl[2]);
							$("#note_head").val(dpl[3]);
							$('#kode_sumber').trigger("chosen:updated");
							// $("#rek_sumber").html(dpl[3]);
							$("#id_detail").val(spl[0]);
							$("#id_header").val(spl[1]);
							$("#fire_modal2").click();
						}
					});
				});
			}
			
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
			//-----------------------------------------------------------------------------------------
			
		});
		</script>
        
    </body>
</html>