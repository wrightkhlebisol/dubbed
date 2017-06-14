<?php
	session_start();
	if(!isset($_SESSION["loggedIn"])){
		redirect();
	} 
	require_once('../includes/connection.php');
	require_once('../includes/head1.php');
	require_once('../functions/functions.php');
	require_once('../includes/head2.php');

	$file_id = $_GET["file"];
	$query = "SELECT solutions, more_info, file_name, uploader_id FROM file WHERE id = " . $file_id;
	$result = mysqli_query($connection, $query) or die("failed to execute database query " . mysqli_error($connection));
	$returned = mysqli_fetch_assoc($result);
	define("UPLOADDIR", "../upload/");
?>

	<link rel="stylesheet" type="text/css" href="../css/viewer.css">
	<div id="viewpane">
		<object data=<?php echo(UPLOADDIR . $returned["file_name"]); ?> ></object>
	</div>

<?php 
	require_once('../includes/end.php');
?>