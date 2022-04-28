
	<section id="content">
		<div class="container">
            
			<div class="card">
				
				<div class="card-header bgm-bluegray ch-alt m-b-25">
					<center><h2> <?php echo isset($icon)?'<i class="'.$icon.'"></i>':''; ?> <?php echo strtoupper($title); ?> </h2></center>
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
        <script src="<?php echo base_url(); ?>assets/vendors/chosen_v1.4.2/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tooltipster.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/functions.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.uikit.min.js"></script>
        <!--script src="<?php //echo base_url();?>assets/js/demo.js"></script-->
		<script type="text/javascript">
		$(document).ready(function(){
			var table = $('#example').DataTable();
			$('.tooltipss').tooltipster();
			
			////////////////////////////////////////////////////////////////////////////
			$('.sa-warning').click(function(event){
				var href = $(this).attr('href');
				event.preventDefault();
				swal({   
					title: "Are you sure?",   
					text: "You will not be able to recover this data!",   
					type: "warning",   
					showCancelButton: true,   
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "Yes, delete it!",   
					closeOnConfirm: false 
				}, function(){   
					// swal("Deleted!", "Your data has been deleted.", "success"); 
					window.location.href = href;
				});
			});
				
			$(".history_all").click(function(){
				var opt_data = {
					id : this.id
				};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/ajax_get_allhistoripembayaran",
					type:'POST',
					data: opt_data,
					success:function(result){
						$("#history_nest").html(result);
						$("#fire_modal").click();
					}
				});
			});		
			
			table.on('draw', function() {
				$('.sa-warning').click(function(event){
					var href = $(this).attr('href');
					event.preventDefault();
					swal({   
						title: "Are you sure?",   
						text: "You will not be able to recover this data!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Yes, delete it!",   
						closeOnConfirm: false 
					}, function(){   
						// swal("Deleted!", "Your data has been deleted.", "success"); 
						window.location.href = href;
					});
				});
			
			   $(".history_all").click(function(){
					var opt_data = {
						id : this.id
					};
					$.ajax({
						url:"<?php echo base_url(); ?>finance/ajax_get_allhistoripembayaran",
						type:'POST',
						data: opt_data,
						success:function(result){
							$("#history_nest").html(result);
							$("#fire_modal").click();
						}
					});
				});
				$('.tooltipss').tooltipster();
			});
			
			
		});
		</script>
        
    </body>
</html>