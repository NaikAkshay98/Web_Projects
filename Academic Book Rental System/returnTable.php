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
			
			if(!empty($_SESSION["returnCart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["returnCart_item"]))) {
					foreach($_SESSION["returnCart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["returnCart_item"][$k]["quantity"])) {
									$_SESSION["returnCart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["returnCart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["returnCart_item"] = array_merge($_SESSION["returnCart_item"],$itemArray);
				}
			} else {
				$_SESSION["returnCart_item"] = $itemArray;
			}
		}
		
	break;
	
	case "remove":
		if(!empty($_SESSION["returnCart_item"])) {
			foreach($_SESSION["returnCart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["returnCart_item"][$k]);				
					if(empty($_SESSION["returnCart_item"]))
						unset($_SESSION["returnCart_item"]);
			}
		}
				
	break;
	case "empty":
		unset($_SESSION["returnCart_item"]);
	break;	
}
}
//session_destroy();
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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  </head>
  <body>
	<?php //include 'navbar.php';?>
	
		<div id="shopping-cart">
	<div class="txt-heading">Shopping Cart</div>

	<a id="btnEmpty" href="return1.php?action=empty">Empty Cart</a>
	<?php
	if(isset($_SESSION["returnCart_item"])){
		$total_quantity = 0;
		$total_price = 0;
	?>	
	<table class="tbl-cart" cellpadding="10" cellspacing="1">
	<tbody>
	<tr>
	<th style="text-align:left;">Name</th>
	<th style="text-align:left;">Code</th>
	<th style="text-align:right;" width="5%">Quantity</th>
	<th style="text-align:right;" width="10%">Unit Price</th>
	<th style="text-align:right;" width="10%">Price</th>
	<th style="text-align:center;" width="5%">Remove</th>
	</tr>	
	<?php		
		foreach ($_SESSION["returnCart_item"] as $item){
			$item_price = $item["quantity"]*$item["price"];
			?>
					<tr>
					<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
					<td><?php echo $item["code"]; ?></td>
					<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
					<td  style="text-align:right;"><?php echo "Rs ".$item["price"]; ?></td>
					<td  style="text-align:right;"><?php echo "Rs ". number_format($item_price,2); ?></td>
					<td style="text-align:center;"><a href="return1.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="image/icon/icon-delete.png" alt="Remove Item" /></a></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"]*$item["quantity"]);
			}
			?>

	<tr>
	<td colspan="2" align="right">Total:</td>
	<td align="right"><?php echo $total_quantity; ?></td>
	<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
	<td></td>
	</tr>
	</tbody>
	</table>		
	  <?php
	} else {
	?>
	<div class="no-records">Your Cart is Empty</div>
	<?php 
	}
	?>
	</div>
</body>
</html>