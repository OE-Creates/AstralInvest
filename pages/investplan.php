<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Contribution Plans</title>
		
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
								
								<h5 class="card-title text-primary mb-3">Contribution Plans</h5>
								
								<div class="row">

									<div class="col-md-6 mb-3">
										<div class="card h-100">
											<img src="../img/invplan_01.jpg" class="card-img-top  w-100" alt="wg-starter-img" style="height: 200px;" />
											<div class="card-body">
												<h6 class="card-title">Starter Plan - 0.25 Acres</h6>
												<p class="text-muted"><small>Nairobi</small></p>
												<div class="row">
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Contribution Amount:</small></b><br class="my-0">$422.87
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Returns After:</small></b><br class="my-0">12 Months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Quarterly Payment Amounts:</small></b><br class="my-0">(422.87 x 0.24)/4 = $25.37
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Return On Investment:</small></b><br class="my-0">24% after 12 months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-12">
														<b class="text-muted"><small>R.O.I. Amount:</small></b><br class="my-0">(422.87 x 0.24) + 422.87 = $524.36
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<p>Note: After 12 months the initial investment of $422.87 is unlocked, and available for withdrawal then reinvestment.</p>
													<br>
												</div>
												<a href="investplanpurchase025.php" class="btn btn-sm btn-outline-primary w-50 py-0">Contribute & Earn</a>
											</div>
										</div>
									</div>

									<div class="col-md-6 mb-3">
										<div class="card h-100">
											<img src="../img/invplan_02.jpg" class="card-img-top  w-100" alt="wg-standard-img" style="height: 200px;" />
											<div class="card-body">
												<h6 class="card-title">Standard Plan - 0.5 Acres</h6>
												<p class="text-muted"><small>Nairobi</small></p>
												<div class="row">
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Contribution Amount:</small></b><br class="my-0">$845.76
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Returns After:</small></b><br class="my-0">12 Months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Quarterly Payment Amounts:</small></b><br class="my-0">(845.76 x 0.24)/4 = $50.75
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Return On Investment:</small></b><br class="my-0">24% after 12 months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-12">
														<b class="text-muted"><small>R.O.I. Amount:</small></b><br class="my-0">(845.76 x 0.24) + 845.76 = $1,048.74
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<p>Note: After 12 months the initial investment of $845.76 is unlocked, and available for withdrawal then reinvestment.</p>
													<br>
												</div>
												<a href="investplanpurchase050.php" class="btn btn-sm btn-outline-primary w-50 py-0">Contribute & Earn</a>
											</div>
										</div>
									</div>

									<div class="col-md-6 mb-3">
										<div class="card h-100">
											<img src="../img/invplan_03.jpg" class="card-img-top  w-100" alt="wg-premium-img" style="height: 200px;" />
											<div class="card-body">
												<h6 class="card-title">Premium Plan - 1 Acre</h6>
												<p class="text-muted"><small>Nairobi</small></p>
												<div class="row">
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Contribution Amount:</small></b><br class="my-0">$1,257.03
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Period:</small></b><br class="my-0">12 Months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Quarterly Payment Amounts:</small></b><br class="my-0">(1,257.03 x .24)/4 = $75.42
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Return On Investment:</small></b><br class="my-0">24% after 12 months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-12">
														<b class="text-muted"><small>R.O.I. Amount:</small></b><br class="my-0">(1,257.03 x .24) + 1,257.03 = $1,558.72
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<p>Note: After 12 months the initial investment of $1,257.03 is unlocked, and available for withdrawal then reinvestment.</p>
													<br>
												</div>
												<a href="investplanpurchase075.php" class="btn btn-sm btn-outline-primary w-50 py-0">Contribute & Earn</a>
											</div>
										</div>
									</div>
									
									<div class="col-md-6 mb-3">
										<div class="card h-100">
											<img src="../img/invplan_04.jpg" class="card-img-top  w-100" alt="wg-exclusive-img" style="height: 200px;" />
											<div class="card-body">
												<h6 class="card-title">Exclusive Plan - 1 Hectare</h6>
												<p class="text-muted"><small>Nairobi</small></p>
												<div class="row">
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Contribution Amount:</small></b><br class="my-0">$1,691.55
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Period:</small></b><br class="my-0">12 Months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-6">
														<b class="text-muted"><small>Quarterly Payment Amounts:</small></b><br class="my-0">(1691.55 x .24)/4 = $101.49
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Return On Investment:</small></b><br class="my-0">24% after 12 months
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<div class="col-12">
														<b class="text-muted"><small>R.O.I. Amount:</small></b><br class="my-0">(1691.55 x .24) + 1691.55 = $2,097.52
													</div>
													<hr class="my-1 mx-0" style="opacity: 10%;">
													<p>Note: After 12 months the initial investment of $1,691.55 is unlocked, and available for withdrawal then reinvestment.</p>
													<br>
												</div>
												<a href="investplanpurchase100.php" class="btn btn-sm btn-outline-primary w-50 py-0">Contribute & Earn</a>
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