<?php
if (session_id() == ""){
	session_start();
}
require_once("php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
	//var_dump($_SESSION["cart_item"]);
		//if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"],'code'=>$productByCode[0]["code"], 'quantity'=>1,'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"])) ) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] +=1;
							}
					}
			}
			 else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		//}
	break;
}
exit();
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<link href="css/style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		
		
		
		<?php include 'navbar.php';?>
		<?php include("php/connect.php"); error_reporting(1);?>
		
		<script>
			function addCart(code){
			
			$.ajax({
			  method: "GET",
			  url: "engineering.php?action=add&code="+code,
			  //data: { name: "John", location: "Boston" }
				})
				//.done(function( msg ) {
				//$("#ajaxReturnDisplay").html(msg);
			  //});
				//$('[data-toggle="popover"]').popover();   
				//$('.alert').alert()
			  //console.log('This was logged in the callback: '); 
			}
			
		</script>
		
		<div id="ajaxReturnDisplay"></div>
		
		<?php
			$eng = "";
			$sem = "";
			$query = "SELECT * FROM tblproduct WHERE 1=1";
			
			if(isset($_POST['eng']) and $_POST['eng']!="" and $_POST['eng']!="All"){
				$eng = $_POST['eng'];
				$query = $query . " and course ='$eng'";
			}
			
			if(isset($_POST['sem']) and $_POST['sem']!="" and $_POST['sem']!="All"){
				$sem = $_POST['sem'];
				$query = $query . " and semester ='$sem'";
			}
		?>
		<div class="container">
			<h1 style="text-align:center" class="text-dark font-italic font-weight-bold mt-5">Engineering</h1>
			<div>
				<button class="btn btn-outline-dark ml-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					FILTER
				</button>
			</div>
			<div class="collapse mt-3" id="collapseExample">
				<div class="card card-body text-light bg-dark">
					<div class="container">
						<form action="engineering.php" method="POST">
							<div>
								<label for="eng" class="font-italic font-weight-bold">Engineering course (select one):</label>
								<select class="form-control" id="eng" name="eng">
									<option>All</option>
									<option>FE</option>
									<option>computer</option>
									<option>IT</option>
									<option></option>
									<option></option>
								</select>
							</div>
							<div>
								<label for="sem" class="font-italic font-weight-bold">Semester (select one):</label>
								<select class="form-control" id="sem" name="sem">
									<option>All</option>
									<option>sem1</option>
									<option>sem2</option>
									<option>sem3</option>
									<option></option>
								</select>
							</div>
							<div class="mt-3">
								<button type="submit" class="btn btn-outline-light">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- card-->
		<div class="container card-columns ">
			<?php
				$data=mysqli_query($con,$query);
				while($row = mysqli_fetch_array($data)) {
			?>
			<!--div class="card-body" -->
			<div class="badge-dark card p-1 m-3" >
				
					<img class="card-img-top" src="<?php echo $row[image]; ?>" alt="Card image cap">
					<div class="card-body p-1">
						<h5 class="card-title"><?php echo $row[name]; ?></h5>
						<!--<h5 class="card-title"><?php// echo $row[course] ."  ". $row[semester]; ?></h5>-->
						<div class="card-price"><?php echo "Rs ".$row[price]; ?></div>
						<div class="cart-action">
						<!--	<input type="text" class="form-group mt-2" name="quantity" value="1" size="1" />  -->
							<input type="button" onclick="addCart('<?php echo $row['code'];?>')" style="float:right;" value="Add to Cart" class="btn btn-outline-light btn-sm mb-2"/>
						</div>
						<!-- <a href="#"><img src="image/icon/basket30.png"></a> -->
					</div>
			</div>
			<?php } ?>
		</div>
		<?php if(isset($_SESSION["Returncart_item"])){unset($_SESSION["Returncart_item"]); unset($_SESSION["pid"]);}?>
	</body>
</html>
