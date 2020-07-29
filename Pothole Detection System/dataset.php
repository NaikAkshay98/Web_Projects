<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
	
	
	<script src="js/index.js"></script>
</head>
<body style="background-image: url('images/3417081.jpg');">
	<?php
		require 'navbar.php';
	?>
	
	<?php include("php/connect.php"); error_reporting(1);?>
	<?php// print_r($_POST); ?>
	<?php //print_r($_GET); ?>
	<?php
		$co = $_GET['pid'];
		if($co!=""){
			$query="SELECT coordinate FROM POTHOLEENTRY WHERE id = $co ";
			$data=mysqli_query($con,$query);
			while($row = mysqli_fetch_array($data)) {
	?>
		<script>				
			var coordDisplay_array=[];
			co_array='<?php echo $row["coordinate"];?>';
			co_array=co_array.split(",");
			
			var i;
			for (i = 0; i < (co_array.length)/2; i++) {
				var lalo_array=[];
				lalo_array.push(co_array[0]);
				lalo_array.push(co_array[1]);
				co_array.shift();
				co_array.shift();
				coordDisplay_array.push(lalo_array);
			}
		</script>
	<?php 
		}
			} 
	?>
	
	<div class="container-fluid pt-3">
			<div class="row">
				<div class="col-lg-6">
					<div style="background-color:#dff9fb" class="card mb-3">
						<div style="background-color:#c7ecee" class="card-header">
							<h4 class="float-left">Pothole Data Table</h4>
							
						</div>
						<div class="card-body" style="height: 541px">
							<?php
								$query="SELECT id , name FROM POTHOLEENTRY WHERE coordinate <> '' and coordinate is not null";
								$data=mysqli_query($con,$query);
							?>
							<table id="mydatatable" class="table table-hover table-bordered table-sm" style="background-color:#c7ecee" style="width:100%">
								<thead>
									<tr>
										<th>Project ID</th>
										<th>Project Name</th>
									</tr>
								</thead>
								<tbody>
							<?php
								if($data){
									foreach($data as $row){
							?>
								
									<tr>
										<td>
											<a href="dataset.php?pid=<?php echo $row['id'];?>">
												<?php echo $row['id'];?>
											</a>
										</td>
										<td><?php echo $row['name'];?></td>
									</tr>
								
							<?php			
									}
								}else{
									echo "No record found";
								}
							?>  
							</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="col-lg-6">
					<div style="background-color:" class="card mb-3 bg-dark text-white">
						<div  class="card-header">
							<h4 class="float-left text-white">Pothole Tracker</h4>
						</div>
						<div class="card-body">
							<div id="map" style="height: 500px"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<script>
		$(document).ready(function() {
			$('#mydatatable').DataTable();
		} );
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

</body>
</html>