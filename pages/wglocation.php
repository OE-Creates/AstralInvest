<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Locations</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js.php') ?>
		
	</head>
	<body>
	
		<div class="container-lg">
		
		<!-- Navbar: START -->
		
		<!-- Navbar: END -->
		
		<!-- Body: START -->
		
			<?php view('header.php') ?>
			
			<div style="height: 65px;"></div> <!-- Header Spacer -->
		
			<?php view('username.php') ?>
			
			<?php view('top-banner.php') ?>
			
			<div class="row mt-3">
			
				<?php view('sidebar.php') ?>
				<div class="col-md-9">

						<div class="card col-md-12 mb-3 box-shadow">
							<div class="card-body pb-0">
							
								<h5 class="card-title text-primary mb-3">Nairobi</h5>
								
								<div class="row">
								
									<div class="col-md-6 mb-3">
										<div class="card h-100">
											<img src="../img/wgloc_01.jpg" class="card-img-top" style="height: 200px;"alt="wg_Nairobi_img">
											<div class="card-body">
												<h6 class="card-title">Nairobi Sugar</h6>
												<p class="text-muted mb-0"><small>Kenya, Africa</small></p>
											</div>
										</div>
									</div>
									
									<div class="col-md-6 mb-3">
										<div class="card">
											<div class="card-body">
												<h6 class="card-title">About Nairobi Sugar</h6>
												The beautiful scenery of Nairobi sub county known for sugarcane farming along the Nakuru-********** route  posseses a nucleus estate covering an area of 16000 ha that it uses to develop cane and supply upto 10% of milling requirement.
												The nucleus estate also has a nursery that is useful for seedcane development. The current area under cane is 1300 ha.
												<hr class="mt-2 mb-1">
												<h6 class="card-title">Facts & Figures</h6>
												<div class="row">
													<div class="col-6 mb-3">
														<small class="text-muted">County</small><br class="my-0">**********
													</div>
													<div class="col-6 mb-3">
														<small class="text-muted">Sugar Plantation</small><br class="my-0">13,000 Ha
													</div>
													<div class="col-6 mb-3">
														<small class="text-muted">Crop Rotation</small><br class="my-0">4 times
													</div>
													<div class="col-6 mb-3">
														<small class="text-muted">Harvest Times</small><br class="my-0">January, March, June, December
													</div>
												</div>
											</div>
										</div>
									</div>
							
								</div>
							</div>
						</div>

						<div class="card col-md-12 mb-3 box-shadow">
							<div class="card-body pb-0">

								<h5 class="card-title text-primary mb-3">Mombasa</h5>
								
								<div class="row">
								
									<div class="col-md-6 mb-3">
										<div class="card h-100">
											<img src="../img/wgloc_02.jpg" class="card-img-top" style="height: 200px;"alt="wg_Mombasa_img">
											<div class="card-body">
												<h6 class="card-title">Mombasa Sugar</h6>
												<p class="text-muted mb-0"><small>Kenya, Africa</small></p>
											</div>
										</div>
									</div>
									
									<div class="col-md-6 mb-3">
										<div class="card">
											<div class="card-body">
												<h6 class="card-title">About Mombasa Sugar</h6>
												Chemelil is located along Awasi-Chemelil-Nandi Hills road in Nairobi sub-county in **********, about 50 kms East of ********** City.
												It has a total of 2,779 hectares of land out of which 2,270 hectares is caneable land and surrounded by many outgrower farms with a total caneable land of approximately 16,171 hectares spread in Nairobi, Nyando, Tinderet, Nandi South and Nandi East sub-counties.
												<hr class="mt-2 mb-1">
												<h6 class="card-title">Facts & Figures</h6>
												<div class="row">
													<div class="col-6 mb-3">
														<small class="text-muted">County</small><br class="my-0">**********
													</div>
													<div class="col-6 mb-3">
														<small class="text-muted">Sugar Plantation</small><br class="my-0">13,000 Ha
													</div>
													<div class="col-6 mb-3">
														<small class="text-muted">Crop Rotation</small><br class="my-0">4 times
													</div>
													<div class="col-6 mb-3">
														<small class="text-muted">Harvest Times</small><br class="my-0">January, March, June, December
													</div>
												</div>
											</div>
										</div>
									</div>
							
								</div>
							</div>
						</div>
						
						<?php view('bottom-tos.php') ?>
						
				</div>
				
			</div>
			
			<div style="height: 45px;"></div> <!-- Footer Spacer -->
			
			<?php view('footer.php') ?>
		
		<!-- Body: END -->
		
		</div>
		
		<?php view('bottom-js.php'); ?>
		
	</body>
</html>