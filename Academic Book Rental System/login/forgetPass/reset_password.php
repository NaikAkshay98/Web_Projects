<?php
	if(isset($_POST["reset-password"])) {
		$conn = mysqli_connect("localhost", "root", "", "bookstore");
		$sql = "UPDATE `bookstore`.`tbl_registered_users` SET `password` = '" . md5($_POST["member_password"]). "' WHERE `tbl_registered_users`.`name` = '" . $_GET["name"] . "'";
		$result = mysqli_query($conn,$sql);
		$success_message = "<h6 class='text-dark font-italic font-weight-bold'>Password is reset successfully</h6>";
		
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
		function validate_password_reset() {
			if((document.getElementById("member_password").value == "") && (document.getElementById("confirm_password").value == "")) {
				document.getElementById("validation-message").innerHTML = "<h6 class='text-dark font-italic font-weight-bold'>Please enter new password</h6>"
				return false;
			}
			if(document.getElementById("member_password").value  != document.getElementById("confirm_password").value) {
				document.getElementById("validation-message").innerHTML = "<h6 class='text-dark font-italic font-weight-bold'>Both password should be same</h6>"
				return false;
			}
			
			return true;
		}
		</script>
		<div class="container">
			<div style="background-color:#7efff5; margin: auto; box-shadow: 0 1px 18px black; width: 80%;" class="jumbotron mb-5 mt-5">
				<form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">
					<h2 class="text-dark font-italic font-weight-bold">Reset Password</h2>
					<?php if(!empty($success_message)) { ?>
					<div class="success_message"><?php echo $success_message; ?></div>
					<?php } ?>

					<div id="validation-message">
						<?php if(!empty($error_message)) { ?>
					<?php echo $error_message; ?>
					<?php } ?>
					</div>

					<div class="form-group">
						<div><label for="Password" class="text-dark font-italic font-weight-bold">Password</label></div>
						<div><input type="password" name="member_password" id="member_password" class="form-control"></div>
					</div>
					
					<div class="form-group">
						<div><label for="email" class="text-dark font-italic font-weight-bold">Confirm Password</label></div>
						<div><input type="password" name="confirm_password" id="confirm_password" class="form-control"></div>
					</div>
					
					<div class="form-group">
						<div><input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="btn btn-outline-dark"></div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>		