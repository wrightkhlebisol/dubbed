<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$q = "SELECT * FROM sendfile WHERE recipient = $id";
	$query = mysqli_query($dbc, $q);
	list($name, $type, $size, $content) = mysqli_fetch_array($query);
	header("Content-length: $size");
	header("Content-type: $type");
	header("Content-Disposition: attachment; filename=$name");
}
?>