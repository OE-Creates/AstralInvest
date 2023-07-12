<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/core_management_logic.php";

	require "../backend/dbconnect_invest.php";
	$curruserid = $_SESSION["userpage_id"];
	
	$pulldata = "SELECT * FROM users WHERE id = '$curruserid'";
	$pull = $conn->query($pulldata);
	
	$row = $pull->fetch_array();
	$conn->close();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | M-User</title>
		
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

						<div class="card col-md-12 box-shadow">
							<div class="card-body pb-0">
								
								<h5 class="card-title text-primary">User Information</h5>
								<div class="d-flex justify-content-begin">
									<a class="btn btn-sm btn-primary me-2" href="management_user.php" role="button">
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
                                    <div class="col-md-6">
                                        <span id="account-name" style="font-size: 1.5em;" class="text-primary"><?php echo $row['name']; ?></span><br>
                                        <b>Account ID</b> | <?php echo $row['id']; ?>
                                        <hr>
										<b>Account Username</b> | <?php echo $row['username']; ?>
										<hr>
										<b>Account Email</b> | <?php echo $row['email']; ?>
										<hr>
										<b>Level</b> | <?php if ($row['level'] == 1) { echo "Administrator"; } else { echo "User"; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="verify-status" class="form-label">Account Status</label><br>
										<span id="verify-status" style="font-size: 2em;" class="text-primary"><?php if ($row['verification_status'] == 1) { echo "Verified"; } else { echo "Not Verified"; } ?></span>
                                        <hr>
										<b>Account Created</b> | <?php echo $row['account_created_on']; ?>
										<hr>
                                        <?php if ($row['loggedin_status'] == 1) { echo "Logged In"; } else { echo "Logged Out"; } ?>
                                    </div>
                                </div>

                                <hr>
                                <h6>Ban Status</h6>
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <b>Account Payment Banned</b> | <?php if ($row['account_paymentban'] == 0) { echo "False"; } else { echo "True"; } ?>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <?php
                                            if ($row['account_paymentban'] == 0)
                                            { echo "<button type='button' class='btn btn-sm btn-danger w-100' data-bs-toggle='modal' data-bs-target='#paybanuser_modal'>PAY-BAN USER</button>"; }
                                            else
                                            { echo "<button type='button' class='btn btn-sm btn-success w-100' data-bs-toggle='modal' data-bs-target='#paybanuser_modal'>UNPAY-BAN USER</button>"; }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <b>Account Banned</b> | <?php if ($row['account_accountban'] == 0) { echo "False"; } else { echo "True"; } ?>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <?php
                                            if ($row['account_accountban'] == 0)
                                            { echo "<button type='button' class='btn btn-sm btn-danger w-100' data-bs-toggle='modal' data-bs-target='#banuser_modal'>BAN USER</button>"; }
                                            else
                                            { echo "<button type='button' class='btn btn-sm btn-success w-100' data-bs-toggle='modal' data-bs-target='#banuser_modal'>UNBAN USER</button>"; }
                                        ?>
                                    </div>
                                </div>

                                <hr class="mt-0">
                                <div class="row justify-content-between">
                                    <div class="col-md-3 mb-3">
                                        <button type='button' class='btn btn-primary w-100' data-bs-toggle='modal' data-bs-target='#updateuser_modal'>UPDATE USER</button>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <?php
                                            if ($row['id'] != $_SESSION["user_id"])
                                            { echo "<button type='button' class='btn btn-danger w-100' data-bs-toggle='modal' data-bs-target='#deleteuser_modal'>DELETE USER</button>"; }
                                        ?>
                                    </div>
                                </div>

								<div class="modal" id="updateuser_modal" tabindex="-1" aria-labelledby="UpdateUserButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update User Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form method="POST">
                                                    <h6>Update Name</h6>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="signupnamefield">Name</span>
                                                        <input type="text" class="form-control" placeholder="Joseph Hughs" name="updateuser_name" pattern="[A-Za-z ]+" minlength="1" maxlength="50" title="Input your name using letters (UPPERCASE or lowercase) only." required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary" name="submit_updateusername" value="<?php echo $row['id']; ?>">Update Name</button>
                                                    </div>
                                                </form>
                                                <hr>
                                                <form method="POST">
                                                    <h6>Update Username</h6>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="updateuserusernamefield">Username</span>
                                                        <input type="text" class="form-control" placeholder="BigJosephH123" name="updateuser_username" pattern="[A-Za-z0-9@#&_-+ ]+" minlength="5" maxlength="50" title="Input a username using letters (UPPERCASE or lowercase) and numbers only." required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary" name="submit_updateuserusername" value="<?php echo $row['id']; ?>">Update Username</button>
                                                    </div>
                                                </form>
                                                <hr>
                                                <form method="POST">
                                                    <h6>Update Email</h6>
                                                    <div class="input-group input-group-sm mb-3">
														<span class="input-group-text" id="updateuseremailfield">E-mail</span>
                                                        <input type="email" class="form-control" placeholder="j.hughs@example.com" name="updateuser_email" pattern="[A-Za-z0-9.-_@]+" minlength="5" maxlength="50" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary" name="submit_updateuseremail" value="<?php echo $row['id']; ?>">Update Email</button>
                                                    </div>
                                                </form>
                                                <hr>
                                                <form method="POST">
                                                    <h6>Update Privilege</h6>
                                                    <div class="input-group input-group-sm mb-3">
														<span class="input-group-text" id="updateuserlevelfield">Privilege</span>
                                                        <select class="form-select" id="updateuserlevelfield" name="updateuser_level" required>
                                                            <option selected value="0">User</option>
                                                            <option value="1">Administrator</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary" name="submit_updateuserlevel" value="<?php echo $row['id']; ?>">Update Privilege</button>
                                                    </div>
                                                </form>
                                                <hr>
                                                <form method="POST">
                                                    <h6>Update Password</h6>
													<div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="updateuserpasswordfield">Password</span>
                                                        <input type="password" class="form-control" id="updpass" name="updateuser_password" minlength="7" maxlength="15" onkeyup="validate_updpassword()" required>
													</div>
													<div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="updateusercpasswordfield">Confirm Password</span>
                                                        <input type="password" class="form-control" id="confirm_updpass" name="updateuser_cpassword" minlength="7" maxlength="15"  onkeyup="validate_updpassword()" required>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary" id="confirm_updbutton" name="submit_updateuserpassword" value="<?php echo $row['id']; ?>">Update Password</button>
                                                    </div>
                                                    <br>
                                                    <span id="wrong_pass_alert_upd"></span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="modal" id="deleteuser_modal" tabindex="-1" aria-labelledby="DeleteUserButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <p class="text-center" style="font-size: 1.25em;">Are you sure?</p>
												<div class="d-flex justify-content-evenly">
													<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="No">Decline</button>
													<form method="POST">
														<button type="submit" class="btn btn-outline-danger" name="submit_deleteuser" value="<?php echo $row['id']; ?>" aria-label="Yes">Accept</button>
													</form>
												</div>
												
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal" id="paybanuser_modal" tabindex="-1" aria-labelledby="PayBanUserButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Pay-ban User?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <p class="text-center" style="font-size: 1.25em;">Are you sure?</p>
												<div class="d-flex justify-content-evenly">
													<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="No">Decline</button>
													<form method="POST">
														<button type="submit" class="btn btn-outline-danger" name="submit_paybanuser" value="<?php echo $row['id']; ?>" aria-label="Yes">Accept</button>
													</form>
												</div>
												
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal" id="banuser_modal" tabindex="-1" aria-labelledby="BanUserButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Ban User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center" style="font-size: 1.25em;">Are you sure?</p>
												<div class="d-flex justify-content-evenly">
													<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="No">Decline</button>
													<form method="POST">
														<button type="submit" class="btn btn-outline-danger" name="submit_banuser" value="<?php echo $row['id']; ?>" aria-label="Yes">Accept</button>
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