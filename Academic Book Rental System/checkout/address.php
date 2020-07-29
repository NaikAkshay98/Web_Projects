<?php
if (session_id() == ""){
	session_start();
}
include("../php/connect.php"); error_reporting(1);
if (isset($_POST["submit"])) {
		
		$inputName = $_POST['inputName'];
		$inputNo = $_POST['inputNo'];
		$inputAddress = $_POST['inputAddress'];
		$inputAddress2 = $_POST['inputAddress2'];
		$inputCity = $_POST['inputCity'];
		$inputState = $_POST['inputState'];
		$inputZip = $_POST['inputZip'];
		
		
		$_SESSION['inputName'] = $inputName;
		$_SESSION['inputNo'] = $inputNo;
		$_SESSION['inputAddress'] = $inputAddress;
		$_SESSION['inputAddress2'] = $inputAddress2;
		$_SESSION['inputCity'] = $inputCity;
		$_SESSION['inputState'] = $inputState;
		$_SESSION['inputZip'] = $inputZip;
        
		
		
		header("Location:orderDetails.php");
        
		
    //header('location: dashboard.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!-- #########################-->
	<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
	<link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	
	<link href="../css/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
  <!--
	
	 -->
	 <!--#####################################################-->
	 <div class="container">
		<div class="row">
            <div class="col-md-12 col-md-offset-3 body-main">
                <?php
					if(!empty($_SESSION['id'])){
						$query="SELECT * FROM tbl_invoice_address WHERE id={$_SESSION['id']}";
						$data=mysqli_query($con,$query);
						while($row = mysqli_fetch_array($data)) {
				?>
				<form method="post" action="address.php">
				 <h3 class="font-italic font-weight-bold">Shipping Details </h3>
				  <div class="form-group">
					<label class="font-italic font-weight-bold" for="inputName">Name</label>
					<input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $_SESSION["name"]; ?>" required>
				  </div>
				  <div class="form-group">
					<label class="font-italic font-weight-bold" for="inputNo">Phone Number</label>
					<input type="text" class="form-control" id="inputNo" name="inputNo" value="<?php echo $row['phone_no']; ?>" required>
				  </div>
				  <div class="form-group">
					<label class="font-italic font-weight-bold" for="inputAddress">FlatNo BuildingName/ RoomNo ChawlName</label>
					<input type="text" class="form-control" id="inputAddress" name="inputAddress" value="<?php echo $row['address']; ?>" required>
				  </div>
				  <div class="form-group">
					<label class="font-italic font-weight-bold" for="inputAddress2">Address</label>
					<input type="text" class="form-control" id="inputAddress2" name="inputAddress2" value="<?php echo $row['address2']; ?>" required>
				  </div>
				  <div class="form-row">
					<div class="form-group col-md-6">
					  <label class="font-italic font-weight-bold" for="inputCity">City</label>
					  <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Mumbai" value="Mumbai">
					</div>
					<div class="form-group col-md-4">
					  <label class="font-italic font-weight-bold" for="inputState">State</label>
					  <select id="inputState" name="inputState" class="form-control" >
						<option selected>Maharashtra</option>

					  </select>
					</div>
					<div class="form-group col-md-2">
					  <label class="font-italic font-weight-bold" for="inputZip">Zip</label>
					  <input type="text" class="form-control" id="inputZip" name="inputZip" value="<?php echo $row['zip_code']; ?>" required>
					</div>
				  </div>
				 
				 <div><input type="submit" class="btn btn-outline-dark" name="submit" value="Submit"></div>

				</form>
					<?php }}else{ ?>
					<form method="post" action="address.php">
						 <p class="font-italic font-weight-bold">Shipping Details </p>
						  <div class="form-group">
							<label class="font-italic font-weight-bold" for="inputName">Name</label>
							<input type="text" class="form-control" id="inputName" name="inputName" placeholder="" required>
						  </div>
						  <div class="form-group">
							<label class="font-italic font-weight-bold" for="inputNo">Phone Number</label>
							<input type="text" class="form-control" id="inputNo" name="inputNo" placeholder="" required>
						  </div>
						  <div class="form-group">
							<label class="font-italic font-weight-bold" for="inputAddress">FlatNo BuildingName/ RoomNo ChawlName</label>
							<input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="" required>
						  </div>
						  <div class="form-group">
							<label class="font-italic font-weight-bold" for="inputAddress2">Address</label>
							<input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="" required>
						  </div>
						  <div class="form-row">
							<div class="form-group col-md-6">
							  <label class="font-italic font-weight-bold" for="inputCity">City</label>
							  <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Mumbai" value="Mumbai">
							</div>
							<div class="form-group col-md-4">
							  <label class="font-italic font-weight-bold" for="inputState">State</label>
							  <select id="inputState" name="inputState" class="form-control" >
								<option selected>Maharashtra</option>

							  </select>
							</div>
							<div class="form-group col-md-2">
							  <label for="inputZip">Zip</label>
							  <input type="text" class="form-control" id="inputZip" name="inputZip" placeholder="" required>
							</div>
						  </div>
						 
						 <div><input type="submit" class="btn btn-outline-dark" name="submit" value="Submit"></div>

					</form>
					<?php } ?>
				<!--#############################3-->
				
				<!--###################################3-->
            </div>
        </div>
	</div>

<style>
 .body-main {
     background: #7efff5;
     border-bottom: 15px solid #1E1F23;
     border-top: 15px solid #1E1F23;
     margin-top: 30px;
     margin-bottom: 30px;
     padding: 40px 30px !important;
     position: relative;
     box-shadow: 0 1px 21px #808080;
     font-size: 17px
 }

 .main thead {
     background: #1E1F23;
     color: #fff
 }

 .img {
     height: 100px
 }

 h1 {
     text-align: center
 }

</style>
  </body>
</html>
