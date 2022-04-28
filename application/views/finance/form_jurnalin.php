		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Form <?php echo $title; ?></h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>akuntansi/proses_jurnalin"  enctype="multipart/form-data">
						<input name="id_head" type="hidden" value="<?php echo isset($head->id)?$head->id:''; ?>">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<?php echo isset($head->kode)?'<h3>'.$head->kode.'</h3>':''; ?>
							<div class="row">
								<div class="col-sm-2">
									<p class="c-black f-500 m-b-10 m-t-5">Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="fg-line">
											<input type='text' name="date" class="form-control date-picker" value="<?php echo isset($head->date)?$head->date:date('Y-m-d'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('date'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-3">      
									<p class="c-black f-500 m-b-15 m-t-5">Akun</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-link"></i></span>
										<div class="fg-line">
											<?php 
											echo form_dropdown('akun', $opt_bank, isset($head->akun)?$head->akun:set_value('akun'), 'class="tag-select" id="akun"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('akun'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<p class="c-black f-500 m-b-5 m-t-5">Keterangan</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<input type="text" name="note" class="form-control" value="<?php echo isset($head->note)?$head->note:set_value('note'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('note'); ?></font></span>
										</div>
									</div>
								</div>
								<?php 
								$deb = $kre = '';
								if(!empty($head_detail)){
									$deb = $kre = ' disabled ';
									if($head_detail->debit!=''){
										$deb .= 'checked';
									}else{
										$kre .= 'checked';
									}
								}
								?>
								<div class="col-md-3">
									<p class="c-black f-500 m-b-10">Jenis</p>
									<label class="radio radio-inline m-r-20">
										<input type="radio" <?php echo $deb; ?> name="jenis" checked value="D"> 
										<i class="input-helper"></i>  
										Debit
									</label>
									<label class="radio radio-inline m-r-20">
										<input type="radio" <?php echo $kre; ?> name="jenis" value="K" > 
										<i class="input-helper"></i>  
										Kredit
									</label>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-4">      
									<p class="c-black f-500 m-b-15">Akun</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
										<div class="fg-line">
											<input name="id_det" type="hidden" value="<?php echo isset($detail->id)?$detail->id:''; ?>">
											<?php 
												echo form_dropdown('akun_d', $akunall, isset($detail->akun) ? $detail->akun : '', 'class="tag-select"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('center'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-10">Nominal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="fg-line">
											<?php
											$hrsisi = '';
											if(!empty($detail)){
												$hrsisi = 'required';
											}
											?>
											<input type="text" <?php echo $hrsisi; ?> name="nominal" class="form-control" value="<?php echo isset($nom)?$nom:''; ?>">
											<span class="help-block"><font color="red"><?php echo form_error('nominal'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-4">
									<p class="c-black f-500 m-b-10">Keterangan</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<input type="text" name="note_d" class="form-control" value="<?php echo isset($detail->memo)?$detail->memo:''; ?>">
											<span class="help-block"><font color="red"><?php echo form_error('note_d'); ?></font></span>
										</div>
									</div>
								</div>
								
							</div>
							<br>
							<?php 
							if(!empty($page)){
								if(empty($tutup)){
									echo '<button type="submit" class="btn btn-block bgm-cyan">Simpan</button><br><br>';
								}								
							}else{
								echo '<button type="submit" class="btn btn-block bgm-cyan">Simpan</button><br><br>';
							}
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
						
						<a href="<?php echo base_url(); ?>akuntansi/jurnalin/" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>
						<a href="<?php echo base_url(); ?>akuntansi/form_jurnalin/" style="z-index: 99;" class="btn bgm-cyan btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></a>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	