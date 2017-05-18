<?php 
	session_start();
	require_once("../includes/connection.php");
	require_once("../includes/head1.php");
	require_once("../functions/functions.php");
	if(!isset($_SESSION["loggedIn"])){
		redirect();
	} 
?>
<link rel="stylesheet" type="text/css" href="../css/view.css">
<?php 

	require_once("../includes/head2.php"); 

	$file_id = $_GET["fid"];
	$query = "SELECT solutions, more_info, file_name, uploader_id FROM file WHERE id = " . $file_id;
	$result = mysqli_query($connection, $query) or die("failed to execute database query " . mysqli_error($connection));
	$returned = mysqli_fetch_assoc($result);
	define("UPLOADDIR", "../upload/");
	// type="application/pdf"
?>
				<div id="viewcontainer">
					<div id="viewpane">
						<object data=<?php echo(UPLOADDIR . $returned["file_name"]); ?> >
							
						</object>
					</div><!-- End of viewpane -->
					<?php 
						$user_query = "SELECT * FROM users WHERE id = " . $returned["uploader_id"];
						$user_request = mysqli_query($connection, $user_query) or die("Query Couldn't be instantiated");
						$user_returned = mysqli_fetch_assoc($user_request) or die("Association Failed" . mysqli_error()); 
					?>

					<div id="uploaderDetails">
						<h3>Uploaded By:</h3>
						<hr>
						<br>
						<p><i class="fa fa-user"></i><?php echo " " . $user_returned["name"]; ?></p>
						<p><i class="fa fa-university"></i><?php echo " " . $user_returned["school"]; ?></p>
						<p><i class="fa fa-phone"></i><?php echo " " . $user_returned["mobile"]; ?></p>
						<br>
						<br>
						<hr>
							<h3 id="remain">Showing 5 of <?php echo $returned["solutions"]; ?> Solutions:</h3><hr>
							<ul>
								<a href="">Tolu (Sept 5, 2016; 3:50pm)</a>
								<a href="">Seyi (Sept 5, 2016; 3:50pm)</a>
								<a href="">Azeez (Sept 5, 2016; 3:50pm)</a>
								<a href="">Faith (Sept 5, 2016; 3:50pm)</a>
								<a href="">Bisoye (Sept 5, 2016; 3:50pm)</a><hr>
							</ul>
							<a href="" class="remain">10 REMAINING</a>
					</div>
				</div>
				<hr>
				<br>
				<div id="moreDetail">
					<p><?php echo $returned["more_info"]; ?></p>
				</div>
<?php require_once("../includes/end.php") ?>