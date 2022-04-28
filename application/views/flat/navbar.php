<div class="navbar navbar-fixed-topxxx navbar-inverse <?php echo BGTHEME; ?>">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?php echo base_url(); ?>finance_dashboard">
			<img src="<?php echo base_url(); ?>assets/images/logo_light.png" alt="">
			<!-- <i class="icon-calendar"></i> <?php echo $this->all_setting['company_name']; ?> -->
		</a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-user"></i></a></li>
			<!-- <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li> -->
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<!-- main menu -->
		<!-- <ul class="nav navbar-nav">
			<li><a href="#">You are in : </a></li>
		</ul> -->

		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?= base_url(); ?>alert_notif"><span class="glyphicon glyphicon-bell"></span><span class="badge" id="alert_notif"></span></a></li>
			<!-- <?php
					$all_session = $this->all_session;
					// pre($all_session);
					// pre($all_session['regional_area_picker']['picker']);
					$regional = $all_session['regional_area_picker']['picker'];
					// pre($regional);
					?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="true">
					 <i class="icon-location3"></i> <?php echo $all_session['regional_area_picker']['current_regional_area']['regional_name']; ?> <i class=" icon-arrow-right5"></i> <?php echo $all_session['regional_area_picker']['current_regional_area']['area_name']; ?>
				</a>
                <?php if (!empty($regional)) : ?>
					<ul class="dropdown-menu dropdown-menu-right">
						<?php
							// if(!empty($regional)):
							$ref = urlencode(base64_encode(current_url()));
							// pre($ref);
							foreach ($regional as $row) :
								$area = $this->regional->all($row['id']);
								$li_class = (!empty($area)) ? 'dropdown-submenu' : '';
								?>
							<li class="<?php echo $li_class; ?>">
								<a href="#"><?php echo $row['name']; ?></a>
								<?php
										if (!empty($area)) :
											?>
									<ul class="dropdown-menu">
										<?php
													foreach ($area as $row_area) :
														$rescope_url = base_url() . 'init/rescope/' . $row_area['code'] . '/' . $ref;
														?>
											<li><a href="<?php echo $rescope_url; ?>"><?php echo $row_area['name']; ?></a></li>
										<?php
													endforeach;
													?>
									</ul>
								<?php
										endif;
										?>
							</li>
						<?php
							endforeach;
							// endif;
							?>
					</ul>
            <?php endif; ?>
			</li> -->
			<!-- <li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-calendar position-left"></i> <span id="hari_tanggal_sekarang"></span>
				</a>

			</li> -->
			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<span id="my_account_name"><?php echo $this->whoami['keterangan']; ?> </span>
					<i class="caret"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<!-- <li><a onclick="open_modal_profile('<?php echo base_url(); ?>my_profile/update');" href="javascript:void(0);"><i class="icon-user-plus"></i> <?php echo $this->lang->line('all_my_profile'); ?></a></li> -->
					<li><a href="<?php echo base_url(); ?>init"><i class="icon-reset"></i> <?php echo $this->lang->line('all_reload'); ?></a></li>
					<li><a href="<?php echo base_url(); ?>logout"><i class="icon-switch2"></i> <?php echo $this->lang->line('all_logout'); ?></a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- /main navbar -->

<!--  -->
<div class="navbar navbar-default" id="navbar-second">
	<ul class="nav navbar-nav no-border visible-xs-block">
		<li><a class="text-center collapsed legitRipple" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-second-toggle">
		<?php
		$arr_menu = $this->session->userdata('arr_menu');
		// pre($arr_menu);
		if (!empty($arr_menu)) :
			?>
			<ul class="nav navbar-nav navbar-nav-material">
				<?php
					foreach ($arr_menu as $top) :
						$top_li_class = (!empty($top['child'])) ? 'class="dropdown"' : '';
						$top_caret = (!empty($top['child'])) ? '<span class="caret"></span>' : '';
						$top_dropdown_class = (!empty($top['child'])) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';
						?>
					<li <?php echo $top_li_class; ?>>
						<a href="<?php echo $top['url']; ?>" <?php echo $top_dropdown_class; ?>>
							<i class="<?php echo $top['icon']; ?> position-left"></i> <?php echo $top['label']; ?> <?php echo $top_caret; ?>
						</a>

						<?php
								if (!empty($top['child'])) :
									?>
							<ul class="dropdown-menu">
								<?php
											foreach ($top['child'] as $second) :
												// pre($second);
												$second_li_class = (!empty($second['child'])) ? 'class="dropdown-submenu"' : '';
												$second_dropdown_class = (!empty($second['child'])) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';
												?>
									<li <?php echo $second_li_class; ?>>
										<a href="<?php echo $second['url']; ?>" <?php echo $second_dropdown_class; ?>><?php echo $second['label']; ?></a>
										<?php
														if (!empty($second['child'])) :
															?>
											<ul class="dropdown-menu">
												<?php
																	foreach ($second['child'] as $third) :
																		// pre($second);
																		$third_li_class = (!empty($third['child'])) ? 'class="dropdown-submenu"' : '';
																		$third_dropdown_class = (!empty($third['child'])) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';
																		?>
													<li <?php echo $third_li_class; ?>>
														<a href="<?php echo $third['url']; ?>"><?php echo $third['label']; ?></a>
													</li>
												<?php
																	endforeach;
																	?>
											</ul>
										<?php
														endif;
														?>
									</li>
								<?php
											endforeach;
											?>
							</ul>
						<?php
								endif;
								?>


					</li>
				<?php
					endforeach;
					?>

			</ul>
		<?php
		endif;
		?>

	</div>
</div>


<!--
<div class="breadcrumb-line">
	<?php
	if (!empty($breadcrumb)) :
		?>
		<ul class="breadcrumb">
			<?php
				foreach ($breadcrumb as $label => $link) :
					?>
					<li><a href="<?php echo $link; ?>"> <?php echo $label; ?></a></li>
				<?php
					endforeach;
					?>
		</ul>
	<?php
	endif;
	?>
	<ul class="breadcrumb">
		<li><a href="#">Stand</a></li>
		<li><a href="#">Alone</a></li>
		<li class="active">Component</li>
	</ul>
	<ul class="breadcrumb-elements">
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-help"></i> Help</a>
			<ul class="dropdown-menu dropdown-menu-right">
				<li>
					<a onclick="open_bug_report();" href="javascript:void(0);"><i class="icon-bug2 position-left"></i> Bug Report</a>
					<a href="#"><i class="icon-bookmark4 position-left"></i> User Guide</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
-->