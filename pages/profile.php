<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/profile_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Profile</title>
		
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
								
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<button class="nav-link active" id="nav-personal-tab" data-bs-toggle="tab" data-bs-target="#nav-personal" type="button" role="tab" aria-controls="nav-personal" aria-selected="true">Personal Settings</button>
										<button class="nav-link" id="nav-profileimg-tab" data-bs-toggle="tab" data-bs-target="#nav-profileimg" type="button" role="tab" aria-controls="nav-profileimg" aria-selected="false">Profile Image Settings</button>
										<button class="nav-link" id="nav-withdraw-tab" data-bs-toggle="tab" data-bs-target="#nav-withdraw" type="button" role="tab" aria-controls="nav-withdraw" aria-selected="false">Withdrawal Settings</button>
										<button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="false">Password/Security</button>
									</div>
								</nav>
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<form method="POST">
											
												<div class="row">
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settingusernamefield">Name</span>
															<input type="text" class="form-control" placeholder="Joseph Hughs" name="settinguser_name" pattern="[A-Za-z ]+" minlength="1" maxlength="25" title="Input a name using letters (UPPERCASE or lowercase) only." value="<?php echo $_SESSION["user_name"];?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settinguserusernamefield">Username</span>
															<input type="text" class="form-control" placeholder="BigJosephH123" name="settinguser_username" pattern="[A-Za-z0-9@#&_-+ ]+" minlength="5" maxlength="25" title="Input a username using letters (UPPERCASE or lowercase) and numbers only." value="<?php echo $_SESSION["user_username"];?>" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settinguseremailfield">E-mail</span>
															<input type="email" class="form-control" placeholder="j.hughs@example.com" name="settinguser_email" pattern="[A-Za-z0-9._@]+" minlength="5" maxlength="30" value="<?php echo $_SESSION["user_email"];?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settinguserpnumberfield">Phone Number</span>
															<input type="text" class="form-control" placeholder="0555-555-555" name="settinguser_pnumber" pattern="[0-9]+" minlength="7" maxlength="10" value="<?php echo $_SESSION["user_pnumber"]; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settinguserdobfield">D.o.B.</span>
															<input type="date" class="form-control" placeholder="dd-mm-yyyy" name="settinguser_dob" value="<?php echo $_SESSION["user_dob"]; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settingusercountryfield">Country</span>
															<select class="form-select" name="settinguser_country" required>
																<option>None</option>
																<option selected value=<?php echo $_SESSION["user_country"]; ?>>Selected: <?php echo $_SESSION["user_country"]; ?></option>
																<option value="Afghanistan">Afghanistan</option>
																<option value="Aland Islands">Åland Islands</option>
																<option value="Albania">Albania</option>
																<option value="Algeria">Algeria</option>
																<option value="American Samoa">American Samoa</option>
																<option value="Andorra">Andorra</option>
																<option value="Angola">Angola</option>
																<option value="Anguilla">Anguilla</option>
																<option value="Antarctica">Antarctica</option>
																<option value="Antigua and Barbuda">Antigua & Barbuda</option>
																<option value="Argentina">Argentina</option>
																<option value="Armenia">Armenia</option>
																<option value="Aruba">Aruba</option>
																<option value="Australia">Australia</option>
																<option value="Austria">Austria</option>
																<option value="Azerbaijan">Azerbaijan</option>
																<option value="Bahamas">Bahamas</option>
																<option value="Bahrain">Bahrain</option>
																<option value="Bangladesh">Bangladesh</option>
																<option value="Barbados">Barbados</option>
																<option value="Belarus">Belarus</option>
																<option value="Belgium">Belgium</option>
																<option value="Belize">Belize</option>
																<option value="Benin">Benin</option>
																<option value="Bermuda">Bermuda</option>
																<option value="Bhutan">Bhutan</option>
																<option value="Bolivia">Bolivia</option>
																<option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
																<option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
																<option value="Botswana">Botswana</option>
																<option value="Bouvet Island">Bouvet Island</option>
																<option value="Brazil">Brazil</option>
																<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
																<option value="Brunei Darussalam">Brunei</option>
																<option value="Bulgaria">Bulgaria</option>
																<option value="Burkina Faso">Burkina Faso</option>
																<option value="Burundi">Burundi</option>
																<option value="Cambodia">Cambodia</option>
																<option value="Cameroon">Cameroon</option>
																<option value="Canada">Canada</option>
																<option value="Cape Verde">Cape Verde</option>
																<option value="Cayman Islands">Cayman Islands</option>
																<option value="Central African Republic">Central African Republic</option>
																<option value="Chad">Chad</option>
																<option value="Chile">Chile</option>
																<option value="China">China</option>
																<option value="Christmas Island">Christmas Island</option>
																<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
																<option value="Colombia">Colombia</option>
																<option value="Comoros">Comoros</option>
																<option value="Congo">Congo - Brazzaville</option>
																<option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
																<option value="Cook Islands">Cook Islands</option>
																<option value="Costa Rica">Costa Rica</option>
																<option value="Cote D_Ivoire">Côte d'Ivoire</option>
																<option value="Croatia">Croatia</option>
																<option value="Cuba">Cuba</option>
																<option value="Curacao">Curaçao</option>
																<option value="Cyprus">Cyprus</option>
																<option value="Czech Republic">Czechia</option>
																<option value="Denmark">Denmark</option>
																<option value="Djibouti">Djibouti</option>
																<option value="Dominica">Dominica</option>
																<option value="Dominican Republic">Dominican Republic</option>
																<option value="Ecuador">Ecuador</option>
																<option value="Egypt">Egypt</option>
																<option value="El Salvador">El Salvador</option>
																<option value="Equatorial Guinea">Equatorial Guinea</option>
																<option value="Eritrea">Eritrea</option>
																<option value="Estonia">Estonia</option>
																<option value="Ethiopia">Ethiopia</option>
																<option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
																<option value="Faroe Islands">Faroe Islands</option>
																<option value="Fiji">Fiji</option>
																<option value="Finland">Finland</option>
																<option value="France">France</option>
																<option value="French Guiana">French Guiana</option>
																<option value="French Polynesia">French Polynesia</option>
																<option value="French Southern Territories">French Southern Territories</option>
																<option value="Gabon">Gabon</option>
																<option value="Gambia">Gambia</option>
																<option value="Georgia">Georgia</option>
																<option value="Germany">Germany</option>
																<option value="Ghana">Ghana</option>
																<option value="Gibraltar">Gibraltar</option>
																<option value="Greece">Greece</option>
																<option value="Greenland">Greenland</option>
																<option value="Grenada">Grenada</option>
																<option value="Guadeloupe">Guadeloupe</option>
																<option value="Guam">Guam</option>
																<option value="Guatemala">Guatemala</option>
																<option value="Guernsey">Guernsey</option>
																<option value="Guinea">Guinea</option>
																<option value="Guinea-Bissau">Guinea-Bissau</option>
																<option value="Guyana">Guyana</option>
																<option value="Haiti">Haiti</option>
																<option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
																<option value="Holy See (Vatican City State)">Vatican City</option>
																<option value="Honduras">Honduras</option>
																<option value="Hong Kong">Hong Kong</option>
																<option value="Hungary">Hungary</option>
																<option value="Iceland">Iceland</option>
																<option value="India">India</option>
																<option value="Indonesia">Indonesia</option>
																<option value="Iran, Islamic Republic of">Iran</option>
																<option value="Iraq">Iraq</option>
																<option value="Ireland">Ireland</option>
																<option value="Isle of Man">Isle of Man</option>
																<option value="Israel">Israel</option>
																<option value="Italy">Italy</option>
																<option value="Jamaica">Jamaica</option>
																<option value="Japan">Japan</option>
																<option value="Jersey">Jersey</option>
																<option value="Jordan">Jordan</option>
																<option value="Kazakhstan">Kazakhstan</option>
																<option value="Kenya">Kenya</option>
																<option value="Kiribati">Kiribati</option>
																<option value="Korea, Democratic People_s Republic of">North Korea</option>
																<option value="Korea, Republic of">South Korea</option>
																<option value="Kosovo">Kosovo</option>
																<option value="Kuwait">Kuwait</option>
																<option value="Kyrgyzstan">Kyrgyzstan</option>
																<option value="Lao People_s Democratic Republic">Laos</option>
																<option value="Latvia">Latvia</option>
																<option value="Lebanon">Lebanon</option>
																<option value="Lesotho">Lesotho</option>
																<option value="Liberia">Liberia</option>
																<option value="Libyan Arab Jamahiriya">Libya</option>
																<option value="Liechtenstein">Liechtenstein</option>
																<option value="Lithuania">Lithuania</option>
																<option value="Luxembourg">Luxembourg</option>
																<option value="Macao">Macao</option>
																<option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
																<option value="Madagascar">Madagascar</option>
																<option value="Malawi">Malawi</option>
																<option value="Malaysia">Malaysia</option>
																<option value="Maldives">Maldives</option>
																<option value="Mali">Mali</option>
																<option value="Malta">Malta</option>
																<option value="Marshall Islands">Marshall Islands</option>
																<option value="Martinique">Martinique</option>
																<option value="Mauritania">Mauritania</option>
																<option value="Mauritius">Mauritius</option>
																<option value="Mayotte">Mayotte</option>
																<option value="Mexico">Mexico</option>
																<option value="Micronesia, Federated States of">Micronesia</option>
																<option value="Moldova, Republic of">Moldova</option>
																<option value="Monaco">Monaco</option>
																<option value="Mongolia">Mongolia</option>
																<option value="Montenegro">Montenegro</option>
																<option value="Montserrat">Montserrat</option>
																<option value="Morocco">Morocco</option>
																<option value="Mozambique">Mozambique</option>
																<option value="Myanmar">Myanmar (Burma)</option>
																<option value="Namibia">Namibia</option>
																<option value="Nauru">Nauru</option>
																<option value="Nepal">Nepal</option>
																<option value="Netherlands">Netherlands</option>
																<option value="Netherlands Antilles">Curaçao</option>
																<option value="New Caledonia">New Caledonia</option>
																<option value="New Zealand">New Zealand</option>
																<option value="Nicaragua">Nicaragua</option>
																<option value="Niger">Niger</option>
																<option value="Nigeria">Nigeria</option>
																<option value="Niue">Niue</option>
																<option value="Norfolk Island">Norfolk Island</option>
																<option value="Northern Mariana Islands">Northern Mariana Islands</option>
																<option value="Norway">Norway</option>
																<option value="Oman">Oman</option>
																<option value="Pakistan">Pakistan</option>
																<option value="Palau">Palau</option>
																<option value="Palestinian Territory, Occupied">Palestine</option>
																<option value="Panama">Panama</option>
																<option value="Papua New Guinea">Papua New Guinea</option>
																<option value="Paraguay">Paraguay</option>
																<option value="Peru">Peru</option>
																<option value="Philippines">Philippines</option>
																<option value="Pitcairn">Pitcairn Islands</option>
																<option value="Poland">Poland</option>
																<option value="Portugal">Portugal</option>
																<option value="Puerto Rico">Puerto Rico</option>
																<option value="Qatar">Qatar</option>
																<option value="Reunion">Réunion</option>
																<option value="Romania">Romania</option>
																<option value="Russian Federation">Russia</option>
																<option value="Rwanda">Rwanda</option>
																<option value="Saint Barthelemy">St. Barthélemy</option>
																<option value="Saint Helena">St. Helena</option>
																<option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
																<option value="Saint Lucia">St. Lucia</option>
																<option value="Saint Martin">St. Martin</option>
																<option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
																<option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
																<option value="Samoa">Samoa</option>
																<option value="San Marino">San Marino</option>
																<option value="Sao Tome and Principe">São Tomé & Príncipe</option>
																<option value="Saudi Arabia">Saudi Arabia</option>
																<option value="Senegal">Senegal</option>
																<option value="Serbia">Serbia</option>
																<option value="Serbia and Montenegro">Serbia</option>
																<option value="Seychelles">Seychelles</option>
																<option value="Sierra Leone">Sierra Leone</option>
																<option value="Singapore">Singapore</option>
																<option value="Sint Maarten">Sint Maarten</option>
																<option value="Slovakia">Slovakia</option>
																<option value="Slovenia">Slovenia</option>
																<option value="Solomon Islands">Solomon Islands</option>
																<option value="Somalia">Somalia</option>
																<option value="South Africa">South Africa</option>
																<option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
																<option value="South Sudan">South Sudan</option>
																<option value="Spain">Spain</option>
																<option value="Sri Lanka">Sri Lanka</option>
																<option value="Sudan">Sudan</option>
																<option value="Suriname">Suriname</option>
																<option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
																<option value="Swaziland">Eswatini</option>
																<option value="Sweden">Sweden</option>
																<option value="Switzerland">Switzerland</option>
																<option value="Syrian Arab Republic">Syria</option>
																<option value="Taiwan, Province of China">Taiwan</option>
																<option value="Tajikistan">Tajikistan</option>
																<option value="Tanzania, United Republic of">Tanzania</option>
																<option value="Thailand">Thailand</option>
																<option value="Timor-Leste">Timor-Leste</option>
																<option value="Togo">Togo</option>
																<option value="Tokelau">Tokelau</option>
																<option value="Tonga">Tonga</option>
																<option value="Trinidad and Tobago">Trinidad & Tobago</option>
																<option value="Tunisia">Tunisia</option>
																<option value="Turkey">Turkey</option>
																<option value="Turkmenistan">Turkmenistan</option>
																<option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
																<option value="Tuvalu">Tuvalu</option>
																<option value="Uganda">Uganda</option>
																<option value="Ukraine">Ukraine</option>
																<option value="United Arab Emirates">United Arab Emirates</option>
																<option value="United Kingdom">United Kingdom</option>
																<option value="United States">United States</option>
																<option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
																<option value="Uruguay">Uruguay</option>
																<option value="Uzbekistan">Uzbekistan</option>
																<option value="Vanuatu">Vanuatu</option>
																<option value="Venezuela">Venezuela</option>
																<option value="Viet Nam">Vietnam</option>
																<option value="Virgin Islands, British">British Virgin Islands</option>
																<option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
																<option value="Wallis and Futuna">Wallis & Futuna</option>
																<option value="Western Sahara">Western Sahara</option>
																<option value="Yemen">Yemen</option>
																<option value="Zambia">Zambia</option>
																<option value="Zimbabwe">Zimbabwe</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settinguseraddressfield">Address</span>
															<input type="text" class="form-control" placeholder="22 JumpStreet, New York, USA" name="settinguser_address" pattern="[A-Za-z0-9.,- ]+" minlength="5" maxlength="100" value="<?php echo $_SESSION["user_address"]; ?>">
														</div>
													</div>
												</div>
												<div>
													<button type="submit" class="btn btn-primary col-4" name="submit_usersettings">Update Settings</button>
												</div>
												
											</form>
											
										</div>
									</div>
									
									<div class="tab-pane fade" id="nav-profileimg" role="tabpanel" aria-labelledby="nav-profileimg-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<form method="POST" enctype="multipart/form-data">
											
												<div class="row">
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settingprofileimgfield">Profile Image</span>
															<input type="file" class="form-control" id="check_profileimg" name="settinguser_profileimg" onchange="FilevalidationProfileImg()" required>
														</div>
														<div class="w-100 d-flex">
															<div class="me-2">
																<button type="submit" class="btn btn-primary col-12" name="submit_imagesettings">Update</button>
															</div>
											</form>
											<form method="POST">
															<div>
																<button type="submit" class="btn btn-danger col-12" name="submit_imageremoveimg">Remove</button>
															</div>
														</div>
													</div>
												</div>
												
											</form>
											
										</div>
									
									</div>
									
									<div class="tab-pane fade" id="nav-withdraw" role="tabpanel" aria-labelledby="nav-withdraw-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<form method="POST">
											
												<div class="row">
													<p>To avoid complications when requesting withdrawals, please make sure the information below is filled in, correct, and up-to-date.</p>
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputBankName" class="form-label">Bank Name</label>
															<input type="text" class="form-control" id="InputBankName" placeholder="Enter Bank Name" name="settinguser_bankname" pattern="[A-Za-z-_ ]+" minlength="1" maxlength="50" value="<?php echo $_SESSION["user_bankname"]; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputAccountName" class="form-label">Account Name</label>
															<input type="text" class="form-control" id="InputAccountName" placeholder="Enter Account Name" name="settinguser_accountname" pattern="[A-Za-z-_ ]+" minlength="1" maxlength="50" value="<?php echo $_SESSION["user_accountname"]; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputAccountNumber" class="form-label">Account Number</label>
															<input type="text" class="form-control" id="InputAccountNumber" placeholder="Enter Account Number" name="settinguser_accountnumber" pattern="[0-9]+" minlength="5" maxlength="20" value="<?php echo $_SESSION["user_accountno"]; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputSwiftCode" class="form-label">Swift Code</label>
															<input type="text" class="form-control" id="InputSwiftCode" placeholder="Enter Swift Code" name="settinguser_swiftcode" minlength="1" maxlength="15" value="<?php echo $_SESSION["user_swfcode"]; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputBitcoinAdd" class="form-label">Bitcoin</label>
															<input type="text" class="form-control" id="InputBitcoinAdd" placeholder="Enter Bitcoin Address" name="settinguser_bitcoinadd" minlength="1" maxlength="255" value="<?php echo $_SESSION["user_btcaddress"]; ?>" aria-describedby="BitcoinHelp">
															<div id="BitcoinHelp" class="form-text">Enter your Bitcoin Address that will be used to withdraw your funds</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputEtheriumAdd" class="form-label">Etherium</label>
															<input type="text" class="form-control" id="InputEtheriumAdd" placeholder="Enter Etherium Address" name="settinguser_etheriumadd" minlength="1" maxlength="255" value="<?php echo $_SESSION["user_ethaddress"]; ?>" aria-describedby="EtheriumHelp">
															<div id="EtheriumHelp" class="form-text">Enter your Etherium Address that will be used to withdraw your funds</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="mb-3">
															<label for="InputLitecoinAdd" class="form-label">Litecoin</label>
															<input type="text" class="form-control" id="InputLitecoinAdd" placeholder="Enter Litecoin Address" name="settinguser_litecoinadd" minlength="1" maxlength="255" value="<?php echo $_SESSION["user_ltcaddress"]; ?>" aria-describedby="LitecoinHelp">
															<div id="LitecoinHelp" class="form-text">Enter your Litecoin Address that will be used to withdraw your funds</div>
														</div>
													</div>
												</div>
												<div>
													<button type="submit" class="btn btn-primary col-2" name="submit_withdrawsettings">Save</button>
												</div>
												
											</form>
											
										</div>
									
									</div>
									
									<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab" tabindex="0">
									
										<div class="mt-3 w-100">
											
											<form method="POST">
											
												<div class="row">
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settingcurpassfield">Current Password</span>
															<input type="password" class="form-control" name="settinguser_currentpassword" minlength="7" maxlength="15" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settingnewpassfield">New Password</span>
															<input type="password" class="form-control" id="pass" name="settinguser_newpassword" minlength="7" maxlength="15" onkeyup="validate_password()" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group input-group-sm mb-3">
															<span class="input-group-text" id="settingconfirmpassfield">Confirm Password</span>
															<input type="password" class="form-control" id="confirm_pass" name="settinguser_confirmpassword" minlength="7" maxlength="15" onkeyup="validate_password()" required>
														</div>
													</div>
												</div>
												<div>
													<button type="submit" class="btn btn-primary col-4" id="confirm_button" name="submit_passwordsettings">Update Password</button>
												</div>
												<br>
												<span id="wrong_pass_alert"></span>
											</form>
											
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