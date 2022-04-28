
		<section id="content">

			<div class="container invoice">

				<div class="block-header">

					<h2>Bukti Pembayaran <small>Please use Google Chrome or any other Webkit browsers for better printing.</small></h2>

				</div>
				<?php 
				$flashmessage   = $this->session->flashdata('message');
				$notifikasi     = $this->session->flashdata('notifikasi');
				echo ! empty($flashmessage) ? '<div class="alert alert-'.$notifikasi.'">' . $flashmessage . '</div>': ''; 
				?>
				<div class="card">


					<div class="card-body card-padding">

						<?php echo $content; ?>

					</div>

				</div>

				

			</div>
			
			<?php 
			// if($this->session->userdata('level')!='1'){
				// if($data->status_print==1){
					// echo '<a class="btn btn-float bgm-indigo m-btn" href="javascript:printESCP();"><i class="zmdi zmdi-print"></i></a>';
				// }else{
					// echo '<a class="trig_r_modal btn btn-float bgm-red m-btn" id="id_'.$data->id.'" href="#"><i class="zmdi zmdi-lock-outline"></i></a>';
				// }
			// }else{
				// echo '<a class="btn btn-float bgm-indigo m-btn" href="javascript:printESCP();"><i class="zmdi zmdi-print"></i></a>';
			// }
			?>
			<button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
			<a href="javascript:history.back()" style="right:100px;z-index: 99;" class="btn bgm-amber btn-float m-btn waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-left"></i></a>

			
		</section>
</section>