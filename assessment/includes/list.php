<?php
	include_once 'connect.php';

	$first_val = $_POST['firstname'];
	$last_val = $_POST['lastname'];
	$email_val = $_POST['email'];
	$address = $_POST['find'];

	$sql = "INSERT INTO formdata (first_name, last_name, email, address) VALUES ('$first_val', '$last_val', '$email_val', '$address')";

	mysqli_query($connect, $sql);

	header("Location: ../index.php?submit=success");

?>