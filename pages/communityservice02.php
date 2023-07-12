<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/communityservice_logic.php";
	require "../backend/payment_request_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Community Service</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js.php') ?>
		
	</head>
	<body onload="FillCommServiceTypeB()">
	
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
							
							<h5 class="card-title text-primary mb-3">Community Service</h5>
							
							<div>
								<a class="btn btn-sm btn-primary mb-3" href="community.php" role="button">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
									</svg>
									Back
								</a>
							</div>
							
							<div class="row">
								<div class="col-md">
									<div class="card mb-3">
										<div class="card-body">
											<h6 class="card-title">Donate to Education</h6>

											<div class="row">
												<div class="col-md-6 mb-3">
													<form method="POST" id="payment-form">

														<input type="hidden" name="cardholder_reason" id="cardholder-reason">
														<input type="hidden" name="cardholder_nooffarms" value="0">
														
														<div class="field">
															<div class="input-group input-group-sm mb-3">
																<span class="input-group-text">Donation Amount: $</span>
																<select class="form-select" id="cardholder-amount" name="cardholder_amount" required>
																	<option selected value="100">1.00</option>
																	<option value="500">5.00</option>
																	<option value="2000">20.00</option>
																	<option value="5000">50.00</option>
																	<option value="10000">100.00</option>
																	<option value="20000">200.00</option>
																</select>
															</div>
														</div>
														<button type="submit" class="btn btn-primary w-100" id="card_paybutton" name="submit_paybutton">Pay</button>
														
													</form>
												</div>
												<div class="col-md-6">
													<div class="card h-100">
														<div class="card-body">
															<h6 class="card-title">Help us finish building the Community's School</h6>
															<img src="../img/cservice_02.jpg" class="w-100" alt="..." style="height: 200px;" />
															<hr class="my-3">
															<?php DisplayCommunityServiceTotal(); ?>
															<ul>
																<li>Raised: <span>$<?php echo $_SESSION["donated_amount"]; ?></span> / $70,000</li>
																<li><i class="fa fa-clock-o"></i> 95 days</li>
															</ul>
															<div class="progress" style="height: 20px;">
																<div class="progress-bar" role="progressbar" aria-label="Contribution Progress Bar" style="width: <?php echo $_SESSION["donated_percent"]; ?>%;" aria-valuenow="<?php echo $_SESSION["donated_percent"]; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $_SESSION["donated_percent"]; ?>%</div>
															</div>
															
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<div>	
						<!-- Cyrpto payments go here -->
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