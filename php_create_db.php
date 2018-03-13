<?php
	// this creates a connection - 'localhost' is the servername, 'root' is both the username and password
	$connection = mysqli_connect("localhost:3306", "root", "root");

	// this checks the connection for errors
	if ($connection === false) {
		die("Failed. " . mysqli_connect_error());
	}
	
	// this is how we create the database 'CEN3031_db'
	$sql = "CREATE DATABASE CEN3031_db";

	
	// this checks the connection for errors
	if (mysqli_query($connection, $sql)) {
		echo "Success!";

	} else {
		echo "Failed. " . mysqli_error($connection);
	}

	// this closes the connection
	mysqli_close($connection);
?>

