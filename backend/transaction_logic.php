<?php
    
    function DisplayTransactionList()
    {
        $uid = $_SESSION["user_id"];

        require 'dbconnect_invest.php';

        $getlist = "SELECT * FROM transactions WHERE customer_id = '$uid' ORDER BY charge_time DESC";
        $get = $conn->query($getlist);

        while ($row = $get->fetch_array())
        {	
            echo "
                <tr>
                    <td>" . $row['payment_name'] . "</td>
                    <td>" . $row['payment_descriptor'] . "</td>
                    <td>" . substr($row['charge_time'], 0, 19) . "</td>
                    <td>" . $row['charge_tokentype'] . "</td>
                    <td><a href='#' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left' data-bs-title='" . $row['charge_description'] . "'>" . $row['charge_result'] . "</a></td>
                    <td>" . $row['charge_amount'] . "</td>
                    <td><form method='GET'><button type='submit' class='btn btn-sm btn-primary py-0' name='submit_viewtransaction' value='" . $row['id'] . "'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-right' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z'/>
                    </svg>
                    </button></form></td>
                </tr>
            ";
        }
        
        $conn->close();
    }

    //VIEW TRANSACTION PAGE
	if (isset($_GET['submit_viewtransaction']))
	{	
		$_SESSION["usertransactpage_id"] = $_GET['submit_viewtransaction'];
		header("Location: user_transact_full.php");
		exit();
	}
	
	function DisplayRefundButton($PayerID, $PaymentID, $PaymentAmt, $PayReason, $Status, $PayDate, $RefundStatus, $RefRequestDate)
	{
        require "../cron/values.php";

		If ($Status == "Succeed" && stripos($PayReason, "Contribution Plan") !== FALSE) //Payment Succeeded and is a Contribution Plan
        {
            If ($RefundStatus != 1) //Payer hasn't previously requested a refund
            {
                $currdate = new DateTimeImmutable("now");
                $pastdate = new DateTimeImmutable($PayDate);
                $interval = $currdate->diff($pastdate);

                If ($interval->days <= $refund_validtime) //Payment still within valid refund time
                {
                    require "dbconnect_invest.php";
                    $getref = "SELECT * FROM referrals WHERE referree_id = '$PayerID'";
                    $rungetref = $conn->query($getref);

                    If ($rungetref->num_rows !== 0) //Payer is a Referred Account
                    {
                        $conn->close();
                        $row_getref = $rungetref->fetch_array();

                        $referral_amt = round(round($PaymentAmt / (1 + $ke_vat), 2) * $referral_percent, 2); //Amount earned from referral for this payment

                        $referrer_profit = $row_getref['referrer_profit'];

                        If ($referrer_profit < $referral_amt) //Referrer has already withdrawn their referral earnings
                        {
                            echo "
                                <hr>
                                <div class='col-md-5 offset-md-7'>
                                    <p>A refund request for this transaction cannot be initiated because the referrer of this account already <b>withdrew</b> their referral earnings.</p>
                                </div>
                            ";
                        }
                        else ////Referrer has not already withdrawn their referral earnings
                        {
                            $referree_profit = $row_getref['referree_profit'];

                            If ($referree_profit < $referral_amt) //Referree has already withdrawn their referral earnings
                            {
                                echo "
                                    <hr>
                                    <div class='col-md-5 offset-md-7'>
                                        <p>A refund request for this transaction cannot be initiated because the account holder already <b>withdrew</b> their referral earnings.</p>
                                    </div>
                                ";
                            }
                            else //Referree has not already withdrawn the referral earnings
                            {
                                echo "
                                    <hr>
                                    <div class='col-md-5 offset-md-7'>
                                        <p>Refund Request Period ==> <b>10 Days</b> from Payment Date</p>
                                        <form method='POST'>
                                            <button type='submit' class='btn btn-outline-danger w-100' name='submit_userrequestrefund' value='" . $PaymentID . "'>GET REFUND</button>
                                        </form>
                                    </div>
                                ";
                            }
                        }
                    }
                    else //Payer is not a Referred Account
                    {
                        $conn->close();

                        echo "
                            <hr>
                            <div class='col-md-5 offset-md-7'>
                                <p>Refund Request Period ==> <b>10 Days</b> from Payment Date</p>
                                <form method='POST'>
                                    <button type='submit' class='btn btn-outline-danger w-100' name='submit_userrequestrefund' value='" . $PaymentID . "'>GET REFUND</button>
                                </form>
                            </div>
                        ";
                    }
                }
                else //Payment is not within valid refund time
                {
                    echo "
                        <hr>
                        <div class='col-md-5 offset-md-7'>
                            <p>A refund request for this transaction cannot be initiated because the refund request period has elapsed <b>(10 Days)</b>.</p>
                        </div>
                    ";
                }
            }
            else //Payer has previously requested a refund
            {
                echo "
                    <hr>
                    <div class='col-md-5 offset-md-7'>
                        <p>A refund request for this payment was already made on <b>" . substr($RefRequestDate, 0, 19) . "</b>. Please allow for a few days post request for the refund to be processed.</p>
                        <form method='POST'>
                            <button type='submit' class='btn btn-outline-success w-100' name='submit_userrescindrefund' value='" . $PaymentID . "'>RESCIND REFUND</button>
                        </form>
                    </div>
                ";
            }
            
        }
	}

    //REQUEST REFUND LOGIC
    if (isset($_POST['submit_userrequestrefund']))
    {
        require 'dbconnect_invest.php';

        $recordid = $conn->real_escape_string($_POST['submit_userrequestrefund']);
        $refrequesttime = date("Y-m-d H:i:s");

        $updrecord = "UPDATE transactions SET refund_requested = 1, refund_requestdate = '$refrequesttime' WHERE id = '$recordid'";
        $update = $conn->query($updrecord);

        $conn->close();
    }

    if (isset($_POST['submit_userrescindrefund']))
    {
        require 'dbconnect_invest.php';

        $recordid = $conn->real_escape_string($_POST['submit_userrescindrefund']);
        $refrequesttime = "0000-00-00 00:00:00.000000";

        $updrecord = "UPDATE transactions SET refund_requested = 0, refund_requestdate = '$refrequesttime' WHERE id = '$recordid'";
        $update = $conn->query($updrecord);

        $conn->close();
    }

?>