<?php
	session_start(); 
	require_once("../includes/connection.php");
 	require_once("../includes/head1.php");
	require_once("../functions/functions.php");
	if(!isset($_SESSION["loggedIn"])){
		redirect();
	}
?>
<link rel="stylesheet" type="text/css" href="../css/create.css">
<?php require_once("../includes/head2.php") ?>

<div id="signupsection">
	<h1>Its as simple as A, B, C.</h1>

<?php
define("PERMUPLOADDIR", 'C:\wamp\www\dubbed\upload');
if(isset($_POST['submit'])){
	$file_temp_name = $_FILES['fileupload']['tmp_name'];
	$file_error = $_FILES['fileupload']['error'];
	$file_type = $_FILES['fileupload']['type'];
	$file_size = $_FILES['fileupload']['size'];

	$topic = mysqli_prep($_POST['topic']);
	$category = mysqli_prep($_POST['category']);
	$explodedFileType = explode('/', $file_type);
	$file_name = $_FILES['fileupload']['name'] = $category . '_' . $topic . '.' . $explodedFileType[1];
	$deadline = mysqli_prep($_POST['deadline']);
	$mobile = mysqli_prep($_POST['mobilenumber']);
	$moreinfo = mysqli_prep($_POST['moreinfo']);
	$uploader = mysqli_prep($_SESSION["id"]);

		$moveResult = move_uploaded_file($file_temp_name, PERMUPLOADDIR."/".$file_name);

		if($moveResult == 1){
			$query = "INSERT INTO file(topic, category, deadline, more_info, file_name, uploader_id, file_type, file_size) VALUES ('$topic', '$category', '$deadline', '$moreinfo', '$file_name', '$uploader', '$file_type', '$file_size')";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Database insert failed " . mysqli_error($connection));
			}else{
				header("Location: ../index.php?dins=1");
			}
		}else{
			echo "<p class=\"alertMessages\">There was a problem uploading the file</p>";
		}

}
// else{
// 	echo NULL;
// }
?>
	<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="signupform" enctype="multipart/form-data">

		<legend>Lil Detail About The File</legend>
						
		<div class="form-input">
			<input type="text" name="topic" placeholder="What is The Topic Of The Content" class="signupforminput" value="<?php if(isset($_POST['topic'])) echo $_POST['topic']; ?>">
		</div>

		<div class="form-input">
			<label for="filecategory">Pick A Category</label>
			<select class="signupforminput" id="filecategory" name="category">
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