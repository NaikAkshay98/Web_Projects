<?php
//session_start();

if (isset($_POST["submit"])) {
    include_once 'DBConnect.php';
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $database = new dbConnect();
    
    $db = $database->openConnection();
    $sql1 = "select name, email from tbl_registered_users where email='$email'";
    
    $user = $db->query($sql1);
    $result = $user->fetchAll();
    //$_SESSION['emailname'] = $result[0]['email'];
    
    if (empty($result)) {
        $sql = "insert into tbl_registered_users (name,email, password) values('$name','$email','$password')";
        
        $db->exec($sql);
        
        $database->closeConnection();
        $response = array(
            "type" => "success",
            "message" => "<h4 class='text-dark font-italic font-weight-bold'>You have registered successfully</h4><br/><a href='index.php'><input class='btn btn-outline-dark' type='button'  value='Home'></a>."
        );
    } else {
        $response = array(
            "type" => "error",
            "message" => "<h4 class='text-dark font-italic font-weight-bold'>Email already in use</h4><br/><a href='login.php'><input class='btn btn-outline-dark' type='button' value='Login'></a>"
        );
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="styles.css">

<script>
    function signupvalidation(){
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_pasword = document.getElementById('confirm_pasword').value;
        var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    	
        var valid=true;

        if(name == ""){
            valid = false;
            document.getElementById('name_error').innerHTML = " required.";
        }

        if(email == ""){
            valid = false;
            document.getElementById('email_error').innerHTML = " required.";
        } else {
            if(!emailRegex.test(email)){
                valid = false;
                document.getElementById('email_error').innerHTML = " invalid.";
            }
        }

        if(password == "" ){
            valid = false;
            document.getElementById('password_error').innerHTML = " required.";
        }
        if(confirm_pasword == "" ){
            valid = false;
            document.getElementById('confirm_password_error').innerHTML = " required.";
        }

        if(password != confirm_pasword){
            valid = false;
            document.getElementById('confirm_password_error').innerHTML = " Both passwords must be same.";
        }

        return valid;
    }
    </script>
</head>
<body>
<div class="container">
	<div style="background-color:#7efff5; margin: auto; box-shadow: 0 1px 18px black; width: 80%;" class="jumbotron mb-5 mt-5">
		<?php
			if (! empty($response)) {
		?>
			<div id="response" class="<?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
		<?php
			}
		?>
		
		<form action="" method="POST" onsubmit="return signupvalidation()">
			<h2 class="text-dark font-italic font-weight-bold" style="text-align:center;">BOOKSTORE</h2>
			
			<div class="form-group">
				<label class="text-dark font-italic font-weight-bold">Name</label><span id="name_error"></span>
				<div>
					<input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
				</div>
			</div>

			<div class="form-group">
				<label class="text-dark font-italic font-weight-bold">Email</label><span id="email_error"></span>
				<div>
					<input type="text" name="email" id="email" class="form-control" placeholder="Enter your Email ID">
				</div>
			</div>

			<div class="form-group">
				<label class="text-dark font-italic font-weight-bold">Password</label><span id="password_error"></span>
				<div>
				<input type="Password" name="password" id="password" class="form-control" placeholder="Enter your password">
				</div>
			</div>

			<div class="form-group">
				<label class="text-dark font-italic font-weight-bold">Confirm Password</label><span
					id="confirm_password_error"></span>
				<div>
				<input type="password" name="confirm_pasword" id="confirm_pasword" class="form-control" placeholder="Re-enter your password">
				</div>
			</div>


			<div class="form-group">
				<div align="center">
					<button type="submit" name="submit" class="btn btn-outline-dark">Sign Up</button>
				</div>
			</div>
	<!--
			<div class="row">
				 <div>
					<a href="login.php"><button type="button" name="submit" class="btn login">Login</button></a>
				</div>
			</div>
	-->	
		</form>
	</div>	
</div>
</body>
</html>