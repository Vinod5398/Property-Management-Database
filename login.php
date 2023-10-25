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
	$num=$_POST["num"]; 
	$name=$_POST["name"]; 
	
	if(strlen($num)==10){
		 
		$sel = "SELECT c_id,c_name, c_phone FROM customer";
		$result = mysqli_query($conn,$sel);

			while($row=mysqli_fetch_array($result)){
			$tname=$row['c_name'];
			$tnum=$row['c_phone']; 
			$tid=$row['c_id'];
			
			
			
			if(($tnum==$num)&&($tname==$name)){
					header("Location:output.php");
					$_SESSION["staticid"] = $tid;
					
				}
				elseif(($tnum!=$num)&&($tname!=$name)){
				}
			} 
		}
		
		elseif(strlen($num)!=10){
		echo 'Invalid number';
		}	
	}
	elseif(isset($_POST["su"])) {
		header("Location:signup.html");
	}

?>
