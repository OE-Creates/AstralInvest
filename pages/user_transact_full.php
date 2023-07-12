<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/transaction_logic.php";

	require "../backend/dbconnect_invest.php";
	$currusertransid = $_SESSION["usertransactpage_id"];
	
	$pulldata = "SELECT * FROM transactions WHERE id = '$currusertransid'";
	$pull = $conn->query($pulldata);
	
	$row = $pull->fetch_array();
	$conn->close();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | U-Transaction</title>
		
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
								
								<h5 class="card-title text-primary">Transaction Details</h5>
								<div>
									<a class="btn btn-sm btn-primary me-2" href="transaction.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Back
									</a>
								</div>
								<hr>

								<div class="row">
									<div class="col-md-7">
										<b>Reference ID</b> | <?php echo $row['id']; ?>
										<hr>
										<b>Currency</b> | <?php echo $row['payment_currency']; ?>
										<hr>
										<b>Paid On</b> | <?php echo substr($row['charge_time'], 0, 19); ?>
										<hr>
										<b>Reason</b> | <?php echo $row['payment_descriptor']; ?>
										<hr>
										<b>Dispute Status</b> | <?php if ($row['payment_disputed']) {echo "True"; } else { echo "False"; } ?>
										<hr>
										<b>Payment Type</b> | <?php echo $row['charge_tokentype']; ?>
										<hr>
										<b>Payment Vendor</b> | <?php echo $row['charge_vendor']; ?>
										<hr>
										<b>Transaction Description</b> | <?php echo $row['charge_description']; ?>
									</div>
									<div class="col-md-5">
										<label for="payment-status" class="form-label">Transaction Result</label><br>
										<span id="payment-status" style="font-size: 2em;" class="text-primary"><?php echo $row['charge_result']; ?></span>
										<hr>
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
									<?php DisplayRefundButton($_SESSION["user_id"], $row['id'], $row['charge_amount'], $row['payment_descriptor'], $row['charge_result'], $row['charge_time'], $row['refund_requested'], $row['refund_requestdate']); ?>
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