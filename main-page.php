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
		<title>MyFarm | Dashboard</title>
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
		<link href="assets/css/skins/aside/test.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" type="image/png" href="favicon.png">

		<!--end::Layout Skins -->
		<!-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> -->
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
						<?php include "html_includes/dashboard_subheader.php" ?>
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
						<div class="row">
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">

									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--brand">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικά Έσοδα</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-bedge">€</span>
															<span class="kt-widget-3__content-number"><?php total_icome(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end::Portlet-->
								</div>
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">

									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--danger">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικά Έξοδα</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-bedge">€</span>
															<span class="kt-widget-3__content-number"><?php total_outgoings(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end::Portlet-->
								</div>
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">

									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--success">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Καθαρό Κέρδος</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-bedge">€</span>
															<span class="kt-widget-3__content-number"><?php total_profit(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end::Portlet-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--info">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Ζώων</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_animals(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--info">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Αγελάδων</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_cows(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--info">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Προβάτων</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_ship(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light"  style="color:grey; width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--info">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Αιγών</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_goats(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--info">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Χοίρων</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_pigs(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--info">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Τοκετών</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_births(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light"  style="color:grey; width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--accent">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Ποσότητα Γαλακτοπαραγωγής</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_milk_l(); ?> </span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--accent">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">M.O. Γαλακτοπαραγωγής</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php average_milk(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--accent">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">Συνολικός Αριθμός Καταχωρήσεων Γαλακτοπαραγωγής</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_milk_records(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light"  style="color:grey; width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--accent">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">M.O. Αριθμού Σώματικών Κυττάρων</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php average_cellulars(); ?> </span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--accent">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">M.O. Πρωτεϊνών</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php average_fat(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>

								<div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
									<!--begin::Portlet-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fluid">
											<div class="kt-widget-3 kt-widget-3--accent">
												<div class="kt-widget-3__content">
													<div class="kt-widget-3__content-info">
														<div class="kt-widget-3__content-section">
															<div class="kt-widget-3__content-title">M.O. Λίπους</div>
														</div>
														<div class="kt-widget-3__content-section">
															<span class="kt-widget-3__content-number"><?php total_milk_records(); ?></span>
														</div>
													</div>
													<div class="kt-widget-3__content-stats">
														<div class="kt-widget-3__content-progress">
															<div class="progress">

																<!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
																<div class="progress-bar bg-light"  style="color:grey; width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
								</div>
							</div>

							

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

	<?php } else{ header('Location: custom/error/404-v1.html');} 
	?>

		

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
		
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>