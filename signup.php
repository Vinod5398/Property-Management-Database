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
	}

	//procedure to make sure agent and customer are from same location else customer is assigned to universal agent
	$dis= "SELECT a_id,a_address FROM agent ";
	$id=mysqli_query($conn,$dis);
	
		while($row=mysqli_fetch_array($id)) {
			if($address==$row["a_address"]){
				$aid=$row["a_id"];	
			break;
			}
			else{
			$aid=0;
			}
		}

		
	$ins = "INSERT INTO customer(c_name,c_address,c_phone,c_type,a_id) VALUES ('$name','$address','$num','$type','$aid')";	
	if(strlen($num)==10){
		if(!mysqli_query($conn,$ins)){	
		echo 'not inserted';
		}
		else{
		header("Location:login.html");
		}
	}
	
		elseif(strlen($num)!=10){
		echo 'Invalid number';
}	
	
?>