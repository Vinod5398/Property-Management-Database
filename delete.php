<?php
	session_start();
	$id=$_SESSION["staticid"];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="project";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		
$del="Delete from customer where c_id=$id";
	if(mysqli_query($conn,$del)){
		header("Location:login.html");
	}
	else{
		echo'not deleted';
	}
?>	