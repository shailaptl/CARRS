<?php
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
	
	// this is how we create the table in the database
	$sql = "CREATE TABLE userLogin(userNm VARCHAR(5), pssWrd VARCHAR(5) NOT NULL)";
	
	// this checks the connection for errors
	if ($connection->query($sql) === TRUE) {
		echo "Success!";
	} else {
		echo "Failed. " . $connection->error;
	}
	
	// this closes the connection
	$connection->close();
?>