<?php
	session_start();
	require_once("../functions/functions.php");	
	if(!isset($_SESSION["loggedIn"])){
		redirect();
	} 
	require_once("../includes/connection.php");
 	require_once("../includes/head1.php");
?>
<link rel="stylesheet" type="text/css" href="../css/create.css">
<script type="text/javascript"></script>
<?php require_once("../includes/head2.php") ?>

<div id="signupsection">
	<h1>Its as simple as A, B, C.</h1>

<?php createContent('C:\xampp\htdocs\dubbed\upload'); ?>

	<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="signupform" enctype="multipart/form-data">

		<legend>Lil Detail About The File</legend>
						
		<div class="form-input">
			<input type="text" name="topic" placeholder="What is The Topic Of The Content" class="signupforminput" value="<?php if(isset($_POST['topic'])) echo $_POST['topic']; ?>" required>
		</div>

		<div class="form-input">
			<label for="filecategory">Pick A Category</label>
			<select class="signupforminput" id="filecategory" name="category" required>
				<?php
					if (isset($_GET['soln'])) {
						echo "<option value=\"solution\" selected>Solution</option>";
					}else{
				?>
				<option value="Test">Test</option>
				<option value="Exam">Exam</option>
				<option value="Project">Project</option>
				<option value="Assignment">Assignment</option>
				<option value="Report">Report</option>
				<option value="Material">Material</option>
				<option value="Note" <?php if(!isset($_GET['soln'])){echo "selected"; } else{ echo "";}?>>Note</option>
				<?php } ?>
			</select>
		</div>

		<div class="form-input" >
			<label for="fileupload">Select A File</label><br>
			<input type="file" class="signupforminput" id="fileupload" name="fileupload" required>
		</div>
			
		<div class="form-input">
			<label for="mobilenumber">What's your mobile number:</label>
			<input type="number" id="mobilenumber" placeholder="Your mobile number, so you can be contacted privately" class="signupforminput" name="mobilenumber" value="<?php echo($_SESSION["mobile"]); ?>">
		</div>

		<div>
			<label for="moreinfo">More Details make people understand the question</label>
			<textarea class="signupforminput" id="moreinfo" placeholder="More info about the content" name="moreinfo"><?php if(isset($_POST['moreinfo'])) echo $_POST['moreinfo']; ?></textarea>		
		</div>
		<input type="submit" value="SUBMIT" class="createbutton" name="submit">

	</form><!-- End of form #signupform -->
				
</div><!-- End of form #signupsection -->
				
<?php require_once("../includes/end.php"); ?>