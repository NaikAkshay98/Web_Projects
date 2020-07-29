<?php
if (session_id() == ""){
	session_start();
}
include("php/connect.php"); error_reporting(1);
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
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		<style>
		.vl {
		  border-left: 2px solid #2d3436;
		  height: 70px;
		}
		</style>
	</head>
	<body>
		<?php include 'navbar.php';?>
		
		<script>
			function logoutAlert(){
				bootbox.confirm({
					message: "Do you want to LogOut?",
					buttons: {
						cancel: {
							label: 'No',
							className: 'btn-danger'
						},
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						}
						
					},
					callback: function (result) {
						if(result==true){
							window.location="login/logout.php";
						}
					}
				});
			}
		</script>
		
		<?php
			$paid=0;
			$query="SELECT product_amt FROM tbl_neworder WHERE id={$_SESSION['id']}";
			$data=mysqli_query($con,$query);
			while($row = mysqli_fetch_array($data)) {
				$paid+=$row['product_amt'];
			}
			
			$received=0;
			$query="SELECT product_amt FROM tbl_returnorder WHERE id={$_SESSION['id']}";
			$data=mysqli_query($con,$query);
			while($row = mysqli_fetch_array($data)) {
				$received+=$row['product_amt'];
			}
			//echo"$received";
			$received=$received*0.85;
			//echo"$received";
			
			$remaining=0;
			$query="SELECT product_amt FROM tbl_invoice_description WHERE id={$_SESSION['id']} and type='new' ";
			$data=mysqli_query($con,$query);
			while($row = mysqli_fetch_array($data)) {
				$remaining+=$row['product_amt'];
			}
			$remaining=$remaining*0.85;
		?>
		<div class="container mt-3">
			<!--
			<div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card mt-5 mb-5">
			  <h5 class="card-header">Featured</h5>
			  <div class="card-body">
				<h5 class="card-title">Special title treatment</h5>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			  </div>
			</div>
			-->
			<h1 style="text-align:center;" class=" display-4 text-dark font-italic font-weight-bold mt-3 mb-4"><?php echo $_SESSION['name'];?></h1>
			<!--#############-->
			<div class="card-deck">
				
			    <div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card mb-3" >
				  <div class="card-header text-dark font-italic font-weight-bold">Paid</div>
				  <div class="card-body">
					<h5 class="card-title text-dark font-italic font-weight-bold"><?php echo "Rs "." ".$paid; ?></h5>
					<p class="card-text text-dark font-italic font-weight-bold">Amount indicates, cost of total purchase of books.</p>
				  </div>
				</div>
			  
			    <div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card mb-3" >
				  <div class="card-header text-dark font-italic font-weight-bold">Received</div>
				  <div class="card-body">
					<h5 class="card-title text-dark font-italic font-weight-bold"><?php echo "Rs "." ".$received; ?></h5>
					<p class="card-text text-dark font-italic font-weight-bold">Amount indicates, cost received after returning of books.</p>
				  </div>
				</div>
			  
			    <div style="background-color:#7efff5; box-shadow: 0 1px 18px black;" class="card mb-3" >
				  <div class="card-header text-dark font-italic font-weight-bold">Remaining</div>
				  <div class="card-body">
					<h5 class="card-title text-dark font-italic font-weight-bold"><?php echo "Rs "." ".$remaining; ?></h5>
					<p class="card-text text-dark font-italic font-weight-bold">Amount indicates, cost to be retrieved by the customer.</p>
				  </div>
				</div>
			  
			</div>
			<!--#############-->
			<div id="accordion"class="mb-4 mt-3">
			  <div style="background-color:#7efff5;" class="card">
				<div class="card-header" id="headingOne">
				  <h5 class="mb-0">
					<button class="btn btn-link text-dark font-italic font-weight-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					  My Orders
					</button>
				  </h5>
				</div>

				<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				  <div class="card-body">
					<?php
						//$query="SELECT * FROM tbl_invoive_date WHERE id={$_SESSION['id']} and type='new'";
						$query="select payable_amt, date_time, c.invoice_no, d.status from tbl_invoice_total c, tbl_invoive_date d where id={$_SESSION['id']} and c.type='new' and c.invoice_no = d.invoice_no";
						$data=mysqli_query($con,$query);
						while($row = mysqli_fetch_array($data)) {
					?>
						<div style="background-color:#7efff5; border: 1px solid #2d3436;" class="card">
							<h5 class="card-header ">
								<?php echo "INVOICE NO. ".$row["invoice_no"];?>
								<input class="btn btn-outline-dark" type="button" style="float: right;" name="status" value="<?php echo $row['status'];?>">
							</h5>
							
							<div class="card-body">
								<div class="form-row">
									<h5 class="card-title col-5"><?php echo "Total Amt <br>Rs"." ".$row["payable_amt"];?></h5>
									<div class="vl col-1"></div>
									<h5 class="card-title col-6"><?php echo "Date&Time <br>".$row["date_time"];?></h5>
									<a href="orderInvoice/newOrderInvoice.php?invoice_no=<?php echo $row['invoice_no']; ?>" class="btn btn-outline-dark">View Invoice</a>
								</div>
							</div>
						</div>
						<br>
					<?php	
						}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div style="background-color:#7efff5;" class="card">
				<div class="card-header" id="headingTwo">
				  <h5 class="mb-0">
					<button class="btn btn-link collapsed text-dark font-italic font-weight-bold" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					  My Returns
					</button>
				  </h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				  <div class="card-body">
					<?php
						//$query="SELECT * FROM tbl_invoive_date WHERE id={$_SESSION['id']} and type='return'";
						$query="select payable_amt, date_time, c.invoice_no, d.status from tbl_invoice_total c, tbl_invoive_date d where id={$_SESSION['id']} and c.type='return' and c.invoice_no = d.invoice_no";
						$data=mysqli_query($con,$query);
						while($row = mysqli_fetch_array($data)) {
					?>
						<div style="background-color:#7efff5; border: 1px solid #2d3436;" class="card">
							<h5 class="card-header ">
								<?php echo "INVOICE NO. ".$row["invoice_no"];?>
								<input class="btn btn-outline-dark" type="button" style="float: right;" name="status" value="<?php echo $row["status"];?>">
							</h5>
							
							<div class="card-body">
								<div class="form-row">
									<h5 class="card-title col-5"><?php echo "Total Amt <br>Rs"." ".$row["payable_amt"];?></h5>
									<div class="vl col-1"></div>
									<h5 class="card-title col-6"><?php echo "Date&Time <br>".$row["date_time"];?></h5>
									<a href="orderInvoice/returnOrderInvoice.php?invoice_no=<?php echo $row['invoice_no']; ?>" class="btn btn-outline-dark">View Invoice</a>
								</div>
							</div>
						</div>
						<br>
					<?php	
						}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div style="background-color:#7efff5;" class="card">
				<div class="card-header" id="headingThree">
				  <h5 class="mb-0">
					<button class="btn btn-link collapsed text-dark font-italic font-weight-bold" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					  Extra
					</button>
				  </h5>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
				  <div class="card-body">
					Aur nahi, itna he hai
				  </div>
				</div>
			  </div>
			</div>
			<input class="btn btn-outline-dark mb-3" onclick="logoutAlert()" type="button" name="Logout" value="Logout">
		</div>
		<?php if(isset($_SESSION["Returncart_item"])){unset($_SESSION["Returncart_item"]); unset($_SESSION["pid"]);}?>
	</body>
</html>
