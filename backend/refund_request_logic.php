<?php

    if (isset($_POST['submit_refundbutton']))
	{
        $recid = $_POST['cardholder_refundrecid'];
        $reason = $_POST['cardholder_refundreason'];

        $payid = $_POST['submit_refundbutton'];

        function createRefundData($cardholder_payid, $cardholder_recid, $cardholder_reason)
        {
            $rawdata = array(
                            "reconciliation_id"=>$cardholder_recid,
                            "refund_reason"=>$cardholder_reason
            );

            $data = json_encode($rawdata);
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://api.paymentsos.com/payments/" . $cardholder_payid . "/refunds");
            //curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "api-version: 1.3.0",
                "x-payments-os-env: test",
                "app_id: **********",
                "private_key: **********")
            );

            curl_exec($ch);

            curl_close($ch);

            header("Location: management_refund.php");
			exit();
        }

        createRefundData($payid, $recid, $reason);
    }

?>