<?php
	$selectedOption = $_GET["name"];
	$forLogName = (string)$selectedOption;
	$s = $_REQUEST["s"];		
		// this is the info for the server and connection credentials
		$servername = "localhost:3306";
		$username = "root";
		$password = "root";
		$databasename = "CEN3031_db";

		// this creates a connection
		$connection = new mysqli($servername, $username, $password, $databasename);
		// this checks the connection for errors
		if ($connection->connect_error) {
			die("Failed. " . $connection->connect_error);
		} 

		// this is how we query the database
		// this is how we will get the actual current time in php
		// date_default_timezone_set("America/New_York");
		// $currentTime = date("h:i:s");
		
		// example time
		$currentTime = "00:00:16";
		$logname = "T" . $forLogName . "_real_time";
		
		$sql = "UPDATE $logname SET occOrVac = '0' WHERE theTime = '$currentTime'";
		
		if ($connection->query($sql) === TRUE) {
			echo "Success!";
		} else {
			echo "Failed." . $connection->error;
		}

		

	?>