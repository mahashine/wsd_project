<?php
	//add in the db connection details using require_once
	require_once 'db.php';
	//create a new connection to the db
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	//create sql query to run
	$sql = "SELECT * FROM incident_type";
	// create var to contain the result-set from SQL query
	$result = $conn ->query($sql);
	//create array var incidentTypes
	$incidentTypes = [];
	//use while loop to fetch each row of the result-set
	while($row = $result->fetch_assoc()){
		//assign the column value to incident_type_id to var id
		$id = $row['incident_type_id'];
		//assign the column value to incident_type_desc to var tpye
		$type = $row['incident_type_desc'];
		//create array var incidentType to hold the column values for each row
		$incidentType = ["id" => $id, "type" => $type];
		//using the array_push function to assign all rows of the result-set into array var incidentTypes
		array_push($incidentTypes, $incidentType);
	}
	$conn->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log Call</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	</head>
		<body>
		<div class="container" style="width: 80%">
			<!--use php require_once expression to include header image and navigation bar from nav.php-->
			<?php require_once 'nav.php' ?>
			<!--Create section container to place web form-->
			<section style="margin-top: 20px">

			<!--create web form with caller name, contact number, location of incident, type of incident, description of incident input fields-->
			<form action="dispatch.php" method="post">
				
				<!--Row for caller name label and textbox input-->
				<div class="form-group row">
					<label for="callerName" class="col-lg-4 col-form-label">Caller's Name</label>
					<div class="col-lg-8">
						<input type="text" name="callerName" class="form-control" id="callerName" size="30" maxlength="50" pattern="[A-Za-z_]+">
					</div>
				</div>
				<br>

				<!--Row for contact number label and textbox input-->
				<div class="form-group row">
					<label for="contactNo" class="col-lg-4 col-form-label">Contact Number (Required)</label>
					<div class="col-lg-8">
						<input type="text" name="contactNo" class="form-control" id="contactNo" pattern="[0-9]{8}" required>
					</div>
				</div>
				<br>

				<!--Row for location of incident label and textbox input-->
				<div class="form-group row">
					<label for="locationofIncident" class="col-lg-4 col-form-label">Location of Incident (Required)</label>
					<div class="col-lg-8">
						<input type="text" name="locationofIncident" class="form-control" id="locationofIncident" required>
					</div>
				</div>
				<br>

				<!--Row for type of incident label and dropdown input-->
				<div class="form-group row">
					<label for="typeofIncident" class="col-sm-4 col-form-label">Type of Incident (Required)</label>
					<div class="col-sm-8">
						<select name="typeofIncident" class="form-control" id="typeofIncident" requried>
							<option>Select</option>
							<?php
							/*using for loop to retrieve the data from array var incidentTypes*/
								for ($i = 0; $i < count($incidentTypes); $i++){
									$incidentType = $incidentTypes[$i];
									echo "<option value='".$incidentType['id']."'>" .$incidentType['type']. "</option>";
								}
							?>
						</select>
					</div>
				</div>
				<br>

				<!--Row for description of incident label and large textbox input-->
				<div class="form-group row">
					<label for="descriptionofIncident" class="col-lg-4 col-form-label">Description of Incident (Required)</label>
					<div class="col-lg-8">
						<textarea rows="5" name="descriptionofIncident" class="form-control" id="descriptionofIncident" required></textarea>
					</div>
				</div>
				<br>

				<!-- Row for process call and reset button-->
				<div class="form-group row">
					<div class="col-lg-4"></div>
					<div class="col-lg-8" style="text-align: center;">
						<input type="submit" name="btnProcessCall" class="btn btn-primary" value="Process Call">
						<input type="submit" name="btnReset" class="btn btn-primary" value="Reset">
					</div>
				</div>
				<!--End of web form-->
			</form>
			<!--End of section-->
		</section>
		<!--footer-->
		<footer class="page-footer font-small blue pt-4 footer-copyright text-center py-3">
			&copy;2021 Copyright
			<a href="www.ite.edu.sg">ITE</a>
		</footer>
		</div>
		<script type="text/javascript" src="js/jquery-3.5.0.min.js"></script>
		<script type="text/javascript" src="js/popper.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
	</body>
</html>