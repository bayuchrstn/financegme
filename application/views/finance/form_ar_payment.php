		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> AR Payment <?php echo $title; ?><small>Account Receivable Payment</small></h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>finance/arpayment_proses">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
								<div class="col-sm-12">                       
									<div class="input-group">
										<span class="input-group-addon">Pilih Client : </span>
										<div class="fg-line">
											<input type="hidden" id="flagdp" name="flagdp" class="form-control" value="<?php echo isset($flagdp)?$flagdp:'';?>">
											<input type="hidden" id="flag" name="flag" class="form-control" value="<?php echo isset($flag)?$flag:'';?>">
											<input type="hidden" name="id" class="form-control" value="<?php echo isset($edit->id)?$edit->id:'';?>">
											<input type="hidden" name="id_edit" class="form-control" value="<?php echo isset($id_edit)?$id_edit:'';?>">
											<?php
												echo form_dropdown('id_company', $option_company, isset($sitee)?$sitee:'', 'class="tag-select company" id="payment_ar_client"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('nama'); ?></font></span>
										</div>
									</div>
								</div>
							</div>
							<div id="inv_nest"></div>
							<div id="formall" style="display:none;">
								<div class="row">
									<div class="col-sm-3">
										<p class="c-black f-500 m-b-5 m-t-20">Payment No</p>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
											<div class="col-sm-12">
												<div class="fg-line">    
													<input name="no_pay" readonly type="text" class="form-control" value="<?php echo $next_nopay;?>"></input>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p class="c-black f-500 m-b-5 m-t-20">Payment Date</p>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
											<div class="fg-line">
												<input type='text' name="tanggal" id="tanggal" class="form-control date-picker" placeholder="Tentukan Tanggal"  value="<?php echo (isset($payment)?$payment->tanggal:date("Y-m-d")); ?>">
												<span class="help-block"><font color="red"><?php echo form_error('tanggal'); ?></font></span>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p class="c-black f-500 m-b-5 m-t-20">Tipe Pembayaran</p>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
											<div class="fg-line">
												<?php
													echo form_dropdown('payment_type', array('1'=>'Transfer','2'=>'Cash','3'=>'BG','4'=>'Lain-lain'), (isset($payment)?$payment->payment_type:''), 'class="tag-select"');
												?>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p class="c-black f-500 m-b-5 m-t-20">Pilih Rekening</p>
										<div class="input-group form-group">
											<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
												<div class="dtp-container fg-line">
												<?php 
													echo form_dropdown('rek', $opt_bank, (isset($payment)?$payment->rek:''), 'class="tag-select"');
												?>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<p class="c-black f-500 m-b-5">Note</p>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-format-subject"></i></span>
											<div class="col-sm-12">
												<div class="fg-line">    
													<input name="note" type="text" class="form-control" value="<?php echo (isset($payment)?$payment->note:'');?>"></input>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4" style="display:none;">
										<p class="c-black f-500 m-b-5">Akun</p>
										<div class="input-group form-group">
											<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
												<div class="dtp-container fg-line">
												<?php 
													echo form_dropdown('akun', $akunall, '103101', 'class="tag-select"');
												?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3" style="display:none;">
									<p class="c-black f-500 m-b-10">Jenis</p>
									<label class="radio radio-inline m-r-20">
										<input type="radio" checked name="jenis" value="1"> 
										<i class="input-helper"></i>  
										Kredit
									</label>
								</div>
								<!--div class="row">
									<div class="col-sm-3">
										<p class="c-black f-500 m-b-5 m-t-20">Payment Method</p><br>
										
										<label class="radio radio-inline m-r-10">
											<i class="zmdi zmdi-local-atm"></i> <input checked  type="radio" name="payment"  onchange="getbank(this);" value="c">
											<i class="input-helper"></i>  
											Cash
										</label>
													
										<label class="radio radio-inline m-r-10">
											<i class="zmdi zmdi-swap"></i> 
											<input  type="radio" name="payment"  onchange="getbank(this);" value="t">
											<i class="input-helper"></i>  
											Bank Transfer
										</label>
									</div>
									<div class="col-sm-6">
										<p class="c-black f-500 m-b-5 m-t-20">&nbsp;</p><br>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-local-atm"></i></span>
											<div class="col-sm-12">
												<div class="fg-line">
													<label class="radio radio-inline m-r-10">
														<div id="bank"></div>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<p class="c-black f-500 m-b-5 m-t-20"><a href="arsenal.html#modalColor" data-target-color="cyan" data-toggle="modal" class="btn btn-block bgm-cyan waves-effect" id="f_ar_btcek">Lihat Piutang</a></p>
									</div>
								</div-->
								<div id="divdetail"></div>
								<hr>
								<div class="row">
									<div class="col-sm-offset-9 col-sm-3">
										<p class="c-black f-500 m-b-5">Sisa Piutang</p>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
											<div class="fg-line">
												<input type="text" id="sub_tot" name="sub_tot" readonly class="rupiah form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="sembunyi">
											<p class="c-black f-500 m-b-5">PPh</p>
											<div class="input-group">
												<div class="fg-line">
													<label class="radio trig_pph radio-inline m-r-20">
													<input type="radio" name="pph" value="1">
													<i class="input-helper"></i>  
													PPh 22
												</label>
												
												<label class="radio trig_pph radio-inline m-r-20">
													<input type="radio" name="pph" value="2">
													<i class="input-helper"></i>  
													PPh 23
												</label>
												<label class="radio trig_pph radio-inline">
													<input checked type="radio" name="pph" value="0">
													<i class="input-helper"></i>  
													No PPh
												</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="sembunyi">
											<p class="c-black f-500 m-b-5">PPn</p>
											<div class="input-group">
												<div class="fg-line">
													<label class="radio trig_np radio-inline m-r-20">
														<input type="radio" name="np" value="1">
														<i class="input-helper"></i>  
														PPn
													</label>
													<label class="radio trig_np radio-inline">
														<input checked type="radio" name="np" value="0">
														<i class="input-helper"></i>  
														No PPn
													</label>
												</div>
										</div>
										</div>
									</div>
									
								</div><br>
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-4">
												<div class="sembunyi">
													<p class="c-black f-500 m-b-5">Nominal PPh</p>
													<div class="input-group">
														<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
														<div class="fg-line">
															<input type="text" readonly id="pph" name="nom_pph" class="rupiah form-control">
														</div>
													</div>
												</div>
											</div>
											<div class=" col-sm-4">
												<div class="sembunyi">
													<p class="c-black f-500 m-b-5">Nominal PPn</p>
													<div class="input-group">
														<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
														<div class="fg-line">
															<input type="text" readonly id="np" name="np" class="rupiah form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-offset-1 col-sm-3">
												<div class="sembunyi">
													<p class="c-black f-500 m-b-5">PPh + PPn</p>
													<div class="input-group">
														<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
														<div class="fg-line">
															<input type="text" readonly id="pphnp" name="pphnp" class="rupiah form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3">
												<p class="c-black f-500 m-b-5 m-t-20">Biaya Adm Bank</p>
												<div class="input-group">
													<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
													<div class="fg-line">
														<input type="text" id="b_admin" name="b_admin" class="rupiah form-control trig_angka_fin" value="<?php echo isset($payment)?$payment->adm_bank:''; ?>">
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="sembunyi">
												<p class="c-black f-500 m-b-5 m-t-20">Biaya Materai</p>
												<div class="input-group">
													<div class="fg-line">
														<label class="radio trig_angka_fin radio-inline m-r-20">
															<input type="radio" name="b_materai" class="materai" value="1">
															<i class="input-helper"></i>  
															Ya
														</label>
														<label class="radio trig_angka_fin radio-inline">
															<input checked type="radio" name="b_materai" class="materai" value="0">
															<i class="input-helper"></i>  
															Tidak
														</label>
													</div>
												</div>
												</div>
											</div>
											<div class="col-sm-3">
												<p class="c-black f-500 m-b-5 m-t-20">Pendapatan Lain2</p>
												<div class="input-group">
													<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
													<div class="fg-line">
														<input type="text" id="b_lain" name="b_lain" class="rupiah form-control trig_angka_fin" value="<?php echo isset($payment)?$payment->lainlain:''; ?>">
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<p class="c-black f-500 m-b-5 m-t-20">Total Biaya Extra</p>
												<div class="input-group">
													<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
													<div class="fg-line">
														<input name="biaya_extra" readonly type="text" id="biaya_extra_fin" placeholder="Total Biaya Extra" class="rupiah form-control" value="0"></input>
													</div>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-offset-9 col-sm-3">
												<p class="c-black f-500 m-b-5">Grand Total</p>
												<div class="input-group">
													<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
													<div class="fg-line">
														<input name="grand" id="grand" type="text" readonly placeholder="Grand Total" class="rupiah form-control"></input>
													</div>
												</div>
											</div>
										</div>
									</div>
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
	
	 <div class="modal fade" data-modal-color="" id="modalColor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Daftar Invoice yang belum Terbayar</h4>
				</div>
				<div class="modal-body"  >
					<div class="table-responsive" tabindex="5" style="overflow: hidden; outline: none;">
					<div id="tbl"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" id="f_grid_ok">Selesai</button>
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
		function getbank(nil){
			if(nil.value=='c'){
				$('#bank').html('');
			}else{
				$.ajax({url:"<?php echo base_url(); ?>Finance/getbank/",
					success:function(result){
						$('#bank').html(result);
						 if($('.tag-select')[0]) {
							$('.tag-select').chosen({
								width: '100%',
								allow_single_deselect: true
							});
						}
					}
				}); 
				
			}
		};
		$(document).ready(function(){
			$('.tooltipss').tooltipster();
			
			var next_serv = '<?php echo isset($next_serv)?$next_serv:''; ?>';
			var sitee = '<?php echo (!empty($sitee)?$sitee:''); ?>';
			var inv = '<?php echo (!empty($inv)?$inv:''); ?>';
			var edit = '<?php echo isset($id_edit)?$id_edit:'';?>';
			var suming = 0;
			////////////////////////////////////////////////////////////////////////////
			$(".rupiah").inputmask("currency");
			
			$('body').on('click', '#btn-color-targets > .btn', function(){
				var color = $(this).data('target-color');
				$('#modalColor').attr('data-modal-color', color);
				$('#modalColor2').attr('data-modal-color', color);
			});
			
			var total_cpe = 0;
			
			//FINANCE////////////////////////////////
			if(sitee!=''){
				$("#divdetail").html('');
				var opt_data = {
					id : $("#payment_ar_client").val(),
					flag : $("#flag").val(),
					flagdp : $("#flagdp").val(),
					edit : edit,
					id_inv : inv
				};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/cari",
					type:'POST',
					data: opt_data,
					success:function(result){
						$("#inv_nest").html(result);
						$(".animate_inv").show('normal');
						if($('.tag-select')[0]) {
							$('.tag-select').chosen({
								width: '100%',
								allow_single_deselect: true
							});
						}
						
						// $('#id_inv').change(function(){
							// alert('a');
							// var dat={'nota':$('#id_inv').val(),'biaya_extra':$('#biaya_extra_fin').val()};
							var dat={'nota':inv,'biaya_extra':$('#biaya_extra_fin').val(),edit:edit};
							$.ajax({
								url:"<?php echo base_url(); ?>Finance/get_f_ardetail",
								type:'POST',
								data:dat,
								success:function(result){
									// alert(result);
									$('#formall').show("normal");
									var arr = result.split('__');
									$('#divdetail').html(arr[0]);
									$('#sub_tot').val(arr[1]);
									$('#grand').val(arr[2]);
									suming = arr[3] / 1.1;
									// $('#grand_ori').val(arr[2]);
									if(arr[4]==2){
										$('.sembunyi').hide("normal");
									}
									
									if(edit!=''){
										var id = 'kurangfix_1';
										var id2 = id.split('_');
										f_keyup(id2);
									}
									$(".trig_nominal, .trig_nominal_ppn, .trig_bayar").keyup(function() {
										var id = this.id;
										var id2 = id.split('_');
										f_keyup(id2);
									});
									$(".rupiah").inputmask("currency");
								}
							});
							// $('#modalColor').modal('toggle');
						// });
					}
				});
			}
			function f_keyup(id2){
				
				// var nom = $("#nominal_"+id2[1]).val();
				// if (typeof nom != "undefined" && nom != '') {
					// nom = nom.replace(/,/g, '');
				// }
				// var ppn = $("#nominalppn_"+id2[1]).val();
				// if (typeof ppn != "undefined" && ppn != '') {
					// ppn = ppn.replace(/,/g, '');
				// }
				var byr = $("#bayar_"+id2[1]).val();
				if (typeof byr != "undefined" && byr != '') {
					byr = byr.replace(/,/g, '');
				}else{
					byr = 0;
				}
				
				var instalasi = $("#instalasi_"+id2[1]).val();
				if (typeof instalasi != "undefined" && instalasi != '') {
					instalasi = instalasi.replace(/,/g, '');
				}else{
					instalasi = 0;
				}
				
				var byr_voucher = $("#voucher_"+id2[1]).val();
				if (typeof byr_voucher != "undefined" && byr_voucher != '') {
					byr_voucher = byr_voucher.replace(/,/g, '');
				}else{
					byr_voucher = 0;
				}
				
				var kurang = $("#kurangfix_"+id2[1]).val();
				if (typeof kurang != "undefined" && kurang != '') {
					kurang = kurang.replace(/,/g, '');
				}else{
					kurang = 0;
				}
				var kekurangan = parseFloat(kurang) - parseFloat(byr) - parseFloat(instalasi) - parseFloat(byr_voucher);	
				// alert(kekurangan);
				// kekurangan = kekurangan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
				// $("#kurang_"+id2[1]).html(kekurangan);
				// $(".rupiah").inputmask("currency");
				// var jml = parseFloat(ppn) + parseFloat(nom);							
				var jml = parseFloat(byr);				
				// $("#subtotal_"+id2[1]).val(jml);
				
				// $("#subtotal_"+id2[1]).change(function() {
					var numOri = $('.hitung_invoice').length;
					// var nom = 0;
					// var ppn = 0;
					var byr = 0;
					var biaya_extra = $( "#biaya_extra_fin" ).val();
					// alert('1---'+biaya_extra);
					if (typeof biaya_extra != "undefined" && biaya_extra != '') {
						biaya_extra = biaya_extra.replace(/,/g, '');
					}
					// alert('2---'+biaya_extra);
					var pphnp = $( "#pphnp" ).val();
					if (typeof pphnp != "undefined" && pphnp != '') {
						pphnp = pphnp.replace(/,/g, '');
					}
					total_cpe = kekurangan;
					// for (var i = 1; i <= numOri; i++){
						// // nom = $("#nominal_"+i).val();
						// // if (typeof nom != "undefined" && nom != '') {
							// // nom = nom.replace(/,/g, '');
						// // }
						// // ppn = $("#nominalppn_"+i).val();
						// // if (typeof ppn != "undefined" && ppn != '') {
							// // ppn = ppn.replace(/,/g, '');
						// // }
						// byr = $("#bayar_"+i).val();
						// if (typeof byr != "undefined" && byr != '') {
							// byr = byr.replace(/,/g, '');
						// }
						// // total_cpe = parseFloat(total_cpe) + parseFloat(nom) + parseFloat(ppn);
						// total_cpe = parseFloat(total_cpe) + parseFloat(byr);
					// }
					// $("#sub_tot").val(total_cpe);
					$("#sub_tot").val(kekurangan);
					// $("#grand_ori").val(total_cpe);
					if(biaya_extra==''){
						total_cpe = parseFloat(total_cpe) - 0;
					}else{
						
						total_cpe = parseFloat(total_cpe) - parseFloat(biaya_extra);
					}
					if(pphnp==''){
						total_cpe = parseFloat(total_cpe) - 0;
					}else{
						total_cpe = parseFloat(total_cpe) - parseFloat(pphnp);
					}
					$("#grand").val(total_cpe);
					
				// });
			}
			$("#payment_ar_client").change(function(){
				$("#divdetail").html('');
				var opt_data = {
					id : $("#payment_ar_client").val(),
					flag : $("#flag").val(),
					flagdp : $("#flagdp").val(),
					edit : edit,
					id_inv : inv
				};
				$.ajax({
					url:"<?php echo base_url(); ?>finance/cari",
					type:'POST',
					data: opt_data,
					success:function(result){
						$("#inv_nest").html(result);
						$(".animate_inv").show('normal');
						if($('.tag-select')[0]) {
							$('.tag-select').chosen({
								width: '100%',
								allow_single_deselect: true
							});
						}
						
						$('#id_inv').change(function(){
							// alert('a');
							// var dat={'nota':$('#id_inv').val(),'biaya_extra':$('#biaya_extra_fin').val()};
							var dat={'nota':$('#id_inv').val(),'biaya_extra':$('#biaya_extra_fin').val()};
							$.ajax({
								url:"<?php echo base_url(); ?>Finance/get_f_ardetail",
								type:'POST',
								data:dat,
								success:function(result){
									// alert(result);
									$('#formall').show("normal");
									var arr = result.split('__');
									$('#divdetail').html(arr[0]);
									$('#sub_tot').val(arr[1]);
									$('#grand').val(arr[2]);
									suming = arr[3] / 1.1;
									// $('#grand_ori').val(arr[2]);
									if(arr[4]==2){
										$('.sembunyi').hide("normal");
									}
									
									$(".trig_nominal, .trig_nominal_ppn, .trig_bayar").keyup(function() {
										var id = this.id;
										var id2 = id.split('_');
										// var nom = $("#nominal_"+id2[1]).val();
										// if (typeof nom != "undefined" && nom != '') {
											// nom = nom.replace(/,/g, '');
										// }
										// var ppn = $("#nominalppn_"+id2[1]).val();
										// if (typeof ppn != "undefined" && ppn != '') {
											// ppn = ppn.replace(/,/g, '');
										// }
										var byr = $("#bayar_"+id2[1]).val();
										if (typeof byr != "undefined" && byr != '') {
											byr = byr.replace(/,/g, '');
										}else{
											byr = 0;
										}
										
										var instalasi = $("#instalasi_"+id2[1]).val();
										if (typeof instalasi != "undefined" && instalasi != '') {
											instalasi = instalasi.replace(/,/g, '');
										}else{
											instalasi = 0;
										}
										
										var byr_voucher = $("#voucher_"+id2[1]).val();
										if (typeof byr_voucher != "undefined" && byr_voucher != '') {
											byr_voucher = byr_voucher.replace(/,/g, '');
										}else{
											byr_voucher = 0;
										}
										
										var kurang = $("#kurangfix_"+id2[1]).val();
										if (typeof kurang != "undefined" && kurang != '') {
											kurang = kurang.replace(/,/g, '');
										}
										var kekurangan = parseFloat(kurang) - parseFloat(byr) - parseFloat(instalasi) - parseFloat(byr_voucher);	
										// kekurangan = kekurangan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
										// $("#kurang_"+id2[1]).html(kekurangan);
										// $(".rupiah").inputmask("currency");
										// var jml = parseFloat(ppn) + parseFloat(nom);							
										var jml = parseFloat(byr);				
										// $("#subtotal_"+id2[1]).val(jml);
										
										// $("#subtotal_"+id2[1]).change(function() {
											var numOri = $('.hitung_invoice').length;
											// var nom = 0;
											// var ppn = 0;
											var byr = 0;
											var biaya_extra = $( "#biaya_extra_fin" ).val();
											// alert('1---'+biaya_extra);
											if (typeof biaya_extra != "undefined" && biaya_extra != '') {
												biaya_extra = biaya_extra.replace(/,/g, '');
											}
											// alert('2---'+biaya_extra);
											var pphnp = $( "#pphnp" ).val();
											if (typeof pphnp != "undefined" && pphnp != '') {
												pphnp = pphnp.replace(/,/g, '');
											}
											total_cpe = kekurangan;
											// for (var i = 1; i <= numOri; i++){
												// // nom = $("#nominal_"+i).val();
												// // if (typeof nom != "undefined" && nom != '') {
													// // nom = nom.replace(/,/g, '');
												// // }
												// // ppn = $("#nominalppn_"+i).val();
												// // if (typeof ppn != "undefined" && ppn != '') {
													// // ppn = ppn.replace(/,/g, '');
												// // }
												// byr = $("#bayar_"+i).val();
												// if (typeof byr != "undefined" && byr != '') {
													// byr = byr.replace(/,/g, '');
												// }
												// // total_cpe = parseFloat(total_cpe) + parseFloat(nom) + parseFloat(ppn);
												// total_cpe = parseFloat(total_cpe) + parseFloat(byr);
											// }
											// $("#sub_tot").val(total_cpe);
											$("#sub_tot").val(kekurangan);
											// $("#grand_ori").val(total_cpe);
											if(biaya_extra==''){
												total_cpe = parseFloat(total_cpe) - 0;
											}else{
												
												total_cpe = parseFloat(total_cpe) - parseFloat(biaya_extra);
											}
											if(pphnp==''){
												total_cpe = parseFloat(total_cpe) - 0;
											}else{
												total_cpe = parseFloat(total_cpe) - parseFloat(pphnp);
											}
											$("#grand").val(total_cpe);
											
										// });
									});
									$(".rupiah").inputmask("currency");
								}
							});
							// $('#modalColor').modal('toggle');
						});
					}
				});
			});
			
			//for form ar payment ---------------------------
			var f_ar_grid='';
			$('.filter_merah').click(function(){
				var id_region = $('#id_region').val();
				var ppnflag = $('#ppnflag').val();
				window.location.href = "<?php echo base_url(); ?>finance/merah/" + id_region + "/" + ppnflag;
			});
			
			$('#id_client_kp').change(function(){
				// alert($('#id_client_kp').val());
				var dat={'id_client':$('#id_client_kp').val()};
				$.ajax({
					url:"<?php echo base_url(); ?>Finance/ajax_get_invoice",
					type:'POST',
					data:dat,
					success:function(result){
						$('#invoice_nest').html(result);
						if($('.tag-select')[0]) {
							$('.tag-select').chosen({
								width: '100%',
								allow_single_deselect: true
							});
						}
					}
				});
			});
			
			$('#id_order').change(function(){
				var dat={'id':$('#id_order').val()};
				$.ajax({
					url:"<?php echo base_url(); ?>Finance/ajax_order",
					type:'POST',
					data:dat,
					success:function(result){
						$('#order_nest').html(result);
						if($('.tag-select')[0]) {
							$('.tag-select').chosen({
								width: '100%',
								allow_single_deselect: true
							});
						}
					}
				});
			});
			
			
			$('.trig_pph').click(function(){
				var pph = $(".trig_pph input[type='radio']:checked").val();
				var sum = 0;
				$('.trig_nominal').each(function(){
					var a = this.value;
					if (typeof a != "undefined" && a != '') {
						a = a.replace(/,/g, '');
					}
					sum += parseFloat(a);  // Or this.innerHTML, this.innerText
				});
				var nom_pph = 0;
				if(pph==1){
					nom_pph = Math.round(suming * 0.015);
				}else if(pph==2){
					nom_pph = Math.round(suming * 0.02);
				}else if(pph==3){
					nom_pph = Math.round(suming * 0.02 * 0.015);
				}else if(pph==0){
					nom_pph = 0;
				}
				$("#pph").val(nom_pph);
				var sub_tot = $("#sub_tot").val();
				if (typeof sub_tot != "undefined" && sub_tot != '') {
					sub_tot = sub_tot.replace(/,/g, '');
				}
				var biaya_extra_fin = $("#biaya_extra_fin").val();
				if (typeof biaya_extra_fin != "undefined" && biaya_extra_fin != '') {
					biaya_extra_fin = biaya_extra_fin.replace(/,/g, '');
				}else{
					biaya_extra_fin = 0;
				}
				var np = $("#np").val();
				if(np!=''){
					if (typeof np != "undefined" && np != '') {
						np = np.replace(/,/g, '');
					}
					var tambahin = parseFloat(np) + parseFloat(nom_pph);					
					$("#pphnp").val(tambahin);
					var grandend = parseFloat(sub_tot) - parseFloat(tambahin) - parseFloat(biaya_extra_fin);
				}else{
					$("#pphnp").val(nom_pph);
					var grandend = parseFloat(sub_tot) - parseFloat(nom_np) - parseFloat(biaya_extra_fin);
				}
				$("#grand").val(grandend);
			});
			$('.trig_np').click(function(){
				var np = $(".trig_np input[type='radio']:checked").val();
				var sum = 0;
				$('.trig_nominal').each(function(){
					var a = this.value;
					if (typeof a != "undefined" && a != '') {
						a = a.replace(/,/g, '');
					}
					sum += parseFloat(a);  // Or this.innerHTML, this.innerText
				});
				// alert(suming);
				var nom_np = 0;
				if(np==1){
					nom_np = Math.round(suming * 0.1);
				}else if(np==0){
					nom_np = 0;
				}
				$("#np").val(nom_np);
				var sub_tot = $("#sub_tot").val();
				if (typeof sub_tot != "undefined" && sub_tot != '') {
					sub_tot = sub_tot.replace(/,/g, '');
				}
				var biaya_extra_fin = $("#biaya_extra_fin").val();
				if (typeof biaya_extra_fin != "undefined" && biaya_extra_fin != '') {
					biaya_extra_fin = biaya_extra_fin.replace(/,/g, '');
				}else{
					biaya_extra_fin = 0;
				}
				var pph = $("#pph").val();
				if(pph!=''){
					if (typeof pph != "undefined" && pph != '') {
						pph = pph.replace(/,/g, '');
					}
					var tambahin = parseFloat(pph) + parseFloat(nom_np);
					$("#pphnp").val(tambahin);					
					var grandend = parseFloat(sub_tot) - parseFloat(tambahin) - parseFloat(biaya_extra_fin);
				}else{
					$("#pphnp").val(nom_np);
					var grandend = parseFloat(sub_tot) - parseFloat(nom_np) - parseFloat(biaya_extra_fin);
				}
				$("#grand").val(grandend);
			});				
		
			function update_pembayaran(){
				
				$(".trig_angka_fin").bind("keyup change click",function(){
					var id = this.id;
					var b_admin = $('#b_admin').val();
					if (typeof b_admin != "undefined" && b_admin != '') {
						b_admin = b_admin.replace(/,/g, '');
					}else{
						b_admin = 0;
					}
					var b_lain = $('#b_lain').val();
					if (typeof b_lain != "undefined" && b_lain != '') {
						b_lain = b_lain.replace(/,/g, '');
					}else{
						b_lain = 0;
					}
					
					// var b_materai = $('#b_materai').val();
					// if (typeof b_materai != "undefined" && b_materai != '') {
						// b_materai = b_materai.replace(/,/g, '');
					// }else{
						// b_materai = 0;
					// }
					var b_materai = $('input[name=b_materai]:checked').val();
					if (b_materai=='1') {
						var mamat = $('#nominalmaterai').val();
						b_materai = mamat;							
						// if(nall>1000000){
							// b_materai = 6000;							
						// }else{
							// b_materai = 3000;
						// }
					}else{
						b_materai = 0;
					}
					// if(b_admin==''){
						// var tot = 0 + parseFloat(b_materai);
					// }else if(b_materai==''){
						// var tot = parseFloat(b_admin) + 0;
					// }else if(b_lain==''){
						// var tot = parseFloat(b_lain) + 0;
					// }else{
						var tot = parseFloat(b_admin) + parseFloat(b_materai);
					// }
					
					$('#biaya_extra_fin').val(tot);
					
					var sub_tot = $('#sub_tot').val();
					if (typeof sub_tot != "undefined" && sub_tot != '') {
						sub_tot = sub_tot.replace(/,/g, '');
					}else{
						sub_tot = 0;
					}
					
					var pphnp = $('#pphnp').val();
					if (typeof pphnp != "undefined" && pphnp != '') {
						pphnp = pphnp.replace(/,/g, '');
					}else{
						pphnp = 0;
					}
					var grand = 0;
					grand = parseFloat(sub_tot) - parseFloat(tot) - parseFloat(pphnp) + parseFloat(b_lain);
					$('#grand').val(grand);
				});			
			}
			update_pembayaran();
			
			$('#f_ar_btcek').click(function(){
				// $("#LoadingImage").show();
				var color = $(this).data('target-color');
				if($("#payment_ar_client").val()!='0'){
					
					var opt_data = {
						id : $("#payment_ar_client").val(),
						flag : $("#flag").val(),
						edit : edit,
						flagdp : $("#flagdp").val()
					};
					$.ajax({
						url:"<?php echo base_url(); ?>finance/cari",
						type:'POST',
						data: opt_data,
						success:function(result){
							$('#tbl').html(result);
							// var val 	= 'tbltruck';
							// grid(val);
							
							// event.preventDefault();
							
							$('#modalColor').attr('data-modal-color', color);
							$('#tbl').attr('style', 'color:black');
							var rowIds = [];
							$("#data-table-selection").bootgrid({
								css: {
									icon: 'zmdi icon',
									iconColumns: 'zmdi-view-module',
									iconDown: 'zmdi-expand-more',
									iconRefresh: 'zmdi-refresh',
									iconUp: 'zmdi-expand-less'
								},
								navigation : 3,
								selection: true,
								multiSelect: true,
								rowSelect: true,
								keepSelection: true
							}).on("selected.rs.jquery.bootgrid", function(e, rows)
								{
									for (var i = 0; i < rows.length; i++)
									{
										rowIds.push(rows[i].id);
									}
									f_ar_grid=rowIds.join(",");
									// alert("Select: " + rowIds.join(","));
								}).on("deselected.rs.jquery.bootgrid", function(e, rows)
								{
									// var rowIds = [];
									for (var i = 0; i < rows.length; i++)
									{
										var index = rowIds.indexOf(rows[i].id);
										rowIds.splice(index, 1);
									}
									f_ar_grid=rowIds.join(",");
								});
							$('.actionBar').addClass('hidden');
							$('#modalColor').modal({show:true});
							// $("#LoadingImage").hide();
					
						}
					}); 
				}else{
					swal("Oops!", "Pastikan Anda telah memilih client..", "error"); 
				}
				
				return false;
			   
				 
			});
			$('#f_ar_btcek1').click(function(){
					var color = $(this).data('target-color');
					 
                    $('#modalColor').attr('data-modal-color', color);
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
			//-----------------------------------------------------------------------------------------
			
		});
		</script>
        
    </body>
</html>