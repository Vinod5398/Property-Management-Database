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
		
	$disp = "SELECT c_id,c_name,c_address,c_phone,c_type,a_id FROM customer where c_id=$id";
	$result = mysqli_query($conn,$disp);
		
	// output data of needed row
	$row=mysqli_fetch_array($result);
		$_SESSION["uname"]=$row["c_name"];
		$_SESSION["uaddress"]=$row["c_address"];
		$_SESSION["unum"]=$row["c_phone"];
		$_SESSION["utype"]=$row["c_type"];
		
	if(isset($_POST["buy"])){
	header("Location:propertyoutput.php");
	}
	if(isset($_POST["sell"])){
	header("Location:propertyinput.php");
	}
	if(isset($_POST["alter"])){
	header("Location:update.php");
	}
	if(isset($_POST["delete"])){
		header("Location:delete.php");
	}
	if(isset($_POST["adetails"])){
	header("Location:adetails.php");
	}
		
?>
<html>
	<head>
		<style>
			body 
			{
			background: url(output.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			}
			table
			{
			border-radius: 25px;
			margin: 200px auto ;
			padding:30px;
			color: black;
			background-color: rgba(180,180,180,0.45);
			width: 375px;
			font-size:20px;
			}
			.large
			{
			font-size:25px;
			color: black;
			}
			.xlarge
			{
			font-size: 40px;
			color: black;
			}
			
		</style>
		
		<title>CustomerDetails</title>
	</head>
	
	<body>
			<table>		
				<tr><th class=xlarge><i>Customer</i></th> <th class=xlarge><i>Details</i></th></tr>
				<tr><td class=large>Customer ID</td><?php echo "<td>:".$row["c_id"]."</td>"; ?> </tr>
				<tr><td class=large>ID</td><?php echo "<td>:".$id."</td>"; ?> </tr>
				<tr><td class=large>Name</td><?php echo "<td>:".$_SESSION["uname"]."</td>"; ?> </tr>
				<tr><td class=large>Address</td><?php echo "<td>:".$_SESSION["uaddress"]."</td>"; ?> </tr>
				<tr><td class=large>Phone Number</td><?php echo "<td>:".$_SESSION["unum"]."</td>"; ?> </tr>
				<tr><td class=large>Agent ID</td><?php echo "<td>:".$row["a_id"]."</td>"; ?> </tr>
				
				<form method="post" action="output.php">	
			
					<tr><td><?php 
						if($row["c_type"]=='seller'){
						echo '<input type="submit" name="sell" value="Sell Property">';
						}
						?>
						<?php if($row["c_type"]=='buyer'){
						echo '<input type="submit" name="buy" value="Buy Property">';
						}
					?></td>							
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<td><input type="submit" name="adetails" value="View Agent Details"></tr></td>
					<tr><td><input type="submit" name="alter" value="Update your Details"></td>
					<td><input type="submit" name="delete" value="Delete your Account"> <br></tr></td>
					
				</form>
			</table>	
	</body>
</html>