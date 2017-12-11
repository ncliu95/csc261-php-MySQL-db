<?php
	session_start();
	include_once 'dbconnect.php';

	$query = $DBcon->query("SELECT station_id FROM PERSONNEL WHERE pid =".$_SESSION['userSession']);
	$userRow=$query->fetch_array();

	$query = "SELECT * FROM STATION WHERE id =".$userRow['station_id'];
	$result = $DBcon->query($query);

	if (isset($_POST['select'])) {
		$_SESSION['selectedStation'] = $_POST['stationSelect'];
		//echo '<script type="text/javascript">alert('.$_SESSION['selectedStation'].');</script>';
		header("Location: station.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Station List</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>

	#custom-search-input {
		margin:0;
		margin-top: 10px;
		padding: 0;
	}

	#custom-search-input .search-query {
		padding-right: 3px;
		padding-right: 4px \9;
		padding-left: 3px;
		padding-left: 4px \9;
		/* IE7-8 doesn't have border-radius, so don't indent the padding */

		margin-bottom: 0;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}

	#custom-search-input button {
		border: 0;
		background: none;
		/** belows styles are working good */
		padding: 2px 5px;
		margin-top: 2px;
		position: relative;
		left: -28px;
		/* IE7-8 doesn't have border-radius, so don't indent the padding */
		margin-bottom: 0;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		color:#D9230F;
	}

	.search-query:focus + button {
		z-index: 3;   
	}
</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2>Police Station Selection</h2>
			<div>
				<form method="POST">
					<select name="stationSelect">
					<?php
					if ($result->num_rows>0) {
						while($row=$result->fetch_assoc()) {
							echo "
								<option value=".$row['id']."> Address: ".$row['street_address']." ".$row['zip_code']."</option>";
						}
					}
					?>
					</select>
					<button type="submit" class="btn-primary btn-def " name="select">Select</button>
				</form>
			</div>
			<br>
			<br>
			<!--<h2>Affiliated Stations</h2>         
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
					<?php
							while($row =$result->fetch_assoc()) {
								echo "
									<tr>
										<td>".$row['zip_code']."</td>
										<td>".$row['street_address']."</td>
										<td>".$row['phone)number']."</td>
										<td>".$row['captain_pid']."</td>
									</tr>
								";
							}
						
					?>
				</tbody>
			</table>-->
		</div>
	</div>

	
</body>
</html>