<!DOCTYPE html>
<?php 
	session_start();
	$id=$_SESSION["staticid"];
	$type=$_SESSION["utype"];
	$address=$_SESSION["uaddress"];
	$name=$_SESSION["uname"];
	$num=$_SESSION["unum"];
    
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
	if(isset($_POST["sub"])) {
		
		if(isset($_POST["name"])) {
		$name=$_POST["name"]; 
		}
		
		if(isset($_POST["address"])) {
		$address=$_POST["address"]; 
		}
		
		if(isset($_POST["num"])) {
		$num=$_POST["num"]; 
		}		
		
		if(isset($_POST["type"])) {
		$type=($_POST["type"]);
			if($type=="seller")
		$type="seller"; 
			else if($type=="buyer")
		$type="buyer"; 
		}
	
	if(strlen($num)==10){
		$update = "UPDATE customer SET c_name='$name',c_address='$address',c_phone='$num',c_type='$type' where c_id=$id";	
		if(strlen($num)==10){
			if(!mysqli_query($conn,$update)){	
			echo 'not updated';
			}
			else{
			header("Location:login.html");
			}
		}
	}
	else{
		echo 'Invalid number';
	}
	}
	
?>
<html>
	<head>
		<style>
			body 
			{
			background: url(signup.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
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
			font-size: 40px;
			color: black;
			}
			
			.large
			{
			color: black;
			}
		</style>
		
		<title>Update Details</title>
	</head>
	
	<body>	
        <div>
		<h1 class=xlarge ><i>Update Details</i></h1>		
			
			<form action="update.php" method="post">
				<b class=large>Enter your Name:</b><br>
					<input type="text" name="name" placeholder="<?php echo $name; ?>" ><br>
				<b class=large>Enter your Address:</b><br>
					<input type="text" name="address" placeholder="<?php echo $address; ?>"><br>
				<b class=large>Enter your Phone Number:</b><br>
					<input type="text" name="num" placeholder="<?php echo $num; ?>"><br>
				<b class=large>Would u like to buy or sell property:</b><br>
					<input type="radio" name="type" value="seller"> Sell existing property<br>
					<input type="radio" name="type" value="buyer" > Purchase property<br>
	
				<input type="submit" name="sub" value="submit">
			</form>
		
		</div>
	</body>
</html>
 