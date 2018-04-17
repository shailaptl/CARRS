<?php
	// CREATE CONNECTION
	$connection = mysqli_connect("localhost:3306", "root", "root", "CEN3031_db");

	// TEST CONNECTION
	if ($connection === false)
	{
		die("Failed1. " . mysqli_connect_error());
	}
	


	// CREATE SQL QUERY
	$sql_left_lane = "SELECT occOrVac
			   	FROM T3_real_time";

	// RESULTS
    $result_left_lane 	= mysqli_query($connection, $sql_left_lane);
    $left_lane_array	= array();								// oocOrVac AS ARRAY 

	
	// TEST QUERY WITH CONNECTION
	if ($result_left_lane) 
	{	

		// SETS THE RESULTS AS NUMERICALLY ACCESSIBLE ARRAYS
		while ($row_left_lane = mysqli_fetch_assoc($result_left_lane))
		{
			$left_lane_array[] = $row_left_lane['occOrVac'];
		}


		// VARIABLES FOR LOGIC
		$left_lane_state 				= 0;	// CURRENT STATE FOR main_road
		$max_GL_left_lane 				= 0;	// This is the current duration value and decreases to 0, i.e. timer
										// 	till change
		$num_of_GL_durations_left_lane  = 0;	// NUMBER OF ACCUMULATED GREEN LIGHT durations
		$GL_durations_left_lane 		= 0;    // ACCUMULATED TIME COUNT FOR left_lane
		$timer 							= false;
		$timer_sec 						= 0;


		$max = sizeof($left_lane_array);
		// ALGORITHM FOR AVG GREEN LIGHT durations
		for ($it = 0; $it < $max; ++$it)
		{

		// at beginning of cycle...
			if ( $left_lane_array[$it] == 1 && $left_lane_state == 0 && $max_GL_left_lane < 15)
			{
				++$max_GL_left_lane;

				if ($timer == false)
				{
					$timer 	   = true;
					$timer_sec = 16;
				}
			}


		// at end of cycle...	
			if ($timer == true)
			{
				--$timer_sec;
				//echo "timer_sec: " .$timer_sec."\n";
				if($timer_sec == 0)
				{
					$left_lane_state = 1;
					$timer = false;
					$GL_durations_left_lane = $GL_durations_left_lane + $max_GL_left_lane;
					++$num_of_GL_durations_left_lane;
				}
			}
			else if ($left_lane_state == 1)
			{
				--$max_GL_left_lane;
				if ($max_GL_left_lane == 0)
				{
					$left_lane_state = 0;
				}
			}
		} //END OF ALGORITHM


		$avg_GL_left_lane = $GL_durations_left_lane / $num_of_GL_durations_left_lane;

		//echo "Avg. Green Light Duration (left_lane):                 " . round($avg_GL_left_lane,4) . "\n";
		//echo "# Green Light Duration (left_lane):                    " . $num_of_GL_durations_left_lane . "\n";
		//echo "Accumulated (in sec) Green Light Duration (left_lane): " . $GL_durations_left_lane . "\n\n";
		echo round($avg_GL_left_lane,4); 

	    // FREE RESULTs
		mysqli_free_result($result_left_lane);
	} 
	else 
	{
		echo "Failed - SQL Query. " . mysqli_error($connection) . "\n";
	}
	

	// CLOSE CONNECTION
	mysqli_close($connection);
?>