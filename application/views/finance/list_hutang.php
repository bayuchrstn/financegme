		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> <?php echo $title; ?><small>Account Payable Payment</small></h2>
						<div id="btn-color-targets">
						<?php echo $button;?>
					</div>
					</div>
					<div class="card-body card-padding">
						
						<input id="dari" type="hidden" value="<?php echo isset($dari)?$dari:''; ?>">
						<input id="sampai" type="hidden" value="<?php echo isset($sampai)?$sampai:''; ?>">
						
						<div style="margin-top:-25px;" class="alert alert-warning alert-dismissible" role="alert">
						   <b><center><i class="zmdi zmdi-filter-list"></i> <?php echo strtoupper($titlenote); ?></center></b>
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
				<form action="<?php echo base_url(); ?>finance/simpan_payment_hutang" method="POST">
					<input name="id_header" type="hidden" id="id_header">
					<div class="modal-body">
						<div class="row" id="date_merge">
							
							<div class="col-sm-6">
								<p class="c-black f-500 m-b-20">Akun</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="dtp-container fg-line">
										<?php 
											echo form_dropdown('akun', $akunall_id, '', 'class="tag-select" id="coa"');
										?>
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
								<p class="c-black f-500 m-b-20">Nominal Pembayaran</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="dtp-container fg-line">
										<input name="nominal" type="number" id="kekurangan" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<p class="c-black f-500 m-b-20">Tanggal</p>
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="dtp-container fg-line">
										<input name="date" value="<?php echo date('Y-m-d'); ?>" type="text" class="form-control date-picker">
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
	<div class="modal fade"  id="modalFilter" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Data</h4><small>Tentukan parameter</small>
				</div>
				<form action="<?php echo base_url().$action; ?>" method="POST">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="dtp-container fg-line">
										<input type="text" name="tdari" value="<?php echo $dari; ?>" class="form-control date-picker" placeholder="Periode Awal">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="dtp-container fg-line">
										<input type="text" name="tsampai" value="<?php echo $sampai; ?>" class="form-control date-picker" placeholder="Periode Akhir">
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-link" >Save changes</button>
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
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.uikit.min.js"></script>

		<script type="text/javascript">
		
		$(document).ready(function(){
			var table = $('#example').DataTable();
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
						url:"<?php echo base_url(); ?>finance/ajax_get_historipembayaran_hutang",
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
					var spl = idne.split('_');
					$("#kekurangan").val(spl[1]);
					$("#id_header").val(spl[0]);
					$("#fire_modal2").click();
						
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