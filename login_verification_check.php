<?php
	// this is how we will get the login data from the html login form and process it via the database - we'll store the html login data into variables
	$usernameB=$_POST['usernm'];
	$passwordB=$_POST['passwrd'];
	
	// this is the info for the server and connection credentials
	$servername = "localhost:3306";
	$username = "root";
	$password = "root";
	$databasename = "CEN3031_db";

	// this creates a connection
	$connection = new mysqli($servername, $username, $password, $databasename);
	// this checks the connection for errors
	if ($connection->connect_error) {
		die("Couldn't connect. " . $connection->connect_error);
	} else {
		echo "Connected!" . "\n";
	} 
	
	// this is how we query the database
	$sql = "SELECT userNm, pssWrd FROM userLogin";
	// this gets the result of the query
	$result = $connection->query($sql);
	
	// if the rows aren't empty, data is available to be queried
	if ($result->num_rows > 0) {
		// this is so we can grab data from the rows
		while($row = $result->fetch_assoc()) {
			// this checks the login credentials in the database
			// versus what the user entered in the login page 
			if ($row['userNm'] == $usernameB && $row['pssWrd'] == $passwordB) {
				echo "Success! Welcome to C.A.R.R.S. ".$row['username'];
				echo '<script type="text/javascript">
						     window.location = "emergencyMode.html"
						</script>';
			} else {
				echo "<script type='text/javascript'>alert('Failed.');</script>";
				echo '<script type="text/javascript">
						     window.location = "login.html"
						</script>';
			}
		}
	} else {
		echo "Failed.";
	}

?>