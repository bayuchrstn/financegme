
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
					
					<div style="margin-top:-25px;" class="alert alert-warning alert-dismissible" role="alert">
					   <b><center><i class="zmdi zmdi-filter-list"></i> <?php echo isset($titlenote)?strtoupper($titlenote):''; ?></center></b>
					</div>
					<?php 
						$flashmessage   = $this->session->flashdata('message');
						$notifikasi     = $this->session->flashdata('notifikasi');
						echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
					?>
					
					<div class="row">
						<div class="col-sm-12">    
							<div role="tabpanel">
								<ul class="tab-nav" role="tablist">
									<li class="active"><a href="gmedia.html#crm" aria-controls="crm" role="tab" data-toggle="tab">LIST INVOICE</a></li>
									<li><a href="gmedia.html#blm" aria-controls="blm" role="tab" data-toggle="tab">PROSES REVISI
									</a></li>
								</ul>
							  
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="crm">
										<div class="table-responsive">
											<?php echo $table0; ?>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="blm">
										<div class="table-responsive">
											<?php echo $table1; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
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
	<div class="modal-dialog modal-sm">
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
        <!--script src="<?php //echo base_url();?>assets/js/demo.js"></script-->
		<script type="text/javascript">
		$(document).ready(function(){
			var table = $('.example_select').DataTable();
			$('.tooltipss').tooltipster();
			
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
					if(dari==''){dari=0;}
					var sampai = $('#tsampai_kp').val();
					if(sampai==''){sampai=0;}
					window.location.href = "<?php echo base_url(); ?>finance/kartu_piutang/" + dari + "/" + sampai + "/" + id_client + "/" + id_order;
				}else if(id_filter=='cust_aktif'){
					window.location.href = "<?php echo base_url(); ?>finance/customers/" + id_region3 + "/" + ppnflag3;
				}else if(id_filter=='filter_jurnal'){
					var dari = $('#seko').val();
					var nganti = $('#nganti').val();
					var pcent = $('#pcent').val();
					// alert("<?php echo base_url(); ?>akuntansi/jurnal/" + menu + "/" + dari + "/" + sampai);
					window.location.href = "<?php echo base_url(); ?>akuntansi/jurnal/" + menu + "/" + dari + "/" + nganti + "/" + pcent;
				}
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
			
			table.on('draw', function() {
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
					
				$('.tooltipss').tooltipster();
			});
			
			$(".example_select").on("click", ".trig_modal", function(){
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
			
		});
		</script>
        
    </body>
</html>