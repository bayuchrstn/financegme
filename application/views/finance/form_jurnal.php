		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Form <?php echo $title; ?></h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>akuntansi/proses_jurnal"  enctype="multipart/form-data">
						<input name="flag" type="hidden" value="<?php echo isset($flag)?$flag:''; ?>" class="form-control">
						<input name="flagcode" type="hidden" value="<?php echo isset($flagcode)?$flagcode:''; ?>" class="form-control">
						<input name="id_head" type="hidden" value="<?php echo isset($page->id)?$page->id:''; ?>">
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
											<input type='text' name="date" class="form-control date-picker" value="<?php echo isset($page->date)?$page->date:date('Y-m-d'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('date'); ?></font></span>
										</div>
									</div>
								</div>
								<?php 
								if($flag!='bebas'){
									?>
									<div class="col-sm-3">      
										<p class="c-black f-500 m-b-15 m-t-5">Akun</p>
										<div class="input-group">
											<span class="input-group-addon"><i class="zmdi zmdi-link"></i></span>
											<div class="fg-line">
												<?php 
													// if($flag=='bebas'){
														// echo form_dropdown('akun', $akunall, isset($page->akun)?$page->akun:set_value('akun'), 'class="tag-select" id="akun"');
													// }else{
														echo form_dropdown('akun', $opt_bank, isset($page->akun)?$page->akun:set_value('akun'), 'class="tag-select" id="akun"');
													// }
												?>
												<span class="help-block"><font color="red"><?php echo form_error('akun'); ?></font></span>
											</div>
										</div>
									</div>
									<?php
								}
								?>
								<div class="col-sm-3">      
									<p class="c-black f-500 m-b-15 m-t-5">Profit Center</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('pcenter', $opt_cabang, isset($page->center)?$page->center:'3', 'class="tag-select" id="center"');
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
											<input type="text" name="note" class="form-control" value="<?php echo isset($page->note)?$page->note:set_value('note'); ?>">
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
											<input name="id" type="hidden" value="<?php echo isset($default['id'])?$default['id']:''; ?>">
											<input name="id_edit" type="hidden" value="<?php echo isset($edit->id)?$edit->id:''; ?>">
											<?php 
												echo form_dropdown('akun_d', $akunall, isset($edit->akun) ? $edit->akun : '', 'class="tag-select"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('center'); ?></font></span>
										</div>
									</div>
								</div>
								<?php 
								$c1 = $c2 = '';
								if(!empty($edit)){
									if($edit->debit==0){
										$nom = $edit->kredit;
										$c2 = 'checked';
									}else if($edit->kredit==0){
										$nom = $edit->debit;
										$c1 = 'checked';
									}
								}
								
								?>
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
											<input type="text" <?php echo $hrsisi; ?> name="nominal" class="form-control" value="<?php echo isset($nom)?$nom:''; ?>">
											<span class="help-block"><font color="red"><?php echo form_error('nominal'); ?></font></span>
										</div>
									</div>
								</div>
								<?php
								$krd = $dbt = '';
								if($flagakun=='D'){
									// $dbt = 'disabled';
									$krd = 'checked';
								}elseif($flagakun=='K'){
									$dbt = 'checked';
									// $krd = 'disabled';
								}
								$disp = 'block';
								if($flag){
									if($flag=='bebas'){
										$disp = 'block';
									}
								}
								?>
								
								<?php 
								if($flag=='bebas'){
									?>
									<div class="col-md-3" style="display:<?php echo $disp; ?>;">
										<p class="c-black f-500 m-b-10">Jenis</p>
										<label class="radio radio-inline m-r-20">
											<input type="radio" <?php echo $dbt; ?> name="jenis" value="0" <?php echo $c1; ?>> 
											<i class="input-helper"></i>  
											Debit
										</label>
										<label class="radio radio-inline m-r-20">
											<input type="radio" <?php echo $krd; ?> name="jenis" value="1" <?php echo $c2; ?>> 
											<i class="input-helper"></i>  
											Kredit
										</label>
									</div>
									<?php
								}
								?>
								<!--div class="col-sm-3">
									<p class="c-black f-500 m-b-10">Keterangan</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<input type="text" name="note_d" class="form-control" value="<?php //echo isset($edit->memo)?$edit->memo:''; ?>">
											<span class="help-block"><font color="red"><?php //echo form_error('note_d'); ?></font></span>
										</div>
									</div>
								</div-->
								
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
						
						<a href="<?php echo base_url(); ?>akuntansi/jurnal/<?php echo $flag; ?>" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>
						<a href="<?php echo base_url(); ?>akuntansi/form_jurnal/<?php echo $flag; ?>" style="z-index: 99;" class="btn bgm-cyan btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></a>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	