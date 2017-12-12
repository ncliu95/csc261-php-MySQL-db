<?php
session_start();
include_once 'dbconnect.php';

$query = "SELECT CITATIONS.id, CITATIONS.fine, CITATIONS.pid, CITATIONS.notes FROM CITATIONS LEFT JOIN PERSONNEL ON CITATIONS.pid = PERSONNEL.pid WHERE PERSONNEL.station_id =" . $_SESSION['selectedStation'];
$results = $DBcon->query($query);

if (isset($_POST['search'])) {
		if($_POST['attribute'] == "opid") {
			$searchItem = $_POST['query'];
			$query = "SELECT CITATIONS.fine, CITATIONS.pid, CITATIONS.notes FROM CITATIONS LEFT JOIN PERSONNEL ON CITATIONS.pid = PERSONNEL.pid WHERE PERSONNEL.station_id =" . $_SESSION['selectedStation'] . " AND CITATIONS.pid=".$searchItem;
			$results = $DBcon->query($query);
		} else if ($_POST['attribute'] == "fine"){
			$searchItem = $_POST['query'];
			$query = "SELECT CITATIONS.fine, CITATIONS.pid, CITATIONS.notes FROM CITATIONS LEFT JOIN PERSONNEL ON CITATIONS.pid = PERSONNEL.pid WHERE PERSONNEL.station_id =" . $_SESSION['selectedStation'] . " AND CITATIONS.fine=".$searchItem;
			$results = $DBcon->query($query);
		} else if ($_POST['attribute'] == "notes"){
			$searchItem = $_POST['query'];
			$query = "SELECT CITATIONS.fine, CITATIONS.pid, CITATIONS.notes FROM CITATIONS LEFT JOIN PERSONNEL ON CITATIONS.pid = PERSONNEL.pid WHERE PERSONNEL.station_id =" . $_SESSION['selectedStation'] . " AND CITATIONS.notes LIKE '%".$searchItem."%'";
			//echo $query;
			$results = $DBcon->query($query);
		}
		//echo $query;

}

if (isset($_POST['addButton'])) {
	if (!empty($_POST['addpid']) && !empty($_POST['addnotes']) && !empty($_POST['addfine'])) {
			$insertQuery = "INSERT INTO CITATIONS (pid, fine, notes) 
			VALUES (".$_POST['addpid'].",".$_POST['addfine'].",'".$_POST['addnotes']."');";
			//echo $insertQuery;
			if ($DBcon->query($insertQuery)===TRUE) {
				echo "Detainee Added";
			} else {
				echo "Error: ".$DBcon->error;
			}
	}
}

if (isset($_POST['deleteButton'])) {
	$deleteQuery = "DELETE FROM CITATIONS WHERE id =".$_POST['deleteButton'];
	//echo $deleteQuery;
	$result = $DBcon->query($deleteQuery);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Citation List</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<a href="station.php">Return to Stations</a>
	<div class="container">
		<div class="row">
			<h2>Citation List</h2> 
			<div class="col-md-2">
				<button type="button" class="btn btn-primary"data-toggle="modal" data-target="#myModal">Add Citation</button>
			</div>
			<form method="POST">
			<div class="col-md-3">
				<select class="form-control" name="attribute">
					<option value="opid">Officer ID</option>
					<option value="fine">Fine</option>
					<option value="notes">Notes</option>
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
		<h2>Results</h2> 
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Officer ID</th>
					<th>Fine</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row=$results->fetch_assoc()) { echo "
				<tr>
					<td>".$row['pid']."</td>
					<td>".$row['fine']."</td>
					<td>".$row['notes']."</td>
					<td>
					<form method='POST'>
					<button type='submit' class='btn btn-danger' value='".$row['id']."' name='deleteButton'>Delete</button>
					</form></td>
				</tr>
			";}?>
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
					<h4 class="modal-title">Add Citation</h4>
				</div>
				<form method="POST">
				<div class="modal-body">
					<div class="form-group col-md-6">
						<label for="usr">Issuing Officer ID:</label>
						<input type="text" class="form-control" name="addpid">
					</div>
					<div class="form-group col-md-6">
						<label for="usr">Fine:</label>
						<input type="text" class="form-control" name="addfine">
					</div>
					<div class="form-group col-md-12">
						<label for="comment">Notes:</label>
						<textarea class="form-control" rows="5" name="addnotes"></textarea>
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