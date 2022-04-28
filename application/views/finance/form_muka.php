		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> FORM PENDAPATAN DI MUKA</h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>finance/muka_proses"  enctype="multipart/form-data">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
								<div class="col-sm-12">                       
									<div class="input-group">
										<?php 
										if(empty($edit->id)){
											echo '<span class="input-group-addon">Pilih Rekening : </span>';
										}else{
											echo '<span class="input-group-addon">Rekening : </span>';		
										}
										?>
										<div class="fg-line">
											<input type="hidden" name="id" class="form-control" value="<?php echo isset($edit->id)?$edit->id:'';?>">
											<?php 
												echo form_dropdown('id_bank', $option_bank, isset($edit->id_bank)?$edit->id_bank:set_value('id_bank'), 'class="tag-select" id="id_bank"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('id_bank'); ?></font></span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-5 m-t-20">Rekening</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<input type="text" name="rekening" class="form-control" value="<?php echo isset($edit->rekening)?$edit->rekening:set_value('rekening'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('rekening'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-5 m-t-20">Atas Nama</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-accounts-list"></i></span>
										<div class="fg-line">
											<input type="text" name="an" class="form-control" value="<?php echo isset($edit->an)?$edit->an:set_value('an'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('an'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-5 m-t-20">Nominal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
										<div class="fg-line">
											<input type="text" name="nominal" class="form-control" value="<?php echo isset($edit->nominal)?$edit->nominal:set_value('nominal'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('nominal'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-5 m-t-20">Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="fg-line">
											<input type='text' name="tanggal" class="form-control date-picker" value="<?php echo isset($edit->tanggal)?$edit->tanggal:set_value('tanggal'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('tanggal'); ?></font></span>
										</div>
									</div>
								</div>
							</div>
							<br>
							<?php 
							if(!empty($option_cust)){
								?>
								<div class="row">
									<div class="col-sm-12">                       
										<div class="input-group">
											<span class="input-group-addon">Claim As : </span>
											<div class="fg-line">
												<?php 
													echo form_dropdown('id_cust', $option_cust, '', 'class="tag-select" id="id_cust"');
												?>
												<span class="help-block"><font color="red"><?php echo form_error('id_bank'); ?></font></span>
											</div>
										</div>
									</div>
								</div>
								<br/>
								<?php
							}
							?>
						</div>
						<button type="submit" style="z-index: 99;" id="ms-compose" class="btn bgm-cyan btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-check"></i></button>
						<a href="javascript:history.back()" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	