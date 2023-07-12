<?php

    if (isset($_POST['submit_paybutton']))
	{
        if ($_SESSION["user_paybanstatus"] == 0)
        {
            $id = $_SESSION["user_id"];
            $name = $_SESSION["user_name"];

            $name_parts = explode(" ", $name);
            $fname = $name_parts[0];
            $sname = end(explode(" ", $name));

            $email = $_SESSION["user_email"];
            $reason = $_POST['cardholder_reason'];

            $nofarms = $_POST['cardholder_nooffarms'];
            $amount = $_POST['cardholder_amount'];

            function createChargeData($card_paymentid)
            {
                $permitted_chars = '0123456789';
                $code = substr(str_shuffle($permitted_chars), 0, 8);

                $rawdata = array(
                    "merchant_site_url"=>"https://www.example.com",
                    "payment_method"=>array(
                                    "source_type"=>"payment_page",
                                    "type"=>"untokenized",
                                    "additional_details"=>array(
                                        "supported_payment_methods"=>"CREDITCARD,MOBILE_BANKING")
                                    ),                                
                    "reconciliation_id"=>$code
                );

                $data = json_encode($rawdata);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://api.paymentsos.com/payments/" . $card_paymentid . "/charges");
                //curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json",
                    "api-version: 1.3.0",
                    "x-payments-os-env: live",
                    "app_id: **********",
                    "private_key: **********")
                );

                $server_response = json_decode(curl_exec($ch), true);

                curl_close($ch);

                $redirect_url = $server_response["redirection"]["url"];
                header("Location: " . $redirect_url);
            }

            function createPaymentData($cardholder_id, $cardholder_fname, $cardholder_sname, $cardholder_nooffarms, $cardholder_amount, $cardholder_reason, $cardholder_email)
            {
                $rawdata = array(
                                "amount"=>(int)$cardholder_amount,
                                "currency"=>"USD",
                                "statement_soft_descriptor"=>$cardholder_reason,
                                "additional_details"=>array(
                                                            "account_id"=>$cardholder_id,
                                                            "no_of_farms"=>$cardholder_nooffarms),
                                "billing_address"=>array(
                                                        "email"=>$cardholder_email,
                                                        "first_name"=>$cardholder_fname,
                                                        "last_name"=>$cardholder_sname)
                );

                $data = json_encode($rawdata);
                
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://api.paymentsos.com/payments");
                //curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json",
                    "api-version: 1.3.0",
                    "x-payments-os-env: live",
                    "app_id: **********",
                    "private_key: **********")
                );

                $server_response = json_decode(curl_exec($ch), true);

                curl_close($ch);

                $card_paymentid = $server_response["id"];

                createChargeData($card_paymentid);
            }

            createPaymentData($id, $fname, $sname, $nofarms, $amount, $reason, $email);
        }
        else
        {
            echo "
                <div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                    Your account is currently banned from making payments. Please contact support for further assistance
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
    }

?>