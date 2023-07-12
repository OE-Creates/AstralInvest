<?php
	//echo "loggedin_logic_script loaded successfully";
	
	if (isset($_SESSION["user_id"]))
	{
		$uid = $_SESSION["user_id"];
	}
	else
	{
		session_unset();
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	require 'dbconnect_invest.php';

	$getsql = "SELECT loggedin_status FROM users WHERE id = $uid";
	$getstatus=$conn->query($getsql);
	$row = $getstatus->fetch_array();

	if ($getstatus->num_rows === 0 || $row['loggedin_status'] != 1)
	{
		$setsql = "UPDATE users SET loggedin_status = 0 WHERE id = $uid";
		$setstatus=$conn->query($setsql);

		$conn->close();

		session_unset();
		session_destroy();
		header("Location: login.php");
		exit();
	}
	else
	{
		if ($_SESSION["user_verifystatus"] != 1 && $_SERVER['REQUEST_URI'] != "/pages/verifyaccount.php")
		{
			$conn->close();

			header("Location: verifyaccount.php");
			exit();
		}
		
		if ($_SESSION["user_verifystatus"] != 0 && $_SERVER['REQUEST_URI'] == "/pages/verifyaccount.php")
		{
			$conn->close();

			header("Location: dashboard.php");
			exit();
		}
	}

	function DisplayManagementButton()
	{
		if ($_SESSION["user_level"] == 1)
		{
			echo "
				<a class='btn btn-sm btn-primary me-2' href='management.php' role='button'>
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-person' viewBox='0 0 16 16'>
						<path d='M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z'/>
						<path d='M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>
					</svg>
					Management
				</a>
			";
		}
	}

	function DisplayProfileImage()
	{
		if (isset($_SESSION["user_profileimg"]) && $_SESSION["user_profileimg"] != "")
		{
			$profileimgpath = $_SESSION["user_profileimg"];
			echo "
				<img src='" . $profileimgpath . "' alt='profile_image' class='mb-2 mx-auto' style='width: 145px; height: 145px; border-radius: 100%;'/>
			";
		}
		else
		{
			echo "
				<svg xmlns='http://www.w3.org/2000/svg' width='145' fill='currentColor' class='bi bi-person-circle mb-2 mx-auto' viewBox='0 0 16 16'>
					<path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z'/>
					<path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z'/>
				</svg>
			";
		}
	}
	
?>