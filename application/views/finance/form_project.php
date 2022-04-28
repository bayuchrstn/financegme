		<section id="content">
			<div class="container">
				<div class="card">
					<div class="card-header bgm-bluegray">
						<h2><i class="zmdi zmdi zmdi-collection-text"></i> Edit Order <small>Silahkan pilih nomor order terlebih dahulu</small></h2>
					</div>
					<form method="POST" action="<?php echo base_url(); ?>finance/order_proses">
						<div class="card-body card-padding">
							<?php 
							$flashmessage   = $this->session->flashdata('message');
							$notifikasi     = $this->session->flashdata('notifikasi');
							echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
							?>
							<div class="row">
								<div class="col-sm-6">                       
									<div class="input-group">
										<span class="input-group-addon">Client</span>
										<div class="fg-line">
											<?php 
												echo '<input type="hidden" name="id_company" id="id_company" class="form-control" value="'.$edit_company->id.'">';
												echo '<input readonly type="text" name="label_company" class="form-control" value="'.$edit_company->nama.'">';											
											?>
										</div>
									</div>
								</div>
								<div class="col-sm-6">                       
									<div class="input-group">
										<span class="input-group-addon">Nomor Order </span>
										<div class="fg-line">
											<?php 
												echo form_dropdown('id_order', $option_order, '', 'class="tag-select order" id="id_order"');
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div id="order_nest"></div>
							</div>
							<br/>
						</div>
						<button type="submit" style="z-index: 99;" id="ms-compose" class="btn bgm-cyan btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-check"></i></button>
						<a href="javascript:history.back()" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>
						<br/>
					</form>
				</div>
			</div>
		</section>
	</section>
	