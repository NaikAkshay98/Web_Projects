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
	
	<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
	<link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	
	<link href="../css/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
<div class="container">
    <div class="page-header">
        <?php
			if($_SESSION["checkoutType"]=="new"){
		?>
				<h1 class="text-dark font-italic font-weight-bold">Order Details: New books</h1>
		<?php
			}else{
		?>
				<h1 class="text-dark font-italic font-weight-bold">Order Details: Return books</h1>	
		<?php
			}
		?>
    </div>
    <div class="container">
		
		<a href="exitPage.php"><input class="btn btn-outline-dark" type="button" name="confirmOrder" value="Home"></a>
        <a href="#"><input class="btn btn-outline-dark" type="button" name="confirmOrder" value="Save"></a>
		<a href="#"><input class="btn btn-outline-dark" type="button" name="confirmOrder" value="Print"></a>
		
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
						<div style="text-align:center;" class="col-md-4">
                            <h4 style="color: #F81D2D;"><strong>To</strong></h4>
                            <p><?php echo $_SESSION['inputName'];?></p>
                            <p><?php echo $_SESSION['inputAddress']." ".$_SESSION['inputAddress2'];?></p>
							<p><?php echo $_SESSION['inputCity']."  ".$_SESSION['inputState']."  ".$_SESSION['inputZip'];?></p>
                        </div>
						<div style="text-align:center;" class="col-md-4">
                            <h4 style="color: #F81D2D;"><strong>Details</strong></h4>
							<p><?php echo $_SESSION['inputNo'];?></p>
                            <p><?php echo $_SESSION['email'];?></p>
							<p><?php $timestamp = time(); echo date("F d, Y h:i:s A", $timestamp) ;?><p>
                        </div>
                    </div> <br />
               
					<div class="row">
                        <div class="col-md-12 text-center">
                            <h2>INVOICE</h2>
                            <h5><?php echo $_SESSION['invoice_no'];?></h5>
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
									$total_price=0;
									if($_SESSION["checkoutType"]=="new"){
										$x="cart_item";
									}else{
										$x="Returncart_item";	
									}
									foreach ($_SESSION[$x] as $item){
									$item_price = $item["quantity"]*$item["price"];
								?>
                                <tr>
                                    <td class="col-md-6"><?php echo $item["name"]; ?></td>
									<td class="col-md-3"><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $item["quantity"]; ?></td>
                                    <td class="col-md-3"><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo "Rs ".$item_price; ?></td>
                                </tr>
								<?php
									$total_price += ($item["price"]*$item["quantity"]);
								}
								
									$shipment_taxes = 50;
									
									if($_SESSION["checkoutType"]=="new"){
							
										$discount= 0;
								
									}else{
										//85% of total amt
										$discount=$total_price*0.85;	
								
									}
									
									
									if($_SESSION["checkoutType"]=="new"){
							
										$payable_amt=$shipment_taxes+$total_price+$discount;

								
									}else{
							
										$payable_amt=$shipment_taxes+$discount;	
								
									}
								?>
								
                                    <td colspan="2" class="text-right">
                                        <p> <strong>Shipment and Taxes:</strong> </p>
                                        <p> <strong>Total Amount: </strong> </p>
										<?php
											if($_SESSION["checkoutType"]=="new"){
										?>
												<p> <strong>Discount: </strong> </p>
										<?php
											}else{
										?>
												<p> <strong>85% of Total Amount: </strong> </p>	
										<?php
											}
										?>
                                        
                                        <p> <strong>Payable Amount: </strong> </p>
                                    </td>
                                    <td>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $shipment_taxes; ?></strong> </p>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <?php echo $total_price; ?></strong> </p>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $discount; ?></strong> </p>
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $payable_amt; ?></strong> </p>
                                    </td>
                                </tr>
                                <tr style="color: #F81D2D;">
                                    <td colspan="2" class="text-right">
                                        <h4><strong>Total:</strong></h4>
                                    </td>
                                    <td class="text-left">
                                        <h4><strong><i class="fas fa-rupee-sign" area-hidden="true"></i><?php echo $payable_amt; ?></strong></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
					<div>
                        <div class="col-md-12">
                            <p><b>Signature</b></p>
                        </div>
                    </div>
					<!--<div><a href="billing.php"><input type="button" name="confirmOrder" value="Confirm Order"></a></div>-->
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
     font-size: 10px
 }

 .main thead {
     background: #1E1F23;
     color: #fff
 }

 .img {
     height: 100px
 }

 h1 {
     text-align: center
 }

</style>

  </body>
</html>
