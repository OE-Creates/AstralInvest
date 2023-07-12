<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/core_management_logic.php";

	require "../backend/dbconnect_invest.php";
	$currreferralid = $_SESSION["referralpage_id"];
	
	$pulldata = "SELECT * FROM users WHERE id = '$currreferralid'";
	$pull = $conn->query($pulldata);
	
	$row = $pull->fetch_array();
	$conn->close();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | M-Referral</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js-manage.php') ?>
		
	</head>
	<body onload="ManageReferralFullPageFunct()">
	
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
								
								<h5 class="card-title text-primary">User Information</h5>
								<div class="d-flex justify-content-begin">
									<a class="btn btn-sm btn-primary me-2" href="management_referral.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Back
									</a>

									<a class="btn btn-sm btn-warning" href="management.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Management
									</a>
								</div>
								<hr>

								<div class="row">
                                    <div class="col-md-7">
                                        <h6>Payment Account Details</h6>
                                        <hr>
                                        <b>Bank Name</b> | <?php echo $row['bankname']; ?><br><br>
                                        <b>Account Name</b> | <?php echo $row['accountname']; ?><br><br>
                                        <b>Account Number</b> | <?php echo $row['accountnumber']; ?><br><br>
                                        <b>Account Swiftcode</b> | <?php echo $row['swiftcode']; ?><br><br>
                                        <b>Bitcoin Wallet</b> | <?php echo $row['bitcoin_address']; ?><br><br>
                                        <b>Etherium Wallet</b> | <?php echo $row['etherium_address']; ?><br><br>
                                        <b>Litecoin Wallet</b> | <?php echo $row['litecoin_address']; ?>
									</div>
                                    <div class="col-md-5">
                                    <span id="account-name" style="font-size: 1.5em;" class="text-primary"><?php echo $row['name']; ?></span><br>
                                        <b>Account ID</b> | <?php echo $row['id']; ?>
                                        <hr>
										<b>Account Username</b> | <?php echo $row['username']; ?>
										<hr>
										<b>Account Email</b> | <?php echo $row['email']; ?>
                                        <hr>
                                        <?php include "../backend/management_referral_amount_logic.php"; ?>
                                        <label for="amount-payable" class="form-label mb-0">Amount Earned</label><br>
										<span id="amount-payable" style="font-size: 3em;" class="text-primary">$<?php echo GetReferralEarnedAmount($row['id']); ?></span><br>
                                        <b>Payout Requested On</b> | <?php echo substr($row['referral_payoutdate'], 0, 19); ?>

                                    </div>
                                </div>

                                <div class="my-3">
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="referral-ack-check" onchange="CheckRefAckBtn()">
                                        <label class="form-check-label" for="referral-acknowledge">
                                            <b class="text-danger">
                                                By checking this box, you acknowledge that the amount listed above has been paid to an account of the client in question.
                                            </b>
                                        </label>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-md-4">
                                        <button type='button' class='btn btn-warning w-100' id="referral-ack-button" data-bs-toggle='modal' data-bs-target='#referralpaid_modal'>Payment Made</button>
                                    </div>
                                </div>

                                <div class="modal" id="referralpaid_modal" tabindex="-1" aria-labelledby="ReferralPaidButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

												<div class="d-flex justify-content-evenly">
													<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="No">Decline</button>
													<form method="POST">
														<button type="submit" class="btn btn-outline-danger" name="submit_referralacknowledge" value="<?php echo $row['id']; ?>" aria-label="Yes">Accept</button>
													</form>
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
		
		<?php view('bottom-js-manage.php'); ?>
		
	</body>
</html>