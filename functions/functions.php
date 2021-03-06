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
			return $alertMessage = "<h3 id=\"notice\"><i class=\"fa fa-ban\"></i> You're not logged in, Please log in to use the full feature</h3>";
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
				$file_extension = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
				$topic = mysqli_prep($_POST['topic']);
				$category = mysqli_prep($_POST['category']);
				$replacedTopic = trim(str_replace(' ', '_', $topic));			
				$file_name = $_FILES['fileupload']['name'] = $category.'_'.$replacedTopic.'.'.$file_extension;
				$mobile = mysqli_prep($_POST['mobilenumber']);
				$moreinfo = mysqli_prep($_POST['moreinfo']);
				$uploader = mysqli_prep($_SESSION["id"]);
					
				if (!empty($_POST['mobilenumber']) && isset($mobile)) {
					$query0 = "UPDATE users SET mobile = '$mobile' WHERE id = '$uploader'"; 
					$result0 = mysqli_query($connection, $query0) or die("Couldn't update users table ". mysqli_error($connection));
				}
				
				if (isset($file_name) && !empty($file_name)) {
					$moveResult = move_uploaded_file($file_temp_name, PERMUPLOADDIR."/".$file_name);
					if($moveResult == 1){
						$queryCreate = "INSERT INTO file(topic, category, more_info, file_name, uploader_id, file_type, file_size)"; 
						$queryCreate .= " VALUES ('$topic', '$category', '$moreinfo', '$file_name', '$uploader', '$file_extension', '$file_size')";
						if(isset($_GET['soln'])){
							$fileId = $_GET["file"];
							$userId = $_SESSION["id"];
							$querySoln = "INSERT INTO solution(file_id, user_id, file_name) ";
							$querySoln .= "VALUES ($fileId, $userId, '$file_name')";
							$resultSoln = mysqli_query($connection, $querySoln);
							if (!$resultSoln) {
								die("Database insert failed " . mysqli_error($connection));
							}else{
								$queryTotalPoint = "SELECT points ";
								$queryTotalPoint .= "FROM users ";
								$queryTotalPoint .= "WHERE id = $uploader";
								$queryTotalPointQuery = mysqli_query($connection, $queryTotalPoint);
								$queryTotalPointResult = mysqli_fetch_assoc($queryTotalPointQuery);
								$newUserPoints = $queryTotalPointResult['points'] + 3;
								$queryTotalPointInsert = "UPDATE users ";
								$queryTotalPointInsert .= "SET points = $newUserPoints ";
								$queryTotalPointInsert .= "WHERE id = $uploader";
								$totalPointInsertResult = mysqli_query($connection, $queryTotalPointInsert);
								if(!$totalPointInsertResult){
									die("Couldn't Add Points " . mysqli_error($connection));
								}else{
									$totalSolnQuery = "SELECT * ";
									$totalSolnQuery .= "FROM solution ";
									$totalSolnQuery .= "WHERE file_id = $fileId";
									$totalSoln = mysqli_num_rows($totalSolnResult = mysqli_query($connection, $totalSolnQuery));
									$queryUpdateTotalSoln = "UPDATE file ";
									$queryUpdateTotalSoln .= "SET solutions = $totalSoln ";
									$queryUpdateTotalSoln .= "WHERE id = $fileId";
									$updateTotalSolnResult = mysqli_query($connection, $queryUpdateTotalSoln);
									if(!$updateTotalSolnResult){
										die("Couldn't update solutions " . mysqli_error($connection));
									}
								}
								
							}							
						}
						$resultCreate = mysqli_query($connection, $queryCreate);
						if (!$resultCreate) {
							die("Database insert failed " . mysqli_error($connection));
						}else{
							// header("Location: ../index.php?dins=1");
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

	// function viewByType($_GET['type']){
	// }

?>