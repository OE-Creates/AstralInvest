<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/investplanpurchase_logic.php";
	require "../backend/payment_request_logic.php";
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
	<body onload="FillInvestmentType050()"> <!-- onload="DisablePayBtn()"-->
		
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
								
								<h5 class="card-title text-primary mb-3">Standard Plan</h5>
								
								<div>
									<a class="btn btn-sm btn-primary mb-3" href="investplan.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Back
									</a>
								</div>
								
								<div class="row">
									<div class="col-md-7">
										<div class="card mb-3">
											<div class="card-body">
											
												<form method="POST" id="payment-form">
													<input type="hidden" id="cardholder-reason" name="cardholder_reason">
													<input type="hidden" id="cardholder-nofarms" name="cardholder_nooffarms" value="1">
													<input type="hidden" id="cardholder-amount" name="cardholder_amount">
													
													<label for="cardholder-nooffarms" class="form-label">Number Of Farms</label>
													<div class="d-flex">
														<button type="button" id="pay-minus-btn" class="btn btn-outline-danger mb-3 me-2" onclick="SubtractFarms050()">-</button>
														<input type="number" class="form-control mb-3 me-2" id="cardholder-nooffarms" value="1" disabled/>
														<button type="button" id="pay-pluss-btn" class="btn btn-outline-success mb-3" onclick="AddFarms050()">+</button>
													</div>

													<label for="total-payable" class="form-label">Amount to Invest</label><br class="my-0">
													<span id="total-payable" style="font-size: 4em;" class="text-primary d-flex justify-content-evenly"></span>

													<hr class="my-1">
													
													<div class="d-flex justify-content-evenly">
														<div>
															<label for="amount-payable" class="form-label">Amount (excl. VAT)</label><br class="my-0">
															<span id="amount-payable" style="font-size: 2em;"></span>
														</div>
														<div>
															<label for="vat-payable" class="form-label">Kenya VAT (16%)</label><br class="my-0">
															<span id="vat-payable" style="font-size: 2em;" class="text-danger"></span>
														</div>
													</div>
													
													<hr class="my-1">

													<button type="submit" class="btn btn-primary w-100 mt-2" id="card_paybutton" name="submit_paybutton">Pay</button>
												</form>
											
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="card mb-3">
											<div class="card-body">
												<h6 class="card-title">Standard Plan</h6>
												<hr class="my-1" style="opacity: 10%;">
												<div class="row">
													<div class="col-6">
														<b class="text-muted"><small>Contribution Amount:</small></b><br class="my-0"><span id="display-totalinvest"></span>
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Period:</small></b><br class="my-0">12 Months
													</div>
												</div>
												<hr class="my-1" style="opacity: 10%;">
												<div class="row">
													<div class="col-6">
														<b class="text-muted"><small>Quarterly Payment Amounts:</small></b><br class="my-0"><span id="display-quarterearn"></span>
													</div>
													<div class="col-6">
														<b class="text-muted"><small>Return On Investment:</small></b><br class="my-0">24% after 12 months
													</div>
												</div>
												<hr class="my-1" style="opacity: 10%;">
												<div class="row">
													<div class="col-12">
														<b class="text-muted"><small>R.O.I. Amount:</small></b><br class="my-0"><span id="display-totalearn"></span>
													</div>
												</div>
												<hr class="my-1" style="opacity: 10%;">
												<p>Note: After 12 months the initial investment of <b><span id="display-descrtotalinvest"></span></b> is unlocked, and available for withdrawal then reinvestment.</p>
												<div>
													<label for="display-amount-invested" class="form-label">Total Amount Invest</label>
													<span id="display-amount-invested" style="font-size: 1.5em" class="text-primary"><br>$<b><?php DisplayInvestPlanUserInvestedTotal(); ?></b></span>
													<hr>
													<label for="display-amount-earned" class="form-label">Total Profit Made</label>
													<span id="display-amount-earned" style="font-size: 1.5em" class="text-success"><br><b>$<?php DisplayInvestPlanUserEarnedTotal(); ?></b></span>
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