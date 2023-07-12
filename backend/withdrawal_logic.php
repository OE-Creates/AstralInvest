<?php

    function DisplayWithdrawalList()
    {
        require '../cron/values.php';

        $uid = $_SESSION["user_id"];

        require 'dbconnect_invest.php';

        $getlist = "SELECT * FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND roi_monthsinvested > 3 AND payment_descriptor LIKE '%Contribution Plan%'";
        $get = $conn->query($getlist);

        while ($row = $get->fetch_array())
        {
            echo "
                <tr>
                    <td>" . $row['payment_descriptor'] . "</td>
                    <td>" . substr($row['charge_time'], 0, 19) . "</td>
                    <td>" . $row['charge_nooffarms'] . "</td>
                    <td>" . $row['charge_amount'] . "</td>
                    <td>" . $row['roi_monthsinvested'] . "</td>
                    <td>" . $row['roi_totalreturn'] . "</td>";
                if ($row['roi_payoutrequested'] == 0 && $row['roi_payoutpaid'] == 0)
                {
                    echo "
                        <td><form method='POST'><button type='submit' class='btn btn-sm btn-warning py-0' name='submit_requestpayout' value='" . $row['id'] . "'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
                            <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
                            <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
                        </svg>
                        </button></form></td>";
                }
                else if ($row['roi_payoutrequested'] == 1 && $row['roi_payoutpaid'] == 0)
                {
                    echo "
                        <td><button type='button' class='btn btn-sm btn-info py-0'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock-history' viewBox='0 0 16 16'>
                            <path d='M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z'/>
                            <path d='M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z'/>
                            <path d='M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z'/>
                        </svg>
                        </button></td>";
                }
                else if ($row['roi_payoutpaid'] == 1)
                {
                    echo "
                        <td><button type='button' class='btn btn-sm btn-dark py-0'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-hand-thumbs-up-fill' viewBox='0 0 16 16'>
                            <path d='M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z'/>
                        </svg>
                        </button></td>";
                }
            echo "
                </tr>
            ";
        }
        
        $conn->close();

    }

    if (isset($_POST['submit_requestpayout']))
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
            require 'dbconnect_invest.php';

            $recordid = $conn->real_escape_string($_POST['submit_requestpayout']);
			$payrequesttime = date("Y-m-d H:i:s");

            $updrecord = "UPDATE transactions SET roi_payoutrequested = 1, roi_payoutrequestdate = '$payrequesttime' WHERE id = '$recordid'";
            $update = $conn->query($updrecord);

            $conn->close();
        }
    }
?>