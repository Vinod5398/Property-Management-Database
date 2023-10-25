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
	$errdisp=0;
    if(isset($_POST["sub"])) {
	
	if(isset($_POST["length"])) {
	$length=$_POST["length"]; 
	}
	
	if(isset($_POST["width"])) {
	$width=$_POST["width"]; 
	}
	
	if(isset($_POST["loc"])) {
	$loc=$_POST["loc"]; 
	}
	
	if(isset($_POST["price"])) {
	$price=$_POST["price"]; 
	}
	
	if(isset($_POST["type"])) {
	$type=($_POST["type"]);
		if($type=="vacant")
	$type="vacant"; 
		if($type=="residential")
	$type="residential";
		else if($type=="commercial")
	$type="commercial";
	}
	

	$ins1 = "INSERT INTO property(p_length,p_width,p_cost,p_type,p_location,c_id) VALUES ('$length','$width','$price','$type','$loc','$id')";
	if(!mysqli_query($conn,$ins1)){	
	$error=mysqli_error($conn);
		$errdisp=1;
		
	}
	header("Location:done.php");
	}
	
?>
<html>
	<head>
			<style>
			body 
			{
			background: url(propertyinput.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			}
			
			div 
			{
			border-radius: 25px;
			margin: 200px auto ;
			padding:30px;
			color: white;
		    text-align: center;
			background-color: rgba(180,180,180,0.75);
			width: 375px;  
			}
			.xlarge
			{
			font-size: 20px;
			color: black;
			}
			.large
			{
			color: black;
			}
			
		</style>
		
		<title>PropertyDetails</title>
	</head>
	
	<body>	
		<div>
			<h1 class=large><i>Enter Property Details</i></h1>		
		
				<form action="propertyinput.php"  method="post">
					<b class=xlarge>Enter Property Dimension:</b><br>
						<input placeholder="Length" type="text" name="length" ><br>
						<input placeholder="Width" type="text" name="width" ><br> 
					<b class=xlarge>Enter the Location of your property:</b><br>
						<input type="text" name="loc" ><br>
					<b class=xlarge>Enter Type of property:</b><br>
						<input type="radio" name="type" value="vacant">Vacant Property<br>
						<input type="radio" name="type" value="residential" checked>Residential Property<br>
						<input type="radio" name="type" value="commercial">Commercial Property   <br>
					<b class=xlarge>Enter the Price you would like to sell <br> your property for:</b><br>
						<input type="text" name="price" ><br><br>
<?php	
	if($errdisp==1)
  {
	  echo $error;
  }
  ?>
				  <input type="submit" name="sub" value="submit">
			</form>
		</div>
	</body>
</html>