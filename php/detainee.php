<?php 
$servername="localhost";
$username="root";
$password="Shuntensatsu1990*";
$dbname = "nliu9";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
			//$conn->close(); 
$sql = "SELECT * FROM DETAINEE";
$result = $conn->query($sql);
				//echo '<script type="text/javascript">alert("hello!");</script>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>DETAINEE</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>DETAINEE</h2>
		<p>Detaining PID left NULL due to mock data constraints</p>                                                                                   
		<div class="table-responsive">          
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>DOB</th>
						<th>Street Address</th>
						<th>Zip Code</th>
						<th>Phone Number</th>
						<th>Detaining PID</th>
						<th>Bail</th>
						<th>Station ID</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
						if ($result->num_rows > 0) {
						// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<td>
								" . $row["id"]. "</td><td>" . $row["last_name"] . 
								"</td><td>" . $row["first_name"] . "</td><td>" . $row["dob"] . "</td><td>" . $row["street_address"] . "</td><td>" . $row["zip_code"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["detaining_pid"] . "</td><td>" . $row["bail"] . "</td><td>" . $row["station_id"] . "</td></tr>";
							}
						} else {
							echo "0 results";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
		$conn->close();

		?>
	</body>
	</html>
	$conn->close();

?>