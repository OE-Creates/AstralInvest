<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/core_management_logic.php";
	require "../backend/refund_request_logic.php";

	require "../backend/dbconnect_invest.php";
	$currrefdid = $_SESSION["refundpage_id"];
	
	$pulldata = "SELECT * FROM transactions WHERE id = '$currrefdid'";
	$pull = $conn->query($pulldata);
	
	$row = $pull->fetch_array();
	$conn->close();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | M-Refund</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js-manage.php') ?>
		
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
								
								<h5 class="card-title text-primary">Refund Details</h5>
								<div class="d-flex justify-content-begin">
									<a class="btn btn-sm btn-primary me-2" href="management_refund.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Back
									</a>

									<a class="btn btn-sm btn-warning me-2" href="management_transact.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Transactions
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
										<b>Reference ID</b> | <?php echo $row['id']; ?>
										<hr>
										<b>Payment ID</b> | <?php echo $row['payment_id']; ?>
										<hr>
										<b>Currency</b> | <?php echo $row['payment_currency']; ?>
										<hr>
										<b>Paid On</b> | <?php echo substr($row['charge_time'], 0, 19); ?>
										<hr>
										<b>Reason</b> | <?php echo $row['payment_descriptor']; ?>
										<hr>
										<b>Dispute Status</b> | <?php if ($row['payment_disputed']) {echo "True"; } else { echo "False"; } ?>
										<hr>
										<b>Payment Reconciliation ID</b> | <?php echo $row['charge_recid']; ?>
										<hr>
										<b>Payment Type</b> | <?php echo $row['charge_tokentype']; ?>
										<hr>
										<b>Payment Vendor</b> | <?php echo $row['charge_vendor']; ?>
										<hr>
										<b>Payment Source</b> | <?php echo $row['charge_source']; ?>
										<hr>
										<b>Transaction Response Code</b> | <?php echo $row['charge_responsecode']; ?>
										<hr>
										<b>Transaction Description</b> | <?php echo $row['charge_description']; ?>
										<hr>
										<b>Transaction ID</b> | <?php echo $row['charge_transactid']; ?>
										<hr>
										<b>Transaction External ID</b> | <?php echo $row['charge_externalid']; ?>
										<hr>
										<b>Transaction Fee Details</b><br>
										<textarea class="form-control" row="2" style="font-size: 1em; " disabled><?php echo $row['charge_feedetails']; ?></textarea>
									</div>
									<div class="col-md-5">
										<label for="payment-status" class="form-label">Transaction Result</label><br>
										<span id="payment-status" style="font-size: 2em;" class="text-primary"><?php echo $row['charge_result']; ?></span>
										<hr>
										<b>Payer Account ID</b> | <span id="amount-paid" class="text-primary"><?php echo $row['customer_id']; ?></span><br><br>
										<label for="account-name" class="form-label">Payer Account Name</label><br>
										<span id="account-name" style="font-size: 1.5em;" class="text-primary"><?php echo $row['payment_name']; ?></span><br>
										<label for="account-email" class="form-label">Payer Account Email</label><br>
										<span id="account-email" style="font-size: 1.5em;" class="text-primary"><?php echo $row['payment_email']; ?></span><br>
										<hr>
										<label for="amount-paid" class="form-label">Amount Paid</label><br>
										<span id="amount-paid" style="font-size: 3em;" class="text-primary"><?php if ($row['payment_currency'] == "USD") { echo "$" . $row['charge_amount']; } else if ($row['payment_currency'] == "KES") { echo "-//" . $row['charge_amount']; } else { echo $row['charge_amount'] . "c"; } ?></span><br>

										<?php
											if ($row['charge_nooffarms'] > 0)
											{
												echo "<b># of Farms Invested</b> | <span id='no-of-farms' style='font-size: 1.5em;' class='text-primary'>" .  $row['charge_nooffarms'] . "</span>";
											}
										?>
									</div>
								</div>
								
								<hr>
								<h6>Refund Processing</h6>
                                <button type='button' class='btn btn-warning w-100' data-bs-toggle='modal' data-bs-target='#processrefund_modal'>PROCESS REFUND</button>

								<div class="modal" id="processrefund_modal" tabindex="-1" aria-labelledby="ProcessRefundButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Process Refund</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center" style="font-size: 1.25em;">Are you sure?</p>
												
												<form method="POST">
													<input type="hidden" name="cardholder_refundrecid" value="<?php echo $row['charge_recid']; ?>">
													<div class="input-group input-group-sm mb-3">
														<span class="input-group-text">Reason</span>
														<select class="form-select" name="cardholder_refundreason" required>
															<option selected value="User Requested">User Requested</option>
															<option value="Erroneous Payment">Erroneous Payment</option>
														</select>
													</div>
													<div class="d-flex justify-content-evenly">
														<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="No">Decline</button>
														<button type="submit" class="btn btn-outline-danger" name="submit_refundbutton" value="<?php echo $row['payment_id']; ?>" aria-label="Yes">Accept</button>
													</div>
												</form>
												
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