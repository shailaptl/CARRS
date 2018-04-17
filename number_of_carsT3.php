<?php
//$n = $_REQUEST["n"];

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
$sql = "SELECT SUM(occOrVac) AS totalCars FROM T3_real_time";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while($totalCarsResult = $result->fetch_assoc()) {
		// we echo back the result from the query
		
		$totalCarsInt = (int)$totalCarsResult["totalCars"];		
		echo $totalCarsInt;
	}
} else {
	echo "Failed.";
}

?>

