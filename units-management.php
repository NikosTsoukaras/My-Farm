<?php 
	session_start();
	include "assets/php/functions.php";
?>

<!DOCTYPE html>
<html lang="el">

	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Keen | Dashboard</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!--begin::Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/brand/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/aside/light.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->


	<?php if(isset($_SESSION['user_id'])){ ?>


	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Header Mobile -->
		<?php include "html_includes/dashboard_mobile_header.html" ?>
		<!-- end:: Header Mobile -->

		<!-- begin:: Root -->
		<div class="kt-grid kt-grid--hor kt-grid--root">

			<!-- begin:: Page -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

				<?php include "html_includes/dashboard_sidebar.php" ?>

				<!-- end:: Aside -->

				<!-- begin:: Wrapper -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<?php include "html_includes/dashboard_header.php" ?>
					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Subheader -->
						<?php include "html_includes/dashboard_subheader.php" ?>
						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">
											Πίνακας Κτηνοτροφικών Μονάδων
											<!-- <small>data loaded from remote data source</small> -->
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="#" class="btn btn-clean kt-hidden">
												Back to dashboard
											</a>
											<a href="#" class="btn btn-clean btn-bold btn-upper btn-font-sm kt-hidden">
												<i class="la la-long-arrow-left"></i>
												Back
											</a>
											<a data-toggle="collapse" href="#unit_form" role="button" aria-expanded="true" aria-controls="unit_form" class="btn btn-default btn-bold btn-upper btn-font-sm d-flex">
												<i class="flaticon2-add-1"></i>
												Νέα Μονάδα
											</a>
		
											
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="collapse" id="unit_form" >
										<div class="card card-body">
											<div class="kt-portlet__head">
												<div class="kt-portlet__head-label">
													<h3 class="kt-portlet__head-title">Καταχώρηση Μονάδας</h3>
												</div>
											</div>
											<form class="kt-form kt-form--label-right" id="insert_unit_form">
												<div class="kt-portlet__body">

													<div class="form-group row">
														<label class="col-form-label col-lg-3 col-sm-12">Περιοχή *</label>
														<div class="col-lg-5 col-md-5 col-sm-12">
															<input type="text" class="form-control" name="region" placeholder="Πληκτρολογήστε την περιοχή">
														</div>
													</div>

													<div class="form-group row">
														<label class="col-form-label col-lg-3 col-sm-12">Είδος Ζώων *</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<div class="kt-radio-inline">
																<label class="kt-radio">
																	<input type="checkbox" value="Αγελάδες" name="animal_type"> Αγελάδες
																	<span></span>
																</label>
																<label class="kt-radio">
																	<input type="checkbox" name="animal_type"> Πρόβατα
																	<span></span>
																</label>
																<label class="kt-radio">
																	<input type="checkbox" name="animal_type"> Αίγιες
																	<span></span>
																</label>
																<label class="kt-radio">
																	<input type="checkbox" name="animal_type"> Γουρούνια
																	<span></span>
																</label>
															</div>
															<span class="form-text text-muted">Παρακαλώ επιλέξτε τουλάχιστον μια επιλογή.</span>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-form-label col-lg-3 col-sm-12">Τύπος Εκτροφής *</label>
														<div class="col-lg-5 col-md-5 col-sm-12 form-group-sub">
															<select class="form-control" name="rearing">
																<option value=""></option>
																<option>Εκτατικό</option>
																<option>Ημιεντατικό</option>
																<option>Εντατικό</option>															
															</select>
															<span class="form-text text-muted">Παρακαλώ επιλέξτε μια επιλογή.</span>
														</div>
													</div>

													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<div class="row">
																<div class="col-lg-9 ml-lg-auto">
																	<button type="submit" class="btn btn-brand">Καταχώρηση</button>
																	<button type="reset" class="btn btn-secondary">Ακύρωση</button>
																</div>
															</div>
														</div>
													</div>
											</form>
										</div>
									</div>

									<!--begin: Search Form -->
									<div class="kt-form kt-fork--label-right kt-margin-t-20 kt-margin-b-10">
										<div class="row align-items-center">
											<div class="col-xl-8 order-2 order-xl-1">
												<div class="row align-items-center">
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-input-icon kt-input-icon--left">
															<input type="text" class="form-control" placeholder="Search..." id="generalSearch">
															<span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
														</div>
													</div>
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label>Status:</label>
															</div>
															<div class="kt-form__control">
																<select class="form-control bootstrap-select" id="kt_form_status">
																	<option value="">All</option>
																	<option value="1">Pending</option>
																	<option value="2">Delivered</option>
																	<option value="3">Canceled</option>
																	<option value="4">Success</option>
																	<option value="5">Info</option>
																	<option value="6">Danger</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label>Type:</label>
															</div>
															<div class="kt-form__control">
																<select class="form-control bootstrap-select" id="kt_form_type">
																	<option value="">All</option>
																	<option value="1">Online</option>
																	<option value="2">Retail</option>
																	<option value="3">Direct</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-4 order-1 order-xl-2 kt-align-right">
												<a href="#" class="btn btn-default kt-hidden">
													<i class="la la-cart-plus"></i> New Order
												</a>
												<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
											</div>
										</div>
									</div>

									<!--end: Search Form -->
								</div>
								<div class="kt-portlet__body kt-portlet__body--fit">

									<!--begin: Datatable -->
									<div class="kt_datatable" id="ajax_data"></div>

									<!--end: Datatable -->
								</div>
							</div>
						</div>
						<!-- end:: Content -->
					</div>
	</div>
					<!-- begin:: Footer -->
					<?php include "html_includes/dashboard_footer.html" ?>
					<!-- end:: Footer -->
				</div>

				<!-- end:: Wrapper -->
			</div>

			<!-- end:: Page -->
		</div>

		<!-- end:: Root -->

		<!-- begin:: Topbar Offcanvas Panels -->

		<!-- begin::Offcanvas Toolbar Quick Actions -->
		<?php include "html_includes/dashboard_quick_panel.html" ?>
		<!-- end::Offcanvas Toolbar Quick Actions -->

		<!-- end:: Topbar Offcanvas Panels -->

		<!-- begin:: Quick Panel -->
		<?php include "html_includes/dashboard_quick_panel_window.html" ?>
		<!-- end:: Quick Panel -->

		<!-- begin:: Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end:: Scrolltop -->

	<?php } ?>

		

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#10ac84",
						"metal": "#c4c5d6",
						"light": "#ffffff",
						"accent": "#00c5dc",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995",
						"focus": "#9816f4"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<script src="assets/js/pages/components/forms/validation/controls.js" type="text/javascript"></script>

		<!--begin::Page Scripts(used by this page) -->
		<!-- <script src="assets/js/pages/dashboard.js" type="text/javascript"></script> -->
		<script src="assets/js/pages/components/keen-datatable/base/data-ajax.js" type="text/javascript"></script>
		
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>