<!DOCTYPE html>
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
		
		$disp = "SELECT a.a_id,a.a_name,a.a_address,a.a_phone,b.b_name,b.b_phone FROM agent a,customer c,branch b  where c.c_id=$id and a.a_id=c.a_id and a.b_id=b.b_id";
		$result = mysqli_query($conn,$disp);
	
		// output data of needed row
		$row=mysqli_fetch_array($result);

 ?>
<html>
	<head>
		<style>
			body 
			{
			background: url(details.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			}
			table
			{
			border-radius: 25px;
			margin: 200px auto ;
			padding:30px;
			color:black;
		    text-align: left;
			background-color: rgba(180,180,180,0.75);
			width: 375px;  
			}		
			.xlarge
			{
			font-size: 40px;
			color: black;
			}
		</style>
		
		<title>AgentDetails</title>
	</head>
	
	<body>	
		
		<table>
				<tr><th colspan="2" align="center" class=xlarge><i>Agent Details</i></th></tr>
				<tr><th>Agent ID<?php echo "<td>:".$row["a_id"]."</td>"; ?></tr>
				<tr><th>Agent Name<?php echo "<td>:".$row["a_name"]."</td>"; ?></tr>
				<tr><th>Agent Address<?php echo "<td>:".$row["a_address"]."</td>"; ?></tr>
				<tr><th>Agent Phone Number<?php echo "<td>:".$row["a_phone"]."</td>"; ?></tr>
				<tr><th>Branch Address<?php echo "<td>:".$row["b_name"]."</td>"; ?></tr>
				<tr><th>Branch Phone Number<?php echo "<td>:".$row["b_phone"]."</td>"; ?></tr>
		</table>

	</body>
</html>	