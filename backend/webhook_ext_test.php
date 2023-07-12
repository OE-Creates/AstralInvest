<?php
    //echo "webhook_email_script loaded successfully";
    //echo "script for handling successful payment emails";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    function SendWebhookSuccessEmail($paymentid, $chargevendor)
    {
        require '../cron/values.php';

        require '../apps/PHPMailer/src/Exception.php';
        require '../apps/PHPMailer/src/PHPMailer.php';
        require '../apps/PHPMailer/src/SMTP.php';

        require '../backend/dbconnect_invest.php';

        $getdata = "SELECT payment_descriptor, payment_name, payment_email, charge_time, charge_amount FROM transactions_test WHERE payment_id = '$paymentid'";
        $get = $conn->query($getdata);
        $row = $get->fetch_array();

        $ureason = $row['payment_descriptor'];
        $uname = $row['payment_name'];
        $uemail = $row['payment_email'];
        $udate = substr($row['charge_time'], 0, 19);
        $ucard = $chargevendor;
        $uamount = $row['charge_amount'];

        $conn->close();

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
            $mail->Subject = 'AstralInvest - Successful Payment Confirmation';
            $mail->Body = '<html>
                                <head>
                                </head>
                                <body>
                                    Hello ' . $uname . '.
                                    <br>
                                    A successful payment of <b>$' . $uamount . '</b> was just paid to AstralInvest.
                                    <br><br>
                                    <b>PAYMENT BREAKDOWN</b><br>
                                    Reason: ' . $ureason . '<br>
                                    Date: ' . $udate . '<br>
                                    Email: ' . $uemail . '<br>
                                    Card Type:' . $ucard . '<br>
                                    Amount: ' . $uamount . '<br>

                                    <br>
                                    Kind Regards,
                                    <b>AstralInvest</b>
                                </body>
                            </html>';
            $mail->AltBody = 'Hello ' . $uname . ' (' . $uemail . '). A successful payment of $' . $uamount . ' for ' . $ureason . ' was just paid to AstralInvest on ' . $udate . '.';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function SendWebhookRefundEmail($paymentid)
    {
        require '../cron/values.php';

        require '../apps/PHPMailer/src/Exception.php';
        require '../apps/PHPMailer/src/PHPMailer.php';
        require '../apps/PHPMailer/src/SMTP.php';

        require '../backend/dbconnect_invest.php';

        $updatepayrefunded = "UPDATE transactions_test SET refund_processed = 1 WHERE payment_id = '$paymentid'";
        $runupdatepayrefunded = $conn->query($updatepayrefunded);

        $getdata = "SELECT payment_descriptor, customer_id, payment_name, payment_email, charge_time, charge_amount, refund_time FROM transactions_test WHERE payment_id = '$paymentid'";
        $get = $conn->query($getdata);
        $row = $get->fetch_array();

        $ureason = $row['payment_descriptor'];
        $upname = $row['payment_name'];
        $upemail = $row['payment_email'];
        $ucdate = substr($row['charge_time'], 0, 19);
        $urdate = substr($row['refund_time'], 0, 19);
        $uamount = $row['charge_amount'];

        $curruserid = $row['customer_id'];

        $getadddata = "SELECT name, email FROM users WHERE id = '$curruserid'";
        $getadd = $conn->query($getadddata);
        $row_e = $getadd->fetch_array();

        $uemail = $row_e['email'];
        $uname = $row_e['name'];

        $conn->close();

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
            $mail->Subject = 'AstralInvest - Successful Refund Confirmation';
            $mail->Body = '<html>
                                <head>
                                </head>
                                <body>
                                    Hello ' . $uname . '.
                                    <br>
                                    A refund of <b>$' . $uamount . '</b> was just successfully completed from AstralInvest.
                                    <br><br>
                                    <b>REFUND BREAKDOWN</b><br>
                                    Payment Reason: ' . $ureason . '<br><br>

                                    Payment Name: ' . $upname . '<br>
                                    Payment Email: ' . $upemail . '<br>
                                    Payment Date: ' . $ucdate . '<br>
                                    Payment Amount: ' . $uamount . '<br><br>

                                    Refund Date' . $urdate . '<br>
                                    Refund Amount: ' . $uamount . '<br>

                                    <br>
                                    Kind Regards,
                                    <b>AstralInvest</b>
                                </body>
                            </html>';
            $mail->AltBody = 'Hello ' . $uname . ' (' . $uemail . '). A refund of $' . $uamount . ' for ' . $ureason . ' was completed by AstralInvest on ' . $urdate . '.';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function SetReferralDataIfAny($paymentid)
    {
        require '../cron/values.php';

        require '../backend/dbconnect_invest.php';

        $getdata = "SELECT customer_id, charge_amount FROM transactions_test WHERE payment_id = '$paymentid' AND payment_descriptor LIKE '%Contribution Plan%'";
        $get = $conn->query($getdata);

        if ($get->num_rows !== 0)
        {
            $row = $get->fetch_array();

            $crefid_e = $row['customer_id'];
            $camount = $row['charge_amount'];
            $camountex = round(($camount / (1 + $ke_vat)), 2);
            $creferralamount = round(($camountex * $referral_percent), 2);

            $getref = "SELECT * FROM referrals WHERE referree_id = '$crefid_e'";
            $rungetref = $conn->query($getref);

            if ($rungetref->num_rows !== 0)
            {
                $row_e = $rungetref->fetch_array();

                $referrerprofit = $row_e['referrer_profit'];
                $referreeprofit = $row_e['referree_profit'];

                $referrerprofit += $creferralamount;
                $referreeprofit += $creferralamount;

                $updateref = "UPDATE referrals SET referrer_profit = '$referrerprofit', referree_profit = '$referreeprofit' WHERE referree_id = '$crefid_e'";
                $updref = $conn->query($updateref);
            }
        }

        $conn->close();
    }

    function UnsetReferralDataIfAny($paymentid)
    {
        require '../cron/values.php';

        require '../backend/dbconnect_invest.php';

        $getdata = "SELECT customer_id, charge_amount FROM transactions_test WHERE payment_id = '$paymentid' AND payment_descriptor LIKE '%Contribution Plan%'";
        $get = $conn->query($getdata);

        if ($get->num_rows !== 0)
        {
            $row = $get->fetch_array();

            $crefid_e = $row['customer_id'];
            $camount = $row['charge_amount'];
            $camountex = round(($camount / (1 + $ke_vat)), 2);
            $creferralamount = round(($camountex * $referral_percent), 2);

            $getref = "SELECT * FROM referrals WHERE referree_id = '$crefid_e'";
            $rungetref = $conn->query($getref);

            if ($rungetref->num_rows !== 0)
            {
                $row_e = $rungetref->fetch_array();

                $referrerprofit = $row_e['referrer_profit'];
                $referreeprofit = $row_e['referree_profit'];

                $referrerprofit -= $creferralamount;
                if ($referrerprofit < 0) { $referrerprofit = 0; }
                $referreeprofit -= $creferralamount;
                if ($referreeprofit < 0) { $referreeprofit = 0; }

                $updateref = "UPDATE referrals SET referrer_profit = '$referrerprofit', referree_profit = '$referreeprofit' WHERE referree_id = '$crefid_e'";
                $updref = $conn->query($updateref);
            }
        }

        $conn->close();
    }
?>