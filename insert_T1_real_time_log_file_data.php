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
	
	// this is how we load data from a file into the table in the database
	$sql = "LOAD DATA LOCAL INFILE '/Applications/MAMP/htdocs/T1_real_time_log.txt' 
	INTO TABLE T1_real_time 
	FIELDS TERMINATED BY ' '
	LINES TERMINATED BY '\n'";
	
	// this checks the connection for errors
	if ($connection->query($sql) === TRUE) {
		echo "Success!";
	} else {
		echo "Failed. " . $connection->error;
	}
	
	// this closes the connection
	$connection->close();
?>