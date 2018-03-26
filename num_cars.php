<?php
	// CREATE CONNECTION
	$connection = mysqli_connect("localhost:3306", "root", "root", "CEN3031_db");

	// TEST CONNECTION
	if ($connection === false)
	{
		die("Failed - Connection. " . mysqli_connect_error());
	}


	// CREATE SQL QUERY
	$day1 = "2_16_2018"; //EDIT TO SPECIFIC DAY
	$day2 = "2_16_2018"; //EDIT TO SPECIFIC DAY

	$sql1 = "SELECT SUM(occOrVac) AS SUM
			FROM T1_feb_mock 
			WHERE theDate < '" . $day1 . "'"; //INCLUSIVE TO THIS DAY

	$sql2 = "SELECT SUM(occOrVac) AS SUM
			FROM T1_feb_mock 
			WHERE theDate <= '" . $day2 . "'"; //INCLUSIVE TO THIS DAY

	$result1 = mysqli_query($connection, $sql1);
	$result2 = mysqli_query($connection, $sql2);

	// SHOW RESULTS
	if ($result1 && $result2) 
	{
		$row1 = $result1->fetch_assoc();
		$row2 = $result2->fetch_assoc();

		echo ($row2['SUM'] - $row1['SUM'])."\n";
	} 
	else 
	{
		echo "Failed - SQL Query. " . mysqli_error($connection) . "\n";
	}

	// FREE RESULT
	mysqli_free_result($result1);
	mysqli_free_result($result2);

	// CLOSE CONNECTION
	mysqli_close($connection);
?>
