<?php

	require "../cron/values.php";
	include '../backend/webhook_ext.php';

	if ($_SERVER["REQUEST_METHOD"] === "POST")
	{
		$headers = apache_request_headers();

		foreach ($headers as $header => $value)
		{
			if ($header == "event-type" && $value == "payment.payment.create")
			{
				$rawpayload = file_get_contents("php://input");
				$payload = json_decode($rawpayload, true);

				require '../backend/dbconnect_invest.php';

				$id = $payload["id"];
				
				$paymentid = $payload["payment_id"];

				$paymentcurrency = $payload["data"]["currency"];

				$timestamp = $payload["data"]["created"];
				$newtimestamp = substr($timestamp, 0, 10);
				$paymenttime = date("Y-m-d H:i:s", $newtimestamp);

				$paymentdescriptor = $payload["data"]["statement_soft_descriptor"];
				$paymentdisputed = $payload["data"]["is_disputed"];
				
				$paymentcustomerid = $payload["data"]["additional_details"]["account_id"];
				$paymentnooffarms = $payload["data"]["additional_details"]["no_of_farms"];

				$paymentname = $payload["data"]["billing_address"]["first_name"] . " " . $payload["data"]["billing_address"]["last_name"];
				$paymentemail = $payload["data"]["billing_address"]["email"];

				$ph_cid = date("H:i:s");
				$ph_rid = date("H:i:s");

				$checkpaymentid = "SELECT payment_id FROM transactions WHERE payment_id = '$paymentid'";
				$check = $conn->query($checkpaymentid);

				if ($check->num_rows === 0)
				{
					$addnewdata = "INSERT INTO transactions (id, payment_id, payment_currency, payment_time, payment_descriptor, payment_disputed, customer_id, payment_name, payment_email, cid, charge_nooffarms, rid)
													  VALUES('$id', '$paymentid', '$paymentcurrency', '$paymenttime', '$paymentdescriptor', '$paymentdisputed', '$paymentcustomerid', '$paymentname', '$paymentemail', '$ph_cid', '$paymentnooffarms', '$ph_rid')";
					$adddata = $conn->query($addnewdata);
				}
				else
				{
					$updnewdata = "UPDATE transactions SET id = '$id', payment_currency = '$paymentcurrency', payment_time = '$paymenttime', payment_descriptor = '$paymentdescriptor', payment_disputed = '$paymentdisputed',
														   customer_id = '$paymentcustomerid', payment_name = '$paymentname', payment_email = '$paymentemail', charge_nooffarms = '$paymentnooffarms' WHERE payment_id = '$paymentid'";
					$upddata = $conn->query($updnewdata);
				}

			}

			/*if ($header == "event-type" && $value == "payment.payment.update")
			{
				$rawpayload = file_get_contents("php://input");
				$payload = json_decode($rawpayload, true);

				require '../backend/dbconnect_invest.php';
			}*/

			if ($header == "event-type" && $value == "payment.charge.create")
			{
				$rawpayload = file_get_contents("php://input");
				$payload = json_decode($rawpayload, true);

				require '../backend/dbconnect_invest.php';
				
				$cid = $payload["id"];

				$paymentid = $payload["payment_id"];

				$timestamp = $payload["data"]["created"];
				$newtimestamp = substr($timestamp, 0, 10);
				$chargetime = date("Y-m-d H:i:s", $newtimestamp);

				$chargerecid= $payload["data"]["reconciliation_id"];
				$chargetokentype = $payload["data"]["payment_method"]["alternative_payment"]["additional_details"]["supported_payment_methods"];
				$chargesource = $payload["data"]["payment_method"]["source_type"];
				$chargeresult = $payload["data"]["result"]["status"];

				$chargeprovname = $payload["data"]["provider_data"]["provider_name"];
				$chargedescr = "Transaction Process Not Completed";
				$chargetransid = $payload["data"]["provider_data"]["transaction_id"];

				$chargeamount = $payload["data"]["amount"] / 100;
				
				$checkpaymentid = "SELECT payment_id FROM transactions WHERE payment_id = '$paymentid'";
				$check = $conn->query($checkpaymentid);

				if ($check->num_rows !== 0)
				{
					$addchargedata = "UPDATE transactions SET cid = '$cid', charge_time = '$chargetime', charge_recid = '$chargerecid', charge_tokentype = '$chargetokentype', charge_source = '$chargesource', charge_result = '$chargeresult',
															  charge_providername = '$chargeprovname', charge_transactid = '$chargetransid', charge_description = '$chargedescr', charge_amount = '$chargeamount' WHERE payment_id = '$paymentid'";
					$addchdata = $conn->query($addchargedata);
				}
				else
				{					
					$file = "../logs/webhook_errors.txt";
					$entry = ">>> Payment request was not logged for this charge -> CHARGE ID: " . $paymentid . ". Please check PaymentOS account for more details.\n";
					file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
				}
			}

			if ($header == "event-type" && $value == "payment.charge.update")
			{
				$rawpayload = file_get_contents("php://input");
				$payload = json_decode($rawpayload, true);

				require '../backend/dbconnect_invest.php';
				
				$cid = $payload["id"];

				$paymentid = $payload["payment_id"];

				$chargevendor = $payload["data"]["payment_method"]["alternative_payment"]["vendor"];
				$chargeresult = $payload["data"]["result"]["status"];

				$chargeresponsecode = $payload["data"]["provider_data"]["response_code"];
				$chargedescr = $payload["data"]["provider_data"]["description"];

				if (isset($payload["data"]["provider_data"]["external_id"]))
				{
					$chargeexternalid = $payload["data"]["provider_data"]["external_id"];
				}
				else
				{
					$chargeexternalid = "No External ID";
				}
				
				if (isset($payload["data"]["provider_data"]["transaction_cost"]["applied_fees"]))
				{
					$chargefeedetails = json_encode($payload["data"]["provider_data"]["transaction_cost"]["applied_fees"]);
				}
				else
				{
					$chargefeedetails = "No Payment Fees";
				}
				
				$checkpaymentid = "SELECT payment_id FROM transactions WHERE payment_id = '$paymentid'";
				$check = $conn->query($checkpaymentid);

				if ($check->num_rows !== 0)
				{
					$updatechargedata = "UPDATE transactions SET cid = '$cid', charge_vendor = '$chargevendor', charge_result = '$chargeresult', charge_responsecode = '$chargeresponsecode',
																 charge_description = '$chargedescr', charge_externalid ='$chargeexternalid', charge_feedetails = '$chargefeedetails' WHERE payment_id = '$paymentid'";
					$updchdata = $conn->query($updatechargedata);

					if ($chargeresult == "Succeed")
					{
						SendWebhookSuccessEmail($paymentid, $chargevendor);
						SetReferralDataIfAny($paymentid);
					}
				}
				else
				{					
					$file = "../logs/webhook_errors.txt";
					$entry = ">>> Charge Update invalid -> CHARGE ID: " . $paymentid . ". Please check PaymentOS account for more details.\n";
					file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
				}
			}

			if ($header == "event-type" && $value == "payment.refund.create")
			{
				$rawpayload = file_get_contents("php://input");
				$payload = json_decode($rawpayload, true);

				require '../backend/dbconnect_invest.php';

				$rid = $payload["id"];

				$paymentid = $payload["payment_id"];

				$timestamp = $payload["data"]["created"];
				$newtimestamp = substr($timestamp, 0, 10);
				$refundtime = date("Y-m-d H:i:s", $newtimestamp);

				$refundreason = $payload["data"]["reason"];

				$refundresult = $payload["data"]["result"]["status"];
				if ($refundresult == "Succeed")
				{
					$refundresult = "Refunded";
				}

				$refundresponsecode = $payload["data"]["provider_data"]["response_code"];
				$refundescr = $payload["data"]["provider_data"]["description"];
				$refundexternalid = $payload["data"]["provider_data"]["external_id"];

				$refundfeedetails = json_encode($payload["data"]["provider_data"]["transaction_cost"]["applied_fees"]);
				
				$checkpaymentid = "SELECT payment_id FROM transactions WHERE payment_id = '$paymentid'";
				$check = $conn->query($checkpaymentid);

				if ($check->num_rows !== 0)
				{
					$updrefunddata = "UPDATE transactions SET rid = '$rid', refund_time = '$refundtime', refund_reason = '$refundreason', charge_result = '$refundresult', charge_responsecode = '$refundresponsecode',
															  charge_description = '$refundescr', charge_externalid ='$refundexternalid', charge_feedetails = '$refundfeedetails' WHERE payment_id = '$paymentid'";
					$updrfdata = $conn->query($updrefunddata);

					if ($refundresult == "Refunded")
					{
						SendWebhookRefundEmail($paymentid);
						UnsetReferralDataIfAny($paymentid);
					}
				}
				else
				{					
					$file = "../logs/webhook_errors.txt";
					$entry = ">>> Payment request was not logged for this refund -> REFUND ID: " . $paymentid . ". Please check PaymentOS account for more details.\n";
					file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
				}
			}

			/*if ($header == "event-type" && $value == "payment.refund.update")
			{
				$rawpayload = file_get_contents("php://input");
				$payload = json_decode($rawpayload, true);

				require '../backend/dbconnect_invest.php';
			}*/
		}
	}

	$conn->close();
?>