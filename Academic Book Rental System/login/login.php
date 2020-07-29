<?php
if (session_id() == ""){
	session_start();
}
if (isset($_POST["submit"])) {
    include_once 'DBConnect.php';
	
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $database = new dbConnect();
    
    $db = $database->openConnection();
    
    //$sql = "select * from tbl_registered_users where email = '$email' and password= '$password'";
	$sql = "select * from tbl_registered_users where email = '$email'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_ASSOC);
   
	
    $database->closeConnection();
	
	if (empty($result)) {
        $response = array(
            "type" => "error",
            "message" => "<h4 class='text-dark font-italic font-weight-bold'>You are a new user<br/>Please Signup first</h4></br><a href='signup.php'><input class='btn btn-outline-dark' type='button' value='Signup'></a>"
        );
    }elseif(!empty($result[0]['email'])){
		$database = new dbConnect();
		$db = $database->openConnection();
		$sql = "select * from tbl_registered_users where email = '$email' and password= '$password'";
		$user = $db->query($sql);
		$result = $user->fetchAll(PDO::FETCH_ASSOC);
		$database->closeConnection();
		
		if(empty($result)){
			$response = array(
			"type" => "error",
            "message" => "<h4 class='text-dark font-italic font-weight-bold'>Incorrect Password</h4>"
			);
		}else {
			$id = $result[0]['id'];
			$name = $result[0]['name'];
			$email = $result[0]['email'];
			//echo "$name : a";
			$email = $result[0]['email'];
			$_SESSION['name'] = $name;
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $email;
			if(isset($_SESSION['name'])){
				header("Location:../index.php");
			}
		}
	
	}
	
	
/*        $response = array(
            "type" => "success",
            "message" => "You have registered successfully.<br/><a href='../index.php'></a>."
        );
*/
    
    //header('location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="styles.css">

<script>
    function loginvalidation(){
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var valid = true;

        if(email == ""){
        	   valid = false;
            document.getElementById('email_error').innerHTML = " required.";
        }

        if(password == ""){
        	   valid = false;
            document.getElementById('password_error').innerHTML = " required.";
        }
        return valid;
    }
    </script>
</head>
<body >
    <div class="container">
		<div style="background-color:#7efff5; margin: auto; box-shadow: 0 1px 18px black; width: 80%;" class="jumbotron mb-5 mt-5">
			<?php
			if (! empty($response)) {
				?>
			<div id="response" class="<?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
			<?php
			}
			?>
			<form action="" method="POST" onsubmit="return loginvalidation();">
				<h2 class="text-dark font-italic font-weight-bold" style="text-align:center;">BOOKSTORE</h2>

				<div class="form-group">
					<label class="text-dark font-italic font-weight-bold">Email</label> <span id="email_error"></span>
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
					<a href="forgetPass/forgetpass.php" class="forget_pass">Forgot Password?</a>
					
					<div>
						<button type="submit" name="submit" class="btn btn-outline-dark">Login</button>
					</div>
				</div>
			
			</form>
		</div>
    </div>
</body>
</html>