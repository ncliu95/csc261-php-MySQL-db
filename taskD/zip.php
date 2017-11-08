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
$sql = "SELECT * FROM ZIP";
$result = $conn->query($sql);
				//echo '<script type="text/javascript">alert("hello!");</script>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>ZIP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>ZIP</h2>                                                                                   
		<div class="table-responsive">          
			<table class="table">
				<thead>
					<tr>
						<th>ZIP</th>
						<th>CITY</th>
						<th>STATE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
						if ($result->num_rows > 0) {
						// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<td>
								" . $row["zip_code"]. "</td><td>" . $row["city"] . 
								"</td><td>" . $row["state"] . "</td></tr>";
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