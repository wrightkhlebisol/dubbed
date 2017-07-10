<?php 
	session_start();
	require_once("../functions/functions.php");
	if(!isset($_SESSION["loggedIn"])){
		redirect();
	}
	require_once("../includes/connection.php");
	require_once("../includes/head1.php"); 
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
				$user_request = mysqli_query($connection, $user_query) or die("Query Couldn't be instantiated" . mysqli_error($connection));
				$user_returned = mysqli_fetch_assoc($user_request) or die("Association Failed" . mysqli_error($connection)); 
			?>

			<div id="uploaderDetails">
				<h3>Uploaded By:</h3>
				<hr>
				<br>
				<p><i class="fa fa-user"></i><?php echo " " . $user_returned["name"]; ?></p>
				<p><i class="fa fa-university"></i><?php echo " " . $user_returned["school"]; ?></p>
				<p><i class="fa fa-phone"></i><?php echo " " . $user_returned["mobile"]; ?></p>
				<p><i class="fa fa-balance-scale"></i><?php echo " " . $user_returned["points"]; ?></p>
				<br>
				<br>
				<hr>
					<h3 id="remain">
						<?php 
							if ($returned["solutions"] == 0) {
								echo "No Solutions Yet";
							}elseif ($returned["solutions"] < 5) {
								echo "Showing " . $returned["solutions"] . " of " . $returned["solutions"] . " Solution(s):";
							}else{
								echo "Showing 5 of " . $returned["solutions"] . " Solutions:";
							}
						?>
					</h3><hr>
					<ul>
						<?php 
							$solnQuery = "SELECT s.upload_time AS solnUploadTime, s.id AS solnFileId, u.name AS uploaderName ";
							$solnQuery .= "FROM users AS u INNER JOIN solution AS s ";
							$solnQuery .= "ON u.id = s.user_id ";
							$solnQuery .= "WHERE s.file_id = " . $file_id;
							$solnQuery .= " LIMIT 5";
							$solnQueryResult = mysqli_query($connection, $solnQuery);
							$totalReturnedSoln = mysqli_num_rows($solnQueryResult);
							while ($totalReturnedSoln >= 1) {
								$solnArray = mysqli_fetch_assoc($solnQueryResult);
								$id = $solnArray['solnFileId'];
							 	echo "<a href=\"view.php?fid={$id}\">" . $solnArray['uploaderName'] . ' ' . '(' . $solnArray['solnUploadTime'] . ')' . "</a>";
							 	$totalReturnedSoln--;
							}
						?>
					</ul>
					<a href="" class="remain">10 REMAINING</a>
			</div>
	</div><!--End of viewcontainer-->
			<div class="optionPanel">
				<!-- <button class="solnButton"> -->
					<?php 
					echo "<a href=\"create.php?soln&file=$file_id\">Solve This (+3pts) </a>";
					?>
				<!-- </button>
				<button class="solnButton"> -->
					<?php 
					echo "<a href=\"viewer.php?file=$file_id\">FullScreen </a>";
					?>
				<!-- </button>
				<button class="solnButton"> -->
					<?php 
					echo "<a href=\"create.php?soln&file=$file_id\">Download </a>";
					?>
				<!-- </button> -->
			</div>

		<hr>
		<br>
		<div id="moreDetail">
			<p><?php echo $returned["more_info"]; ?></p>
		</div>
<?php require_once("../includes/end.php") ?>