<!DOCTYPE html>
<?php
	session_start();
	$pid=$_SESSION["propertyid"];
	$ppid=$_SESSION["staticid"];
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
		
		$sel = "SELECT p.p_id,p.p_cost,c.a_id,p.c_id FROM property p,customer c where p.p_id=$pid and p.c_id=c.c_id";
		$result = mysqli_query($conn,$sel);
		while($row=mysqli_fetch_array($result)){		
		$pcost=$row["p_cost"];
		$aid=$row["a_id"];
		$cid=$row["c_id"];
		}
		
	if(isset($_POST["sub"])) {
				
		if(isset($_POST["cardno"])) {
			$num=$_POST["cardno"]; 	
		}	
		if(isset($_POST["type"])) {
		$type=($_POST["type"]);
			if($type=="credit")
		$type="credit"; 
			else if($type=="debit")
		$type="debit"; 
		}
		$pcost1=(1.1)*$pcost;
		$ins = "insert into payment (py_cost,p_id,c_id,a_id,p_mode,c_no) values ('$pcost1','$pid','$cid','$aid','$type','$num')";
		if(!mysqli_query($conn,$ins)){	
		echo 'error';
		}
		else{
		header("Location:exit.html");	
		}
	
		$ins1 = "UPDATE customer SET status='sold' where c_id=$cid";
		if(!mysqli_query($conn,$ins1)){	
		echo 'done';
		}
		else{
		echo 'not done';	
		}
		$ins2 = "UPDATE customer SET status='bought' where c_id=$ppid";
		if(!mysqli_query($conn,$ins2)){	
		echo 'done';
		}
		else{
		echo 'not done';	
		}
		$del="Delete from property where p_id=$pid";
		if(!mysqli_query($conn,$del)){	
		echo 'done';
		}
		else{
		echo 'not done';	
		}
	}
		session_destroy();
	?>
<html>
	<head>
		<style>
			body 
			{
			background: url(payment.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			}
			
			table
			{
			border-radius: 25px;
			margin: 200px auto ;
			padding:30px;
			color: black;
		    text-align: left;
			background-color: rgba(180,180,180,0.45);
			width: 375px;  
			}
			
			.xlarge
			{
			font-size: 40px;
			color: black;
			}
			
			
		</style>
		
		<title>Payment</title>
	</head>
	
	<body>	
		<form action="payment.php" method="post">
			<table>
				
					<tr><th colspan="2" align="center" class="xlarge"><i>Payment Portal</i></th></tr>			 
					<tr><td>Property ID</td><td><?php echo ":".$pid;  ?></td></tr><br>
					<tr><td>Amount To Be Paid</td><td><?php echo ":".$pcost*1.1  ?></td></tr><br>
					<tr><td>Customer ID</td><td><?php echo ":".$cid;  ?></td></tr><br>
					<tr><td>Agent ID</td><td><?php echo ":".$aid;  ?></td></tr><br>
					<tr><td>Select Payment Mode</td></td>
						<td>:<input type="checkbox" name="type" value="credit">Credit Card<br>
							&nbsp;<input type="checkbox" name="type" value="debit" checked>Debit Card</tr></tr>			  
				  <tr><td class=large>Card no:</td>	
				  <td><input type="text" name="cardno" ></td> </tr>
				
				<tr><td colspan="2" align="center" > <input  type="submit" name="sub" value="submit"> </td></tr>
			</table>
			
		</form>
	</body>
</html>