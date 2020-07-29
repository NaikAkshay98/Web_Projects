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
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
		<h3 class="text-white font-italic font-weight-bold">BOOKSTORE</h3>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav m-auto">
				
				<li class="nav-item active"><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a class="nav-link" href="aboutUs.php">AboutUs</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
					Books
					</a>
					<div class="dropdown-menu bg-dark">
						<a class="dropdown-item text-light bg-dark" href="engineering.php">Engineering</a>
						<a class="dropdown-item text-light bg-dark" href="#">XYZ</a>
						<a class="dropdown-item text-light bg-dark" href="#">PQR</a>
					</div>
				</li>
				<li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
				
				<li class="nav-item"><a class="nav-link" href="return1.php">Return</a></li>
			</ul>
				<?php
				//$_SESSION['name']="";
				if (isset($_SESSION["name"])){ 
					//echo $_SESSION["name"];
				?>
					<a class="navbar-brand font-weight-light" href="profile.php">My Account</a>
				<?php }else{ ?>
					<a class="navbar-brand font-weight-light" href="login/signup.php">Signup</a>
					<a class="navbar-brand font-weight-light" href="login/login.php">Login</a>
				<?php } ?>
				
			
		</div>
		</div>
	</nav>

	
      <!-- 
      ================================================== -->
      
  </body>
</html>
