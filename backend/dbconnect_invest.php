<?php
	$conn = new mysqli("localhost", "root", "", "testing");
	if($conn->connect_errno > 0)
	{
		die('Connection failed [' . $conn->connect_error . ']');
	}
?>