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
$sql = "SELECT * FROM PERSONNEL";
$result = $conn->query($sql);
				//echo '<script type="text/javascript">alert("hello!");</script>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>PERSONNEL</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>PERSONNEL</h2>                                                                                   
		<div class="table-responsive">          
			<table class="table">
				<thead>
					<tr>
						<th>PID</th>
						<th>SSN</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Phone Number</th>
						<th>Street Address</th>
						<th>Zip Code</th>
						<th>DOB</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Station ID</th>
						<th>Salary</th>
						<th>Rank</th>
						<th>Vacation</th>
						<th>Employee Type</th>
						<th>US Citizen</th>
						<th>Password</th>
						<th>Admin</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
						if ($result->num_rows > 0) {
						// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<td>
								" . $row["pid"]. "</td><td>" . $row["ssn"] . 
								"</td><td>" . $row["last_name"] . "</td><td>" . $row["first_name"]. "</td><td>". $row["middle_name"]. "</td><td>". $row["phone_number"]. "</td><td>". $row["street_address"]. "</td><td>". $row["zip_code"]. "</td><td>". $row["dob"]. "</td><td>". $row["start_date"]. "</td><td>". $row["end_date"]. "</td><td>". $row["station_id"]. "</td><td>". $row["salary"]. "</td><td>". $row["rank"]. "</td><td>". $row["vacation"]. "</td><td>". $row["employee_type"]. "</td><td>". $row["us_citizen"]. "</td><td>". $row["password"]. "</td><td>". $row["admin"]. "</td></tr>";
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