<?php 
	require_once("constants.php");
	$connection = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE); 
		if (!$connection) {
			die("mysql failed to connect" . mysqli_error());
		}

	// $selectdb = mysqli_select_db($connection, DATABASE);
	// 	if(!$selectdb){
	// 		die("database selection has failed" . mysqli_error());
	// 	}
?>