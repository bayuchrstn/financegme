		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Proses Tutup Buku</h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>akuntansi/proses_tutup">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
								<div class="col-sm-4">
									<p class="c-black f-500 m-b-10 m-t-5">Tanggal</p>
									<div class="input-group">
										<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
										<div class="fg-line">
											<input type='text' name="date" class="form-control date-picker" value="<?php echo date('Y-m-d'); ?>">
											<span class="help-block"><font color="red"><?php echo form_error('date'); ?></font></span>
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<p class="c-black f-500 m-b-10 m-t-5"> </p>
									<div class="input-group">
										<span class="input-group-addon"> </span>
										<div class="fg-line">
											<button onclick="return confirm('Apakah anda yakin ?')" type="submit" class="btn btn-block bgm-cyan"><br>Tutup<br><br></button><br><br>
										</div>
									</div>
								</div>
							</div>
							<br>
						</div>
					</form>
				</div>
			</div>
		</section>
	</section>
	