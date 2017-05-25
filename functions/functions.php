<?php

	function logoutFunc(){
		session_start();
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 42000, '/');
		}
		session_destroy();
		header("Location: ../index.php?lo=1");
	} 

	function mysqli_prep($value){
		global $connection;
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysqli_real_escape_string"); // i.e. PHP >= v4.3.0
		if ($new_enough_php) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if($magic_quotes_active){ 
				$value = stripslashes($value);
			}
			$value = mysqli_real_escape_string($connection, $value);
		}else{ // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if(!$magic_quotes_active){
				$value = addslashes($value);
			}
			//if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function authenticate(){
	 	if(!empty($message)){ 
 			echo "<h1 id=\"notice\">" . $message . "</h1>";
 		}else{
 			echo "<h1>Welcome Home ! You have chosen to join an Elite community. <br> Let's set you up !</h1>";
 		}
	}

	// function redirects you if you're logged in and tryna signup 
	function redirectLoggedIn($redirectLocation = "../index.php"){
		if (isset($_SESSION["loggedIn"])){ // checks to see if session variable isloggedin is set
	 		header("Location: " . $redirectLocation);
	 		exit();
	 	}
	}

	function redirect(){
		header("Location: ../index.php?yanli"); // YANLI = you're not logged in
	}

	function alertMessages(){
		if (isset($_GET["yanli"])) {
			return $alertMessage = "<h3 id=\"notice\"><i class=\"fa fa-ban\"></i> You're not logged in jo <i class=\"fa fa-meh-o\"></i>, Please log in to use the full feature</h3>";
		}

		if (isset($_GET["lo"])) {
			return $alertMessage = "<h3 id=\"notice\"><i class=\"fa fa-info-circle\"></i> You are logged out, Log in to get the full feature</h3>";
		}

		if (isset($_GET["dins"])) {
			return $alertMessage = "<h3 id=\"notice\"><i class=\"fa fa-info-circle\"></i> Thank you for creating, your content has been uploaded</h3>";
		}
	}

	function isItSet($input){
		if(isset($input)){
			echo $input;
		}
	}

	function createContent($uploadlocation){
		global $connection;
		define("PERMUPLOADDIR", $uploadlocation);
		if(isset($_POST['submit'])){
			if (!empty($_FILES['fileupload']) && !empty($_POST['topic']) && isset($_POST['topic'])) {
				$file_temp_name = $_FILES['fileupload']['tmp_name'];
				$file_error = $_FILES['fileupload']['error'];
				$file_type = $_FILES['fileupload']['type'];
				$file_size = $_FILES['fileupload']['size'];
				

				$topic = mysqli_prep($_POST['topic']);
				$category = mysqli_prep($_POST['category']);
				$explodedFileType = explode('/', $file_type);
				if (array_key_exists(1, $explodedFileType)) {			
					$file_name = $_FILES['fileupload']['name'] = $category . '_' . $topic . '.' . $explodedFileType[1];
				}
				$deadline = mysqli_prep($_POST['deadline']);
				$mobile = mysqli_prep($_POST['mobilenumber']);
				$moreinfo = mysqli_prep($_POST['moreinfo']);
				$uploader = mysqli_prep($_SESSION["id"]);
				
				if (!empty($_POST['mobilenumber']) && isset($mobile)) {
					$query0 = "UPDATE users SET mobile = '$mobile' WHERE id = '$uploader'"; 
					$result0 = mysqli_query($connection, $query0) or die("Couldn't update users table ". mysqli_error($connection));
				}
				
				if (isset($file_name)) {
					$moveResult = move_uploaded_file($file_temp_name, PERMUPLOADDIR."/".$file_name);
					if($moveResult == 1){
						$query1 = "INSERT INTO file(topic, category, deadline, more_info, file_name, uploader_id, file_type, file_size)"; 
						$query1 .= " VALUES ('$topic', '$category', '$deadline', '$moreinfo', '$file_name', '$uploader', '$file_type', '$file_size')";
						$result1 = mysqli_query($connection, $query1);
						if (!$result1) {
							die("Database insert failed " . mysqli_error($connection));
						}else{
							header("Location: ../index.php?dins=1");
						}
					}else{
						echo "<p class=\"alertMessages\">There was a problem uploading the file</p>";
					}
				}else{
					echo "<p class=\"alertMessages\">Please pick a File</p>";
				}	
			}else{
				echo "<p class=\"alertMessages\">Some fields are empty</p>";
			}
		}
	} 

?>