		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Form Jurnal Penyesuaian</h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>akuntansi/add_cart"  enctype="multipart/form-data">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<?php echo isset($page->kode)?'<h3>'.$page->kode.'</h3>':''; ?>
							<div class="row">
								<div class="col-sm-2">
									<p class="c-black f-500 m-b-10 m-t-5">Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="fg-line">
											<input type='hidden' name="name" value="<?php echo isset($edit['name'])?$edit['name']:'temp'; ?>">
											<input type='hidden' name="id" value="<?php echo isset($edit['rowid'])?$edit['rowid']:''; ?>">
											<input type='text' name="date" class="form-control date-picker" value="<?php echo isset($edit['options']['date'])?$edit['options']['date']:date('Y-m-d'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('date'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-3">      
									<p class="c-black f-500 m-b-15 m-t-5">Profit Center</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('pcenter', $opt_cabang, isset($edit['options']['pc'])?$edit['options']['pc']:'3', 'class="tag-select" id="center"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('pcenter'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<p class="c-black f-500 m-b-5 m-t-5">Keterangan</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<input type="text" name="note" class="form-control" value="<?php echo isset($edit['options']['note'])?$edit['options']['note']:set_value('note'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('note'); ?></font></span>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-4">      
									<p class="c-black f-500 m-b-15">Akun</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('akun_d', $akunall, isset($edit['options']['akun']) ? $edit['options']['akun'] : '', 'class="tag-select"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('center'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-2">
									<p class="c-black f-500 m-b-10">Nominal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="fg-line">
											<?php
											$hrsisi = '';
											if(!empty($edit)){
												$hrsisi = 'required';
											}
											?>
											<input type="text" required <?php echo $hrsisi; ?> name="nominal" class="form-control" value="<?php echo isset($edit['price'])?$edit['price']:''; ?>">
											<span class="help-block"><font color="red"><?php echo form_error('nominal'); ?></font></span>
										</div>
									</div>
								</div>
								<?php 
								$dbcek = $kbcek = '';
								if(!empty($edit)){
									if($edit['options']['jenis']==0){
										$dbcek = 'checked';
									}else{
										$kbcek = 'checked';
									}									
								}
								?>
								<div class="col-md-3">
									<p class="c-black f-500 m-b-10">Jenis</p>
									<label class="radio radio-inline m-r-20">
										<input <?php echo $dbcek; ?> type="radio" name="jenis" value="0"> 
										<i class="input-helper"></i>  
										Debit
									</label>
									<label class="radio radio-inline m-r-20">
										<input <?php echo $kbcek; ?> type="radio" name="jenis" value="1"> 
										<i class="input-helper"></i>  
										Kredit
									</label>
								</div>							
							</div>
							<br>
							<?php 
							echo '<button type="submit" class="btn btn-block ">'.$lbl_butt.'</button><br><br>';
							?>
							
							<?php 
							if(!empty($table)){
								?>
								<div class="row">
									<div class="col-sm-12">                       
										<?php echo $table; ?>
									</div>
								</div>
								<br/>
								<?php
							}
							?>
						</div>
						<?php 
						if($save==1){
							echo '<a href="'.base_url().'akuntansi/jurnal/bebas/" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>';							
							echo '<a href="'.base_url().'akuntansi/save_bebas/" style="z-index: 99;" class="btn bgm-cyan btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-check"></i></a>';							
						}
						?>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	