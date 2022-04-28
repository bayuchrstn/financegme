	<section id="content">
		<div class="container">
			<div class="card">
				<div class="card-header bgm-red ch-alt">
					<center><h2><i class="zmdi zmdi zmdi-book"></i> RAPORT MERAH <small><?php //echo strtoupper($titlenote); ?></small></h2></center>
					<div id="btn-color-targets">
						<?php echo $button;?>
					</div>
				</div>
				<div class="card-body card-padding">
					<?php 
						$flashmessage   = $this->session->flashdata('message');
						$notifikasi     = $this->session->flashdata('notifikasi');
						echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
					?>
					<div class="row">
						<div class="col-sm-12">
							<div role="tabpanel" class="tab">
								<ul class="tab-nav text-center" role="tablist">
									<li class="active"><a href="components.html#reminder" aria-controls="home10" role="tab" data-toggle="tab">Reminder</a></li>
									<li role="presentation"><a href="components.html#sp1" aria-controls="profile10" role="tab" data-toggle="tab">SP 1</a></li>
									<li role="presentation"><a href="components.html#sp2" aria-controls="messages10" role="tab" data-toggle="tab">SP 2</a></li>
									<li role="presentation"><a href="components.html#sp3" aria-controls="messages10" role="tab" data-toggle="tab">SP 3</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="reminder">
										<div class="row">
											<div class="col-sm-12">
												<?php if($grand_reminder){echo $grand_reminder;} ?>
												<div tabindex="4" style="overflow: hidden;" class="table-responsive">
													<?php echo $reminder; ?>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="sp1">
										<div class="row">
											<div class="col-sm-12">
												<?php if($grand_sp1){echo $grand_sp1;} ?>
												<div tabindex="4" style="overflow: hidden;" class="table-responsive">
													<?php echo $sp1; ?>
												</div>
											</div>
											
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="sp2">
										<div class="row">
											<div class="col-sm-12">
												<?php if($grand_sp2){echo $grand_sp2;} ?>
												<div tabindex="4" style="overflow: hidden;" class="table-responsive">
													<?php echo $sp2; ?>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="sp3">
										<div class="row">
											<div class="col-sm-12">
												<?php if($grand_sp3){echo $grand_sp3;} ?>
												<div tabindex="4" style="overflow: hidden;" class="table-responsive">
													<?php echo $sp3; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade"  id="modalColor" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Filter Data</h4><small>Tentukan region dan ppn</small>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
										<div class="dtp-container fg-line">
										<?php 
										echo form_dropdown('id_region', $opt_region, '', 'class="tag-select" id="id_region"');
										?>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group form-group">
									<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="dtp-container fg-line">
										<?php 
										echo form_dropdown('ppn', array('0'=>'Pilih PPn', '1'=>'PPn','3'=>'Non-PPn'), '', 'class="tag-select" id="ppnflag"');
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link filter_merah">Save changes</button>
						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="preventClick" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">NOTE PENAGIHAN</h4>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>finance/note_proses">
						<div class="modal-body">
							<input type="hidden" value="" name="id_arpost" id="id_arpost">
							<div id="history_nest">
								
							</div>
							<br>
							  <div class="form-group fg-float">
                                <div class="fg-line">
                                    <input name="note" type="text" class="form-control fg-input">
                                </div>
                                <label class="fg-label">Tambah Note</label>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-link">Save</button>
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
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
			$('.example').dataTable();
			$('.tooltipss').tooltipster();
			
			var next_serv = '<?php echo $next_serv; ?>';
			
			
			////////////////////////////////////////////////////////////////////////////
			
			$('body').on('click', '#btn-color-targets > .btn', function(){
				var color = $(this).data('target-color');
				$('#modalColor').attr('data-modal-color', color);
				$('#modalColor2').attr('data-modal-color', color);
			});
			
			$('.filter_daterange').click(function(){	
				var id_filter = this.id;
				var id_region = $('#id_region').val();
				var id_region2 = $('#id_region2').val();
				var ppnflag = $('#ppnflag').val();
				var ppnflag2 = $('#ppnflag2').val();
				var site = $('#id_site').val();
				var site2 = $('#id_site2').val();
				var dari = $('#tdari').val();
				if(dari==''){dari=0;}
				var sampai = $('#tsampai').val();
				if(sampai==''){sampai=0;}
				if(id_filter=='filter_ar'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_arlunas'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_lunas/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
				}else if(id_filter=='filter_arpiutang'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_piutang/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag + "/" + site;
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
					window.location.href = "<?php echo base_url(); ?>finance/dataar_dp/" + dari + "/" + sampai + "/" + id_region2 + "/" + ppnflag2 + "/" + site2;
				}else if(id_filter=='filter_ar_piutangdp'){
					window.location.href = "<?php echo base_url(); ?>finance/dataar_piutang_dp/" + dari + "/" + sampai + "/" + id_region2 + "/" + ppnflag2 + "/" + site2;
				}else if(id_filter=='filter_ar_lunasdp'){
					window.location.href = "<?php echo base_url(); ?>finance/dataardp_lunas/" + dari + "/" + sampai + "/" + id_region2 + "/" + ppnflag2 + "/" + site2;
				}else if(id_filter=='filter_muka'){
					window.location.href = "<?php echo base_url(); ?>finance/muka/" + dari + "/" + sampai;
				}else if(id_filter=='kartu_piutang'){
					var id_client = $('#id_client_kp').val();
					var id_order = $('#id_order_kp').val();
					var dari = $('#tdari_kp').val();
					if(dari==''){dari=0;}
					var sampai = $('#tsampai_kp').val();
					if(sampai==''){sampai=0;}
					window.location.href = "<?php echo base_url(); ?>finance/kartu_piutang/" + dari + "/" + sampai + "/" + id_client + "/" + id_order;
				}
			});			
		
			
			$('#f_ar_btcek1').click(function(){
					var color = $(this).data('target-color');
					 
                    $('#modalColor').attr('data-modal-color', color);
			});
			 
			$('.command-note').click(function(){
				var id = this.id;
				var arr = id.split('_');
				var dat={'id_arpost':arr[1]};
				$.ajax({
					url:"<?php echo base_url(); ?>Finance/ajax_get_note",
					type:'POST',
					data:dat,
					success:function(result){
						$('#history_nest').html(result);
						$('#id_arpost').val(arr[1]);
						$('#preventClick').modal('show');							
					}
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
					window.location.href = "<?php echo base_url(); ?>finance/email_merah/" + arr[1];
                });
            });
		});
		</script>
        
    </body>
</html>