<?php 
	require_once("constants.php");
	$connection = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE); 
		if (!$connection) {
			die("mysql failed to connect" . mysqli_error());
		}

	/*
		Append $dirBaseName to view link in order to be able to send id to both view pages
		:: $dirBaseName is the basename from the current working directory. 
	*/
	$dirBaseName = basename(getcwd()) != 'php' ? 'php/' : '';

	// $selectdb = mysqli_select_db($connection, DATABASE);
	// 	if(!$selectdb){
	// 		die("database selection has failed" . mysqli_error());
	// 	}
?>