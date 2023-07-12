<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/dashboard_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | User Dashboard</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js.php') ?>
		
	</head>
	<body onload="CalculatePayAmount_Dash()">
	
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
							<div class="card-body">
								
								<h5 class="card-title text-primary">Account Summary</h5>
								<div class="row">
									<div class="col-md-4">
										<div class="card grad-background-blue">
											<div class="card-body d-flex justify-content-between">
												<div>
													<p class="card-title text-secondary">Total Invested</p>
													<h6 class="my-0">$<?php DisplayTotalInvested(); ?></h6>
												</div>
												<div>
													<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
														<path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
														<path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
													</svg>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="card grad-background-blue">
											<div class="card-body d-flex justify-content-between">
												<div>
													<p class="card-title text-secondary">Total Returns</p>
													<h6 class="my-0">$<?php DisplayTotalEarned(); ?></h6>
												</div>
												<div>
													<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
														<path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
														<path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
														<path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
													</svg>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="card grad-background-blue">
											<div class="card-body d-flex justify-content-between">
												<div>
													<p class="card-title text-secondary">Total Charity</p>
													<h6 class="my-0">$<?php DisplayTotalCharity(); ?></h6>
												</div>
												<div>
													<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16">
														<path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z"/>
													</svg>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="card col-md-12 my-3 box-shadow">
							<div class="card-body">
								<h5 class="card-title text-primary">Calculate Profits</h5>

								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<button class="nav-link active" id="nav-starter-tab" data-bs-toggle="tab" data-bs-target="#nav-starter" type="button" role="tab" aria-controls="nav-starter" aria-selected="true">Starter Plan</button>
										<button class="nav-link" id="nav-standard-tab" data-bs-toggle="tab" data-bs-target="#nav-standard" type="button" role="tab" aria-controls="nav-standard" aria-selected="false">Standard Plan</button>
										<button class="nav-link" id="nav-premium-tab" data-bs-toggle="tab" data-bs-target="#nav-premium" type="button" role="tab" aria-controls="nav-premium" aria-selected="false">Premium Plan</button>
										<button class="nav-link" id="nav-exclusive-tab" data-bs-toggle="tab" data-bs-target="#nav-exclusive" type="button" role="tab" aria-controls="nav-exclusive" aria-selected="false">Exclusive Plan</button>
									</div>
								</nav>

								<label for="cardholder-nooffarms" class="form-label mt-3">Number Of Farms</label>
								<div class="d-flex">
									<button type="button" id="pay-minus-btn" class="btn btn-outline-danger mb-3 me-2" onclick="SubtractFarms_Dash()">-</button>
									<input type="number" class="form-control mb-3 me-2" id="cardholder-nooffarms" name="cardholder_nooffarms" value="1" disabled/>
									<button type="button" id="pay-pluss-btn" class="btn btn-outline-success mb-3" onclick="AddFarms_Dash()">+</button>
								</div>

								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-starter" role="tabpanel" aria-labelledby="nav-starter-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<div>
												<div class="d-flex justify-content-between">
													<label for="total-payable-25" class="form-label">Amount to Invest</label>
													<label for="total-earned-25" class="form-label">Amount to Receive</label>
												</div>
												
												<div class="d-flex justify-content-evenly">
													<span id="total-payable-25" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
													<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
													</svg>
													<span id="total-earned-25" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
												</div>
												
												<hr class="my-1">
												
												<div class="d-flex justify-content-between">
													<div class="d-flex justify-content-evenly">
														<div class="me-3">
															<label for="amount-payable-25" class="form-label">Amount (excl. VAT)</label><br class="my-0">
															<span id="amount-payable-25" style="font-size: 1.5em;"></span>
														</div>
														<div>
															<label for="vat-payable-25" class="form-label">Kenya VAT (16%)</label><br class="my-0">
															<span id="vat-payable-25" style="font-size: 1.5em;"class="text-danger"></span>
														</div>
													</div>
													<div class="d-flex justify-content-evenly">
														<div>
															<label for="amount-earned-25" class="form-label">Amount Earned</label><br class="my-0">
															<span id="amount-earned-25" style="font-size: 1.5em;"></span>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
									
									<div class="tab-pane fade" id="nav-standard" role="tabpanel" aria-labelledby="nav-standard-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<div>
												<div class="d-flex justify-content-between">
													<label for="total-payable-50" class="form-label">Amount to Invest</label>
													<label for="total-earned-50" class="form-label">Amount to Receive</label>
												</div>
												
												<div class="d-flex justify-content-evenly">
													<span id="total-payable-50" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
													<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
													</svg>
													<span id="total-earned-50" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
												</div>
												
												<hr class="my-1">
												
												<div class="d-flex justify-content-between">
													<div class="d-flex justify-content-evenly">
														<div class="me-3">
															<label for="amount-payable-50" class="form-label">Amount (excl. VAT)</label><br class="my-0">
															<span id="amount-payable-50" style="font-size: 1.5em;"></span>
														</div>
														<div>
															<label for="vat-payable-50" class="form-label">Kenya VAT (16%)</label><br class="my-0">
															<span id="vat-payable-50" style="font-size: 1.5em;"class="text-danger"></span>
														</div>
													</div>
													<div class="d-flex justify-content-evenly">
														<div>
															<label for="amount-earned-50" class="form-label">Amount Earned</label><br class="my-0">
															<span id="amount-earned-50" style="font-size: 1.5em;"></span>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									
									</div>
									
									<div class="tab-pane fade" id="nav-premium" role="tabpanel" aria-labelledby="nav-premium-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<div>
												<div class="d-flex justify-content-between">
													<label for="total-payable-75" class="form-label">Amount to Invest</label>
													<label for="total-earned-75" class="form-label">Amount to Receive</label>
												</div>
												
												<div class="d-flex justify-content-evenly">
													<span id="total-payable-75" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
													<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
													</svg>
													<span id="total-earned-75" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
												</div>
												
												<hr class="my-1">
												
												<div class="d-flex justify-content-between">
													<div class="d-flex justify-content-evenly">
														<div class="me-3">
															<label for="amount-payable-75" class="form-label">Amount (excl. VAT)</label><br class="my-0">
															<span id="amount-payable-75" style="font-size: 1.5em;"></span>
														</div>
														<div>
															<label for="vat-payable-75" class="form-label">Kenya VAT (16%)</label><br class="my-0">
															<span id="vat-payable-75" style="font-size: 1.5em;"class="text-danger"></span>
														</div>
													</div>
													<div class="d-flex justify-content-evenly">
														<div>
															<label for="amount-earned-75" class="form-label">Amount Earned</label><br class="my-0">
															<span id="amount-earned-75" style="font-size: 1.5em;"></span>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									
									</div>
									
									<div class="tab-pane fade" id="nav-exclusive" role="tabpanel" aria-labelledby="nav-exclusive-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<div>
												<div class="d-flex justify-content-between">
													<label for="total-payable-100" class="form-label">Amount to Invest</label>
													<label for="total-earned-100" class="form-label">Amount to Receive</label>
												</div>
												
												<div class="d-flex justify-content-evenly">
													<span id="total-payable-100" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
													<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
													</svg>
													<span id="total-earned-100" style="font-size: 2.5em;" class="text-primary d-flex justify-content-evenly"></span>
												</div>
												
												<hr class="my-1">
												
												<div class="d-flex justify-content-between">
													<div class="d-flex justify-content-evenly">
														<div class="me-3">
															<label for="amount-payable-100" class="form-label">Amount (excl. VAT)</label><br class="my-0">
															<span id="amount-payable-100" style="font-size: 1.5em;"></span>
														</div>
														<div>
															<label for="vat-payable-100" class="form-label">Kenya VAT (16%)</label><br class="my-0">
															<span id="vat-payable-100" style="font-size: 1.5em;"class="text-danger"></span>
														</div>
													</div>
													<div class="d-flex justify-content-evenly">
														<div>
															<label for="amount-earned-100" class="form-label">Amount Earned</label><br class="my-0">
															<span id="amount-earned-100" style="font-size: 1.5em;"></span>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									
									</div>
									
								</div>
								<br>
								<div class="text-center">
									<a class="btn btn-primary" href="investplan.php" role="button">Contribute & Earn</a>
								</div>
							</div>
						</div>
						
						<div class="card col-md-12 my-3 box-shadow">
							<div class="card-body">
								<h5 class="card-title text-primary">How It Works</h5>
								<img src="../img/howitworks_2.jpg" class="w-100" alt="investment_flow_diagram" />
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