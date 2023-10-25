<?php 
session_start();
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
		if(isset($_POST["pid"]))
			$pid=$_POST["pid"]; 	
	}
	
	$sel = "SELECT p_id FROM property";
	$result = mysqli_query($conn,$sel);

		while($row=mysqli_fetch_array($result)){
		$id=$row['p_id'];
			if($pid==$id){	
				$key=1;
				break;
			}
			elseif($pid!=$id){
			$key=0;
			}
			
		}
		if($key==1){
			$_SESSION["propertyid"] = $pid;
			header("Location:payment.php");
			
		}
		elseif($key==0){
		echo'invalid choice';
		}

?>