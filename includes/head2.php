</head>
<body>		

	<header id="generalTopRibbon">

		<div id="logoWrap">

			<h5 class="logo">mo'dub</h5>

		</div><!-- End of #logoWrap -->	

			<form id="header-login-form" action="../index.php" method="POST">
			<?php 
				if(isset($_SESSION["loggedIn"])){
					echo("You're logged in as " . $_SESSION["username"] . " <a href=\"../php/logout.php\">Log Out</a> </p>");
				}else{
			 ?>
				<input type="email" id="header-email" name="header-email" placeholder="E-mail">
				<input type="password" id="header-password" name="header-password" placeholder="Password">
				<input type="submit" id="header-submit" name="header-submit" value="Login"/>
			<?php } ?>
			</form><!-- End of form #header-login-form -->	

	</header> <!-- End of header #generalTopRibbon -->	

	<section>

		<div id="leftnav">

			<a href="../index.php"><i class="fa fa-home"></i>Home</a>
			<a href="../index.php?type='test'"><i class="fa fa-pencil-square-o"></i>Test</a>
			<a href="../index.php?type='exam'"><i class="fa fa-low-vision"></i>Exam</a>
			<a href="../index.php?type='project'"><i class="fa fa-binoculars"></i>Project</a>
			<a href="../index.php?type='assignment'"><i class="fa fa-signing"></i>Assignment</a>
			<a href="../index.php?type='report'"><i class="fa fa-bar-chart"></i>Reports</a>
			<a href="../index.php?type='material'"><i class="fa fa-bookmark"></i>Material</a>
			<a href="../index.php?type='note'"><i class="fa fa-book"></i>Notes</a>
			<?php
				if(isset($_SESSION["loggedIn"])){
					echo "<p class=\"welcomeUser\">Welcome " . $_SESSION["username"] . "</p>";
				}else{
					echo "<a href=\"signup.php\"><i class=\"fa fa-users\"></i>Sign Up</a>";
				}
			?>
		</div> <!-- End of div#leftnav -->

		<div class="mainsection">

			<div class="horzrule"></div>

			<div class="mainsection-headline">