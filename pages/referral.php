<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/referral_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Referrals</title>
		
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
							<div class="card-body">
								
								<h5 class="card-title text-primary">Referrals</h5>

								<p>Below is your personal referral link. When an account that was created using this link makes a contribution (e.g. Premium Plan - 1 Acre), both your account and theirs will receive a commission from their payment (excl. VAT).</p>

								<div class="input-group input-group">
									<input type="text" class="form-control" id="referrer-link" value="invest.astralinvest.com/pages/rfsignup.php?code=<?php echo $_SESSION["user_refcode"]; ?>" disabled />
									<button type="button" class="btn btn-outline-primary" onclick="CopyToClipBoard()">Copy</button>
								</div>

							</div>
						</div>

						<div class="card col-md-12 box-shadow">
							<div class="card-body pb-0">
								
								<h5 class="card-title text-primary">Referral Income</h5>
								<p>Payout request only eligible for amounts above $<?php require "../cron/values.php"; echo $referral_payoutmin; ?></p>
								<div class="input-group input-group">
									<span class="input-group-text">Earned: $</span>
									<input type="text" class="form-control" id="referrer-link" value="<?php ReferralTotalEarned(); ?>" disabled />
									<button type="button" class="btn btn-primary" onclick="location.reload()">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
											<path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
										</svg>
										Refresh
									</button>
								</div>
								<div class="row">
									<?php ReferralButtonDisplay(); ?>
									<?php ReferralStatus(); ?>
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