<body>
	<header id="header">
		<ul class="header-inner">
			<li id="menu-trigger" data-trigger="#sidebar"> 
				<div class="line-wrap">
					<div class="line top"></div>
					<div class="line center"></div>
					<div class="line bottom"></div>
				</div>
			</li>
		
			<li class="logo hidden-xs">
				<!--a href="#">GMEDIA Panel</a-->
				<img src="https://erpsmg.gmedia.id/erp/images/logo-gmedia.png" style="max-height:35px;">
			</li>
			
			
			
			<li class="pull-right visible-xs">
				<ul class="top-menu">
					<li id="toggle-width">
						<div class="toggle-switch">
							<input id="tw-switch" type="checkbox" hidden="hidden">
							<label for="tw-switch" class="ts-helper"></label>
						</div>
					</li>
					<li class="dropdown" style="padding-top:8px;">
						<a data-toggle="dropdown" class="tm-settings" href="invoice.html"></a>
						<ul class="dropdown-menu dm-icon pull-right">
							<li class="hidden-xs">
								<a data-action="fullscreen" href="invoice.html"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>Marketing/home"><i class="zmdi zmdi-accounts"></i> Marketing</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>Finance/home"><i class="zmdi zmdi-money-box"></i> Finance</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>Marketing/logout"><i class="zmdi zmdi-power"></i> Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="pull-right hidden-xs">
				<ul class="top-menu">
					<li id="toggle-width">
						<div class="toggle-switch">
							<input id="tw-switch" type="checkbox" hidden="hidden">
							<label for="tw-switch" class="ts-helper"></label>
						</div>
					</li>
					<?php
						$hover_mart = $hover_fin = '';
						if($this->uri->segment(1)=='Marketing'){
							$hover_mart = 'style="background-color: rgba(0, 0, 0, 0.12);"';
						}else if($this->uri->segment(1)=='Finance'){
							$hover_fin = 'style="background-color: rgba(0, 0, 0, 0.12);"';
						}
						// if($this->session->userdata('id_division')==3){
							echo '<li '.$hover_mart.'>
										<a href="'.base_url().'Marketing/home"><i class="zmdi zmdi-accounts"></i>&nbsp;&nbsp;Marketing</a>
									</li>					
									<li '.$hover_fin.'>
										<a href="'.base_url().'Finance/home"><i class="zmdi zmdi-money-box"></i>&nbsp;&nbsp;Finance</a>
									</li>';
						// }else if($this->session->userdata('id_division')==1){
							// echo '<li '.$hover_fin.'>
										// <a href="'.base_url().'Finance/home"><i class="zmdi zmdi-money-box"></i>&nbsp;&nbsp;Finance</a>
									// </li>';
						// }else if($this->session->userdata('id_division')==6){
							// echo '<li '.$hover_mart.'>
										// <a href="'.base_url().'Marketing/home"><i class="zmdi zmdi-accounts"></i>&nbsp;&nbsp;Marketing</a>
									// </li>';
						// }
					?>
					
					<li >
						<a href="<?php  echo base_url(); ?>Marketing/logout"><i class="zmdi zmdi-power"></i>&nbsp;&nbsp;Logout</a>
					</li>
					<!--
					 <li id="toggle-width">
						<div class="toggle-switch">
							<input id="tw-switch" type="checkbox" hidden="hidden">
							<label for="tw-switch" class="ts-helper"></label>
						</div>
					</li>
					
					 
					
					<li class="dropdown">
						<a data-toggle="dropdown" class="tm-settings" href="invoice.html"></a>
						<ul class="dropdown-menu dm-icon pull-right">
							<li class="hidden-xs">
								<a data-action="fullscreen" href="invoice.html"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
							</li>
							<li>
								<a href="<?php // echo base_url(); ?>main/logout"><i class="zmdi zmdi-power"></i> Logout</a>
							</li>
						</ul>
					</li>
					-->
				</ul>
			</li>
		</ul>
		
		<!-- Top Search Content -->
		<div id="top-search-wrap">
			<form action="<?php echo base_url(); ?>main/search" method="POST">
				<input type="text" name="string">
				<i id="top-search-close">&times;</i>
			</form>
		</div>
	</header>
	
	<section id="main">
		<!--<aside id="sidebar" style="background-image:url('<?php //echo base_url();?>assets/img/boxes2.png');background-position: left bottom;background-repeat: no-repeat;background-attachment: fixed;">-->
		<aside id="sidebar" >
			<div class="sidebar-inner c-overflow">
				<div class="profile-menu">
					<a href="<?php echo base_url(); ?>main/home">
						<div class="profile-pic">
							
						</div>

						<div class="profile-info">
							<?php echo $this->session->userdata('nama'); 
							// $get_kab = $this->Main_model->get_kabupaten($this->session->userdata('id_kota'))->row();
							?>
							<br>
							<?php //echo $get_kab->nama_kab; ?>
						</div>
					</a>

					<ul class="main-menu">
						<!--li>
							<a href="<?php echo base_url(); ?>main/akun"><i class="zmdi zmdi-settings"></i> Change Password</a>
						</li-->
						<li>
							<a href="<?php echo base_url(); ?>main/logout"><i class="zmdi zmdi-power"></i> Logout</a>
						</li>
					</ul>
				</div>

				<ul class="main-menu">
					<?php 
						
						$parents=$this->Main_model->get_menu(0,$divisi)->result();
						// print_r($parents);exit();
						foreach($parents as $parent){
							$childs=$this->Main_model->get_menu($parent->id,$divisi)->result();
							$ada=0;
							$len = count($childs);
							// echo $len;
							if($len==0){
								echo '<li><a href="'.base_url().$parent->link.'"><i class="zmdi zmdi-'.$parent->icon.'"></i> '.$parent->title.'</a></li>';
							}
							foreach($childs as $child){
								$childs2=$this->Main_model->get_menu($child->id,$divisi)->result();
								$len2 = count($childs2);
								$toggle = $toggle_cont = '';
								if(!empty($act_menu)){
									if($parent->title==$act_menu){
										$toggle = 'toggled';
										$toggle_cont = 'style="display:block"';
									}									
								}
								if($ada==0){
									echo '<li class="sub-menu '.$toggle.'">
											<a href="'.base_url().$parent->link.'"><i class="zmdi zmdi-'.$parent->icon.'"></i> '.$parent->title.'</a>
											<ul '.$toggle_cont.'>';
								}
								if($len2==0){
									echo '<li><a href="'.base_url().$child->link.'">'.$child->title.'</a></li>';
								}else{
									$m=0;
									foreach($childs2 as $child2){
										$m++;
										if($m==1){
											echo '<li class="sub-menu">
												<a href="'.base_url().$child->link.'">'.$child->title.'</a>
												<ul>';											
										}
										echo '<li><a href="'.base_url().$child2->link.'">'.$child2->title.'</a></li>';
										if($m==$len2){
											echo '</ul></li>';
										}
									}
								}
								if($ada==$len-1){
									echo '</ul></li>';
								}
								$ada =$ada+1;
								
							}
						}
					?>
				</ul>
			</div>
		</aside>