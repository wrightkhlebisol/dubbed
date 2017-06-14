</div><!-- End of div.mainsection-headline -->

			<div class="mainsection-snippet">

				<!-- This place is to contain 
				the conditional school panel 
				when the user is logged in -->
				<?php 
					if(isset($_SESSION["loggedIn"])){
				?>
						<div id="right-snippet-content-sales">

							<div class="right-snippet-content-sales-headline">
								<p>
									<i class="fa fa-university"></i>
									<?php 
										if(isset($_SESSION['school'])){
											echo($_SESSION['school']);
										}else{
											'School Unknown';
										}
									?>
								</p>
								<!-- Conditional School Panel ends here -->
								<b>
									<?php 
									echo "<a href=\"$dirBaseName" . "../index.php\">";
									?>
										Trending 
										<i class="fa fa-navicon"></i>
									</a>
								</b>
							</div><!-- End of div.right-snippet-content-sales-headline -->

							<div class="right-snippet-content-sales-content">
								<?php 
									$snipSchool = $_SESSION['school'];
									$query0 = "SELECT f.id AS fileId, f.topic AS topic, f.upload_date AS uploadDate, f.category AS category, u.name AS name";
									$query0 .= " FROM file AS f INNER JOIN users AS u";
									$query0 .= " ON u.id = f.uploader_id";
									$query0 .= " WHERE u.school = '$snipSchool'";
									$query0 .= " ORDER BY f.upload_date DESC";
									$query0 .= " LIMIT 5";										
									$result0 = mysqli_query($connection, $query0) or die('failed to make query' . mysqli_error($connection));
									$total = mysqli_num_rows($result0);
									while ($total > 0){
										$returned_result = mysqli_fetch_assoc($result0);
										$snipId = $returned_result['fileId'];
										$snipTopic = $returned_result['topic'];
										$snipName = $returned_result['name'];
										$snipCategory = $returned_result['category'];
										$snipUploadDate = $returned_result['uploadDate'];

										echo "<div class=\"right-snippet-content-sales-content-eachcontent\">";		
										echo "<h5><a href=\"$dirBaseName" . "view.php?fid={$snipId}\">$snipTopic</a></h5>
											<div class=\"horzrule\"></div>
											<p>$snipName</p>
											<br>
											<p>$snipCategory</p> |
											<p>$snipUploadDate</p>";
										echo "</div>";
										$total--;
									}
								?>			
							</div><!-- End of div.right-snippet-content-sales-content -->

						</div><!-- End of div#right-snippet-content-sales -->
				<?php	} 	?>

				<div id="right-snippet-content-sales">

					<div class="right-snippet-content-sales-headline">
						<p><i class="fa fa-universal-access"></i> General</p>
						<b>
							<?php 
								echo "<a href=\"$dirBaseName" . "../index.php\">";
							?>
								Trending 
								<i class="fa fa-navicon"></i>
							</a>
						</b>
					</div><!-- End of div.right-snippet-content-sales-headline -->

					<div class="right-snippet-content-sales-content">
						<?php 
							$query0 = "SELECT f.id AS fileId, f.topic AS topic, f.upload_date AS uploadDate, f.category AS category, u.name AS name";
							$query0 .= " FROM file AS f INNER JOIN users AS u";
							$query0 .= " ON u.id = f.uploader_id";
							// $query0 .= " WHERE u.school = 'university of lagos'";
							$query0 .= " ORDER BY f.upload_date DESC";
							$query0 .= " LIMIT 5";										
							$result0 = mysqli_query($connection, $query0) or die('failed to make query' . mysqli_error($connection));
							$total = mysqli_num_rows($result0);
							while ($total > 0){
								$returned_result = mysqli_fetch_assoc($result0);
								$snipId = $returned_result['fileId'];
								$snipTopic = $returned_result['topic'];
								$snipName = $returned_result['name'];
								$snipCategory = $returned_result['category'];
								$snipUploadDate = $returned_result['uploadDate'];

								echo "<div class=\"right-snippet-content-sales-content-eachcontent\">";		
								echo "<h5><a href=\"$dirBaseName" . "view.php?fid={$snipId}\">$snipTopic</a></h5>
									<div class=\"horzrule\"></div>
									<p>$snipName</p>
									<br>
									<p>$snipCategory</p> |
									<p>$snipUploadDate</p>";
								echo "</div>";
								$total--;
							}
						?>
					</div><!-- End of div.right-snippet-content-sales-content -->
					
				</div><!-- End of div#right-snippet-content-sales -->

			</div><!-- End of div.mainsection-snippet -->

		</div><!-- End of div.mainsection -->

	</section>
<?php 
	// session_unset();
?>
	<!-- // <script type="text/javascript" src="../javascript/jquery.js"></script> -->
	<!-- // <script type="text/javascript" src="../javascript/bootstrap.min.js"></script> -->
</body>
</html>