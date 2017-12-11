<?php
	session_start();
	include_once 'dbconnect.php';

	$query = $DBcon->query("SELECT * FROM STATION WHERE id=".$_SESSION['selectedStation']);

	$stationRow=$query->fetch_assoc();
?>
<html>
<head>
	<title>Police Station</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2>Selected Station:</h2>         
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Zip Code</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>Captain</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							echo "
								<td>".$stationRow['zip_code']."</td>
								<td>".$stationRow['street_address']."</td>
								<td>".$stationRow['phone_number']."</td>
								<td>".$stationRow['captain_pid']."</td>
								";
						?>
					</tr>
				</tbody>
			</table>
			<br><br>
			<div class="col-md-4">  
				<button type="button" class="btn btn-primary btn-block" onclick="location.href = './personnel.php';">Personnel</button>
			</div>

			<div class="col-md-4">  
				<button type="button" class="btn btn-primary btn-block" onclick="location.href = './detainees.php';">Detainees</button>
			</div>
			<div class="col-md-4">  
				<button type="button" class="btn btn-primary btn-block" onclick="location.href = './citations.php';">Citations</button>
			</div>
		</div>
	</div>
</body>
</html>