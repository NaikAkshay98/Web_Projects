<?php
if (session_id() == ""){
	session_start();
}

require_once("php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
}
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
	
	<h1 class="font-weight-bold">Return</h1>
	
	<div id="shopping-cart">
	<div class="txt-heading">Return Cart</div>

	
	<table class="tbl-cart" cellpadding="10" cellspacing="1">
	<tbody>
	<tr>
	<th style="text-align:left;">Name</th>
	<th style="text-align:right;" width="10%">Course</th>
	<th style="text-align:right;" width="10%">Semester</th>
	<th style="text-align:right;" width="10%">Date Time</th>
	<th style="text-align:right;" width="10%">Code</th>
	<th style="text-align:right;" width="10%">Invoice NO.</th>
	<th style="text-align:right;" width="10%">Quantity</th>
	<th style="text-align:right;" width="10%">Price</th>
	<th style="text-align:center;" width="5%">Return</th>
	</tr>	
	<?php
		$total_quantity = 0;
		$total_price = 0;
		include("php/connect.php"); error_reporting(1);
		$query="select s.id,code,n.invoice_no, image,description,qty,product_amt,price,course,semester,date_time from  tbl_invoice_description s,tblproduct m, tbl_invoive_date n where s.id={$_SESSION['id']} and s.description = m.name and s.invoice_no=n.invoice_no";
		$data=mysqli_query($con,$query);
		while($row = mysqli_fetch_array($data)) {
	?>
	
					<tr>
					<td><img src="<?php echo $row["image"]; ?>" class="cart-item-image" /><?php echo $row["description"]; ?></td>
					<td style="text-align:right;"><?php echo $row["course"]; ?></td>
					<td style="text-align:right;"><?php echo $row["semester"]; ?></td>
					<td style="text-align:right;"><?php echo $row["date_time"]; ?></td>
					<td style="text-align:right;"><?php echo $row["code"]; ?></td>
					<td style="text-align:right;"><?php echo $row["invoice_no"]; ?></td>
					<td style="text-align:right;"><?php echo $row["qty"]; ?></td>
					<td  style="text-align:right;"><?php echo "Rs ".$row["product_amt"]; ?></td>
					<td><a href="return.php?action=add&code=<?php echo $row["code"]; ?>"><input class="btn btn-success" type="button" name="confirmOrder" value="Return"></a></td>
					</tr>
	<?php
					$total_quantity += 1;
					$total_price += $row["product_amt"];
			
		
					
	}
	if($total_quantity ==0){
	?>
	<div class="no-records">Your Cart is Empty</div>
	<?php
	}
	?>

	<tr>
	<td colspan="4"></td>
	<td colspan="2" align="right">Total:</td>
	<td align="right"><?php echo $total_quantity; ?></td>
	<td align="right"><strong><?php echo "Rs ".$total_price; ?></strong></td>
	<td></td>
	</tr>
	</tbody>
	</table>		
	
	</div>

		<div><a href="#"><input type="submit" value="Proceed >>>"></div>
  </body>
</html>
