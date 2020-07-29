<?php
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "", "bookstore");
		
		$condition = "";
		if(!empty($_POST["user-login-name"])) 
			$condition = " name = '" . $_POST["user-login-name"] . "'";
		if(!empty($_POST["user-email"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from tbl_registered_users " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("forgot-password-recovery-mail.php");
		} else {
			$error_message = 'No User Found';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="styles.css">
	<!--<link href="demo-style.css" rel="stylesheet" type="text/css">-->
</head>
	<body>
		<script>
		function validate_forgot() {
			if((document.getElementById("user-login-name").value == "") && (document.getElementById("user-email").value == "")) {
				document.getElementById("validation-message").innerHTML = "<h6 class='text-dark font-italic font-weight-bold'>Login Name or Email is required</h6>"
				return false;
			}
			return true
		}
		</script>
		<div class="container">
			<div style="background-color:#7efff5; margin: auto; box-shadow: 0 1px 18px black; width: 80%;" class="jumbotron mb-5 mt-5">
				<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
					<h2 class="text-dark font-italic font-weight-bold">Forgot Password?</h2>
					<?php if(!empty($success_message)) { ?>
					<div class="success_message"><?php echo $success_message; ?></div>
					<?php } ?>

					<div id="validation-message">
						<?php if(!empty($error_message)) { ?>
					<?php echo $error_message; ?>
					<?php } ?>
					</div>

					<div class="form-group">
						<div><label for="username" class="text-dark font-italic font-weight-bold">Username</label></div>
						<div><input type="text" name="user-login-name" id="user-login-name" class="form-control"></div>
					</div>
					
					<div class="form-group">
						<div><label for="username" class="text-dark font-italic font-weight-bold">OR</label></div>
					</div>
					
					<div class="form-group">
						<div><label for="email" class="text-dark font-italic font-weight-bold">Email</label></div>
						<div><input type="text" name="user-email" id="user-email" class="form-control"></div>
					</div>
					
					<div class="form-group">
						<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="btn btn-outline-dark"></div>
					</div>	
				</form>
			</div>	
		</div>
	</body>
</html>