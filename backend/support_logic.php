<?php
    //echo "support_logic_script loaded successfully";

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;	
	
    if (isset($_POST['submit_supportmsg']))
	{
		require 'dbconnect_invest.php';
		
		if (isset($_SESSION["user_email"]))
		{
			$uemail = $_SESSION["user_email"];
		}
		else
		{
			$uemail = $conn->real_escape_string($_POST['support_email']);
		}
		
		$umessage = $conn->real_escape_string($_POST['support_message']);
		
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
		$mail->addAddress('info@astralinvest.com'); // Add a recipient $mail->addAddress('to@example.com', 'Joe User');
		$mail->addReplyTo('info@astralinvest.com', 'Information');

		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'WGK - Support (' . $uemail . ')';
		$mail->Body = $umessage;
		$mail->AltBody = $umessage;
		
		$mail->send();
		//echo 'Message has been sent';
		
		echo "
			<div class='alert alert-success alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
				Message Sent.
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>
		";

		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		
		$conn->close();
	}
?>