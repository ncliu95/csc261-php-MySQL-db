<?php 
session_start();
include_once 'dbconnect.php';

if (isset($_POST['search'])) {
	//echo '<script type="text/javascript">alert("'.$_POST['query'].'");</script>';
	//include_once 'dbconnect.php';
	echo $_POST['query'];

	if($_POST['attribute'] == "fname") {
		$searchItem = $_POST['query'];
		$query = $DBcon->query("SELECT * FROM PERSONNEL WHERE (station_id=".$_SESSION['selectedStation']." AND first_name ='".$searchItem."')");
	} else if ($_POST['attribute'] == "lname"){
		$searchItem = $_POST['query'];
		$query = $DBcon->query("SELECT * FROM PERSONNEL WHERE (station_id=".$_SESSION['selectedStation']." AND last_name ='".$searchItem."')");
	} else if ($_POST['attribute'] == "rank"){
		$searchItem = $_POST['query'];
		$query = $DBcon->query("SELECT * FROM PERSONNEL WHERE (station_id=".$_SESSION['selectedStation']." AND rank ='".$searchItem."')");
	} else if ($_POST['attribute'] == "salary"){
		$searchItem = $_POST['query'];
		$query = $DBcon->query("SELECT * FROM PERSONNEL WHERE (station_id=".$_SESSION['selectedStation']." AND slsary ='".$searchItem."')");
	} else if ($_POST['attribute'] == "position"){
		$searchItem = $_POST['query'];
		$query = $DBcon->query("SELECT * FROM PERSONNEL WHERE (station_id=".$_SESSION['selectedStation']." AND employee_type ='".$searchItem."')");
	}
	echo $DBcon->error;
}

if (isset($_POST['modify'])) {
	$_SESSION['pidTemp'] = $_POST['modify'];
	$modifyQuery = $DBcon->query("SELECT * FROM PERSONNEL WHERE pid=".$_POST['modify']);
	$results = $modifyQuery->fetch_assoc();
}

if (isset($_POST['applyMod'])) {
	if (!empty($_POST['modfname'])) {
		$modifyQuery = "UPDATE PERSONNEL SET first_name='".$_POST['modfname']."' WHERE pid =".$_SESSION['pidTemp'];
		$DBcon->query($modifyQuery);
	}
	if (!empty($_POST['modmname'])) {
		$modifyQuery = "UPDATE PERSONNEL SET middle_name='".$_POST['modmname']."' WHERE pid =".$_SESSION['pidTemp'];
		$DBcon->query($modifyQuery);
	}
	if (!empty($_POST['modlname'])) {
		$modifyQuery = "UPDATE PERSONNEL SET last_name='".$_POST['modlname']."' WHERE pid =".$_SESSION['pidTemp'];
		$DBcon->query($modifyQuery);
	}
	if (!empty($_POST['modrank'])) {
		$modifyQuery = "UPDATE PERSONNEL SET rank='".$_POST['modrank']."' WHERE pid =".$_SESSION['pidTemp'];
		$DBcon->query($modifyQuery);
	}
	if (!empty($_POST['modsalary'])) {
		$modifyQuery = "UPDATE PERSONNEL SET salary='".$_POST['modsalary']."' WHERE pid =".$_SESSION['pidTemp'];
		$DBcon->query($modifyQuery);
	}
	if (!empty($_POST['modposition'])) {
		$modifyQuery = "UPDATE PERSONNEL SET employee_type='".$_POST['modposition']."' WHERE pid =".$_SESSION['pidTemp'];
		$DBcon->query($modifyQuery);
	}
}

if (isset($_POST['addButton'])) {
	if (!empty($_POST['addfname']) && !empty($_POST['addmname']) && !empty($_POST['addlname']) && !empty($_POST['adddob']) && !empty($_POST['addrank']) && !empty($_POST['addposition']) && !empty($_POST['addsalary']) && !empty($_POST['addaddress']) && !empty($_POST['addzip']) && !empty($_POST['addssn'])) {
		$insertQuery = 
		"INSERT INTO PERSONNEL (station_id,start_date,first_name, middle_name, last_name, dob, rank, employee_type, salary, street_address, zip_code, ssn, end_date)
		VALUES (".$_SESSION['selectedStation'].",'".date('Y-m-d')."','".$_POST['addfname']."','".$_POST['addmname']."','".$_POST['addlname']."','".$_POST['adddob']."','".$_POST['addrank']."','".$_POST['addposition']."',".$_POST['addsalary'].",'".$_POST['addaddress']."',".$_POST['addzip'].",".$_POST['addssn'].",'".$_POST['addenddate']."');";
		//echo $insertQuery;
		if ($DBcon->query($insertQuery) === TRUE ) {
			echo "Personnel added";
		} else {
			echo "Error: " . $DBcon -> error;
		}
	} else {
		echo "Please fill in all fields";
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Personnel List</title>
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
			<h2>Personnel List</h2> 
			<div class="col-md-2">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Personnel</button>
			</div>
			<form method="POST">
				<div class="col-md-2">
					<select class="form-control" name="attribute" id="attribute">
						<option value="fname">First Name</option>
						<option value="lname">Last Name</option>
						<option value="rank">Rank</option>
						<option value="position">Position</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" placeholder="search..." name="query">
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn-primary btn" name="search">Search</button>
				</div>
			</form>
		</div>
		<?php 
				if (isset($_POST['modify'])) {
					echo "
						<h2>Modify: ".$results['first_name']." ".$results['last_name']."</h2>
						
						<form method='POST'>
						<div class='row'>
							<div class='col-md-4'>
								First Name: <input type='text' name='modfname'>
							</div>
							<div class='col-md-4'>
								Middle Name: <input type='text' name='modmname'>
							</div>
							<div class='col-md-4'>
								Last Name: <input type='text' name='modlname'>
							</div>
						</div>
						<br>
						<div class='row'>
							<div class='col-md-4'>
								Rank: <input type='text' name='modrank'>
							</div>
							<div class='col-md-4'>
								Salary: <input type='number' name='modsalary'>
							</div>
							<div class='col-md-4'>
								Position: <input type='text' name='modposition'>
							</div>
						</div>
						<br>
						<div class='row'>
							<div class='col-md-2 col-md-offset-10'>
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
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Rank</th>
					<th>Salary</th>
					<th>Position</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (isset($_POST['search'])) {
				while($row=$query->fetch_assoc()) {
					echo "
				<tr>
					<td>".$row['first_name']."</td>
					<td>".$row['middle_name']."</td>
					<td>".$row['last_name']."</td>
					<td>".$row['rank']."</td>
					<td>".$row['salary']."</td>
					<td>".$row['employee_type']."</td>
					<td>
					<form method='POST'>
					<button type='submit' class='btn btn-danger' value='".$row['pid']."' name='modify'>Modify</button>
					</form>
					</td>
				</tr>
				";
				}
			}
				?>
			</tbody>
		</table>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<form method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Personnel</h4>
				</div>
				<div class="modal-body">
					<div class="form-group col-md-4">
						<label for="usr">First Name:</label>
						<input type="text" class="form-control" name="addfname">
					</div>
					<div class="form-group col-md-4">
						<label for="usr">Middle Name:</label>
						<input type="text" class="form-control" name="addmname">
					</div>
					<div class="form-group col-md-4">
						<label for="usr">Last Name:</label>
						<input type="text" class="form-control" name="addlname">
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Date of Birth: </label>
							<div class='input-group date' id='datetimepicker1'>
								<input type='date' class="form-control" name="adddob"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="usr">Rank: </label>
						<input type="text" class="form-control" name="addrank">
					</div>
					<div class="form-group col-md-4">
						<label for="usr">Position: </label>
						<input type="text" class="form-control" name="addposition">
					</div>
					<div class="form-group col-md-4">
						<label for="usr">Salary: </label>
						<input type="number" class="form-control" name="addsalary">
					</div>
					<div class="form-group col-md-12">
						<label for="comment">Address:</label>
						<textarea class="form-control" rows="2" name="addaddress"></textarea>
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Zip (Between 10000 and 10999): </label>
						<input type="number" class="form-control" name="addzip">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">SSN: </label>
						<input type="number" class="form-control" name="addssn">
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>End Date: </label>
							<div class='input-group date' id='datetimepicker1'>
								<input type='date' class="form-control" name="addenddate" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
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