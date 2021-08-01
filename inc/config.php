<?php 
	$servername = "localhost";
	$username = "webdesign_754";
	$password = "adI3cdRdfw0A";
	$dbname = "zazzle_rest_api";

	// $servername = "localhost";
	// $username = "root";
	// $password = "DanIsGreat";
	// $dbname = "zazzle_rest_api";

		// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} else {
		// echo "Successful Connection To Database!";
	}


	
?>
