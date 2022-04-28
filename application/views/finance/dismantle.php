
	<section id="content">
		<div class="container">
            
			<div class="card">
				
				<div class="card-header bgm-bluegray m-b-20">
					<h2><i class="zmdi zmdi zmdi-settings"></i> <?php echo $title; ?> <small><?php echo $titlenote; ?></small></h2>
						<?php echo $button;?>
				</div>
				
				<div class="card-body card-padding">
					<?php 
						$flashmessage   = $this->session->flashdata('message');
						$notifikasi     = $this->session->flashdata('notifikasi');
						echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
					?>
					<input id="dari" type="hidden" value="<?php echo isset($dari)?$dari:''; ?>">
					<input id="sampai" type="hidden" value="<?php echo isset($sampai)?$sampai:''; ?>">
					<div class="row">
						<div class="col-sm-12">    
							<div class="table-responsive">
								<?php echo $table; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
</section>

<div class="modal fade" id="modalColor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
								<input type="text" id="tdari"    class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group form-group">
							<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
								<input type="text" id="tsampai"  class="form-control date-picker" placeholder="Click here...">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link filter_daterange" id="filter_<?php echo $flag; ?>">Apply changes</button>
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
			var table = $('.example').DataTable();
			$('.tooltipss').tooltipster();
			$('body').on('click', '#btn-color-targets > .btn', function(){
				var color = $(this).data('target-color');
				$('#modalColor').attr('data-modal-color', color);
				$('#modalColor2').attr('data-modal-color', color);
			});
			
			//for form ar payment ---------------------------
			var f_ar_grid='';
			
			$('.filter_daterange').click(function(){	
				var dari = $('#tdari').val();
				if(dari==''){dari=0;}
				var sampai = $('#tsampai').val();
				if(sampai==''){sampai=0;}
					window.location.href = "<?php echo base_url(); ?>finance/dismantle/" + dari + "/" + sampai;
			});
			
		});
		</script> 
    </body>
</html>