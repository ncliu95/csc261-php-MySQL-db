<?php
	session_start();
	require_once 'dbconnect.php';

	/*
	if (isset($_SESSION['ptUserSession'])!="") {
   		header("Location: .php");
    	exit;
	} else if (isset($_SESSION['phyUserSession'])!=""){
    	header("Location: doctor-profile.php");
	}*/
	if (isset($_POST['login'])) {
	//echo '<script type="text/javascript">console.log("button pressed");</script>';

    $pid = strip_tags($_POST['userID']);
    $password = strip_tags($_POST['password']);

    $pid = $DBcon->real_escape_string($pid);
    $password = $DBcon->real_escape_string($password);

    $query = $DBcon->query("SELECT pid, admin, password FROM PERSONNEL WHERE pid='$pid'");
    $row=$query->fetch_array();

    $count = $query->num_rows; // if email/password are correct returns must be 1 row
 	echo '<script type="text/javascript">alert('.$row['admin'].');</script>';
    if (($password == $row['password']) && $count==1) {
        $_SESSION['userSession'] = $row['pid'];
        if ($row['admin'] == '1') {
        	header("Location: ../phpmyadmin");
        } else { 
        	header("Location: stationlist.php");
        }
    } else {
        $msg = "<div class='alert alert-danger'>
        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
        </div>";
    }
    $DBcon->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Personnel Login</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style type="text/css">
		body{
			background: #00589F;
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00589F', endColorstr='#0073CF', GradientType=0);
			background: -webkit-linear-gradient(to bottom, #00589F 50%, #0073CF) !important;
			background: -moz-linear-gradient(to bottom, #00589F 50%, #0073CF) !important;
			background: -ms-linear-gradient(to bottom, #00589F 50%, #0073CF) !important;
			background: -o-linear-gradient(to bottom, #00589F 50%, #0073CF) !important;
			background: linear-gradient(to bottom, #00589F 50%, #0073CF) !important;
			color: black;
		}

		div.well{
			height: 250px;
		} 

		.Absolute-Center {
			margin: auto;
			position: absolute;
			top: 0; left: 0; bottom: 0; right: 0;
		}

		.Absolute-Center.is-Responsive {
			width: 50%; 
			height: 50%;
			min-width: 200px;
			max-width: 400px;
			padding: 40px;
		}

		#logo-container{
			margin: auto;
			margin-bottom: 10px;
			width:200px;
			height:30px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class = "row">
			<?php echo $msg ?>
		</div>
		<div class="row">
			<div class="Absolute-Center is-Responsive">
				<div id="logo-container">
					<h3>Personnel Login</h3>
				</div>
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<form id="loginForm" method="POST">
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control" type="text" name='userID' placeholder="Personnel ID"/>          
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" name='password' placeholder="Password"/>     
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox"> Remember me</a>
							</label>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-def btn-block" name="login" id="login">Login</button>
						</div>
					</form>        
				</div>  
			</div>    
		</div>
	</div>

</body>
</html>