		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Form Pengisian Kas</h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>akuntansi/proses_tambahkas">
						<input name="id" type="hidden" value="<?php echo isset($edit->id)?$edit->id:''; ?>">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
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
								<div class="col-sm-4">
									<p class="c-black f-500 m-b-5 m-t-5">Regional</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('id_region', $opt_cabang, isset($edit->id_region)?$edit->id_region:'3', 'class="tag-select" id="center"');
											?>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<p class="c-black f-500 m-b-5 m-t-20"> </p>
									<div class="input-group">
										<span class="input-group-addon"></span>
										<div class="fg-line">
											<button type="submit" class="btn btn-block bgm-cyan">Simpan</button>
										</div>
									</div>
								</div>
							</div>
							<br><br>
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
						
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	