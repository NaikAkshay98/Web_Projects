<?php
if (session_id() == ""){
	session_start();
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
	
	<link href="css/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
	<?php include 'navbar.php';?>
	<div class="container">
		<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="jumbotron mb-5 mt-5">
			<?php
				if (isset($_SESSION["name"])){ 
			?>
			<h3 class="display-4 text-dark font-italic font-weight-bold">Hello,<?php echo($_SESSION["name"]);?></h3>
			<?php }else{ ?>
			<h3 class="display-4 text-dark font-italic font-weight-bold">Hello, User</h3>
			<?php } ?>
			
			<h3 class="text-dark font-italic font-weight-bold">Get 85% cashback on every Return. Try your Luck now.</h3>
			<hr class="my-4">
			<h5 class="text-dark font-italic font-weight-bold">Home Delivery and Cash on Delivery at your service.</h5>
			
			<?php
				if (isset($_SESSION["name"])){ 
			?>
			<a class="btn btn-outline-dark mt-3" href="profile.php" role="button">My Account</a>
			<?php }else{ ?>
			<a class="btn btn-outline-dark mt-3" href="login/signup.php" role="button">SignUp</a>
			<a class="btn btn-outline-dark mt-3" href="login/login.php" role="button">Login</a>
			<?php } ?>
			
			</p>
		</div>
		
		<div class="row mb-3">
		  <div class="col-sm-6">
			<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card">
			  <div class="card-body">
				<h5 class="card-title text-dark font-italic font-weight-bold">How to Order Books?</h5>
				<p class="card-text text-dark font-italic font-weight-bold">Learn more about the simplicity of ordering books.</p>
				<a href="#" class="btn btn-outline-dark">Learn More</a>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6">
			<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card">
			  <div class="card-body">
				<h5 class="card-title text-dark font-italic font-weight-bold">How to Return Books?</h5>
				<p class="card-text text-dark font-italic font-weight-bold">Learn more about the simplicity of returning books.</p>
				<a href="#" class="btn btn-outline-dark">Learn More</a>
			  </div>
			</div>
		  </div>
		</div>
		
	</div>
	<?php if(isset($_SESSION["Returncart_item"])){unset($_SESSION["Returncart_item"]); unset($_SESSION["pid"]); }?>
  </body>
</html>
