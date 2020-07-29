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
			
			<h1 style="text-align:center;" class="text-dark font-italic font-weight-bold">Follow us on</h1>
			<hr class="my-4">
			<h5 style="text-align:center;"><img class="mr-5" src="product-images/icon/twitter.png"><img class="mr-5" src="product-images/icon/instagram.png"><img src="product-images/icon/facebook.png"></h5>
			
		</div>
		
		<div class="row ">
		  <div class="col-sm-6">
			<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card">
			  <div class="card-body">
				<h5 class="card-title text-dark font-italic font-weight-bold">Address</h5>
				<p class="card-text text-dark font-italic font-weight-bold">Malwani Church, Marve Road, Malad-West,</p> 
				<p class="card-text text-dark font-italic font-weight-bold">Mumbai-400095, Maharashtra</p>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6">
			<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card">
			  <div class="card-body">
				<h5 class="card-title text-dark font-italic font-weight-bold">Contact</h5>
				<p class="card-text text-dark font-italic font-weight-bold">Mobile No: 77777 11111</p>
				<p class="card-text text-dark font-italic font-weight-bold">Email Id: Bookstore400095@gmail.com</p>
			  </div>
			</div>
		  </div>
		</div>
		<!--
		<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="jumbotron jumbotron-fluid mt-5">
			<div class="container">
				<h1 class="display-4">Fluid jumbotron</h1>
				<p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
			</div>
		</div>
		-->
	</div>
	<?php if(isset($_SESSION["Returncart_item"])){unset($_SESSION["Returncart_item"]); unset($_SESSION["pid"]); }?>
  </body>
</html>
