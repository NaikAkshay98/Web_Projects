<?php
if (session_id() == ""){
	session_start();
}
$_SESSION["checkoutType"]="new";

require_once("php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
exit();
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
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>
	<body>
		<?php include 'navbar.php';?>
		
		<script>
		function cancelBtn(code){
			$.ajax({
			  method: "GET",
			  url: "cart.php?action=remove&code="+code,
			  //data: { name: "John", location: "Boston" }
			})
			$('#shopping-cart').load(' #shopping-cart');
			
			  
		  }
		  
		function emptyBtn(){
			$.ajax({
			  method: "GET",
			  url: "cart.php?action=empty",
			  //data: { name: "John", location: "Boston" }
			})
			$('#shopping-cart').load(' #shopping-cart');
			
		}
		
		</script>
		
		
		<?php
		if (isset($_GET['alert'])) {
				checkLogin();
		}
			function checkLogin(){
				if(!isset($_SESSION["name"]) ){
		?>
					<script>	bootbox.alert("please Login first"); </script>
		<?php			
				}else{
		?>
					<script>window.location="checkout/address.php";</script> 
						
				<?php
				}
			}  
		?>
		
		<div class="container" id="shopping-cart">
			<div class="txt-heading font-italic font-weight-bold">Shopping Cart</div>

			<?php
			if(isset($_SESSION["cart_item"])){
				$total_quantity = 0;
				$total_price = 0;
			?>
	
			<input id="emptyBtn" class="btn btn-outline-dark mt-3" style="float: right;" type="button" onclick="emptyBtn()" value="Empty Cart">
			
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th class="font-italic font-weight-bold" style="text-align:left;">Name</th>
						<th class="font-italic font-weight-bold" style="text-align:right;" width="5%">Quantity</th>
						<!--<th style="text-align:right;" width="10%">Unit Price</th>-->
						<th class="font-italic font-weight-bold" style="text-align:center;" width="10%">Price</th>
						<th style="text-align:center;" width="5%"></th>
					</tr>	
					<?php		
						foreach ($_SESSION["cart_item"] as $item){
							$item_price = $item["quantity"]*$item["price"];
					?>
							<tr>
								<td class="font-italic font-weight-bold"><?php echo $item["name"]; ?></td>
								<td class="font-italic font-weight-bold" style="text-align:center;"><?php echo $item["quantity"]; ?></td>
								<td class="font-italic font-weight-bold" style="text-align:center;"><?php echo "Rs ". number_format($item_price,2); ?></td>
								<td><input id="cancelBtn" class="btn btn-outline-danger" type="button" onclick="cancelBtn('<?php echo $item['code']; ?>')" style="font-size: 13px;" value="Delete"></td>
							</tr>
					<?php
							$total_quantity += $item["quantity"];
								
							$total_price += ($item["price"]*$item["quantity"]);
						}
					?>

					<tr>
						<td class="font-italic font-weight-bold" align="right">Total:</td>
						<td class="font-italic font-weight-bold" align="center"><?php echo $total_quantity; ?></td>
						<td class="font-italic font-weight-bold" align="center" ><?php echo "Rs ".number_format($total_price, 2); ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<a href="cart.php?alert=true"><input type="submit" class="btn btn-outline-dark" value="Proceed"></a>

			<?php
			} else {
			?>
				<div class="no-records font-italic font-weight-bold">Your Cart is Empty</div>
			<?php 
			}
			?>
		</div>
		<?php if(isset($_SESSION["Returncart_item"])){unset($_SESSION["Returncart_item"]); unset($_SESSION["pid"]);}?>
	</body>
</html>
