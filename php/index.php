<!DOCTYPE html>
<html>
<head>
	<title>Show Relations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var function getOutput() {
			$.ajax({
				url:'relationdisplay.php',
				complete: function (response) {
					$('#output').html(response.responseText);
				},
				error: function () {
					$('#output').html('Bummer: there was an error!');
				}
			});
			return false;
		}
	</script>
</head>
<body>
	<div class="container">
		<div class="row" style="margin-top:50px">
			<div style="text-align: center">
				<h1>Relations</h1>
			</div>
			<br><br>
			<div class="col-md-1"></div>
			<div class="col-md-2">
				<button type="button" class="btn btn-def btn-primary" onclick="location.href = './zip.php'"">ZIP</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-def btn-primary" onclick="location.href = './station.php'">STATION</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-def btn-primary" onclick="location.href = './personnel.php'">PERSONNEL</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-def btn-primary" onclick="location.href = './detainee.php'">DETAINEE</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-def btn-primary" onclick="location.href = './citations.php'">CITATIONS</button>
			</div>
			<div class="col-md-1"></div>
			<br><br>
		</div>
	</div>
</body>
</html>