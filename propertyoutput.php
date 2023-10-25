<!DOCTYPE html>

<html>
	<head>
		<style>
			table,th,td {
			border: 1px solid black;
			background-color: rgba(180,180,180,0.25);
			text-align:center;
			border-collapse: collapse;
			}
			body 
			{
			background: url(output.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			}
			.large
			{
			color: black;
			text-align: center;
			}
			div 
			{
			margin:auto ;
			color: black;
		    text-align: center;
			}
			
			
		</style>
		
		<title>PropertyDetails</title>
	</head>
	
	<body>
			<h1 class=large><i>PropertyDetails</i></h1>
				
				<table style="width:100%">
			    <tr>
					<th>Property-ID</th>
					<th>Property-Location</th> 
					<th>Property-Type</th>
					<th>Property-Height</th>
					<th>Property-Width</th>
					<th>Property-Cost</th>
				</tr>

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
							
							$disp = "SELECT p_id,p_length,p_width,p_cost,p_type,p_location FROM property";
							$result = mysqli_query($conn,$disp);

							
							// output data of each row
							while($row=mysqli_fetch_array($result)) {
							
							echo "<tr>";
							echo "<td>".$row["p_id"]."</td>";
							echo "<td>".$row["p_location"]."</td>";
							echo "<td>".$row["p_type"]."</td>";
							echo "<td>".$row["p_length"]."</td>";
							echo "<td>".$row["p_width"]."</td>";
							echo "<td>".(1.1)*$row["p_cost"]."</td>";
							
							}
						?>
					
				</table>
				<div>
					<form action="propertyselect.php" method="post">
						<b>Enter Property-ID To Purchase:</b><br>
							<input type="text" placeholder="Please select valid ID" name="pid" ><br>
						<input type="submit" name="sub" value="Submit">
					</form>
				</div>
	</body>
</html>