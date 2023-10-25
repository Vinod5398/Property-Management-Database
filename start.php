<!DOCTYPE html>
 <html>
	<head>
		<style>
			body 
			{
			background: url(start.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			}
		large
			{
			font-size: 40px;
			color: black;
			}
		</style>
		
		<title>PROJECT MANAGENEMT DATABASE</title>
	</head>
	<body>	
	<h1 class="large">PROJECT MANAGENEMT DATABASE</h1>
		<form action="start.php" method="post">

		<input  type="submit" name="proc" value="Procedure to calculate overall profit till date"><br>
		<input  type="submit" name="proc1" value="Procedure to calculate overall sales till date"><br>
		<input  type="submit" name="proc2" value="Procedure to calculate overall Salary of all agents"><br>
		<input type="submit" name="start" value="Login Page"><br><br><br>
		</form>
	</body>
</html>	
<?php 
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
	

	if(isset($_POST["proc"])) {
		$proc="CALL profit()";
		$result=mysqli_query($conn,$proc);
		while($row=mysqli_fetch_array($result)){
		$profit=$row["profit"];
		echo "Overall Profit Till Date:".$profit;
		}
	}
	if(isset($_POST["proc1"])) {
		$proc="CALL sales()";
		$result=mysqli_query($conn,$proc);
		while($row=mysqli_fetch_array($result)){
		$sales=$row["sales"];
		echo "Overall Sales Till Date:".$sales;
		}
	}
	if(isset($_POST["proc2"])) {
		$proc="CALL totalsal()";
		$result=mysqli_query($conn,$proc);
		while($row=mysqli_fetch_array($result)){
		$sal=$row["sal"];
		echo "Overall Salary Of All Pgents Per Month:".$sal;
		}
	}
	elseif(isset($_POST["start"])) {
		header("Location:login.html");
	}
	 
 ?>