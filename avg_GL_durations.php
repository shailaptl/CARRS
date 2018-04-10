<?php
	// CREATE CONNECTION
	$connection = mysqli_connect("localhost:3306", "root", "root", "CEN3031_db");

	// TEST CONNECTION
	if ($connection === false)
	{
		die("Failed1. " . mysqli_connect_error());
	}
	


	// CREATE SQL QUERY
	$sql_NS = "SELECT occOrVac
				FROM T1_feb_mock_14";


	$sql_WE = "SELECT occOrVac
			   	FROM T1_feb_mock_16";

	// RESULTS
    $result_NS 	= mysqli_query($connection, $sql_NS);
    $result_WE 	= mysqli_query($connection, $sql_WE);
    $NS_array 	= array();								// oocOrVac AS ARRAY
    $WE_array	= array();								// oocOrVac AS ARRAY 

	
	// TEST QUERY WITH CONNECTION
	if ($result_NS && $result_WE) 
	{	

		// SETS THE RESULTS AS NUMERICALLY ACCESSIBLE ARRAYS
		while ($row_NS = mysqli_fetch_assoc($result_NS))
		{
			$NS_array[] = $row_NS['occOrVac'];
		}
		while ($row_WE = mysqli_fetch_assoc($result_WE))
		{
			$WE_array[] = $row_WE['occOrVac'];
		}


		// VARIABLES FOR LOGIC
		$NS_state 				= 1;	// CURRENT STATE FOR NS
		$WE_state 				= 0;	// CURRENT STATE FOR NS
		$T_cycle  				= 0; 	// TIME OF CURRENT CYCLE
		$max_GL_NS 				= 10;   // This is the current duration value and decreases to 0, i.e. timer 
										// 	till change
		$max_GL_WE 				= 0;	// This is the current duration value and decreases to 0, i.e. timer
										// 	till change
		$num_of_GL_durations_NS = 0;	// NUMBER OF ACCUMULATED GREEN LIGHT DURATIONS
		$GL_durations_NS 		= 0;    // ACCUMULATED TIME COUNT FOR NS
		$num_of_GL_durations_WE = 0;	// NUMBER OF ACCUMULATED GREEN LIGHT DURATIONS
		$GL_durations_WE 		= 0;    // ACCUMULATED TIME COUNT FOR WE


		// ALGORITHM FOR AVG GREEN LIGHT DURATIONS
		for ($it = 0; $it < 3600; ++$it)
		{

		// at beginning of cycle...
			if ( $NS_array[$it] == 1 && $NS_state == 0 && $max_GL_NS < 30)
			{
				if ($max_GL_NS == 0)
					$max_GL_NS = 10;
				else	
					++$max_GL_NS;
			}

			if ( $WE_array[$it] == 1 && $WE_state == 0 && $max_GL_WE < 30)
			{
				if ($max_GL_WE == 0)
					$max_GL_WE = 10;
				else	
					++$max_GL_WE;
			}


		// at end of cycle...	
			++$T_cycle;
			if ($NS_state == 1)
			{
				--$max_GL_NS;
				if ($max_GL_NS == 0) 								//switched from G to R
				{
					++$num_of_GL_durations_NS;						// INCREASE TOTAL NUMBER OF GL NS DURATIONS (COUNT)
					$GL_durations_NS = $GL_durations_NS + $T_cycle;	// INCREASE TOTAL NUMBER OF GL NS DURATIONS (TIME)
					$T_cycle		 = 0;							// RESET CURRENT COUNT OF CYCLE
					$max_GL_NS 		 = 0;							// RESET THE COUNTER TO 0
					$NS_state 		 = 0;  							// SWITCH STATES
					$WE_state 		 = 1;

					if ($max_GL_WE == 0)  							// IN CASE WE ARE MOVING TO OPPOSITE LIGHT AND NO CARS PASSED, 
						$max_GL_WE = 10;							//	ADD AT LEAST 10 SEC
				}
			}
			else
			{
				--$max_GL_WE;
				if (!$max_GL_WE) 									//switched from G to R
				{
					++$num_of_GL_durations_WE;						// INCREASE TOTAL NUMBER OF GL WE DURATIONS (COUNT)
					$GL_durations_WE = $GL_durations_WE + $T_cycle;	// INCREASE TOTAL NUMBER OF GL WE DURATIONS (TIME)
					$T_cycle 		 = 0;							// RESET CURRENT COUNT OF CYCLE
					$max_GL_WE 		 = 0;							// RESET THE COUNTER TO 0
					$NS_state 		 = 1;  							// SWITCH STATES
					$WE_state 		 = 0;

					if ($max_GL_NS == 0)	 						// IN CASE WE ARE MOVING TO OPPOSITE LIGHT AND NO CARS PASSED 
						$max_GL_NS = 10;							// 	ADD AT LEAST 10 SEC
				}
			}
		} //END OF ALGORITHM


		$avg_GL_NS = $GL_durations_NS / $num_of_GL_durations_NS;
		$avg_GL_WE = $GL_durations_WE / $num_of_GL_durations_WE;

		echo "Avg. Green Light Duration (NS):                 " . $avg_GL_NS . "\n";
		echo "# Green Light Duration (NS):                    " . $num_of_GL_durations_NS . "\n";
		echo "Accumulated (in sec) Green Light Duration (NS): " . $GL_durations_NS . "\n\n";
		echo "Avg. Green Light Duration (WE):                 " . $avg_GL_WE . "\n";
		echo "# Green Light Duration (WE):                    " . $num_of_GL_durations_WE . "\n";
		echo "Accumulated (in sec) Green Light Duration (WE): " . $GL_durations_WE . "\n\n";


	    // FREE RESULTs
		mysqli_free_result($result_NS);
		mysqli_free_result($result_WE);
	} 
	else 
	{
		echo "Failed - SQL Query. " . mysqli_error($connection) . "\n";
	}
	

	// CLOSE CONNECTION
	mysqli_close($connection);
?>