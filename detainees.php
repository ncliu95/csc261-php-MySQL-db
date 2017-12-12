<?php
	session_start();
	include_once 'dbconnect.php';

	$query = "SELECT * FROM DETAINEE WHERE station_id=".$_SESSION['selectedStation'];
	$results = $DBcon->query($query);

	if (isset($_POST['releaseButton'])) {
		$releaseQuery = "DELETE FROM DETAINEE WHERE id=".$_POST['releaseButton'];
		$result = $DBcon->query($releaseQuery);
	}

	if (isset($_POST['modifyButton'])) {
		$_SESSION['didTemp'] = $_POST['modifyButton'];
		//echo "hello ". $_SESSION['didTemp'];
		$modifyQuery = $DBcon->query("SELECT * FROM DETAINEE WHERE id=".$_POST['modifyButton']);
		$modresults = $modifyQuery->fetch_assoc();
	}

	if (isset($_POST['search'])) {
		if($_POST['attribute'] == "fname") {
			$searchItem = $_POST['query'];
			$query = $DBcon->query("SELECT * FROM DETAINEE WHERE (station_id=".$_SESSION['selectedStation']." AND first_name ='".$searchItem."')");
		} else if ($_POST['attribute'] == "lname"){
			$searchItem = $_POST['query'];
			$query = $DBcon->query("SELECT * FROM DETAINEE WHERE (station_id=".$_SESSION['selectedStation']." AND last_name ='".$searchItem."')");
		} else if ($_POST['attribute'] == "dob"){
			$searchItem = $_POST['query'];
			$query = $DBcon->query("SELECT * FROM DETAINEE WHERE (station_id=".$_SESSION['selectedStation']." AND dob ='".$searchItem."')");
		}
		//echo $query;

	}

	if (isset($_POST['addButton'])) {
		if (!empty($_POST['addfname']) && !empty($_POST['addlname']) && !empty($_POST['addaddress']) && !empty($_POST['addzip']) && !empty($_POST['adddob']) && !empty($_POST['addbail']) && !empty($_POST['addphone']) && !empty($_POST['addpid'])) {
			$insertQuery = "INSERT INTO DETAINEE (first_name, last_name, dob, street_address, zip_code, phone_number, detaining_pid, bail, station_id) 
			VALUES ('".$_POST['addfname']."','".$_POST['addlname']."','".$_POST['adddob']."','".$_POST['addaddress']."',".$_POST['addzip'].",".$_POST['addphone'].",".$_POST['addpid'].",".$_POST['addbail'].",".$_SESSION['selectedStation'].");";
			//echo $insertQuery;
			if ($DBcon->query($insertQuery)===TRUE) {
				echo "Detainee Added";
			} else {
				echo "Error: ".$DBcon->error;
			}
		}
	}

	if (isset($_POST['applyMod'])) {
		//echo "button pressed";
		if (!empty($_POST['modfname'])) {
			$modifyQuery = "UPDATE DETAINEE SET first_name='".$_POST['modfname']."' WHERE id =".$_SESSION['didTemp'];
			$DBcon->query($modifyQuery);
			//echo $modifyQuery;
			echo $DBcon->error;
		}
		if (!empty($_POST['modlname'])) {
			$modifyQuery = "UPDATE DETAINEE SET last_name='".$_POST['modlname']."' WHERE id =".$_SESSION['didTemp'];
			$DBcon->query($modifyQuery);
			//echo $DBcon->error;
		}
		if (!empty($_POST['modbail'])) {
			$modifyQuery = "UPDATE DETAINEE SET bail='".$_POST['modbail']."' WHERE id =".$_SESSION['didTemp'];
			$DBcon->query($modifyQuery);
			//echo $DBcon->error;
		}
		if (!empty($_POST['moddob'])) {
			$modifyQuery = "UPDATE DETAINEE SET dob='".$_POST['moddob']."' WHERE id =".$_SESSION['didTemp'];
			$DBcon->query($modifyQuery);
			//echo $DBcon->error;
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Detainee List</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<a href="station.php">Return to Station</a>
		<div class="row">
			<h2>Detainee List</h2> 
			<div class="col-md-2">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Detainee</button>
			</div>
			<form method="POST">
				<div class="col-md-3">
					<select class="form-control" name="attribute" id="attribute">
						<option value="fname">First Name</option>
						<option value="lname">Last Name</option>
						<option value="dob">Date of Birth</option>
					</select>
				</div>
				<div class="form-group col-md-6">
						<input type="text" class="form-control" placeholder="search..." name="query">
				</div>
				<div class="col-md-1">
					<button type="submit" class="btn-primary btn" name="search">Search</button>
				</div>
			</form>

		</div>
		<?php 
				if (isset($_POST['modifyButton'])) {
					echo "
						<h2>Modify: ".$modresults['first_name']." ".$modresults['last_name']."</h2>
						
						<form method='POST'>
						<div class='row'>
							<div class='col-md-6'>
								First Name: <input type='text' name='modfname'>
							</div>
							<div class='col-md-6'>
								Last Name: <input type='text' name='modlname'>
							</div>
						</div>
						<br>
						<div class='row'>
							<div class='col-md-6'>
								<div class='form-group'>
									<label>Date of Birth: </label>
									<div class='input-group date' id='datetimepicker1'>
										<input type='date' class='form-control' name='moddob'/>
										<span class='input-group-addon'>
											<span class='glyphicon glyphicon-calendar'></span>
										</span>
									</div>
								</div>
							</div>
							</div>
							<div class='row'>
							<div class='col-md-4'>
								Bail: <input type='number' name='modbail'>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-2 col-md-offset-8'>
								<button type='submit' class='btn-primary btn' name='applyMod'>Apply</button>
							</div>
						</div>
						</form>

					";

				}
			?>
		<h2>Results</h2> 
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Birth</th>
					<th>Detaining PID</th>
					<th>Bail</th>
				</tr>
			</thead>
			<tbody>
				<form method="POST">
				<?php
				if (isset($_POST['search'])) {
					while ($row=$query->fetch_assoc()) {
					echo " 
						<tr>
							<td>".$row['first_name']."</td>
							<td>".$row['last_name']."</td>
							<td>".$row['dob']."</td>
							<td>".$row['detaining_pid']."</td>
							<td>".$row['bail']."</td>
							<td><button type='submit' class='btn btn-danger' name='releaseButton' value='".$row['id']."''>Release</button><button type='submit' class='btn btn-primary' name='modifyButton' value='".$row['id']."''>Modify</button></td>
						</tr>
					";}
				} else {
					while ($row=$results->fetch_assoc()) {
					echo " 
						<tr>
							<td>".$row['first_name']."</td>
							<td>".$row['last_name']."</td>
							<td>".$row['dob']."</td>
							<td>".$row['detaining_pid']."</td>
							<td>".$row['bail']."</td>
							<td><button type='submit' class='btn btn-danger' name='releaseButton' value='".$row['id']."''>Release</button><button type='submit' class='btn btn-primary' name='modifyButton' value='".$row['id']."''>Modify</button></td>
						</tr>
					";}
				}
				?>
			</form>
			</tbody>
		</table>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Detainee</h4>
				</div>
				<form method="POST">
				<div class="modal-body">
					<div class="form-group col-md-6">
						<label for="usr">First Name:</label>
						<input type="text" class="form-control" name="addfname">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Last Name:</label>
						<input type="text" class="form-control" name="addlname">
					</div>
					<div class="form-group col-md-12">
						<label for="comment">Address:</label>
						<textarea class="form-control" rows="2" name="addaddress"></textarea>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Date of Birth: </label>
							<div class='input-group date' name='datetimepicker1'>
								<input type='date' class="form-control" name="adddob" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Zip (Between 10000 and 10999): </label>
						<input type="number" class="form-control" name="addzip">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Bail: </label>
						<input type="text" class="form-control" name="addbail">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Phone Number: </label>
						<input type="number" class="form-control" name="addphone">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Detaining PID: </label>
						<input type="text" class="form-control" name="addpid">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-success" name="addButton">Add</button>
					<button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
			</div>

		</div>
	</div>
</div>    
</body>
</html>