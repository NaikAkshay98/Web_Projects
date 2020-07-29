<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
		<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
		<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<script src="js/index.js"></script>
	</head>
	<body style="background-image: url('images/3417081.jpg');">
		<?php
			require 'navbar.php';
		?>
		
		<?php include("php/connect.php"); error_reporting(1);?>
		<?php //print_r($_POST); ?>
		<?php
			if(isset($_POST['filename']) and isset($_POST['coord'])){
				$fn = $_POST['filename'];
				$co = $_POST['coord'];
				//echo $_POST['filename'] ;
				//echo $co ;
				if($fn!="" and $co!=""){
					$query="INSERT INTO POTHOLEENTRY VALUES ('','$fn','$co')";
					$data=mysqli_query($con,$query);
		?>
				<script>window.location=" pothole.php";</script> 
		<?php		
				}else{ 
		?>
					<script>
						bootbox.alert("Execute Pothole Detection <br> Before submitting records");
					</script>
		<?php
				}
			}
		?>
		<!---->
		<script>
			function alertFunc() {
				if($("#filename").val()==""){
					bootbox.alert("Enter area <br> Before submitting records");
				}else if($("#coord").val()==""){
					bootbox.alert("Execute Pothole Detection <br> Before submitting records");
				}else{
					bootbox.confirm({
					message: "Do you want to submit records?",
					buttons: {
						cancel: {
							label: 'No',
							className: 'btn-danger'
						},
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						}
					},
					callback: function (result) {
						if(result==true){
							//console.log($("#areaForm"));
							areaForm.submit();
						}
					}
					});
				}	
			}
		</script>

		<div class="container-fluid">
			<form action="pothole.php" id="areaForm" method="POST">			
				<div class="pt-3">
				  <div class="form-row">
					<div class="col-4">
						<input type="text" name="filename" id="filename" class="form-control" placeholder="Enter your Area" required>
						<input type="hidden" name="coord" id="coord" value="" >
					</div>
					<div class="col-8">
						<button type="button" class="btn btn-success float-left" onclick="alertFunc()">Submit Record</button>
					</div>
				  </div>
				</div>
			</form>
		</div>
		
		<div class="container-fluid pt-3">
			<div class="row">
				<div class="col-lg-6">
					<div class="card mb-3" style="background-color:#dff9fb" >
						<div class="card-header" style="background-color:#c7ecee" >
							<h4 class="float-left">Pothole Detection</h4>
							
							<button type="button" class="btn btn-danger float-right" onclick="end()">Stop</button>
							<button type="button" class="btn btn-info float-right mr-2" onclick="init()">Start</button>
						</div>
						<div class="card-body" style="height: 505px">
							<div class="progress mb-3">
								<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							
							<div id="webcam-container"></div>
							<div id="label-container"></div>
							<!--<p id="demo1"></p>-->	<!--testing -->
							<!--<p id="demo2"></p>-->	<!--testing -->
							<!--<p id="tabDisplay"></p>-->	<!--testing -->
						</div>
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="card mb-3 bg-dark text-white">
						<div class="card-header">
							<h4 class="float-left">Pothole Tracker</h4>
							<button type="button" class="btn btn-info float-right" onclick="displayMap()">Display</button>
						</div>
						<div class="card-body">
							<div id="map" style="height: 465px"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>