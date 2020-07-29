<?php
if (session_id() == ""){
	session_start();
}
include("../php/connect.php"); error_reporting(1);

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
	
	<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
	<link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	
	<link href="../css/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
<div class="container">
    <div class="page-header">
        <h1 class="text-dark font-italic font-weight-bold">Order Details</h1>
    </div>
    <div class="container">
		<div class="row">
            <div class="col-md-12 col-md-offset-3 body-main">
                <div class="col-md-12">
					<div><h1 style="text-align:center;" class="text-dark font-italic font-weight-bold">BOOKSTORE</h1></div>
                    <div class="row">
                        
						<div style="text-align:center;" class="col-md-4">
                            <h4 style="color: #F81D2D;"><strong>From</strong></h4>
                            <p>221 ,Baker Street</p>
                            <p>1800-234-124</p>
                            <p>example@gmail.com</p>
                        </div>
						<?php
								$query="SELECT * FROM tbl_invoice_address WHERE id={$_SESSION['id']}";
								$data=mysqli_query($con,$query);
								while($row = mysqli_fetch_array($data)) {
						?>
						<div style="text-align:center;" class="col-md-4">
                            <h4 style="color: #F81D2D;"><strong>To</strong></h4>
                            <p><?php echo $_SESSION["name"]; ?></p>
                            <p><?php echo $row['address']." ".$row['address2'];?></p>
							<p><?php echo $row['city']."  ".$row['state']."  ".$row['zip_code'];?></p>
                        </div>
						<div style="text-align:center;" class="col-md-4">
                            <h4 style="color: #F81D2D;"><strong>Details</strong></h4>
							<p><?php echo $row['phone_no'];?></p>
							<?php } ?>
                            <p>
								<?php 
									$query="SELECT * FROM tbl_registered_users WHERE id={$_SESSION['id']}";
									$data=mysqli_query($con,$query);
									while($row = mysqli_fetch_array($data)) {
										echo $row['email'];
									}
								?>
							</p>
							<p>
							<?php 
									$query="SELECT * FROM tbl_invoive_date WHERE id={$_SESSION['id']}  and invoice_no={$_GET['invoice_no']}";
									$data=mysqli_query($con,$query);
									while($row = mysqli_fetch_array($data)) {
										echo $row['date_time'];
									}
							?>
							<p>
                        </div>
                    </div> <br />
               
					<div class="row">
                        <div class="col-md-12 text-center">
                            <h2>INVOICE</h2>
                            <h5><?php echo $_GET['invoice_no'];?></h5>
                        </div>
                    </div> 
					<br />
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <h5>Description</h5>
                                    </th>
									<th>
                                        <h5>Qty</h5>
                                    </th>
                                    <th>
                                        <h5>Amount</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
										$query="SELECT * FROM tbl_neworder WHERE id={$_SESSION['id']} and invoice_no={$_GET['invoice_no']}";
										$data=mysqli_query($con,$query);
										while($row = mysqli_fetch_array($data)) {
								?>
                                <tr>
                                    <td class="col-md-6"><?php echo $row["description"]; ?></td>
									<td class="col-md-3"><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $row["qty"]; ?></td>
                                    <td class="col-md-3"><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo "Rs ".$row["product_amt"]; ?></td>
                                </tr>
								<?php
										}
								?>
								<!--###########################-->
								<?php
										$query="SELECT * FROM tbl_invoice_total WHERE invoice_no={$_GET['invoice_no']}";
										$data=mysqli_query($con,$query);
										while($row = mysqli_fetch_array($data)) {
								?>
								<tr>
									<td></td>
                                    <td class="text-right">
                                        <p> <strong>Shipment and Taxes:</strong> </p>
                                        <p> <strong>Total Amount: </strong> </p>
                                        <p> <strong>Discount: </strong> </p>
                                        <p> <strong>Payable Amount: </strong> </p>
                                    </td>
                                    <td>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $row["shipment_tax"]; ?></strong> </p>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <?php echo $row["total_amt"]; ?></strong> </p>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $row["discount"]; ?></strong> </p>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $row["payable_amt"]; ?></strong> </p>
                                    </td>
                                </tr>
                                <tr style="color: #F81D2D;">
									<td></td>
                                    <td class="text-right">
                                        <h4><strong>Total:</strong></h4>
                                    </td>
                                    <td class="text-left">
                                        <h4><strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $row["payable_amt"]; ?></strong></h4>
                                    </td>
                                </tr>
								<?php 
									}
								?>
								<!--###########################-->
                            </tbody>
                        </table>
                    </div>
					<div>
                        <div class="col-md-12">
                            <p><b>Signature</b></p>
                        </div>
                    </div>
					
                </div>
            </div>
        </div>
		
    </div>
</div>

<style>
 .body-main {
     background: #ffffff;
     border-bottom: 15px solid #1E1F23;
     border-top: 15px solid #1E1F23;
     margin-top: 30px;
     margin-bottom: 30px;
     padding: 40px 30px !important;
     position: relative;
     box-shadow: 0 1px 21px #808080;
     font-size: 10px;
 }

 .main thead {
     background: #1E1F23;
     color: #fff;
 }

 .img {
     height: 100px;
 }

 h1 {
     text-align: center;
 }

	</style>
  </body>
</html>
