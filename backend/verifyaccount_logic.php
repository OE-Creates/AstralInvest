<?php
    //echo "verifyaccount_logic_script loaded successfully";

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;	
	
    if (isset($_POST['submit_verifyaccount']))
	{
		require 'dbconnect_invest.php';
		
        $uid = $_SESSION["user_id"];
		$ucode = $conn->real_escape_string($_POST['verifyaccount_code']);

        $checkcode = "SELECT verification_code FROM users WHERE id = '$uid'";
        $check = $conn->query($checkcode);

        $row = $check->fetch_array();

        if ($ucode == $row['verification_code'])
        {
            $setverifystatus = "UPDATE users SET verification_status = 1 WHERE id = '$uid'";
            $set = $conn->query($setverifystatus);

            $_SESSION["user_verifystatus"] = 1;

            header("Location: dashboard.php");
			exit();
        }
        else
        {
            echo "
				<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
					Incorrect code, try again
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>
			";
        }

        $conn->close();
    }
	
	if (isset($_POST['submit_resendverify']))
	{
		require 'dbconnect_invest.php';
		
        $uid = $_SESSION["user_id"];
		$uemail = $_SESSION["user_email"];

        $getcode = "SELECT verification_code FROM users WHERE id = '$uid'";
        $check = $conn->query($getcode);

        $row = $check->fetch_array();
		
		$uverifycode = $row['verification_code'];

        //Email user with generated code
		require '../apps/PHPMailer/src/Exception.php';
		require '../apps/PHPMailer/src/PHPMailer.php';
		require '../apps/PHPMailer/src/SMTP.php';

		// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
		$mail = new PHPMailer(true);

		try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'mail.astralinvest.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'accounts@astralinvest.com'; // SMTP username
		$mail->Password = '**********'; // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // //Enable implicit TLS encryption
		$mail->Port = 465; // TCP port to connect to

		$mail->setFrom('accounts@astralinvest.com', 'do-not-reply');
		$mail->addAddress($uemail); // Add a recipient $mail->addAddress('to@example.com', 'Joe User');
		$mail->addReplyTo('info@astralinvest.com', 'Information');

		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'AstralInvest - Verify Email Account';
		$mail->Body = '<html>
							<head>
							</head>
							<body>
							Please find below, the verification code for account, ' . $uemail . '.

							Enter the code below into the "Verification Code" field on the AstralInvest portal verification page to gain full control of your account.

							<b><h1>' . $uverifycode . '</h1></b>
							</body>
						</html>';
		$mail->AltBody = 'Please find below, the verification code for account, ' . $uemail . '. Enter the code below into the "Verification Code" field on the AstralInvest portal verification page to gain full control of your account. Verify Code: '. $uverifycode . '.';

		$mail->send();
		//echo 'Message has been sent';

		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			echo "
				<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
					Verification email could not be sent, email address could not be reached. You will not be able to use the account you just tried to create. Create a new account or contact support with a working email to have you account updated.
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>
			";
		}

        $conn->close();
    }
?>