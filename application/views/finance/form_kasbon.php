		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Form <?php echo $title; ?></h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>akuntansi/proses_kasbon" >
						
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
								<div class="col-sm-3">      
									<p class="c-black f-500 m-b-15 m-t-5">Profit Center</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('pcenter', $opt_cabang, isset($edit->pc)?$edit->pc:set_value('pcenter'), 'class="tag-select" id="center"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('pcenter'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-4">      
									<p class="c-black f-500 m-b-15 m-t-5">Karyawan</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('id_emp', $opt_emp, isset($edit->id_emp)?$edit->id_emp:set_value('id_emp'), 'class="tag-select" id="id_emp"');
											?>
											<span class="help-block"><font color="red"><?php echo form_error('id_emp'); ?></font></span>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<p class="c-black f-500 m-b-10">Keterangan</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<input name="id" type="hidden" value="<?php echo isset($edit->id)?$edit->id:''; ?>">
											<input type="text" name="note" class="form-control" value="<?php echo isset($edit->note)?$edit->note:''; ?>">
											<span class="help-block"><font color="red"><?php echo form_error('note'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<p class="c-black f-500 m-b-10 m-t-5">Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="fg-line">
											<input type='text' name="date" class="form-control date-picker" value="<?php echo isset($edit->date)?$edit->date:date('Y-m-d'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('date'); ?></font></span>
										</div>
									</div>
								</div>
								
								<div class="col-sm-2">
									<p class="c-black f-500 m-b-10">Nominal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
										<div class="fg-line">
											<input type="text" required name="nominal" class="form-control" value="<?php echo isset($edit->nominal)?$edit->nominal:''; ?>">
											<span class="help-block"><font color="red"><?php echo form_error('nominal'); ?></font></span>
										</div>
									</div>
								</div>
								<?php
								// $krd = $dbt = '';
								// if($flagakun=='D'){
									// $dbt = 'disabled';
									// $krd = 'checked';
								// }elseif($flagakun=='K'){
									// $dbt = 'checked';
									// $krd = 'disabled';
								// }
								?>
								
								<!--div class="col-md-3">
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
								</div-->
								
								
							</div>
							<br>
							<button type="submit" class="btn btn-block bgm-cyan">Simpan</button><br><br>
						</div>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	