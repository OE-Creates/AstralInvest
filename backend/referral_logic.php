<?php

    function ReferralTotalEarned()
    {
        $uid = $_SESSION["user_id"];
    
        require 'dbconnect_invest.php';

        $referrer_total = 0;
        $getreferrerprofit = "SELECT referrer_profit FROM referrals WHERE referrer_id = '$uid'";
        $rungetref_r = $conn->query($getreferrerprofit);

        if ($rungetref_r->num_rows !== 0)
        {
            while($row = $rungetref_r->fetch_array())
            {
                $referrer_total += $row['referrer_profit'];
            }
        }

        $referree_total = 0;
        $getreferreeprofit = "SELECT referree_profit FROM referrals WHERE referree_id = '$uid'";
        $rungetref_e = $conn->query($getreferreeprofit);

        if ($rungetref_e->num_rows !== 0)
        {
            while($row = $rungetref_e->fetch_array())
            {
                $referree_total += $row['referree_profit'];
            }
        }

        $total_amount = $referrer_total + $referree_total;
        $_SESSION["user_referralearned"] = $total_amount;
        echo $total_amount;

        $conn->close();
    }

    function ReferralStatus()
    {
        $rid = $_SESSION["user_id"];

        require "dbconnect_invest.php";

        $getstatus = "SELECT referral_payoutrequest FROM users WHERE id = '$rid'";
        $rungetstatus = $conn->query($getstatus);
        $row = $rungetstatus->fetch_array();

        if ($row["referral_payoutrequest"])
        {
            echo "
                <div class='col-md-4 my-3'>
                    <p class='text-success'><b>Payout Already Requested</b></p>
                </div>
            ";
        }

        $conn->close();
    }

    function ReferralButtonDisplay()
    {
        require "../cron/values.php";

        if ($_SESSION["user_referralearned"] >= $referral_payoutmin)
        {
            $uid = $_SESSION["user_id"];

            require "dbconnect_invest.php";

            $getrefstatus = "SELECT referral_payoutrequest FROM users WHERE id = '$uid'";
            $rungetrefstatus = $conn->query($getrefstatus);
            $row = $rungetrefstatus->fetch_array();

            if ($row["referral_payoutrequest"])
            {
                echo "
                    <div class='col-md-4 mb-3'> 
                        <button type='submit' class='btn btn-dark w-100 mt-3' disabled>
                            Request Payout
                        </a>
                    </div>
                ";
            }
            else
            {
                echo "
                    <div class='col-md-4 mb-3'>
                        <form method='POST'>
                            <button type='submit' class='btn btn-dark w-100 mt-3' name='submit_requestrefpayout'>
                                Request Payout
                            </a>
                        </form>
                    </div>
                ";
            }

            $conn->close();
        }
        else
        {
            echo "
                <div class='col-md-4 mb-3'>
                    <button type='submit' class='btn btn-dark w-100 mt-3' disabled>
                        Request Payout
                    </a>
                </div>
            ";
        }
    }
    
    if (isset($_POST["submit_requestrefpayout"]))
    {
        if ($_SESSION["user_bankname"] == "" || $_SESSION["user_accountname"] == "" || $_SESSION["user_accountno"] == "" || $_SESSION["user_swfcode"] == "")
        {
            header("Location: profile.php");
            
            echo "
                <div class='alert alert-success alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                    Please fill in your Withdrawal Details
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
        else
        {
            $rid = $_SESSION["user_id"];
            $rdate = Date("Y-m-d H:i:s");

            require "dbconnect_invest.php";

            $setrefstatus = "UPDATE users SET referral_payoutrequest = 1, referral_payoutdate = '$rdate' WHERE id = '$rid'";
            if ($runsetrefstatus = $conn->query($setrefstatus))
            {
                echo "
                    <div class='alert alert-success alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                        Referral Payout Request Sent
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";

                $conn->close();
            }
            else
            {
                echo "
                    <div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                        Referral Payout Request Failed. Please contact support for further assistance
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";

                $conn->close();
            }
        }
        
    }

?>