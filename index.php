<?php
	session_start();
	require_once("includes/connection.php");
	require_once("functions/functions.php");
	if (isset($_GET['type'])) {
		$viewType = $_GET['type'];
	}
	
	$loginMessage = "";
	if(isset($_POST['header-submit'])){ 
		if(!empty($_POST['header-email']) && !empty($_POST['header-password'])){
			$userMail = mysqli_prep($_POST['header-email']);
			$passWord = sha1($_POST['header-password']);
			$query = "SELECT id, name, email, school, mobile, area, points, course ";
			$query .= "FROM users ";
			$query .= "WHERE email = '{$userMail}' ";
			$query .= "AND hashedpassword = '{$passWord}' ";
			$query .= "LIMIT 1";
			$queryDatabase = mysqli_query($connection, $query);
			if (mysqli_num_rows($queryDatabase) == 1) {
				$userDetails = mysqli_fetch_assoc($queryDatabase);
				$_SESSION["id"] = $userDetails['id'];
				$_SESSION["username"] = $userDetails['name'];
				$_SESSION["school"] = $userDetails['school'];
				$_SESSION["email"] = $userDetails['email'];
				$_SESSION["mobile"] = $userDetails['mobile'];
				$_SESSION["loggedIn"] = true;
			}else{
				$loginMessage = "<span class=\"alertMessage\">Incorrect Details, Please review your inputs</span>";
			}
		}else{
			$loginMessage = "<span class=\"alertMessage\">Please fill in both fields</span>";
		}
	}

	$alertMessage = alertMessages();
 
	$query = "SELECT id, topic, category, upload_date, solutions ";
	$query .= "FROM file ";
	if (isset($_GET['type'])) {
		$query .= "WHERE category = {$viewType} ";
	}
	$query .= "ORDER BY id ";
	$query .= "DESC";
	$result = mysqli_query($connection, $query) or die("Query Execution Failed " . mysqli_error($connection));
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>MODUB SCRIBBLE | A gathering of intellects helping intellects </title>
	<meta name="HandheldFriendly" content="true" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
	<!--<script src="https://use.fontawesome.com/0e68ce4411.js"></script>-->
	<link rel="icon" href="images/dublogocut.png">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/scribbles.css">
	<link rel="stylesheet" type="text/css" href="css/general.css">
</head>
<body>
	<header id="generalTopRibbon">

		<a href="index.php">
			<div id="logoWrap">

				<h4 class="logo">mo'dub</h4>
			</div>
		</a><!-- End of #logoWrap -->		

			<?php echo $loginMessage; ?>
			<form id="header-login-form" method="POST" action="index.php">
				<?php 
					if(isset($_SESSION["loggedIn"])){
						echo("<br><p class=\"loginMessage\">You're logged in as " . $_SESSION["username"] . " <a href=\"php/logout.php\">Log Out</a> </p>");
					}else{	?>
						<input type="email" id="header-email" name="header-email" placeholder="E-mail" value="<?php if(isset($_POST["header-email"])){echo($_POST["header-email"]);} ?>">
						<input type="password" id="header-password" name="header-password" placeholder="Password">
						<input type="submit" id="header-submit" name="header-submit" value="Login"/>
				<?php } ?>
			</form><!-- End of form #header-login-form -->

	</header> <!-- End of header #generalTopRibbon -->	

	<section>

		<div id="leftnav">

			<a href="index.php"><i class="fa fa-home"></i>Home</a>
			<a href="index.php?type='test'"><i class="fa fa-pencil-square-o"></i>Test</a>
			<a href="index.php?type='exam'"><i class="fa fa-low-vision"></i>Exam</a>
			<a href="index.php?type='project'"><i class="fa fa-binoculars"></i>Project</a>
			<a href="index.php?type='assignment'"><i class="fa fa-signing"></i>Assignment</a>
			<a href="index.php?type='report'"><i class="fa fa-bar-chart"></i>Reports</a>
			<a href="index.php?type='material'"><i class="fa fa-bookmark"></i>Material</a>
			<a href="index.php?type='note'"><i class="fa fa-book"></i>Notes</a>
			<?php
				if(isset($_SESSION["loggedIn"])){
					echo "<p class=\"welcomeUser\">Welcome " . $_SESSION["username"] . "</p>";
				}else{
					echo "<a href=\"php/signup.php\"><i class=\"fa fa-users\"></i>Sign Up</a>";
				}

			?>
		</div> <!-- End of div#leftnav -->

		<div class="mainsection">

			<div class="horzrule"></div>

			<div class="mainsection-headline">
					<div class="mainsectionscribbleContent">
						<a href="php/create.php"><button name="create" id="create"><i class="fa fa-pencil-square-o"> </i>Create</button></a>
						<?php
							echo $alertMessage;
						?>
						
						<div class="scribblehorzrule"></div>

						<section>
							<article>
								<div class="mainsectionscribbleContent-tableColumn head"><i class="fa fa-spin fa-book"></i> Topic</div>
								<div class="mainsectionscribbleContent-tableColumn head"><i class="fa fa-spin fa-sitemap"></i> Categories</div>
								<div class="mainsectionscribbleContent-tableColumn head"><i class="fa fa-spin fa-clock-o"></i> Date Uploaded</div>
								<div class="mainsectionscribbleContent-tableColumn head"><i class="fa fa-spin fa-plus-square"></i> Solution</div>
							</article>
							<?php 
								if(!$result){
									die("the query was unsuccessful " . mysqli_error($connection));
								}else{
									$rows = mysqli_num_rows($result);
									while ($rows > 0) {
										$fields = mysqli_fetch_assoc($result);
										$id = $fields['id'];
										$topic = $fields['topic'];
										$category = $fields['category'];
										$uploadDate = $fields['upload_date'];
										$numsolu = $fields['solutions'];// total number of solutions
										echo "<article>
												<div class=\"mainsectionscribbleContent-tableColumn\"><a href=\"php/view.php?fid={$id}\">$topic</a></div>
												<div class=\"mainsectionscribbleContent-tableColumn\">$category</div>
												<div class=\"mainsectionscribbleContent-tableColumn\">$uploadDate</div>
												<div class=\"mainsectionscribbleContent-tableColumn\">$numsolu</div>
											</article>";
										$rows--;
									}
								}	
			
							?>
						</section>
					
					</div>
<?php require_once("includes/end.php") ?>			
<?php mysqli_close($connection); ?>