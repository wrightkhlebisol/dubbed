<?php
	session_start(); 
	require_once("../includes/connection.php");
 	require_once("../includes/head1.php");
	require_once("../functions/functions.php");
	if(!isset($_SESSION["loggedIn"])){
		redirect();
	}
	if (isset($_GET["soln"])) {
		
	}
?>
<link rel="stylesheet" type="text/css" href="../css/create.css">
<script type="text/javascript"></script>
<?php require_once("../includes/head2.php") ?>

<div id="signupsection">
	<h1>Its as simple as A, B, C.</h1>

<?php createContent('C:\wamp\www\dubbed\upload'); ?>

	<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="signupform" enctype="multipart/form-data">

		<legend>Lil Detail About The File</legend>
						
		<div class="form-input">
			<input type="text" name="topic" placeholder="What is The Topic Of The Content" class="signupforminput" value="<?php if(isset($_POST['topic'])) echo $_POST['topic']; ?>">
		</div>

		<div class="form-input">
			<label for="filecategory">Pick A Category</label>
			<select class="signupforminput" id="filecategory" name="category">
				<option value="solution">Solution</option>
				<option value="Test">Test</option>
				<option value="Exam">Exam</option>
				<option value="Project">Project</option>
				<option value="Assignment">Assignment</option>
				<option value="Report">Report</option>
				<option value="Material">Material</option>
				<option value="Note" selected>Note</option>
			</select>
		</div>

		<label for="fileupload">Select A File</label>
		<div class="form-input" >
			<input type="file" class="signupforminput" id="fileupload" name="fileupload">
		</div>
			
		<div class="form-input">
			<label for="deadline">When do you want this request taken down</label>
			<input type="date" placeholder="When do you want this request taken down" id="deadline"
			class="signupforminput" name="deadline" value="<?php echo date("Y-m-d"); ?>">
		</div>


		<label for="mobilenumber">What's your mobile number:</label>
		<div class="form-input">
			<input type="number" placeholder="Your mobile number, so you can be contacted privately" class="signupforminput" name="mobilenumber" value="<?php echo($_SESSION["mobile"]); ?>">
		</div>

		<label for="moreinfo">More Details make people understand the question</label>
		<textarea class="signupforminput" placeholder="More info about the content" name="moreinfo"><?php if(isset($_POST['moreinfo'])) echo $_POST['moreinfo']; ?></textarea>		
		<input type="submit" value="SUBMIT" class="createbutton" name="submit">

	</form><!-- End of form #signupform -->
				
</div><!-- End of form #signupsection -->
				
<?php require_once("../includes/end.php"); ?>