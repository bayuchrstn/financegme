		<footer id="footer" style="color:black;">

			Copyright &copy; 2016 GMedia
		</footer>

		<!-- Javascript Libraries -->
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/flot/jquery.flot.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/flot/jquery.flot.resize.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/sparklines/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/moment/min/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/Waves/dist/waves.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/chosen_v1.4.2/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bootgrid/jquery.bootgrid.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		<!-- Placeholder for IE9 -->
		<!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
		<script src="<?php echo base_url(); ?>assets/invoice/js/jquery.inputmask.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/invoice/vendors/fileinput/fileinput.min.js"></script>
		<!--script src="<?php 
						?>assets/js/charts.js"></script-->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tooltipster.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/invoice/js/functions.js"></script>
		<!--script src="<?php 
						?>assets/js/demo.js"></script-->
		<script type="text/javascript">
			function getbank(nil) {
				if (nil.value == 'c') {
					$('#bank').html('');
				} else {
					$.ajax({
						url: "<?php echo base_url(); ?>Finance/getbank/",
						success: function(result) {
							$('#bank').html(result);
							if ($('.tag-select')[0]) {
								$('.tag-select').chosen({
									width: '100%',
									allow_single_deselect: true
								});
							}
						}
					});

				}
			};
			$(document).ready(function() {
				$('.tooltipss').tooltipster();

				var next_serv = '<?php echo isset($next_serv) ? $next_serv : ''; ?>';
				var chart_cust = [<?php echo isset($grafik) ? $grafik : ''; ?>];
				var chart_project = [<?php echo isset($grafik2) ? $grafik2 : ''; ?>];
				var chart_sales = [<?php echo isset($grafik3) ? $grafik3 : ''; ?>];
				var chart_invoice = [<?php echo isset($grafik4) ? $grafik4 : ''; ?>];

				function sparklineBar(id, values, height, barWidth, barColor, barSpacing) {
					$('.' + id).sparkline(values, {
						type: 'bar',
						height: height,
						barWidth: barWidth,
						barColor: barColor,
						barSpacing: barSpacing
					})
				}

				function sparklineLine(id, values, width, height, lineColor, fillColor, lineWidth, maxSpotColor, minSpotColor, spotColor, spotRadius, hSpotColor, hLineColor) {
					$('.' + id).sparkline(values, {
						type: 'line',
						width: width,
						height: height,
						lineColor: lineColor,
						fillColor: fillColor,
						lineWidth: lineWidth,
						maxSpotColor: maxSpotColor,
						minSpotColor: minSpotColor,
						spotColor: spotColor,
						spotRadius: spotRadius,
						highlightSpotColor: hSpotColor,
						highlightLineColor: hLineColor
					});
				}
				if ($('.stats-bar')[0]) {
					sparklineBar('stats-bar', chart_cust, '45px', 3, '#fff', 2);
				}
				if ($('.stats-bar-2')[0]) {
					// sparklineBar('stats-bar-2', cash_in, '45px', 3, '#fff', 2);
					sparklineLine('stats-bar-2', chart_project, 85, 45, '#fff', 'rgba(0,0,0,0)', 1.25, 'rgba(255,255,255,0.4)', 'rgba(255,255,255,0.4)', 'rgba(255,255,255,0.4)', 3, '#fff', 'rgba(255,255,255,0.4)');
				}
				if ($('.stats-line')[0]) {
					sparklineBar('stats-line', chart_sales, '45px', 3, '#fff', 2);
				}
				if ($('.stats-line-2')[0]) {
					sparklineLine('stats-line-2', chart_invoice, 85, 45, '#fff', 'rgba(0,0,0,0)', 1.25, 'rgba(255,255,255,0.4)', 'rgba(255,255,255,0.4)', 'rgba(255,255,255,0.4)', 3, '#fff', 'rgba(255,255,255,0.4)');
				}
				////////////////////////////////////////////////////////////////////////////
				$(".rupiah").inputmask("currency");

				$('body').on('click', '#btn-color-targets > .btn', function() {
					var color = $(this).data('target-color');
					$('#modalColor').attr('data-modal-color', color);
					$('#modalColor2').attr('data-modal-color', color);
				});

				var total_cpe = 0;

				//FINANCE////////////////////////////////
				$("#payment_ar_client").change(function() {
					$("#divdetail").html('');
				});

				//invoice piutang
				var grid2p = $("#data-table-ar").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn sa-warning bgm-green btn-default waves-effect command-email\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-email\"></span></a>";
						},
						"link": function(column, row) {
							return "<a href=\"<?php echo base_url() . 'Finance/invoice/'; ?>" + row.id + "\" data-row-id=\"" + row.id + "\">" + row.invoice + "</a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid2p.find(".command-email").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice/" + $(this).data("row-id");
					});
				});
				///////////////////////////////////////////////
				//invoice piutang dp
				var grid2 = $("#data-table-ardp").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn sa-warning bgm-green btn-default waves-effect command-email\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-email\"></span></a>";
						},
						"link": function(column, row) {
							return "<a href=\"<?php echo base_url() . 'Finance/invoice/'; ?>" + row.id + "\" data-row-id=\"" + row.id + "\">" + row.invoice + "</a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid2.find(".command-email").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice_dp/" + $(this).data("row-id");
					});
				});
				///////////////////////////////////////////////
				//invoice so
				var gridso = $("#data-table-so").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn sa-warning bgm-green btn-default waves-effect command-email\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-email\"></span></a>";
						},
						"link": function(column, row) {
							return "<a href=\"<?php echo base_url() . 'Finance/invoice/'; ?>" + row.id + "\" data-row-id=\"" + row.id + "\">" + row.invoice + "</a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					gridso.find(".command-email").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/email_invoice_so/" + $(this).data("row-id");
					});
				});
				//////////////////////////////////////////////////////
				$("#data-table-ar2").bootgrid();
				// $(".data-table-merah").bootgrid();

				var grid_merah = $(".data-table-merah").bootgrid({

					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn bgm-amber btn-default waves-effect command-view\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-email\"> </span></a> <a class=\"btn bgm-green btn-default waves-effect command-note\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"> </span></a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid_merah.find(".command-view").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/email_merah/" + $(this).data("row-id");
					}).end().find(".command-note").on("click", function(e) {
						// e.preventDefault();
						var id = $(this).data("row-id");
						var dat = {
							'id_arpost': id
						};
						$.ajax({
							url: "<?php echo base_url(); ?>Finance/ajax_get_note",
							type: 'POST',
							data: dat,
							success: function(result) {
								$('#history_nest').html(result);
								$('#id_arpost').val(id);
								$('#preventClick').modal('show');
							}
						});
					});
				});

				var grid_lunas = $("#data-table-arlunas").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn bgm-amber btn-default waves-effect command-view\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-time\"> History Pembayaran</span></a>";
						},
						"link": function(column, row) {
							return "<a href=\"<?php echo base_url() . 'Finance/invoice/'; ?>" + row.id + "\" data-row-id=\"" + row.id + "\">" + row.invoice + "</a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid_lunas.find(".command-view").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/view_ar_lunas/" + $(this).data("row-id");
					});
				});

				var grid_so_lunas = $("#data-table-solunas").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn bgm-amber btn-default waves-effect command-view\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-time\"> History Pembayaran</span></a>";
						},
						"link": function(column, row) {
							return "<a href=\"<?php echo base_url() . 'Finance/invoice/'; ?>" + row.id + "\" data-row-id=\"" + row.id + "\">" + row.invoice + "</a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid_so_lunas.find(".command-view").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/view_so_lunas/" + $(this).data("row-id");
					});
				});

				var gridmuka = $("#data-table-muka").bootgrid({
					formatters: {
						"pengirim": function(column, row) {
							return row.bank + " " + row.rek + "<br>" + row.an;
						},
						"commands": function(column, row) {
							if (row.claim == '') {
								return "<a class=\"btn bgm-purple sa-warning btn-default waves-effect command-edit\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span> Claim</a> <a class=\"btn bgm-red sa-warning btn-default waves-effect command-delete\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span> Delete</a>";
							} else {
								return "<a class=\"btn bgm-red sa-warning btn-default waves-effect command-delete\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span> Delete</a>";
							}
						},
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					gridmuka.find(".command-edit").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/form_muka/" + $(this).data("row-id");
					}).end().find(".command-delete").on("click", function(e) {
						var id = $(this).data("row-id");
						swal({
							title: "Are you sure?",
							text: "You will not be able to recover this record!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						}, function() {
							window.location.href = "<?php echo base_url(); ?>finance/del_muka/" + id;
						});
					});
				});

				var grid = $("#data-table-cust").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn bgm-purple sa-warning btn-default waves-effect command-edit\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></a>";
						},
						"commands2": function(column, row) {
							return "<a class=\"btn bgm-red sa-warning btn-default waves-effect command-delete\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid.find(".command-edit").on("click", function(e) {
						// alert("You pressed edit on row: " + $(this).data("row-id"));
						var flag = '<?php echo isset($flag) ? $flag : ""; ?>';
						if (flag == 'cust') {
							window.location.href = "<?php echo base_url(); ?>marketing/customer_new/" + $(this).data("row-id");
						} else if (flag == 'proj') {
							window.location.href = "<?php echo base_url(); ?>marketing/form_order/" + $(this).data("row-id");
						} else if (flag == 'so') {
							window.location.href = "<?php echo base_url(); ?>marketing/createorder/" + $(this).data("row-id");
						}
					}).end().find(".command-delete").on("click", function(e) {
						var id = $(this).data("row-id");
						swal({
							title: "Are you sure?",
							text: "You will not be able to recover this record!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						}, function() {
							// swal("Deleted!", "Your record has been deleted.", "success"); 
							window.location.href = "<?php echo base_url(); ?>marketing/del_<?php echo isset($flag) ? $flag : ""; ?>/" + id;
						});
					});
				});

				var grid3 = $("#data-table-cust-fin").bootgrid({
					formatters: {
						"commands": function(column, row) {
							return "<a class=\"btn bgm-purple sa-warning btn-default waves-effect command-edit\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></a>";
						}
					}
				}).on("loaded.rs.jquery.bootgrid", function() {
					/* Executes after data is loaded and rendered */
					grid3.find(".command-edit").on("click", function(e) {
						window.location.href = "<?php echo base_url(); ?>finance/form_order_fin/" + $(this).data("row-id");
					});
				});


				//for form ar payment ---------------------------
				var f_ar_grid = '';

				$('.filter_daterange').click(function() {
					var id_filter = this.id;
					var id_region = $('#id_region').val();
					var id_region2 = $('#id_region2').val();
					var ppnflag = $('#ppnflag').val();
					var ppnflag2 = $('#ppnflag2').val();
					var dari = $('#tdari').val();
					if (dari == '') {
						dari = 0;
					}
					var sampai = $('#tsampai').val();
					if (sampai == '') {
						sampai = 0;
					}
					if (id_filter == 'filter_ar') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag;
					} else if (id_filter == 'filter_arlunas') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar_lunas/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag;
					} else if (id_filter == 'filter_arpiutang') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar_piutang/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag;
					} else if (id_filter == 'filter_cust') {
						window.location.href = "<?php echo base_url(); ?>marketing/customers/" + dari + "/" + sampai;
					} else if (id_filter == 'filter_proj') {
						window.location.href = "<?php echo base_url(); ?>marketing/project_order/" + dari + "/" + sampai;
					} else if (id_filter == 'filter_so') {
						window.location.href = "<?php echo base_url(); ?>marketing/sales_order/" + dari + "/" + sampai;
					} else if (id_filter == 'filter_inv_so') {
						window.location.href = "<?php echo base_url(); ?>finance/invoice_so/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag;
					} else if (id_filter == 'filter_piutang_so') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar_so/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag;
					} else if (id_filter == 'filter_lunas_so') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar_so_lunas/" + dari + "/" + sampai + "/" + id_region + "/" + ppnflag;
					} else if (id_filter == 'filter_ar_dp') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar_dp/" + dari + "/" + sampai + "/" + id_region2 + "/" + ppnflag2;
					} else if (id_filter == 'filter_ar_piutangdp') {
						window.location.href = "<?php echo base_url(); ?>finance/dataar_piutang_dp/" + dari + "/" + sampai + "/" + id_region2 + "/" + ppnflag2;
					} else if (id_filter == 'filter_ar_lunasdp') {
						window.location.href = "<?php echo base_url(); ?>finance/dataardp_lunas/" + dari + "/" + sampai + "/" + id_region2 + "/" + ppnflag2;
					} else if (id_filter == 'filter_muka') {
						window.location.href = "<?php echo base_url(); ?>finance/muka/" + dari + "/" + sampai;
					} else if (id_filter == 'kartu_piutang') {
						var id_client = $('#id_client_kp').val();
						var id_order = $('#id_order_kp').val();
						var dari = $('#tdari_kp').val();
						if (dari == '') {
							dari = 0;
						}
						var sampai = $('#tsampai_kp').val();
						if (sampai == '') {
							sampai = 0;
						}
						window.location.href = "<?php echo base_url(); ?>finance/kartu_piutang/" + dari + "/" + sampai + "/" + id_client + "/" + id_order;
					}
				});
				$('.filter_merah').click(function() {
					var id_region = $('#id_region').val();
					var ppnflag = $('#ppnflag').val();
					window.location.href = "<?php echo base_url(); ?>finance/merah/" + id_region + "/" + ppnflag;
				});

				$('#id_client_kp').change(function() {
					// alert($('#id_client_kp').val());
					var dat = {
						'id_client': $('#id_client_kp').val()
					};
					$.ajax({
						url: "<?php echo base_url(); ?>Finance/ajax_get_invoice",
						type: 'POST',
						data: dat,
						success: function(result) {
							$('#invoice_nest').html(result);
							if ($('.tag-select')[0]) {
								$('.tag-select').chosen({
									width: '100%',
									allow_single_deselect: true
								});
							}
						}
					});
				});

				$('#id_company_req').change(function() {
					var dat = {
						'id_cust': $('#id_company_req').val()
					};
					$.ajax({
						url: "<?php echo base_url(); ?>Marketing/get_client_service",
						type: 'POST',
						data: dat,
						success: function(result) {
							// alert(result);
							var res = result.split('___');
							$('#layanan_nest').html(res[0]);
							$('#layanan_nest2').html(res[1]);
							$(".rupiah").inputmask("currency");
						}
					});
				});

				$('#id_order').change(function() {
					var dat = {
						'id': $('#id_order').val()
					};
					$.ajax({
						url: "<?php echo base_url(); ?>Finance/ajax_order",
						type: 'POST',
						data: dat,
						success: function(result) {
							$('#order_nest').html(result);
							if ($('.tag-select')[0]) {
								$('.tag-select').chosen({
									width: '100%',
									allow_single_deselect: true
								});
							}
						}
					});
				});

				$('#f_grid_ok').click(function() {
					// alert('a');
					var dat = {
						'nota': f_ar_grid,
						'biaya_extra': $('#biaya_extra_fin').val()
					};
					$.ajax({
						url: "<?php echo base_url(); ?>Finance/get_f_ardetail",
						type: 'POST',
						data: dat,
						success: function(result) {
							// alert(result);
							var arr = result.split('__');
							$('#divdetail').html(arr[0]);
							$('#sub_tot').val(arr[1]);
							$('#grand').val(arr[2]);
							// $('#grand_ori').val(arr[2]);

							$(".trig_nominal, .trig_nominal_ppn").keyup(function() {
								var id = this.id;
								var id2 = id.split('_');
								var nom = $("#nominal_" + id2[1]).val();
								if (typeof nom != "undefined" && nom != '') {
									nom = nom.replace(/,/g, '');
								}
								var ppn = $("#nominalppn_" + id2[1]).val();
								if (typeof ppn != "undefined" && ppn != '') {
									ppn = ppn.replace(/,/g, '');
								}
								var jml = parseFloat(ppn) + parseFloat(nom);
								$("#subtotal_" + id2[1]).val(jml);

								// $("#subtotal_"+id2[1]).change(function() {
								var numOri = $('.hitung_invoice').length;
								var nom = 0;
								var ppn = 0;
								var biaya_extra = $("#biaya_extra_fin").val();
								if (typeof biaya_extra != "undefined" && biaya_extra != '') {
									biaya_extra = biaya_extra.replace(/,/g, '');
								}
								total_cpe = 0;
								for (var i = 1; i <= numOri; i++) {
									nom = $("#nominal_" + i).val();
									if (typeof nom != "undefined" && nom != '') {
										nom = nom.replace(/,/g, '');
									}
									ppn = $("#nominalppn_" + i).val();
									if (typeof ppn != "undefined" && ppn != '') {
										ppn = ppn.replace(/,/g, '');
									}
									total_cpe = parseFloat(total_cpe) + parseFloat(nom) + parseFloat(ppn);
								}
								$("#sub_tot").val(total_cpe);
								// $("#grand_ori").val(total_cpe);
								if (biaya_extra == '') {
									total_cpe = parseFloat(total_cpe) + 0;
								} else {
									total_cpe = parseFloat(total_cpe) + parseFloat(biaya_extra);
								}
								$("#grand").val(total_cpe);

								var sub_tot = $("#sub_tot").val();
								if (typeof sub_tot != "undefined" && sub_tot != '') {
									sub_tot = sub_tot.replace(/,/g, '');
								}
								var pph = $(".trig_pph input[type='radio']:checked").val();
								var nom_pph = 0;
								if (pph == 1) {
									nom_pph = sub_tot * 0.015;
								} else if (pph == 2) {
									nom_pph = sub_tot * 0.02;
								} else if (pph == 3) {
									nom_pph = sub_tot * 0.02 * 0.015;
								} else if (pph == 0) {
									nom_pph = 0;
								}
								$("#pph").val(nom_pph);
								// });
							});
							var sub_tot = $("#sub_tot").val();
							if (typeof sub_tot != "undefined" && sub_tot != '') {
								sub_tot = sub_tot.replace(/,/g, '');
							}
							var pph = $(".trig_pph input[type='radio']:checked").val();
							var nom_pph = 0;
							if (pph == 1) {
								nom_pph = sub_tot * 0.015;
							} else if (pph == 2) {
								nom_pph = sub_tot * 0.02;
							} else if (pph == 3) {
								nom_pph = sub_tot * 0.02 * 0.015;
							} else if (pph == 0) {
								nom_pph = 0;
							}
							$("#pph").val(nom_pph);
							$(".rupiah").inputmask("currency");
						}
					});
					$('#modalColor').modal('toggle');
				});
				$("#biaya_extra").on('keyup focusout', function() {
					var grand_old = $("#sub_tot").val();
					if (typeof grand_old != "undefined" && grand_old != '') {
						grand_old = grand_old.replace(/,/g, '');
					}
					var extra = $("#biaya_extra").val();
					if (typeof extra != "undefined" && extra != '') {
						extra = extra.replace(/,/g, '');
					}
					if (extra == '') {
						var grand = parseFloat(grand_old) + 0;
					} else {
						var grand = parseFloat(grand_old) + parseFloat(extra);
					}
					$('#grand').val(grand);
					var ppn = $(".ppn:checked").val();
					if (ppn != '') {
						update_radio();
					}
				});

				$('.trig_pph').click(function() {
					var pph = $(".trig_pph input[type='radio']:checked").val();
					var sub_tot = $("#sub_tot").val();
					if (typeof sub_tot != "undefined" && sub_tot != '') {
						sub_tot = sub_tot.replace(/,/g, '');
					}
					var nom_pph = 0;
					if (pph == 1) {
						nom_pph = sub_tot * 0.015;
					} else if (pph == 2) {
						nom_pph = sub_tot * 0.02;
					} else if (pph == 3) {
						nom_pph = sub_tot * 0.02 * 0.015;
					} else if (pph == 0) {
						nom_pph = 0;
					}
					$("#pph").val(nom_pph);
				});

				// $( "#biaya_extra_fin" ).keyup(function() {
				// var grand_old = $("#sub_tot").val();
				// var extra = $("#biaya_extra_fin").val();
				// if(extra==''){
				// var grand = parseFloat(grand_old) + 0;
				// }else{
				// var grand = parseFloat(grand_old) + parseFloat(extra);
				// }
				// $('#grand').val(grand);
				// });
				function update_pembayaran() {

					$(".trig_angka_fin").bind("keyup change", function() {
						var id = this.id;
						var b_admin = $('#b_admin').val();
						if (typeof b_admin != "undefined" && b_admin != '') {
							b_admin = b_admin.replace(/,/g, '');
						}
						var b_materai = $('#b_materai').val();
						if (typeof b_materai != "undefined" && b_materai != '') {
							b_materai = b_materai.replace(/,/g, '');
						}
						if (b_admin == '') {
							var tot = 0 + parseFloat(b_materai);
						} else if (b_materai == '') {
							var tot = parseFloat(b_admin) + 0;
						} else {
							var tot = parseFloat(b_admin) + parseFloat(b_materai);
						}

						$('#biaya_extra_fin').val(tot);

						var sub_tot = $('#sub_tot').val();
						if (typeof sub_tot != "undefined" && sub_tot != '') {
							sub_tot = sub_tot.replace(/,/g, '');
						}
						var biaya_extra_fin = $('#biaya_extra_fin').val();
						if (typeof biaya_extra_fin != "undefined" && biaya_extra_fin != '') {
							biaya_extra_fin = biaya_extra_fin.replace(/,/g, '');
						}
						var grand = 0;
						if (sub_tot == '') {
							grand = parseFloat(biaya_extra_fin) + 0;
						} else {
							grand = parseFloat(biaya_extra_fin) + parseFloat(sub_tot);
						}
						$('#grand').val(grand);
					});
				}
				update_pembayaran();

				$('#f_ar_btcek').click(function() {
					// $("#LoadingImage").show();
					var color = $(this).data('target-color');
					if ($("#payment_ar_client").val() != '0') {

						var opt_data = {
							id: $("#payment_ar_client").val(),
							flag: $("#flag").val(),
							flagdp: $("#flagdp").val()
						};
						$.ajax({
							url: "<?php echo base_url(); ?>finance/cari",
							type: 'POST',
							data: opt_data,
							success: function(result) {
								$('#tbl').html(result);
								// var val 	= 'tbltruck';
								// grid(val);

								// event.preventDefault();

								$('#modalColor').attr('data-modal-color', color);
								$('#tbl').attr('style', 'color:black');
								var rowIds = [];
								$("#data-table-selection").bootgrid({
									css: {
										icon: 'zmdi icon',
										iconColumns: 'zmdi-view-module',
										iconDown: 'zmdi-expand-more',
										iconRefresh: 'zmdi-refresh',
										iconUp: 'zmdi-expand-less'
									},
									navigation: 3,
									selection: true,
									multiSelect: true,
									rowSelect: true,
									keepSelection: true
								}).on("selected.rs.jquery.bootgrid", function(e, rows) {
									for (var i = 0; i < rows.length; i++) {
										rowIds.push(rows[i].id);
									}
									f_ar_grid = rowIds.join(",");
									// alert("Select: " + rowIds.join(","));
								}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
									// var rowIds = [];
									for (var i = 0; i < rows.length; i++) {
										var index = rowIds.indexOf(rows[i].id);
										rowIds.splice(index, 1);
									}
									f_ar_grid = rowIds.join(",");
								});
								$('.actionBar').addClass('hidden');
								$('#modalColor').modal({
									show: true
								});
								// $("#LoadingImage").hide();

							}
						});
					} else {
						swal("Oops!", "Pastikan Anda telah memilih client..", "error");
					}

					return false;


				});
				$('#f_ar_btcek1').click(function() {
					var color = $(this).data('target-color');

					$('#modalColor').attr('data-modal-color', color);
				});

				$('.sa-warning').click(function() {
					swal({
						title: "Are you sure?",
						text: "You will not be able to recover this imaginary file!",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function() {
						swal("Deleted!", "Your imaginary file has been deleted.", "success");
					});
				});
				//-----------------------------------------------------------------------------------------
				update_grand_penjualan();

				function update_grand_penjualan() {
					var numOri = $('.hitung').length;
					var nom = 0;
					var total_cpe = 0;
					if (numOri == 1) {
						nom = $("#nominal_1").val();
						if (typeof nom != "undefined" && nom != '') {
							nom = nom.replace(/,/g, '');
						}
						total_cpe = parseFloat(total_cpe) + parseFloat(nom);

					} else {
						for (var i = 1; i <= numOri; i++) {
							nom = $("#nominal_" + i).val();
							if (typeof nom != "undefined" && nom != '') {
								nom = nom.replace(/,/g, '');
							}
							total_cpe = parseFloat(total_cpe) + parseFloat(nom);
						}
					}
					var numOri2 = $('.hitung_service').length;
					var nom2 = 0;
					if (numOri2 == 1) {
						nom2 = $("#nominal2_1").val();
						if (typeof nom2 != "undefined" && nom2 != '') {
							nom2 = nom2.replace(/,/g, '');
							total_cpe = parseFloat(total_cpe) + parseFloat(nom2);
						}
					} else {
						for (var i = 1; i <= numOri2; i++) {
							nom2 = $("#nominal2_" + i).val();
							if (typeof nom2 != "undefined" && nom2 != '') {
								nom2 = nom2.replace(/,/g, '');
							}
							total_cpe = parseFloat(total_cpe) + parseFloat(nom2);
						}
					}

					$("#sub_tot").val(total_cpe);
					// console.log(total_cpe);

					var extra = $("#biaya_extra").val();
					if (typeof extra != "undefined" && extra != '') {
						extra = extra.replace(/,/g, '');
					}
					if (extra == '') {
						var grand = parseFloat(total_cpe) + 0;
					} else {
						var grand = parseFloat(total_cpe) + parseFloat(extra);
					}
					$('#grand').val(grand);
				}

				function update_radio() {
					// alert('a');
					var ppn = $(".ppn:checked").val();
					if (ppn == 1) {
						var sub_tot = $('#sub_tot').val();
						if (typeof sub_tot != "undefined" && sub_tot != '') {
							sub_tot = sub_tot.replace(/,/g, '');
						}

						var biaya_extra = $('#biaya_extra').val();
						// alert(biaya_extra);
						if (typeof biaya_extra != "undefined" && biaya_extra != '') {
							biaya_extra = biaya_extra.replace(/,/g, '');
							var grnd = parseFloat(sub_tot) + parseFloat(biaya_extra);
						} else {
							var grnd = sub_tot;
						}
						var ppn_nominal = grnd * 0.1;
						// console.log(grnd);
						// console.log(ppn_nominal);
						$('#ppn_nominal').val(ppn_nominal);

						var grand = parseFloat(grnd) + parseFloat(ppn_nominal);
						$('#grand').val(grand);
					} else {
						$('#ppn_nominal').val('');
						update_grand_penjualan();
					}
				}

				function update_harga() {
					//BARANG///////////////////////////
					$(".pilih_cpe").change(function() {
						var id = this.id;
						var arr = id.split('_');
						var id_item = $("#id_item_" + arr[2]).val();
						var opt_data = {
							id: id_item
						};
						$.ajax({
							url: "<?php echo base_url(); ?>marketing/ajax_get_harga",
							type: "post",
							data: opt_data,
							success: function(res) {
								// alert(res);
								$("#harga_" + arr[2]).val(res);
								// $("#harga_"+arr[2]).attr("min",res);
								var qty = $("#qty_" + arr[2]).val();

								if (qty == '') {
									var sub = res * 1;
									$("#qty_" + arr[2]).val('1');
								} else {
									var sub = res * qty;
								}
								$("#nominal_" + arr[2]).val(sub);
								update_radio();
								update_grand_penjualan();
							}
						});

					});
					$(".trig_harga").keyup(function() {
						var id = this.id;
						var arr = id.split('_');
						var nominal = $("#" + id).val();
						if (typeof nominal != "undefined" && nominal != '') {
							nominal = nominal.replace(/,/g, '');
						}
						var qty = $("#qty_" + arr[1]).val();
						alert(qty);
						var total = nominal * qty;
						$('#nominal_' + arr[1]).val(total);

						update_radio();
						update_grand_penjualan();
					});
					$(".trig_angka").bind("keyup change", function() {
						var id = this.id;
						var arr = id.split('_');
						var qty = $('#qty_' + arr[1]).val();
						var harga = $('#harga_' + arr[1]).val();
						if (typeof harga != "undefined" && harga != '') {
							harga = harga.replace(/,/g, '');
						}
						if (harga == '') {
							$('#nominal_' + arr[1]).val(0);
						} else {
							var sub = qty * harga;
							$('#nominal_' + arr[1]).val(sub);
						}
						update_radio();
						update_grand_penjualan();
					});

					//SERVICE//////////////////
					$(".trig_harga_serv").keyup(function() {
						var id = this.id;
						var arr = id.split('_');
						var nominal = $("#" + id).val();
						if (typeof nominal != "undefined" && nominal != '') {
							nominal = nominal.replace(/,/g, '');
						}
						var qty = $("#qty2_" + arr[1]).val();
						var total = nominal * qty;
						$('#nominal2_' + arr[1]).val(total);
						update_radio();
						update_grand_penjualan();
					});
					$(".trig_qty_serv").bind("keyup change", function() {
						var id = this.id;
						var arr = id.split('_');
						var qty = $("#" + id).val();
						var nominal = $("#harga2_" + arr[1]).val();
						if (typeof nominal != "undefined" && nominal != '') {
							nominal = nominal.replace(/,/g, '');
						}
						var total = nominal * qty;
						$('#nominal2_' + arr[1]).val(total);
						update_radio();
						update_grand_penjualan();
					});
				}
				update_harga();
				$(".ppn").change(function() {
					update_radio();
				});
				$(".site_add").click(function() {
					var numItems = $('.hitung_site').length + 1;
					var numOri = $('.hitung_site').length;
					$("#site_nest").append('<b>SITE ' + numItems + '</b><hr><div style="display:none" class="row hitung_site animate_site"><div class="col-sm-3"><p class="c-black f-500 m-b-5 m-t-10">Region</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line"><input type="hidden" name="idsite[]" id="idsite_' + numItems + '"><select name="id_region[]" class="tag-select" id="id_region_' + numItems + '"><?php if (!empty($option_region)) {
																																																																																																																						foreach ($option_region as $key => $val) {
																																																																																																																							echo '<option value="' . $key . '">' . $val . '</option>';
																																																																																																																						}
																																																																																																																					} ?></select></div></div></div><div class="col-sm-3"><p class="c-black f-500 m-b-5 m-t-10">Company Group</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-accounts-alt"></i></span><div class="fg-line"><input type="text" name="groupname[]" id="groupname_' + numItems + '" class="form-control"></div></div></div><div class="col-sm-3"><p class="c-black f-500 m-b-5 m-t-10">Email</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-email"></i></span><div class="fg-line"><input type="text" name="email[]" id="email_' + numItems + '" class="form-control" placeholder="Company Email"></div></div></div><div class="col-sm-3"><p class="c-black f-500 m-b-5 m-t-10">Phone</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span><div class="fg-line"><input type="text" name="phone[]" id="phone_' + numItems + '" class="form-control" placeholder="Company Phone"></div></div></div><div class="col-sm-12"><div class="row"><div class="col-sm-6"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span><div class="fg-line"><input type="text" name="alamat[]" id="alamat_' + numItems + '" class="form-control" placeholder="Company Address"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line"><input type="text" name="kota[]" id="kota_' + numItems + '" class="form-control" placeholder="Company City"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line"><input type="text" name="taxno[]" id="taxno_' + numItems + '" class="form-control" placeholder="Tax Reg Number"></div></div></div></div><p class="c-black f-500 m-b-5 m-t-10">Represented By</p><div class="row"><div class="col-sm-6"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-account"></i></span><div class="fg-line"><input type="text" name="wakil[]" id="wakil_' + numItems + '" class="form-control" placeholder="Dully Represented by"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-email"></i></span><div class="fg-line"><input type="text" name="wakiljob[]" id="wakiljob_' + numItems + '" class="form-control" placeholder="Job Title"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span><div class="fg-line"><input type="text" name="wakilemail[]" id="wakilemail_' + numItems + '" class="form-control" placeholder="Email"></div></div></div></div><p class="c-black f-500 m-b-5 m-t-10">Contact Person</p><div id="cp_nest_' + numItems + '"><div class="row hitung_cp"><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-account"></i></span><div class="fg-line"><input type="text" name="cp_name[0][]" id="cp_name_' + numItems + '_1" class="form-control" placeholder="Name"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-case"></i></span><div class="fg-line"><input type="text" name="cp_jabatan[0][]" id="cp_jabatan_' + numItems + '_1" class="form-control" placeholder="Jabatan"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-email"></i></span><div class="fg-line"><input type="text" name="cp_email[0][]" id="cp_email_' + numItems + '_1" class="form-control" placeholder="Email"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span><div class="fg-line"><input type="text" name="cp_phone[0][]" id="cp_phone_' + numItems + '_1" class="form-control" placeholder="Phone"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"></span><div class="fg-line select"><select name="cp_flag[0][]" id="cp_flag_' + numItems + '_1" class="form-control"><option value="t" selected>Teknis</option><option value="f" >Finance</option></select></div></div></div></div></div><br/><button  id="cp_add_' + numItems + '" style="float:right;" type="button" class="btn btn-default btn-xs btn-icon-text waves-effect cp_add"><i class="zmdi zmdi-plus"></i> Tambah CP</button><br></div></div>');
					$(".animate_site").show('normal');
					if ($('.tag-select')[0]) {
						$('.tag-select').chosen({
							width: '100%',
							allow_single_deselect: true
						});
					}
					$("#cp_add_" + numItems).click(function() {
						var id = this.id;
						var ex = id.split('_');
						var numItems2 = ex[2];
						$("#cp_nest_" + numItems2).append('<div style="display:none" class="row hitung_cp animate_cp"><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-account"></i></span><div class="fg-line"><input type="text" name="cp_name[]" id="cp_name_' + numItems2 + '" class="form-control" placeholder="Name"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-case"></i></span><div class="fg-line"><input type="text" name="cp_jabatan[]" id="cp_jabatan_' + numItems2 + '" class="form-control" placeholder="Jabatan"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-email"></i></span><div class="fg-line"><input type="text" name="cp_email[]" id="cp_email_' + numItems2 + '" class="form-control" placeholder="Email" ></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span><div class="fg-line"><input type="text" name="cp_phone[]" id="cp_phone_' + numItems2 + '" class="form-control" placeholder="Phone"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"></span><div class="fg-line select"><select name="cp_flag[]" id="cp_flag_' + numItems2 + '" class="form-control"><option value="t" selected>Teknis</option><option value="f">Finance</option></select></div></div></div></div>');
						$(".animate_cp").show('normal');
						$(".rupiah").inputmask("currency");
					});
				});
				// $(".cp_add").click(function(){
				// var id = this.id;
				// var ex = id.split('_');
				// var numItems2 = ex[2];
				// // var numItems2 = $('.hitung_cp').length+1;
				// // var numOri2 = $('.hitung_cp').length;
				// $("#cp_nest_"+numItems2).append('<div style="display:none" class="row hitung_cp animate_cp"><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-account"></i></span><div class="fg-line"><input type="text" name="cp_name[]" id="cp_name_'+numItems2+'" class="form-control" placeholder="Name"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-case"></i></span><div class="fg-line"><input type="text" name="cp_jabatan[]" id="cp_jabatan_'+numItems2+'" class="form-control" placeholder="Jabatan"></div></div></div><div class="col-sm-3"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-email"></i></span><div class="fg-line"><input type="text" name="cp_email[]" id="cp_email_'+numItems2+'" class="form-control" placeholder="Email" ></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span><div class="fg-line"><input type="text" name="cp_phone[]" id="cp_phone_'+numItems2+'" class="form-control" placeholder="Phone"></div></div></div><div class="col-sm-2"><div class="input-group"><span class="input-group-addon"></span><div class="fg-line select"><select name="cp_flag[]" id="cp_flag_'+numItems2+'" class="form-control"><option value="t" selected>Teknis</option><option value="f">Finance</option></select></div></div></div></div>');
				// $(".animate_cp").show('normal');
				// $(".rupiah").inputmask("currency");
				// });
				$(".item_add").click(function() {
					var numItems = $('.hitung').length + 1;
					var numOri = $('.hitung').length;
					$("#item_nest").append('<div class="input-group hitung"><span class="input-group-addon"><i class="zmdi zmdi-dropbox"></i></span><div class="row"><div class="col-sm-4"><div class="fg-line"><select id="id_item_' + numItems + '" name="id_item[]" class="tag-select pilih_cpe"><?php echo isset($option_cpe) ? $option_cpe : ''; ?></select></div></div><div class="col-sm-3"><div class="fg-line"><input name="harga[]" type="text" id="harga_' + numItems + '" class="rupiah form-control trig_harga" placeholder="Harga Satuan"></div></div><div class="col-sm-2"><div class="fg-line"><input name="qty[]" min="0" type="number" id="qty_' + numItems + '" class="form-control trig_angka" placeholder="Quantity"></div></div><div class="col-sm-3"><div class="fg-line"><input name="nominal[]" type="text" id="nominal_' + numItems + '" readonly class="rupiah form-control" placeholder="Nominal"></div></div></div></div>');
					if ($('.tag-select')[0]) {
						$('.tag-select').chosen({
							width: '100%',
							allow_single_deselect: true
						});
					}
					$(".rupiah").inputmask("currency");
					update_harga();
				});
				$(".layanan_add").click(function() {
					var numItems = $('.hitung').length + 1;
					var numOri = $('.hitung').length;
					var nextserv_lbl = next_serv + '-' + numItems;
					$("#layanan_nest").append('<div style="display:none;" class="row hitung animate_serv"><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">Service ID ' + numItems + '</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span><div class="fg-line"><input type="text" name="service_id[]" value="' + nextserv_lbl + '" class="form-control"></div></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">Nama Layanan</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span><div class="fg-line"><input type="text" name="layanan[]" class="form-control"></div></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-15 m-t-20">Compliment</p><div class="toggle-switch"><input id="c_' + numItems + '" name="compliment[]" type="checkbox" value="2" hidden="hidden"><label for="c_' + numItems + '" class="ts-helper"></label></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">Biaya Langganan</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span><div class="fg-line"><input type="text" name="harga_langganan[]" class="rupiah form-control"></div></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">Start Billing</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="fg-line"><input type="text" name="start[]" class="form-control date-picker"></div></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">RFS</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="fg-line"><input type="text" name="rfs[]" class="form-control date-picker"></div></div></div><div class="row-fluid"><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">PPn</p><br><select name="ppn[]" class="tag-select ppn"><option value="3">Include</option><option value="1">Exclude</option><option value="2">Non</option></select></div><div class="col-sm-3"><p class="c-black f-500 m-b-5 m-t-20">Periode Penagihan</p><br><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-refresh-sync"></i></span><div class="fg-line"><select name="periode[]" class="tag-select periode"><option value="1">Bulanan</option><option value="3">Tri Wulan</option><option value="4">Catur Wulan</option><option value="6">Semester</option><option value="12">Tahunan</option><option value="0">One Time Project</option></select></div></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">Periode Pembayaran</p><br><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-swap"></i></span><div class="fg-line"><select name="periode_bayar[]" class="tag-select periode_bayar"><option value="1">Pre-Paid</option><option value="2">Post-Paid</option></select></div></div></div><div class="col-sm-3"><p class="c-black f-500 m-b-15 m-t-20">Down Payment (DPP)</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span><div class="fg-line"><input type="text" name="dp[]" class="rupiah form-control" placeholder=""></div></div></div><div class="col-sm-2"><p class="c-black f-500 m-b-5 m-t-20">Satuan DP</p><br><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span><div class="fg-line"><select name="satuan_dp[]" class="tag-select satuan_dp"><option value="1">%</option><option value="2">Rp</option></select></div></div></div></div><div class="row-fluid"><div class="col-sm-12"><p class="c-black f-500 m-b-5 m-t-20">Note</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-format-subject"></i></span><div class="col-sm-12"><div class="fg-line"><input name="note[]" type="text" class="form-control"></div></div></div></div></div></div>');
					$(".animate_serv").show('normal');
					if ($('.tag-select')[0]) {
						$('.tag-select').chosen({
							width: '100%',
							allow_single_deselect: true
						});
					}
					if ($('.date-picker')[0]) {
						$('.date-picker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
					}
					$(".rupiah").inputmask("currency");
				});
				$(".service_add").click(function() {
					var numItems = $('.hitung_service').length + 1;
					var numOri = $('.hitung_service').length;
					$("#service_nest").append('<div class="input-group hitung_service"><span class="input-group-addon"><i class="zmdi zmdi-settings"></i></span><div class="row"><div class="col-sm-4"><div class="fg-line"><input name="service2[]" type="text" id="service2_' + numItems + '" class="form-control" placeholder="Service Type"></div></div><div class="col-sm-3"><div class="fg-line"><input name="harga2[]" type="text" id="harga2_' + numItems + '" class="rupiah form-control trig_harga_serv"   placeholder="Harga Satuan"></div></div><div class="col-sm-2"><div class="fg-line"><input name="qty2[]" min="0" type="number" id="qty2_' + numItems + '" class="form-control trig_qty_serv" placeholder="Quantity"></div></div><div class="col-sm-3"><div class="fg-line"><input name="nominal2[]" type="text" id="nominal2_' + numItems + '" readonly class="rupiah form-control" placeholder="Nominal"></div></div></div></div>');
					if ($('.tag-select')[0]) {
						$('.tag-select').chosen({
							width: '100%',
							allow_single_deselect: true
						});
					}
					$(".rupiah").inputmask("currency");
					update_harga();
				});

				// $(".extra_add").click(function(){
				// var numItems = $('.hitung').length+1;
				// var numOri = $('.hitung').length;
				// $("#extra_nest").append('<div class="row hitung"><div class="col-sm-6"><p class="c-black f-500 m-b-5 m-t-20">Keterangan Biaya Extra</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-label-alt"></i></span><div class="fg-line"><input id="ket_extra_fin_'+numItems+'" type="text" name="ket_extra_fin[]" class="form-control"></div></div></div><div class="col-sm-6"><p class="c-black f-500 m-b-5 m-t-20">Nominal Biaya</p><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span><div class="fg-line"><input id="nom_extra_fin_'+numItems+'" type="text" name="nom_extra_fin[]" class="trig_angka_fin form-control"></div></div></div></div>');

				// update_pembayaran();
				// });


				$("#id_company").change(function() {
					var id = $("#id_company").val();
					var opt_data = {
						id: id
					};
					$.ajax({
						url: "<?php echo base_url(); ?>marketing/ajax_get_company",
						type: "post",
						data: opt_data,
						success: function(res) {
							$("#company_nest").hide("normal");
							$("#company_nest").show("normal");
							var arr = res.split('__');
							$("#company").text(arr[0]);
							$("#phone").text(arr[1]);
							$("#email").text(arr[2]);
							$("#alamat").text(arr[3]);
							$("#kota").text(arr[4]);
							$("#cp_nest").html(arr[5]);
							$("#custid").text(arr[6]);
							$("#taxno").text(arr[7]);
							$("#wakil").text(arr[8]);
							$("#wakilemail").text(arr[9]);
							$("#wakiljob").text(arr[10]);
							$("#id_region").text(arr[11]);
							// $("#id_region").trigger("chosen:updated");
							if ($('.tag-select')[0]) {
								$('.tag-select').chosen({
									width: '100%',
									allow_single_deselect: true
								});
							}
						}
					});

				});

			});
		</script>

		</body>

		</html>