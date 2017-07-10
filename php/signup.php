<?php
	session_start(); 
	require_once("../includes/connection.php");
	require_once("../functions/functions.php"); 
	redirectLoggedIn();
?>
<?php 
	if (isset($_POST['submit'])) {
		$email  = mysqli_prep($_POST['email']);
		$school  = mysqli_prep($_POST['school']);
		$password1  = $_POST['password1'];
		$password2  = $_POST['password2'];
		$name  = mysqli_prep($_POST['name']);
		$message = "";

		if ($password1 != $password2) { /*password1 and password2 are different?
		 								  check your password for correctness*/
			$message = "The password combination is different. Please review";
		}else{
			if (empty($email) || empty($school) || empty($password1) || empty($password2) || empty($name)) {//confirm that the none of the fields is empty
				$message = "Sorry, You have to fill all fields";
			}else{
				$password1 = sha1($password1); //sha1 encrypt then insert into database 
				$query = "INSERT INTO users(email, school, hashedpassword, name) VALUES('$email', '$school', '$password1', '$name')";
				$success = mysqli_query($connection, $query);
				if ($success) {
					$message = "You're registered. Please proceed to your e-mail to finalize the registration process";
				}else{
					// Something went wrong, what is it
					$message = "Database entry failed <br>" . mysqli_error($connection);
				}
			}	
		}
	}
?>
<?php require_once("../includes/head1.php") ?>
<link rel="stylesheet" type="text/css" href="../css/signup.css">
<?php require_once("../includes/head2.php") ?>

				<div id="signupsection">
					<?php if(!empty($message)){ echo "<h1 id=\"notice\">" . $message . "</h1>";}else{echo "<h1>Welcome Home ! You have chosen to join an Elite community. <br> Let's set you up !</h1>";} // the message stored in message variable is displayed here?>
					<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="signupform" enctype="multipart/form-data">
						<div class="form-input">
							<input type="email" placeholder="What is Your E-mail Address" class="signupforminput" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
						</div>
						<div class="form-input">
							<input type="text" placeholder="Which School are You From" class="signupforminput" name="school" id="school" value="<?php if(isset($_POST['school'])) echo $_POST['school']; ?>" required>
						</div>
						<div class="form-input">
							<input type="password" placeholder="Please Make a Secure Password" class="signupforminput" name="password1" id="password1" value="<?php if(isset($_POST['password1'])) echo $_POST['password1']; ?>" required>
						</div>
						<div class="form-input">
							<input type="password" placeholder="We hate to repeat things too, but can you please Re-enter Your Password" class="signupforminput" name="password2" id="password2" value="<?php if(isset($_POST['password2'])) echo $_POST['password2']; ?>" required>
						</div>
						<div class="form-input">
							<input type="text" placeholder="What is Your Name" class="signupforminput" name="name" id="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" required>
						</div>
						
							<input type="submit" value="BECOME ONE OF US" class="signupforminput" name="submit">
					</form><!-- End of form #signupform -->
				</div><!-- End of form #signupsection -->

<!--<?php // require_once("../includes/end.php") ?>-->